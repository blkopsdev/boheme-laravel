<?php

namespace App\Http\Controllers;

use App\BusinessMail;
use App\ContentAdding;
use App\ExtraWork;
use App\ExtraFunction;
use App\FirstHome;
use App\FirstFeedback;
use App\FinalFeedback;
use App\Hosting;
use App\LogoDesignForm;
use App\LogoFeedback;
use App\LogoFirstFeedback;
use App\LogoFinalFeedback;
use App\MailError;
use App\Media;
use App\Onboarding;
use App\Project;
use App\Status;
use App\TextFeedback;
use App\TextFinalFeedback;
use App\TextFirstFeedback;
use App\TextWriting;
use App\WebDesign;
use App\WebdesignFirstVersion;
use App\WebdesignFinalVersion;
use App\WebdesignDev;
use App\WebdesignOnboarding;
use App\WebsiteFeedback;
use App\WebshopOnboarding;
use App\WebsiteTextAdding;
use App\User;

use PDF;

use App\Mail\FotobaseMail;
use App\Mail\AnswerSavedMail;
use App\Mail\FormSubmitEmail;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function logoDesign(Request $request, $id) 
    {
        $form = LogoDesignForm::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }

        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        $status_id = Status::whereSlug('logo_design')->value('id');
        $logo_files = Media::whereProjectId($form->project_id)->whereType('image')->whereStatusId($status_id)->whereRef('logo_reference')->get();
        return view('forms.logo_design', compact('form', 'logo_files'));
    }

    public function updateLogoDesign($id, Request $request) 
    {
        $form = LogoDesignForm::find($id);

        $rules = [
            'company_name'      => 'required',
            'niche'             => 'required',
            'logo_styles'       => 'required',
            'favorite_logo_1'   => 'required',
            'favorite_logo_2'   => 'required',
            'favorite_logo_3'   => 'required',
            'favorite_logo_4'   => 'required',
            'purposes'          => 'required',
        ];

        if ($request->logo_color == 'on') {
            $logo_color = '1';
        } else {
            $logo_color = '0';
        }
        $data = [
            'company_name' => $request->company_name,
            'slogan' => $request->slogan,
            'niche' => $request->niche,
            'favorite_logo_1' => $request->favorite_logo_1,
            'favorite_logo_2' => $request->favorite_logo_2,
            'favorite_logo_3' => $request->favorite_logo_3,
            'favorite_logo_4' => $request->favorite_logo_4,
            'types'     => json_encode($request->logo_styles),
            'purpose' => json_encode($request->purposes),
            'logo_color' => $logo_color,
            'main_color' => $request->main_color,
            'sub_color_1' => $request->sub_color_1,
            'sub_color_2' => $request->sub_color_2,
            'inspiration_logo' => $request->inspiration_logo
        ];

        $status_id = Status::whereSlug('logo_design')->value('id');
        if ($request->hasFile('reference_color') != Null) {

            $file = $request->file('reference_color');
            $file_size = fileSizeMB($file->getSize());
            
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            $media = Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'reference_color']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            
            $data['reference_color'] = $media->id;
        } else {
            $color_file = Media::whereProjectId($form->project_id)->whereType('image')->whereStatusId($status_id)->whereRef('reference_color')->get();
            if ($request->logo_color != 'on' && $color_file->count() == 0) {
                $rules['main_color'] = 'required';
                $messages['main_color.required'] = trans('form.logo_color_required');
            }
        }

        if ($request->hasFile('logo_files') != Null) {
            $status_id = Status::whereSlug('logo_design')->value('id');

            $files = $request->file('logo_files');
            $file_names = [];
            foreach($files as $file) {
                $file_size = fileSizeMB($file->getSize());
                if ($file_size > 8) {
                    return redirect()->back()->with('error', trans('app.file_size_error_msg'));
                }
                
                $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                $media = Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'logo_reference']);
                $destinationPath = 'uploads/';
                $file->move($destinationPath, $file_name);
                array_push($file_names, $media->id);
            }
            $data['logo_file'] = json_encode($file_names);
        }
        
        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }
        
        
        $messages = [
            'logo_styles.required'          => trans('app.logo_styles_required'),
            'favorite_logo_1.required'      => trans('app.favorite_logo_required'),
            'favorite_logo_2.required'      => trans('app.favorite_logo_required'),
            'favorite_logo_3.required'      => trans('app.favorite_logo_required'),
            'favorite_logo_4.required'      => trans('app.favorite_logo_required'),
            'purposes.required'             => trans('app.purposes_required'),
        ];

        

        if($request->quick_save == 0) {
            $this->validate($request, $rules, $messages);
            $data['status'] = '1';
        }

        $update = $form->update($data);

        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            add_comment($form->project_id, trans('app.logo_design_form_submit'));
            project_action($form->project_id, 'company');
            
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('logo_design', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }

    }

    public function logoFirstFeedback(Request $request, $id) 
    {
        $form = LogoFirstFeedback::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.logo_first_feedback', compact('form'));
    }

    public function updateLogoFirstFeedback($id, Request $request) 
    {
        $form = LogoFirstFeedback::find($id);
        $rules = [
            'logo_name' => 'required',
            'logo_feedback' => 'required',
        ];

        $data = [
            'filename' => $request->logo_name,
            'feedback'  => $request->logo_feedback,
        ];

        $status_id = Status::whereSlug('logo_version_1')->value('id');
        if ($request->File('files')) {
            $files = $request->file('files');
            foreach($files as $file) {
                $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'logo_version_1']);
                $destinationPath = 'uploads/';
                $file->move($destinationPath, $file_name);
            }
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules);
            $data['status'] = '1';

            $update = $form->update($data);
            add_comment($form->project_id, trans('app.logo_feedback_form_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('logo_version_1', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }

    }

    public function logoFinalFeedback(Request $request, $id) 
    {
        $form = LogoFinalFeedback::find($id);

        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }

        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.logo_final_feedback', compact('form'));
    }

    public function updateLogoFinal($id, Request $request) 
    {
        $form = LogoFinalFeedback::find($id);
        $rules = [
            'logo_name' => 'required',
            'logo_feedback' => 'required',
        ];

        $data = [
            'filename' => $request->logo_name,
            'feedback' => $request->logo_feedback,
        ];

        if ($request->File('files')) {
            $status_id = Status::whereSlug('logo_version_2')->value('id');

            $files = $request->file('files');
            foreach($files as $file) {
                $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'logo_version_2']);
                $destinationPath = 'uploads/';
                $file->move($destinationPath, $file_name);
            }
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules);
            $data['status'] = '1';

            $update = $form->update($data);
            add_comment($form->project_id, trans('app.logo_final_feedback_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('logo_version_2', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function webdesign(Request $request, $id) 
    {
        $form = WebDesign::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.webdesign', compact('form'));
    }

    public function updateWebdesign(Request $request, $id)
    {
        $form = WebDesign::find($id);
        
        $rules = [
            'industry'              => 'required',
            'type'                  => 'required',
            'usp.0'                 => 'required',
            'contact_phone'         => 'required',
            'contact_email'         => 'required',
            'contact_address'       => 'required',
            'appeal_1'              => 'required',
            'appeal_2'              => 'required',
            'appeal_3'              => 'required',
            'appeal_4'              => 'required',
            'reference.0'           => 'required',
            'service_highlight.0'   => 'required',
        ];

        $messages = [
            'type.required'          => trans('app.type_required'),
            'appeal_1.required'      => trans('app.appeal_required'),
            'appeal_2.required'      => trans('app.appeal_required'),
            'appeal_3.required'      => trans('app.appeal_required'),
            'appeal_4.required'      => trans('app.appeal_required'),
            'usp.0.required'         => trans('app.usp_required'),
            'reference.0.required'   => trans('app.reference_required'),
            'service_highlight.0.required'     => trans('app.service_required'),
        ];

        if($request->main_color == null && $request->use_logo_color != 1 && $request->website_color != 1) {
            $rules['main_color'] = 'required';
            $messages['main_color.required'] = trans('form.color_picker_required');
        }

        $data = [
            'industry'                  => $request->industry,
            'purpose'                   => $request->purpose,
            'purpose_description'       => $request->purpose_description,
            'focus'                     => $request->focus,
            'focus_description'         => $request->focus_description,
            'type'                      => json_encode($request->type),
            'usp'                       => json_encode($request->usp),
            'contact_phone'             => $request->contact_phone,
            'contact_email'             => $request->contact_email,
            'contact_address'           => $request->contact_address,
            'font'                      => $request->font,
            'font_description'          => $request->font_description,
            'appeal_1'                  => $request->appeal_1,
            'appeal_2'                  => $request->appeal_2,
            'appeal_3'                  => $request->appeal_3,
            'appeal_4'                  => $request->appeal_4,
            'reference'                 => json_encode($request->reference),
            'team'                      => $request->team,
            'review'                    => $request->review,
            'portfolio'                 => $request->portfolio,
            'blog'                      => $request->blog,
            'newsletter'                => $request->newsletter,
            'service_highlight'         => json_encode($request->service_highlight),
            'use_logo_color'            => $request->use_logo_color,
            'main_color'                => $request->main_color,
            'sub_color_1'               => $request->sub_color_1,
            'sub_color_2'               => $request->sub_color_2,
            'logo_notes'                => $request->logo_notes
        ];
        
        $status_id = Status::whereSlug('web_design')->value('id');
        
        if ($request->File('font_file') != Null) {
            $file = $request->file('font_file');
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'font_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
        }

        if ($request->File('logo_file') != Null) {
            $file = $request->file('logo_file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'logo_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
        }
        
        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }
        
        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules, $messages);
            $data['status'] = '1';
            $update = $form->update($data);
            add_comment($form->project_id, trans('app.webdesign_form_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('web_design', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function webdesignOnboarding(Request $request, $id) 
    {
        $form = WebdesignOnboarding::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.webdesign_onboarding', compact('form'));
    }

    public function updateWebdesignOnboarding(Request $request, $id)
    {
        $form = WebdesignOnboarding::find($id);
        
        $rules = [
            'industry'              => 'required',
            'type'                  => 'required',
            'usp.0'                 => 'required',
            'contact_phone'         => 'required',
            'contact_email'         => 'required',
            'contact_address'       => 'required',
            'appeal_1'              => 'required',
            'appeal_2'              => 'required',
            'appeal_3'              => 'required',
            'appeal_4'              => 'required',
            'reference.0'           => 'required',
        ];

        $messages = [
            'type.required'          => trans('app.type_required'),
            'appeal_1.required'      => trans('app.appeal_required'),
            'appeal_2.required'      => trans('app.appeal_required'),
            'appeal_3.required'      => trans('app.appeal_required'),
            'appeal_4.required'      => trans('app.appeal_required'),
            'usp.0.required'         => trans('app.usp_required'),
            'reference.0.required'   => trans('app.reference_required'),
        ];

        $data = [
            'industry'                  => $request->industry,
            'type'                      => json_encode($request->type),
            'usp'                       => json_encode($request->usp),
            'contact_phone'             => $request->contact_phone,
            'contact_email'             => $request->contact_email,
            'contact_address'           => $request->contact_address,
            'font'                      => $request->font,
            'font_description'          => $request->font_description,
            'appeal_1'                  => $request->appeal_1,
            'appeal_2'                  => $request->appeal_2,
            'appeal_3'                  => $request->appeal_3,
            'appeal_4'                  => $request->appeal_4,
            'reference'                 => json_encode($request->reference),
            'team'                      => $request->team,
            'review'                    => $request->review,
            // 'portfolio'                 => $request->portfolio,
            'blog'                      => $request->blog,
            'newsletter'                => $request->newsletter,
            'use_logo_color'            => $request->logo_color,
            'website_color'             => $request->logo_color,
            'main_color'                => $request->main_color,
            'sub_color_1'               => $request->sub_color_1,
            'sub_color_2'               => $request->sub_color_2,
            'logo_notes'                => $request->logo_notes
        ];

        if(!$request->main_color && $request->use_logo_color != 1 && $request->website_color != 1) {
            $rules['main_color'] = 'required';
            $messages['main_color.required'] = trans('form.color_picker_required');
        }
        
        $status_id = Status::whereSlug('webdesign_onboarding')->value('id');

        if ($request->File('font_file') != Null) {
            $file = $request->file('font_file');
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'font_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $data['font_file']  = $file_name;
        }

        if ($request->File('logo_file') != Null) {
            $file = $request->file('logo_file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'logo_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $data['logo_file']  = $file_name;
        }
        
        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $data['status'] = '1';
            $this->validate($request, $rules, $messages);
            $update = $form->update($data);
            add_comment($form->project_id, trans('app.webdesign_onboarding_form_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('webdesign_onboarding', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function webdesignFirstVersion(Request $request, $id) 
    {
        $form = WebdesignFirstVersion::find($id);

        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        $status = 'webdesign_version_1';
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.webdesign_feedback', compact('form', 'status'));
    }

    public function updateWebdesignFirstVersion(Request $request, $id)
    {
        $form = WebdesignFirstVersion::find($id);
        $rules = [
            'feedback' => 'required',
        ];
        
        $data = [
            'feedback'  => $request->feedback,
        ];

        if ($request->hasFile('files') != Null) {
            $status_id = Status::whereSlug('webdesign_version_1')->value('id');

            $files = $request->file('files');
            foreach($files as $file) {
                
                $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'webdesign_version_1']);
                $destinationPath = 'uploads/';
                $file->move($destinationPath, $file_name);
            }
        }

        $project = Project::find($form->project_id);
        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        if($request->quick_save == 0) {
            $this->validate($request, $rules);
            $data['status'] = '1';
            $update = $form->update($data);

            add_comment($form->project_id, trans('app.webdesign_first_feedback_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('webdesign_version_1', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function webdesignFinalVersion(Request $request, $id) 
    {
        $form = WebdesignFinalVersion::find($id);

        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        $status = 'webdesign_version_2';
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.webdesign_feedback', compact('form', 'status'));
    }

    public function updateWebdesignFinalVersion(Request $request, $id)
    {
        $form = WebdesignFinalVersion::find($id);
        $rules = [
            'feedback' => 'required',
        ];
        
        $data = [
            'feedback'  => $request->feedback,
        ];

        if ($request->hasFile('files') != Null) {
            $status_id = Status::whereSlug('webdesign_version_2')->value('id');

            $files = $request->file('files');
            foreach($files as $file) {
                    
                $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'webdesign_version_2']);
                $destinationPath = 'uploads/';
                $file->move($destinationPath, $file_name);
            }
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules);
            $data['status'] = '1';
            $update = $form->update($data);
            
            add_comment($form->project_id, trans('app.webdesign_final_feedback_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('webdesign_version_2', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function TextWriting(Request $request, $id) 
    {
        $form = TextWriting::find($id);

        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        $status_id = Status::whereSlug('text_writing')->value('id');
        $files = Media::whereProjectId($form->project_id)->whereType('image')->whereStatusId($status_id)->whereRef('text_writing')->get();

        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.text_writing', compact('form', 'files'));
    }

    public function updateTextWriting($id, Request $request) 
    {
        $form = TextWriting::find($id);
        $rules = [
            'market'                => 'required',
            'usp.0'                 => 'required',
            'competitors.0'         => 'required',
            'customers'             => 'required',
            'wishes'                => 'required',
            'concrete'              => 'required',
            'promise'               => 'required',
            'working_method'        => 'required',
            'visitor_description'   => 'required',
            'page_names.*'          => 'required',
            'guidelines.*'          => 'required',
        ];
        $messages = [
            'usp.0.required'            => trans('app.usp_required'),
            'competitors.0.required'    => trans('app.competitors_required'),
            'page_names.*.required'     => trans('app.page_names_required'),
            'guidelines.*.required'     => trans('app.guidelines_required'),
        ];

        $data = [
            'market'                => $request->market,
            'usp'                   => json_encode($request->usp),
            'focus'                 => $request->focus,
            'customers'             => $request->customers,
            'competitors'           => json_encode($request->competitors),
            'wishes'                => $request->wishes,
            'concrete'              => $request->concrete,
            'promise'               => $request->promise,
            'page_names'            => json_encode($request->page_names),
            'guidelines'            => json_encode($request->guidelines),
            'working_method'        => $request->working_method,
            'visitor_description'   => $request->visitor_description,
        ];

        if ($request->File('page_files') != Null) {

            $status_id = Status::whereSlug('text_writing')->value('id');
            
            $files = $request->file('page_files');
            $file_names = [];
            for($i = 0; $i < count($request->page_names); $i++) {
                if(isset($files[$i])) {
                    $file = $files[$i];
                    
                    $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                    $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                    $destinationPath = 'uploads/';
                    $file->move($destinationPath, $file_name);
                    Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'text_writing', 'page_num' => $i]);
                }
            }
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules, $messages);
            $data['status'] = '1';

            $update = $form->update($data);

            add_comment($form->project_id, trans('app.text_writing_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('text_writing', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function TextFirstFeedback(Request $request, $id) 
    {
        $form = TextFirstFeedback::find($id);

        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }

        return view('forms.text_first_feedback', compact('form'));
    }

    public function updateTextFirstFeedback($id, Request $request) 
    {
        $form = TextFirstFeedback::find($id);

        $rules = [
            'page_names.*' => 'required',
            'page_feedbacks.*' => 'required'
        ];

        $data = [
            'page_names'          => json_encode($request->page_names),
            'page_feedbacks'      => json_encode($request->page_feedbacks),
        ];

        if ($request->File('page_files') != Null) {
            $status_id = Status::whereSlug('text_version_1')->value('id');
            
            $files = $request->file('page_files');
            for($i = 0; $i < count($request->page_names); $i++) {
                if(isset($files[$i])) {
                    $file = $files[$i];
                    
                    $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                    $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                    $destinationPath = 'uploads/';
                    $file->move($destinationPath, $file_name);
                    Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'text_version_1', 'page_num' => $i]);
                } 
            }
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules);
            $data['status'] = '1';
            $update = $form->update($data);
            add_comment($form->project_id, trans('app.text_first_feedback_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('text_version_1', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function TextFinalFeedback(Request $request, $id) 
    {
        $form = TextFinalFeedback::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.text_final_feedback', compact('form'));
    }

    public function updateTextFinalFeedback($id, Request $request) 
    {
        $form = TextFinalFeedback::find($id);

        $rules = [
            'page_names.*' => 'required',
            'page_feedbacks.*' => 'required'
        ];

        $data = [
            'page_names'          => json_encode($request->page_names),
            'page_feedbacks'      => json_encode($request->page_feedbacks),
        ];

        if ($request->File('page_files') != Null) {
            $status_id = Status::whereSlug('text_version_2')->value('id');
            
            $files = $request->file('page_files');
            for($i = 0; $i < count($request->page_names); $i++) {
                if(isset($files[$i])) {
                    $file = $files[$i];
                    
                    $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                    $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                    $destinationPath = 'uploads/';
                    $file->move($destinationPath, $file_name);
                    Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'text_version_2', 'page_num' => $i]);
                } 
            }
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules);
            $data['status'] = '1';
            $update = $form->update($data);
            add_comment($form->project_id, trans('app.text_final_feedback_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('text_version_2', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function onboarding(Request $request, $id) 
    {
        $form = Onboarding::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.onboarding', compact('form'));
    }

    public function updateOnboarding($id, Request $request) 
    {
        $form = Onboarding::find($id);
        $rules = [
            'purpose'               => 'required',
            'focus'                 => 'required',
            'menu_item_1'           => 'required',
            'domain_name'           => 'required',
            'domain_provider'       => 'required',
            'domain_username'       => 'required',
            'domain_password'       => 'required',
            'ref_websites.0'        => 'required',
            'seo_keywords.0'        => 'required',
            'contact_mail'          => 'required',
            'contact_phone'         => 'required',
            'contact_address'       => 'required',
        ];

        $messages = [
            'menu_item_1.required'              => trans('app.menu_item_required'),
            'ref_websites.0.required'           => trans('app.ref_websites_required'),
            'seo_keywords.0.required'           => trans('app.seo_keywords_required'),
        ];

        $data = [
            'purpose'               => $request->purpose,
            'purpose_comment'       => $request->purpose_comment,
            'focus'                 => $request->focus,
            'focus_comment'         => $request->focus_comment,
            'menu_item_1'           => $request->menu_item_1,
            'menu_item_2'           => $request->menu_item_2,
            'menu_item_3'           => $request->menu_item_3,
            'menu_item_4'           => $request->menu_item_4,
            'menu_item_5'           => $request->menu_item_5,
            'menu_item_6'           => $request->menu_item_6,
            'submenu_item_1'        => json_encode($request->submenu_item_1),
            'submenu_item_2'        => json_encode($request->submenu_item_2),
            'submenu_item_3'        => json_encode($request->submenu_item_3),
            'submenu_item_4'        => json_encode($request->submenu_item_4),
            'submenu_item_5'        => json_encode($request->submenu_item_5),
            'submenu_item_6'        => json_encode($request->submenu_item_6),
            'menu_comment'          => $request->menu_comment,
            'domain_name'           => $request->domain_name,
            'domain_provider'       => $request->domain_provider,
            'domain_username'       => $request->domain_username,
            'domain_password'       => $request->domain_password,
            'ref_websites'          => json_encode($request->ref_websites),
            'seo_keywords'          => json_encode($request->seo_keywords),
            /* 'layout'                => $request->layout,
            'layout_comment'        => $request->layout_comment, */
            'image_source'          => $request->image_source,
            'contact_phone'         => $request->contact_phone,
            'contact_mail'          => $request->contact_mail,
            'contact_address'       => $request->contact_address,
            'social'                => json_encode($request->social),
            'social_links'          => json_encode($request->social_links),
            'main_color'            => $request->main_color,
            'sub_color_1'           => $request->sub_color_1,
            'sub_color_2'           => $request->sub_color_2,
            'website_color'         => $request->website_color,
            'use_logo_color'        => $request->use_logo_color,
        ];

        if($request->has_domain == null) {
            $data['has_domain'] = '0';
        } else {
            $data['has_domain'] = $request->has_domain;
        }

        if($request->main_color == null && $request->use_logo_color != 1 && $request->website_color != 1) {
            $rules['main_color'] = 'required';
            $messages['main_color.required'] = trans('form.color_picker_required');
        }

        if ($request->hasFile('logo_name') != Null) {
            
            $status_id = Status::whereSlug('onboarding')->value('id');
            $file = $request->file('logo_name');
            $file_size = fileSizeMB($file->getSize());
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $media = Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'website_onboarding']);
            $data['logo_name']  = $media->id;
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        if ($request->image_source == 1) {
            $project = Project::find($form->project_id);
            $user = $project->user;
            Mail::to($project->email)->send(new FotobaseMail($project, $user));
        }
        
        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules, $messages);
            $data['status'] = '1';
            $update = $form->update($data);
            add_comment($form->project_id, trans('app.onboarding_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('onboarding', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function WebshopOnboarding(Request $request, $id) 
    {
        $form = WebshopOnboarding::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.webshop_onboarding', compact('form'));
    }

    public function updateWebshopOnboarding($id, Request $request) 
    {
        $form = WebshopOnboarding::find($id);
        $rules = [
            'company_name'          => 'required',
            'niche'                 => 'required',
            'menu_item_1'           => 'required',
            'domain_name'           => 'required',
            'domain_provider'       => 'required',
            'domain_username'       => 'required',
            'domain_password'       => 'required',
            'ref_websites.0'        => 'required',
            'seo_keywords.0'        => 'required',
            'contact_mail'          => 'required',
            'contact_phone'         => 'required',
            'contact_address'       => 'required',
        ];

        $messages = [
            'menu_item_1.required'              => trans('app.menu_item_required'),
            'ref_websites.0.required'           => trans('app.ref_websites_required'),
            'seo_keywords.0.required'           => trans('app.seo_keywords_required'),
        ];

        $data = [
            'company_name'          => $request->company_name,
            'slogan'                => $request->slogan,
            'niche'                 => $request->niche,
            'menu_item_1'           => $request->menu_item_1,
            'menu_item_2'           => $request->menu_item_2,
            'menu_item_3'           => $request->menu_item_3,
            'menu_item_4'           => $request->menu_item_4,
            'menu_item_5'           => $request->menu_item_5,
            'menu_item_6'           => $request->menu_item_6,
            'submenu_item_1'        => json_encode($request->submenu_item_1),
            'submenu_item_2'        => json_encode($request->submenu_item_2),
            'submenu_item_3'        => json_encode($request->submenu_item_3),
            'submenu_item_4'        => json_encode($request->submenu_item_4),
            'submenu_item_5'        => json_encode($request->submenu_item_5),
            'submenu_item_6'        => json_encode($request->submenu_item_6),
            'menu_comment'          => $request->menu_comment,
            'domain_name'           => $request->domain_name,
            'domain_provider'       => $request->domain_provider,
            'domain_username'       => $request->domain_username,
            'domain_password'       => $request->domain_password,
            'ref_websites'          => json_encode($request->ref_websites),
            'seo_keywords'          => json_encode($request->seo_keywords),
            // 'layout'                => $request->layout,
            // 'layout_comment'        => $request->layout_comment,
            'image_source'          => $request->image_source,
            'contact_phone'         => $request->contact_phone,
            'contact_mail'          => $request->contact_mail,
            'contact_address'       => $request->contact_address,
            'kvk'                   => $request->kvk,
            'btw_num'               => $request->btw_num,
            'social'                => json_encode($request->social),
            'social_links'          => json_encode($request->social_links),
            'main_color'            => $request->main_color,
            'sub_color_1'           => $request->sub_color_1,
            'sub_color_2'           => $request->sub_color_2,
            'website_color'         => $request->website_color,
            'use_logo_color'        => $request->use_logo_color,
        ];

        if(!$request->main_color && $request->use_logo_color != 1 && $request->website_color != 1) {
            $rules['main_color'] = 'required';
            $messages['main_color.required'] = trans('form.color_picker_required');
        }
        
        if($request->has_domain == null) {
            $data['has_domain'] = '0';
        } else {
            $data['has_domain'] = $request->has_domain;
        }

        if ($request->hasFile('logo_file') != Null) {
            
            $status_id = Status::whereSlug('webshop_onboarding')->value('id');
            
            $file = $request->file('logo_file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'webshop_onboarding']);
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        if ($request->image_source == 1) {
            $project = Project::find($form->project_id);
            $user = $project->user;
            Mail::to($project->email)->send(new FotobaseMail($project, $user));
        }
        
        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules, $messages);
            $data['status'] = '1';
            $update = $form->update($data);
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            add_comment($form->project_id, trans('app.webshop_onboarding_submit'));
            project_action($form->project_id, 'company');
            
            return view('forms.thankyou', compact('form'));
        } else {
            
            $route = route('webshop_onboarding', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function webdesignDev(Request $request, $id) 
    {
        $form = WebdesignDev::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.webdesign_dev', compact('form'));
    }

    public function updateWebdesignDev(Request $request, $id)
    {
        $form = WebdesignDev::find($id);
        $rules = [
            'menu_item_1'           => 'required',
            'social_links.0'        => 'required',
        ];

        $messages = [
            'menu_item_1.required'              => trans('app.menu_item_required'),
            'social_links.0.required'           => trans('app.social_links_required'),
        ];

        $data = [
            'menu_item_1'           => $request->menu_item_1,
            'menu_item_2'           => $request->menu_item_2,
            'menu_item_3'           => $request->menu_item_3,
            'menu_item_4'           => $request->menu_item_4,
            'menu_item_5'           => $request->menu_item_5,
            'menu_item_6'           => $request->menu_item_6,
            'submenu_item_1'        => json_encode($request->submenu_item_1),
            'submenu_item_2'        => json_encode($request->submenu_item_2),
            'submenu_item_3'        => json_encode($request->submenu_item_3),
            'submenu_item_4'        => json_encode($request->submenu_item_4),
            'submenu_item_5'        => json_encode($request->submenu_item_5),
            'submenu_item_6'        => json_encode($request->submenu_item_6),
            'menu_comment'          => $request->menu_comment,
            'social_links'          => json_encode($request->social_links),
        ];

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }
        
        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules, $messages);
            $data['status'] = '1';
            $update = $form->update($data);

            add_comment($form->project_id, trans('app.webdesign_dev_form_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            
            $route = route('webdesign_dev', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function firstHome(Request $request, $id) 
    {
        $form = FirstHome::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }

        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.first_home', compact('form'));
    }

    public function updateFirstHome(Request $request, $id)
    {
        $form = FirstHome::find($id);
        $rules = [
            'feedback' => 'required',
        ];
        
        $data = [
            'feedback'  => $request->feedback,
        ];
        
        if ($request->hasFile('files') != Null) {
            $status_id = Status::whereSlug('first_home')->value('id');

            $files = $request->file('files');
            $file_names = [];
            foreach($files as $file) {
                    
                $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'first_home']);
                $destinationPath = 'uploads/';
                $file->move($destinationPath, $file_name);
                    
            }
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules);
            $data['status'] = '1';
            $update = $form->update($data);
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            add_comment($form->project_id, trans('app.first_home_submit'));
            project_action($form->project_id, 'company');
            
            return view('forms.thankyou', compact('form'));
        } else {
            
            $route = route('first_home', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function textAdding(Request $request, $id) 
    {
        $form = WebsiteTextAdding::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }

        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.text_adding', compact('form'));
    }

    public function updateTextAdding($id, Request $request) 
    {
        $form = WebsiteTextAdding::find($id);
        $rules = [
            'usp.0'         => 'required',
            'titles.0'      => 'required',
        ];
        if (!$request->hasFile('text_file') && !$form->file('text_file')) {
            $rules['text_file'] = 'required';
        }

        if($request->team == 1 && $request->team_file_later != 'on') {
            if (!$form->file('team_doc')) {
                $rules['team_doc'] = 'required';
            }
            if (!$form->file('team_photo')) {
                $rules['team_photo'] = 'required';
            }
        }

        $messages = [
            'usp.0.required'            => trans('app.usp_required'),
            'titles.0.required'         => trans('app.titles_required'),
        ];

        $data = [
            'direct_text'   => $request->direct_text,
            'usp'           => json_encode($request->usp),
            'titles'        => json_encode($request->titles),
            'team'          => $request->team,
            'team_text'     => $request->team_text,
            'other_comment' => $request->other_comment,
            'review'        => $request->review,
            'review_link'   => $request->review_link,
            'portfolio'     => $request->portfolio,
            'portfolio_link'=> $request->portfolio_link,
            'blog'          => $request->blog,
            'blog_link'     => $request->blog_link,
            'newsletter'    => $request->newsletter,
            'explanation'   => $request->explanation,
        ];

        if($request->team_file_later == 'on') {
            $data['team_file_later'] = '1';
        }

        if($request->review_file_later == 'on') {
            $data['review_file_later'] = '1';
        }

        if($request->portfolio_file_later == 'on') {
            $data['portfolio_file_later'] = '1';
        }

        if($request->blog_file_later == 'on') {
            $data['blog_file_later'] = '1';
        }

        if ($request->dev_image == 1) {
            $data['dev_image'] = '1';
        } else {
            $data['dev_image'] = '0';
        }

        
        $status_id = Status::whereSlug('text_adding')->value('id');
        
        if ($request->File('text_file') != Null) {
            $file = $request->file('text_file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'text_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $data['text_file']  = $file_name;
        }

        if ($request->File('team_doc') != Null) {
            $file = $request->file('team_doc');
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'team_doc']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $data['team_doc']  = $file_name;
        }

        if ($request->File('team_photo') != Null) {
            $file = $request->file('team_photo');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'team_photo']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $data['team_photo']  = $file_name;
        }
        if ($request->File('terms_file') != Null) {
            $file = $request->file('terms_file');
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'terms_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $data['terms_file']  = $file_name;
        }

        if ($request->File('other_file') != Null) {
            
            $files = $request->file('other_file');
            $file_names = [];
            foreach($files as $file) {
                $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'other_file']);
                $destinationPath = 'uploads/';
                $file->move($destinationPath, $file_name);
                array_push($file_names, $file_name);
            }
            $data['other_file'] = json_encode($file_names);
        }

        if ($request->File('review_file') != Null) {
            $file = $request->file('review_file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'review_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $data['review_file']  = $file_name;
        }
        if ($request->File('portfolio_file') != Null) {
            $file = $request->file('portfolio_file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'portfolio_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $data['portfolio_file']  = $file_name;
        }
        if ($request->File('blog_file') != Null) {
            $file = $request->file('blog_file');
            $file_size = fileSizeMB($file->getSize());
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'blog_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $data['blog_file']  = $file_name;
        }
        if ($request->File('images_file') != Null) {
            $file = $request->file('images_file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'images_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $data['images_file']  = $file_name;
        }
        
        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }
        
        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules, $messages);
            $data['status'] = '1';
            $update = $form->update($data);
            add_comment($form->project_id, trans('app.text_adding_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            
            $route = route('text_adding', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function ContentAdding(Request $request, $id) 
    {
        $form = ContentAdding::find($id);
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.content_adding', compact('form'));
    }

    public function updateContentAdding($id, Request $request) 
    {
        $form = ContentAdding::find($id);
        $rules = [
            'usp.0' => 'required',
            'pages.*' => 'required',
            'payment_live_key'  => 'required',
            'payment_test_key'  => 'required',
        ];

        if (!$form->file('products_file')) {
            $rules['products_file'] = 'required';
        }

        if (!$form->file('products_image')) {
            $rules['products_image'] = 'required';
        }

        $messages = [
            'usp.0.required' => trans('app.usp_required'),
            'pages.*.required' => trans('form.page_names_required'),
            'page_descriptions.*.required' => trans('form.page_descriptions_required'),
        ];

        $data = [
            'description'   => $request->description,
            'usps'          => json_encode($request->usp),
            'other_comment' => $request->other_comment,
            'review'        => $request->review,
            'review_link'   => $request->review_link,
            'newsletter'    => $request->newsletter,
            'pages'         => json_encode($request->pages),
            'page_descriptions' => json_encode($request->page_descriptions),
            'payment_live_key'  => $request->payment_live_key,
            'payment_test_key'  => $request->payment_test_key,
            'website_image_source'  => $request->website_image_source,
            'website_image_comment' => $request->website_image_comment
        ];

        if($request->review_file_later == 'on') {
            $data['review_file_later'] = '1';
        } else {
            $data['review_file_later'] = '0';
        }

        if($request->review == 1 && $request->review_link == null && $request->review_file_later == null && !$form->file('review_file') && $request->File('review_file') == null) {
            $rules['review_field'] = 'required';
            $messages['review_field.required'] = trans('form.review_field_required');
        }

        if($request->website_image_source != 1 && !$form->file('website_image') && $request->File('website_image') == Null) {
            $rules['image_source'] = 'required';
            $messages['image_source.required'] = trans('form.image_source_required');
        }

        $status_id = Status::whereSlug('content_adding')->value('id');
        
        if ($request->File('products_file') != Null) {
            $file = $request->file('products_file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'products_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
        }

        if ($request->File('products_image') != Null) {
            $file = $request->file('products_image');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'products_image']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
        }

        if ($request->File('terms_file') != Null) {
            $file = $request->file('terms_file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'terms_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
        }

        if ($request->File('other_file') != Null) {
            
            $files = $request->file('other_file');
            foreach($files as $file) {
                
                $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'other_file']);
                $destinationPath = 'uploads/';
                $file->move($destinationPath, $file_name);
            }
        }

        if ($request->File('review_file') != Null) {
            $file = $request->file('review_file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'review_file']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
        }

        if ($request->File('page_files') != Null) {
            $status_id = Status::whereSlug('first_feedback')->value('id');
            $files = $request->file('page_files');
            for ($i=0; $i < count($request->pages); $i++) { 
                if(isset($files[$i])) {
                    foreach($files[$i] as $file) {
                        $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                        $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                        $destinationPath = 'uploads/';
                        $file->move($destinationPath, $file_name);
                        Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'content_adding', 'page_num' => $i]);
                    }
                } 
            }
        }
        
        if ($request->File('website_image') != Null) {
            $file = $request->file('website_image');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'website_image']);
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
        }
        
        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }
        
        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules, $messages);
            $data['status'] = '1';
            $update = $form->update($data);

            add_comment($form->project_id, trans('app.content_adding_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            
            $route = route('content_adding', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function FirstFeedback(Request $request, $id) 
    {
        $form = FirstFeedback::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        
        return view('forms.first_feedback', compact('form'));
    }

    public function updateFirstFeedback(Request $request, $id)
    {
        $form = FirstFeedback::find($id);
        
        $rules = [
            'page_names.*' => 'required',
            'page_feedbacks.*' => 'required'
        ];

        $messages = [
            'page_names.*.required' => trans('app.page_name_required'),
            'page_feedbacks.*.required' => trans('app.page_feedback_required')
        ];

        $data = [
            'page_names'          => json_encode($request->page_names),
            'page_feedbacks'      => json_encode($request->page_feedbacks),
        ];
 
        if ($request->File('page_files') != Null) {
            $status_id = Status::whereSlug('first_feedback')->value('id');
            $files = $request->file('page_files');
            for ($i=0; $i < count($request->page_names); $i++) { 
                if(isset($files[$i])) {
                    foreach($files[$i] as $file) {
                        $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                        $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                        $destinationPath = 'uploads/';
                        $file->move($destinationPath, $file_name);
                        Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'first_feedback', 'page_num' => $i]);
                    }
                } 
            }
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules, $messages);
            $data['status'] = '1';
            $update = $form->update($data);
            add_comment($form->project_id, trans('app.first_feedback_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            
            $route = route('first_feedback', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function FinalFeedback(Request $request, $id) 
    {
        $form = FinalFeedback::find($id);

        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        if ($form->pages && $form->pages != 'null') {
            $pages = json_decode($form->pages);
            $feedbacks = json_decode($form->feedbacks);
        } else {
            $pages = false;
            $feedbacks = false;
        }

        return view('forms.final_feedback', compact('form', 'pages', 'feedbacks'));
    }

    public function updateFinalFeedback(Request $request, $id)
    {
        $form = FinalFeedback::find($id);

        $rules = [
            'page_names.*' => 'required',
            'page_feedbacks.*' => 'required'
        ];

        $data = [
            'page_names'          => json_encode($request->page_names),
            'page_feedbacks'      => json_encode($request->page_feedbacks),
        ];

        if ($request->File('page_files') != Null) {
            $status_id = Status::whereSlug('final_feedback')->value('id');
            $files = $request->file('page_files');
            for ($i=0; $i < count($request->page_names); $i++) { 
                if(isset($files[$i])) {
                    foreach($files[$i] as $file) {
                        $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                        $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                        $destinationPath = 'uploads/';
                        $file->move($destinationPath, $file_name);
                        Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'final_feedback', 'page_num' => $i]);
                    }
                } 
            }
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules);
            $data['status'] = '1';
            $update = $form->update($data);
            add_comment($form->project_id, trans('app.final_feedback_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            
            $route = route('final_feedback', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }

    }

    public function Hosting(Request $request, $id) 
    {
        $form = Hosting::find($id);

        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.hosting', compact('form'));
    }

    public function updateHosting(Request $request, $id)
    {
        $form = Hosting::find($id);

        $rules = [
            'domain_name'           => 'required',
            'domain_provider'       => 'required',
            'domain_username'       => 'required',
            'domain_password'       => 'required'
        ];
        if($request->hosting == 1) {
            $rules['bank_info'] = 'required';
            $rules['tav'] = 'required';
            $rules['agree_terms'] = 'accepted';
            $rules['agree_cost'] = 'accepted';
        } elseif($request->hosting == 2) {
            if($request->have_site ==1) {
                $rules['wp_url'] = 'required';
                $rules['wp_username'] = 'required';
                $rules['wp_password'] = 'required';
            }
        }

        if ($request->google_analytics == 1) {
            $rules['gmail_account'] = 'required';
        }

        $messages = [
            'wp_url.required'       => 'The URL field is required.',
            'wp_username.required'  => 'The username field is required.',
            'wp_password.required'  => 'The password field is required.',
        ];

        $data = [
            'type' => $request->type,
            'bank_info' => $request->bank_info,
            'tav' => $request->tav,
            'agree_terms' => $request->agree_terms,
            'agree_fee' => $request->agree_cost,
            'have_site' => $request->have_site,
            'aware_cost' => $request->aware_cost,
            'wp_url' => $request->wp_url,
            'wp_username' => $request->wp_username,
            'wp_password' => $request->wp_password,
            'domain_name' => $request->domain_name,
            'domain_provider' => $request->domain_provider,
            'domain_username' => $request->domain_username,
            'domain_password' => $request->domain_password,
            'google_analytics' => $request->google_analytics,
            'gmail_account'  => $request->gmail_account,
        ];

        if($request->hosting == null) {
            $data['hosting'] = '0';
        } else {
            $data['hosting'] = $request->hosting;
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }
        
        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $this->validate($request, $rules, $messages);
            $data['status'] = '1';
            $update = $form->update($data);
            add_comment($form->project_id, trans('app.hosting_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {

            $route = route('hosting', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }

    }

    public function ExtraFunction(Request $request, $id) 
    {
        $form = ExtraFunction::find($id);

        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }

        return view('forms.extra_function', compact('form'));
    }

    public function updateExtraFunction(Request $request, $id)
    {
        $form = ExtraFunction::find($id);
        
        $rules = [
            'description.*' => 'required'
        ];

        $data = [
            'description' => json_encode($request->description),
            'examples' => json_encode($request->examples),
            'login_urls'    => json_encode($request->login_urls),
            'login_emails' => json_encode($request->login_emails),
            'login_passwords' => json_encode($request->login_passwords),
        ];

        if ($request->File('files') != Null) {
            $status_id = Status::whereSlug('extra_function')->value('id');
            
            $files = $request->file('files');
            for ($i=0; $i < count($request->description); $i++) { 
                if (isset($files[$i])) {
                    $file = $files[$i];
                    $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                    $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                    Media::create(['project_id' => $form->project_id, 'status_id' => $status_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'extra_function', 'page_num' => $i]);
                    $destinationPath = 'uploads/';
                    $file->move($destinationPath, $file_name);
                }
            }
        }
        
        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }
        $project = Project::find($form->project_id);
        if($request->quick_save == 0) {
            $data['status'] = '1';
            $this->validate($request, $rules);
            $update = $form->update($data);
            add_comment($form->project_id, trans('app.extra_function_submit'));
            project_action($form->project_id, 'company');
            Mail::to($project->user)->send(new FormSubmitEmail($project));
            return view('forms.thankyou', compact('form'));
        } else {
            
            $route = route('extra_function', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }

    }

    public function ExtraWork(Request $request, $id) 
    {
        $form = ExtraWork::find($id);

        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.extra_work', compact('form'));
    }

    public function updateExtraWork(Request $request, $id)
    {
        $form = ExtraWork::find($id);
        
        $data = [
            'description' => $request->description,
        ];

        if ($request->File('files') != Null) {
            $files = $request->file('files');
            foreach($files as $file) {
                $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                Media::create(['project_id' => $form->project_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'extra_work', 'status_id' => $id]);
                $destinationPath = 'uploads/';
                $file->move($destinationPath, $file_name);
            }
        }
        
        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }
        if($request->quick_save == 0) {
            $data['status'] = '1';

            $update = $form->update($data);
            $files = Media::whereProjectId($form->project_id)->whereStatusId($id)->whereType('image')->whereRef('extra_work')->get();
            $data = $form;
            $pdf = PDF::loadView('pdf.extra_work', compact('data'));
            $file_name = 'Extra_Work_' . date('_Y_m_d_H_i_s') . '.pdf';
            $pdf->save('uploads/' . $file_name);
            
            Media::create(['project_id' => $form->project_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'extra_work']);
            Mail::to($form->project->user)->send(new FormSubmitEmail($form->project));
            return view('forms.thankyou', compact('form'));
        } else {
            
            $route = route('extra_work', ['id' => $id, 'token' => $form->token]);
            Mail::to($form->project->email)->send(new AnswerSavedMail($form->project, $route));
            return view('forms.saved_form', compact('form'));
        }

    }

    public function BusinessEmail(Request $request, $id) 
    {
        $form = BusinessMail::find($id);

        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.business_mail', compact('form'));
    }

    public function updateBusinessEmail(Request $request, $id)
    {
        $form = BusinessMail::find($id);
        
        $rules = [
            'mails.0'           => 'required',
            'first_name'        => 'required',
            'last_name'         => 'required',
            'title'             => 'required',
            'phone'             => 'required',
            'personal_email'    => 'required',
            'address'           => 'required',
            'zip'               => 'required',
            'state'             => 'required',
            'country'           => 'required',
            'kvk'               => 'required',
            'domain_name'       => 'required',
            'domain_provider'   => 'required',
            'domain_username'   => 'required',
            'domain_password'   => 'required',
            'mail_fee'          => 'accepted'
        ];
        
        $messages = [
            'mails.0.required' => trans('app.mails_required'),
            'kvk.required' => trans('app.kvk_required')
        ];

        $data = [
            'mails' => json_encode($request->mails),
            'mail_type' => $request->mail_type,
            'mail_first_name' => $request->first_name,
            'mail_last_name' => $request->last_name,
            'mail_title' => $request->title,
            'mail_phone' => $request->phone,
            'mail_personal_email' => $request->personal_email,
            'mail_address' => $request->address,
            'mail_zip' => $request->zip,
            'mail_state' => $request->state,
            'mail_country' => $request->country,
            'mail_kvk' => $request->kvk,
            'domain_name' => $request->domain_name,
            'domain_provider' => $request->domain_provider,
            'domain_username' => $request->domain_username,
            'domain_password' => $request->domain_password
        ];
        
        if ($request->mail_fee && $request->mail_fee == 1) {
            $data['mail_fee'] = '1';
        } else {
            $data['mail_fee'] = '0';
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }
        
        if($request->quick_save == 0) {
            $data['status'] = '1';
            $this->validate($request, $rules, $messages);
            $update = $form->update($data);

            add_comment($form->project_id, trans('app.business_email_form_submit'));
            $project = Project::find($form->project_id);
            $pdf = PDF::loadView('pdf.business_email', compact('form', 'project'));
            $file_name = 'Zakelijk_email_instellen_'. date('Y-m-d') . '.pdf';
            $pdf->save('uploads/' . $file_name);
            $old_file = Media::whereProjectId($form->project_id)->whereRef('business_email')->first();
            if($old_file) {
                $old_file->delete();
            }
            Media::create(['project_id' => $form->project_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'business_email']);
            Mail::to($form->project->user)->send(new FormSubmitEmail($form->project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('business_email', ['id' => $id, 'token' => $form->token]);
            Mail::to($form->project->email)->send(new AnswerSavedMail($form->project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function MailError(Request $request, $id) 
    {
        $form = MailError::find($id);

        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.mail_error', compact('form'));
    }

    public function updateMailError(Request $request, $id)
    {
        $form = MailError::find($id);
        
        $rules = [
            'email_provider'   => 'required',
            'email_address'   => 'required',
            'password'   => 'required'
        ];

        $data = [
            'email_provider' => $request->email_provider,
            'email_address' => $request->email_address,
            'password' => $request->password
        ];

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }
        if($request->quick_save == 0) {
            $this->validate($request, $rules);
            $data['status'] = '1';
            $update = $form->update($data);

            $project = Project::find($form->project_id);
            $pdf = PDF::loadView('pdf.mail_error', compact('form'));
            $file_name = 'Mail verstuurd niet.pdf';
            $pdf->save('uploads/' . $file_name);
            
            $old_file = Media::whereProjectId($form->project_id)->whereRef('mail_error')->first();
            if($old_file) {
                $old_file->delete();
            }
            Media::create(['project_id' => $form->project_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'mail_error']);
            add_comment($form->project_id, trans('app.mail_error_form_submit', ['url' => asset('uploads/' . $file_name)]));
            Mail::to($form->project->user)->send(new FormSubmitEmail($form->project));
            return view('forms.thankyou', compact('form'));
        } else {
            $route = route('mail_error', ['id' => $id, 'token' => $form->token]);
            Mail::to($form->project->email)->send(new AnswerSavedMail($form->project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function logoFeedback(Request $request, $id) 
    {
        $form = LogoFeedback::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }

        $status_id = Status::whereSlug('logo_version_1')->value('id');
        $files = Media::whereProjectId($form->project_id)->whereType('image')->whereRef('logo_feedback')->whereStatusId($id)->get();
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }
        return view('forms.logo_feedback', compact('form', 'files'));
    }

    public function updateLogoFeedback($id, Request $request) 
    {
        $form = LogoFeedback::find($id);
        $rules = [
            'logo_name' => 'required',
            'logo_feedback' => 'required',
        ];
        
        $data = [
            'filename' => $request->logo_name,
            'feedback'  => $request->logo_feedback,
        ];

        if ($request->hasFile('files') != Null) {

            $files = $request->file('files');
            $file_names = [];
            foreach($files as $file) {
                $file_size = fileSizeMB($file->getSize());
                
                $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                Media::create(['project_id' => $form->project_id, 'media_name'=>$file_name, 'type'=>'image', 'status_id'=> $id, 'ref'=>'logo_feedback']);
                $destinationPath = 'uploads/';
                $file->move($destinationPath, $file_name);
            }
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        $project = Project::find($form->project_id);

        if($request->quick_save == 0) {
            $this->validate($request, $rules);
            $data['status'] = '1';

            $update = $form->update($data);
            
            $data = $form;
            $pdf = PDF::loadView('pdf.logo_feedback', compact('data'));
            $file_name = 'Logo_feedback' . date('_Y_m_d_H_i_s') . '.pdf';
            $pdf->save('uploads/' . $file_name);
            
            Media::create(['project_id' => $form->project_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'logo_feedback']);
            Mail::to($form->project->user)->send(new FormSubmitEmail($form->project));
            return view('forms.thankyou', compact('form'));
        } else {
            
            $route = route('logo_feedback', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }

    }

    public function TextFeedback(Request $request, $id) 
    {
        $form = TextFeedback::find($id);

        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }

        return view('forms.text_feedback', compact('form'));
    }

    public function updateTextFeedback($id, Request $request) 
    {
        $form = TextFeedback::find($id);

        $rules = [
            'page_names.*' => 'required',
            'page_feedbacks.*' => 'required'
        ];

        $data = [
            'page_names'          => json_encode($request->page_names),
            'page_feedbacks'      => json_encode($request->page_feedbacks),
        ];

        if ($request->File('page_files') != Null) {
            
            $files = $request->file('page_files');
            for($i = 0; $i < count($request->page_names); $i++) {
                if(isset($files[$i])) {
                    $file = $files[$i];
                    
                    $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                    $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                    $destinationPath = 'uploads/';
                    $file->move($destinationPath, $file_name);
                    Media::create(['project_id' => $form->project_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'text_feedback', 'page_num' => $i, 'status_id' => $id]);
                } 
            }
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        if($request->quick_save == 0) {
            $this->validate($request, $rules);
            $data['status'] = '1';
            $update = $form->update($data);
            /* add_comment($form->project_id, trans('app.text_first_feedback_submit'));
            project_action($form->project_id, 'company'); */
            $data = $form;
            $pdf = PDF::loadView('pdf.text_feedback', compact('data'));
            $file_name = 'Text_feedback' . date('_Y_m_d_H_i_s') . '.pdf';
            $pdf->save('uploads/' . $file_name);
            
            Media::create(['project_id' => $form->project_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'text_feedback']);
            Mail::to($form->project->user)->send(new FormSubmitEmail($form->project));
            return view('forms.thankyou', compact('form'));
        } else {
            $project = Project::find($form->project_id);
            $route = route('text_version_1', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function WebsiteFeedback(Request $request, $id) 
    {
        $form = WebsiteFeedback::find($id);
        
        $token = $request->token;
        if (!$token || $token != $form->token) {
            return abort(404);
        }
        
        if($form->status == 1 && !auth()->check()) {
            return view('forms.form_submitted', compact('form'));
        }

        return view('forms.website_feedback', compact('form'));
    }

    public function updateWebsiteFeedback(Request $request, $id)
    {
        $form = WebsiteFeedback::find($id);
        $rules = [
            'page_names.*' => 'required',
            'page_feedbacks.*' => 'required'
        ];

        $data = [
            'page_names'          => json_encode($request->page_names),
            'page_feedbacks'      => json_encode($request->page_feedbacks),
        ];

        if ($request->File('page_files') != Null) {
            $files = $request->file('page_files');
            for ($i=0; $i < count($request->page_names); $i++) { 
                if(isset($files[$i])) {
                    foreach($files[$i] as $file) {
                        $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

                        $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
                        $destinationPath = 'uploads/';
                        $file->move($destinationPath, $file_name);
                        Media::create(['project_id' => $form->project_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'website_feedback', 'page_num' => $i, 'status_id' => $id]);
                    }
                } 
            }
        }

        $update = $form->update($data);
        if (!$update) { 
            return back()->withStatus(__('Something went wrong, please check the information again.'));
        }

        if($request->quick_save == 0) {
            $this->validate($request, $rules);
            $data['status'] = '1';
            $data = $form;
            $pdf = PDF::loadView('pdf.feedback_error', compact('data'));
            $file_name = 'Website_feedback' . date('_Y_m_d_H_i_s') . '.pdf';
            $pdf->save('uploads/' . $file_name);
            
            Media::create(['project_id' => $form->project_id, 'media_name'=>$file_name, 'type'=>'image', 'ref'=>'website_feedback']);
            Mail::to($form->project->user)->send(new FormSubmitEmail($form->project));
            return view('forms.thankyou', compact('form'));
        } else {
            $project = $form->project;
            $route = route('website_feedback', ['id' => $id, 'token' => $form->token]);
            Mail::to($project->email)->send(new AnswerSavedMail($project, $route));
            return view('forms.saved_form', compact('form'));
        }
    }

    public function thankyou()
    {
        return view('forms.thankyou');
    }

    public function saveAnswers()
    {
        return view('forms.saved_form');
    }

    public function uploadImage(Request $request, $project_id = Null, $status_id = Null, $field_name = Null){

        $images = $request->file($field_name);
        foreach ($images as $image){
            $valid_extensions = ['jpg','jpeg','png'];
            if ( ! in_array(strtolower($image->getClientOriginalExtension()), $valid_extensions) ){
                return redirect()->back()->withInput($request->input())->with('error', 'Only .jpg, .jpeg and .png is allowed extension') ;
            }
            $file_base_name = str_replace('.'.$image->getClientOriginalExtension(), '', $image->getClientOriginalName());

            $resized = Image::make($image)->resize(640, null, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            $image_name = strtolower(time().str_random(5).'-'.str_slug($file_base_name)).'.' . $image->getClientOriginalExtension();

            $imageFileName = 'uploads/'.$image_name;

            try{
                //Upload original image
                $is_uploaded = Storage::disk('public')->put($imageFileName, $resized->__toString(), 'public');

                if ($is_uploaded) {
                    //Save image name into db
                    $created_img_db = Media::create(['project_id' => $project_id, 'status_id' => $status_id, 'media_name'=>$image_name, 'type'=>'image', 'ref'=>'logo']);

                }
            } catch (\Exception $e){
                return redirect()->back()->withInput($request->input())->with('error', $e->getMessage()) ;
            }
        }
    }

    public function deleteMedia(Request $request)
    {
        $id = $request->id;
        $file = Media::find($id);
        $file->delete();
        return ['success' => 1];
    }
}

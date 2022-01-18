<?php

namespace App\Http\Controllers;

use App\BusinessMail;
use App\Comment;
use App\ErrorMessage;
use App\ExtraWork;
use App\MailError;
use App\LogoFeedback;
use App\TextFeedback;
use App\Media;
use App\Project;
use App\Status;
use App\User;
use App\EmailTemplate;
use App\WebsiteFeedback;

use App\Mail\AfgerondMail;
use App\Mail\BusinessEmail;
use App\Mail\ContentAddingMail;
use App\Mail\ExtraFunctionMail;
use App\Mail\ExtraWorkMail;
use App\Mail\FinalFeedbackMail;
use App\Mail\FirstFeedbackMail;
use App\Mail\FotoFormatMail;
use App\Mail\HostingLoginMail;
use App\Mail\HostingMail;
use App\Mail\LogoCompletedMail;
use App\Mail\LogoDesignMail;
use App\Mail\LogoFirstFeedbackMail;
use App\Mail\LogoFinalFeedbackMail;
use App\Mail\LogoFormatMail;
use App\Mail\NoResponseMail;
use App\Mail\OnboardingMail;
use App\Mail\PhotoSubmitErrorMail;
use App\Mail\ProjectReviewMail;
use App\Mail\TextAddingMail;
use App\Mail\TextFinalFeedbackMail;
use App\Mail\TextFirstFeedbackMail;
use App\Mail\TextWritingMail;
use App\Mail\TextCompletedMail;
use App\Mail\WebDesignMail;
use App\Mail\WebdesignFirstMail;
use App\Mail\WebdesignFinalMail;
use App\Mail\WebdesignDevMail;
use App\Mail\WebshopOnboardingMail;
use App\Mail\FirstHomeMail;
use App\Mail\WebsitePaidMail;
use App\Mail\WordpressLoginMail;
use App\Mail\Welcome;
use App\Mail\SendEmail;
use App\Mail\WebdesignOnboardingMail;

use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function welcome($id)
    {
        $project_id = $id;
        $project = Project::find($project_id);

        if($project->sent_welcome == 1) {
            return redirect()->back()->with('error', trans('app.welcome_email_sent'));
        }
        
        if($project->user_id != null) {
            $user = $project->user;
        } else {
            $user = Auth::user();
        }

        Mail::to($project->email)->send(new Welcome($project, $user));

        $project->sent_welcome = '1';
        $project->save();

        add_comment($project->id, trans('app.success_welcome_mail'));
        if($project->space == 0) {
            return redirect(route('website', $project->id))->with('success', trans('app.success_welcome_mail'));
        } else {
            return redirect(route('custom_website', $project->id))->with('success', trans('app.success_welcome_mail'));
        }
    }

    public function resend(Request $request)
    {
        $status_id = $request->status_id;
        $project_id = $request->project_id;

        $status = Status::whereSlug($status_id)->first();
        $model = $status->model;

        $project = Project::find($project_id);
        $user = $project->user;

        $form = $model::whereProjectId($project_id)->first();
        if($status_id == 'logo_design') {
            Mail::to($project->email)->send(new LogoDesignMail($project, $form, $user));
            $msg = trans('app.logo_design_form_email_resend');
        } elseif($status_id == 'logo_version_1') {
            Mail::to($project->email)->send(new LogoFirstFeedbackMail($project, $form, $user));
            $msg = trans('app.logo_version_form_email_1_resend');
        } elseif($status_id == 'logo_version_2') {
            Mail::to($project->email)->send(new LogoFinalFeedbackMail($project, $form, $user));
            $msg = trans('app.logo_version_form_email_2_resend');
        } elseif($status_id == 'web_design') {
            Mail::to($project->email)->send(new WebDesignMail($project, $user, $form));
            $msg = trans('app.webdesign_email_resend');
        } elseif($status_id == 'webdesign_version_1') {
            Mail::to($project->email)->send(new WebdesignFirstMail($project, $user, $form));
            $msg = trans('app.webdesign_version_1_email_resend');
        } elseif($status_id == 'webdesign_version_2') {
            Mail::to($project->email)->send(new WebdesignFinalMail($project, $user, $form));
            $msg = trans('app.webdesign_version_1_email_resend');
        } elseif($status_id == 'webdesign_dev') {
            Mail::to($project->email)->send(new WebdesignDevMail($project, $user, $form));
            $msg = trans('app.webdesign_dev_email_resend');
        } elseif($status_id == 'first_home') {
            Mail::to($project->email)->send(new FirstHomeMail($project, $user, $form));
            $msg = trans('app.first_home_email_resend');
        } elseif($status_id == 'text_writing') {
            Mail::to($project->email)->send(new TextWritingMail($project, $user, $form));
            $msg = trans('app.text_first_feedback_email_resend');
        } elseif($status_id == 'text_version_1') {
            Mail::to($project->email)->send(new TextFirstFeedbackMail($project, $user, $form));
            $msg = trans('app.text_final_feedback_email_resend');
        } elseif($status_id == 'text_version_2') {
            Mail::to($project->email)->send(new TextFinalFeedbackMail($project, $user, $form));
            $msg = trans('app.text_first_feedback_email_resend');
        } elseif($status_id == 'onboarding') {
            Mail::to($project->email)->send(new OnboardingMail($project, $user, $form));
            $msg = trans('app.onboarding_email_resend');
        } elseif($status_id == 'text_adding') {
            Mail::to($project->email)->send(new TextAddingMail($project, $user, $form));
            $msg = trans('app.textadding_email_resend');
        } elseif($status_id == 'first_feedback') {
            Mail::to($project->email)->send(new FirstFeedbackMail($project, $user, $form));
            $msg = trans('app.first_feedback_email_resend');
        } elseif($status_id == 'extra_function') {
            Mail::to($project->email)->send(new ExtraFunctionMail($project, $user, $form));
            $msg = trans('app.extra_function_email_resend');
        } elseif($status_id == 'final_feedback') {
            Mail::to($project->email)->send(new FinalFeedbackMail($project, $user, $form));
            $msg = trans('app.final_feedback_email_resend');
        } elseif($status_id == 'hosting') {
            Mail::to($project->email)->send(new HostingMail($project, $user, $form));
            $msg = trans('app.hosting_mail_resend');
        } elseif($status_id == 'webshop_onboarding') {
            Mail::to($project->email)->send(new WebshopOnboardingMail($project, $user, $form));
            $msg = trans('app.webshop_onboarding_mail_resend');
        } elseif($status_id == 'content_adding') {
            Mail::to($project->email)->send(new ContentAddingMail($project, $user, $form));
            $msg = trans('app.content_adding_mail_resend');
        } elseif($status_id == 'webdesign_onboarding') {
            Mail::to($project->email)->send(new WebdesignOnboardingMail($project, $user, $form));
            $msg = trans('app.webdesign_email_resend');
        } 

        $project->status_id = $status_id;
        $project->action = '1';
        $project->save();

        add_comment($project_id, $msg);

        return ['success'=>1, 'msg' => $msg];
    }

    public function buildEmail(Request $request)
    {
        // $project_id = $request->project_id;
        $project = Project::find($request->project_id);
        $user = $project->user;
        $value = $request->value;
        if ($request->type == 'status') {
            $status = Status::whereSlug($value)->first();
            $template = EmailTemplate::whereStatusId($status->id)->whereType('0')->first();
            if(!($value == 'logo_completed' || $value == 'webdesign_completed' || $value == 'text_completed' || $value == 'afgerond' || $value == 'review')) {
                $form = $status->model::whereProjectId($project->id)->first();
                $form_url = route($value, ['id' => $form->id, 'token' => $form->token]);
            }
            
            $file = Media::whereStatusId($status->id)->whereType('file')->orderBy('id', 'desc')->first();
        } else {
            $template = EmailTemplate::whereErrorMessageId($value)->whereType('1')->first();
            if ($value == 6) {
                $form = ExtraWork::whereProjectId($project->id)->first();
                $form_url = route('extra_work', ['id' => $form->id, 'token' => $form->token]);
            } elseif ($value == 8) {
                $form = BusinessMail::whereProjectId($project->id)->first();
                $form_url = route('business_email', ['id' => $form->id, 'token' => $form->token]);
            } elseif ($value == 9) {
                $form = MailError::whereProjectId($project->id)->first();
                $form_url = route('mail_error', ['id' => $form->id, 'token' => $form->token]);
            } elseif ($value == 10) {
                $form = LogoFeedback::whereProjectId($project->id)->first();
                $form_url = route('logo_feedback', ['id' => $form->id, 'token' => $form->token]);
            } elseif ($value == 11) {
                $form = TextFeedback::whereProjectId($project->id)->first();
                $form_url = route('text_feedback', ['id' => $form->id, 'token' => $form->token]);
            } elseif ($value == 12) {
                $form = WebsiteFeedback::whereProjectId($project->id)->first();
                $form_url = route('website_feedback', ['id' => $form->id, 'token' => $form->token]);
            }
        }

        $email_body = $template->content;
        $search = [
            ':ClientName', 
            ':UserName', 
            ':UserRole', 
            ':UserPhone', 
            ':UserImg', 
            ':UserUrl'
        ];
        $replace = [
            $project->name, 
            $user->name, 
            $user->occupation, 
            $user->phone, 
            asset('uploads/users/' . $user->image_name), 
            $user->website_url
        ];
        
        $email_body = \str_replace($search, $replace, $email_body);
        
        if (isset($form_url)) {
            
            $email_body = \str_replace(':FormURL', $form_url, $email_body);
        }
        
        if($project->testing_url) {
            $email_body = \str_replace(':TestingUrl', $project->testing_url, $email_body);
        }
        
        if($project->website_url) {
            $email_body = \str_replace(':WebsiteUrl', $project->website_url, $email_body);
        }

        $template['content'] = $email_body;

        if (isset($file) && $file != null) {
            $template['file'] = $file->media_name;
        }

        return Response::json($template);
    }

    public function sendEmail(Request $request)
    {
        $project = Project::find($request->project_id);
        
        $message = [
            'subject' => $request->title,
            'body' => $request->email_body,
            'file' => ''
        ];

        if($request->file) {
            $file = Media::whereProjectId($project->id)->whereMediaName($request->file)->orderBy('id', 'desc')->first();
            if ($file) {
                $file->no_delete = '1';
                $file->save();
            }
            $message['file'] = $request->file;
        }

        $user = $project->user;

        Mail::to($project->email)->send(new SendEmail($project, $user, $message));

        if ($request->type == 'status') {
            $status = Status::whereSlug($request->value)->first();
            $project->status_id = $status->id;
            $project->action = '1';
            $slug = $request->value;
            if ($slug == 'logo_completed' || $slug == 'text_completed' || $slug == 'webdesign_completed' || $slug == 'afgerond' || $slug == 'review') {
                $project->action = '0';
            }
            $project->save();

            if(!($request->value == 'afgerond' || $request->value == 'review')) {
                $form = $status->model::whereProjectId($project->id)->first();
                $form->sent_email = '1';
                $form->save();
            }

            return redirect()->back()->with('success', trans('app.status_success_msg', ['status' => $status->name]));
        } else {
            $error = ErrorMessage::find($request->value);
            $error_name = $error->message;
            $project->error_id = $request->value;
            $project->save();
            return redirect()->back()->with('success', trans('app.error_message_email', ['message' => $error_name]));
        }
    }

}

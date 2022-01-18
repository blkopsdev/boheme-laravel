<?php

namespace App\Http\Controllers;

use App\BusinessMail;
use App\Comment;
use App\ContentAdding;
use App\Deadline;
use App\ErrorMessage;
use App\ExtraWork;
use App\ExtraFunction;
use App\FirstFeedback;
use App\FirstHome;
use App\FinalFeedback;
use App\Hosting;
use App\LogoCompleted;
use App\LogoDesignForm;
use App\LogoFeedback;
use App\LogoFirstFeedback;
use App\LogoFinalFeedback;
use App\Notification;
use App\MailError;
use App\Media;
use App\Onboarding;
use App\Project;
use App\Reseller;
use App\Status;
use App\TextWriting;
use App\TextFeedback;
use App\TextFirstFeedback;
use App\TextFinalFeedback;
use App\TextCompleted;
use App\TodoList;
use App\User;
use App\WebDesign;
use App\WebdesignFirstVersion;
use App\WebdesignFinalVersion;
use App\WebdesignCompleted;
use App\WebdesignDev;
use App\WebdesignOnboarding;
use App\WebsiteFeedback;
use App\WebshopOnboarding;
use App\WebsiteTextAdding;

use PDF;

use App\Mail\AfgerondMail;
use App\Mail\BusinessEmail;
use App\Mail\ExtraFunctionMail;
use App\Mail\ExtraWorkMail;
use App\Mail\FinalFeedbackMail;
use App\Mail\FirstHomeMail;
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
use App\Mail\MailErrorEmail;
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
use App\Mail\WebdesignCompletedMail;
use App\Mail\WebdesignDevMail;
use App\Mail\WebsitePaidMail;
use App\Mail\WordpressLoginMail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('app.websites');
        $projects = Project::whereSpace(1)->orderBy('created_at', 'desc')->get();
        
        $users = User::orderBy('name', 'asc')->get();
        return view('dashboard.projects.index', compact('title', 'projects', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('app.add_project');
        $resellers = Reseller::get();
        return view('dashboard.projects.create', compact('title', 'resellers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'project_name'  => 'required',
            'name'          => 'required',
            'company_name'  => 'required',
            'email'         => 'required',
            'phone'         => 'required',
        ];

        $this->validate($request, $rules);
        $status = $request->status;

        array_push($status, 'afgerond', 'review');
        $available_status = json_encode($status);

        $slug = unique_slug($request->name);
        $data = [
            'project_name' => $request->project_name,
            'name' => $request->name,
            'slug' => $slug,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'available_status' => $available_status,
            'space' => 1,
            'note' => $request->note,
            'reseller_id' => $request->reseller,
            'company_id' => auth()->user()->company_id
        ];

        $project = Project::create($data);

        if(!$project) {
            return redirect(route('dashboard'))->with('error', trans('app.project_error_msg'));
        }

        add_comment($project->id, trans('app.project_created_msg'));

        return redirect(route('dashboard'))->with('success', trans('app.project_created_msg'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        
        $files = Media::whereProjectId($id)->whereType('image')->get();
        $statuses = Status::all();
        $error_messages = ErrorMessage::all();
        $users = User::all();
        $available_status = json_decode($project->available_status);
        $comments = Comment::whereProjectId($id)->whereType('1')->orderBy('id')->get();
        $media = Media::whereProjectId($id)->whereType('file')->whereRef('manual_logo')->get();
        return view('dashboard.projects.show', compact('project', 'statuses', 'users', 'error_messages', 'available_status', 'comments', 'media', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = trans('app.edit_project');
        $project = Project::find($id);
        $resellers = Reseller::get();

        return view('dashboard.projects.edit', compact('title', 'project', 'resellers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'project_name'  => 'required',
            'name'          => 'required',
            'company_name'  => 'required',
            'email'         => 'required',
            'phone'         => 'required',
        ];

        $this->validate($request, $rules);

        $status = $request->status;

        array_push($status, 'afgerond', 'review');
        $available_status = json_encode($status);

        $slug = unique_slug($request->name);

        $data = [
            'project_name' => $request->project_name,
            'name' => $request->name,
            'slug' => $slug,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'note' => $request->note,
            'reseller_id' => $request->reseller,
            'available_status' => $available_status
        ];

        $project = Project::find($id);
        $update = $project->update($data);

        if(!$update) {
            return redirect()->back()->with('error', trans('app.project_error_msg'));
        }

        add_comment($project->id, trans('app.project_update_msg'));

        return redirect(route('website', $project->id))->with('success', trans('app.project_update_msg'));
    }

    public function updateFields(Request $request, $id)
    {
        $project = Project::find($id);
        $type = $request->type;
        $value = $request->value;
        $user  = Auth::user();
        
        if ($type == 'status') {
            $available_status = json_decode($project->available_status);
            $manager = $project->user;
            if (!$manager) {
                return ['success'=>0, 'msg' => trans('app.select_manager')];
            }
            
            if($value == 'logo_design') {
                $form = LogoDesignForm::whereProjectId($id)->first();
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                $form = LogoDesignForm::create($data);
                
                if (!$form) {
                    return ['success'=>0, 'msg' => trans('app.form_create_err')];
                }
            } elseif ($value == 'logo_version_1') {
                /* $logo_design = $project->logoDesign;
                if(!$logo_design) {
                    return ['success'=>0, 'msg' => trans('app.complete_previous_timeline')];
                } else{
                    if ($logo_design->status == 0) {
                        return ['success'=>0, 'msg' => trans('app.complete_previous_timeline')];
                    }
                } */
                
                $status_id = Status::whereSlug('logo_version_1')->value('id');
                $media = Media::whereProjectId($id)->whereType('file')->whereStatusId($status_id)->whereRef('manual_logo')->get();
                
                if ($media->count() == 0) {
                    return ['success'=>0, 'msg' => trans('app.add_logo_error')];
                }
                $form = $project->logoFeedbackFirst;
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                $form = LogoFirstFeedback::create($data);
                if (!$form) {
                    return ['success'=>0, 'msg' => trans('app.form_create_err')];
                }
            } elseif ($value == 'logo_version_2') {
                $status_id = Status::whereSlug('logo_version_2')->value('id');
                $media = Media::whereProjectId($id)->whereType('file')->whereStatusId($status_id)->whereRef('manual_logo')->get();

                if ($media->count() == 0) {
                    return ['success'=>0, 'msg' => trans('app.add_logo_error')];
                }

                $form = $project->logoFeedbackFinal;
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];

                $form = LogoFinalFeedback::create($data);
                /* if ($form) {
                    Mail::to($project->email)->send(new LogoFinalFeedbackMail($project, $form, $manager));
                    add_comment($project->id, trans('app.logo_version_form_email_2'));
                } else {
                    return ['success'=>0, 'msg' => trans('app.form_create_err')];
                } */
                if(!$form) {
                    return ['success'=>0, 'msg' => trans('app.form_create_err')];
                }
                
            } elseif ($value == 'logo_completed') {
                $status_id = Status::whereSlug('logo_completed')->value('id');
                $media = Media::whereProjectId($id)->whereType('file')->whereStatusId($status_id)->whereRef('manual_logo')->get();
        
                if ($media->count() == 0) {
                    return ['success'=>0, 'msg' => trans('app.add_logo_error')];
                }

                $form = $project->logoCompleted;
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                /* Mail::to($project->email)->send(new LogoCompletedMail($project, $manager));
                add_comment($project->id, trans('app.logo_completed_email'));
                 */
                $data = [
                    'project_id' => $project->id,
                    'status'     => '1'
                ];

                $form = LogoCompleted::create($data);
            } elseif ($value == 'text_writing') {
                
                $form = $project->textWriting;
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = TextWriting::create($data);
                /* Mail::to($project->email)->send(new TextWritingMail($project, $manager, $form));
                add_comment($project->id, trans('app.text_writing_email')); */
            } elseif ($value == 'text_version_1') {
                /* $prev_timeline = $project->textWriting;
                if(!$prev_timeline) {
                    return ['success'=>0, 'msg' => trans('app.complete_previous_timeline')];
                } else{
                    if ($prev_timeline->status == 0) {
                        return ['success'=>0, 'msg' => trans('app.complete_previous_timeline')];
                    }
                } */

                $form = $project->textFeedbackFirst;
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                $status_id = Status::whereSlug('text_version_1')->value('id');
                $media = Media::whereProjectId($id)->whereType('file')->whereStatusId($status_id)->whereRef('manual_logo')->get();

                if ($media->count() == 0) {
                    return ['success'=>0, 'msg' => trans('app.add_logo_error')];
                }
                
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = TextFirstFeedback::create($data);
                /* Mail::to($project->email)->send(new TextFirstFeedbackMail($project, $manager, $form));
                add_comment($project->id, trans('app.text_first_feedback_email')); */
            } elseif ($value == 'text_version_2') {
                /* $prev_timeline = $project->textWriting;
                if(!$prev_timeline) {
                    return ['success'=>0, 'msg' => trans('app.complete_previous_timeline')];
                } else{
                    if ($prev_timeline->status == 0) {
                        return ['success'=>0, 'msg' => trans('app.complete_previous_timeline')];
                    }
                } */
                $status_id = Status::whereSlug('text_version_2')->value('id');
                $media = Media::whereProjectId($id)->whereType('file')->whereStatusId($status_id)->whereRef('manual_logo')->get();

                if ($media->count() == 0) {
                    return ['success'=>0, 'msg' => trans('app.add_logo_error')];
                }

                $form = $project->textFeedbackFinal;
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = TextFinalFeedback::create($data);
                /* Mail::to($project->email)->send(new TextFinalFeedbackMail($project, $manager, $form));
                add_comment($project->id, trans('app.text_final_feedback_email')); */
            } elseif ($value == 'text_completed') {
                $status_id = Status::whereSlug('text_completed')->value('id');
                $media = Media::whereProjectId($id)->whereType('file')->whereStatusId($status_id)->whereRef('manual_logo')->get();
        
                if ($media->count() == 0) {
                    return ['success'=>0, 'msg' => trans('app.add_logo_error')];
                }

                $form = $project->textCompleted;
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                /* Mail::to($project->email)->send(new TextCompletedMail($project, $manager));
                add_comment($project->id, trans('app.text_completed_email')); */
                
                $data = [
                    'project_id' => $project->id,
                    'status'     => '1'
                ];

                $form = TextCompleted::create($data);
            } elseif ($value == 'onboarding') {
                
                $form = $project->websiteOnboarding;
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                $data = [
                    'project_id' => $id,
                    'token' => str_random(36)
                ];
                
                $form = Onboarding::create($data);
                /* Mail::to($project->email)->send(new OnboardingMail($project, $manager, $form));
                add_comment($project->id, trans('app.onboarding_email')); */
            } elseif ($value == 'text_adding') {

                if(!$project->testing_url) {
                    return ['success'=>0, 'msg' => trans('app.testing_url_err')];
                }

                $form = WebsiteTextAdding::whereProjectId($id)->first();
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }

                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = WebsiteTextAdding::create($data);
                /* Mail::to($project->email)->send(new TextAddingMail($project, $manager, $form));
                add_comment($project->id, trans('app.textadding_email')); */
            } elseif ($value == 'first_feedback') {
                
                if(!$project->testing_url) {
                    return ['success'=>0, 'msg' => trans('app.testing_url_err')];
                }

                $form = $project->FirstFeedback;
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = FirstFeedback::create($data);
                /* Mail::to($project->email)->send(new FirstFeedbackMail($project, $manager, $form));
                add_comment($project->id, trans('app.first_feedback_email')); */
            } elseif ($value == 'extra_function') {
                
                $form = $project->extraFunction;
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = ExtraFunction::create($data);
                /* Mail::to($project->email)->send(new ExtraFunctionMail($project, $manager, $form));
                add_comment($project->id, trans('app.extra_function_email')); */
            } elseif ($value == 'final_feedback') {
                
                if(!$project->testing_url) {
                    return ['success'=>0, 'msg' => trans('app.testing_url_err')];
                }

                $form = $project->finalFeedback;
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = FinalFeedback::create($data);
                /* Mail::to($project->email)->send(new FinalFeedbackMail($project, $manager, $form));
                add_comment($project->id, trans('app.final_feedback_email')); */
            } elseif ($value == 'hosting') {
                
                $form = $project->hosting;
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = Hosting::create($data);
                /* Mail::to($project->email)->send(new HostingMail($project, $manager, $form));
                add_comment($project->id, trans('app.hosting_mail')); */
            } elseif ($value == 'afgerond') {
                if (!$project->website_url) {
                    return ['success'=>0, 'msg' => trans('app.website_url_err')];
                }
                
                /* Mail::to($project->email)->send(new AfgerondMail($project, $manager));
                add_comment($project->id, trans('app.afgerond_mail')); */
            } elseif ($value == 'review') {
                if (!$project->website_url) {
                    return ['success'=>0, 'msg' => trans('app.website_url_err')];
                }
                
                /* Mail::to($project->email)->send(new ProjectReviewMail($project, $manager));
                add_comment($project->id, trans('app.project_review_mail')); */
            } elseif ($value == 'webdesign_dev') {
                $status_id = Status::whereSlug('webdesign_completed')->value('id');
                $media = Media::whereProjectId($id)->whereType('file')->whereStatusId($status_id)->whereRef('manual_logo')->get();
        
                if ($media->count() == 0) {
                    return ['success'=>0, 'msg' => trans('app.add_logo_error')];
                }
                $form = WebdesignDev::whereProjectId($id)->first();
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }

                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = WebdesignDev::create($data);
                /* Mail::to($project->email)->send(new WebdesignDevMail($project, $manager, $form));
                add_comment($project->id, trans('app.webdesign_dev_email')); */
            } elseif ($value == 'first_home') {

                if(!$project->testing_url) {
                    return ['success'=>0, 'msg' => trans('app.testing_url_err')];
                }

                $form = FirstHome::whereProjectId($id)->first();
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }

                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = FirstHome::create($data);
                /* Mail::to($project->email)->send(new FirstHomeMail($project, $manager, $form));
                add_comment($project->id, trans('app.first_home_email')); */
            } elseif ($value == 'web_design') {
                
                $form = WebDesign::whereProjectId($id)->first();
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = WebDesign::create($data);
                /* Mail::to($project->email)->send(new WebDesignMail($project, $manager, $form));
                add_comment($project->id, trans('app.webdesign_email')); */
            } elseif ($value == 'webdesign_onboarding') {
                
                $form = WebdesignOnboarding::whereProjectId($id)->first();
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = WebdesignOnboarding::create($data);
                /* Mail::to($project->email)->send(new WebDesignMail($project, $manager, $form));
                add_comment($project->id, trans('app.webdesign_email')); */
            } elseif ($value == 'webdesign_version_1') {
                /* $webdesign = WebDesign::whereProjectId($id)->first();
                if(!$webdesign) {
                    return ['success'=>0, 'msg' => trans('app.complete_previous_timeline')];
                } else {
                    if($webdesign->status != 1) {
                        return ['success'=>0, 'msg' => trans('app.complete_previous_timeline')];
                    }
                } */

                $status_id = Status::whereSlug('webdesign_version_1')->value('id');
                $media = Media::whereProjectId($id)->whereType('file')->whereStatusId($status_id)->whereRef('manual_logo')->get();

                if ($media->count() == 0) {
                    return ['success'=>0, 'msg' => trans('app.add_logo_error')];
                }

                $form = WebdesignFirstVersion::whereProjectId($id)->first();
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = WebdesignFirstVersion::create($data);
                /* Mail::to($project->email)->send(new WebdesignFirstMail($project, $manager, $form));
                add_comment($project->id, trans('app.webdesign_version_1_email')); */
            } elseif ($value == 'webdesign_version_2') {
                /* $webdesign = WebDesign::whereProjectId($id)->first();
                if(!$webdesign) {
                    return ['success'=>0, 'msg' => trans('app.complete_previous_timeline')];
                } else {
                    if($webdesign->status != 1) {
                        return ['success'=>0, 'msg' => trans('app.complete_previous_timeline')];
                    }
                } */

                $status_id = Status::whereSlug('webdesign_version_2')->value('id');
                $media = Media::whereProjectId($id)->whereType('file')->whereStatusId($status_id)->whereRef('manual_logo')->get();

                if ($media->count() == 0) {
                    return ['success'=>0, 'msg' => trans('app.add_logo_error')];
                }

                $form = WebdesignFinalVersion::whereProjectId($id)->first();
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = WebdesignFinalVersion::create($data);
                /* Mail::to($project->email)->send(new WebdesignFinalMail($project, $manager, $form));
                add_comment($project->id, trans('app.webdesign_version_2_email')); */
            } elseif ($value == 'webdesign_completed') {
                $status_id = Status::whereSlug('webdesign_completed')->value('id');
                $media = Media::whereProjectId($id)->whereType('file')->whereStatusId($status_id)->whereRef('manual_logo')->get();

                if ($media->count() == 0) {
                    return ['success'=>0, 'msg' => trans('app.add_logo_error')];
                }

                $form = WebdesignCompleted::whereProjectId($id)->first();
                if ($form) {
                    if ($form->sent_email == 1) {
                        return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                    } else {
                        $form->delete();
                    }
                }
                
                $data = [
                    'project_id' => $project->id,
                    'status'     => '1'
                ];

                $form = WebdesignCompleted::create($data);
            }  elseif ($value == 'webshop_onboarding') {
                if ($project->webshop_onboarding) {
                    return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                }
                
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = WebshopOnboarding::create($data);
            } elseif ($value == 'content_adding') {
                if ($project->contentAdding) {
                    return ['success'=>0, 'msg' => trans('app.existing_status_err')];
                }

                if(!$project->testing_url) {
                    return ['success'=>0, 'msg' => trans('app.testing_url_err')];
                }
                
                $data = [
                    'project_id' => $project->id,
                    'token' => str_random(36)
                ];
                
                $form = ContentAdding::create($data);
            } 

            return ['success' => 1];
        } elseif ($type == 'error_message') {
            $manager = $project->user;
            if ($manager == null) {
                return ['success'=>0, 'msg' => trans('app.select_manager')];
            }
            
            if ($value != Null) {
                if ($value == 6) {
                    $forms = ExtraWork::whereProjectId($id)->get();
                    if ($forms->count() > 0) {
                        $form_no = $forms->count() + 1;
                    } else {
                        $form_no = 1;
                    }
                    $data = [
                        'project_id'    => $project->id,
                        'form_no'       => $form_no,
                        'token' => str_random(36)
                    ];
                    $form = ExtraWork::create($data);
                    
                } elseif ($value == 8) {
                    $form = $project->businessMail;
                    
                    $data = [
                        'project_id' => $project->id,
                        'token' => str_random(36)
                    ];

                    if ($form) {
                        $data['status'] = '0';
                        $form->update($data);
                    } else {
                        $form = BusinessMail::create($data);
                    }
                    
                } elseif ($value == 9) {
                    $data = [
                        'project_id'    => $project->id,
                        'token' => str_random(36)
                    ];
                    
                    $form = $project->mailError;
                    if (!$form) {
                        $form = MailError::create($data);
                    } else {
                        $data['status'] = '0';
                        $form->update($data);
                    }
                    
                } elseif ($value == 10) {
                    $data = [
                        'project_id' => $project->id,
                        'token' => str_random(36)
                    ];
                    
                    $form = LogoFeedback::whereProjectId($project->id)->first();
                    if ($form) {
                        $data['status'] = '0';
                        $form->update($data);
                    } else {
                        $form = LogoFeedback::create($data);
                    }
                } elseif ($value == 11) {
                    $data = [
                        'project_id' => $project->id,
                        'token' => str_random(36)
                    ];
                    
                    $form = TextFeedback::whereProjectId($project->id)->first();
                    if ($form) {
                        $data['status'] = '0';
                        $form->update($data);
                    } else {
                        $form = TextFeedback::create($data);
                    }
                } elseif ($value == 12) {
                    $data = [
                        'project_id' => $project->id,
                        'token' => str_random(36)
                    ];
                    
                    $form = WebsiteFeedback::whereProjectId($project->id)->first();
                    if ($form) {
                        $data['status'] = '0';
                        $form->update($data);
                    } else {
                        $form = WebsiteFeedback::create($data);
                    }
                }
                $error = ErrorMessage::find($value);
                $error_name = $error->message;
                // add_comment($project->id, trans('app.error_message_email', ['message' => $error_name]));
                return ['success'=>1];
            } else {
                add_comment($project->id, trans('app.message_disable_msg'));
                return ['success'=>1, 'msg' => trans('app.message_disable_msg')];
            }
            
        } elseif ($type == 'project_manager') {
            $project->user_id = $value;
            $project->save();
            $user = User::find($value);
            $user_name = $user->name;
            add_comment($project->id, trans('app.project_manager_success_msg', ['name' => $user_name]));
            return ['success'=>1, 'msg' => trans('app.project_manager_success_msg', ['name' => $user_name])];
        } elseif ($type == 'is_completed') {
            $project->is_completed = $value;
            $project->save();
            
            $manager = $project->user;
            if (!$manager) {
                return ['success'=>0, 'msg' => trans('app.select_manager')];
            }
            
            if($value == 1) {
                Mail::to($project->email)->send(new WebsitePaidMail($project, $manager));
            }
            add_comment($project->id, trans('app.website_completed_msg'));
            return ['success'=>1, 'msg' => trans('app.website_completed_msg')];
        }
        
        return ['success'=>0, 'msg' => trans('app.error_msg')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        $todos = TodoList::whereProjectId($id)->get();
        if($todos->count() > 0) {
            foreach($todos as $todo) {
                if($todo) {
                    $todo->delete();
                }
            }
        }
        $notifications = Notification::whereProjectId($id)->get();
        if($notifications->count() > 0) {
            foreach($notifications as $notification) {
                $notification->delete();
            }
        }
        $deadlines = Deadline::whereProjectId($id)->get();
        if($deadlines->count() > 0) {
            foreach($deadlines as $deadline) {
                $deadline->delete();
            }
        }
        return ['success'=>1, 'msg' => trans('app.project_delete_msg')];
    }

    public function updateURL(Request $request)
    {
        $id = $request->id;

        $project = Project::find($id);
        if ($request->type == 'testing') {
            $project->testing_url = $request->value;
            $title = trans('app.testing_url');
        }
        if ($request->type == 'website') {
            $project->website_url = $request->value;
            $title = trans('app.website_url');
        }
        $project->save();

        $html = '<tr class="project-' . $request->type . '-url"><td><strong>' . $title . '</strong></td><td><a href="' . $request->value . '" target="_blank">' . $request->value . '</a></td><td><form method="POST" class="mb-0 delete-url"><input type="hidden" name="type" value="' . $request->type . '"><button type="submit" class="btn btn-link btn-sm text-danger"><span class="material-icons">delete</span></button></form></td></tr>';
        return ['success'=>1, 'html' => $html, 'type' => $request->type];
    }

    public function deleteURL(Request $request, $id)
    {
        $project = Project::find($id);
        if ($request->type == 'testing') {
            $project->testing_url = null;
        }
        if ($request->type == 'website') {
            $project->website_url = null;
        }
        $project->save();
        return ['success'=>1, 'type' => $request->type];
    }

    public function fileUpload(Request $request, $id)
    {
        $project = Project::find($id);
        $file = $request->file('file');
   
        if($request->type == 0) {
            $file_name = ucwords($request->status) . '_' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $status = Status::whereSlug($request->status)->first();
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $data = [
                'project_id' => $id, 
                'status_id' => $status->id,
                'media_name'=>$file_name, 
                'type'=>'file',
                'ref'=>'manual_logo'
            ];
            $media = Media::create($data);
            $media->status_name = $status->name;
        } else {
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $file_name);
            $data = [
                'project_id' => $id, 
                'media_name'=>$file_name, 
                'type'=>'image',
                'ref'=>'manual_file'
            ];
            $media = Media::create($data);
        }

        return ['success'=>1, 'media' => $media];
    }

    public function manualFile(Request $request, $id)
    {
        $project = Project::find($id);

        $file_name = 'File_'. date('Y_m_d_H_i_s') . '.' . $file->getClientOriginalExtension();
        
        $destinationPath = 'uploads/';
        $file->move($destinationPath, $file_name);
        $status = $project->status_id;
        $data = [
            'project_id' => $id, 
            'status_id' => $status,
            'media_name'=>$file_name, 
            'type'=>'file',
            'ref'=>'manual_logo'
        ];
        $media = Media::create($data);

        return redirect()->back()->with('success', trans('app.file_upload_success_msg'));
    }

    public function deleteFile(Request $request)
    {
        $media = Media::find($request->id);
        $filename = $media->media_name;
        $media->delete();
        Storage::disk('public')->delete('uploads/' .$filename);

        return ['success' => '1'];
    }

    public function upfrontPayment(Request $request)
    {
        $project = Project::find($request->id);
        $project->update(['upfront_payment' => '1']);

        return redirect()->back()->with('success', trans('app.confirm_upfront_payment'));
    }

    public function resetStatus(Request $request)
    {
        if($request->type == 'status') {
            $status = Status::whereSlug($request->value)->first();
            if($status->model) {
                $form = $status->model::whereProjectId($request->project_id)->first();
                $form->delete();
            }
        } else {
            if ($request->value == 6) {
                $form = ExtraWork::whereProjectId($request->project_id)->orderBy('id', 'desc')->first();
                $form->delete();
            } elseif($request->value == 8) {
                $form = BusinessMail::whereProjectId($request->project_id)->orderBy('id', 'desc')->first();
                $form->delete();
            } elseif($request->value == 9) {
                $form = MailError::whereProjectId($request->project_id)->orderBy('id', 'desc')->first();
                $form->delete();
            }
        }
        return ['success' => 1];
    }

    public function updateProjectAction(Request $request)
    {
        $project = Project::find($request->project_id);
        $project->action = $request->value;
        $project->update();
        return ['success' => 1, 'project' => $project];
    }
}

<?php

namespace App\Http\Controllers;

use App\BusinessMail;
use App\Comment;
use App\Deadline;
use App\ErrorMessage;
use App\ExtraWork;
use App\ExtraFunction;
use App\FirstHome;
use App\FirstFeedback;
use App\FinalFeedback;
use App\Hosting;
use App\LogoCompleted;
use App\LogoDesignForm;
use App\LogoFirstFeedback;
use App\LogoFinalFeedback;
use App\Media;
use App\Onboarding;
use App\Project;
use App\Status;
use App\TextWriting;
use App\TextFirstFeedback;
use App\TextFinalFeedback;
use App\TextCompleted;
use App\User;
use App\WebDesign;
use App\WebdesignFirstVersion;
use App\WebdesignFinalVersion;
use App\WebdesignCompleted;
use App\WebdesignDev;
use App\WebdesignOnboarding;
use App\WebshopOnboarding;
use App\WebsiteTextAdding;

use PDF;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function logoDesignPDF($id) 
    {
        $project = Project::find($id);
        $data = LogoDesignForm::whereProjectId($id)->first();

        $status_id = Status::whereSlug('logo_design')->value('id');
        $logo_files = Media::whereProjectId($id)->whereType('image')->whereStatusId($status_id)->whereRef('logo_reference')->get();
        
        $pdf = PDF::loadView('pdf.logo_design', compact('data', 'project', 'logo_files'));
        $now = date('ymdhmi');
        $file_name = 'Logo-Design-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function logoFirstFeedbackPDF($id) 
    {
        $project = Project::find($id);
        $data = LogoFirstFeedback::whereProjectId($id)->first();
        $status = 0;
        $pdf = PDF::loadView('pdf.logo_feedback', compact('data', 'status'));
        $now = date('ymdhmi');
        $file_name = 'Logo-First-Feedback-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function logoFinalFeedbackPDF($id) 
    {
        $project = Project::find($id);
        $data = LogoFinalFeedback::whereProjectId($id)->first();
        $status = 1;
        $pdf = PDF::loadView('pdf.logo_feedback', compact('data', 'status'));
        $now = date('ymdhmi');
        $file_name = 'Logo-Final-Feedback-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function webdesignPDF($id)
    {
        $data = WebDesign::find($id);
        $pdf = PDF::loadView('pdf.webdesign', compact('data'));
        $now = date('ymdhmi');
        $file_name = 'Webdesign-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function webdesignOnboardingPDF($id)
    {
        $data = WebdesignOnboarding::find($id);
        $pdf = PDF::loadView('pdf.webdesign_onboarding', compact('data'));
        $now = date('ymdhmi');
        $file_name = 'Webdesign-onboarding-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function webdesignFirstFeedbackPDF($id)
    {
        $project = Project::find($id);
        $data = WebdesignFirstVersion::whereProjectId($id)->first();
        $status = 'webdesign_version_1';
        $pdf = PDF::loadView('pdf.webdesign_feedback', compact('data', 'status'));
        $now = date('ymdhmi');
        $file_name = 'Webdesign-first-feedback-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function webdesignFinalFeedbackPDF($id)
    {
        $project = Project::find($id);
        $data = WebdesignFinalVersion::whereProjectId($id)->first();
        $status = 'webdesign_version_2';
        $pdf = PDF::loadView('pdf.webdesign_feedback', compact('data', 'status'));
        $now = date('ymdhmi');
        $file_name = 'Webdesign-final-feedback-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function webdesignDevPDF($id)
    {
        $project = Project::find($id);
        $data = WebdesignDev::whereProjectId($id)->first();
        $status_id = Status::whereSlug('webdesign_completed')->value('id');
        $file = Media::whereProjectId($id)->whereType('file')->whereStatusId($status_id)->whereRef('manual_logo')->get();
        $pdf = PDF::loadView('pdf.webdesign_dev', compact('data', 'file'));
        $now = date('ymdhmi');
        $file_name = 'Webdesign-Dev-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function firstHomePDF($id)
    {
        $project = Project::find($id);
        $data = FirstHome::whereProjectId($id)->first();
        $pdf = PDF::loadView('pdf.first_home', compact('data'));
        $now = date('ymdhmi');
        $file_name = 'Homepage-First-Version-' .$now .'.pdf';
        return $pdf->download($file_name);
    }
    
    public function TextWritingPDF($id) 
    {
        $project = Project::find($id);
        $data = TextWriting::whereProjectId($id)->first();
        $pdf = PDF::loadView('pdf.text_writing', compact('data', 'project'));
        $now = date('ymdhmi');
        $file_name = 'Text-Writing-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function TextFirstFeedbackPDF($id) 
    {
        $project = Project::find($id);
        $data = TextFirstFeedback::whereProjectId($id)->first();
        $pdf = PDF::loadView('pdf.text_first_feedback', compact('data', 'project'));
        $now = date('ymdhmi');
        $file_name = 'Webteksten_versie_1_' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function TextFinalFeedbackPDF($id) 
    {
        $project = Project::find($id);
        $data = TextFinalFeedback::whereProjectId($id)->first();
        $pdf = PDF::loadView('pdf.text_final_feedback', compact('data', 'project'));
        $now = date('ymdhmi');
        $file_name = 'Webteksten_versie_2_' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function onboardingPDF($id) 
    {
        $project = Project::find($id);
        $data = Onboarding::whereProjectId($id)->first();
        $pdf = PDF::loadView('pdf.onboarding', compact('data', 'project'));
        $now = date('ymdhmi');
        $file_name = 'Website-First-Version-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function TextAddingPDF($id) 
    {
        $project = Project::find($id);
        $data = WebsiteTextAdding::whereProjectId($id)->first();
        
        $pdf = PDF::loadView('pdf.text_adding', compact('data'));
        $now = date('ymdhmi');
        $file_name = 'Website-Text-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function FeedbackPDF($id, $status) 
    {
        $project = Project::find($id);
        $now = date('ymdhmi');
        if($status == 'first_feedback') {
            $data = FirstFeedback::whereProjectId($id)->first();
            $file_name = 'First-Feedback-' .$now .'.pdf';    
        } elseif($status == 'final_feedback') {
            $data = FinalFeedback::whereProjectId($id)->first();
            $file_name = 'Final-Feedback-' .$now .'.pdf';    
        }
        
        $pdf = PDF::loadView('pdf.website_feedback', compact('data', 'project', 'status'));
        
        return $pdf->download($file_name);
    }

    public function HostingPDF($id)
    {
        $project = Project::find($id);
        $data = Hosting::whereProjectId($id)->first();
        $pdf = PDF::loadView('pdf.hosting', compact('data', 'project'));
        $now = date('ymdhmi');
        $file_name = 'Website-Hosting-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function ExtraPDF($id) 
    {
        $project = Project::find($id);
        $now = date('ymdhmi');
        
        $file_name = 'Extra-Function' .$now .'.pdf';    
        $data = ExtraFunction::whereProjectId($id)->first();
        $examples = json_decode($data->examples, true);
        $login_emails = json_decode($data->login_emails, true);
        $login_passwords = json_decode($data->login_passwords, true);
        $pdf = PDF::loadView('pdf.extra_function',  compact('data'));
        return $pdf->download($file_name);
    }

    public function webshopOnboardingPDF($id) 
    {
        $project = Project::find($id);
        $data = $project->webshopOnboarding;
        $pdf = PDF::loadView('pdf.webshop_onboarding', compact('data'));
        $now = date('ymdhmi');
        $file_name = 'Webshop-onboarding-' .$now .'.pdf';
        return $pdf->download($file_name);
    }

    public function ContentAddingPDF($id) 
    {
        $project = Project::find($id);
        $data = $project->contentAdding;
        $pdf = PDF::loadView('pdf.content_adding', compact('data'));
        $now = date('ymdhmi');
        $file_name = 'Content-Adding-' .$now .'.pdf';
        // return view('pdf.content_adding', compact('data'));
        return $pdf->download($file_name);
    }
}

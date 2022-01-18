<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function todos()
    {
        return $this->hasMany(TodoList::class);
    }

    public function deadline($status_id) {
        $deadline = Deadline::whereProjectId($this->id)->whereStatusId($status_id)->first();
        return $deadline;
    }

    public function deadlineBySlug($slug) {
        $deadline = Deadline::whereProjectId($this->id)->whereStatusSlug($slug)->first();
        return $deadline;
    }

    public function cur_deadline() {
        $deadline = Deadline::whereProjectId($this->id)->whereStatusId($this->status_id)->first();
        if (!$deadline) {
            $deadline = '';
        }
        return $deadline;
    }

    public function logoDesign()
    {
        return $this->hasOne('App\LogoDesignForm');
    }

    public function logoFeedbackFirst()
    {
        return $this->hasOne('App\LogoFirstFeedback');
    }

    public function logoFeedbackFinal()
    {
        return $this->hasOne('App\LogoFinalFeedback');
    }

    public function logoCompleted()
    {
        return $this->hasOne('App\LogoCompleted');
    }

    public function webDesign()
    {
        return $this->hasOne('App\WebDesign');
    }

    public function webdesignFirstVersion()
    {
        return $this->hasOne('App\WebdesignFirstVersion');
    }
    
    public function webdesignFinalVersion()
    {
        return $this->hasOne('App\WebdesignFinalVersion');
    }

    public function webdesignCompleted()
    {
        return $this->hasOne('App\WebdesignCompleted');
    }

    public function textWriting()
    {
        return $this->hasOne('App\TextWriting');
    }

    public function textFeedbackFirst()
    {
        return $this->hasOne('App\TextFirstFeedback');
    }

    public function textFeedbackFinal()
    {
        return $this->hasOne('App\TextFinalFeedback');
    }

    public function textCompleted()
    {
        return $this->hasOne('App\TextCompleted');
    }

    public function webdesignDev()
    {
        return $this->hasOne('App\WebdesignDev');
    }

    public function firstHome()
    {
        return $this->hasOne('App\FirstHome');
    }

    public function websiteOnboarding()
    {
        return $this->hasOne('App\Onboarding');
    }

    public function textAdding()
    {
        return $this->hasOne('App\WebsiteTextAdding');
    }

    public function firstFeedback()
    {
        return $this->hasOne('App\FirstFeedback');
    }

    public function extraFunction()
    {
        return $this->hasOne('App\ExtraFunction');
    }

    public function finalFeedback()
    {
        return $this->hasOne('App\FinalFeedback');
    }

    public function hosting()
    {
        return $this->hasOne('App\Hosting');
    }

    public function webshopOnboarding()
    {
        return $this->hasOne('App\WebshopOnboarding');
    }

    public function contentAdding()
    {
        return $this->hasOne('App\ContentAdding');
    }

    public function extraWorks()
    {
        return $this->hasMany('App\ExtraWork');
    }

    public function businessMail()
    {
        return $this->hasOne('App\BusinessMail');
    }

    public function mailError()
    {
        return $this->hasOne('App\MailError');
    }

    public function webdesignOnboarding()
    {
        return $this->hasOne(WebdesignOnboarding::class);
    }
}

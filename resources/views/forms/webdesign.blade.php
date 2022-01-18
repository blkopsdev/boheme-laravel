@extends('layouts.spaces.form')
@section('content')
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section>
                    <div class="wizard">
                        <div class="wizard-inner hide">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#step0" data-toggle="tab" aria-controls="step0" role="tab">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-home"></i>
                                        </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                        <span class="round-tab">
                                            {{-- <i class="glyphicon glyphicon-picture"></i> --}}
                                            <div class="numberCircle">1</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                        <span class="round-tab">
                                            <div class="numberCircle">2</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                        <span class="round-tab">
                                            <div class="numberCircle">3</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4">
                                        <span class="round-tab">
                                            <div class="numberCircle">4</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5">
                                        <span class="round-tab">
                                            <div class="numberCircle">5</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step6" data-toggle="tab" aria-controls="step6" role="tab" title="Step 6">
                                        <span class="round-tab">
                                            <div class="numberCircle">6</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step7" data-toggle="tab" aria-controls="step7" role="tab" title="Step 7">
                                        <span class="round-tab">
                                            <div class="numberCircle">7</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step8" data-toggle="tab" aria-controls="step8" role="tab" title="Step 8">
                                        <span class="round-tab">
                                            <div class="numberCircle">8</div>
                                        </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step9" data-toggle="tab" aria-controls="step9" role="tab" title="Step 9">
                                        <span class="round-tab">
                                            <div class="numberCircle">9</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step10" data-toggle="tab" aria-controls="step10" role="tab" title="Step 10">
                                        <span class="round-tab">
                                            <div class="numberCircle">10</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step11" data-toggle="tab" aria-controls="step11" role="tab" title="Step 11">
                                        <span class="round-tab">
                                            <div class="numberCircle">11</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step12" data-toggle="tab" aria-controls="step12" role="tab" title="Step 12">
                                        <span class="round-tab">
                                            <div class="numberCircle">12</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step13" data-toggle="tab" aria-controls="step13" role="tab" title="Step 13">
                                        <span class="round-tab">
                                            <div class="numberCircle">13</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step14" data-toggle="tab" aria-controls="step14" role="tab" title="Step 14">
                                        <span class="round-tab">
                                            <div class="numberCircle">14</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step15" data-toggle="tab" aria-controls="step15" role="tab" title="Step 15">
                                        <span class="round-tab">
                                            <div class="numberCircle">15</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step16" data-toggle="tab" aria-controls="step16" role="tab" title="Step 16">
                                        <span class="round-tab">
                                            <div class="numberCircle">16</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step17" data-toggle="tab" aria-controls="step17" role="tab" title="Step 17">
                                        <span class="round-tab">
                                            <div class="numberCircle">17</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step18" data-toggle="tab" aria-controls="step18" role="tab" title="Step 18">
                                        <span class="round-tab">
                                            <div class="numberCircle">18</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step19" data-toggle="tab" aria-controls="step19" role="tab" title="Step 19">
                                        <span class="round-tab">
                                            <div class="numberCircle">19</div>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step20" data-toggle="tab" aria-controls="step20" role="tab" title="Step 20">
                                        <span class="round-tab">
                                            <div class="numberCircle">20</div>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form method="POST" enctype="multipart/form-data" action="" class="multistep web-design">
                            <input type="hidden" name="quick_save" value="0" id="quick_save">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step0">
                                    <div class="tab-pane-title mb-50">
                                    <h1 class="text-dark-light" style="font-size: 54px">@lang('app.webdesign_briefing')</h1>
                                        <h2 class="text-dark-light">{{$form->project->company_name}}</h2>
                                        @if ($errors->any())
                                        <div class="row no-mh mt-30">
                                            <div class="col-md-6 col-md-offset-3 alert alert-danger text-left">
                                                <h4 class="text-danger">@lang('app.form_front_error_message')</h4>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline">
                                        <li><button type="button" class="btn btn-success btn-lg btn-lg btn-round next-step" data-step="step0">@lang('app.proceed')</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step1">
                                    <div class="row mb-30">
                                        <h2>@lang('app.describe_industry') <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.industry_tooltip')"></i></h2>
                                        <div class="form-group {{ $errors->has('industry') ? ' has-danger' : '' }} col-md-8 col-md-offset-2 mt-30">
                                            <input class="form-control input-default{{ $errors->has('industry') ? ' is-invalid' : '' }}" name="industry" id="niche" type="text" placeholder="" value="{{ $form->industry ? $form->industry : old('industry') }}"/>
                                            @if ($errors->has('industry'))
                                            <span class="error text-danger" for="industry">{{ $errors->first('industry') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 1 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light">Wat is de doelstelling van de website? <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.purpose_tooltip')"></i></h2>
                                        <div class="form-group mt-30">
                                            <div class="btn-group purpose mt-30 mb-30" data-toggle="buttons">
                                                <label class="btn btn-default btn-round {{ $form->purpose == 0 ? 'active' : '' }}">
                                                    <input type="radio" name="purpose" value="0" autocomplete="off" {{ $form->purpose == 0 ? 'checked' : '' }}> Actie gericht
                                                </label>
                                                <label class="btn btn-default btn-round {{ $form->purpose == 1 ? 'active' : '' }}">
                                                    <input type="radio" name="purpose" value="1" autocomplete="off" {{ $form->purpose == 1 ? 'checked' : '' }}> Informatief
                                                </label>
                                                <label class="btn btn-default btn-round {{ $form->purpose == 2 ? 'active' : '' }}">
                                                    <input type="radio" name="purpose" value="2" autocomplete="off" {{ $form->purpose == 2 ? 'checked' : '' }}> Lead generator
                                                </label>
                                                <label class="btn btn-default btn-round {{ $form->purpose == 3 ? 'active' : '' }}">
                                                    <input type="radio" name="purpose" value="3" autocomplete="off" {{ $form->purpose == 3 ? 'checked' : '' }}> Overig
                                                </label>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2 mt-30 mb-30">
                                                <textarea name="purpose_description" id="purpose_description" rows="5" placeholder="Opmerkingen:">{{ $form->purpose_description ? $form->purpose_description : old('purpose_description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 2 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="row">
                                        <h2 class="text-dark-light">Waar moet de focus op liggen? <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.focus_tooltip')"></i></h2>
                                        <div class="form-group mt-30">
                                            <div class="btn-group focus mb-30 col-md-8 col-md-offset-2" data-toggle="buttons">
                                                <label class="btn btn-default btn-round {{ $form->focus == 0 ? 'active' : '' }}">
                                                    <input type="radio" name="focus" value="0" autocomplete="off" {{ $form->focus == 0 ? 'checked' : '' }}>Contact opnemen
                                                </label>
                                                <label class="btn btn-default btn-round {{ $form->focus == 1 ? 'active' : '' }}">
                                                    <input type="radio" name="focus" value="1" autocomplete="off" {{ $form->focus == 1 ? 'checked' : '' }}>Offerte aanvragen
                                                </label>
                                                <label class="btn btn-default btn-round {{ $form->focus == 2 ? 'active' : '' }}">
                                                    <input type="radio" name="focus" value="2" autocomplete="off" {{ $form->focus == 2 ? 'checked' : '' }}>Afspraak maken
                                                </label>
                                                <label class="btn btn-default btn-round {{ $form->focus == 3 ? 'active' : '' }}">
                                                    <input type="radio" name="focus" value="3" autocomplete="off" {{ $form->focus == 3 ? 'checked' : '' }}>Overig
                                                </label>
                                                <label class="btn btn-default btn-round {{ $form->focus == 4 ? 'active' : '' }}">
                                                    <input type="radio" name="focus" value="4" autocomplete="off" {{ $form->focus == 4 ? 'checked' : '' }}>Uw portfolio
                                                </label>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2 mt-30 mb-30">
                                                <textarea name="focus_description" id="focus" rows="5" placeholder="Opmerkingen:">{{ $form->focus_description ? $form->focus_description: old('focus_description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 3 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <div class="row">
                                        <h2 class="mb-15">@lang('app.logo_type')</h2>
                                        <div class="form-group badge-checkboxes {{ $errors->has('type') ? ' has-danger' : '' }}">
                                            <div class="col-md-6 col-md-offset-3">
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Dynamisch" name="type[]" 
                                                    @if($form->type && strpos($form->type ,'Dynamisch'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Dynamisch</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Fun" name="type[]"
                                                    @if($form->type && strpos($form->type ,'Fun'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Fun</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Speels" name="type[]"
                                                    @if($form->type && strpos($form->type ,'Speels'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Speels</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Modern" name="type[]"
                                                    @if($form->type && strpos($form->type ,'Modern'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Modern</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Tijdloos" name="type[]"
                                                    @if($form->type && strpos($form->type ,'Tijdloos'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Tijdloos</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Creatief" name="type[]"
                                                    @if($form->type && strpos($form->type ,'Creatief'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Creatief</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Technisch" name="type[]"
                                                    @if($form->type && strpos($form->type ,'Technisch'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Technisch</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Fris" name="type[]"
                                                    @if($form->type && strpos($form->type ,'Fris'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Fris</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Formeel" name="type[]"
                                                    @if($form->type && strpos($form->type ,'Formeel'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Formeel</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Hipster" name="type[]"
                                                    @if($form->type && strpos($form->type ,'Hipster'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Hipster</span>
                                                </label>
                                            </div>
                                            @if ($errors->has('type'))
                                            <div class="col-md-12 mt-30">
                                                <span class="error text-danger float-none" for="type">{{ $errors->first('type') }}</span>
                                            </div>
                                            @endif
                                        </div>
                                            
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 4 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step5">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light mb-50">Wat zijn de USP's (Unique Selling Points) van je bedrijf? <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.usp_tooltip')"></i></h2>
                                        <div class="col-md-4 col-md-offset-4 usp">
                                            
                                            @if ($form->usp && countArray(json_decode($form->usp)) > 0)
                                                @foreach (json_decode($form->usp) as $usp)
                                                @if ($usp)
                                                <div class="form-group">
                                                    <input type="text" name="usp[]" class="input-default input-sm form-control" value="{{ $usp }}">
                                                </div>
                                                @endif
                                                @endforeach
                                            @else
                                                <div class="form-group"><input type="text" name="usp[]" class="input-default input-sm form-control"></div>
                                                <div class="form-group"><input type="text" name="usp[]" class="input-default input-sm form-control"></div>
                                                <div class="form-group"><input type="text" name="usp[]" class="input-default input-sm form-control"></div>
                                                <div class="form-group"><input type="text" name="usp[]" class="input-default input-sm form-control"></div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4 col-md-offset-4 mt-15 text-left">
                                            <button type="button" class="btn-round btn-success no-border ml-20" id="more_usp"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="more_usp">&nbsp;USP toevoegen</label> 
                                        </div>
                                        @if ($errors->has('usp.0'))
                                            <div class="col-md-4 col-md-offset-4">
                                                <span class="text-danger error" for="usp">{{ $errors->first('usp.0') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 5 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step6">
                                    <div class="row mb-30 no-mh">
                                        <h2 class="text-dark-light mb-15">Welke contact gegevens kunnen we gebruiken op de website?</h2>
                                    </div>
                                    <div class="row mb-20">
                                        <div class="col-md-6 col-md-offset-3 form-group">
                                            <input type="text" name="contact_phone" id="contact_phone" class="input-md" placeholder="Telefoon:" value="{{ $form->contact_phone ? $form->contact_phone : old('contact_phone') }}">
                                            @if ($errors->has('contact_phone'))
                                                <span class="error text-danger" for="contact_phone">{{ $errors->first('contact_phone') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 col-md-offset-3 form-group">
                                            <input type="text" name="contact_email" id="contact_email" class="input-md" placeholder="Mail:" value="{{ $form->contact_email ? $form->contact_email : old('contact_email') }}">
                                            @if ($errors->has('contact_email'))
                                                <span class="error text-danger" for="contact_email">{{ $errors->first('contact_email') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 col-md-offset-3 form-group">
                                            <input type="text" name="contact_address" id="contact_address" class="input-md" placeholder="Adres:" value="{{ $form->contact_address ? $form->contact_address : old('contact_address') }}">
                                            @if ($errors->has('contact_address'))
                                                <span class="error text-danger" for="contact_address">{{ $errors->first('contact_address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 6 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step7">
                                    <div class="row">
                                        <h2 class="mb-15">Welk lettertype heeft uw voorkeur:</h2>
                                        <div class="col-md-8 col-md-offset-2 mt-30">
                                            <input type="radio" name="font" 
                                            id="font_1" class="input-hidden" value="Open Sans and Roboto" 
                                            @if($form->font && $form->font == 'Open Sans and Roboto') checked @endif
                                            />
                                            <label for="font_1" class="font-type">
                                                <img src="{{ asset('assets/img/open-sans.png') }}" alt="" />
                                            </label>
                                        </div>
                                        <div class="col-md-8 col-md-offset-2 mt-30">
                                            <input type="radio" name="font" 
                                            id="font_2" class="input-hidden" value="Playfair Display and Montserrat" @if($form->font && $form->font == 'Playfair Display and Montserrat') checked @endif
                                            />
                                            <label for="font_2" class="font-type">
                                                <img src="{{ asset('assets/img/montserrat.png') }}" alt="" />
                                            </label>
                                        </div>
                                        <div class="col-md-8 col-md-offset-2 mt-30">
                                            <input type="radio" name="font" 
                                            id="font_3" class="input-hidden" value="Lora and Alegreya" @if($form->font && $form->font == 'Lora and Alegreya') checked @endif
                                            />
                                            <label for="font_3" class="font-type">
                                                <img src="{{ asset('assets/img/alegreya.png') }}" alt="" />
                                            </label>
                                        </div>
                                        <div class="col-md-8 col-md-offset-2 mt-30">
                                            <input type="radio" name="font" 
                                            id="font_4" class="input-hidden" value="Merriweather and Lato" @if($form->font && $form->font == 'Merriweather and Lato') checked @endif
                                            />
                                            <label for="font_4" class="font-type">
                                                <img src="{{ asset('assets/img/lato.png') }}" alt="" />
                                            </label>
                                        </div>
                                        <div class="col-md-8 col-md-offset-2 mt-30">
                                            <input type="radio" name="font" 
                                            id="font_5" class="input-hidden" value="Amatic SC and Josefin Slab" @if($form->font && $form->font == 'Amatic SC and Josefin Slab') checked @endif
                                            />
                                            <label for="font_5" class="font-type">
                                                <img src="{{ asset('assets/img/josefin-slab.png') }}" alt="" />
                                            </label>
                                        </div>
                                        <div class="col-md-8 col-md-offset-2 mt-30">
                                            <input type="radio" name="font" 
                                            id="font_6" class="input-hidden" value="PT Sans Narrow and PT Sans" @if($form->font && $form->font == 'PT Sans Narrow and PT Sans') checked @endif
                                            />
                                            <label for="font_6" class="font-type">
                                                <img src="{{ asset('assets/img/pt-sans.png') }}" alt="" />
                                            </label>
                                        </div>
                                        <div class="col-md-8 col-md-offset-2 mt-30 text-left">
                                            <div class="font-card">
                                                <h3 class="text-dark-light mb-20"><strong>Ik wil een ander lettertype gebruiken:</strong></h3>
                                                <textarea name="font_description" id="font_description" cols="60" rows="5" class="p-15 form-control" placeholder="Type hier de naam van het lettertype of de URL van een voorbeeld website.">{{ $form->font_description ? $form->font_description : '' }}</textarea>
                                                <h4 class="text-dark-light mt-20">
                                                    Of upload hier een bestand:
                                                </h4>
                                                @if ($form->file('font_file'))
                                                <div class="uploaded-files text-left">
                                                    <h4>@lang('form.uploaded_files')</h4>
                                                    <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('font_file')->id }}"><span class="fa fa-close text-danger"></span></button>
                                                    <a href="{{ asset('uploads/' . $form->file('font_file')->media_name) }}" target="_blank">{{ $form->file('font_file')->media_name }}</a>
                                                </div>
                                                @endif
                                                <div class="font-file {{ $form->file('font_file') ? 'hide' : '' }}">
                                                    <input type="file" name="font_file" id="font_file" class="input-default m-0 form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>

                                    <div class="mt-30">
                                        <h4>Stap 7 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step8">
                                    <div class="row appeals">
                                        <h2 class="mb-15">Welke website spreek u meer aan? <i class="fa fa-info-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.appeal_tooltip')"></i></h2>
                                        <div class="col-md-12 mt-30 {{ $errors->has('appeal_1') ? ' has-danger' : '' }}">
                                            <input type="radio" name="appeal_1" id="appeal_1_odd" class="input-hidden" value="0" @if($form->appeal_1 == 0) checked @endif />
                                            <label for="appeal_1_odd" class="appeal-type">
                                                <img src="{{ asset('assets/img/webdesign-1-0.png') }}" alt="" />
                                            </label>
                                            
                                            <input type="radio" name="appeal_1" id="appeal_1_even" class="input-hidden" value="1" @if($form->appeal_1 == 1) checked @endif />
                                            <label for="appeal_1_even" class="appeal-type">
                                                <img src="{{ asset('assets/img/webdesign-1-1.png') }}" alt="" />
                                            </label>
                                        </div>
                                        @if ($errors->has('appeal_1'))
                                        <div class="col-md-12 mt-30">
                                            <span class="error text-danger float-none" for="appeal_1">{{ $errors->first('appeal_1') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>

                                    <div class="mt-30">
                                        <h4>Stap 8 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step9">
                                    <div class="row appeals">
                                        <h2 class="mb-15">Welke website spreek u meer aan? <i class="fa fa-info-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.appeal_tooltip')"></i></h2>
                                        <div class="col-md-12 mt-30 {{ $errors->has('appeal_2') ? ' has-danger' : '' }}">
                                            <input type="radio" name="appeal_2" id="appeal_2_odd" class="input-hidden" value="0" @if($form->appeal_2 == 0) checked @endif />
                                            <label for="appeal_2_odd" class="appeal-type">
                                                <img src="{{ asset('assets/img/webdesign-2-0.png') }}" alt="" />
                                            </label>

                                            <input type="radio" name="appeal_2" id="appeal_2_even" class="input-hidden" value="1" @if($form->appeal_2 == 1) checked @endif />
                                            <label for="appeal_2_even" class="appeal-type">
                                                <img src="{{ asset('assets/img/webdesign-2-1.png') }}" alt="" />
                                            </label>
                                        </div>
                                        @if ($errors->has('appeal_2'))
                                        <div class="col-md-12 mt-30">
                                            <span class="error text-danger float-none" for="appeal_2">{{ $errors->first('appeal_2') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>

                                    <div class="mt-30">
                                        <h4>Stap 9 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step10">
                                    <div class="row appeals">
                                        <h2 class="mb-15">Welke website spreek u meer aan? <i class="fa fa-info-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.appeal_tooltip')"></i></h2>
                                        <div class="col-md-12 mt-30 {{ $errors->has('appeal_3') ? ' has-danger' : '' }}">
                                            <input type="radio" name="appeal_3" id="appeal_3_odd" class="input-hidden" value="0" @if($form->appeal_3 == 0) checked @endif />
                                            <label for="appeal_3_odd" class="appeal-type">
                                                <img src="{{ asset('assets/img/webdesign-3-0.png') }}" alt="" />
                                            </label>

                                            <input type="radio" name="appeal_3" id="appeal_3_even" class="input-hidden" value="1" @if($form->appeal_3 == 1) checked @endif />
                                            <label for="appeal_3_even" class="appeal-type">
                                                <img src="{{ asset('assets/img/webdesign-3-1.png') }}" alt="" />
                                            </label>
                                        </div>
                                        @if ($errors->has('appeal_3'))
                                        <div class="col-md-12 mt-30">
                                            <span class="error text-danger float-none" for="appeal_3">{{ $errors->first('appeal_3') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>

                                    <div class="mt-30">
                                        <h4>Stap 10 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step11">
                                    <div class="row appeals">
                                        <h2 class="mb-15">Welke website spreek u meer aan? <i class="fa fa-info-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.appeal_tooltip')"></i></h2>
                                        <div class="col-md-12 mt-30 {{ $errors->has('appeal_4') ? ' has-danger' : '' }}">
                                            <input type="radio" name="appeal_4" id="appeal_4_odd" class="input-hidden" value="0" @if($form->appeal_4 == 0) checked @endif />
                                            <label for="appeal_4_odd" class="appeal-type">
                                                <img src="{{ asset('assets/img/webdesign-4-0.png') }}" alt="" />
                                            </label>

                                            <input type="radio" name="appeal_4" id="appeal_4_even" class="input-hidden" value="1" @if($form->appeal_4 == 1) checked @endif />
                                            <label for="appeal_4_even" class="appeal-type">
                                                <img src="{{ asset('assets/img/webdesign-4-1.png') }}" alt="" />
                                            </label>
                                        </div>
                                        @if ($errors->has('appeal_4'))
                                        <div class="col-md-12 mt-30">
                                            <span class="error text-danger float-none" for="appeal_4">{{ $errors->first('appeal_4') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>

                                    <div class="mt-30">
                                        <h4>Stap 11 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step12">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light">Noem hier enkele websites die u mooi vindt:</h2>
                                        <h4 class="text-dark-light mb-50"><strong>Let op: dit kunnen ook websites zijn in een andere branche.</strong></h4>
                                        <div class="col-md-4 col-md-offset-4 reference">
                                            @if ($form->reference && countArray(json_decode($form->reference)) > 0 )
                                                @foreach (json_decode($form->reference) as $reference)
                                                    @if ($reference)
                                                    <div class="form-group">
                                                        <input type="text" name="reference[]" class="input-default input-sm form-control" value="{{ $reference }}">
                                                    </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <div class="form-group"><input type="text" name="reference[]" class="input-default input-sm form-control" placeholder="http://www.domein.nl"></div>
                                                <div class="form-group"><input type="text" name="reference[]" class="input-default input-sm form-control" placeholder="http://www.domein.nl"></div>
                                                <div class="form-group"><input type="text" name="reference[]" class="input-default input-sm form-control" placeholder="http://www.domein.nl"></div>
                                                <div class="form-group"><input type="text" name="reference[]" class="input-default input-sm form-control" placeholder="http://www.domein.nl"></div>
                                                
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4 col-md-offset-4 mt-15 text-left">
                                            <button type="button" class="btn-round btn-success no-border ml-20" id="more_reference"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="more_reference">&nbsp;Add more</label> 
                                        </div>
                                        @if ($errors->has('reference.0'))
                                            <div class="col-md-4 col-md-offset-4">
                                                <span class="text-danger error" for="reference">{{ $errors->first('reference.0') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 12 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step13">
                                    <div class="row no-mh">
                                        <h2 class="mb-30 text-dark-light">Wilt u een <strong>team/personeel sectie</strong> op de website?</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <img src="{{ asset('assets/img/Image 15.png') }}" alt="" class="img-responsive">
                                        </div>
                                        <div class="form-group mt-30 col-md-12">
                                            <div class="btn-group team-section mt-30 mb-30" data-toggle="buttons">
                                                <label class="btn btn-default btn-round next-step {{ $form->team == 1 ? 'active' : '' }}"  for="team_yes">
                                                    <input type="radio" name="team" value="1" id="team_yes" {{ $form->team == 1 ? 'checked' : '' }}> Ja
                                                </label>
                                                <label class="btn btn-default btn-round next-step {{ $form->team == 0 ? 'active' : '' }}" for="team_no">
                                                    <input type="radio" name="team" value="0" id="team_no" {{ $form->team == 0 ? 'checked' : '' }}> Nee
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 13 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step14">
                                    <div class="row no-mh">
                                        <h2 class="mb-30 text-dark-light">Wilt u een review sectie op de website?</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <img src="{{ asset('assets/img/Image 22.png') }}" alt="" class="img-responsive">
                                        </div>
                                        <div class="form-group mt-30 col-md-12">
                                            <div class="btn-group review-section mt-30 mb-30" data-toggle="buttons">
                                                <label class="btn btn-default btn-round next-step {{ $form->review == 1 ? 'active' : '' }}" for="review_yes">
                                                    <input type="radio" name="review" value="1" id="review_yes" {{ $form->review == 1 ? 'checked' : '' }}> Ja
                                                </label>
                                                <label class="btn btn-default btn-round next-step {{ $form->review == 0 ? 'active' : '' }}" for="review_no">
                                                    <input type="radio" name="review" value="0" id="review_no" {{ $form->review == 0 ? 'checked' : '' }}> Nee
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 14 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step15">
                                    <div class="row no-mh">
                                        <h2 class="mb-30 text-dark-light">Wilt u een <strong>portfolio sectie</strong> op de website?</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <img src="{{ asset('assets/img/Image 25.png') }}" alt="" class="img-responsive">
                                        </div>
                                        <div class="form-group mt-30 col-md-12">
                                            <div class="btn-group portfolio-section mt-30 mb-30" data-toggle="buttons">
                                                <label class="btn btn-default btn-round next-step {{ $form->portfolio == 1 ? 'active' : '' }}" for="portfolio_yes">
                                                    <input type="radio" name="portfolio" value="1" id="portfolio_yes" {{ $form->portfolio == 1 ? 'checked' : '' }}> Ja
                                                </label>
                                                <label class="btn btn-default btn-round next-step {{ $form->portfolio == 0 ? 'active' : '' }}" for="portfolio_no">
                                                    <input type="radio" name="portfolio" value="0" id="portfolio_no" {{ $form->portfolio == 0 ? 'checked' : '' }}> Nee
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 15 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step16">
                                    <div class="row no-mh">
                                        <h2 class="mb-30 text-dark-light">Wilt u een <strong>Blog sectie</strong> op de website?</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <img src="{{ asset('assets/img/Image 23.png') }}" alt="" class="img-responsive">
                                        </div>
                                        <div class="form-group mt-30 col-md-12">
                                            <div class="btn-group blog-section mt-30 mb-30" data-toggle="buttons">
                                                <label class="btn btn-default btn-round next-step {{ $form->blog == 1 ? 'active' : '' }}" for="blog_yes">
                                                    <input type="radio" name="blog" value="1" id="blog_yes" {{ $form->blog == 1 ? 'checked' : '' }}> Ja
                                                </label>
                                                <label class="btn btn-default btn-round next-step {{ $form->blog == 0 ? 'active' : '' }}" for="blog_no">
                                                    <input type="radio" name="blog" value="0" id="blog_no" {{ $form->blog == 0 ? 'checked' : '' }}> Nee
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 16 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step17">
                                    <div class="row no-mh">
                                        <h2 class="mb-30 text-dark-light">Wilt u een <strong>Nieuwsbrief aanmelding</strong> op de website?</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <img src="{{ asset('assets/img/Image 27.png') }}" alt="" class="img-responsive">
                                        </div>
                                        <div class="form-group mt-30 col-md-12">
                                            <div class="btn-group newsletter-section mt-30 mb-30" data-toggle="buttons">
                                                <label class="btn btn-default btn-round next-step {{ $form->newsletter == 1 ? 'active' : '' }}" for="newsletter_yes">
                                                    <input type="radio" name="newsletter" value="1" id="newsletter_yes" {{ $form->newsletter == 1 ? 'checked' : '' }}> Ja
                                                </label>
                                                <label class="btn btn-default btn-round next-step {{ $form->newsletter == 0 ? 'active' : '' }}" for="newsletter_no">
                                                    <input type="radio" name="newsletter" value="0" id="newsletter_no" {{ $form->newsletter == 0 ? 'checked' : '' }}> Nee
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 17 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step18">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light mb-50">Welke diensten wilt u uitlichten op de homepagina <i class="fa fa-info-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.highlights_tooltip')"></i></h2>
                                        <div class="col-md-4 col-md-offset-4 service-highlight">
                                            @if ($form->service_highlight && countArray(json_decode($form->service_highlight)) > 0)
                                                @foreach (json_decode($form->service_highlight) as $service_highlight)
                                                @if ($service_highlight)
                                                <div class="form-group">
                                                    <input type="text" name="service_highlight[]" class="input-default input-sm form-control" value="{{ $service_highlight }}">
                                                </div>
                                                @endif
                                                @endforeach
                                            @else
                                                <div class="form-group"><input type="text" name="service_highlight[]" class="input-default input-sm form-control"></div>
                                                <div class="form-group"><input type="text" name="service_highlight[]" class="input-default input-sm form-control"></div>
                                                <div class="form-group"><input type="text" name="service_highlight[]" class="input-default input-sm form-control"></div>
                                                <div class="form-group"><input type="text" name="service_highlight[]" class="input-default input-sm form-control"></div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4 col-md-offset-4 mt-15 text-left">
                                            <button type="button" class="btn-round btn-success no-border ml-20" id="more_highlight"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="more_highlight">&nbsp;Extra dienst toevoegen</label> 
                                        </div>
                                        @if ($errors->has('service_highlight.0'))
                                            <div class="col-md-4 col-md-offset-4">
                                                <span class="text-danger error" for="service_highlight">{{ $errors->first('service_highlight.0') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 18 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step19">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="mb-30 text-dark-light"><strong>Upload uw logo</strong></h2>
                                            <h4 class="text-dark-light">Indien wij al uw logo hebben gemaakt kunt u deze stap overslaan.</h4>
                                            <h4 class="text-dark-light mb-30"><strong>LET OP: het logo moet transparant zijn! (.png)</strong></h4>
                                            <p class="mt-30 text-dark-light">
                                                Indien gewenst kunt u dit logo ook later naar ons sturen
                                            </p>
                                        </div>
                                        @if ($form->file('logo_file'))
                                        <div class="uploaded-files text-left col-md-6 col-md-offset-3">
                                            <h4>@lang('form.uploaded_files')</h4>
                                            <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('logo_file')->id }}"><span class="fa fa-close text-danger"></span></button>
                                            <a href="{{ asset('uploads/' . $form->file('logo_file')->media_name) }}" target="_blank">{{ $form->file('logo_file')->media_name }}</a>
                                        </div>
                                        @endif
                                        <div class="form-group col-md-6 col-md-offset-3 mt-15 {{ $form->file('logo_file') ? 'hide' : '' }}">
                                            <input type="file" name="logo_file" id="logo_file" class="input-default form-control">
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 19 van 20</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step20">
                                    <h2>Wat voor kleuren kunnen wij gebruiken?</h2>
                                    <div class="row card-box">
                                        <div class="card col-md-3">
                                            <div class="card-body">
                                                <h4 class="card-title">Hoofdkleur</h4>
                                                <div class="form-group">
                                                    <input type="text" id="main_color" name="main_color" class="form-control color-picker" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card col-md-3">
                                            <div class="card-body">
                                                <h4 class="card-title">Subkleur 1</h4>
                                                <div class="form-group">
                                                    <input type="text" id="sub_color_1" name="sub_color_1" class="form-control color-picker" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card col-md-3">
                                            <div class="card-body">
                                                <h4 class="card-title">Subkleur 2</h4>
                                                <div class="form-group">
                                                    <input type="text" id="sub_color_2" name="sub_color_2" class="form-control color-picker" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-mh">
										<div class="form-group col-md-6 col-md-offset-3 logo-color mb-30 text-left">
											<label for="website_color"><input type="checkbox" name="website_color" id="website_color" value="1" {{ $form->website_color == 1 ? 'checked' : '' }}> @lang('form.no_decision_color')</label>
										</div>
										<div class="form-group col-md-6 col-md-offset-3 logo-color mb-30 text-left">
											<label for="use_logo_color"><input type="checkbox" name="use_logo_color" id="use_logo_color" value="1" {{ $form->use_logo_color == 1 ? 'checked' : '' }}> @lang('form.use_logo_color')</label>
										</div>
                                    </div>
                                    <div class="row no-mh mt-30">
                                        <div class="form-group col-md-8 col-md-offset-2">
                                            <textarea name="logo_notes" id="logo_notes" cols="30" rows="5" class="form-control" placeholder="Opmerkingen of aanvullingen over de kleur:">{{ $form->logo_notes ? $form->logo_notes : '' }}</textarea>
                                        </div>
                                    </div>
                                    @if ($errors->has('main_color'))
                                    <div class="row no-mh">
                                        <div class="col-md-12 text-center">
                                            <div class="col-md-12">
                                                <span class="error text-danger float-none" for="main_color">{{ $errors->first('main_color') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <ul class="list-inline mt-30">
                                        <li><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li><button type="submit" class="btn btn-success btn-lg btn-round next-step">@lang('app.submit')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 20 van 20</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
</div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#more_usp').on('click', function() {
            var html = '<div class="form-group"><input type="text" name="usp[]" class="input-default input-sm form-control"></div>';
            $('.usp').append(html);
        });

        $('#more_highlight').on('click', function() {
            var html = '<div class="form-group"><input type="text" name="service_highlight[]" class="input-default input-sm form-control"></div>';
            $('.service-highlight').append(html);
        });

        $('#more_reference').on('click', function() {
            var html = '<div class="form-group"><input type="text" name="reference[]" class="input-default input-sm form-control" value="" placeholder="http://www.domein.nl"></div>';
            $('.reference').append(html);
        })
    });

    $(document).on('click', '.file-remove', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('delete_media') }}",
            type: "POST",
            data: { 
                id: id,
                _token : '{{ csrf_token() }}' 
            },
            success : function (response) {
            }
        });
        $(this).closest('.row').find('.hide').removeClass('hide');
        $(this).closest('.uploaded-files').remove();
    })
</script>
@endpush


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
                            </ul>
                        </div>

                        <form method="POST" enctype="multipart/form-data" action="" class="multistep logo-design">
                            @csrf
                            <input type="hidden" name="quick_save" value="0" id="quick_save">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step0">
                                    <div class="tab-pane-title mb-50">
                                        <h1 class="text-dark-light" style="font-size: 54px">@lang('app.logo_briefing')</h1>
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
                                    <div class="row">
                                        <div class="form-group {{ $errors->has('company_name') ? ' has-danger' : '' }} col-md-8 col-md-offset-2 mt-30">
                                            <input class="form-control input-default{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" id="company_name" type="text" placeholder="@lang('app.company_name')" value="{{ $form->company_name ? $form->company_name: old('company_name') }}"/>
                                            @if ($errors->has('company_name'))
                                            <span class="error text-danger" for="company_name">{{ $errors->first('company_name') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('slogan') ? ' has-danger' : '' }} col-md-8 col-md-offset-2  mt-30 mb-30">
                                            <input class="form-control input-default{{ $errors->has('slogan') ? ' is-invalid' : '' }}" name="slogan" id="slogan" type="text" placeholder="@lang('app.slogan')" value="{{ $form->slogan ? $form->slogan: old('slogan') }}"/>
                                            @if ($errors->has('slogan'))
                                            <span class="error text-danger" for="slogan">{{ $errors->first('slogan') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 1 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="row mb-30">
                                        <h2>@lang('app.describe_niche')</h2>
                                        <div class="form-group {{ $errors->has('niche') ? ' has-danger' : '' }} col-md-8 col-md-offset-2 mt-30">
                                            <input class="form-control input-default{{ $errors->has('niche') ? ' is-invalid' : '' }}" name="niche" id="niche" type="text" placeholder="" value="{{ $form->niche ? $form->niche:old('niche') }}"/>
                                            @if ($errors->has('niche'))
                                            <span class="error text-danger" for="niche">{{ $errors->first('niche') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 2 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="row">
                                        <h2 class="mb-15">@lang('app.logo_type')</h2>
                                        <div class="form-group badge-checkboxes {{ $errors->has('logo_styles') ? ' has-danger' : '' }}">
                                            <div class="col-md-6 col-md-offset-3">
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Dynamisch" name="logo_styles[]" 
                                                    @if($form->types && strpos($form->types ,'Dynamisch'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Dynamisch</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Fun" name="logo_styles[]"
                                                    @if($form->types && strpos($form->types ,'Fun'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Fun</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Speels" name="logo_styles[]"
                                                    @if($form->types && strpos($form->types ,'Speels'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Speels</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Modern" name="logo_styles[]"
                                                    @if($form->types && strpos($form->types ,'Modern'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Modern</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Tijdloos" name="logo_styles[]"
                                                    @if($form->types && strpos($form->types ,'Tijdloos'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Tijdloos</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Creatief" name="logo_styles[]"
                                                    @if($form->types && strpos($form->types ,'Creatief'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Creatief</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Technisch" name="logo_styles[]"
                                                    @if($form->types && strpos($form->types ,'Technisch'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Technisch</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Fris" name="logo_styles[]"
                                                    @if($form->types && strpos($form->types ,'Fris'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Fris</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Formeel" name="logo_styles[]"
                                                    @if($form->types && strpos($form->types ,'Formeel'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Formeel</span>
                                                </label>
                                                <label class="checkbox-inline my-10">
                                                    <input type="checkbox" value="Hipster" name="logo_styles[]"
                                                    @if($form->types && strpos($form->types ,'Hipster'))
                                                    checked
                                                    @endif
                                                    ><span class="badge">Hipster</span>
                                                </label>
                                            </div>
                                            @if ($errors->has('logo_styles'))
                                            <div class="col-md-12 mt-30">
                                                <span class="error text-danger float-none" for="logo_styles">{{ $errors->first('logo_styles') }}</span>
                                            </div>
                                            @endif
                                        </div>
                                            
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 3 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <div class="row">
                                        <h2 class="mb-15">@lang('app.logo_type')</h2>
                                        <h4 class="text-dark-light mb-30">Let op: dit is puur om te kijken wat voor soort stijl van het logo u mooi vindt.</h4>
                                        <div class="col-md-6 col-md-offset-3 mt-30 {{ $errors->has('favorite_logo_1') ? ' has-danger' : '' }}">
                                            <input type="radio" name="favorite_logo_1" 
                                            id="logo_1_odd" class="input-hidden" value="1" 
                                            @if($form->favorite_logo_1 && $form->favorite_logo_1 == 1)
                                            checked
                                            @else
                                                {{ old('favorite_logo_1') == "1" ? 'checked' : '' }}
                                            @endif
                                            />
                                            <label for="logo_1_odd" class="logo_type">
                                                <img src="{{ asset('assets/img/Image 3.png') }}" alt="" />
                                                </label>

                                            <input 
                                                type="radio" name="favorite_logo_1"
                                                id="logo_1_even" class="input-hidden"  value="2"
                                                @if($form->favorite_logo_1 && $form->favorite_logo_1 == 2)
                                                checked
                                                @else
                                                {{ old('favorite_logo_1') == "2" ? 'checked' : '' }}
                                                @endif
                                            />
                                            <label for="logo_1_even" class="logo_type">
                                                <img src="{{ asset('assets/img/Image 2.png') }}" alt="" />
                                            </label>
                                        </div>
                                        @if ($errors->has('favorite_logo_1'))
                                        <div class="col-md-12 mt-30">
                                            <span class="error text-danger float-none" for="favorite_logo_1">{{ $errors->first('favorite_logo_1') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>

                                    <div class="mt-30">
                                        <h4>Stap 4 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step5">
                                    <div class="row">
                                        <h2 class="mb-15">@lang('app.logo_type')</h2>
                                        <h4 class="text-dark-light mb-30">Let op: dit is puur om te kijken wat voor soort stijl van het logo u mooi vindt.</h4>
                                        <div class="col-md-6 col-md-offset-3 mt-30 {{ $errors->has('favorite_logo_2') ? ' has-danger' : '' }}">
                                            <input 
                                                type="radio" name="favorite_logo_2" 
                                                id="logo_2_odd" class="input-hidden" value="1"
                                                @if($form->favorite_logo_2 && $form->favorite_logo_2 == 1)
                                                checked
                                                @else
                                                {{ old('favorite_logo_2') == "1" ? 'checked' : '' }}
                                                @endif/>
                                                <label for="logo_2_odd" class="logo_type">
                                                    <img src="{{ asset('assets/img/Image 4.png') }}" alt="" />
                                                </label>

                                                <input 
                                                type="radio" name="favorite_logo_2"
                                                id="logo_2_even" class="input-hidden" value="2"
                                                @if($form->favorite_logo_2 && $form->favorite_logo_2 == 2)
                                                checked
                                                @else
                                                {{ old('favorite_logo_2') == "2" ? 'checked' : '' }}
                                                @endif/>
                                                <label for="logo_2_even" class="logo_type">
                                                    <img src="{{ asset('assets/img/Image 5.png') }}" alt="" />
                                                </label>
                                        </div>
                                        @if ($errors->has('favorite_logo_2'))
                                        <div class="col-md-12 mt-30">
                                            <span class="error text-danger float-none" for="favorite_logo_2">{{ $errors->first('favorite_logo_2') }}</span>
                                        </div>
                                        @endif
                                            
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 5 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step6">
                                    <div class="row">
                                        <h2 class="mb-15">@lang('app.logo_type')</h2>
                                        <h4 class="text-dark-light mb-30">Let op: dit is puur om te kijken wat voor soort stijl van het logo u mooi vindt.</h4>
                                        <div class="col-md-6 col-md-offset-3 mt-30 {{ $errors->has('favorite_logo_3') ? ' has-danger' : '' }}">
                                            <input type="radio" name="favorite_logo_3" id="logo_3_odd" class="input-hidden" value="1"
                                                @if($form->favorite_logo_3 && $form->favorite_logo_3 == 1)
                                                checked
                                                @else
                                                {{ old('favorite_logo_3') == "1" ? 'checked' : '' }}
                                                @endif
                                            />
                                            <label for="logo_3_odd" class="logo_type">
                                                <img src="{{ asset('assets/img/Image 6.png') }}" alt="" />
                                            </label>

                                            <input type="radio" name="favorite_logo_3" id="logo_3_even" class="input-hidden" value="2"
                                                @if($form->favorite_logo_3 && $form->favorite_logo_3 == 2)
                                                checked
                                                @else
                                                {{ old('favorite_logo_3') == "2" ? 'checked' : '' }}
                                                @endif
                                            />
                                            <label for="logo_3_even" class="logo_type">
                                                <img src="{{ asset('assets/img/SvgjsG1865.png') }}" alt="" />
                                            </label>
                                        </div>
                                        @if ($errors->has('favorite_logo_3'))
                                        <div class="col-md-12 mt-30">
                                            <span class="error text-danger float-none" for="favorite_logo_3">{{ $errors->first('favorite_logo_3') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>

                                    <div class="mt-30">
                                        <h4>Stap 6 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step7">
                                    <div class="row">
                                        <h2 class="mb-15">@lang('app.logo_type')</h2>
                                        <h4 class="text-dark-light mb-30">Let op: dit is puur om te kijken wat voor soort stijl van het logo u mooi vindt.</h4>
                                        <div class="col-md-6 col-md-offset-3 mt-30 {{ $errors->has('favorite_logo_4') ? ' has-danger' : '' }}">
                                            <input 
                                                type="radio" name="favorite_logo_4" 
                                                id="logo_4_odd" class="input-hidden" value="1"
                                                @if($form->favorite_logo_4 && $form->favorite_logo_4 == 1)
                                                checked
                                                @else
                                                {{ old('favorite_logo_4') == "1" ? 'checked' : '' }}
                                                @endif/>
                                            <label for="logo_4_odd" class="logo_type">
                                                <img src="{{ asset('assets/img/Image 7.png') }}" alt="" />
                                            </label>

                                            <input 
                                            type="radio" name="favorite_logo_4"
                                            id="logo_5_even" class="input-hidden"  value="2"
                                            @if($form->favorite_logo_4 && $form->favorite_logo_4 == 2)
                                            checked
                                            @else
                                                {{ old('favorite_logo_4') == "2" ? 'checked' : '' }}
                                            @endif/>
                                            <label for="logo_5_even" class="logo_type">
                                                <img src="{{ asset('assets/img/Image 11.png') }}" alt="" />
                                            </label>
                                        </div>
                                        @if ($errors->has('favorite_logo_4'))
                                        <div class="col-md-12 mt-30">
                                            <span class="error text-danger float-none" for="favorite_logo_4">{{ $errors->first('favorite_logo_4') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 7 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step8">
                                    <div class="row">
                                        <h2 class="mb-15">@lang('app.which_purpose') <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.logo_type_tooltip')"></i></h2>
                                        <div class="col-md-6 col-md-offset-3 mt-30 {{ $errors->has('purposes') ? ' has-danger' : '' }}">
                                            <input 
                                                type="checkbox" name="purposes[]" 
                                                id="purpose_0" class="input-hidden" value="Website" 
                                                @if($form->types && strpos($form->purpose ,'Website'))
                                                    checked
                                                @endif
                                            />
                                            <label for="purpose_0" class="logo_type">
                                                <img src="{{ asset('assets/img/Image 8.png') }}" alt="" />
                                            </label>

                                            <input 
                                                type="checkbox" name="purposes[]"
                                                id="purpose_1" class="input-hidden"  value="Visiting cards"
                                                @if($form->types && strpos($form->purpose ,'Visiting cards'))
                                                    checked
                                                @endif
                                            />
                                            <label for="purpose_1" class="logo_type">
                                                <img src="{{ asset('assets/img/Image 9.png') }}" alt="" />
                                            </label>
                                            <input 
                                                type="checkbox" name="purposes[]"
                                                id="purpose_2" class="input-hidden"  value="Social media"
                                                @if($form->types && strpos($form->purpose ,'Social media'))
                                                    checked
                                                @endif
                                            />
                                            <label for="purpose_2" class="logo_type">
                                                <img src="{{ asset('assets/img/Image 10.png') }}" alt="" />
                                            </label>
                                        </div>
                                        @if ($errors->has('purposes'))
                                        <div class="col-md-12 mt-30">
                                            <span class="error text-danger float-none" for="purposes">{{ $errors->first('purposes') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 8 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step9">
                                    <h2>@lang('form.choose_logo_color')</h2>
                                    <div class="row card-box mt-30">
                                        <div class="card col-md-3">
                                            <div class="card-body">
                                                <h4 class="card-title">Hoofdkleur</h4>
                                                <div class="form-group">
                                                    <input type="text" id="main_color" name="main_color" class="form-control color-picker" value="{{ $form->main_color ? $form->main_color : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card col-md-3">
                                            <div class="card-body">
                                                <h4 class="card-title">Subkleur 1</h4>
                                                <div class="form-group">
                                                    <input type="text" id="sub_color_1" name="sub_color_1" class="form-control color-picker" value="{{ $form->sub_color_1 ? $form->sub_color_1 : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card col-md-3">
                                            <div class="card-body">
                                                <h4 class="card-title">Subkleur 2</h4>
                                                <div class="form-group">
                                                    <input type="text" id="sub_color_2" name="sub_color_2" class="form-control color-picker" value="{{ $form->sub_color_2 ? $form->sub_color_2 : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group logo-color mb-30">
                                        
                                        <label for="logo_color"><input type="checkbox" name="logo_color" id="logo_color" {{$form->logo_color == 1? 'checked': ''}}>@lang('form.dont_know_logo')</label>
                                    </div>
                                    <div class="row no-mh">
                                        <h3 class="text-dark-light">@lang('app.logo_color_reference_file')</h3>
                                        <div class="form-group col-md-6 col-md-offset-3 {{ ($form->reference_color && media_file($form->reference_color)) ? 'hide' : '' }} mb-30">
                                            <input type="file" name="reference_color" class="form-control" id="reference_color">
                                        </div>
                                        @if ($form->reference_color && media_file($form->reference_color))
                                        <div class="form-group col-md-6 col-md-offset-3 reference-file">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ media_file($form->reference_color)->id }}"><span class="fa fa-close text-danger"></span></button>
                                                    <a href="{{ asset('uploads/' . media_file($form->reference_color)->media_name) }}" target="_blank">{{ media_file($form->reference_color)->media_name }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                    @if ($errors->has('main_color'))
                                    <div class="row no-mh">
                                        <div class="col-md-12 text-center">
                                            <div class="col-md-12 mb-30">
                                                <span class="error text-danger float-none" for="main_color">{{ $errors->first('main_color') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 9 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step10">
                                    <div class="row">
                                        <h2 class="text-dark-light mb-20"><strong>@lang('form.have_example_logo')</strong></h2>
                                        <h3 class="text-dark-light mb-30">@lang('form.empty_question_note')</h3>
                                        <div class="form-group col-md-6 col-md-offset-3 {{ $errors->has('inspiration_logo') ? ' has-danger' : '' }}">
                                            <textarea name="inspiration_logo" id="inspiration_logo" class="form-control" placeholder="Hier kun je anwijzingen geven of website linkjes zetten om ons op het goede spoor te zetten" rows="5">{{ $form->inspiration_logo ? $form->inspiration_logo : ''}}</textarea>
                                            @if ($errors->has('inspiration_logo'))
                                                <span class="error text-danger" for="inspiration_logo">{{ $errors->first('inspiration_logo') }}</span>
                                            @endif
                                        </div>
                                        @if ($logo_files->count() > 0)
                                        <div class="col-md-6 col-md-offset-3 form-group text-left">
                                            <h3>@lang('form.uploaded_files')</h3>
                                            <ul class="list-unstyled">
                                                @foreach ($logo_files as $file)
                                                <li>
                                                    <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $file->id }}"><span class="fa fa-close text-danger"></span></button>
                                                    <a href="{{ asset('uploads/' . $file->media_name) }}" target="_blank">{{ $file->media_name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <h3 class="text-left col-md-6 col-md-offset-3">@lang('form.example_logo_upload')</h3>
                                        <div class="logo-files mt-15">
                                            <div class="col-md-6 col-md-offset-3 form-group">
                                                <input type="file" name="logo_files[]" class="form-control" accept="">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-md-offset-3 mt-15">
                                            <div class="form-group text-left">
                                                <button type="button" class="btn-round btn-success no-border " id="more_file"><i class="fa fa-plus"></i></button><label for="more_file">&nbsp; Bestand toevoegen</label> 
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="submit" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.submit')</button></li>
                                    </ul>

                                    <div class="mt-30">
                                        <h4>Stap 10 van 10</h4>
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
    $(document).ready( function() {
        $('#more_file').on('click', function() {
            var html = '<div class="form-group col-md-6 col-md-offset-3"><input type="file" name="logo_files[]" class="form-control" accept=""><button type="button" class="btn btn-danger btn-link remove-file p-10"><span class="fa fa-close text-danger"></span></button></div>';
            $('.logo-files').append(html)
        });
    });
    $(document).on('click', '.remove-file', function() {
        $(this).closest('.form-group').remove();
    })
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
        $(this).closest('li').remove();
    })
    
  </script>
@endpush

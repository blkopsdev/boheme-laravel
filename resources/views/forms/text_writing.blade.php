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
                            </ul>
                        </div>

                        <form method="POST" enctype="multipart/form-data" action="" class="multistep">
                            <input type="hidden" name="quick_save" value="0" id="quick_save">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step0">
                                    <div class="tab-pane-title py-100">
                                        <h1 class="text-dark-light" style="font-size: 50px;">@lang('app.webteksten_briefing')</h1>
                                        <h2 class="text-dark-light" style="font-size: 30px;">{{$form->project->company_name}}</h2>
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
                                        <h2 class="text-dark-light col-md-12"><strong>@lang('form.the_market')</strong> @lang('form.market_question')</h2>
                                        <div class="form-group mt-30 col-md-8 col-md-offset-2 {{ $errors->has('market') ? ' has-danger' : '' }}">
                                            <textarea name="market" id="market" rows="5" placeholder="@lang('form.description_placeholder')">{{ $form->market ? $form->market : old('market') }}</textarea>
                                            @if ($errors->has('market'))
                                                <span class="error text-danger" for="market">{{ $errors->first('market') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="list-inline mt-30">
                                            <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                            <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                        </ul>
                                        <div class="mt-30">
                                            <h4>Stap 1 van 11</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light mb-50">@lang('form.usp_question') <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.usp_tooltip')"></i></h2>
                                        <div class="col-md-4 col-md-offset-4 usp {{ $errors->has('usp.0') ? ' has-danger' : '' }}">
                                            
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
                                        <div class="col-md-4 col-md-offset-4 mt-30">
                                            <span class="error text-danger" for="usp">{{ $errors->first('usp.0') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 2 van 11</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light">@lang('form.competitor_question')</h2>
                                        <div class="col-md-6 col-md-offset-3 competitors mt-30 {{ $errors->has('competitors.0') ? ' has-danger' : '' }}">
                                            @if($form->competitors && countArray(json_decode($form->competitors)) > 0)
                                                @foreach (json_decode($form->competitors) as $competitor)
                                                @if ($competitor)
                                                <div class="form-group">
                                                    <input type="text" name="competitors[]" class="input-default input-sm form-control input-full" value="{{ $competitor }}">
                                                </div>
                                                @endif
                                                @endforeach
                                            @else
                                            <div class="form-group">
                                                <input type="text" name="competitors[]" class="input-default input-sm form-control input-full" placeholder="1. http://www.domein.nl">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="competitors[]" class="input-default input-sm form-control input-full" placeholder="2. http://www.domein.nl">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="competitors[]" class="input-default input-sm form-control input-full" placeholder="3. http://www.domein.nl">
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 col-md-offset-3 mt-15 text-left">
                                            <button type="button" class="btn-round btn-success no-border" id="more_competitor"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="more_competitor">&nbsp;@lang('form.add_website')</label> 
                                        </div>
                                        @if ($errors->has('competitors.0'))
                                            <div class="col-md-6 col-md-offset-3 mt-15">
                                                <span class="error text-danger" for="competitors">{{ $errors->first('competitors.0') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 3 van 11</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <div class="row">
                                        <h2 class="text-dark-light">Waar moet de focus op liggen? <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.focus_tooltip')"></i></h2>
                                        <div class="form-group mt-30">
                                            <div class="btn-group focus mb-30 col-md-8 col-md-offset-2" data-toggle="buttons">
                                                <label class="btn btn-default btn-round @if (old('focus') && old('focus') == 0) active @elseif($form->focus == 0 && !old('focus')) active @endif">
                                                    <input type="radio" name="focus" value="0" autocomplete="off" @if (old('focus') && old('focus') == 0) checked @elseif($form->focus == 0 && !old('focus')) checked @endif>Contact opnemen
                                                </label>
                                                <label class="btn btn-default btn-round @if (old('focus') && old('focus') == 1) active @elseif($form->focus == 1 && !old('focus')) active @endif">
                                                    <input type="radio" name="focus" value="1" autocomplete="off" @if (old('focus') && old('focus') == 1) checked @elseif($form->focus == 1 && !old('focus')) checked @endif>Offerte aanvragen
                                                </label>
                                                <label class="btn btn-default btn-round @if (old('focus') && old('focus') == 2) active @elseif($form->focus == 2 && !old('focus')) active @endif">
                                                    <input type="radio" name="focus" value="2" autocomplete="off" @if (old('focus') && old('focus') == 2) checked @elseif($form->focus == 2 && !old('focus')) checked @endif>Afspraak maken
                                                </label>
                                                <label class="btn btn-default btn-round @if (old('focus') && old('focus') == 3) active @elseif($form->focus == 3 && !old('focus')) active @endif">
                                                    <input type="radio" name="focus" value="3" autocomplete="off" @if (old('focus') && old('focus') == 3) checked @elseif($form->focus == 3 && !old('focus')) checked @endif>Overig
                                                </label>
                                                <label class="btn btn-default btn-round @if (old('focus') && old('focus') == 4) active @elseif($form->focus == 4 && !old('focus')) active @endif">
                                                    <input type="radio" name="focus" value="4" autocomplete="off" @if (old('focus') && old('focus') == 4) checked @elseif($form->focus == 4 && !old('focus')) checked @endif>Uw portfolio
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 4 van 11</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step5">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light"><strong>@lang('form.your_customers')</strong> @lang('form.customer_question')</h2>
                                        <div class="form-group mt-30">
                                            <div class="col-md-8 col-md-offset-2 mt-30 mb-30 {{ $errors->has('customers') ? ' has-danger' : '' }}">
                                                <textarea name="customers" id="customers" rows="8" placeholder="@lang('form.description_placeholder')">{{ $form->customers ? $form->customers : old('customers') }}</textarea>
                                                @if ($errors->has('customers'))
                                                    <span class="error text-danger" for="customers">{{ $errors->first('customers') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 5 van 11</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step6">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light"><strong>@lang('form.wishes_and_needs')</strong> @lang('form.wishes_question')</h2>
                                        <div class="form-group mt-30">
                                            <div class="col-md-8 col-md-offset-2 mt-30 mb-30 {{ $errors->has('wishes') ? ' has-danger' : '' }}">
                                                <textarea name="wishes" id="wishes" rows="8" placeholder="@lang('form.description_placeholder')">{{ $form->wishes ? $form->wishes : old('wishes') }}</textarea>
                                                @if ($errors->has('wishes'))
                                                    <span class="error text-danger" for="wishes">{{ $errors->first('wishes') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 6 van 11</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step7">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light"><strong>@lang('form.your_answer')</strong> @lang('form.answer_question')</h2>
                                        <div class="form-group mt-30">
                                            <div class="col-md-8 col-md-offset-2 mt-30 mb-30 {{ $errors->has('concrete') ? ' has-danger' : '' }}">
                                                <textarea name="concrete" id="concrete" rows="8" placeholder="@lang('form.description_placeholder')">{{ $form->concrete ? $form->concrete : old('concrete') }}</textarea>
                                                @if ($errors->has('concrete'))
                                                    <span class="error text-danger" for="concrete">{{ $errors->first('concrete') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 7 van 11</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step8">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light"><strong>@lang('form.your_promise')</strong> @lang('form.promise_question')</h2>
                                        <div class="form-group mt-30">
                                            <div class="col-md-8 col-md-offset-2 mt-30 mb-30 {{ $errors->has('promise' ? 'has-danger' : '')}}">
                                                <textarea name="promise" id="promise" rows="8" placeholder="@lang('form.description_placeholder')">{{ $form->promise ? $form->promise : old('promise') }}</textarea>
                                                @if ($errors->has('promise'))
                                                    <span class="error text-danger" for="promise">{{ $errors->first('promise') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 8 van 11</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step9">
                                    <div class="row">
                                        <div class="feedback-forms col-md-12">
                                            <div class="row no-mh">
                                                <div class="col-md-12 mb-20 mt-30">
                                                    <h2 class="text-dark-light mb-15"><strong>@lang('form.enter_quidelines')</strong></h2>
                                                    <h3 class="text-dark-light">@lang('form.indicate_description')</h3>
                                                    <h3 class="text-dark-light"><strong>@lang('form.guidelines_note')</strong></h3>
                                                </div>
                                            </div>
                                            @if(($form->page_names && countArray(json_decode($form->page_names)) > 0) || ($form->guidelines && countArray(json_decode($form->guidelines)) > 0))
                                                @php
                                                    $pages = count(json_decode($form->page_names));
                                                    
                                                    $page_names = json_decode($form->page_names);
                                                    $guidelines = json_decode($form->guidelines);
                                                @endphp
                                                @for ($i = 0; $i < $pages; $i++)
                                                <div class="row">
                                                    @if ($i != 0)
                                                    <div class="col-md-12"><hr class="border-top-dash"></div>
                                                    @endif
                                                    <div class="col-md-2">
                                                        <span class="text-dark-light form-number">{{$i + 1}}</span>
                                                    </div>
                                                    <div class="col-md-8 page-form">
                                                        <div class="form-group">
                                                            <input type="text" name="page_names[]" class="input-md input-full page-name" placeholder="@lang('form.enter_page_name')" value="{{ $page_names[$i] ? $page_names[$i] : '' }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea name="guidelines[]" rows="5" class="page-guidline" placeholder="@lang('form.type_guidelines')">{{ $guidelines[$i] ? $guidelines[$i] : '' }}</textarea>
                                                        </div>
                                                        <div class="feedback-files text-left {{ $form->file($i) ? 'hide' : '' }}">
                                                            <h4>@lang('form.upload_photos_files')</h4>
                                                            <div class="form-group">
                                                                <input type="file" name="page_files[]" accept=".zip,.png,.jpg,.jpeg,.doc,.docx,.pdf" class="float-left page-file form-control">
                                                            </div>
                                                        </div>
                                                        @if ($form->file($i))
                                                        <div class="uploaded-files text-left">
                                                            <h4>@lang('form.uploaded_files')</h4>
                                                            <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file($i)->id }}"><span class="fa fa-close text-danger"></span></button>
                                                            <a href="{{ asset('uploads/' . $form->file($i)->media_name) }}" target="_blank">{{ $form->file($i)->media_name }}</a>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>  
                                                @endfor
                                            @else
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <span class="text-dark-light form-number">1</span>
                                                </div>
                                                <div class="col-md-8 page-form">
                                                    <div class="form-group">
                                                        <input type="text" name="page_names[]" class="input-md input-full page-name" placeholder="@lang('form.enter_page_name')" value="{{ old('page_names') ? old('page_names')[0] : '' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="guidelines[]" rows="5" class="page-guidline" placeholder="@lang('form.type_guidelines')">{{ old('guidlines') ? old('guidlines')[0] : '' }}</textarea>
                                                    </div>
                                                    <div class="feedback-files text-left">
                                                        <h4>@lang('form.upload_photos_files')</h4>
                                                        
                                                        <div class="form-group">
                                                            <input type="file" name="page_files[]" accept=".zip,.png,.jpg,.jpeg,.doc,.docx,.pdf" class="float-left page-file form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="add-extra-page mt-30 col-md-12 mb-20">
                                            <div class="row no-mh">
                                                <div class="col-md-8 col-md-offset-2 text-left">
                                                    <button type="button" class="btn btn-success btn-md btn-round" id="add_page">@lang('form.add_extra_page') +</button>
                                                </div>
                                            </div>

                                            @if ($errors->has('page_names.*') || $errors->has('guidelines.*'))
                                            <div class="col-md-8 col-md-offset-2">
                                                <span class="error text-danger" for="guidelines">@lang('form.guideline_error')</span> 
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 9 van 11</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step10">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light mb-20"><strong>@lang('form.working_method')</strong></h2>
                                        <h4 class="text-dark-light">@lang('form.indicate_working_method')</h4>
                                        <div class="form-group mt-30">
                                            <div class="col-md-8 col-md-offset-2 mt-30 mb-30 {{ $errors->has('working_method') ? 'has-danger' : '' }}">
                                                <textarea name="working_method" id="working_method" rows="10" placeholder="@lang('form.writing_working_method')">{{ $form->working_method ? $form->working_method : old('working_method') }}</textarea>
                                                @if ($errors->has('working_method'))
                                                    <span class="error text-danger" for="working_method">{{ $errors->first('working_method') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 10 van 11</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step11">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light">@lang('form.tone_of_voice')</h2>
                                        <h2 class="text-dark-light">@lang('form.visitor_question')</h2>
                                        <div class="form-group mt-30">
                                            <div class="col-md-8 col-md-offset-2 mt-30 mb-30 {{ $errors->has('visitor_description') ? 'has-danger' : '' }}">
                                                <textarea name="visitor_description" id="visitor_description" rows="8" placeholder="@lang('form.description_placeholder')">{{ $form->visitor_description ? $form->visitor_description : old('visitor_description') }}</textarea>
                                                @if ($errors->has('visitor_description'))
                                                    <span class="error text-danger" for="visitor_description">{{ $errors->first('visitor_description') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="submit" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.submit')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 11 van 11</h4>
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
    $(document).ready(function(){
        $(document).on('click', '#add_page', function() {
            var elems = $('.form-number')
            var last_elem = elems[elems.length - 1]
            var index = parseInt(last_elem.innerHTML) + 1
            var html = '<div class="row"><div class="col-md-12"><hr class="border-top-dash"></div><div class="col-md-2"><span class="text-dark-light form-number">'+index+'</span></div><div class="col-md-8 page-form"><div class="form-group"><input type="text" name="page_names[]" class="input-md input-full page-name" placeholder="@lang('form.enter_page_name')"></div><div class="form-group"><textarea name="guidelines[]" rows="5" class="page-guidline" placeholder="@lang('form.type_guidelines')"></textarea></div><div class="feedback-files text-left"><h4>@lang('form.upload_photos_files')</h4><div class="form-group"><input type="file" name="page_files[]" accept=".zip,.png,.jpg,.jpeg,.doc,.docx,.pdf" class="float-left page-file form-control"></div></div></div><div class="col-md-2"><button type="button" class="btn btn-danger btn-md btn-round delete-page mt-15" >Verwijderen</button></div></div>';
            $('.feedback-forms').append(html);
            var y = $(window).scrollTop();
            $('html, body').animate({
                scrollTop: y+300
            }, 300);
        });

        $(document).on('click', '#more_usp', function() {
            var html = '<div class="form-group"><input type="text" name="usp[]" class="input-default input-sm form-control"></div>';
            $('.usp').append(html);
        });

        $(document).on('click', '#more_competitor', function() {
            var html = '<div class="form-group"><input type="text" name="competitors[]" class="input-default input-sm form-control input-full"></div>';
            $('.competitors').append(html);
        });

    });
    
    $(document).on('click', '.delete-page', function() {
        $(this).closest('.row').remove();
        var elems = $('.form-number');
        for (let index = 0; index < elems.length; index++) {
            const element = elems[index];
            num = index + 1
            element.innerHTML = num;
        }
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
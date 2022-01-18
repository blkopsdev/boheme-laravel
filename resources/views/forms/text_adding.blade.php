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
                            </ul>
                        </div>

                        <form method="POST" enctype="multipart/form-data" action="" class="multistep">
                            <input type="hidden" name="quick_save" value="0" id="quick_save">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step0">
                                    <div class="tab-pane-title py-100">
                                        <h1 class="text-dark-light" style="font-size: 50px;">Bestanden aanleveren</h1>
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
                                        <h2 class="text-dark-light">Upload uw teksten</h2>
                                        <div class="col-md-6 col-md-offset-3 mt-30 mb-30">
                                            <div class="form-group mt-30">
                                                <textarea name="direct_text" id="direct_text" rows="5" class="form-control" placeholder="Type hier aanwijzingen of verduidelijkingen...">{{ old('direct_text', $form->direct_text) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-md-offset-3 text-left">
                                            @if ($form->file('text_file'))
                                            <div class="uploaded-files text-left">
                                                <h4>@lang('form.uploaded_files')</h4>
                                                <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('text_file')->id }}"><span class="fa fa-close text-danger"></span></button>
                                                <a href="{{ asset('uploads/' . $form->file('text_file')->media_name) }}" target="_blank">{{ $form->file('text_file')->media_name }}</a>
                                            </div>
                                            @endif
                                            <div class="form-group {{ $form->file('text_file') ? 'hide' : '' }}">
                                                <h3 class="text-dark-light ">
                                                    Hier kunt u uw tekst uploaden (.zip, .doc format):
                                                </h3>
                                                <input type="file" name="text_file" id="text_file" class="input-default float-left form-control" accept=".zip, .doc, .docx"><br><br>
                                            </div>
                                            @if ($errors->has('text_file'))
                                                <div class="row no-mh">
                                                    <div class="col-md-12">
                                                        <span class="text-danger error" for="text_file">{{ $errors->first('text_file') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            <h4 class="mt-30"><strong>Let op: geef duidelijk aan per pagina waarbij de tekst hoort, bijvoorbeeld:</strong></h4>
                                            <h4><strong>Home:</strong></h4>
                                            <h4>Teksten home</h4>
                                            <h4><strong>Over ons:</strong></h4>
                                            <h4>Teksten over ons</h4>
                                            <h4><strong>etc.</strong></h4>
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
                                        <h2 class="text-dark-light mb-50">Wat zijn de USP's (Unique Selling Points) van je bedrijf? <i class="fa fa-info-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.usp_tooltip')"></i></h2>
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
                                        <h4>Stap 2 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light">Wat zijn enkele titels die wij kunnen gebruiken op de website? <i class="fa fa-info-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.title_tooltip')"></i></h2>
                                        <div class="form-group col-md-8 col-md-offset-2 website-titles mt-30">
                                            @if ($form->titles && countArray(json_decode($form->titles)) > 0)
                                                @foreach (json_decode($form->titles) as $title)
                                                @if ($title)
                                                <div class="form-group">
                                                    <input type="text" name="titles[]" class="input-default input-sm form-control" value="{{ $title }}">
                                                </div>
                                                @endif
                                                @endforeach
                                            @else
                                                <div class="form-group">
                                                    <input type="text" name="titles[]" class="input-default input-sm form-control input-full" placeholder="1. Voorbeeld: Wij bieden online oplossingen voor het MKB">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="titles[]" class="input-default input-sm form-control input-full" placeholder="2. Voorbeeld: Bestel uw visum online en bespaar tot wel 35%!">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="titles[]" class="input-default input-sm form-control input-full" placeholder="3. Voorbeeld: Uw eigen advocaat: betrokken en breed inzetbaar">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-8 col-md-offset-2 mt-15 text-left">
                                            <button type="button" class="btn-round btn-success no-border ml-20" id="more_title"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="more_title">&nbsp;Titel toevoegen</label> 
                                        </div>
                                        @if ($errors->has('titles.0'))
                                            <div class="col-md-8 col-md-offset-2">
                                                <span class="text-danger error" for="titles">{{ $errors->first('titles.0') }}</span>
                                            </div>
                                        @endif
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
                                    <div class="row no-mh">
                                        <h2 class="mb-15 text-dark-light mt-30">Wilt u een <strong>team/personeel sectie</strong> op de website?</h2>
                                        <h4 class="text-dark-light mb-30">Mocht u eerder hebben gekozen om dit niet te integreren in de website kunt u hieronder op "nee drukken.</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <img src="{{ asset('assets/img/Image 15.png') }}" alt="" class="img-responsive">
                                        </div>
                                        <div class="form-group mt-30 col-md-12">
                                            <div class="btn-group team-section mt-30 mb-30" data-toggle="buttons">
                                                <label class="btn btn-default btn-round {{ $form->team == 1 ? 'active' : '' }}"  for="team_yes">
                                                    <input type="radio" name="team" value="1" id="team_yes" {{ $form->team == 1 ? 'checked' : '' }}> Ja
                                                </label>
                                                <label class="btn btn-default btn-round next-step {{ $form->team == 0 ? 'active' : '' }}" for="team_no">
                                                    <input type="radio" name="team" value="0" id="team_no" {{ $form->team == 0 ? 'checked' : '' }}> Nee
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 go-back-title {{ $form->team == 1 ? 'hide' : '' }}">
                                            <ul class="list-inline">
                                                <li><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row mb-30 team-info {{ $form->team == 0 ? 'hide' : '' }}">
                                        <div class="form-group col-md-8 col-md-offset-2 mt-30 text-left">
                                            <h3 class="text-dark-light text-left mb-30">Upload de bestanden van het team/personeel</h3>
                                            <textarea name="team_text" id="team_text" rows="5" class="form-control" placeholder="Type hier aanwijzingen of verduidelijkingen...">{{ old('team_text', $form->team_text) }}</textarea>
                                        </div>
                                        <div class="form-group col-md-8 col-md-offset-2 mt-30 text-left">
                                            <div class="row no-mh">
                                                <h3 class="text-dark-light col-md-12">
                                                    Hier kun je de namen een functie uploaden in een word .doc:
                                                </h3>
                                                <div class="col-md-12 {{ $form->file('team_doc') ? 'hide' : '' }}">
                                                    <input type="file" name="team_doc" id="team_doc" class="input-default float-left form-control" accept="doc, .docx">
                                                    @if ($errors->has('team_doc'))
                                                        <div class="col-md-8 col-md-offset-2">
                                                            <span class="text-danger error" for="team_doc">{{ $errors->first('team_doc')}}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                @if ($form->file('team_doc'))
                                                <div class="uploaded-files text-left col-md-12">
                                                    <h4>@lang('form.uploaded_files')</h4>
                                                    <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('team_doc')->id }}"><span class="fa fa-close text-danger"></span></button>
                                                    <a href="{{ asset('uploads/' . $form->file('team_doc')->media_name) }}" target="_blank">{{ $form->file('team_doc')->media_name }}</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col-md-8 col-md-offset-2 mt-30 text-left">
                                            <div class="row no-mh">
                                                <h3 class="text-dark-light col-md-12">
                                                    Upload hier de foto's van het personeel/team in een .zip format:
                                                </h3>
                                                <div class="col-md-12 {{ $form->file('team_photo') ? 'hide' : '' }}">
                                                    <input type="file" name="team_photo" id="team_photo" class="input-default float-left form-control" accept=".zip" value="{{ old('team_photo') }}">
                                                    @if ($errors->has('team_photo'))
                                                        <div class="col-md-8 col-md-offset-2">
                                                            <span class="text-danger error" for="team_photo">{{ $errors->first('team_photo')}}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                @if ($form->file('team_photo'))
                                                <div class="uploaded-files text-left col-md-12">
                                                    <h4>@lang('form.uploaded_files')</h4>
                                                    <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('team_photo')->id }}"><span class="fa fa-close text-danger"></span></button>
                                                    <a href="{{ asset('uploads/' . $form->file('team_photo')->media_name) }}" target="_blank">{{ $form->file('team_photo')->media_name }}</a>
                                                </div>
                                                @endif
                                            </div>
                                            
                                        </div>
                                        <div class="form-group col-md-8 col-md-offset-2 mt-30 text-left file-later">
                                            <label for="team_file_later" class="text-dark-light font-weight-default"> <input type="checkbox" name="team_file_later" id="team_file_later" {{ $form->team_file_later == 1 ? 'checked' : '' }}> Ik lever de bestanden later aan, gebruik voor nu voorbeeld content</label>
                                        </div>

                                        <div class="col-md-12">
                                            <ul class="list-inline mt-30">
                                                <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                                <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mt-30">
                                        <h4>Stap 4 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step5">
                                    <div class="row">
                                        <h2 class="mb-30 text-dark-light">Overige bestanden</h2>
                                        <h3 class="mt-30 text-dark-light">
                                            Upload hier de Algemene Voorwaarden (<strong>optioneel</strong>)
                                        </h3>
                                        <div class="form-group col-md-8 col-md-offset-2 mt-15">
                                            <div class="row no-mh">
                                                <div class="col-md-12 {{ $form->file('terms_file') ? 'hide' : '' }}">
                                                    <input type="file" name="terms_file" id="terms_file" class="form-control" accept="">
                                                </div>
                                                @if ($form->file('terms_file'))
                                                <div class="uploaded-files text-left col-md-12">
                                                    <h4>@lang('form.uploaded_files')</h4>
                                                    <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('terms_file')->id }}"><span class="fa fa-close text-danger"></span></button>
                                                    <a href="{{ asset('uploads/' . $form->file('terms_file')->media_name) }}" target="_blank">{{ $form->file('terms_file')->media_name }}</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-md-offset-2 mt-15 text-left">
                                            <h3 class="mt-30 text-dark-light">
                                                Overige bestanden die op de site geupload moeten worden (<strong>optioneel</strong>):
                                            </h3>
                                            <h4 class="text-dark-light mb-20">Voorbeelden: Disclaimer, Klachtenregelement, andere branche gerelateerde documenten</h4>
                                            <div class="row no-mh">
                                                @if ($form->file('other_file')->count() > 0)
                                                <div class="uploaded-files text-left col-md-12">
                                                    <h4>@lang('form.uploaded_files')</h4>
                                                    <ul class="list-unstyled">
                                                        @foreach ($form->file('other_file') as $other_file)
                                                        <li>
                                                            <button type="button" class="btn btn-danger btn-link  p-0 files-remove" data-id="{{ $other_file->id }}"><span class="fa fa-close text-danger"></span></button>
                                                            <a href="{{ asset('uploads/' . $other_file->media_name) }}" target="_blank">{{ $other_file->media_name }}</a>
                                                            @endforeach
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif

                                                <div class="mt-15 mb-15 other-files">
                                                    <div class="col-md-12 form-group">
                                                        <input type="file" name="other_file[]" class="other-file form-control" accept="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group text-left">
                                                        <button type="button" class="btn-round btn-success no-border add-other" id="add_optional_file"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="add_optional_file">&nbsp;Bestand toevoegen</label> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-2 mt-30">
                                                <textarea name="other_comment" id="other_comment" rows="5" placeholder="Opmerkingen of toelichting" class="form-control">{{ $form->other_comment ? $form->other_comment : old('other_comment') }}</textarea>
                                            </div>
                                        </div>
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
                                    <div class="row no-mh">
                                        <h2 class="mb-15 text-dark-light mb-30">Wilt u een review sectie op de website?</h2>
                                        <h4 class="text-dark-light mb-30">Mocht u eerder hebben gekozen om dit niet te integreren in de website kunt u hieronder op "nee drukken</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <img src="{{ asset('assets/img/Image 22.png') }}" alt="" class="img-responsive">
                                        </div>
                                        <div class="form-group mt-30 col-md-12">
                                            
                                            <div class="btn-group review-section mt-30 mb-30" data-toggle="buttons">
                                                <label class="btn btn-default btn-round {{ $form->review == 1 ? 'active' : '' }}" for="review_yes">
                                                    <input type="radio" name="review" value="1" id="review_yes" {{ $form->review == 1 ? 'checked' : '' }}> Ja
                                                </label>
                                                <label class="btn btn-default btn-round next-step {{ $form->review == 0 ? 'active' : '' }}" for="review_no">
                                                    <input type="radio" name="review" value="0" id="review_no" {{ $form->review == 0 ? 'checked' : '' }}> Nee
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 go-back-other {{  $form->review == 1 ? 'hide' : '' }}">
                                            <ul class="list-inline">
                                                <li><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row mb-30 review-info {{ $form->review == 0 ? 'hide' : '' }}">
                                        <div class="col-md-12">
                                            <hr class="border-top-dash">
                                        </div>
                                        <div class="form-group ">
                                            <div class="col-md-6 col-md-offset-3 mt-30">
                                                <h3 class="text-dark-light ">
                                                    Plak hier de link waar wij de reviews kunnen vinden:
                                                </h3>
                                                <input type="text" name="review_link" id="review_link" class="input-md input-full input-round" placeholder="http://www.domein.nl" value="{{ $form->review_link ? $form->review_link : old('review_link') }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-md-offset-3 mt-30">
                                            <h3 class="text-dark-light ">
                                                Of upload de reviews handmatig
                                            </h3>
                                            <div class="row no-mh">
                                                <div class="col-md-12 {{ $form->file('review_file') ? 'hide' : '' }}">
                                                    <input type="file" name="review_file" id="review_file" class="input-default input-sm form-control" accept=".zip, .doc, .docx">
                                                </div>
                                                @if ($form->file('review_file'))
                                                <div class="uploaded-files text-left col-md-12">
                                                    <h4>@lang('form.uploaded_files')</h4>
                                                    <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('review_file')->id }}"><span class="fa fa-close text-danger"></span></button>
                                                    <a href="{{ asset('uploads/' . $form->file('review_file')->media_name) }}" target="_blank">{{ $form->file('review_file')->media_name }}</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col-md-8 col-md-offset-2 text-left file-later">
                                            <label for="review_file_later" class="text-dark-light font-weight-default"><input type="checkbox" name="review_file_later" id="review_file_later" {{ $form->review_file_later == 1 ? 'checked' : '' }}> Ik lever de bestanden later aan, gebruik voor nu voorbeeld content</label>
                                        </div>
                                        <div class="col-md-12">
                                            <ul class="list-inline mt-30">
                                                <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                                <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mt-30">
                                        <h4>Stap 6 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step7">
                                    <div class="row no-mh">
                                        <h2 class="mt-30 mb-15 text-dark-light">Wilt u een <strong>portfolio sectie</strong> op de website?</h2>
                                        <h4 class="text-dark-light mb-30">Mocht u eerder hebben gekozen om dit niet te integreren in de website kunt u hieronder op "nee drukken</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <img src="{{ asset('assets/img/Image 25.png') }}" alt="" class="img-responsive">
                                        </div>
                                        <div class="form-group mt-30 col-md-12">
                                            <div class="btn-group portfolio-section mt-30 mb-30" data-toggle="buttons">
                                                <label class="btn btn-default btn-round {{ $form->portfolio == 1 ? 'active' : '' }}" for="portfolio_yes">
                                                    <input type="radio" name="portfolio" value="1" id="portfolio_yes" {{ $form->portfolio == 1 ? 'checked' : '' }}> Ja
                                                </label>
                                                <label class="btn btn-default btn-round next-step {{ $form->portfolio == 0 ? 'active' : '' }}" for="portfolio_no">
                                                    <input type="radio" name="portfolio" value="0" id="portfolio_no" {{ $form->portfolio == 0 ? 'checked' : '' }}> Nee
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 go-back-review {{ $form->portfolio == 1 ? 'hide' : '' }}">
                                            <ul class="list-inline">
                                                <li><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row mb-30 portfolio-info {{ $form->portfolio == 0 ? 'hide' : '' }}">
                                        <div class="col-md-12 mb-30">
                                            <hr class="border-top-dash">
                                        </div>
                                        <div class="form-group">
                                            <h3 class="text-dark-light mb-20">
                                                Plak hier de link waar wij de portfolio items kunnen vinden:
                                            </h3>
                                            <div class="col-md-6 col-md-offset-3">
                                                <input type="text" name="portfolio_link" id="portfolio_link" class="input-md input-full input-round" placeholder="http://www.domein.nl" value="{{ $form->portfolio_link ? $form->portfolio_link : old('portfolio_link') }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-md-offset-3 mt-30">
                                            <h3 class="text-dark-light ">
                                                Of upload de reviews handmatig
                                            </h3>
                                            <div class="row no-mh">
                                                <div class="col-md-12 {{ $form->file('portfolio_file') ? 'hide' : '' }}">
                                                    <input type="file" name="portfolio_file" id="portfolio_file" class="input-default input-sm form-control" accept=".zip, .doc, .docx">
                                                </div>
                                                @if ($form->file('portfolio_file'))
                                                <div class="uploaded-files text-left col-md-12">
                                                    <h4>@lang('form.uploaded_files')</h4>
                                                    <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('portfolio_file')->id }}"><span class="fa fa-close text-danger"></span></button>
                                                    <a href="{{ asset('uploads/' . $form->file('portfolio_file')->media_name) }}" target="_blank">{{ $form->file('portfolio_file')->media_name }}</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="col-md-8 col-md-offset-2 text-left mt-30 file-later">
                                                <label for="portfolio_file_later" class="text-dark-light font-weight-default"><input type="checkbox" name="portfolio_file_later" id="portfolio_file_later" {{ $form->portfolio_file_later ? 'checked' : '' }}> Ik lever de bestanden later aan, gebruik voor nu voorbeeld content</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <ul class="list-inline mt-30">
                                                <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                                <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mt-30">
                                        <h4>Stap 7 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step8">
                                    <div class="row no-mh">
                                        <h2 class="mt-30 mb-15 text-dark-light">Wilt u een <strong>Blog sectie</strong> op de website?</h2>
                                        <h4 class="text-dark-light mb-30">Mocht u eerder hebben gekozen om dit niet te integreren in de website kunt u hieronder op "nee drukken</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <img src="{{ asset('assets/img/Image 23.png') }}" alt="" class="img-responsive">
                                        </div>
                                        <div class="form-group mt-30 col-md-12">
                                            <div class="btn-group blog-section mt-30 mb-30" data-toggle="buttons">
                                                <label class="btn btn-default btn-round {{ $form->blog == 1 ? 'active' : '' }}" for="blog_yes">
                                                    <input type="radio" name="blog" value="1" id="blog_yes" {{ $form->blog == 1 ? 'checked' : '' }}> Ja
                                                </label>
                                                <label class="btn btn-default btn-round next-step {{ $form->blog == 0 ? 'active' : '' }}" for="blog_no">
                                                    <input type="radio" name="blog" value="0" id="blog_no" {{ $form->blog == 0 ? 'checked' : '' }}> Nee
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 go-back-portfolio {{ $form->blog == 1 ? 'hide' : '' }}">
                                            <ul class="list-inline">
                                                <li><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row mb-30 blog-info {{ $form->blog == 0 ? 'hide' : '' }}">
                                        <div class="col-md-12 mb-30">
                                            <hr class="border-top-dash">
                                        </div>
                                        <div class="form-group">
                                            <h3 class="text-dark-light mb-20">
                                                Plak hier de link waar wij de blog posts kunnen vinden:
                                            </h3>
                                            <div class="col-md-6 col-md-offset-3">
                                                <input type="text" name="blog_link" id="blog_link" class="input-md input-full input-round" placeholder="http://www.domein.nl" value="{{ $form->blog_link ? $form->blog_link : old('blog_link') }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-md-offset-3 mt-30">
                                            <h3 class="text-dark-light ">
                                                Of upload hier de foto's + bestanden van uw blog in een .zip
                                            </h3>
                                            <div class="row no-mh">
                                                <div class="col-md-12 {{ $form->file('blog_file') ? 'hide' : '' }}">
                                                    <input type="file" name="blog_file" id="blog_file" class="input-default input-sm form-control" accept=".zip, .doc, .docx">
                                                </div>
                                                @if ($form->file('blog_file'))
                                                <div class="uploaded-files text-left col-md-12">
                                                    <h4>@lang('form.uploaded_files')</h4>
                                                    <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('blog_file')->id }}"><span class="fa fa-close text-danger"></span></button>
                                                    <a href="{{ asset('uploads/' . $form->file('blog_file')->media_name) }}" target="_blank">{{ $form->file('blog_file')->media_name }}</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-2 text-left mt-30 file-later">
                                                <label for="blog_file_later" class="text-dark-light font-weight-default"><input type="checkbox" name="blog_file_later" id="blog_file_later" {{ $form->blog_file_later == 1 ? 'checked' : '' }}> Ik lever de bestanden later aan, gebruik voor nu voorbeeld content</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <ul class="list-inline mt-30">
                                                <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                                <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mt-30">
                                        <h4>Stap 8 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step9">
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
                                    <div class="col-md-12">
                                        <ul class="list-inline">
                                            <li><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        </ul>
                                    </div>
                                    <div class="mt-30">
                                        <h4>Stap 9 van 10</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step10">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light mb-30">Upload hier de foto's voor de website (.zip format): <i class="fa fa-info-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.website_image_tooltip')"></i></h2>
                                        <div class="form-group col-md-6 col-md-offset-3 mt-30 {{ $form->file('images_file') ? 'hide' : '' }}">
                                            <input type="file" name="images_file" id="images_file" class="input-default input-sm form-control" accept=".zip">
                                        </div>
                                        @if ($form->file('images_file'))
                                        <div class="uploaded-files text-left col-md-6 col-md-offset-3">
                                            <h4>@lang('form.uploaded_files')</h4>
                                            <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('images_file')->id }}"><span class="fa fa-close text-danger"></span></button>
                                            <a href="{{ asset('uploads/' . $form->file('images_file')->media_name) }}" target="_blank">{{ $form->file('images_file')->media_name }}</a>
                                        </div>
                                        @endif
                                        <div class="form-group col-md-6 col-md-offset-3 image-source mt-30">
                                            <label for="dev_image" class="text-dark-light font-weight-default"><input type="checkbox" name="dev_image" id="dev_image" value="1" {{ $form->dev_image == 1 ? 'checked' : '' }}> Ik heb alle foto's via jullie fotodatabase uitgezocht</label>
                                        </div>
                                        <div class="form-group col-md-8 col-md-offset-2 mt-30">
                                            <textarea name="explanation" id="explanation" rows="5" placeholder="Opmerkingen of toelichting">{{ $form->explanation ? $form->explanation : old('explanation') }}</textarea>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
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
    $(document).ready(function(){
        $('#more_usp').on('click', function() {
            var html = '<div class="form-group"><input type="text" name="usp[]" class="input-default input-sm form-control"></div>';
            $('.usp').append(html);
        });
        $('#more_title').on('click', function() {
            var html = '<div class="form-group"><input type="text" name="titles[]" class="input-default input-full input-sm form-control" placeholder="Voorbeeld: Uw eigen advocaat: betrokken en breed inzetbaar"></div>';
            $('.website-titles').append(html);
        });

        $('#add_optional_file').on('click', function() {
            var html = '<div class="col-md-12 form-group"><input type="file" name="other_file[]" class="other-file float-left form-control" accept=""><button type="button" class="btn btn-danger btn-link remove-other-file p-10"><span class="fa fa-close text-danger"></span></button></div>';
            $('.other-files').append(html);
        });

        $('.team-section .btn').click(function() {
            var value = $(this).find('input').val();
            if(value == 1) {
                $('.team-info').removeClass('hide');
                $('.go-back-title').addClass('hide');
            } else {
                $('.team-info').addClass('hide');
                $('.go-back-title').removeClass('hide');
            }
        });

        $('.review-section .btn').click(function() {
            var value = $(this).find('input').val();
            if(value == 1) {
                $('.review-info').removeClass('hide');
                $('.go-back-other').addClass('hide');
            } else {
                $('.review-info').addClass('hide');
                $('.go-back-other').removeClass('hide');
            }
        });
        $('.portfolio-section .btn').click(function() {
            var value = $(this).find('input').val();
            if(value == 1) {
                $('.portfolio-info').removeClass('hide');
                $('.go-back-review').addClass('hide');
            } else {
                $('.portfolio-info').addClass('hide');
                $('.go-back-review').removeClass('hide');
            }
        });
        $('.blog-section .btn').click(function() {
            var value = $(this).find('input').val();
            if(value == 1) {
                $('.blog-info').removeClass('hide');
                $('.go-back-portfolio').addClass('hide');
            } else {
                $('.blog-info').addClass('hide');
                $('.go-back-portfolio').removeClass('hide');
            }
        });
    });
    
    $(document).on('click', '.remove-other-file', function() {
        $(this).parent('.form-group').remove();
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

    $(document).on('click', '.files-remove', function() {
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
        $(this).closest('li').remove();
    })
    
</script>
@endpush
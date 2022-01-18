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
                            </ul>
                        </div>

                        <form method="POST" enctype="multipart/form-data" action="" class="multistep">
                            <input type="hidden" name="quick_save" value="0" id="quick_save">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step0">
                                    <div class="tab-pane-title py-100">
                                        <h1 class="text-dark-light" style="font-size: 50px;">Content aanleveren</h1>
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
                                        <h2 class="text-dark-light">Upload jouw producten</h2>
                                        <h4><strong>Let op: het is belangerijk dat wij de producten op de juiste manier aangeleverd krijgen.</strong></h4>
                                        <div class="col-md-8 col-md-offset-2 mb-30 text-left">
                                            <a href="https://www.iqscript.nl/wp-content/uploads/2020/12/Product-lijst-template.xlsx" class="text-success" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Download hier het juiste format</a>
                                            <div class="form-group mt-30">
                                                <textarea name="description" id="description" rows="5" class="form-control" placeholder="Type hier aanwijzingen of verduidelijkingen...">{{ $form->description ? $form->description : old('description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row no-mh">
                                                <div class="col-md-8 col-md-offset-2 text-left">
                                                    <h3 class="mt-30 text-dark-light ">
                                                    @lang('form.upload_excel_doc'):
                                                    </h3>
                                                    <p><strong>Het is van belang dat u de informatie upload in de juiste format, zie hierboven.</strong></p>
                                                </div>
                                                @if ($form->file('products_file'))
                                                <div class="uploaded-files text-left col-md-8 col-md-offset-2">
                                                    <h4>@lang('form.uploaded_files')</h4>
                                                    <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('products_file')->id }}"><span class="fa fa-close text-danger"></span></button>
                                                    <a href="{{ asset('uploads/' . $form->file('products_file')->media_name) }}" target="_blank">{{ $form->file('products_file')->media_name }}</a>
                                                </div>
                                                @endif
                                                <div class="form-group col-md-8 col-md-offset-2 {{ $form->file('products_file') ? 'hide' : '' }}">
                                                    <input type="file" name="products_file" id="products_file" class="input-default float-left form-control" accept=".xlsx,.csv,.json, .docx, .doc" ><br><br>
                                                    @if ($errors->has('products_file'))
                                                    <div class="row no-mh">
                                                        <div class="col-md-12">
                                                            <span class="text-danger error" for="products_file">{{ $errors->first('products_file') }}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row no-mh">
                                                <div class="col-md-8 col-md-offset-2 text-left mt-20">
                                                    <h3 class="mt-30 text-dark-light ">
                                                    @lang('form.upload_products_images'):
                                                    </h3>
                                                </div>
                                                @if ($form->file('products_image'))
                                                <div class="uploaded-files text-left col-md-8 col-md-offset-2">
                                                    <h4>@lang('form.uploaded_files')</h4>
                                                    <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('products_image')->id }}"><span class="fa fa-close text-danger"></span></button>
                                                    <a href="{{ asset('uploads/' . $form->file('products_image')->media_name) }}" target="_blank">{{ $form->file('products_image')->media_name }}</a>
                                                </div>
                                                @endif
                                                <div class="form-group col-md-8 col-md-offset-2 {{ $form->file('products_image') ? 'hide' : '' }}">
                                                    <input type="file" name="products_image" id="products_image" class="input-default float-left form-control" accept="" value="{{ old('products_image') }}"><br><br>
                                                    @if ($errors->has('products_image'))
                                                    <div class="row no-mh">
                                                        <div class="col-md-12">
                                                            <span class="text-danger error" for="products_image">{{ $errors->first('products_image') }}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 1 van 8</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light mb-30">Wat zijn de USP's (Unique Selling Points) van je bedrijf? <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.usp_tooltip')"></i></h2>
                                        <h4><strong>Denk aan: Gratis verzending, voor 16:00 besteld de volgende dag in huis etc.</strong></h4>
                                        <div class="col-md-4 col-md-offset-4 usp">
                                            
                                            @if ($form->usps && countArray(json_decode($form->usps)) > 0)
                                            @foreach (json_decode($form->usps) as $usp)
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
                                        <h4>Stap 2 van 8</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="row">
                                        <h2 class="mb-30 text-dark-light">Overige bestanden</h2>
                                        <div class="form-group col-md-8 col-md-offset-2 mt-15">
                                            <h3 class="mt-30 text-dark-light text-left">
                                                Upload hier de Algemene Voorwaarden (<strong>optioneel</strong>)
                                            </h3>
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
                                            <h4 class="text-dark-light">Voorbeelden: Disclaimer, Klachtenregelement, andere branche gerelateerde documenten</h4>
                                            <div class="row no-mh">
                                                @if ($form->file('other_file')->count() > 0)
                                                <div class="uploaded-files text-left col-md-12">
                                                    <h4>@lang('form.uploaded_files')</h4>
                                                    <ul class="list-unstyled">
                                                        @foreach ($form->file('other_file') as $other_file)
                                                        <li>
                                                            <button type="button" class="btn btn-danger btn-link p-0 files-remove" data-id="{{ $other_file->id }}"><span class="fa fa-close text-danger"></span></button>
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
                                                <textarea name="other_comment" id="other_comment" rows="5" placeholder="Opmerkingen of toelichting">{{ $form->other_comment ? $form->other_comment : old('other_comment') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 3 van 8</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step4">
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
                                        <div class="col-md-12 go-back-other {{ $form->review == 1 ? 'hide' : '' }}">
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
                                        @if ($errors->has('review_field'))
                                        <div class="col-md-8 col-md-offset-2">
                                            <span class="text-danger error" for="review_field">{{ $errors->first('review_field') }}</span>
                                        </div>
                                        @endif
                                        <div class="col-md-12">
                                            <ul class="list-inline mt-30">
                                                <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                                <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mt-30">
                                        <h4>Stap 4 van 8</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step5">
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
                                        <h4>Stap 5 van 8</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step6">
                                    <div class="row mt-30">
                                        <h2 class="text-dark-light">@lang('form.other_pages_text'):</h2>
                                        <div class="col-md-12">
                                            <div class="other-pages">
                                                @if (($form->pages && countArray(json_decode($form->pages)) > 0) || ($form->page_descriptions && countArray(json_decode($form->page_descriptions)) > 0))
                                                    @php
                                                        $pages = json_decode($form->pages);
                                                        $page_descriptions = json_decode($form->page_descriptions);
                                                    @endphp
                                                    @for ($i = 0; $i < count(json_decode($form->pages)); $i++) 
                                                    <div class="row other-page">
                                                        @if ($i != 0)
                                                        <div class="col-md-12"><hr class="border-top-dash"></div>
                                                        @endif
                                                        <div class="col-md-2 mt-30">
                                                            <span class="text-dark-light form-number">{{ $i + 1 }}</span>
                                                        </div>
                                                        <div class="col-md-8 mt-30">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" name="pages[]" class="input-md input-full page-name form-control" placeholder="@lang('form.enter_page_title')" value="{{ isset($pages[$i]) ? $pages[$i] : '' }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <textarea name="page_descriptions[]" rows="5" placeholder="@lang('form.description_placeholder')" class="form-control">{{ isset($page_descriptions[$i]) ? $page_descriptions[$i] : '' }}</textarea>
                                                                    </div>
                                                                    <div class="page-files text-left mt-20 row no-mh">
                                                                        <h4 class="text-left col-md-12">@lang('form.upload_text_files')</h4>
                                                                        @if ($form->files($i)->count() > 0)
                                                                        <div class="uploaded-files text-left col-md-12">
                                                                            <h4>@lang('form.uploaded_files')</h4>
                                                                            <ul class="list-unstyled">
                                                                                @foreach ($form->files($i) as $file)
                                                                                <li>
                                                                                    <button type="button" class="btn btn-danger btn-link  p-0 files-remove" data-id="{{ $file->id }}"><span class="fa fa-close text-danger"></span></button>
                                                                                    <a href="{{ asset('uploads/' . $file->media_name) }}" target="_blank">{{ $file->media_name }}</a>
                                                                                    @endforeach
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group col-md-12">
                                                                            <input type="file" name="page_files[{{ $i }}][]" class="float-left form-control" accept="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-12 text-left">
                                                                        <label><button type="button" class="btn-round btn-success no-border add-file"><i class="fa fa-plus"></i></button>&nbsp; Bestand toevoegen</label> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            @if ($i != 0 )
                                                            <button type="button" class="btn btn-danger btn-md btn-round delete-page" >Verwijderen</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @endfor
                                                @else
                                                    <div class="row other-page">
                                                        <div class="col-md-2 mt-30">
                                                            <span class="text-dark-light form-number">1</span>
                                                        </div>
                                                        <div class="col-md-8 mt-30">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" name="pages[]" class="input-md input-full page-name form-control" placeholder="@lang('form.enter_page_title')">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <textarea name="page_descriptions[]" rows="5" placeholder="@lang('form.description_placeholder')" class="form-control"></textarea>
                                                                    </div>
                                                                    <div class="page-files text-left mt-20 row no-mh">
                                                                        <h4 class="text-left col-md-12">@lang('form.upload_text_files')</h4>
                                                                        <div class="form-group col-md-12">
                                                                            <input type="file" name="page_files[0][]" class="float-left form-control" accept="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-12 text-left">
                                                                        <label><button type="button" class="btn-round btn-success no-border add-file"><i class="fa fa-plus"></i></button>&nbsp; Bestand toevoegen</label> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="add-extra-page mt-30">
                                                <div class="row no-mh">
                                                    <div class="col-md-8 col-md-offset-2 text-left">
                                                        <button type="button" class="btn btn-success btn-md btn-round" id="add_page">@lang('form.add_extra_page') +</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('pages.*'))
                                    <div class="row no-mh">
                                        <div class="col-md-8 col-md-offset-2">
                                            <span class="text-danger error" for="page_names">{{ $errors->first('pages.*') }}</span>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row mh mt-30">
                                        <div class="col-md-12">
                                            <ul class="list-inline">
                                                <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                                <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                            </ul>
                                            <div class="mt-30">
                                                <h4>Stap 6 van 8</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step7">
                                    <div class="row mt-30">
                                        <h2 class="text-dark-light mb-10">Upload hier de foto's voor de website (.zip format): <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.website_image_tooltip')"></i></h2>
                                        @if ($form->file('website_image'))
                                        <div class="uploaded-files text-left col-md-6 col-md-offset-3">
                                            <h4>@lang('form.uploaded_files')</h4>
                                            <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file('website_image')->id }}"><span class="fa fa-close text-danger"></span></button>
                                            <a href="{{ asset('uploads/' . $form->file('website_image')->media_name) }}" target="_blank">{{ $form->file('website_image')->media_name }}</a>
                                        </div>
                                        @endif
                                        <div class="form-group col-md-6 col-md-offset-3 mt-30 {{ $form->file('website_image') ? 'hide' : '' }}">
                                            <input type="file" name="website_image" id="website_image" class="input-default input-sm form-control" accept=".zip">
                                        </div>
                                        <div class="form-group col-md-6 col-md-offset-3 image-source text-left mt-15">
                                            <label for="website_image_source" class="text-dark-light font-weight-default"><input type="checkbox" name="website_image_source" id="website_image_source" value="1" {{ $form->website_image_source == 1 ? 'checked' : '' }}> Ik heb alle foto's via jullie fotodatabase uitgezocht</label>
                                        </div>
                                        @if ($errors->has('image_source'))
                                        <div class="col-md-6 col-md-offset-3">
                                            <span class="text-danger error" for="image_source">{{ $errors->first('image_source') }}</span>
                                        </div>
                                        @endif
                                        <div class="form-group col-md-6 col-md-offset-3 mt-30">
                                            <textarea name="website_image_comment" id="website_image_comment" rows="5" placeholder="Opmerkingen of toelichting">{{ $form->website_image_comment ? $form->website_image_comment : old('website_image_comment') }}</textarea>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 7 van 8</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step8">
									<div class="row mb-30 no-mh mt-30">
										<h2 class="text-dark-light mb-30">@lang('form.mollie_api_keys')</h2>
									</div>
									<div class="row mb-50 no-mh">
										<div class="col-md-6 col-md-offset-3 form-group">
											<input type="text" name="payment_live_key" id="payment_live_key" class="input-md" placeholder="@lang('form.enter_live_key')" value="{{ $form->payment_live_key ? $form->payment_live_key : old('payment_live_key') }}">
											@if ($errors->has('payment_live_key'))
												<span class="error text-danger" for="payment_live_key">{{ $errors->first('payment_live_key') }}</span>
											@endif
										</div>
										<div class="col-md-6 col-md-offset-3 form-group">
											<input type="text" name="payment_test_key" id="payment_test_key" class="input-md" placeholder="@lang('form.enter_test_key')" value="{{ $form->payment_test_key ? $form->payment_test_key : old('payment_test_key') }}">
											@if ($errors->has('payment_test_key'))
												<span class="error text-danger" for="payment_test_key">{{ $errors->first('payment_test_key') }}</span>
											@endif
                                        </div>
                                        <div class="col-md-6 col-md-offset-3 mt-20">
                                            <h4><a href="https://www.iqscript.nl/uitleg-mollie/" class="text-success" target="_blank"><i class="fa fa-question-circle" aria-hidden="true"></i> Waar kan ik deze sleutels vinden?</a></h4>
                                        </div>
									</div>
									<ul class="list-inline">
										<li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
										<li class="mb-10"><button type="submit" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.submit')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 8 van 8</h4>
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
            var html = '<div class="form-group"><input type="text" name="titles[]" class="input-default input-full input-sm" placeholder="Voorbeeld: Uw eigen advocaat: betrokken en breed inzetbaar"></div>';
            $('.website-titles').append(html);
        });

        $('#add_optional_file').on('click', function() {
            var html = '<div class="col-md-12 form-group"><input type="file" name="other_file[]" class="other-file float-left form-control" accept=""><button type="button" class="btn btn-danger btn-link remove-other-file p-10"><span class="fa fa-close text-danger"></span></button></div>';
            $('.other-files').append(html);
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

        
    });

    $(document).on('click', '#add_page', function() {
        var elems = $('.form-number')
        var last_elem = elems[elems.length - 1]
        var index = parseInt(last_elem.innerHTML) + 1
        var html = '<div class="row mt-20 other-page"><div class="col-md-12 top-border"></div><div class="col-md-2 mt-30"><span class="text-dark-light form-number">'+index+'</span></div><div class="col-md-8 mt-30"><div class="row"><div class="col-md-12"><div class="form-group"><input type="text" name="pages[]" class="input-md input-full page-name form-control" placeholder="@lang('form.enter_page_title')"></div><div class="form-group"><textarea name="page_descriptions[]" rows="5" class="form-control" placeholder="@lang('form.description_placeholder')"></textarea></div><div class="page-files text-left mt-20 row no-mh"><h4 class="text-left col-md-12">@lang('form.upload_text_files')</h4><div class="form-group col-md-12"><input type="file" name="page_files['+ (index - 1) +'][]" class="float-left form-control" accept=""></div></div><div class="form-group col-md-12 text-left"><label><button type="button" class="btn-round btn-success no-border add-file"><i class="fa fa-plus"></i></button>&nbsp; Bestand toevoegen</label></div></div></div></div><div class="col-md-2 mt-30 text-center"><button type="button" class="btn btn-danger btn-md btn-round delete-page" >Verwijderen</button></div></div>';
        $('.other-pages').append(html);
        
        var y = $(window).scrollTop();
        $('html, body').animate({
            scrollTop: y+300
        }, 300);
    });

    $(document).on('click', '.delete-page', function() {
        $(this).closest('.row').remove();
        var elems = $('.form-number');
        for (let index = 0; index < elems.length; index++) {
            const element = elems[index];
            element.innerHTML = index + 1;
            $(element).closest('.other-page').find('input[type="file"]').each(function() {
                $(this).attr('name', 'page_files[' + index + '][]');
            })
        }
    });

    $(document).on('click', '.add-file', function() {
        index = $(this).closest('.other-page').find('.form-number').html()
        
        html = '<div class="form-group col-md-12"><input type="file" name="page_files[' + (index-1) + '][]" class="float-left form-control" accept=""><button type="button" class="btn btn-danger btn-link remove-file p-10"><span class="fa fa-close text-danger"></span></button></div>'
        var content = $(this).closest('.other-page').find('.page-files');
        content.append(html)
    });

    $(document).on('click', '.remove-other-file', function() {
        $(this).parent('.form-group').remove();
    });

    $(document).on('click', '.remove-file', function() {
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
</script>
@endpush
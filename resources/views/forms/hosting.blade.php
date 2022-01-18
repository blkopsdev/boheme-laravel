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
                            </ul>
                        </div>

                        <form method="POST" enctype="multipart/form-data" action="" class="multistep">
                            <input type="hidden" name="quick_save" value="0" id="quick_save">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step0">
                                    <div class="tab-pane-title py-100">
                                        <h1 class="text-dark-light" style="font-size: 50px;">@lang('app.hosting')</h1>
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
                                    <div class="row hosting {{ $form->hosting != 0 ? 'hide' : '' }}">
                                        <h2 class="text-dark-light mb-30">@lang('form.want_host_with_us')</h2>
                                        <div class="col-md-8 col-md-offset-2 text-left">
                                            <h4><strong>Voordelen:</strong></h4>
                                            <p><i class="fa fa-check-circle check-icon mr-15 text-success" aria-hidden="true"></i>Zorg dat uw website razendsnel blijft door onze optimalisaties</p>
                                            <p><i class="fa fa-check-circle check-icon mr-15 text-success" aria-hidden="true"></i>Wij maken wekelijks backups waardoor u <strong>garantie heeft op de website</strong></p>
                                            <p><i class="fa fa-check-circle check-icon mr-15 text-success" aria-hidden="true"></i>Bij het onderhoud van de website komt GRATIS service. U kunt ons ten alle tijden opbellen met vragen!</p>
                                            <p><i class="fa fa-check-circle check-icon mr-15 text-success" aria-hidden="true"></i>Uw website is ten alle tijden AVG Proof!</p>
                                            <p><i class="fa fa-check-circle check-icon mr-15 text-success" aria-hidden="true"></i>Premium beveiliging van uw gegevens.</p>
                                            <p class="mt-30"><i class="fa fa-question-circle mr-15 text-success" aria-hidden="true" style="font-size: 20px;"></i> <a href="https://www.iqscript.nl/wat-is-hosting/" target="_blank" class="text-success">Wat is hosting?</a></p>
                                        </div>
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group mt-30">
                                                <div class="btn-group mt-30 mb-30" data-toggle="buttons">
                                                    <label class="btn btn-default btn-round {{ $form->hosting == 1 ? 'active' : '' }}" for="hosting_yes">
                                                        <input type="radio" name="hosting" value="1" id="hosting_yes" {{ $form->hosting == 1 ? 'checked' : '' }}> Ja
                                                    </label>
                                                    <label class="btn btn-default btn-round {{ $form->hosting == 2 ? 'active' : '' }}" for="hosting_no">
                                                        <input type="radio" name="hosting" value="2" id="hosting_no" {{ $form->hosting == 2 ? 'active' : '' }}> Nee
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hosting-yes {{ $form->hosting != 1 ? 'hide' : '' }}">
                                        <div class="row hosting-table">
                                            <h3 class="text-dark-light">@lang('form.thankyou_trust_us')</h3>
                                            <h3 class="text-dark-light"><strong>@lang('form.choose_package')</strong></h3>
                                            <div class="col-md-12 mb-30">
                                                <div class="pricing-table row mt-30">
                                                    <table class="col-md-12 table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td style="padding: 5px 0;"><span class="text-white most-popular">Meest gekozen</span></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-3 border-top-no vertical-middle"><h3><strong>Hosting + onderhoud</strong></h3></td>
                                                                <td class="col-md-3 border-top-no">
                                                                    <h4><strong>Basic</strong></h4>
                                                                    <p>Razendsnelle hosting</p>
                                                                    <h3 class="pricing"><strong><sup>€</sup>9<sup>.95</sup></strong><sub>/maand</sub></h3>
                                                                </td>
                                                                <td class="col-md-3 border-top-no">
                                                                    <h4><strong>Premium</strong></h4>
                                                                    <p>Een website met garantie</p>
                                                                    <h3 class="pricing"><strong><sup>€</sup>19<sup>.95</sup></strong><sub>/maand</sub></h3>
                                                                </td>
                                                                <td class="col-md-3 border-top-no">
                                                                    <h4><strong>Professional</strong></h4>
                                                                    <p>Premium service</p>
                                                                    <h3 class="pricing"><strong><sup>€</sup>29<sup>.95</sup></strong><sub>/maand</sub></h3>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="odd">
                                                                <td class="text-left"><h4 class="mb-0 mt-0"><strong>Algemeen</strong></h4></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr class="even">
                                                                <td class="text-left">Opslag ruimte</td>
                                                                <td>2GB</td>
                                                                <td>3GB</td>
                                                                <td>3GB+</td>
                                                            </tr>
                                                            <tr class="odd">
                                                                <td class="text-left">SSL certificaat</td>
                                                                <td>€ 39 / jaar</td>
                                                                <td>Inbegrepen</td>
                                                                <td>Inbegrepen</td>
                                                            </tr>
                                                            <tr class="even">
                                                                <td class="text-left"><h4 class="mb-0 mt-0"><strong>Service</strong></h4></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr class="odd">
                                                                <td class="text-left">Website Garantie</td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                            </tr>
                                                            <tr class="even">
                                                                <td class="text-left">Service Desk toegang</td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                            </tr>
                                                            <tr class="odd">
                                                                <td class="text-left">Snelheid & Database optimalisatie</td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                            </tr>
                                                            <tr class="even">
                                                                <td class="text-left">Maandelijkse backups</td>
                                                                <td><i class="fa fa-times-circle times-icon" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                            </tr>
                                                            <tr class="odd">
                                                                <td class="text-left">Updaten Plugins/Wordpress</td>
                                                                <td><i class="fa fa-times-circle times-icon" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                            </tr>
                                                            <tr class="even">
                                                                <td class="text-left">Whatsapp contact</td>
                                                                <td><i class="fa fa-times-circle times-icon" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-times-circle times-icon" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                            </tr>
                                                            <tr class="odd">
                                                                <td class="text-left">Kleine aanpassingen doorvoeren</td>
                                                                <td><i class="fa fa-times-circle times-icon" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-times-circle times-icon" aria-hidden="true"></i></td>
                                                                <td><i class="fa fa-check-circle check-icon text-success" aria-hidden="true"></i></td>
                                                            </tr>
                                                            <tr class="even">
                                                                <td></td>
                                                                <td>
                                                                    <div class="btn-group choose-plan" data-toggle="buttons">
                                                                        <label class="btn btn-default btn-round {{ $form->type == 1 ? 'active' : '' }}" for="type_1" dava-value="Basic">
                                                                            <input type="radio" name="type" value="1" id="type_1" {{ $form->type == 1 ? 'checked' : '' }}> @lang('form.select')
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group choose-plan" data-toggle="buttons">
                                                                        <label class="btn btn-default btn-round {{ $form->type == 2 ? 'active' : '' }}" for="type_2" data-value="Premium">
                                                                            <input type="radio" name="type" value="2" id="type_2" {{ $form->type == 2 ? 'active' : '' }}> @lang('form.select')
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group choose-plan" data-toggle="buttons">
                                                                        <label class="btn btn-default btn-round {{ $form->type == 3 ? 'active' : '' }}" for="type_3" data-value="Professional">
                                                                            <input type="radio" name="type" value="3" id="type_3" {{ $form->type == 3 ? 'checked' : '' }}> @lang('form.select')
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @if ($form->hosting != 1)
                                            <button type="button" class="btn btn-dark-light btn-lg btn-round mt-30 go-hosting" id="go_hosting">@lang('app.go_back')</button>
                                            @endif
                                            
                                        </div>
                                        <div class="row hosting-info {{ $form->hosting != 1 ? 'hide' : '' }}">
                                            <h2 class="text-dark-light">Automatische incasso hosting</h2>
                                            <div class="col-md-6 col-md-offset-3 mt-30">
                                                <div class="form-group">
                                                    <input type="text" name="bank_info" id="bank_info" class="input-default input-sm form-control input-full" placeholder="Uw bankrekening" value="{{ $form->bank_info ? $form->bank_info : old('bank_info') }}">
                                                    @if ($errors->has('bank_info'))
                                                    <div class="row no-mh">
                                                        <div class="col-md-12">
                                                            <span class="error text-danger">{{ $errors->first('bank_info') }}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="tav" id="tav" class="input-default input-sm form-control input-full" placeholder="T.a.v" value="{{ $form->tav ? $form->tav : old('tav') }}">
                                                    @if ($errors->has('tav'))
                                                    <div class="row no-mh">
                                                        <div class="col-md-12">
                                                            <span class="error text-danger">{{ $errors->first('tav') }}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="form-group text-left mt-30">
                                                    <label for="agree_terms" class="text-dark-light"><input type="checkbox" name="agree_terms" id="agree_terms" {{ $form->agree_terms == 1 ? 'checked' : '' }} value="1"> Ik ga akkoord met de <a href="https://www.iqscript.nl/wp-content/uploads/2020/08/Algemene-voorwaarden-IQ-Script.pdf" target="_blank">Algemene Voorwaarden</a></label>
                                                    @if ($errors->has('agree_terms'))
                                                    <div class="row no-mh">
                                                        <div class="col-md-12">
                                                            <span class="error text-danger">{{ $errors->first('agree_terms') }}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="form-group text-left">
                                                    <label for="agree_cost" class="text-dark-light"><input type="checkbox" name="agree_cost" id="agree_cost" {{ $form->agree_fee == 1 ? 'checked' : '' }} value="1"> Ik ga akkoord met de maandelijkse incasso</label>
                                                    @if ($errors->has('agree_cost'))
                                                    <div class="row no-mh">
                                                        <div class="col-md-12">
                                                            <span class="error text-danger">{{ $errors->first('agree_cost') }}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="ssl-notes text-left mt-30">
                                                    <h4>
                                                        <img src="{{ asset('assets/img/lock.png') }}" width=40 alt="" class="mr-15">
                                                        <span class="text-dark-light">Dit formulier is SSL beveiligd, <strong>uw gegevens zijn veilig</strong></span>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-md-offset-3">
                                                <ul class="list-inline mt-30">
                                                    <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round go-hosting">@lang('app.go_back')</button></li>
                                                    <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step validate-step">@lang('app.proceed')</button></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hosting-no {{ $form->hosting != 2 ? 'hide' : '' }}">
                                        <div class="row mb-30">
                                            <div class="col-md-8 col-md-offset-2 has-website">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h2 class="text-dark-light mb-30">@lang('form.have_wordpress_site')</h2>
                                                        <div class="form-group mt-30">
                                                            <div class="btn-group have-site mt-30 mb-30" data-toggle="buttons">
                                                                <label class="btn btn-default btn-round {{ $form->have_site == 1 ? 'active' : '' }}" for="have_site_yes">
                                                                    <input type="radio" name="have_site" value="1" id="have_site_yes" {{ $form->have_site == 1 ? 'checked' : '' }}> Ja
                                                                </label>
                                                                <label class="btn btn-default btn-round {{ $form->have_site == 0 ? 'active' : '' }}" for="have_site_no">
                                                                    <input type="radio" name="have_site" value="0" id="have_site_no" {{ $form->have_site == 0 ? 'checked' : '' }}> Nee
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row no-mh">
                                                    <div class="col-md-12">
                                                        <ul class="list-inline mt-30">
                                                            <li><button type="button" class="btn btn-dark-light btn-lg btn-round go-hosting">@lang('app.go_back')</button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2 aware-cost mt-30 hide">
                                                <h3 class="text-dark-light mb-30">@lang('form.wordpress_with_other_hosting')</h3>
                                                <h3 class="text-dark-light mb-30">@lang('form.aware_this')</h3>
                                                <div class="form-group mt-30">
                                                    <div class="btn-group domain-register mt-30 mb-30" data-toggle="buttons">
                                                        <label class="btn btn-default btn-round next-step {{ $form->aware_cost == 1 ? 'active' : '' }}" for="aware_cost_yes">
                                                            <input type="radio" name="aware_cost" value="1" id="aware_cost_yes" {{ $form->aware_cost == 1 ? 'checked' : '' }}> Ja
                                                        </label>
                                                        <label class="btn btn-default btn-round next-step {{ $form->aware_cost == 0 ? 'active' : '' }}" for="aware_cost_no">
                                                            <input type="radio" name="aware_cost" value="0" id="aware_cost_no" {{ $form->aware_cost == 0 ? 'checked' : '' }}> Nee
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row no-mh">
                                                    <div class="col-md-12">
                                                        <ul class="list-inline mt-30">
                                                            <li><button type="button" class="btn btn-dark-light btn-lg btn-round go-has-website">@lang('app.go_back')</button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2 wp-info mt-30 {{ $form->have_site == 0 ? 'hide' : '' }}">
                                                <h3 class="text-dark-light mb-30">@lang('form.wordpress_data')</h3>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-md-offset-3">
                                                        <input type="text" name="wp_url" id="wp_url" class="input-default input-sm form-control input-full" placeholder="Login URL" value="{{ $form->wp_url ? $form->wp_url : old('wp_url') }}">
                                                        @if ($errors->has('wp_url'))
                                                        <div class="row no-mh">
                                                            <div class="col-md-12">
                                                                <span class="error text-danger">{{ $errors->first('wp_url') }}</span>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-6 col-md-offset-3">
                                                        <input type="text" name="wp_username" id="wp_username" class="input-default input-sm form-control input-full" placeholder="Username / Email" value="{{ $form->wp_username ? $form->wp_username : old('wp_username') }}">
                                                        @if ($errors->has('wp_username'))
                                                        <div class="row no-mh">
                                                            <div class="col-md-12">
                                                                <span class="error text-danger">{{ $errors->first('wp_username') }}</span>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-6 col-md-offset-3">
                                                        <input type="text" name="wp_password" id="wp_password" class="input-default input-sm form-control input-full" placeholder="Password" value="{{ $form->wp_password ? $form->wp_password : old('wp_password') }}">
                                                        @if ($errors->has('wp_password'))
                                                        <div class="row no-mh">
                                                            <div class="col-md-12">
                                                                <span class="error text-danger">{{ $errors->first('wp_password') }}</span>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row no-mh">
                                                    <div class="col-md-12">
                                                        <ul class="list-inline mt-30">
                                                            <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round go-has-website">@lang('app.go_back')</button></li>
                                                            <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step validate-step">@lang('app.proceed')</button></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-30">
                                        <h4>Stap 1 van 4</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="row">
                                        <h2 class="text-dark-light">@lang('form.domain_name')</h2>
                                        <div class="form-group mt-30">
                                            <div class="col-md-6 col-md-offset-3 mt-30 mb-30">
                                                <input type="text" name="domain_name" id="domain_name" class="input-default input-sm form-control input-full" placeholder="www.example.nl" value="{{ $form->domain_name ? $form->domain_name : old('domain_name') }}">
                                                @if ($errors->has('domain_name'))
                                                    <span class="error text-danger">{{ $errors->first('domain_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 2 van 4</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="row">
                                        <h2 class="text-dark-light mb-30">@lang('form.login_details')</h2>
                                        <h4 class="text-dark-light">Providers zoals: Transip, Yourhosting, Mijndomein</h4>
                                        <div class="col-md-6 col-md-offset-3 mb-30">
                                            <div class="form-group mt-30">
                                                <input type="text" name="domain_provider" id="domain_provider" class="input-default input-sm form-control input-full" placeholder="Naam provider (bijv. Transip, Mijndomein etc.)" value="{{ $form->domain_provider ? $form->domain_provider : old('domain_provider') }}">
                                                @if ($errors->has('domain_provider'))
                                                    <span class="error text-danger">{{ $errors->first('domain_provider') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="domain_username" id="domain_username" class="input-default input-sm form-control input-full" placeholder="Username / Email" value="{{ $form->domain_username ? $form->domain_username : old('domain_username') }}">
                                                @if ($errors->has('domain_username'))
                                                    <span class="error text-danger">{{ $errors->first('domain_username') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group ">
                                                <input type="text" name="domain_password" id="domain_password" class="input-default input-sm form-control input-full" placeholder="Wachtwoord" value="{{ $form->domain_password ? $form->domain_password : old('domain_password') }}">
                                                @if ($errors->has('domain_password'))
                                                    <span class="error text-danger">{{ $errors->first('domain_password') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 3 van 4</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <div class="row mb-30">
                                        <h2 class="text-dark-light mb-30">@lang('form.want_google_analytics')</h2>
                                        <h4 class="text-dark-light">@lang('form.analyze_website_traffic')</h4>
                                        <div class="col-md-6 col-md-offset-3 mt-30">
                                            <img src="{{asset('assets/img/mockup_seo_01.png')}}" alt="" class="img-responsive">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mt-30">
                                                <div class="btn-group google-analytics mt-30 mb-30" data-toggle="buttons">
                                                    <label class="btn btn-default btn-round {{ $form->google_analytics == 1 ? 'active' : '' }}" for="google_analytics_yes">
                                                        <input type="radio" name="google_analytics" value="1" id="google_analytics_yes" {{ $form->google_analytics == 1 ? 'checked' : '' }}> Ja
                                                    </label>
                                                    <label class="btn btn-default btn-round {{ $form->google_analytics == 0 ? 'active' : '' }}" for="google_analytics_no">
                                                        <input type="radio" name="google_analytics" value="0" id="google_analytics_no" {{ $form->google_analytics == 0 ? 'checked' : '' }}> Nee
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 google-info mt-30 {{ $form->google_analytics == 0 ? 'hide' : '' }}">
                                            <hr class="border-top-dash mb-30">
                                            <div class="form-group">
                                                <div class="row no-mh">
                                                    <div class="col-md-8 col-md-offset-2 text-left">
                                                        <h3 class="text-dark-light">@lang('form.enter_gmail_account')</h3>
                                                        <h4><strong>@lang('form.gmail_account_note')</strong></h4>
                                                    </div>
                                                    <div class="col-md-6 col-md-offset-3 mt-20 mb-30">
                                                        <input type="email" name="gmail_account" id="gmail_account" placeholder="name@gmail.com" class="input-md" value="{{ $form->gmail_account? $form->gmail_account: old('gmail_account') }}">
                                                        @if ($errors->has('gmail_account'))
                                                            <span class="error text-danger">{{ $errors->first('gmail_account') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="submit" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.submit')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 4 van 4</h4>
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

        $('.hosting .btn').click(function() {
            var value = $(this).find('input').val();
            $('.hosting').addClass('hide');
            if(value == 1) {
                $('.hosting-yes').removeClass('hide');
                $('.hosting-no').addClass('hide');
            } else {
                $('.hosting-no').removeClass('hide');
                $('.hosting-yes').addClass('hide');
                $('.has-website').removeClass('hide');
                $('.wp-info').addClass('hide');
                $('.aware-cost').addClass('hide');
            }
        });

        $('.go-hosting').click(function() {
            $('.hosting-yes').addClass('hide');
            $('.hosting-no').addClass('hide');
            $('.hosting').removeClass('hide');
        });

        $('.go-has-website').click(function() {
            $('.has-website').removeClass('hide');
            $('.wp-info').addClass('hide');
            $('.aware-cost').addClass('hide');
        });

        $('.choose-plan .btn').click(function() {
            $('.choose-plan .btn.active').removeClass('active')
            $('.hosting-info').removeClass('hide')
            $('#go_hosting').addClass('hide')
            var type = $(this).data('value')
        });

        $('.have-site .btn').click(function() {
            var value = $(this).find('input').val();
            $('.has-website').addClass('hide');
            if(value == 1) {
                $('.wp-info').removeClass('hide');
                $('.aware-cost').addClass('hide');
            } else {
                $('.aware-cost').removeClass('hide');
                $('.wp-info').addClass('hide');
            }
        });

        $('.google-analytics .btn').click(function() {
            var value = $(this).find('input').val();
            if(value == 1) {
                $('.google-info').removeClass('hide');
            } else {
                $('.google-info').addClass('hide');
            }
        });

        // $('.validate-step').click(function() {
        //     debugger;
        // })
    });
    
</script>
@endpush
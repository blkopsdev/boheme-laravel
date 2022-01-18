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
                            </ul>
                        </div>

                        <form method="POST" enctype="multipart/form-data" action="" class="multistep">
                            <input type="hidden" name="quick_save" value="0" id="quick_save">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step0">
                                    <div class="row no-mh">
                                        <div class="col-md-12 py-30">
                                            <h3><strong>Maak een keuze:</strong></h3>
                                            <div class="row no-mh">
                                                <div class="mail-type mt-30">
                                                    <input 
                                                        type="radio" name="mail_type" 
                                                        id="mail_type_0" class="input-hidden" value="0" 
                                                        {{ $form->mail_type == 0 ? 'checked' : '' }}
                                                    />
                                                    <label for="mail_type_0" data-type="0" class="col-md-4">
                                                        <img src="{{ asset('assets/img/gmail.png') }}" alt="" width="80" class="mb-20"/>
                                                        <h3 class="mb-20 text-dark-light"><strong>Gmail</strong></h3>
                                                        <h4 class="text-dark-light">€ 5.95 <sub>per gebruiker/ per maand</sub></h4>
                                                    </label>
        
                                                    <input 
                                                        type="radio" name="mail_type"
                                                        id="mail_type_1" class="input-hidden"  value="1"
                                                        {{ $form->mail_type == 1 ? 'checked' : '' }}
                                                    />
                                                    <label for="mail_type_1" data-type="1" class="col-md-4">
                                                        <img src="{{ asset('assets/img/outlook.png') }}" alt="" width="80" class="mb-20"/>
                                                        <h3 class="mb-20 text-dark-light"><strong>Outlook</strong></h3>
                                                        <h4 class="text-dark-light">€ 5.95 <sub>per gebruiker/ per maand</sub></h4>
                                                    </label>
                                                    <input 
                                                        type="radio" name="mail_type"
                                                        id="mail_type_2" class="input-hidden"  value="2"
                                                        {{ $form->mail_type == 2 ? 'checked' : '' }}
                                                    />
                                                    <label for="mail_type_2" data-type="2" class="col-md-4">
                                                        <img src="{{ asset('assets/img/mail.png') }}" alt="" width="80" class="mb-20"/>
                                                        <h3 class="mb-20 text-dark-light"><strong>IQ Script mail</strong></h3>
                                                        <h4 class="text-dark-light">€ 2.95 <sub>per gebruiker/ per maand</sub></h4>
                                                        <p class="text-left label-card-text">Let op: dit is kwalitatief mindere mail waardoor mails sneller in de spam terecht komen.</p>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-30 text-left border-top-dash">
                                            <div class="row no-mh">
                                                <div class="col-md-8 mt-20 mb-30">
                                                    <h3 class="text-dark-light">Voeg hier de mailaccounts toe:</h3>
                                                    <div class="form-group business-mails mb-0">
                                                        @if ($form->mails && countArray(json_decode($form->mails)) > 0)
                                                        @foreach (json_decode($form->mails) as $mail)
                                                        @if ($mail)
                                                        @if ($loop->first)
                                                            <div class="business-mail">
                                                                <input type="text" name="mails[]" placeholder="Voorbeeld: info@iqscript.nl" class="input-sm" value="{{ $mail }}">
                                                            </div>
                                                        @else
                                                        <div class="business-mail"><input type="email" name="mails[]" placeholder="Voorbeeld: info@iqscript.nl" class="input-sm mt-15" value="{{ $mail }}"><button type="button" class="btn btn-danger btn-link remove-mail p-10"><span class="fa fa-close text-danger"></span></button></div>
                                                        @endif
                                                        @endif
                                                        @endforeach
                                                        @else
                                                        <div class="business-mail">
                                                            <input type="email" name="mails[]" placeholder="Voorbeeld: info@iqscript.nl" class="input-sm"> 
                                                        </div>
                                                        @endif
                                                        @if ($errors->has('mails.0'))
                                                        <div class="row no-mh">
                                                            <div class="col-md-12">
                                                                <span class="text-danger error" for="mails.0">{{$errors->first('mails.0')}}</span>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" class="btn-round btn-success no-border mt-15" id="more_mail"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="more_mail">&nbsp; Email toevoegen</label> 
                                                    </div>
                                                </div>
                                                <div class="col-md-4 my-30">
                                                    <div class="card p-20 price-calc">
                                                        <h4><strong>Totale kosten:</strong></h4>
                                                        @if ($form->mails && countArray(json_decode($form->mails)) > 0)
                                                            @if ($form->mail_type == 2)
                                                            <h3>€ <span class="calc-value">{{2.95 * countArray(json_decode($form->mails))}}</span> p/maand</h3>
                                                            @else
                                                            <h3>€ <span class="calc-value">{{5.95 * countArray(json_decode($form->mails))}}</span> p/maand</h3>
                                                            @endif
                                                        @else
                                                        <h3>€ <span class="calc-value">5.95</span> p/maand</h3>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h3 class="text-dark-light">Uw gegevens:</h3>
                                                <div class="row no-mh">
                                                    <div class="col-md-6 mb-15 mt-20">
                                                        <input type="text" name="first_name" id="first_name" placeholder="Voornaam:" class="input-md" value="{{ $form->mail_first_name ? $form->mail_first_name : old('first_name') }}">
                                                        @if ($errors->has('first_name'))
                                                            <span class="error text-danger" for="first_name">{{ $errors->first('first_name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row no-mh">
                                                    <div class="col-md-6 mb-15">
                                                        <input type="text" name="last_name" id="last_name" placeholder="Achternaam:" class="input-md" value="{{ $form->mail_last_name ? $form->mail_last_name : old('last_name') }}">
                                                        @if ($errors->has('last_name'))
                                                            <span class="error text-danger" for="last_name">{{ $errors->first('last_name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row no-mh">
                                                    <div class="col-md-6 mb-15">
                                                        <input type="text" name="title" id="title" placeholder="Title/Position:" class="input-md" value="{{ $form->mail_title ? $form->mail_title : old('title') }}">
                                                        @if ($errors->has('title'))
                                                            <span class="error text-danger" for="title">{{ $errors->first('title') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row no-mh">
                                                    <div class="col-md-6 mb-15">
                                                        <input type="text" name="phone" id="phone" placeholder="Phone number:" class="input-md" value="{{ $form->mail_phone ? $form->mail_phone : old('phone') }}">
                                                        @if ($errors->has('phone'))
                                                            <span class="error text-danger" for="phone">{{ $errors->first('phone') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row no-mh">
                                                    <div class="col-md-6 mb-15">
                                                        <input type="email" name="personal_email" id="personal_email" placeholder="Persoonlijke e-mail:" class="input-md" value="{{ $form->mail_personal_email ? $form->mail_personal_email : old('personal_email') }}">
                                                        @if ($errors->has('personal_email'))
                                                            <span class="error text-danger" for="personal_email">{{ $errors->first('personal_email') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row no-mh">
                                                    <div class="col-md-6 mb-15">
                                                        <input type="text" name="address" id="address" placeholder="Straatnaam + Huisnr." class="input-md" value="{{ $form->mail_address ? $form->mail_address : old('address') }}">
                                                        @if ($errors->has('address'))
                                                            <span class="error text-danger" for="address">{{ $errors->first('address') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row no-mh">
                                                    <div class="col-md-3 mb-15">
                                                        <input type="text" name="zip" id="zip" placeholder="Postcode:" class="input-md" value="{{ $form->mail_zip ? $form->mail_zip : old('zip') }}">
                                                        @if ($errors->has('zip'))
                                                            <span class="error text-danger" for="zip">{{ $errors->first('zip') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3 mb-15">
                                                        <input type="text" name="state" id="state" placeholder="Stad/plaats:" class="input-md" value="{{ $form->mail_state ? $form->mail_state : old('state') }}">
                                                        @if ($errors->has('state'))
                                                            <span class="error text-danger" for="state">{{ $errors->first('state') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row no-mh">
                                                    <div class="col-md-6 mb-15">
                                                        <input type="text" name="country" id="country" placeholder="Land:" class="input-md" value="{{ $form->mail_country ? $form->mail_country : old('country') }}">
                                                        @if ($errors->has('country'))
                                                            <span class="error text-danger" for="country">{{ $errors->first('country') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row no-mh">
                                                    <div class="col-md-6 mb-15">
                                                        <input type="text" name="kvk" id="kvk" placeholder="KvK Nummer" class="input-md" value="{{ $form->mail_kvk ? $form->mail_kvk : old('kvk') }}">
                                                        @if ($errors->has('kvk'))
                                                            <span class="error text-danger" for="kvk">{{ $errors->first('kvk') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row no-mh">
                                                    <div class="form-group col-md-6 mb-15">
                                                        <label for="mail_fee" class="text-dark-light font-weight-default"><input type="checkbox" name="mail_fee" id="mail_fee" value="1" {{ $form->mail_fee == 1? 'checked': '' }}> Ik ben mij bewust van de maandelijkse kosten</label>
                                                        @if ($errors->has('mail_fee'))
                                                        <span class="error text-danger" for="mail_fee">{{ $errors->first('mail_fee') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 1 van 2</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step1">
                                    <div class="row mb-30">
                                        <div class="form-group mt-30 has-domain col-md-12 {{ $form->has_domain != 0 ? 'hide' : '' }}">
                                            <h2 class="text-dark-light">Heeft u uw domein al geregistreerd?</h2>
                                            <div class="row">
                                                <div class="btn-group domain-register mt-30 mb-30" data-toggle="buttons">
                                                    <label class="btn btn-default btn-round {{ $form->has_domain == 1 ? 'active' : '' }}" for="has_domain_yes">
                                                        <input type="radio" name="has_domain" value="1" id="has_domain_yes" {{ $form->has_domain == 1 ? 'checked' : '' }}> Ja
                                                    </label>
                                                    <label class="btn btn-default btn-round {{ $form->has_domain == 0 ? 'active' : '' }}" for="has_domain_no">
                                                        <input type="radio" name="has_domain" value="2" id="has_domain_no" {{ $form->has_domain == 2 ? 'checked' : '' }}> Nee
                                                    </label>
                                                </div>
                                            </div>
                                            <ul class="list-inline mt-30">
                                                <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                                <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                            </ul>
                                            <div class="mt-30">
                                                <h4>Stap 2 van 2</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-12 domain-info {{ $form->has_domain != 1 ? 'hide' : '' }} mt-30">
                                            <div class="row no-mh">
                                                <h3 class="text-dark-light">Wat is uw domeinnaam? </h3>
                                                <div class="col-md-6 col-md-offset-3 mt-20 mb-30">
                                                    <div class="form-group">
                                                        <input type="text" name="domain_name" id="domain_name" placeholder="www.example.nl" class="input-default form-control" value="{{ $form->domain_name? $form->domain_name: old('domain_name')}}">
                                                    </div>
                                                    @if ($errors->has('domain_name'))
                                                    <span class="error text-danger float-none" for="domain_name">{{ $errors->first('domain_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row no-mh">
                                                <h3 class="text-dark-light">Wat zijn de inlog gegevens van de provider?</h3>
                                                <h4 class="text-dark-light">Providers zoals: Transip, Yourhosting, Mijndomein</h4>
                                                <div class="col-md-6 col-md-offset-3 mb-15 mt-20">
                                                    <div class="form-group">
                                                        <input type="text" name="domain_provider" id="domain_provider" placeholder="Naam provider" class="input-default form-control" value="{{ $form->domain_provider? $form->domain_provider: old('domain_provider') }}">
                                                    </div>
                                                    @if ($errors->has('domain_provider'))
                                                    <span class="error text-danger float-none" for="domain_provider">{{ $errors->first('domain_provider') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-md-offset-3 mb-15">
                                                    <div class="form-group">
                                                        <input type="text" name="domain_username" id="domain_username" placeholder="Username / Email" class="input-default form-control" value="{{ $form->domain_username? $form->domain_username: old('domain_username') }}">
                                                    </div>
                                                    @if ($errors->has('domain_username'))
                                                    <span class="error text-danger float-none" for="domain_username">{{ $errors->first('domain_username') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-md-offset-3 mb-15">
                                                    <div class="form-group">
                                                        <input type="text" name="domain_password" id="domain_password" placeholder="Wachtwoord" class="input-default form-control" value="{{ $form->domain_password? $form->domain_password: old('domain_password') }}">
                                                    </div>
                                                    @if ($errors->has('domain_password'))
                                                    <span class="error text-danger float-none" for="domain_password">{{ $errors->first('domain_password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <ul class="list-inline mt-30">
                                                <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round go-has-domain">@lang('app.go_back')</button></li>
                                                <li class="mb-10"><button type="submit" class="btn btn-success btn-lg btn-round next-step">@lang('app.submit')</button></li>
                                            </ul>
                                            <div class="mt-30">
                                                <h4>Stap 2 van 2</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-12 no-domain mt-30 {{ $form->has_domain != 2 ? 'hide' : '' }}">
                                            <h3 class="text-dark-light mb-20">
                                                Hier volgt een stappenplan hoe u zelf uw domein kunt registreren:
                                            </h3>
                                            <h4 class="text-dark-light" style="line-height: 22px;">In onderstaande filmpje leggen wij uit hoe u zelf een domein kunt registreren? <br><strong>Dit is binnen 1-2 minuten geregeld!</strong></h4>
                                            <div class="py-20">
                                                <iframe class="embed-responsive-item no-border" src="https://www.youtube.com/embed/iN2KaYApxWY?rel=0" width="480" height="270"></iframe>
                                            </div>
                                            <a href="https://www.transip.nl" target="__blank" style="font-size:24px;">www.transip.nl</a>

                                            <ul class="list-inline mt-30">
                                                <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round go-has-domain">@lang('app.go_back')</button></li>
                                                <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round go-domain-info">@lang('app.proceed')</button></li>
                                            </ul>
                                            <div class="mt-30">
                                                <h4>Stap 2 van 2</h4>
                                            </div>
                                        </div>
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
        $('.domain-register .btn').click(function() {
            var value = $(this).find('input').val();
            $('.has-domain').addClass('hide');
            if(value == 1) {
                $('.no-domain').addClass('hide');
                $('.domain-info').removeClass('hide');
            } else {
                $('.no-domain').removeClass('hide');
                $('.domain-info').addClass('hide');
            }
        });
    })
    $(document).on('click', '.remove-mail', function() {
        $(this).parent('.business-mail').remove();
        var mails = $('input[name="mails[]"]').length;
        var mail_price = 5.95;
        if($('input[name="mail_type"]:checked').val() == 2) {
            mail_price = 2.95;
        }
        var mails = $('input[name="mails[]"]').length;
        var new_price = mail_price * mails;
        $('.calc-value').html(new_price.toFixed(2));
    });
    $(document).on('click', '#more_mail', function() {
        html = '<div class="business-mail"><input type="email" name="mails[]" placeholder="Voorbeeld: info@iqscript.nl" class="input-sm mt-15"><button type="button" class="btn btn-danger btn-link remove-mail p-10"><span class="fa fa-close text-danger"></span></button></div>';
        $('.business-mails').append(html);
        var mail_price = 5.95;
        if($('input[name="mail_type"]:checked').val() == 2) {
            mail_price = 2.95;
        }
        var mails = $('input[name="mails[]"]').length;
        var new_price = mail_price * mails;
        $('.calc-value').html(new_price.toFixed(2));
    });

    $(document).on('click', '.mail-type label', function() {
        var mail_type = $(this).data('type');
        
        var mail_price = 5.95;
        if(mail_type == 2) {
            mail_price = 2.95;
        }
        var mails = $('input[name="mails[]"]').length;
        var new_price = mail_price * mails;
        $('.calc-value').html(new_price.toFixed(2));
    });
    $(document).on('click', '.go-has-domain', function(){
        $('.has-domain').removeClass('hide');
        $('.no-domain').addClass('hide');
        $('.domain-info').addClass('hide');
    });
    $(document).on('click', '.go-domain-info', function() {
        $('.no-domain').addClass('hide');
        $('.domain-info').removeClass('hide');
    })
    
</script>
@endpush
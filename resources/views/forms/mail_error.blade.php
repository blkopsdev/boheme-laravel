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
                            </ul>
                        </div>

                        <form method="POST" enctype="multipart/form-data" action="" class="multistep">
                            <input type="hidden" name="quick_save" value="0" id="quick_save">
                            <div class="tab-content">
                              <div class="tab-pane active" role="tabpanel" id="step0">
                                <div class="tab-pane-title mb-50">
                                  <h1 class="text-dark-light" style="font-size: 54px">@lang('form.mail_service')</h1>
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
                                  <li><button type="button" class="btn btn-success btn-lg btn-lg btn-round next-step">@lang('form.get_started')</button></li>
                                </ul>
                              </div>
                              <div class="tab-pane" role="tabpanel" id="step1">
                                <div class="row mb-30">
                                  <div class="col-md-12 domain-info mt-30">
                                    <div class="row no-mh">
                                      <h2 class="text-dark-light">@lang('form.mail_login_details')</h2>
                                      <h4 class="text-dark-light">Providers zoals: Transip, Yourhosting, Mijndomein</h4>
                                      <div class="col-md-6 col-md-offset-3 mb-15 mt-20">
                                        <div class="form-group">
                                          <input type="text" name="email_provider" id="email_provider" placeholder="@lang('form.email_provider')" class="form-control" value="{{ $form->email_provider ? $form->email_provider: old('email_provider') }}">
                                        </div>
                                        @if ($errors->has('email_provider'))
                                        <span class="error text-danger float-none" for="email_provider">{{ $errors->first('email_provider') }}</span>
                                        @endif
                                      </div>
                                      <div class="col-md-6 col-md-offset-3 mb-15">
                                        <div class="form-group">
                                          <input type="email" name="email_address" id="email_address" placeholder="Email" class="form-control" value="{{ $form->email_address? $form->email_address: old('email_address') }}">
                                        </div>
                                        @if ($errors->has('email_address'))
                                        <span class="error text-danger float-none" for="email_address">{{ $errors->first('email_address') }}</span>
                                        @endif
                                      </div>
                                      <div class="col-md-6 col-md-offset-3 mb-15">
                                        <div class="form-group">
                                          <input type="text" name="password" id="password" placeholder="Wachtwoord" class="form-control" value="{{ $form->password? $form->password: old('password') }}">
                                        </div>
                                        @if ($errors->has('password'))
                                        <span class="error text-danger float-none" for="password">{{ $errors->first('password') }}</span>
                                        @endif
                                      </div>
                                      <div class="col-md-6 col-md-offset-3 ssl-notes text-left">
                                        <h4>
                                            <img src="{{ asset('assets/img/lock.png') }}" width=40 alt="" class="mr-15">
                                            <span class="text-dark-light">Dit formulier is SSL beveiligd, <strong>uw gegevens zijn veilig</strong></span>
                                        </h4>
                                    </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                      <li><button type="button" class="btn btn-dark-light btn-lg btn-round go-has-domain">@lang('app.go_back')</button></li>
                                      <li><button type="submit" class="btn btn-success btn-lg btn-round next-step">@lang('app.submit')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                      <h4>Stap 1 van 1</h4>
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
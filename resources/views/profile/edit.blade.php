@extends('layouts.spaces.dashboard', ['activePage' => 'profile', 'titlePage' => __('User Profile'), 'activePanel' => 'dashboard'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card ">
              <div class="card-header card-header-success">
                <h4 class="card-title">{{ __('Edit Profile') }}</h4>
                <p class="card-category">{{ __('User information') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">@lang('app.occupation')</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('occupation') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}" name="occupation" id="input-occupation" type="text" placeholder="@lang('app.occupation')" value="{{ auth()->user()->occupation ? auth()->user()->occupation : old('occupation') }}"/>
                      @if ($errors->has('occupation'))
                        <span id="occupation-error" class="error text-danger" for="input-occupation">{{ $errors->first('occupation') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">@lang('app.phone')</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="input-phone" type="text" placeholder="@lang('app.phone')" value="{{ auth()->user()->phone ? auth()->user()->phone : old('phone') }}"/>
                      @if ($errors->has('phone'))
                        <span id="phone-error" class="error text-danger" for="input-phone">{{ $errors->first('phone') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">@lang('app.image')</label>
                  <div class="col-sm-7">
                    <div id="uploaded-ads-image-wrap">
                      <div class="creating-ads-img-wrap">
                        <img src="{{ asset('uploads/users/' . auth()->user()->image_name ) }}" class="img-responsive" width="100">
                        {{-- <a href="javascript:;" class="imgDeleteBtn btn btn-link btn-danger" style="vertical-align:top"><i class="fa fa-trash-o"></i> </a> --}}
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                      <input class="profile-image {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id="input-image" type="file" value="{{ old('image') }}" accept="image/jpeg,image/png,image/jpg"/>
                      @if ($errors->has('image'))
                        <span id="image-error" class="error text-danger" for="input-image">{{ $errors->first('image') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">@lang('app.website_url')</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('website_url') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('website_url') ? ' is-invalid' : '' }}" name="website_url" id="input-website_url" type="text" placeholder="@lang('app.website_url')" value="{{ auth()->user()->website_url ? auth()->user()->website_url : old('website_url') }}"/>
                      @if ($errors->has('website_url'))
                        <span id="website_url-error" class="error text-danger" for="input-website_url">{{ $errors->first('website_url') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-success">
                <h4 class="card-title">{{ __('Change password') }}</h4>
                <p class="card-category">{{ __('Password') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status_password'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status_password') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-current-password">{{ __('Current Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('current_password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" type="password" name="current_password" id="input-current-password" placeholder="{{ __('Current Password') }}" value="" required />
                      @if ($errors->has('current_password'))
                        <span id="current-password-error" class="error text-danger" for="input-current-password">{{ $errors->first('current_password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __('New Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('New Password') }}" value="" required />
                      @if ($errors->has('password'))
                        <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm New Password') }}" value="" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-success">{{ __('Change password') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.smtp_setting') }}" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card ">
              <div class="card-header card-header-success">
                <h4 class="card-title">{{ __('Smtp settings') }}</h4>
                <p class="card-category">{{ __('Email') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status_smtp'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status_smtp') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-sm-11">
                    <p class="text-dark"><strong>Note: If you are going to use Gmail, please confirm you set Less Secure App Access on.</strong><a href="https://support.google.com/a/answer/6260879?hl=en" target="_blank"> {{ __('Lean more') }}</a></p>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-smtp-host">{{ __('Host') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('smtp_host') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('smtp_host') ? ' is-invalid' : '' }}" type="text" name="smtp_host" id="input-smtp-host" placeholder="{{ __('smtp.gmail.com') }}" value="{{ old('smtp_host', auth()->user()->smtp_host) }}" />
                      @if ($errors->has('smtp_host'))
                        <span id="smtp-host-error" class="error text-danger" for="input-smtp-host">{{ $errors->first('smtp_host') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-smtp-port">{{ __('Port') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('smtp_port') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('smtp_port') ? ' is-invalid' : '' }}" type="text" name="smtp_port" id="input-smtp-port" placeholder="{{ __('587') }}" value="{{ old('smtp_port', auth()->user()->smtp_port) }}" />
                      @if ($errors->has('smtp_port'))
                        <span id="smtp-port-error" class="error text-danger" for="input-smtp-port">{{ $errors->first('smtp_port') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-smtp-username">{{ __('Username') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('smtp_username') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('smtp_username') ? ' is-invalid' : '' }}" type="text" name="smtp_username" id="input-smtp-username" placeholder="{{ __('demo@gmail.com') }}" value="{{ old('smtp_username', auth()->user()->smtp_username) }}" />
                      @if ($errors->has('smtp_username'))
                        <span id="smtp-username-error" class="error text-danger" for="input-smtp-username">{{ $errors->first('smtp_username') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-smtp-password">{{ __('Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('smtp_password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('smtp_password') ? ' is-invalid' : '' }}" type="password" name="smtp_password" id="input-smtp-password" placeholder="{{ __('Password') }}" value="{{ old('smtp_password', auth()->user()->smtp_password) }}" />
                      @if ($errors->has('smtp_password'))
                        <span id="smtp-password-error" class="error text-danger" for="input-smtp-password">{{ $errors->first('smtp_password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-smtp-encryption">{{ __('Encryption') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('smtp_encryption') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('smtp_encryption') ? ' is-invalid' : '' }}" type="text" name="smtp_encryption" id="input-smtp-encryption" placeholder="{{ __('TLS') }}" value="{{ old('smtp_encryption', auth()->user()->smtp_encryption) }}" />
                      @if ($errors->has('smtp_encryption'))
                        <span id="smtp-encryption-error" class="error text-danger" for="input-smtp-encryption">{{ $errors->first('smtp_encryption') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-7 offset-sm-2">
                    <div class="form-group{{ $errors->has('confirm_smtp') ? ' has-danger' : '' }}">
                      <label class="col-form-label" for="input-smtp-confirm"><input class="{{ $errors->has('confirm_smtp') ? ' is-invalid' : '' }}" type="checkbox" name="confirm_smtp" id="input-smtp-confirm" value="1" onchange="document.getElementById('smtp_submit').disabled = !this.checked;"/> &nbsp;{{ __('Check here if all data you entered are correct') }}</label>
                      
                      @if ($errors->has('confirm_smtp'))
                        <span id="smtp-confirm-error" class="error text-danger" for="input-smtp-confirm">{{ $errors->first('confirm_smtp') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-success" id="smtp_submit" disabled>{{ __('Update') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
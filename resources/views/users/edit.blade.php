@extends('layouts.spaces.dashboard', ['activePage' => 'edit_user', 'titlePage' => __('User Profile'), 'activePanel' => 'dashboard'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('update_user', $user->id) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf

            <div class="card ">
              <div class="card-header card-header-success">
                <h4 class="card-title">@lang('app.edit_user')</h4>
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
                  <label class="col-sm-2 col-form-label">@lang('app.name')</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="@lang('app.name')" value="{{ $user->name ? $user->name : old('name') }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">@lang('app.email')</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="@lang('app.email')" value="{{ $user->email ? $user->email : old('email') }}" required />
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
                      <input class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}" name="occupation" id="input-occupation" type="text" placeholder="@lang('app.occupation')" value="{{ old('occupation', $user->occupation) }}"/>
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
                      <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="input-phone" type="text" placeholder="@lang('app.phone')" value="{{ $user->phone ? $user->phone : old('phone') }}"/>
                      @if ($errors->has('phone'))
                      <span id="phone-error" class="error text-danger" for="input-phone">{{ $errors->first('phone') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">@lang('app.user_type')</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <select class="selectpicker form-control no-bg" id="user_type" name="user_type" data-style="btn btn-success text-white" >
                        <option value="user" {{ $user->user_type == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">@lang('app.image')</label>
                  <div class="col-sm-7">
                    <div id="uploaded-ads-image-wrap">
                      <div class="creating-ads-img-wrap">
                        <img src="{{ asset('uploads/users/' . $user->image_name ) }}" class="img-responsive" width="100">
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
                      <input class="form-control{{ $errors->has('website_url') ? ' is-invalid' : '' }}" name="website_url" id="input-website_url" type="text" placeholder="@lang('app.website_url')" value="{{ $user->website_url ? $user->website_url : old('website_url') }}"/>
                      @if ($errors->has('website_url'))
                        <span id="website_url-error" class="error text-danger" for="input-website_url">{{ $errors->first('website_url') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-success">@lang('app.update')</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('user_password', $user->id) }}" class="form-horizontal">
            @csrf
            <div class="card ">
              <div class="card-header card-header-success">
                <h4 class="card-title">@lang('app.change_password')</h4>
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
                  <label class="col-sm-2 col-form-label" for="input-current-password">{{ __('app.current_password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" type="password" name="old_password" id="input-current-password" placeholder="{{ __('app.current_password') }}" value="" required />
                      @if ($errors->has('old_password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __('app.new_password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('app.new_password') }}" value="" required />
                      @if ($errors->has('password'))
                        <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('app.confirm_new_password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('app.confirm_new_password') }}" value="" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-success">{{ __('app.change_password') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('smtp_setting', $user->id) }}" class="form-horizontal">
            @csrf
            <div class="card ">
              <div class="card-header card-header-success">
                <h4 class="card-title">{{ __('Smtp email settings') }}</h4>
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
                      <input class="form-control{{ $errors->has('smtp_host') ? ' is-invalid' : '' }}" type="text" name="smtp_host" id="input-smtp-host" placeholder="{{ __('smtp.gmail.com') }}" value="{{ old('smtp_host', $user->smtp_host) }}" />
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
                      <input class="form-control{{ $errors->has('smtp_port') ? ' is-invalid' : '' }}" type="text" name="smtp_port" id="input-smtp-port" placeholder="{{ __('587') }}" value="{{ old('smtp_port', $user->smtp_port) }}" />
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
                      <input class="form-control{{ $errors->has('smtp_username') ? ' is-invalid' : '' }}" type="text" name="smtp_username" id="input-smtp-username" placeholder="{{ __('demo@gmail.com') }}" value="{{ old('smtp_username', $user->smtp_username) }}" />
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
                      <input class="form-control{{ $errors->has('smtp_password') ? ' is-invalid' : '' }}" type="password" name="smtp_password" id="input-smtp-password" placeholder="{{ __('Password') }}" value="{{ old('smtp_password', $user->smtp_password) }}" />
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
                      <input class="form-control{{ $errors->has('smtp_encryption') ? ' is-invalid' : '' }}" type="text" name="smtp_encryption" id="input-smtp-encryption" placeholder="{{ __('TLS') }}" value="{{ old('smtp_encryption', $user->smtp_encryption) }}" />
                      @if ($errors->has('smtp_encryption'))
                        <span id="smtp-encryption-error" class="error text-danger" for="input-smtp-encryption">{{ $errors->first('smtp_encryption') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-7 offset-sm-2">
                    <div class="form-group{{ $errors->has('confirm_smtp') ? ' has-danger' : '' }}">
                      <label class="col-form-label" for="input-smtp-confirm"><input class="{{ $errors->has('confirm_smtp') ? ' is-invalid' : '' }}" type="checkbox" name="smtp_confirm" id="input-smtp-confirm" value="1" onchange="document.getElementById('smtp_submit').disabled = !this.checked;"/> &nbsp;{{ __('Check here if all data you entered are correct') }}</label>
                      
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
@extends('layouts.spaces.dashboard', ['activePage' => 'create_user', 'titlePage' => __('User Create'), 'activePanel' => 'dashboard'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('add_user') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
          @csrf

          <div class="card ">
            <div class="card-header card-header-success">
              <h4 class="card-title">@lang('app.add_user')</h4>
            </div>
            <div class="card-body ">
              <div class="row">
                <label class="col-sm-2 col-form-label">@lang('app.name')</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="@lang('app.name')" value=""/>
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
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="@lang('app.email')" value=""/>
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
                    <input class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}" name="occupation" id="input-occupation" type="text" placeholder="@lang('app.occupation')" value=""/>
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
                    <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="input-phone" type="text" placeholder="@lang('app.phone')" value=""/>
                    @if ($errors->has('phone'))
                      <span id="phone-error" class="error text-danger" for="input-phone">{{ $errors->first('phone') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">@lang('app.image')</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                    <input class="profile-image {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id="input-image" type="file" value="" accept="image/jpeg,image/png,image/jpg"/>
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
                    <input class="form-control{{ $errors->has('website_url') ? ' is-invalid' : '' }}" name="website_url" id="input-website_url" type="text" placeholder="@lang('app.website_url')" value=""/>
                    @if ($errors->has('website_url'))
                      <span id="website_url-error" class="error text-danger" for="input-website_url">{{ $errors->first('website_url') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">@lang('app.user_type')</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <select class="selectpicker form-control no-bg" id="user_type" name="user_type" data-style="btn btn-success text-white" >
                      <option value="user">User</option>
                      <option value="admin">Admin</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-password">{{ __('app.password') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('app.password') }}" value=""/>
                    @if ($errors->has('password'))
                      <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('app.confirm_password') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('app.confirm_password') }}" value=""/>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-success">@lang('app.save')</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
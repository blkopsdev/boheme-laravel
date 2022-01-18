@extends('layouts.app', ['activePage' => 'create_user', 'titlePage' => __('User Create')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('add_user') }}" autocomplete="off" class="form-horizontal">
          @csrf

          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title">@lang('app.add_user')</h4>
            </div>
            <div class="card-body ">
              <div class="row">
                <label class="col-sm-2 col-form-label">@lang('app.name')</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="@lang('app.name')" value="{{ old('name') }}" required="true" aria-required="true"/>
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
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="@lang('app.email')" value="{{ old('email') }}" required />
                    @if ($errors->has('email'))
                      <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-password">{{ __('app.password') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('app.password') }}" value="" required />
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
                    <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('app.confirm_password') }}" value="" required />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">@lang('app.save')</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
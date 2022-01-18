@extends('layouts.spaces.dashboard', ['activePage' => 'settings', 'titlePage' => __('Settings'), 'activePanel' => 'dashboard'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2>{{ $title }} - {{ $company->company_name }}</h2>
          {{-- <img src="{{ asset('uploads/companies/' . $company->logo_name) }}" alt="{{ $company->logo_name }}" width="150" class="mr-3"> <a href="{{ route('company.edit', $company->id) }}" class="btn btn-success btn-round"><i class="material-icons">edit</i> @lang('app.edit')</a>
          <form method="POST" action="{{route('company.destroy', $company->id) }}" class="form-destroy">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-round"><i class="material-icons">delete</i> @lang('app.delete')</button>
          </form> --}}
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <form class="form" method="POST" action="{{ route('update_settings') }}" enctype="multipart/form-data">
            @csrf
            <div class="card py-5">
              <div class="bmd-form-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                <div class="col-md-8">
                  <h5 class="mb-0"><strong>@lang('app.company_name')</strong></h5>
                </div>
                <div class="input-group col-md-8">
                  <input type="text" name="company_name" class="form-control" id="company_name" placeholder="@lang('app.company_name')" value="{{ old('company_name', $company->company_name) }}" required>
                </div>
                @if ($errors->has('company_name'))
                  <div id="name-error" class="error text-danger pl-3" for="company_name" style="display: block;">
                    <strong>{{ $errors->first('company_name') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('logo') ? ' has-danger' : '' }} mt-5">
                <div class="col-md-8">
                  <h5 class="mb-0"><strong>{{ __('Logo') }}</strong></h5>
                  <img src="{{ asset($company->logo) }}" alt="{{ $company->company_name }}" width="150" class="my-3">
                </div>
                <div class="input-group col-md-8">
                  <input type="file" name="logo" class="form-control">
                </div>
                @if ($errors->has('logo'))
                  <div id="logo-error" class="error text-danger pl-3" for="logo" style="display: block;">
                    <strong>{{ $errors->first('logo') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group mt-5">
                <div class="col-md-8">
                  <h5 class="mb-1"><strong>@lang('app.main_color')</strong></h5>
                </div>
                <div class="input-group col-md-8">
                  <input type="text" id="main_color" name="main_color" class="form-control color-picker no-bg" value="{{ old('main_color', $company->main_color) }}" required>
                </div>
              </div>
              <div class="bmd-form-group mt-3">
                <div class="col-md-8">
                  <h5 class="mb-1"><strong>@lang('app.sub_color')</strong></h5>
                </div>
                <div class="input-group col-md-8">
                  <input type="text" id="sub_color" name="sub_color" class="form-control color-picker no-bg" value="{{ old('sub_color', $company->sub_color) }}" required>
                </div>
              </div>
              <div class="bmd-form-group mt-3">
                <div class="col-md-8">
                  <h5 class="mb-1"><strong>@lang('app.other_color')</strong></h5>
                </div>
                <div class="input-group col-md-8">
                  <input type="text" id="other_color" name="other_color" class="form-control color-picker no-bg" value="{{ old('other_color', $company->other_color) }}" required>
                </div>
              </div>
              <div class="col-md-12 mt-2">
                <hr>
              </div>
              <div class="col-md-12">
                <h3>Email Setting</h3>
              </div>
              <div class="bmd-form-group{{ $errors->has('smtp_host') ? ' has-danger' : '' }} mt-2">
                <div class="col-md-8">
                  <h5 class="mb-0"><strong>{{ __('Host') }}</strong></h5>
                </div>
                <div class="input-group col-md-8">
                  <input type="text" name="smtp_host" class="form-control" id="smtp_host" placeholder="smtp.gmail.com" value="{{ old('smtp_host', $company->smtp_host) }}" required>
                </div>
                @if ($errors->has('smtp_host'))
                  <div id="name-error" class="error text-danger pl-3" for="smtp_host" style="display: block;">
                    <strong>{{ $errors->first('smtp_host') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('smtp_port') ? ' has-danger' : '' }} mt-2">
                <div class="col-md-8">
                  <h5 class="mb-0"><strong>{{ __('Port') }}</strong></h5>
                </div>
                <div class="input-group col-md-8">
                  <input type="text" name="smtp_port" class="form-control" id="smtp_port" placeholder="587 or 465" value="{{ old('smtp_port', $company->smtp_port) }}" required>
                </div>
                @if ($errors->has('smtp_port'))
                  <div id="name-error" class="error text-danger pl-3" for="smtp_port" style="display: block;">
                    <strong>{{ $errors->first('smtp_port') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('smtp_username') ? ' has-danger' : '' }} mt-2">
                <div class="col-md-8">
                  <h5 class="mb-0"><strong>{{ __('Username') }}</strong></h5>
                </div>
                <div class="input-group col-md-8">
                  <input type="text" name="smtp_username" class="form-control" id="smtp_username" placeholder="{{ __('demo@gmail.com') }}" value="{{ old('smtp_username', $company->smtp_username) }}" required>
                </div>
                @if ($errors->has('smtp_username'))
                  <div id="name-error" class="error text-danger pl-3" for="smtp_username" style="display: block;">
                    <strong>{{ $errors->first('smtp_username') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('smtp_password') ? ' has-danger' : '' }} mt-2">
                <div class="col-md-8">
                  <h5 class="mb-0"><strong>{{ __('Password') }}</strong></h5>
                </div>
                <div class="input-group col-md-8">
                  <input type="password" name="smtp_password" class="form-control" id="smtp_password" placeholder="{{ __('Password') }}" value="{{ old('smtp_password', $company->smtp_password) }}" required>
                </div>
                @if ($errors->has('smtp_password'))
                  <div id="name-error" class="error text-danger pl-3" for="smtp_password" style="display: block;">
                    <strong>{{ $errors->first('smtp_password') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('smtp_encryption') ? ' has-danger' : '' }} mt-2">
                <div class="col-md-8">
                  <h5 class="mb-0"><strong>{{ __('Encryption') }}</strong></h5>
                </div>
                <div class="input-group col-md-8">
                  <input type="text" name="smtp_encryption" class="form-control" id="smtp_encryption" placeholder="TLS or SSL" value="{{ old('smtp_encryption', $company->smtp_encryption) }}" required>
                </div>
                @if ($errors->has('smtp_encryption'))
                  <div id="name-error" class="error text-danger pl-3" for="smtp_encryption" style="display: block;">
                    <strong>{{ $errors->first('smtp_encryption') }}</strong>
                  </div>
                @endif
              </div>
              @if ($company->id == 1)
              <div class="col-md-12 mt-2">
                <hr>
              </div>
              <div class="col-md-12">
                <h3>Service Desk Email</h3>
              </div>
              <div class="bmd-form-group{{ $errors->has('sd_email') ? ' has-danger' : '' }} mt-2">
                <div class="col-md-8">
                  <h5 class="mb-0"><strong>{{ __('Email') }}</strong></h5>
                </div>
                <div class="input-group col-md-8">
                  <input type="text" name="sd_email" class="form-control" id="sd_email" placeholder="example@gmail.com" value="{{ old('sd_email', $company->sd_email) }}" required>
                </div>
                @if ($errors->has('sd_email'))
                  <div id="name-error" class="error text-danger pl-3" for="sd_email" style="display: block;">
                    <strong>{{ $errors->first('sd_email') }}</strong>
                  </div>
                @endif
              </div>
              @endif
              <div class="bmd-form-group mt-3 ">
                <div class="col-md-8">
                  <button type="submit" class="btn btn-success btn-round">@lang('app.update')</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script>
  @if(session('success'))
      toastr.success('{{ session('success') }}', '{{ trans('app.success') }}', toastr_options);
  @endif
  @if(session('error'))
      toastr.error('{{ session('error') }}', '{{ trans('app.error') }}', toastr_options);
  @endif
</script>
@endpush
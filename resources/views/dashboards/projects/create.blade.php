@extends('layouts.app', ['activePage' => 'create_project'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2>{{ $title }}</h2>
        </div>
      </div>
      
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <form class="form" method="POST" action="">
            @csrf
            <div class="card py-5">
              <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="name" class="form-control" placeholder="@lang('app.name')" value="{{ old('name') }}" required>
                </div>
                @if ($errors->has('name'))
                  <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                    <strong>{{ $errors->first('name') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('company_name') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="company_name" class="form-control" placeholder="@lang('app.company_name')" value="{{ old('company_name') }}" required>
                </div>
                @if ($errors->has('company_name'))
                  <div id="company-name-error" class="error text-danger pl-3" for="company_name" style="display: block;">
                    <strong>{{ $errors->first('company_name') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('phone') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="phone" class="form-control" placeholder="@lang('app.phone')" value="{{ old('phone') }}" required>
                </div>
                @if ($errors->has('phone'))
                  <div id="phone-error" class="error text-danger pl-3" for="phone" style="display: block;">
                    <strong>{{ $errors->first('phone') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="email" name="email" class="form-control" placeholder="@lang('auth.email')" value="{{ old('email') }}" required>
                </div>
                @if ($errors->has('email'))
                  <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                    <strong>{{ $errors->first('email') }}</strong>
                  </div>
                @endif
              </div>
              <div class="col-md-8 offset-md-1 mt-5">
                <h4><strong>@lang('app.timeline_activation')</strong></h4>
              </div>
              <div class="bmd-form-group mt-3">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="logo_design">@lang('app.logo_design')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="logo_design" id="logo_design" checked>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="logo_version_1">@lang('app.logo_version_1')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="logo_version_1" id="logo_version_1">
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="logo_version_2">@lang('app.logo_version_2')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="logo_version_2" id="logo_version_2">
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="logo_completed">@lang('app.logo_completed')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="logo_completed" id="logo_completed">
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div> 

              <div class="col-md-8 offset-md-1 mt-2">
                <hr class="underline-dotted">
              </div>

              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="text_writing">@lang('app.text_writing')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="text_writing" id="text_writing">
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="text_version_1">@lang('app.text_version_1')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="text_version_1" id="text_version_1">
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="text_version_2">@lang('app.text_version_2')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="text_version_2" id="text_version_2">
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="text_completed">@lang('app.text_completed')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="text_completed" id="text_completed">
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div> 

              <div class="col-md-8 offset-md-1 mt-2">
                <hr class="underline-dotted">
              </div>

              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="first_version">@lang('app.first_version')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="first_version" id="first_version" checked>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="deliver_text">@lang('app.deliver_text')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="deliver_text" id="deliver_text" checked>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="first_feedback">@lang('app.first_feedback')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="first_feedback" id="first_feedback" checked>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="final_feedback">@lang('app.final_feedback')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="final_feedback" id="final_feedback" checked>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div> 
              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="hosting">@lang('app.hosting')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="hosting" id="hosting" checked>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div> 
              <div class="bmd-form-group mt-3 ">
                <div class="col-md-8 offset-md-1">
                  <button type="submit" class="btn btn-success btn-round">@lang('app.add_project')</button>
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
    $(document).ready(function() {
      md.initDashboardPageCharts();
    });
  </script>
@endpush
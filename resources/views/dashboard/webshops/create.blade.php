@extends('layouts.spaces.dashboard', ['activePage' => 'webshops', 'activePanel' => 'dashboard'])

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
          <form class="form" method="POST" action="{{ route('webshop.store') }}">
            @csrf
            <div class="card py-5">
              <div class="bmd-form-group{{ $errors->has('project_name') ? ' has-danger' : '' }}">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="project_name" class="form-control" placeholder="@lang('app.project_name')" value="{{ old('project_name') }}" required>
                </div>
                @if ($errors->has('project_name'))
                  <div id="name-error" class="error text-danger pl-3" for="project_name" style="display: block;">
                    <strong>{{ $errors->first('project_name') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }} mt-3">
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
              <div class="bmd-form-group{{ $errors->has('note') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <textarea name="note" class="form-control ckeditor" id="note" cols="30" rows="5" placeholder="@lang('app.notes')">{{ old('note') }}</textarea>
                  @if ($errors->has('note'))
                    <div id="note-error" class="error text-danger pl-3" for="note" style="display: block;">
                      <strong>{{ $errors->first('note') }}</strong>
                    </div>
                  @endif
                </div>
              </div>
              <div class="bmd-form-group{{ $errors->has('reseller') ? ' has-danger' : '' }} mt-3">
                <div class="col-md-8 offset-md-1">
                  <label for="">@lang('app.select_reseller')</label>
                  <div class="input-group">
                    <select class="selectpicker form-control no-bg" id="reseller" name="reseller" data-style="btn btn-success text-white" >
                      <option value="">@lang('app.select_reseller')</option>
                      @foreach ($resellers as $reseller)
                      <option value="{{ $reseller->id }}">{{ $reseller->company_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
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
                      <input type="checkbox" class="info" name="status[]" value="logo_design" id="logo_design" checked>
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
                      <input type="checkbox" class="info" name="status[]" value="logo_version_1" id="logo_version_1">
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
                      <input type="checkbox" class="info" name="status[]" value="logo_version_2" id="logo_version_2">
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
                      <input type="checkbox" class="info" name="status[]" value="logo_completed" id="logo_completed">
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
                      <input type="checkbox" class="info" name="status[]" value="text_writing" id="text_writing">
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
                      <input type="checkbox" class="info" name="status[]" value="text_version_1" id="text_version_1">
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
                      <input type="checkbox" class="info" name="status[]" value="text_version_2" id="text_version_2">
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
                      <input type="checkbox" class="info" name="status[]" value="text_completed" id="text_completed">
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
                    <label for="webshop_onboarding">@lang('app.webshop_onboarding')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="status[]" value="webshop_onboarding" id="webshop_onboarding" checked>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="content_adding">@lang('app.content_adding')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="status[]" value="content_adding" id="content_adding" checked>
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
                      <input type="checkbox" class="info" name="status[]" value="first_feedback" id="first_feedback" checked>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bmd-form-group mt-2">
                <div class="input-group">
                  <div class="col-md-6 offset-md-1">
                    <label for="extra_function">@lang('app.extra_function')</label>
                  </div>
                  <div class="col-md-4">
                    <label class="switch">
                      <input type="checkbox" class="info" name="status[]" value="extra_function" id="extra_function" checked>
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
                      <input type="checkbox" class="info" name="status[]" value="final_feedback" id="final_feedback" checked>
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
                      <input type="checkbox" class="info" name="status[]" value="hosting" id="hosting" checked>
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
<script src="//cdn.ckeditor.com/4.15.1/basic/ckeditor.js"></script>
@endpush
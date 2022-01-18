@extends('layouts.spaces.service_desk', ['activePage' => 'open_tickets', 'activePanel' => 'service_desk'])

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
          <form class="form" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="card py-5">
              <div class="col-md-8 offset-md-1 mt-3">
                <h4><strong>@lang('app.contact_details')</strong></h4>
              </div>
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
              
              {{-- <div class="col-md-8 offset-md-1 mt-2">
                <hr class="underline-dotted">
              </div> --}}

              <div class="col-md-8 offset-md-1 mt-5">
                <h4><strong>@lang('app.describe_your_problem')</strong></h4>
              </div>
              <div class="bmd-form-group{{ $errors->has('subject') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="subject" class="form-control" placeholder="@lang('app.subject')" value="{{ old('subject') }}" required>
                </div>
                @if ($errors->has('subject'))
                  <div id="name-error" class="error text-danger pl-3" for="subject" style="display: block;">
                    <strong>{{ $errors->first('subject') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('description') ? ' has-danger' : '' }} mt-3">
                <div class="col-md-8 offset-md-1">
                  <label for="note">@lang('app.note')</label>
                </div>
                <div class="input-group col-md-8 offset-md-1">
                  <textarea name="note" class="form-control ckeditor" id="note" required>{{ old('note') }}</textarea>
                  @if ($errors->has('note'))
                    <div id="note-error" class="error text-danger pl-3" for="note" style="display: block;">
                      <strong>{{ $errors->first('note') }}</strong>
                    </div>
                  @endif
                </div>
              </div>
              <div class="form-group mt-3">
                <div class="col-md-8 offset-md-1">
                  <label class="text-dark" for="file">@lang('app.file')</label>
                  <input type="file" name="file" id="file" class="upload-file">
                </div>
              </div>
              <div class="form-group mt-3">
                <div class="col-md-8 offset-md-1">
                  <label for="priority">@lang('app.choose_priority')</label>
                  <select class="selectpicker" id="priority" name="priority" data-style="btn btn-success text-white" title="@lang('app.choose_priority')" required>
                    <option value="Urgent" class="priority-option-urgent">{{ __('Urgent') }}</option>
                  <option value="High" class="priority-option-high">{{ __('High') }}</option>
                  <option value="Medium" class="priority-option-medium">{{ __('Medium') }}</option>
                  <option value="Low" class="priority-option-low">{{ __('Low') }}</option>
                  </select>
                </div>
              </div>
              
              <div class="bmd-form-group mt-3 ">
                <div class="col-md-8 offset-md-1">
                  <button type="submit" class="btn btn-success btn-round">@lang('app.submit')</button>
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
<script>
  @if(session('success'))
      toastr.success('{{ session('success') }}', '{{ trans('app.success') }}', toastr_options);
  @endif
  @if(session('error'))
      toastr.error('{{ session('error') }}', '{{ trans('app.error') }}', toastr_options);
  @endif
</script>
@endpush
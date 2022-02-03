@extends('layouts.app', ['activePage' => 'customers.create', 'titlePage' => "Add a New Customer"])

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
          <form class="form" method="POST" action="{{ route('customers.store') }}">
            @csrf
            <div class="card py-5">
              <div class="bmd-form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="first_name" class="form-control" placeholder="{{ __('First Name') }}" value="{{ old('first_name') }}" required>
                </div>
                @if ($errors->has('first_name'))
                  <div id="first-name-error" class="error text-danger pl-3" for="first_name" style="display: block;">
                    <strong>{{ $errors->first('first_name') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('last_name') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="last_name" class="form-control" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" required>
                </div>
                @if ($errors->has('last_name'))
                  <div id="last-name-error" class="error text-danger pl-3" for="last_name" style="display: block;">
                    <strong>{{ $errors->first('last_name') }}</strong>
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
                  <input type="email" name="email" class="form-control" placeholder="@lang('auth.email')" value="{{ old('email') }}">
                </div>
                @if ($errors->has('email'))
                  <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                    <strong>{{ $errors->first('email') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('contact_pref') ? ' has-danger' : '' }} mt-3">
                <div class="col-md-8 offset-md-1">
                  <label for="contact_pref">{{ __('Trade-in notes') }}</label>
                  <select class="selectpicker form-control" id="contact_pref" name="contact_pref" data-style="btn btn-primary text-white">
                    <option value="normal">{{ __('Normal') }}</option>
                    <option value="exceptional">{{ __('Exceptional') }}</option>
                    <option value="marginal">{{ __('Marginal') }}</option>
                  </select>
                </div>
                @if ($errors->has('contact_pref'))
                  <div id="contact-pref-error" class="error text-danger pl-3" for="contact_pref" style="display: block;">
                    <strong>{{ $errors->first('contact_pref') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('newsletter') ? ' has-danger' : '' }} mt-3">
                <div class="col-md-8 offset-md-1">
                  <label for="newsletter">{{ __('Receive Newsletter') }}</label>
                  <select class="selectpicker form-control" id="newsletter" name="newsletter" data-style="btn btn-primary text-white">
                    <option value="yes">{{ __('Yes') }}</option>
                    <option value="no">{{ __('No') }}</option>
                  </select>
                </div>
                @if ($errors->has('newsletter'))
                  <div id="contact-pref-error" class="error text-danger pl-3" for="newsletter" style="display: block;">
                    <strong>{{ $errors->first('newsletter') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('customer_notes') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <textarea name="customer_notes" class="form-control" placeholder="{{ __('Customer Notes') }}" value="{{ old('customer_notes') }}" rows="5"></textarea>
                </div>
                @if ($errors->has('customer_notes'))
                  <div id="customer-notes-error" class="error text-danger pl-3" for="customer_notes" style="display: block;">
                    <strong>{{ $errors->first('customer_notes') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group mt-5">
                <div class="col-md-8 offset-md-1">
                  <button type="submit" class="btn btn-success btn-rounded">{{ __('Submit') }}</button>
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
@extends('layouts.app', ['activePage' => 'customers', 'titlePage' => "Customer Edit"])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">{{ __('Customers') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('customers.show', $customer->id) }}">{{ __('Customer') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h2>{{ $title }}</h2>
        </div>
      </div>
      
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <form class="form" method="POST" action="{{ route('customers.update', $customer->id) }}">
            @csrf
            @method('put')
            <div class="card py-5">
              <div class="bmd-form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="first_name" class="form-control" placeholder="{{ __('First Name') }}" value="{{ old('first_name', $customer->first_name) }}" required>
                </div>
                @if ($errors->has('first_name'))
                  <div id="first-name-error" class="error text-danger pl-3 col-md-8 offset-md-1" for="first_name" style="display: block;">
                    <strong>{{ $errors->first('first_name') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('last_name') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="last_name" class="form-control" placeholder="{{ __('Last Name') }}" value="{{ old('last_name', $customer->last_name) }}" required>
                </div>
                @if ($errors->has('last_name'))
                  <div id="last-name-error" class="error text-danger pl-3 col-md-8 offset-md-1" for="last_name" style="display: block;">
                    <strong>{{ $errors->first('last_name') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('phone') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="@lang('app.phone')" value="{{ old('phone', $customer->phone) }}" required>
                </div>
                @if ($errors->has('phone'))
                  <div id="phone-error" class="error text-danger pl-3 col-md-8 offset-md-1" for="phone" style="display: block;">
                    <strong>{{ $errors->first('phone') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="email" name="email" class="form-control" placeholder="" value="{{ old('email', $customer->email) }}" required>
                </div>
                @if ($errors->has('email'))
                  <div id="email-error" class="error text-danger pl-3 col-md-8 offset-md-1" for="email" style="display: block;">
                    <strong>{{ $errors->first('email') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('contact_pref') ? ' has-danger' : '' }} mt-3">
                <div class="col-md-8 offset-md-1">
                  <label for="contact_pref">{{ __('Trade-in notes') }}</label>
                  <select class="selectpicker form-control" id="contact_pref" name="contact_pref" data-style="btn btn-warning text-white">
                    <option value="normal" {{ strtolower($customer->contact_pref) == 'normal' ? 'selected' : '' }}>{{ __('Normal') }}</option>
                    <option value="exceptional" {{ strtolower($customer->contact_pref) == 'exceptional' ? 'selected' : '' }}>{{ __('Exceptional') }}</option>
                    <option value="marginal" {{ strtolower($customer->contact_pref) == 'marginal' ? 'selected' : '' }}>{{ __('Marginal') }}</option>
                  </select>
                </div>
                @if ($errors->has('contact_pref'))
                  <div id="contact-pref-error" class="error text-danger pl-3 col-md-8 offset-md-1" for="contact_pref" style="display: block;">
                    <strong>{{ $errors->first('contact_pref') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('newsletter') ? ' has-danger' : '' }} mt-3">
                <div class="col-md-8 offset-md-1">
                  <label for="newsletter">{{ __('Receive Newsletter') }}</label>
                  <select class="selectpicker form-control" id="newsletter" name="newsletter" data-style="btn btn-warning text-white">
                    <option value="yes" {{ strtolower($customer->newsletter) == 'yes' ? 'selected' : '' }}>{{ __('Yes') }}</option>
                    <option value="no" {{ strtolower($customer->newsletter) == 'no' ? 'selected' : '' }}>{{ __('No') }}</option>
                  </select>
                </div>
                @if ($errors->has('newsletter'))
                  <div id="contact-pref-error" class="error text-danger pl-3 col-md-8 offset-md-1" for="newsletter" style="display: block;">
                    <strong>{{ $errors->first('newsletter') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('customer_notes') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <textarea name="customer_notes" class="form-control" placeholder="{{ __('Customer Notes') }}"rows="5">{{ old('customer_notes', $customer->customer_notes) }}</textarea>
                </div>
                @if ($errors->has('customer_notes'))
                  <div id="customer-notes-error" class="error text-danger pl-3 col-md-8 offset-md-1" for="customer_notes" style="display: block;">
                    <strong>{{ $errors->first('customer_notes') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group mt-5">
                <div class="col-md-8 offset-md-1">
                  <button type="submit" class="btn btn-primary btn-rounded">{{ __('Update') }}</button>
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
    $('#phone').mask('(000) 000-0000');
  })
</script>
<script>
  @if(session('success'))
      toastr.success('{{ session('success') }}', '{{ trans('app.success') }}', toastr_options);
  @endif
  @if(session('error'))
      toastr.error('{{ session('error') }}', '{{ trans('app.error') }}', toastr_options);
  @endif
</script>
@endpush
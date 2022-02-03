@extends('layouts.app', ['activePage' => 'settings', 'titlePage' => __('Settings')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-warning">
        <h3 class="card-title">{{ $title }}</h3>
      </div>
      <div class="card-body">
        <div class="row pt-5">
          <div class="col-md-12">
            <form class="form" method="POST" action="{{ route('update_settings') }}" enctype="multipart/form-data">
              @csrf
              <div class="row d-flex align-items-center">
                <div class="col-md-4">
                  <h5 class="mb-0"><strong>{{ __('Tax Rate (%):') }}</strong></h5>
                </div>
                <div class="col-md-4">
                  <div class="bmd-form-group{{ $errors->has('tax_rating') ? ' has-danger' : '' }}">
                    <div class="input-group">
                      <input type="number" name="tax_rating" class="form-control" id="tax_rating" placeholder="9.827" step="0.001" min="0" value="{{ old('tax_rating', get_option('tax_rate')) }}" required>
                    </div>
                    @if ($errors->has('tax_rating'))
                      <div id="tax-rating-error" class="error text-danger pl-3" for="tax_rating" style="display: block;">
                        <strong>{{ $errors->first('tax_rating') }}</strong>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row d-flex align-items-center mt-2">
                <div class="col-md-4">
                  <h5 class="mb-0"><strong>{{ __('Expiration Period (months):') }}</strong></h5>
                </div>
                <div class="col-md-4">
                  <div class="bmd-form-group{{ $errors->has('expiration_period') ? ' has-danger' : '' }}">
                    <div class="input-group">
                      <input type="number" name="expiration_period" class="form-control" id="expiration_period" placeholder="12" step="1" min="0" value="{{ old('tax_rating', get_option('expiration_period')) }}" required>
                    </div>
                    @if ($errors->has('expiration_period'))
                      <div id="expiration-period-error" class="error text-danger pl-3" for="expiration_period" style="display: block;">
                        <strong>{{ $errors->first('expiration_period') }}</strong>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8">
                  <div class="bmd-form-group mt-3 ">
                    <button type="submit" class="btn btn-success btn-round">{{ __('Save') }}</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
    @if(session('success'))
      toastr.success('{{ session("success") }}', '{{ trans("app.success") }}', toastr_options);
    @endif
    @if(session('error'))
      toastr.error('{{ session("error") }}', '{{ trans("app.error") }}', toastr_options);
    @endif
</script>
@endpush
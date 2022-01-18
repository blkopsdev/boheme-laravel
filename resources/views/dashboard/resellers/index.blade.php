@extends('layouts.spaces.dashboard', ['activePage' => 'resellers', 'activePanel' => 'dashboard', 'titlePage' => __('Resellers')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2><span class="mr-3">{{ $title }}</span> <a href="{{ route('reseller.create') }}" class="btn btn-success btn-round"><i class="material-icons">add</i>@lang('app.add_reseller')</a></h2>
        </div>
        <div class="col-md-12 bg-success-light">
          <h4 class="m-3"><strong class="text-success">@lang('app.total_resellers')</strong> {{ $resellers->count() }}</h4>
        </div>
      </div>
      
      <div class="row row-eq-height">
        @foreach ($resellers as $reseller)
        <div class="col-lg-3 col-md-3">
          <div class="card">
            <div class="card-body text-center mt-5">
              <img src="{{ asset('uploads/resellers/' . $reseller->logo_name) }}" alt="{{ $reseller->logo_name }}" width="150">
              <h3 class="text-success mt-5 mb-3"><a href="{{ route('reseller.show', $reseller->id) }}"><strong>{{ $reseller->company_name }}</strong></a></h3>
              <h5><strong>@lang('app.contact'): </strong>{{ $reseller->contact_name }}</h5>
              <p><i class="fa fa-phone text-success"></i> {{ $reseller->contact_phone }}</p>
            </div>
          </div>
        </div>
        @endforeach
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
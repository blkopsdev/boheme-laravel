@extends('layouts.app', ['activePage' => 'customers', 'titlePage' => __('Customers')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Customers') }}</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <h2>{{ $title }}</h2>
        </div>
        <div class="col-md-10">
          <a href="{{ route('customers.create') }}" class="btn btn-success btn-rounded"><i class="material-icons">add</i>{{ __('New Customer') }}</a>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">{{ __('Total Customers:') }} <strong></strong></h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover" id="customers">
                <thead class="text-warning">
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('First Name') }}</th>
                  <th>{{ __('Last Name') }}</th>
                  <th>{{ __('Phone') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Action') }}</th>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // $('#customers').DataTable({
      //   "order": [[ 0, 'desc' ]],
      //   "columnDefs": [
      //     { "targets": [0], "orderable": true },
      //     // { "orderable": false, targets: '_all' }
      //   ],
      //   "pageLength" : 50,
      //   // "paging": false
      // })
      $('#customers').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('customer_ajax') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ],
        "pageLength" : 50,
      })
    });
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
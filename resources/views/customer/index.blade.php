@extends('layouts.app', ['activePage' => 'customers', 'titlePage' => __('Customers')])

@section('content')
  <div class="content">
    <div class="container-fluid">
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
              <h4 class="card-title">{{ __('Total Customers:') }} <strong>{{ number_format($total) }}</strong></h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover" id="customers">
                <thead class="text-warning">
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Phone') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th></th>
                </thead>
                <tbody>
                  @foreach ($customers as $customer)
                  <tr>
                    <td>{{$customer->id}}</td>
                    <td><a href="{{ route('customers.show', $customer->id) }}" class="text-primary">{{$customer->first_name }} {{$customer->last_name }}</a> </td>
                    <td>{{$customer->phone }}</td>
                    <td>{{$customer->email }}</td>
                    <td>{{$customer->customer_notes }}</td>
                  </tr>
                  @endforeach
                  
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
      $('#customers').DataTable()
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
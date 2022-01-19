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
              <h4 class="card-title">{{ __('Total Customers:') . $customers->count() }}</h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Phone') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Notes') }}</th>
                  <th>{{ __('View/Edit') }}</th>
                </thead>
                <tbody>
                  @foreach ($customers as $customer)
                  <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->first_name }} {{$customer->last_name }}</td>
                    <td>{{$customer->phone }}</td>
                    <td>{{$customer->email }}</td>
                    <td>{{$customer->customer_notes }}</td>
                    <td>
                      <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-primary btn-rounded p-2 mr-2"><i class="material-icons">visibility</i></a>
                      <a href="" class="btn btn-warning btn-rounded p-2"><i class="material-icons">edit</i></a>
                    </td>
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
              {{ $customers->links() }}
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
      md.initDashboardPageCharts();
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
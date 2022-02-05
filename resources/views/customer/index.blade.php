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
              <h4 class="card-title">{{ __('Total Customers:') }} <strong>{{ number_format($total) }}</strong></h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover" id="customers">
                <thead class="text-warning">
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Phone') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Action') }}</th>
                </thead>
                <tbody>
                  @foreach ($customers as $customer)
                  <tr>
                    <td>{{$customer->id}}</td>
                    <td><a href="{{ route('customers.show', $customer->id) }}" class="text-primary">{{$customer->first_name }} {{$customer->last_name }}</a> </td>
                    <td>
                      @php
                        $phone = str_replace('-', '', str_replace('.', '',$customer->phone));
                        if(strlen($phone) == 7) {
                          $phone = '530' . $phone;
                        }
                      @endphp
                      {{ preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $phone) }}
                    </td>
                    <td>{{ $customer->email }}</td>
                    <td class="d-flex">
                      <a rel="tooltip" class="btn btn-warning btn-rounded p-2" href="{{ route('customers.edit', $customer->id) }}" data-original-title="" title="{{ __('Edit') }}">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                      </a>
                      @if (auth()->user()->user_type == 'admin')
                      <form action="{{ route('customers.destroy',$customer->id) }}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger p-2" onclick="return confirm('All transactions linked to this customer will be deleted. Are you sure you want to permanently DELETE Customer #{{ $customer->id }}?')" rel="tooltip" data-original-title="" title="{{ __('Delete') }}"><i class="material-icons">delete</i></button>
                      </form>
                      @endif
                    </td>
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
      $('#customers').DataTable({
        "order": [[ 0, 'desc' ]],
        "columnDefs": [
          { "targets": [0], "orderable": true },
          // { "orderable": false, targets: '_all' }
        ]
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
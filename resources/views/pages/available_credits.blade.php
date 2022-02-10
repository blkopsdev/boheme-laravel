@extends('layouts.app', ['activePage' => 'available_credits', 'titlePage' => __('Total Available Store Credit')])

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
      <div class="col-md-12">
        <h3>{{ $title }}: <strong class="text-primary">${{ number_format($available_store_credit, 2) }}</strong></h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Customers with available store credit</h4>
            <p class="card-category">This data is updated in every 2 hours.</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover" id="available_customers">
                <thead class=" text-primary">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Available Credit</th>
                </thead>
                <tbody>
                  @foreach ($customers_with_credit as $customer)
                  <tr>
                    <td>{{ $customer->id }}</td>
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
                    <td class="text-primary">
                      ${{ number_format($customer->available_credit, 2) }}
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
</div>
@endsection

@push('js')
    <script>
      $(document).ready(function() {
        $('#available_customers').DataTable({
          "columnDefs": [
            { "targets": [0], "orderable": true },
            // { "orderable": false, targets: '_all' }
          ]
        })
      })
    </script>
@endpush
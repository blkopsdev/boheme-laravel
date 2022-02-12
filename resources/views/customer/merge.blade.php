@extends('layouts.app', ['activePage' => 'transactions', 'titlePage' => "Transaction Edit"])

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
              <li class="breadcrumb-item active" aria-current="page">{{ __('Merge') }}</li>
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
        <div class="col-md-12">
          <div class="client-info">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Merge With') }}</h4>
              </div>
              <div class="card-body pt-5">
                <form id="merge_form" action="{{ route('merge_submit', $customer->id) }}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="target_id">Enter Target Customer ID Here (move transactions to this ID)</label>
                        <input type="number" name="target_id" step="1" min="1" id="target_id" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-rounded" onclick="return confirm('You cannot revert this Merge Customers action. Please make sure you entered the correct Target Customer ID!')">{{ __('Submit') }}</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card mt-5 pb-3">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Customer Information') }}</h4>
              </div>
              <div class="card-body table-responsive">
                <table class="ml-2 table table-striped" style="width: 600px">
                  <tbody>
                    <tr>
                      <td><strong>{{ __('First Name:') }}</strong></td>
                      <td>{{$customer->first_name}}</td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Last Name:') }}</strong></td>
                      <td>{{$customer->last_name}}</td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Phone Number:') }}</strong></td>
                      <td>
                        @php
                          $phone = str_replace('-', '', str_replace('.', '',$customer->phone));
                          if(strlen($phone) == 7) {
                            $phone = '530' . $phone;
                          }
                        @endphp
                        {{ preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $phone) }}
                        {{-- {{$customer->phone}} --}}
                      </td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Email:') }}</strong></td>
                      <td>{{$customer->email}}</td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Trade-in Quality:') }}</strong></td>
                      <td>{{ucfirst($customer->contact_pref)}}</td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Newsletter:') }}</strong></td>
                      <td>{{ucfirst($customer->newsletter)}}</td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Customer Notes') }}</strong></td>
                      <td>{{ $customer->customer_notes }}</td>
                    </tr>
                    <tr>
                      <td><strong>{{ __('Available Credit') }}</strong></td>
                      <td>
                        $<span id="storeCredit">{{ number_format($store_credit, 2) }}</span>
                      </td>
                    </tr>
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
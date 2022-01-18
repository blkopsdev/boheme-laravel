@extends('layouts.spaces.dashboard', ['activePage' => 'resellers', 'activePanel' => 'dashboard', 'titlePage' => __('Reseller')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <img src="{{ asset('uploads/resellers/' . $reseller->logo_name) }}" alt="{{ $reseller->logo_name }}" width="150" class="mr-3"> <a href="{{ route('reseller.edit', $reseller->id) }}" class="btn btn-success btn-round"><i class="material-icons">edit</i> @lang('app.edit')</a>
          <form method="POST" action="{{route('reseller.destroy', $reseller->id) }}" class="form-destroy">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-round"><i class="material-icons">delete</i> @lang('app.delete')</button>
          </form>
        </div>
      </div>
      
      <div class="row row-eq-height">
        <div class="col-lg-8 col-md-8">
          <div class="card">
            <div class="card-body mt-3">
              <h2 class="m-0">{{ $reseller->company_name }}</h2>
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td><strong>@lang('app.company_name')</strong></td>
                    <td>{{ $reseller->company_name }}</td>
                  </tr>
                  <tr>
                    <td><strong>@lang('app.contact_name')</strong></td>
                    <td>{{ $reseller->contact_name }}</td>
                  </tr>
                  <tr>
                    <td><strong>@lang('app.phone')</strong></td>
                    <td>{{ $reseller->contact_phone }}</td>
                  </tr>
                  <tr>
                    <td><strong>@lang('app.email')</strong></td>
                    <td>{{ $reseller->contact_email }}</td>
                  </tr>
                  <tr>
                    <td><strong>@lang('app.main_color')</strong></td>
                    <td style="display: flex; align-items: center;">
                      <div class="swatch-color" style="background-color: {{ $reseller->main_color }}; width: 50px; height: 30px; display:inline-block;">
                      </div>
                      <span class="ml-2">{{ $reseller->main_color }}</span>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>@lang('app.sub_color')</strong></td>
                    <td style="display: flex; align-items: center;">
                      <div class="swatch-color" style="background-color: {{ $reseller->sub_color }}; width: 50px; height: 30px; display:inline-block;">
                      </div>
                      <span class="ml-2">{{ $reseller->sub_color }}</span>
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
@endsection

@push('js')
<script>
  $(document).ready(function() {
    $('form.form-destroy .btn-danger').on('click', function() {
      if (!confirm('{{ trans('app.are_you_sure_delete_reseller') }}')) {
        return false;
      }
    })
  });
  @if(session('success'))
      toastr.success('{{ session('success') }}', '{{ trans('app.success') }}', toastr_options);
  @endif
  @if(session('error'))
      toastr.error('{{ session('error') }}', '{{ trans('app.error') }}', toastr_options);
  @endif
</script>
@endpush
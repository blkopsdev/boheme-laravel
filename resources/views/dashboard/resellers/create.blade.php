@extends('layouts.spaces.dashboard', ['activePage' => 'resellers', 'activePanel' => 'dashboard'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2>{{ $title }}</h2>
        </div>
      </div>
      
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <form class="form" method="POST" action="{{ route('reseller.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card py-5">
              <div class="bmd-form-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="company_name" class="form-control" placeholder="@lang('app.company_name')" value="{{ old('company_name') }}" required>
                </div>
                @if ($errors->has('company_name'))
                  <div id="name-error" class="error text-danger pl-3" for="company_name" style="display: block;">
                    <strong>{{ $errors->first('company_name') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('contact_name') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="contact_name" class="form-control" placeholder="@lang('app.contact_name')" value="{{ old('contact_name') }}" required>
                </div>
                @if ($errors->has('contact_name'))
                  <div id="name-error" class="error text-danger pl-3" for="contact_name" style="display: block;">
                    <strong>{{ $errors->first('contact_name') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('contact_phone') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" name="contact_phone" class="form-control" placeholder="@lang('app.phone')" value="{{ old('contact_phone') }}" required>
                </div>
                @if ($errors->has('contact_phone'))
                  <div id="phone-error" class="error text-danger pl-3" for="contact_phone" style="display: block;">
                    <strong>{{ $errors->first('contact_phone') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('contact_email') ? ' has-danger' : '' }} mt-3">
                <div class="input-group col-md-8 offset-md-1">
                  <input type="email" name="contact_email" class="form-control" placeholder="@lang('app.email')" value="{{ old('contact_email') }}" required>
                </div>
                @if ($errors->has('contact_email'))
                  <div id="phone-error" class="error text-danger pl-3" for="contact_email" style="display: block;">
                    <strong>{{ $errors->first('contact_email') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('logo') ? ' has-danger' : '' }} mt-3">
                <div class="col-md-8 offset-md-1">
                  <h5 class="mb-0">Logo</h5>
                </div>
                <div class="input-group col-md-8 offset-md-1">
                  <input type="file" name="logo" class="form-control" required>
                </div>
                @if ($errors->has('logo'))
                  <div id="logo-error" class="error text-danger pl-3" for="logo" style="display: block;">
                    <strong>{{ $errors->first('logo') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group mt-3">
                <div class="col-md-8 offset-md-1">
                  <h5 class="mb-1">@lang('app.main_color')</h5>
                </div>
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" id="main_color" name="main_color" class="form-control color-picker no-bg" value="#ffcc00" required>
                </div>
              </div>
              <div class="bmd-form-group mt-3">
                <div class="col-md-8 offset-md-1">
                  <h5 class="mb-1">@lang('app.sub_color')</h5>
                </div>
                <div class="input-group col-md-8 offset-md-1">
                  <input type="text" id="sub_color" name="sub_color" class="form-control color-picker no-bg" value="#ffcc00" required>
                </div>
              </div>
              <div class="bmd-form-group mt-3 ">
                <div class="col-md-8 offset-md-1">
                  <button type="submit" class="btn btn-success btn-round">@lang('app.save')</button>
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
      $('.color-picker').each( function() {
        $(this).minicolors({
          control: $(this).attr('data-control') || 'hue',
          defaultValue: $(this).attr('data-defaultValue') || '',
          format: $(this).attr('data-format') || 'hex',
          keywords: $(this).attr('data-keywords') || '',
          inline: $(this).attr('data-inline') === 'true',
          letterCase: $(this).attr('data-letterCase') || 'lowercase',
          opacity: $(this).attr('data-opacity'),
          position: $(this).attr('data-position') || 'bottom',
          swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
          change: function(value, opacity) {
              if( !value ) return;
              if( opacity ) value += ', ' + opacity;
              if( typeof console === 'object' ) {
              console.log(value);
              }
          },
          theme: 'bootstrap'
        });
      });
    });
  </script>
@endpush
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.minicolors.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}">
    <style type="text/css">
      .btn-success,
      .btn-group .btn.active {
        background-color: {{ $form->project->reseller_id != null ? $form->project->reseller->main_color : $form->project->company->main_color }};
        border-color: {{ $form->project->reseller_id != null ? $form->project->reseller->main_color : $form->project->company->main_color }};
      }
      .btn-success:hover,
      .btn-success:active,
      .btn-success:focus {
        background-color: {{ $form->project->reseller_id != null ? $form->project->reseller->main_color : $form->project->company->main_color }}77;
        border-color: {{ $form->project->reseller_id != null? $form->project->reseller->main_color : $form->project->company->main_color }}77;
      }
      .text-success {
        color: {{ $form->project->reseller_id != null ? $form->project->reseller->main_color : $form->project->company->main_color }};
      }
    </style>
    </head>
    <body class="{{ $class ?? '' }}  {{ $form->project->reseller_id }}">
      
      <nav class="navbar">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            @if ($form->project->reseller_id != null )
            <img src="{{ asset('uploads/resellers/' . $form->project->reseller->logo_name) }}" alt="" height="40">
            @else
            <img src="{{ asset($form->project->company->logo) }}" alt="" height="40">
            @endif
        </div>
       
        <div id="navbar" class="collapse navbar-collapse pull-right" @if (request()->path() == 'thank-you' || request()->path() == 'saved-answers') style="display:none !important" @endif>
          <ul class="nav navbar-nav d-flex align-items-center">
            <li><span><i class="fa fa-floppy-o" aria-hidden="true" style="font-size: 20px; color: {{ $form->project->reseller_id ? $form->project->reseller->main_color : $form->project->company->main_color }}"></i> @lang('app.form_save_later') <button class="btn btn-link save-later" style="color: {{ $form->project->reseller_id ? $form->project->reseller->main_color : $form->project->company->main_color }}">@lang('app.save_answers')</button></span></li>
            <li>
              <a href="{{ route('add_ticket') }}" class="nav-link p-0 d-flex align-items-center">
                <i class="material-icons text-success">support_agent</i>&nbsp; {{ __('Service desk') }}
              </a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
      @yield('content')
    <div id="loader"></div>
        <!--   Core JS Files   -->
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
        <script src="{{ asset('assets/js/jquery.minicolors.min.js')}}"></script>
        <script src="{{asset('assets/js/form.js')}}"></script>
        <script>
          $(document).ready(function() {
            var spinner = $('#loader');
            $('.save-later').click(function() {
              $('#quick_save').val('1');
              $('.multistep').submit()
              spinner.show();
            });

            $('form.multistep button[type="submit"]').on('click', function() {
              spinner.show();
            });

            $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip();
            });
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
      @stack('js')
  </body>
</html>
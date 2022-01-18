@extends('layouts.spaces.form')
@section('content')
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section>
                    <div class="wizard">
                        <div class="wizard-inner hide">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#step0" data-toggle="tab" aria-controls="step0" role="tab">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-home"></i>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                        <span class="round-tab">
                                            {{-- <i class="glyphicon glyphicon-picture"></i> --}}
                                            <div class="numberCircle">1</div>
                                        </span>
                                    </a>
                                </li>
                                {{-- <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                        <span class="round-tab">
                                            <div class="numberCircle">2</div>
                                        </span>
                                    </a>
                                </li> --}}
                            </ul>
                        </div>

                        <form method="POST" enctype="multipart/form-data" action="" class="multistep">
                            <input type="hidden" name="quick_save" value="0" id="quick_save">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step0">
                                    <div class="tab-pane-title py-100">
                                        <h1 class="text-dark-light" style="font-size: 54px;">@lang('app.feedback_logo')</h1>
                                        <h2 class="text-dark-light">{{$form->project->company_name}}</h2>
                                        @if ($errors->any())
                                        <div class="row no-mh mt-30">
                                            <div class="col-md-6 col-md-offset-3 alert alert-danger text-left">
                                                <h4 class="text-danger">@lang('app.form_front_error_message')</h4>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline">
                                        <li><button type="button" class="btn btn-success btn-lg btn-lg btn-round next-step" data-step="step0">@lang('app.proceed')</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step1">
                                    <div class="row mt-30">
                                        <div class="col-md-6 col-md-offset-3 text-left">
                                            <label for="logo_name" class="text-left field-info">Voer hier de bestandsnaam in van het logo dat je wilt kiezen</label>
                                        </div>
                                        <div class="form-group col-md-6 col-md-offset-3 {{ $errors->has('logo_name') ? ' has-danger' : '' }}">
                                            <i class="fa fa-question-circle text-success feedback-tooltip" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="@lang('form.logo_feedback_tooltip')"></i>
                                            <input type="text" name="logo_name" id="logo_name" class="form-control" value="{{ $form->filename ? $form->filename : ''}}">
                                            @if ($errors->has('logo_name'))
                                                <span class="error text-danger" for="logo_name">{{ $errors->first('logo_name') }}</span>
                                            @endif
                                        </div>
                                        <label class="text-left col-md-6 col-md-offset-3 field-info">Type hier de feedback over het logo:</label>
                                        <div class="form-group col-md-6 col-md-offset-3 {{ $errors->has('logo_feedback') ? ' has-danger' : '' }}">
                                            
                                            <textarea name="logo_feedback" id="logo_feedback" class="form-control" placeholder="Type hier de feedback over het logo" rows="8">{{ $form->feedback ? $form->feedback : ''}}</textarea>
                                            @if ($errors->has('logo_feedback'))
                                                <span class="error text-danger" for="logo_feedback">{{ $errors->first('logo_feedback') }}</span>
                                            @endif
                                        </div>
                                        <label class="text-left col-md-6 col-md-offset-3 field-info">Hier kunt u foto's of bestanden uploaden als referentie (alleen .png, .jpg & .jpeg bestanden):</label>
                                        <div class="col-md-6 col-md-offset-3">
                                            @if ($form->files()->count() > 0)
                                            <div class="form-group text-left">
                                                <h4 class="text-left">@lang('form.uploaded_files'):</h4>
                                                <ul class="list-unstyled">
                                                    @foreach ($form->files() as $file)
                                                    <li>
                                                        <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $file->id }}"><span class="fa fa-close text-danger"></span></button>
                                                        <a href="{{ asset('uploads/' . $file->media_name) }}" target="_blank">{{ $file->media_name }}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="logo-files col-md-6 col-md-offset-3">
                                            <div class="form-group">
                                                <input type="file" name="files[]" class="reference-logos form-control" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-md-offset-3 text-left">
                                            <button type="button" class="btn-round btn-success no-border " id="more_logo"><i class="fa fa-plus"></i></button><label for="more_logo">&nbsp; Bestand toevoegen</label> 
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="submit" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.submit')</button></li>
                                    </ul>
                                    {{-- <div class="mt-30">
                                        <h4>Stap 2 van 2</h4>
                                    </div> --}}
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function(){
        CKEDITOR.replace('logo_feedback')
        $('#more_logo').on('click', function() {
            var html = '<div class="form-group"><div class="logo-upload-btn"><input type="file" name="files[]" class="reference-logos form-control" accept="image/*"><button type="button" class="btn btn-danger btn-link remove-logo-input"><span class="fa fa-close text-danger"></span></button></div></div>';
            $('.logo-files').append(html)
        });
    });
    $(document).on('click', '.remove-logo-input', function() {
        $(this).closest('.form-group').remove();
    })
    $(document).on('click', '.file-remove', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('delete_media') }}",
            type: "POST",
            data: { 
                id: id,
                _token : '{{ csrf_token() }}' 
            },
            success : function (response) {
            }
        });
        $(this).closest('li').remove();
    })
</script>
@endpush
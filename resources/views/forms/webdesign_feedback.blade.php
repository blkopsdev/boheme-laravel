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
                                            <div class="numberCircle">1</div>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form method="POST" enctype="multipart/form-data" action="" class="multistep">
                            <input type="hidden" name="quick_save" value="0" id="quick_save">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step0">
                                    <div class="tab-pane-title py-100">
                                        <h1 class="text-dark-light" style="font-size: 54px;">
                                            {{ $status == 'webdesign_version_1' ? trans('app.webdesign_first_feedback') : trans('app.webdesign_final_feedback') }}</h1>
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
                                    <div class="row">
                                        <div class="form-group col-md-6 col-md-offset-3 text-left {{ $errors->has('feedback') ? ' has-danger' : '' }}">
                                            <label for="" class="field-info">Type hier de feedback over het webdesign</label>
                                            <textarea name="feedback" id="feedback" class="form-control" rows="8" required>{{ $form->feedback ? $form->feedback : ''}}</textarea>
                                            @if ($errors->has('feedback'))
                                                <span class="error text-danger" for="feedback">{{ $errors->first('feedback') }}</span>
                                            @endif
                                        </div>
                                        <div class="feedback-files col-md-6 col-md-offset-3">
                                            <div class="row no-mh">
                                                <label class="text-left field-info col-md-12">Hier kunt u foto’s of bestanden uploaden:</label>
                                                @if ($form->files() && $form->files()->count() > 0)
                                                <div class="form-group col-md-12 text-left">
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
                                                <div class="form-group col-md-12">
                                                    <input type="file" name="files[]" class="float-left form-control" accept="">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-6 col-md-offset-3 text-left">
                                            <button type="button" class="btn-round btn-success no-border " id="more_file"><i class="fa fa-plus"></i></button><label for="more_file">&nbsp; Bestand toevoegen</label> 
                                        </div>
                                        @if ($status != 'webdesign_version_1')
                                        <div class="form-group col-md-6 col-md-offset-3 text-left">
                                            <p><strong>Let op: dit is de final feedback! Alle feedback/wijzigingen die hierna worden aangegeven worden op basis van uurtarief afgehandeld! Zorg daarom dat u alles nog een keer goed checkt en het hier opschrijft.</strong></p>
                                            <p><strong>U kunt altijd achteraf na oplevering zelf nog wijzigingen doorvoeren m.b.v. onze video cursus!</strong></p>
                                        </div>
                                        @endif
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="submit" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.submit')</button></li>
                                    </ul>
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
        CKEDITOR.replace('feedback')
        $('#more_file').on('click', function() {
            var html = '<div class="row no-mh"><div class="form-group col-md-12"><input type="file" name="files[]" class="float-left form-control" accept=""><button type="button" class="btn btn-danger btn-link remove-file p-10"><span class="fa fa-close text-danger"></span></button></div></div>';
            $('.feedback-files').append(html)
        });
    });
    $(document).on('click', '.remove-file', function() {
        $(this).closest('.row').remove();
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
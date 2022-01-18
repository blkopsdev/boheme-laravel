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
                                        <h1 class="text-dark-light" style="font-size: 50px;">@lang('app.extra_work')</h1>
                                        <h2 class="text-dark-light" style="font-size: 30px;">{{$form->project->company_name}}</h2>
                                    </div>
                                    <ul class="list-inline">
                                        <li><button type="button" class="btn btn-success btn-lg btn-lg btn-round next-step" data-step="step0">@lang('app.proceed')</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step1">
                                    <div class="row">
                                        <h2 class="text-dark-light mb-30">@lang('form.extra_work_summary')</h2>
                                        <h4 class="text-dark-light">@lang('form.make_sure_summary')</h4>
                                        <div class="form-group col-md-8 col-md-offset-2 mt-30">
                                            <textarea name="description" id="description" rows="5" placeholder="@lang('form.description_placeholder')" required>{{ $form->description ? $form->description : old('description') }}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row no-mh upload-files">
                                                <div class="col-md-6 col-md-0ffset-3 text-left">
                                                    <h4 class="text-dark-light ">@lang('form.add_relevant_files')</h4>
                                                </div>
                                                @if ($form->files()->count() > 0)
                                                <div class="uploaded-files text-left col-md-6 col-md-offset-3">
                                                    <h4>@lang('form.uploaded_files')</h4>
                                                    <ul class="list-unstyled">
                                                        @foreach ($form->files() as $file)
                                                        <li>
                                                            <button type="button" class="btn btn-danger btn-link  p-0 files-remove" data-id="{{ $file->id }}"><span class="fa fa-close text-danger"></span></button>
                                                            <a href="{{ asset('uploads/' . $file->media_name) }}" target="_blank">{{ $file->media_name }}</a>
                                                            @endforeach
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif
                                                <div class="form-group col-md-6 col-md-offset-3">
                                                    <input type="file" name="files[]" class="input-default form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-md-offset-2 text-left form-group">
                                            <button type="button" class="btn-round btn-success no-border" id="add_file">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <label class="text-dark-light" for="add_file">&nbsp;@lang('form.add_more_files')</label>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="submit" class="btn btn-success btn-lg btn-round next-step">@lang('form.submit')</button></li>
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
        $('#add_file').click(function() {
            html = '<div class="form-group col-md-8 col-md-offset-2 text-left"><input type="file" name="files[]" class="input-default form-control"><button type="button" class="btn btn-danger btn-link remove-file p-10"><span class="fa fa-close text-danger"></span></button></div>';

            $('.upload-files').append(html);
        });
    });
    $(document).on('click', '.remove-file', function() {
        $(this).closest('.form-group').remove()
    });

    $(document).on('click', '.files-remove', function() {
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
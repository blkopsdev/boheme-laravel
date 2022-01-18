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
                                        <h1 class="text-dark-light" style="font-size: 50px;">@lang('form.website_feedback')</h1>
                                        <h2 class="text-dark-light" style="font-size: 30px;">{{$form->project->company_name}}</h2>
                                    </div>
                                    <ul class="list-inline">
                                        <li><button type="button" class="btn btn-success btn-lg btn-lg btn-round next-step" data-step="step0">@lang('app.proceed')</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step1">
                                    <div class="row mb-30">
                                        <div class="col-md-12">
                                            <div class="feedback-pages">
                                                @if (($form->page_names && countArray(json_decode($form->page_names)) > 0) || ($form->page_feedbacks && countArray(json_decode($form->page_feedbacks)) > 0))
                                                    @php
                                                        $pages = count(json_decode($form->page_names));
                                                        $page_names = json_decode($form->page_names);
                                                        $page_feedbacks = json_decode($form->page_feedbacks);
                                                    @endphp
                                                    @for ($i = 0; $i < $pages; $i++) 
                                                    <div class="row feedback-page">
                                                        @if ($i != 0)
                                                        <div class="col-md-12"><hr class="border-top-dash"></div>
                                                        @endif
                                                        <div class="col-md-2 mt-30">
                                                            <span class="text-dark-light form-number">{{ $i + 1 }}</span>
                                                        </div>
                                                        <div class="col-md-8 mt-30">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group text-left">
                                                                        <label for="" class="field-info">@lang('form.enter_feedback_page')</label>
                                                                        <input type="text" name="page_names[]" class="input-md input-full page-name form-control" required value="{{ isset($page_names[$i]) ? $page_names[$i] : '' }}">
                                                                    </div>
                                                                    <div class="form-group text-left">
                                                                        <label for="" class="field-info">@lang('form.type_feedback_photo_reference')</label>
                                                                        <textarea name="page_feedbacks[]" id="page-feedback-{{ $i }}" rows="5" placeholder="@lang('form.type_feedback_photo_reference')" class="form-control">{{ isset($page_feedbacks[$i]) ? $page_feedbacks[$i] : '' }}</textarea>
                                                                    </div>
                                                                    <div class="page-files text-left mt-20 row no-mh">
                                                                        <label for="" class="col-md-12 field-info">@lang('form.upload_photos_files')</label>
                                                                        @if ($form->files($i)->count() > 0)
                                                                        <div class="uploaded-files text-left col-md-12">
                                                                            <ul class="list-unstyled">
                                                                                @foreach ($form->files($i) as $file)
                                                                                <li>
                                                                                    <button type="button" class="btn btn-danger btn-link  p-0 files-remove" data-id="{{ $file->id }}"><span class="fa fa-close text-danger"></span></button>
                                                                                    <a href="{{ asset('uploads/' . $file->media_name) }}" target="_blank">{{ $file->media_name }}</a>
                                                                                    @endforeach
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group col-md-12">
                                                                            <input type="file" name="page_files[{{ $i }}][]" class="float-left form-control" accept="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-12 text-left">
                                                                        <label><button type="button" class="btn-round btn-success no-border add-file"><i class="fa fa-plus"></i></button>&nbsp; Bestand toevoegen</label> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            @if ($i != 0 )
                                                            <button type="button" class="btn btn-danger btn-md btn-round delete-page" >Verwijderen</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @endfor
                                                @else
                                                    <div class="row feedback-page">
                                                        <div class="col-md-2 mt-30">
                                                            <span class="text-dark-light form-number">1</span>
                                                        </div>
                                                        <div class="col-md-8 mt-30">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group text-left">
                                                                        <label for="" class="field-info">@lang('form.enter_feedback_page')</label>
                                                                        <input type="text" name="page_names[]" class="input-md input-full page-name form-control" required>
                                                                    </div>
                                                                    <div class="form-group text-left">
                                                                        <label for="" class="field-info">@lang('form.type_feedback_photo_reference')</label>
                                                                        <textarea name="page_feedbacks[]" rows="5" id="page-feedback-0" placeholder="@lang('form.type_feedback_photo_reference')" class="form-control"></textarea>
                                                                    </div>
                                                                    <div class="page-files text-left mt-20 row no-mh">
                                                                        <div class="col-md-12">
                                                                            <label for="" class="field-info">@lang('form.upload_photos_files')</label>
                                                                        </div>
                                                                        <div class="form-group col-md-12">
                                                                            <input type="file" name="page_files[0][]" class="float-left form-control" accept="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-12 text-left">
                                                                        <label><button type="button" class="btn-round btn-success no-border add-file"><i class="fa fa-plus"></i></button>&nbsp; Bestand toevoegen</label> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="add-extra-page mt-30">
                                                <div class="row no-mh">
                                                    <div class="col-md-8 col-md-offset-2 text-left">
                                                        <button type="button" class="btn btn-success btn-md btn-round" id="add_page">@lang('form.add_extra_page') +</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
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
    $(document).ready(function() {
        var forms = $('.feedback-pages .row.feedback-page')
        for (let i = 0; i < forms.length; i++) {
            CKEDITOR.replace('page-feedback-' + i)
        }
    })
    $(document).on('click', '#add_page', function() {
        var elems = $('.form-number')
        var last_elem = elems[elems.length - 1]
        var index = parseInt(last_elem.innerHTML) + 1
        var html = '<div class="row mt-20 feedback-page"><div class="col-md-12 top-border"></div><div class="col-md-2 mt-30"><span class="text-dark-light form-number">'+index+'</span></div><div class="col-md-8 mt-30"><div class="row"><div class="col-md-12"><div class="form-group text-left"><label class="field-info">@lang('form.enter_feedback_page')</label><input type="text" name="page_names[]" class="input-md input-full page-name form-control" required></div><div class="form-group text-left"><label class="field-info">Typ hier de feedback- en foto-referentiekenmerken. Zorg ervoor dat u duidelijk aangeeft waar de foto\'s geplaatst moeten worden.</label><textarea name="page_feedbacks[]" rows="5" id="page-feedback-' + index + '" class="form-control"></textarea></div><div class="page-files text-left mt-20 row no-mh"><div class="col-md-12"><label class="field-info">@lang('form.upload_photos_files')</label></div><div class="form-group col-md-12"><input type="file" name="page_files['+ (index - 1) +'][]" class="float-left form-control" accept=""></div></div><div class="form-group col-md-12 text-left"><label><button type="button" class="btn-round btn-success no-border add-file"><i class="fa fa-plus"></i></button>&nbsp; Bestand toevoegen</label></div></div></div></div><div class="col-md-2 mt-30 text-center"><button type="button" class="btn btn-danger btn-md btn-round delete-page" >Verwijderen</button></div></div>';
        $('.feedback-pages').append(html);
        CKEDITOR.replace('page-feedback-' + index)
        var y = $(window).scrollTop();
        $('html, body').animate({
            scrollTop: y+300
        }, 300);
    });

    $(document).on('click', '.delete-page', function() {
        $(this).closest('.row').remove();
        var elems = $('.form-number');
        for (let index = 0; index < elems.length; index++) {
            const element = elems[index];
            element.innerHTML = index + 1;
            $(element).closest('.feedback-page').find('input[type="file"]').each(function() {
                $(this).attr('name', 'page_files[' + index + '][]');
            })
        }
    });

    $(document).on('click', '.add-file', function() {
        index = $(this).closest('.feedback-page').find('.form-number').html()
        
        html = '<div class="form-group col-md-12"><input type="file" name="page_files[' + (index-1) + '][]" class="float-left form-control" accept=""><button type="button" class="btn btn-danger btn-link remove-page-file p-10"><span class="fa fa-close text-danger"></span></button></div>'
        var content = $(this).closest('.feedback-page').find('.page-files');
        content.append(html)
    });

    $(document).on('click', '.remove-page-file', function() {
        $(this).parent('.form-group').remove();
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

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
                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                        <span class="round-tab">
                                            <div class="numberCircle">2</div>
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
                                        <h1 class="text-dark-light">Webteksten feedback</h1>
                                        <h2 class="text-dark-light" style="font-size: 30px;">{{$form->project->company_name}}</h2>
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
                                    <div class="row my-30">
                                        <div class="col-md-12">
                                            <div class="feedback-forms">
                                                @if (($form->page_names && countArray(json_decode($form->page_names)) > 0) || ($form->page_feedbacks && countArray(json_decode($form->page_feedbacks)) > 0))
                                                @php
                                                    $pages = count(json_decode($form->page_names));
                                                    $page_names = json_decode($form->page_names);
                                                    $page_feedbacks = json_decode($form->page_feedbacks);
                                                @endphp
                                                @for ($i = 0; $i < $pages; $i++)
                                                    <div class="row feedback">
                                                        @if ($i != 0)
                                                        <div class="col-md-12"><hr class="border-top-dash"></div>
                                                        @endif
                                                        <div class="col-md-2">
                                                            <span class="text-dark-light form-number">{{ $i+1 }}</span>
                                                        </div>
                                                        <div class="col-md-8 page-form">
                                                            <div class="form-group text-left">
                                                                <label class="text-left field-info">Voer hier de pagina in waarover de feedback gaat</label>
                                                                <input type="text" name="page_names[]" class="input-md input-full page-name" value="{{ isset($page_names[$i]) ? $page_names[$i] : '' }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea name="page_feedbacks[]" rows="5" class="page-feedback" id="page-feedback-{{ $i }}" placeholder="@lang('form.type_feedback')" required>{{ isset($page_feedbacks[$i]) ? $page_feedbacks[$i] : '' }}</textarea>
                                                            </div>
                                                            <div class="feedback-files text-left {{ $form->file($i) ? 'hide' : '' }}" data-page="1">
                                                                <label class="text-left field-info">Hier kun je foto's of bestanden uploaden voor deze pagina:</label>
                                                                <div class="row no-mh">
                                                                    <div class="form-group col-md-12">
                                                                        <input type="file" name="page_files[]" accept=".zip,.png,.jpg,.jpeg,.doc,.docx,.pdf" class="float-left page-file form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if ($form->file($i))
                                                            <div class="uploaded-files text-left">
                                                                <label class="text-left field-info">@lang('form.uploaded_files')</label>
                                                                <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file($i)->id }}"><span class="fa fa-close text-danger"></span></button>
                                                                <a href="{{ asset('uploads/' . $form->file($i)->media_name) }}" target="_blank">{{ $form->file($i)->media_name }}</a>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2 mt-15">
                                                            @if ($i != 0)
                                                            <button type="button" class="btn btn-danger btn-md btn-round delete-page" >Verwijderen</button>
                                                            @endif
                                                        </div>
                                                    </div>    
                                                    @endfor
                                                @else
                                                <div class="row feedback">
                                                    <div class="col-md-2">
                                                        <span class="text-dark-light form-number">1</span>
                                                    </div>
                                                    <div class="col-md-8 page-form">
                                                        <div class="text-left form-group">
                                                            <label class="field-info">Voer hier de pagina in waarover de feedback gaat</label>
                                                            <input type="text" name="page_names[]" class="input-md input-full page-name" required>
                                                        </div>
                                                        <label class="text-left field-info">@lang('form.type_feedback')</label>
                                                        <div class="form-group">
                                                            <textarea name="page_feedbacks[]" rows="5" class="page-feedback" id="page-feedback-0" placeholder="@lang('form.type_feedback')" required></textarea>
                                                        </div>
                                                        <div class="feedback-files text-left" data-page="1">
                                                            <label class="text-left field-info">Hier kun je foto's of bestanden uploaden voor deze pagina:</label>
                                                            <div class="row no-mh">
                                                                <div class="form-group col-md-12">
                                                                    <input type="file" name="page_files[]" accept=".zip,.png,.jpg,.jpeg,.doc,.docx,.pdf" class="float-left page-file form-control">
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
                                        <li class="mb-10"><button type="submit" class="btn btn-success btn-lg btn-round next-step proceed">@lang('form.send_feedback')</button></li>
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
        var forms = $('.feedback-forms .row.feedback')
        for (let i = 0; i < forms.length; i++) {
            CKEDITOR.replace('page-feedback-' + i)
        }
        $(document).on('click', '#add_page', function() {
            var elems = $('.form-number')
            var last_elem = elems[elems.length - 1]
            var index = parseInt(last_elem.innerHTML) + 1
            var html = '<div class="row feedback"><div class="col-md-12"><hr class="border-top-dash"></div><div class="col-md-2"><span class="text-dark-light form-number">' + index + '</span></div><div class="col-md-8 page-form"><div class="text-left form-group"><label class="field-info">Voer hier de pagina in waarover de feedback gaat</label><input type="text" name="page_names[]" class="input-md input-full page-name" required></div><label class="text-left field-info">@lang('form.type_feedback')</label><div class="form-group"><textarea name="page_feedbacks[]" rows="5" class="page-feedback" id="page-feedback-' + index+ '" required></textarea></div><div class="feedback-files text-left"><label class="text-left field-info">Hier kun je foto\'s of bestanden uploaden voor deze pagina:</label><div class="row no-mh"><div class="col-md-12 form-group"><input type="file" name="page_files[]" accept=".zip,.png,.jpg,.jpeg,.doc,.docx,.pdf" class="float-left page-file form-control"></div></div></div></div><div class="col-md-2 mt-15"><button type="button" class="btn btn-danger btn-md btn-round delete-page" >Verwijderen</button></div></div>';
            $('.feedback-forms').append(html);
            CKEDITOR.replace('page-feedback-' + index)
            var y = $(window).scrollTop();
            $('html, body').animate({
                scrollTop: y+300
            }, 300);
        });

    });
    
    $(document).on('click', '.delete-page', function() {
        $(this).closest('.row').remove();
        var elems = $('.form-number');
        for (let index = 0; index < elems.length; index++) {
            const element = elems[index];
            num = index + 1
            element.innerHTML = num;
        }
        var inputs = $('.page-name').length;
        $('.page-name')[inputs-1].focus()
    });

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
        $(this).closest('.row').find('.hide').removeClass('hide');
        $(this).closest('.uploaded-files').remove();
    })

</script>
@endpush
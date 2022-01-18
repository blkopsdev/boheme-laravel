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
                                        <h1 class="text-dark-light" style="font-size: 50px;">@lang('form.extra_function')</h1>
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
                                    <div class="row no-mh mt-30">
                                        <h2 class="text-dark-light col-md-12">@lang('form.extra_function_summary')</h2>
                                        <h4 class="text-dark-light mb-30 col-md-12">@lang('form.make_sure_summary')</h4>
                                    </div>
                                    <div class="row mb-30">
                                        <div class="col-md-12">
                                            <div class="extra-functions">
                                                @if ($form->description && countArray(json_decode($form->description)) > 0)
                                                    @for ($i = 0; $i < count(json_decode($form->description)); $i++)
                                                    <div class="row extra-function">
                                                        @if ($i > 0)
                                                        <div class="col-md-12 top-border"></div>
                                                        @endif
                                                        <div class="col-md-2 mt-30">
                                                            <span class="text-dark-light form-number">{{ $i + 1 }}</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row no-mh">
                                                                <div class="form-group col-md-12">
                                                                    <textarea name="description[]" rows="5" placeholder="@lang('form.description_placeholder')" required>{{ json_decode($form->description)[$i] }}</textarea>

                                                                </div>
                                                                @if ($form->file($i))
                                                                <div class="uploaded-files text-left col-md-12">
                                                                    <h4>@lang('form.uploaded_files')</h4>
                                                                    <button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->file($i)->id }}"><span class="fa fa-close text-danger"></span></button>
                                                                    <a href="{{ asset('uploads/' . $form->file($i)->media_name) }}" target="_blank">{{ $form->file($i)->media_name }}</a>
                                                                </div>
                                                                @endif
                                                                <div class="form-group col-md-12 function-files text-left mt-20 {{ $form->file($i) ? 'hide' : '' }}">
                                                                    <h4 >@lang('form.add_relevant_files')</h4>
                                                                    <input type="file" name="files[]" accept="" class="float-left form-control">
                                                                </div>
                                                            </div>
                                                            <div class="row no-mh text-left">
                                                                <h2 class="text-dark-light col-md-12">@lang('form.existing_example_functionality')</h2>
                                                                <div class="example-sites text-left mt-20">
                                                                    @if (isset(json_decode($form->examples, true)[$i]) && countArray(json_decode($form->examples, true)[$i]) > 0)
                                                                        @foreach (json_decode($form->examples, true)[$i] as $example)
                                                                        @if ($example)
                                                                        <div class="form-group col-md-8">
                                                                            <input type="text" name="examples[{{ $i }}][]" class="input-default input-sm form-control" placeholder="www.example.nl" value="{{ $example }}">
                                                                        </div>        
                                                                        @endif
                                                                        @endforeach
                                                                    @else
                                                                    <div class="form-group col-md-8">
                                                                        <input type="text" name="examples[{{ $i }}][]" class="input-default input-sm form-control" placeholder="www.example.nl">
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group col-md-8">
                                                                    <label class="text-dark-light"><button type="button" class="btn-round btn-success no-border mt-15 more-example"><i class="fa fa-plus"></i></button>&nbsp; Extra website toevoegen</label>
                                                                </div>
                                                            </div>
                                                            <div class="row no-mh text-left">
                                                                <div class="col-md-12">
                                                                    <h2 class="text-dark-light">@lang('form.enter_login_details')</h2>
                                                                    <div class="login-details">
                                                                        @if (countArray(json_decode($form->login_urls)[$i]) > 0 || countArray(json_decode($form->login_emails)[$i]) > 0 || countArray(json_decode($form->login_passwords)[$i]) > 0 )
                                                                            @for ($j = 0; $j < count(json_decode($form->login_urls)[$i]); $j++)
                                                                                @if (json_decode($form->login_urls)[$i][$j] || json_decode($form->login_emails)[$i][$j] || json_decode($form->login_passwords)[$i][$j])
                                                                                <div class="row no-mh">
                                                                                    @if ($j > 0)
                                                                                    <div class="col-md-12">
                                                                                        <hr class="border-top-dash">
                                                                                    </div>
                                                                                    @endif
                                                                                    <div class="form-group col-md-8">
                                                                                        <input type="text" name="login_urls[{{ $i }}][]" class="input-default input-sm form-control" placeholder="Software naam / URL" value="{{ json_decode($form->login_urls)[$i][$j] ? json_decode($form->login_urls)[$i][$j] : '' }}">
                                                                                        <input type="text" name="login_emails[{{ $i }}][]" class="input-default input-sm form-control" placeholder="Gebruikersnaam / E-mail" value="{{ json_decode($form->login_emails)[$i][$j] ? json_decode($form->login_emails)[$i][$j] : '' }}">
                                                                                        <input type="text" name="login_passwords[{{ $i }}][]" class="input-default input-sm form-control" placeholder="Wachtwoord" value="{{ json_decode($form->login_passwords)[$i][$j] ? json_decode($form->login_passwords)[$i][$j] : '' }}">
                                                                                    </div>
                                                                                </div>
                                                                                @endif
                                                                            @endfor
                                                                        @else
                                                                        <div class="row no-mh">
                                                                            <div class="form-group col-md-8">
                                                                                <input type="text" name="login_urls[{{ $i }}][]" class="input-default input-sm form-control" placeholder="Software naam / URL">
                                                                                <input type="text" name="login_emails[{{ $i }}][]" class="input-default input-sm form-control" placeholder="Gebruikersnaam / E-mail">
                                                                                <input type="text" name="login_passwords[{{ $i }}][]" class="input-default input-sm form-control" placeholder="Wachtwoord">
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="text-dark-light"><button type="button" class="btn-round btn-success no-border mt-15 more-login"><i class="fa fa-plus"></i></button>&nbsp; @lang('app.add_extra_login')</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if ($i > 0)
                                                        <div class="col-md-2 mt-30 text-center"><button type="button" class="btn btn-danger btn-md btn-round delete-function" >Verwijderen</button></div>
                                                        @else
                                                        <div class="col-md-2"></div>
                                                        @endif
                                                    </div>        
                                                    @endfor
                                                @else
                                                <div class="row extra-function">
                                                    <div class="col-md-2 mt-30">
                                                        <span class="text-dark-light form-number">1</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row no-mh">
                                                            <div class="form-group col-md-12">
                                                                <textarea name="description[]" rows="5" placeholder="@lang('form.description_placeholder')" required></textarea>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12 function-files text-left mt-20">
                                                                <h4 >@lang('form.add_relevant_files')</h4>
                                                                <input type="file" name="files[]" accept="" class="float-left form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row no-mh text-left mt-30">
                                                            <h2 class="text-dark-light col-md-12">@lang('form.existing_example_functionality')</h2>
                                                            <div class="example-sites text-left">
                                                                <div class="form-group col-md-8">
                                                                    <input type="text" name="examples[0][]" class="input-default input-sm form-control" placeholder="www.example.nl">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-8">
                                                                <label class="text-dark-light"><button type="button" class="btn-round btn-success no-border mt-15 more-example"><i class="fa fa-plus"></i></button>&nbsp; Extra website toevoegen</label>
                                                            </div>
                                                        </div>
                                                        <div class="row no-mh text-left mt-30">
                                                            <div class="col-md-12">
                                                                <h2 class="text-dark-light">@lang('form.enter_login_details')</h2>
                                                                <div class="login-details">
                                                                    <div class="row no-mh">
                                                                        <div class="form-group col-md-8">
                                                                            <input type="text" name="login_urls[0][]" class="input-default input-sm form-control" placeholder="Software naam / URL">
                                                                            <input type="text" name="login_emails[0][]" class="input-default input-sm form-control" placeholder="Gebruikersnaam / E-mail">
                                                                            <input type="text" name="login_passwords[0][]" class="input-default input-sm form-control" placeholder="Wachtwoord">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-dark-light"><button type="button" class="btn-round btn-success no-border mt-15 more-login"><i class="fa fa-plus"></i></button>&nbsp; @lang('app.add_extra_login')</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-2"></div>
                                                </div> 
                                                @endif
                                            </div>
                                            <div class="add-extra-functionality mt-30">
                                                <div class="row no-mh">
                                                    <div class="col-md-8 col-md-offset-2 text-left">
                                                        <button type="button" class="btn btn-success btn-md btn-round" id="add_function">@lang('form.add_extra_function') +</button>
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
    $(document).ready(function(){
        $(document).on('click', '#add_function', function() {
            var elems = $('.form-number')
            var last_elem = elems[elems.length - 1]
            var index = parseInt(last_elem.innerHTML)
            var html = '<div class="row extra-function"><div class="col-md-12 top-border"></div><div class="col-md-2 mt-30"><span class="text-dark-light form-number">' + (index + 1) + '</span></div><div class="col-md-8"><div class="row no-mh"><div class="form-group col-md-12"><textarea name="description[]" rows="5" placeholder="@lang('form.description_placeholder')" required></textarea></div><div class="form-group col-md-12 function-files text-left mt-20"><h4 >@lang('form.add_relevant_files')</h4><input type="file" name="files[]" accept="" class="float-left form-control"></div></div><div class="row no-mh text-left mt-30"><h2 class="text-dark-light col-md-12">@lang('form.existing_example_functionality')</h2><div class="example-sites text-left mt-20"><div class="form-group col-md-8"><input type="text" name="examples[' + index + '][]" class="input-default input-sm form-control" placeholder="www.example.nl"></div></div><div class="form-group col-md-8"><label class="text-dark-light"><button type="button" class="btn-round btn-success no-border mt-15 more-example"><i class="fa fa-plus"></i></button>&nbsp; Extra website toevoegen</label></div></div><div class="row no-mh text-left mt-30"><div class="col-md-12"><h2 class="text-dark-light">@lang('form.enter_login_details')</h2><div class="login-details"><div class="row no-mh"><div class="form-group col-md-8"><input type="text" name="login_urls[' + index + '][]" class="input-default input-sm form-control" placeholder="Software naam / URL"><input type="text" name="login_emails[' + index + '][]" class="input-default input-sm form-control" placeholder="Gebruikersnaam / E-mail"><input type="text" name="login_passwords[' + index + '][]" class="input-default input-sm form-control" placeholder="Wachtwoord"></div></div></div><div class="form-group"><label class="text-dark-light"><button type="button" class="btn-round btn-success no-border mt-15 more-login"><i class="fa fa-plus"></i></button>&nbsp; @lang('app.add_extra_login')</label></div></div></div></div><div class="col-md-2 mt-30 text-center"><button type="button" class="btn btn-danger btn-md btn-round delete-function" >Verwijderen</button></div></div>';
            $('.extra-functions').append(html);
            
            var y = $(window).scrollTop();
            $('html, body').animate({
                scrollTop: y+300
            }, 300);
        });

    });
    
    $(document).on('click', '.delete-function', function() {
        $(this).closest('.row').remove();
        var elems = $('.form-number');
        for (let index = 0; index < elems.length; index++) {
            const element = elems[index];
            element.innerHTML = index + 1;
        }
    });

    $(document).on('click', '.more-example', function() {
        index = $(this).closest('.extra-function').find('.form-number').html();
        html = '<div class="form-group col-md-8"><input type="text" name="examples[' + (index-1) + '][]" class="input-default input-sm form-control" placeholder="www.example.nl"><button type="button" class="btn btn-danger btn-link remove-input"><span class="fa fa-close text-danger"></span></button></div>';
        var content = $(this).closest('.row').find('.example-sites');
        content.append(html)
    });

    $(document).on('click', '.more-login', function() {
        index = $(this).closest('.extra-function').find('.form-number').html()
        html = '<div class="row no-mh"><div class="col-md-12"><hr class="border-top-dash"></div><div class="form-group col-md-8"><input type="text" name="login_urls[' + (index - 1) + '][]" class="input-default input-sm form-control" placeholder="Software naam / URL"><input type="text" name="login_emails[' + (index - 1) + '][]" class="input-default input-sm form-control" placeholder="Gebruikersnaam / E-mail"><input type="text" name="login_passwords[' + (index - 1) + '][]" class="input-default input-sm form-control" placeholder="Wachtwoord"></div><div class="form-group col-md-4"><button type="button" class="btn btn-danger btn-round remove-login">@lang('form.delete_login')</button></div></div>';
        var content = $(this).closest('.form-group').closest('.col-md-12').find('.login-details');
        content.append(html)
    })

    $(document).on('click', '.remove-input', function() {
        $(this).closest('.form-group').remove()
    });

    $(document).on('click', '.remove-login', function() {
        $(this).closest('.row.no-mh').remove()
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
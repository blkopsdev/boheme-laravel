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
                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                        <span class="round-tab">
                                            <div class="numberCircle">3</div>
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
                                        <h1 class="text-dark-light" style="font-size:50px;">@lang('app.webdesign_dev')</h1>
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
                                    <div class="row no-mh">
                                        <h2 class="mb-15 text-dark-light mt-30">Wat is de site structuur die u in gedachten heeft? <i class="fa fa-info-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.onboarding_menu_tooltip')"></i></h2>
                                        <h4 class="mb-30">Let op: niet alle velden hoeven ingevuld te worden.</h4>
                                    </div>
                                    <div class="row full-row no-mh">
																			<div class="col-md-6">
																				<div class="row">
																					<div class="col-md-3">
																						<h3 class="text-dark-light">Home</h3>
																					</div>
																					<div class="col-md-3">
																						<div class="row no-mh">
																							<div class="col-md-12 website-menu-1">
																								<div class="form-group">
																									<input type="text" name="menu_item_1" id="menu_item_1" value="{{ $form->menu_item_1 ? $form->menu_item_1 : '' }}">
																								</div>
																								@if ($form->submenu_item_1 && countArray(json_decode($form->submenu_item_1)) > 0)
																									@foreach (json_decode($form->submenu_item_1) as $sub1_item)
																									@if ($sub1_item)
																									<div class="form-group website-submenu-item">
																										<button type="button" class="btn btn-danger btn-link remove-submenu">
																											<span class="fa fa-close text-danger"></span>
																										</button>
																										<input type="text" name="submenu_item_1[]" class="submenu-item" value="{{$sub1_item?$sub1_item:''}}"></div>
																									@endif
																									@endforeach
																								@endif
																							</div>
																						</div>
																						
																						<div class="form-group text-left">
																							<button type="button" class="btn-round btn-success no-border add-submenu" data-menu-id="1" id="add_submenu_1"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="add_submenu_1">&nbsp;Submenu</label> 
																						</div>
																					</div>
																					<div class="col-md-3">
																						<div class="row no-mh">
																							<div class="col-md-12 website-menu-2">
																								<div class="form-group">
																									<input type="text" name="menu_item_2" id="menu_item_2" value="{{ $form->menu_item_2 ? $form->menu_item_2 : old('menu_item_2') }}">
																								</div>
																								@if ($form->submenu_item_2 && countArray(json_decode($form->submenu_item_2)) > 0)
																									@foreach (json_decode($form->submenu_item_2) as $sub2_item)
																									@if ($sub2_item)
																									<div class="form-group website-submenu-item">
																										<button type="button" class="btn btn-danger btn-link remove-submenu">
																											<span class="fa fa-close text-danger"></span>
																										</button>
																										<input type="text" name="submenu_item_2[]" class="submenu-item" value="{{$sub2_item?$sub2_item:''}}"></div>
																									@endif
																									@endforeach
																								@endif
																							</div>
																						</div>
																						<div class="form-group text-left">
																							<button type="button" class="btn-round btn-success no-border add-submenu" data-menu-id="2" id="add_submenu_2"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="add_submenu_2">&nbsp;Submenu</label> 
																						</div>
																					</div>
																					<div class="col-md-3">
																						<div class="row no-mh">
																							<div class="col-md-12 website-menu-3">
																								<div class="form-group">
																									<input type="text" name="menu_item_3" id="menu_item_3" value="{{ $form->menu_item_3 ? $form->menu_item_3 : old('menu_item_3') }}">
																								</div>
																								@if ($form->submenu_item_3 && countArray(json_decode($form->submenu_item_3)) > 0)
																									@foreach (json_decode($form->submenu_item_3) as $sub3_item)
																									@if ($sub3_item)
																									<div class="form-group website-submenu-item">
																										<button type="button" class="btn btn-danger btn-link remove-submenu">
																											<span class="fa fa-close text-danger"></span>
																										</button>
																										<input type="text" name="submenu_item_3[]" class="submenu-item" value="{{$sub3_item?$sub3_item:''}}"></div>
																									@endif
																									@endforeach
																								@endif
																							</div>
																						</div>
																						<div class="form-group text-left">
																							<button type="button" class="btn-round btn-success no-border add-submenu" data-menu-id="3" id="add_submenu_3"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="add_submenu_3">&nbsp;Submenu</label> 
																						</div>
																					</div>
																				</div>
																			</div> 
																			<div class="col-md-6">
																				<div class="row">
																					<div class="col-md-3">
																						<div class="row no-mh">
																							<div class="col-md-12 website-menu-4">
																								<div class="form-group">
																									<input type="text" name="menu_item_4" id="menu_item_4" value="{{ $form->menu_item_4 ? $form->menu_item_4 : old('menu_item_4') }}">
																								</div>
																								@if ($form->submenu_item_4 && countArray(json_decode($form->submenu_item_4)) > 0)
																									@foreach (json_decode($form->submenu_item_4) as $sub4_item)
																									@if ($sub4_item)
																									<div class="form-group website-submenu-item">
																										<button type="button" class="btn btn-danger btn-link remove-submenu">
																											<span class="fa fa-close text-danger"></span>
																										</button>
																										<input type="text" name="submenu_item_4[]" class="submenu-item" value="{{$sub4_item?$sub4_item:''}}"></div>
																									@endif
																									@endforeach
																								@endif
																							</div>
																						</div>
																						<div class="form-group text-left">
																							<button type="button" class="btn-round btn-success no-border add-submenu" data-menu-id="4" id="add_submenu_4"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="add_submenu_4">&nbsp;Submenu</label> 
																						</div>
																					</div>
																					<div class="col-md-3">
																						<div class="row no-mh">
																							<div class="col-md-12 website-menu-5">
																								<div class="form-group">
																									<input type="text" name="menu_item_5" id="menu_item_5" value="{{ $form->menu_item_5 ? $form->menu_item_5 : old('menu_item_5') }}">
																								</div>
																								@if ($form->submenu_item_5 && countArray(json_decode($form->submenu_item_5)) > 0)
																									@foreach (json_decode($form->submenu_item_5) as $sub5_item)
																									@if ($sub5_item)
																									<div class="form-group website-submenu-item">
																										<button type="button" class="btn btn-danger btn-link remove-submenu">
																											<span class="fa fa-close text-danger"></span>
																										</button>
																										<input type="text" name="submenu_item_5[]" class="submenu-item" value="{{$sub5_item?$sub5_item:''}}"></div>
																									@endif
																									@endforeach
																								@endif
																							</div>
																						</div>
																						<div class="form-group text-left">
																							<button type="button" class="btn-round btn-success no-border add-submenu" data-menu-id="5" id="add_submenu_5"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="add_submenu_5">&nbsp;Submenu</label> 
																						</div>
																					</div>
																					<div class="col-md-3">
																						<div class="row no-mh">
																							<div class="col-md-12 website-menu-6">
																								<div class="form-group">
																									<input type="text" name="menu_item_6" id="menu_item_6" value="{{ $form->menu_item_6 ? $form->menu_item_6 : old('menu_item_6') }}">
																								</div>
																								@if ($form->submenu_item_6 && countArray(json_decode($form->submenu_item_6)) > 0)
																									@foreach (json_decode($form->submenu_item_6) as $sub6_item)
																									@if ($sub6_item)
																									<div class="form-group website-submenu-item">
																										<button type="button" class="btn btn-danger btn-link remove-submenu">
																											<span class="fa fa-close text-danger"></span>
																										</button>
																										<input type="text" name="submenu_item_6[]" class="submenu-item" value="{{$sub6_item?$sub6_item:''}}"></div>
																									@endif
																									@endforeach
																								@endif
																							</div>
																						</div>
																						<div class="form-group text-left">
																							<button type="button" class="btn-round btn-success no-border add-submenu" data-menu-id="6" id="add_submenu_6"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="add_submenu_6">&nbsp;Submenu</label> 
																						</div>
																					</div>
																					<div class="col-md-3">
																						<h3 class="text-dark-light">Contact</h3>
																					</div>
																				</div>
																			</div>
																			@if ($errors->has('menu_item_1'))
																			<div class="col-md-12">
																				<span class="error text-danger float-none" for="menu_item_1">{{ $errors->first('menu_item_1') }}</span>
																			</div>
																			@endif
																		</div>
                                    <div class="row no-mh">
                                        <div class="form-group col-md-8 col-md-offset-2 mt-30 mb-30">
                                            <textarea name="menu_comment" id="menu_comment" rows="5" placeholder="Opmerkingen:">{{ $form->menu_comment ? $form->menu_comment : old('menu_comment') }}</textarea>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-30">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 1 van 2</h4>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="row mb-30 no-mh">
                                        <h2 class="text-dark-light">Welke social media kanalen wilt u op de website?</h2>
                                    </div>
                                    <div class="row mb-20">
                                        <div class="social-media">
											@if ($form->social_links && countArray(json_decode($form->social_links)) > 0)
											@foreach (json_decode($form->social_links) as $social_link)
											@if ($social_link)
											@if ($loop->first)
											<div class="media-item">
												<div class="col-md-4 col-md-offset-4 form-group">
													<input type="text" name="social_links[]" class="input-sm input-full" placeholder="Bedrijfspagina link:" value="{{ $social_link }}">
												</div>
											</div>
											@else
											<div class="media-item"><div class="col-md-12"><hr class="text-dark-light border-top-dash"></div><div class="col-md-4 col-md-offset-4 form-group mt-30 text-left"><input type="text" name="social_links[]" class="input-sm mt-15 input-social" placeholder="Bedrijfspagina link:" value="{{ $social_link }}"><button type="button" class="btn btn-danger btn-link remove-social"><span class="fa fa-close text-danger"></span></button><br></div></div>
											@endif
											@endif
											@endforeach
											@else
											<div class="media-item">
												<div class="col-md-4 col-md-offset-4 form-group">
													<input type="text" name="social_links[]" class="input-sm input-full" placeholder="Bedrijfspagina link:">
												</div>
											</div>
											@endif
										</div>
                                        <div class="col-md-4 col-md-offset-4 text-left mt-20"><button type="button" class="btn-round btn-success no-border" id="more_social"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="more_social">&nbsp;Voeg social media kanaal toe</label> </div>
                                        @if ($errors->has('social_links.0'))
                                            <div class="col-md-4 col-md-offset-4">
                                                <span class="error text-danger" for="social_links">{{ $errors->first('social_links.0') }}</span>
                                            </div>                                                
                                        @endif
                                    </div>
                                    <ul class="list-inline">
                                        <li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
                                        <li class="mb-10"><button type="submit" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.submit')</button></li>
                                    </ul>
                                    <div class="mt-30">
                                        <h4>Stap 2 van 2</h4>
                                    </div>
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
        $('.add-submenu').on('click', function() {
            var menu_id = $(this).data('menu-id');
            var html = '<div class="form-group website-submenu-item"><button type="button" class="btn btn-danger btn-link remove-submenu"><span class="fa fa-close text-danger"></span></button><input type="text" name="submenu_item_' + menu_id + '[]" class="submenu-item"></div>';
            var p_class = '.website-menu-' + menu_id;
            $(p_class).append(html);
        });

        $('#more_social').click(function() {
            html = '<div class="media-item"><div class="col-md-12"><hr class="text-dark-light border-top-dash"></div><div class="col-md-4 col-md-offset-4 form-group mt-20 text-left"><input type="text" name="social_links[]" class="input-sm input-social" placeholder="Bedrijfspagina link:"><button type="button" class="btn btn-danger btn-link remove-social"><span class="fa fa-close text-danger"></span></button><br></div></div>';
            $('.social-media').append(html);
        });
        
    });
    
    $(document).on('click', '.remove-submenu', function() {
        $(this).parent('.form-group').remove();
    });

    $(document).on('click', '.remove-social', function() {
        $(this).closest('.media-item').remove();
    });
    
</script>
@endpush
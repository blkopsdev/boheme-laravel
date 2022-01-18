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
								<li role="presentation" class="disabled">
									<a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4">
										<span class="round-tab">
											<div class="numberCircle">4</div>
										</span>
									</a>
								</li>
								<li role="presentation" class="disabled">
									<a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5">
										<span class="round-tab">
											<div class="numberCircle">5</div>
										</span>
									</a>
								</li>
								<li role="presentation" class="disabled">
									<a href="#step6" data-toggle="tab" aria-controls="step6" role="tab" title="Step 6">
										<span class="round-tab">
											<div class="numberCircle">6</div>
										</span>
									</a>
								</li>
								<li role="presentation" class="disabled">
									<a href="#step7" data-toggle="tab" aria-controls="step7" role="tab" title="Step 7">
										<span class="round-tab">
											<div class="numberCircle">7</div>
										</span>
									</a>
								</li>
								<li role="presentation" class="disabled">
									<a href="#step8" data-toggle="tab" aria-controls="step8" role="tab" title="Step 8">
										<span class="round-tab">
											<div class="numberCircle">8</div>
										</span>
									</a>
								</li>

								<li role="presentation" class="disabled">
									<a href="#step9" data-toggle="tab" aria-controls="step9" role="tab" title="Step 9">
										<span class="round-tab">
											<div class="numberCircle">9</div>
										</span>
									</a>
								</li>
								
								<li role="presentation" class="disabled">
									<a href="#step10" data-toggle="tab" aria-controls="step10" role="tab" title="Step 10">
										<span class="round-tab">
											<div class="numberCircle">10</div>
										</span>
									</a>
								</li>

								<li role="presentation" class="disabled">
									<a href="#step11" data-toggle="tab" aria-controls="step11" role="tab" title="Step 11">
										<span class="round-tab">
											<div class="numberCircle">11</div>
										</span>
									</a>
								</li>

								{{-- <li role="presentation" class="disabled">
									<a href="#step12" data-toggle="tab" aria-controls="step12" role="tab" title="Step 12">
										<span class="round-tab">
											<div class="numberCircle">12</div>
										</span>
									</a>
								</li> --}}
							</ul>
						</div>

						<form method="POST" enctype="multipart/form-data" action="" class="multistep onboarding">
							<input type="hidden" name="quick_save" value="0" id="quick_save">
							<div class="tab-content">
								<div class="tab-pane active" role="tabpanel" id="step0">
									<div class="tab-pane-title py-100">
										<h1 class="text-dark-light" style="font-size:50px;">@lang('app.website_briefing')</h1>
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
									<div class="row mb-30">
										<h2 class="text-dark-light">Wat is de doelstelling van de website? <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.purpose_tooltip')"></i></h2>
										<div class="form-group mt-30">
											<div class="btn-group purpose mt-30 mb-30" data-toggle="buttons">
												<label class="btn btn-default btn-round {{ $form->purpose == 0 ? 'active' : '' }}">
													<input type="radio" name="purpose" value="0" autocomplete="off" {{ $form->purpose == 0 ? 'checked' : '' }}> Actie gericht
												</label>
												<label class="btn btn-default btn-round {{ $form->purpose == 1 ? 'active' : '' }}">
													<input type="radio" name="purpose" value="1" autocomplete="off" {{ $form->purpose == 1 ? 'checked' : '' }}> Informatief
												</label>
												<label class="btn btn-default btn-round {{ $form->purpose == 2 ? 'active' : '' }}">
													<input type="radio" name="purpose" value="2" autocomplete="off" {{ $form->purpose == 2 ? 'checked' : '' }}> Lead generator
												</label>
												<label class="btn btn-default btn-round {{ $form->purpose == 3 ? 'active' : '' }}">
													<input type="radio" name="purpose" value="3" autocomplete="off" {{ $form->purpose == 3 ? 'checked' : '' }}> Overig
												</label>
											</div>
											<div class="col-md-8 col-md-offset-2 mt-30 mb-30">
												<textarea name="purpose_comment" id="purpose_comment" rows="5" placeholder="Opmerkingen:">{{ $form->purpose_comment ? $form->purpose_comment : old('purpose_comment') }}</textarea>
											</div>
										</div>
									</div>
									<ul class="list-inline mt-30">
										<li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
										<li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
									</ul>
									<div class="mt-30">
										<h4>Stap 1 van 11</h4>
									</div>
								</div>
								<div class="tab-pane" role="tabpanel" id="step2">
									<div class="row">
										<h2 class="text-dark-light">Waar moet de focus op liggen? <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.onboarding_focus_tooltip')"></i></h2>
										<div class="form-group mt-30">
											<div class="btn-group focus mb-30 col-md-8 col-md-offset-2" data-toggle="buttons">
												<label class="btn btn-default btn-round {{ $form->focus == 0 ? 'active' : '' }}">
													<input type="radio" name="focus" value="0" autocomplete="off" {{ $form->focus == 0 ? 'checked' : '' }}>Contact opnemen
												</label>
												<label class="btn btn-default btn-round {{ $form->focus == 1 ? 'active' : '' }}">
													<input type="radio" name="focus" value="1" autocomplete="off" {{ $form->focus == 1 ? 'checked' : '' }}>Offerte aanvragen
												</label>
												<label class="btn btn-default btn-round {{ $form->focus == 2 ? 'active' : '' }}">
													<input type="radio" name="focus" value="2" autocomplete="off" {{ $form->focus == 2 ? 'checked' : '' }}>Afspraak maken
												</label>
												<label class="btn btn-default btn-round {{ $form->focus == 3 ? 'active' : '' }}">
													<input type="radio" name="focus" value="3" autocomplete="off" {{ $form->focus == 3 ? 'checked' : '' }}>Overig
												</label>
												<label class="btn btn-default btn-round {{ $form->focus == 4 ? 'active' : '' }}">
													<input type="radio" name="focus" value="4" autocomplete="off" {{ $form->focus == 4 ? 'checked' : '' }}>Uw portfolio
												</label>
											</div>
											<div class="col-md-8 col-md-offset-2 mt-30 mb-30">
												<textarea name="focus_comment" id="focus_comment" rows="5" placeholder="Opmerkingen:">{{ $form->focus_comment ? $form->focus_comment: '' }}</textarea>
											</div>
										</div>
									</div>
									<ul class="list-inline">
										<li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
										<li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
									</ul>
									<div class="mt-30">
										<h4>Stap 2 van 11</h4>
									</div>
								</div>
								<div class="tab-pane" role="tabpanel" id="step3">
									<div class="row no-mh">
										<h2 class="mb-30 text-dark-light">Wat is de site structuur die u in gedachten heeft? <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.onboarding_menu_tooltip')"></i></h2>
										<p class="mb-30">Let op: niet alle velden hoeven ingevuld te worden.</p>
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
										<h4>Stap 3 van 11</h4>
									</div>
								</div>
								<div class="tab-pane" role="tabpanel" id="step4">
									<div class="row">
										<h2 class="mb-30 text-dark-light"><strong>Upload uw logo</strong></h2>
										<h4 class="text-dark-light">Indien wij al uw logo hebben gemaakt kunt u deze stap overslaan.</h4>
										<h4 class="text-dark-light mb-30"><strong>LET OP: het logo moet transparant zijn! (.png)</strong></h4>
										@if ($form->logo_file)
										<div class="uploaded-files text-left col-md-6 col-md-offset-3">
											<h4>@lang('form.uploaded_files')</h4>
											<button type="button" class="btn btn-danger btn-link  p-0 file-remove" data-id="{{ $form->logo_file->id }}"><span class="fa fa-close text-danger"></span></button>
											<a href="{{ asset('uploads/' . $form->logo_file->media_name) }}" target="_blank">{{ $form->logo_file->media_name }}</a>
										</div>
										@endif
										<div class="form-group col-md-6 col-md-offset-3 mt-15 {{ $form->logo_file ? 'hide' : '' }}">
											<p class="mt-30 text-dark-light">
												Indien gewenst kunt u dit logo ook later naar ons sturen
											</p>
											<input type="file" name="logo_name" id="logo_name" class="form-control">
										</div>
									</div>
									<ul class="list-inline mt-30">
										<li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
										<li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
									</ul>
									<div class="mt-30">
										<h4>Stap 4 van 11</h4>
									</div>
								</div>
								<div class="tab-pane" role="tabpanel" id="step5">
									<div class="row mb-30">
										<div class="form-group mt-30 has-domain col-md-12 {{ $form->has_domain != 0 ? 'hide' : '' }}">
											<h2 class="text-dark-light">Heeft u uw domein al geregistreerd? <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.onboarding_domain_tooltip')"></i></h2>
											<div class="row">
												<div class="btn-group domain-register mt-30 mb-30" data-toggle="buttons">
													<label class="btn btn-default btn-round {{ $form->has_domain == 1 ? 'active' : '' }}" for="has_domain_yes">
														<input type="radio" name="has_domain" value="1" id="has_domain_yes" {{ $form->has_domain == 1 ? 'checked' : '' }}> Ja
													</label>
													<label class="btn btn-default btn-round {{ $form->has_domain == 2 ? 'active' : '' }}" for="has_domain_no">
														<input type="radio" name="has_domain" value="2" id="has_domain_no" {{ $form->has_domain == 2 ? 'checked' : '' }}> Nee
													</label>
												</div>
											</div>
											<ul class="list-inline mt-30">
												<li><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
												{{-- <li><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li> --}}
											</ul>
											<div class="mt-30">
												<h4>Stap 5 van 11</h4>
											</div>
										</div>
										<div class="col-md-12 domain-info {{ $form->has_domain != 1 ? 'hide' : '' }} mt-30">
											<div class="row no-mh">
												<h3 class="text-dark-light">Wat is uw domeinnaam? </h3>
												<div class="col-md-6 col-md-offset-3 mt-20 mb-30">
													<div class="form-group">
														<input type="text" name="domain_name" id="domain_name" placeholder="www.example.nl" class="input-default form-control" value="{{ $form->domain_name? $form->domain_name: old('domain_name')}}">
													</div>
													@if ($errors->has('domain_name'))
													<span class="error text-danger float-none" for="domain_name">{{ $errors->first('domain_name') }}</span>
													@endif
												</div>
											</div>
											<div class="row no-mh">
												<h3 class="text-dark-light">Wat zijn de inlog gegevens van de provider? <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.onboarding_login_tooltip')"></i></h3>
												<h4 class="text-dark-light">Providers zoals: Transip, Yourhosting, Mijndomein</h4>
												<div class="col-md-6 col-md-offset-3 mb-15 mt-20">
													<div class="form-group">
														<input type="text" name="domain_provider" id="domain_provider" placeholder="Naam provider" class="input-default form-control" value="{{ $form->domain_provider? $form->domain_provider: old('domain_provider') }}">
													</div>
													@if ($errors->has('domain_provider'))
													<span class="error text-danger float-none" for="domain_provider">{{ $errors->first('domain_provider') }}</span>
													@endif
												</div>
												<div class="col-md-6 col-md-offset-3 mb-15">
													<div class="form-group">
														<input type="text" name="domain_username" id="domain_username" placeholder="Username / Email" class="input-default form-control" value="{{ $form->domain_username? $form->domain_username: old('domain_username') }}">
													</div>
													@if ($errors->has('domain_username'))
													<span class="error text-danger float-none" for="domain_username">{{ $errors->first('domain_username') }}</span>
													@endif
												</div>
												<div class="col-md-6 col-md-offset-3 mb-15">
													<div class="form-group">
														<input type="text" name="domain_password" id="domain_password" placeholder="Wachtwoord" class="input-default form-control" value="{{ $form->domain_password? $form->domain_password: old('domain_password') }}">
													</div>
													@if ($errors->has('domain_password'))
													<span class="error text-danger float-none" for="domain_password">{{ $errors->first('domain_password') }}</span>
													@endif
												</div>
											</div>
											<ul class="list-inline mt-30">
												<li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round go-has-domain">@lang('app.go_back')</button></li>
												<li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step">@lang('app.proceed')</button></li>
											</ul>
											<div class="mt-30">
												<h4>Stap 5a van 11</h4>
											</div>
										</div>
										<div class="col-md-12 no-domain mt-30 {{ $form->has_domain != 2 ? 'hide' : '' }}">
											<h3 class="text-dark-light mb-20">
												Hier volgt een stappenplan hoe u zelf uw domein kunt registreren:
										</h3>
										<h4 class="text-dark-light" style="line-height: 22px;">In onderstaande filmpje leggen wij uit hoe u zelf een domein kunt registreren? <br><strong>Dit is binnen 1-2 minuten geregeld!</strong></h4>
											<div class="py-20">
												<iframe class="embed-responsive-item no-border" src="https://www.youtube.com/embed/iN2KaYApxWY?rel=0" width="480" height="270"></iframe>
											</div>
											<a href="https://www.transip.nl" target="__blank" style="font-size:24px;">www.transip.nl</a>

											<ul class="list-inline mt-30">
												<li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round go-has-domain">@lang('app.go_back')</button></li>
												<li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round go-domain-info">@lang('app.proceed')</button></li>
											</ul>
											<div class="mt-30">
												<h4>Stap 5a van 11</h4>
											</div>
										</div>
									</div>
									
								</div>
								<div class="tab-pane" role="tabpanel" id="step6">
									<div class="row mb-30">
										<h2 class="text-dark-light">Welke bestaande websites spreken u aan?</h2>
										<div class="col-md-4 col-md-offset-4 ref-websites pt-20">
											@if ($form->ref_websites && countArray(json_decode($form->ref_websites)) > 0)
												@foreach (json_decode($form->ref_websites) as $ref_website)
													@if ($ref_website)
													<div class="form-group">
														<input type="text" name="ref_websites[]" class="input-default form-control" value="{{ $ref_website }}">
													</div>
													@endif
												@endforeach
											@else
												<div class="form-group">
													<input type="text" name="ref_websites[]" class="input-default form-control" placeholder="www.example.nl">
												</div>
												<div class="form-group">
													<input type="text" name="ref_websites[]" class="input-default form-control">
												</div>
												<div class="form-group">
													<input type="text" name="ref_websites[]" class="input-default form-control">
												</div>
												<div class="form-group">
													<input type="text" name="ref_websites[]" class="input-default form-control">
												</div>
											@endif
										</div>
										<div class="form-group col-md-4 col-md-offset-4 mt-15 text-left">
											<button type="button" class="btn-round btn-success no-border ml-20" id="more_ref"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="more_ref">&nbsp;Website toevoegen</label> 
										</div>
										@if ($errors->has('ref_websites.0'))
										<div class="col-md-12">
											<span class="error text-danger float-none" for="ref_websites">{{ $errors->first('ref_websites.0') }}</span>
										</div>
										@endif
									</div>
									<ul class="list-inline">
										<li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
										<li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
									</ul>
									<div class="mt-30">
										<h4>Stap 6 van 11</h4>
									</div>
								</div>
								<div class="tab-pane" role="tabpanel" id="step7">
									<div class="row mb-30">
										<h2 class="text-dark-light">Op welke <strong>zoekwoorden</strong> wilt u worden gevonden op <strong>Google</strong>? <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.onboarding_google_tooltip')"></i></h2>
										<div class="col-md-4 col-md-offset-4 seo-keywords pt-20">
											@if ($form->seo_keywords && countArray(json_decode($form->seo_keywords)) > 0)
												@foreach (json_decode($form->seo_keywords) as $keyword)
												@if ($keyword)
												<div class="form-group">
													<input type="text" name="seo_keywords[]" class="input-default form-control" value="{{ $keyword }}">
												</div>
												@endif
												@endforeach
											@else
												<div class="form-group">
													<input type="text" name="seo_keywords[]" class="input-default form-control">
												</div>
												<div class="form-group"><input type="text" name="seo_keywords[]" class="input-default form-control"></div>
												<div class="form-group"><input type="text" name="seo_keywords[]" class="input-default form-control"></div>
												<div class="form-group"><input type="text" name="seo_keywords[]" class="input-default form-control"></div>
											@endif
										</div>
										<div class="form-group col-md-4 col-md-offset-4 mt-15 text-left">
											<button type="button" class="btn-round btn-success no-border ml-20" id="more_keyword"><i class="fa fa-plus"></i></button><label class="text-dark-light" for="more_keyword">&nbsp;Zoekwoord toevoegen</label> 
										</div>
										@if ($errors->has('seo_keywords.0'))
										<div class="col-md-12">
											<span class="error text-danger float-none" for="seo_keywords">{{ $errors->first('seo_keywords.0') }}</span>
										</div>
										@endif
									</div>
									<ul class="list-inline">
										<li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
										<li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
									</ul>
									<div class="mt-30">
										<h4>Stap 7 van 11</h4>
									</div>
								</div>
								{{-- <div class="tab-pane" role="tabpanel" id="step8">
									<div class="row mb-30">
										<h2 class="text-dark-light">Kies uw layout: <i class="fa fa-question-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="@lang('form.onboarding_layout_tooltip')"></i></h2>
										<div class="col-md-12 demo-layout">
											<div class="row">
												<div class="col-md-6 p-15">
													<div class="row no-mh">
														<div class="col-md-12">
															<input type="radio" name="layout" id="layout_1" class="input-hidden" value="0"
																@if (old('layout') && old('layout') == 0) checked @elseif($form->layout == 0 && !old('layout')) checked @endif
															/>
															<label for="layout_1" class="layout-type">
																<img src="{{ asset('assets/img/demos/Consulting.jpg') }}" alt="" class="img-responsive"/>
															  </label>
														</div>
													</div>
													<div class="row no-mh mt-20">
														<div class="col-md-6">
															<a href="http://consulting.iqscript.nl/" class="btn btn-success btn-round" target="__blank">Layout bekijken</a>
														</div>
														<div class="col-md-6">
															<h3 class="text-dark-light mb-0 mt-10">Consulting</h3>
														</div>
													</div>
												</div>
												<div class="col-md-6 p-15">
													<div class="row no-mh">
														<div class="col-md-12">
															<input type="radio" name="layout" id="layout_2" class="input-hidden" value="1"
															@if (old('layout') && old('layout') == 1) checked @elseif($form->layout == 1 && !old('layout')) checked @endif
															/>
															<label for="layout_2" class="layout-type">
																<img src="{{ asset('assets/img/demos/Estate.jpg') }}" alt="" class="img-responsive"/>
															</label>
														</div>
													</div>
													<div class="row no-mh mt-20">
														<div class="col-md-6">
															<a href="http://estate.iqscript.nl/" target="__blank" class="btn btn-success btn-round">Layout bekijken</a>
														</div>
														<div class="col-md-6">
															<h3 class="text-dark-light mb-0 mt-10">Estate</h3>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 p-15">
													<div class="row no-mh">
														<div class="col-md-12">
															<input type="radio" name="layout" id="layout_3" class="input-hidden" value="2"
															@if (old('layout') && old('layout') == 2) checked @elseif($form->layout == 2 && !old('layout')) checked @endif
															/>
															<label for="layout_3" class="layout-type">
																<img src="{{ asset('assets/img/demos/Business.jpg') }}" alt="" class="img-responsive"/>
															</label>
														</div>
													</div>
													<div class="row no-mh mt-20">
														<div class="col-md-6">
															<a href="http://business.iqscript.nl/" class="btn btn-success btn-round" target="__blank">Layout bekijken</a>
														</div>
														<div class="col-md-6">
															<h3 class="text-dark-light mb-0 mt-10">Business</h3>
														</div>
													</div>
												</div>
												<div class="col-md-6 p-15">
													<div class="row no-mh">
														<div class="col-md-12">
															<input type="radio" name="layout" id="layout_4" class="input-hidden" value="3"
															@if (old('layout') && old('layout') == 3) checked @elseif($form->layout == 3 && !old('layout')) checked @endif
															/>
															<label for="layout_4" class="layout-type">
																<img src="{{ asset('assets/img/demos/Eco.jpg') }}" alt="" class="img-responsive"/>
															</label>
														</div>
													</div>
													<div class="row no-mh mt-20">
														<div class="col-md-6">
															<a href="http://eco.iqscript.nl/" class="btn btn-success btn-round" target="__blank">Layout bekijken</a>
														</div>
														<div class="col-md-6">
															<h3 class="text-dark-light mb-0 mt-10">Eco</h3>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 p-15">
													<div class="row no-mh">
														<div class="col-md-12">
															<input type="radio" name="layout" id="layout_5" class="input-hidden" value="4"
															@if (old('layout') && old('layout') == 4) checked @elseif($form->layout == 4 && !old('layout')) checked @endif
															/>
															<label for="layout_5" class="layout-type">
																<img src="{{ asset('assets/img/demos/Shipping.jpg') }}" alt="" class="img-responsive"/>
															</label>
														</div>
													</div>
													<div class="row no-mh mt-20">
														<div class="col-md-6">
															<a href="http://shipping.iqscript.nl/" class="btn btn-success btn-round" target="__blank">Layout bekijken</a>
														</div>
														<div class="col-md-6">
															<h3 class="text-dark-light mb-0 mt-10">Shipping</h3>
														</div>
													</div>
												</div>
												<div class="col-md-6 p-15">
													<div class="row no-mh">
														<div class="col-md-12">
															<input type="radio" name="layout" id="layout_6" class="input-hidden" value="5"
															@if (old('layout') && old('layout') == 5) checked @elseif($form->layout == 5 && !old('layout')) checked @endif
															/>
															<label for="layout_6" class="layout-type">
																<img src="{{ asset('assets/img/demos/Agency.jpg') }}" alt="" class="img-responsive"/>
															</label>
														</div>
													</div>
													<div class="row no-mh mt-20">
														<div class="col-md-6">
															<a href="http://agency.iqscript.nl/" class="btn btn-success btn-round" target="__blank">Layout bekijken</a>
														</div>
														<div class="col-md-6">
															<h3 class="text-dark-light mb-0 mt-10">Agency</h3>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 p-15">
													<div class="row no-mh">
														<div class="col-md-12">
															<input type="radio" name="layout" id="layout_7" class="input-hidden" value="6"
															@if (old('layout') && old('layout') == 6) checked @elseif($form->layout == 6 && !old('layout')) checked @endif
															/>
															<label for="layout_7" class="layout-type">
																<img src="{{ asset('assets/img/demos/Corporate.jpg') }}" alt="" class="img-responsive"/>
															</label>
														</div>
													</div>
													<div class="row no-mh mt-20">
														<div class="col-md-6">
															<a href="http://corporate.iqscript.nl/" class="btn btn-success btn-round" target="__blank">Layout bekijken</a>
														</div>
														<div class="col-md-6">
															<h3 class="text-dark-light mb-0 mt-10">Corporate</h3>
														</div>
													</div>
												</div>
												<div class="col-md-6 p-15">
													<div class="row no-mh">
														<div class="col-md-12">
															<input type="radio" name="layout" id="layout_10" class="input-hidden" value="9"
															@if (old('layout') && old('layout') == 9) checked @elseif($form->layout == 9 && !old('layout')) checked @endif
															/>
															<label for="layout_10" class="layout-type">
																<img src="{{ asset('assets/img/demos/Restaurant.jpg') }}" alt="" class="img-responsive"/>
															</label>
														</div>
													</div>
													<div class="row no-mh mt-20">
														<div class="col-md-6">
															<a href="http://restaurant.iqscript.nl/" class="btn btn-success btn-round" target="__blank">Layout bekijken</a>
														</div>
														<div class="col-md-6">
															<h3 class="text-dark-light mb-0 mt-10">Restaurant</h3>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-8 col-md-offset-2 mt-30 mb-30">
											<textarea name="layout_comment" class="form-control" id="layout_comment" rows="5" placeholder="Opmerkingen:">{{ $form->layout_comment ? $form->layout_comment : old('layout_comment') }}</textarea>
										</div>
									</div>
									<ul class="list-inline">
										<li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
										<li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
									</ul>
									<div class="mt-30">
										<h4>Stap 8 van 11</h4>
									</div>
								</div> --}}
								<div class="tab-pane" role="tabpanel" id="step8">
									<div class="row mb-30">
										<h2 class="text-dark-light mb-30">Foto's voor de website</h2>
										<div class="form-group col-md-6 col-md-offset-3 text-left mt-15 image-source">
											<label for="image_source_1" class="text-dark-light font-weight-default"><input type="radio" name="image_source" id="image_source_1" value="0"{{ $form->image_source == 0 ? 'checked' : '' }}> Ik lever mijn eigen foto's aan</label>
										</div>
										<div class="form-group col-md-6 col-md-offset-3 text-left image-source">
											<label for="image_source_2" class="text-dark-light font-weight-default"><input type="radio" name="image_source" id="image_source_2" value="1" {{ $form->image_source == 1 ? 'checked' : '' }}> Ik wil gebruik maken van een foto database</label>
										</div>
										<div class="form-group col-md-6 col-md-offset-3 text-left image-source">
											<label for="image_source_3" class="text-dark-light font-weight-default"><input type="radio" name="image_source" id="image_source_3" value="2" {{ $form->image_source == 2 ? 'checked' : '' }}> Ik wil dat jullie de foto's voor mij uitkiezen (+ €59,—)</label>
										</div>
									</div>
									<ul class="list-inline">
										<li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
										<li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
									</ul>
									<div class="mt-30">
										<h4>Stap 8 van 11</h4>
									</div>
								</div>
								<div class="tab-pane" role="tabpanel" id="step9">
									<div class="row mb-30 no-mh">
										<h2 class="text-dark-light mb-30">Welke contact gegevens kunnen we gebruiken op de website?</h2>
									</div>
									<div class="row mb-20">
										<div class="col-md-6 col-md-offset-3 form-group">
											<input type="text" name="contact_phone" id="contact_phone" class="input-md" placeholder="Telefoon:" value="{{ $form->contact_phone ? $form->contact_phone : old('contact_phone') }}">
											@if ($errors->has('contact_phone'))
												<span class="error text-danger" for="contact_phone">{{ $errors->first('contact_phone') }}</span>
											@endif
										</div>
										<div class="col-md-6 col-md-offset-3 form-group">
											<input type="text" name="contact_mail" id="contact_mail" class="input-md" placeholder="Mail:" value="{{ $form->contact_mail ? $form->contact_mail : old('contact_mail') }}">
											@if ($errors->has('contact_mail'))
												<span class="error text-danger" for="contact_mail">{{ $errors->first('contact_mail') }}</span>
											@endif
										</div>
										<div class="col-md-6 col-md-offset-3 form-group">
											<input type="text" name="contact_address" id="contact_address" class="input-md" placeholder="Adres:" value="{{ $form->contact_address ? $form->contact_address : old('contact_address') }}">
											@if ($errors->has('contact_address'))
												<span class="error text-danger" for="contact_address">{{ $errors->first('contact_address') }}</span>
											@endif
										</div>
									</div>
									<ul class="list-inline">
										<li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
										<li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
									</ul>
									<div class="mt-30">
										<h4>Stap 9 van 11</h4>
									</div>
								</div>
								<div class="tab-pane" role="tabpanel" id="step10">
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
										<li class="mb-10"><button type="button" class="btn btn-success btn-lg btn-round next-step proceed">@lang('app.proceed')</button></li>
									</ul>
									<div class="mt-30">
										<h4>Stap 10 van 11</h4>
									</div>
								</div>
								<div class="tab-pane" role="tabpanel" id="step11">
									<h2>@lang('form.website_color_question')</h2>
									<div class="row card-box">
										<div class="card col-md-3">
											<div class="card-body">
												<h4 class="card-title">Hoofdkleur</h4>
												<div class="form-group">
													<input type="text" id="main_color" name="main_color" class="form-control color-picker" value="">
												</div>
											</div>
										</div>
										<div class="card col-md-3">
											<div class="card-body">
												<h4 class="card-title">Subkleur 1</h4>
												<div class="form-group">
													<input type="text" id="sub_color_1" name="sub_color_1" class="form-control color-picker" value="">
												</div>
											</div>
										</div>
										<div class="card col-md-3">
											<div class="card-body">
												<h4 class="card-title">Subkleur 2</h4>
												<div class="form-group">
													<input type="text" id="sub_color_2" name="sub_color_2" class="form-control color-picker" value="">
												</div>
											</div>
										</div>
									</div>
									<div class="row no-mh">
										<div class="form-group col-md-6 col-md-offset-3 logo-color mb-30 text-left">
											<label for="website_color"><input type="checkbox" name="website_color" id="website_color" value="1" {{ $form->website_color == 1 ? 'checked' : '' }}> @lang('form.no_decision_color')</label>
										</div>
										<div class="form-group col-md-6 col-md-offset-3 logo-color mb-30 text-left">
											<label for="use_logo_color"><input type="checkbox" name="use_logo_color" id="use_logo_color" value="1" {{ $form->use_logo_color == 1 ? 'checked' : '' }}> @lang('form.use_logo_color')</label>
										</div>
									</div>
									@if ($errors->has('main_color'))
										<div class="row no-mh">
												<div class="col-md-12 text-center">
														<div class="col-md-12 mb-30">
																<span class="error text-danger float-none" for="main_color">{{ $errors->first('main_color') }}</span>
														</div>
												</div>
										</div>
										@endif
									<ul class="list-inline">
										<li class="mb-10"><button type="button" class="btn btn-dark-light btn-lg btn-round prev-step">@lang('app.go_back')</button></li>
										<li class="mb-10"><button type="submit" class="btn btn-success btn-lg btn-round next-step">@lang('app.submit')</button></li>
									</ul>
									<div class="mt-30">
											<h4>Stap 11 van 11</h4>
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

		$('#more_ref').on('click', function() {
			html = '<div class="form-group"><input type="text" name="ref_websites[]" class="input-default form-control"></div>';
			$('.ref-websites').append(html);
		});

		$('#more_keyword').click(function() {
			html = '<div class="form-group"><input type="text" name="seo_keywords[]" class="input-default form-control"></div>';
			$('.seo-keywords').append(html);
		});

		$('#more_social').click(function() {
			html = '<div class="media-item"><div class="col-md-12"><hr class="text-dark-light border-top-dash"></div><div class="col-md-4 col-md-offset-4 form-group mt-30 text-left"><input type="text" name="social_links[]" class="input-sm mt-15 input-social" placeholder="Bedrijfspagina link:"><button type="button" class="btn btn-danger btn-link remove-social"><span class="fa fa-close text-danger"></span></button><br></div></div>';
			$('.social-media').append(html);
		});

		$('.domain-register .btn').click(function() {
			var value = $(this).find('input').val();
			$('.has-domain').addClass('hide');
			if(value == 1) {
				$('.no-domain').addClass('hide');
				$('.domain-info').removeClass('hide');
			} else {
				$('.no-domain').removeClass('hide');
				$('.domain-info').addClass('hide');
			}
		});

		
	});
	
	$(document).on('click', '.remove-submenu', function() {
		$(this).parent('.form-group').remove();
	});

	$(document).on('click', '.remove-social', function() {
		$(this).closest('.media-item').remove();
	});
	$(document).on('click', '.go-has-domain', function(){
		$('.has-domain').removeClass('hide');
		$('.no-domain').addClass('hide');
		$('.domain-info').addClass('hide');
	});
	$(document).on('click', '.go-domain-info', function() {
		$('.no-domain').addClass('hide');
		$('.domain-info').removeClass('hide');
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
		$(this).closest('.row').find('.hide').removeClass('hide');
		$(this).closest('.uploaded-files').remove();
	})	
</script>
@endpush
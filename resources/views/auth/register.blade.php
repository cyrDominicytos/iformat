@extends('layouts.auth_layouts')
@section('content')
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative customBg" >
					<!--begin::Wrapper-->
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
						<!--begin::Content-->
						<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
							<!--begin::Logo-->
							<a href="../../demo12/dist/index.html" class="py-9 mb-5">
								<img alt="Logo" src="http://www.win-africa.com/images/logo.png" class="h-60px" />
							</a>
							<!--end::Logo-->
							<!--begin::Title-->
							<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #fff;">Bienvenue sur <?= getenv('APP_NAME') ?></h1>
							<!--end::Title-->
							<!--begin::Description-->
							<p class="fw-bold fs-2" style="color: #fff;">Votre Plateforme de suivi des formations</p>
							<!--end::Description-->
						</div>
						<!--end::Content-->
						<!--begin::Illustration-->
						<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px">
                             <!-- Owl-Carousel -->
                             <div class="owl-carousel owl-theme">
                                <img src="{{ asset('assets/media/presentation/pre1.png') }}" alt="" class="login_img">
                                <img src="{{ asset('assets/media/presentation/pre2.png') }}" alt="" class="login_img">
                                <img src="{{ asset('assets/media/presentation/pre3.png') }}" alt="" class="login_img">
                                <img src="{{ asset('assets/media/presentation/pre4.png') }}" alt="" class="login_img">
                                <img src="{{ asset('assets/media/presentation/pre5.png') }}" alt="" class="login_img">                                
                            </div>
                            <!-- /Owl-Carousel --> 
                       </div>
						<!--end::Illustration-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-600px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" action="<?= isset($old_user) ? route('user.edit') : route('register') ?>" method="post">
							@csrf
								<?php if (isset($old_user)): ?>
								   <input type="hidden" name="id" value="<?=  $old_user->id ?>">
								<?php endif ?>
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3"><?= (isset($old_user)? ("Mise à jour d'un compte ".(isset($role_id) ? roles_list()[$role_id] : '')." sur ") : ("Créer un compte ".(isset($role_id) ? roles_list()[$role_id] : '')." sur ")) ?> <?= getenv('APP_NAME') ?></h1>
									<!--end::Title-->
									<!--begin::Link-->
									<div class="text-gray-400 fw-bold fs-4">Retournez à votre
									<a href="{{ route('home') }}" class="link-primary fw-bolder"> espace de travail</a></div>
									<!--end::Link-->
									<!-- <div id="infoMessage" style="color:red;"><?=  session()->has('message') ? (session()->get('message')) : ("")?></div> -->
								</div>
								<!--end::Heading-->
								<!--begin::Action
								<button type="button" class="btn btn-light-primary fw-bolder w-100 mb-10">
								<img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Sign in with Google</button>
								end::Action-->
								<!--begin::Separator-->
								<div class="d-flex align-items-center mb-10">
									<div class="border-bottom border-gray-300 mw-50 w-100"></div>
									<span class="fw-bold text-gray-400 fs-7 mx-2">Détails</span>
									<div class="border-bottom border-gray-300 mw-50 w-100"></div>
								</div>
								<!--end::Separator-->
								<!--begin::Input group-->
								<div class="row fv-row mb-7">
									<!--begin::Col-->
									<div class="col-xl-6">
										<label class="form-label fw-bolder text-dark fs-6">Noms <sup class="mySup">*</sup></label>
										<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="last_name" autocomplete="off" required="required" value="<?= (isset($old_user)? ($old_user->last_name) : (old("last_name")))?>"/>
										@if($errors->has('last_name'))
										<div class="fv-plugins-message-container invalid-feedback"><div data-field="last_name" data-validator="notEmpty">{{$errors->first('last_name')}}</div></div>
										@endif
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-xl-6">
										<label class="form-label fw-bolder text-dark fs-6">Prénoms <sup class="mySup">*</sup></label>
										<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="first_name" autocomplete="off" required="required" value="<?= (isset($old_user)? ($old_user->first_name) : (old("last_name")))?>"/>
										@if($errors->has('first_name'))
										<div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('first_name')}}</div></div>
										@endif
									</div>
									<!--end::Col-->
								</div>
								<div class="row fv-row mb-7">
									<!--begin::Col-->
									<div class="col-xl-6">
										<label class="form-label fw-bolder text-dark fs-6">Email <sup class="mySup">*</sup></label>
										<input class="form-control form-control-lg form-control-solid" type="email" placeholder="" name="email" autocomplete="off" rique="required" value="<?= (isset($old_user)? ($old_user->email) : (old("email")))?>"/>
										@if($errors->has('email'))
										<div class="fv-plugins-message-container invalid-feedback"><div data-field="email" data-validator="notEmpty">{{$errors->first('email')}}</div></div>
										@endif
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-xl-6">
										<label class="form-label fw-bolder text-dark fs-6">Téléphone</label>
										<input class="form-control form-control-lg form-control-solid" type="tel" placeholder="" name="phone_number" autocomplete="off" required="required" value="<?= (isset($old_user)? ($old_user->phone_number) : (old("phone_number")))?>"/>
										@if($errors->has('phone_number'))
										<div class="fv-plugins-message-container invalid-feedback"><div data-field="phone_number" data-validator="notEmpty">{{$errors->first('phone_number')}}</div></div>
										@endif
									</div>
									<!--end::Col-->
								</div>
								<div class="row fv-row mb-7">
									<!--begin::Col-->
									<div class="col-xl-12">
										<label class="form-label fw-bolder text-dark fs-6">Adresse </sup></label>
										<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="address" autocomplete="off" value="<?= (isset($old_user)? ($old_user->address) : (old("address")))?>"/>
										@if($errors->has('address'))
										<div class="fv-plugins-message-container invalid-feedback"><div data-field="last_name" data-validator="notEmpty">{{$errors->first('address')}}</div></div>
										@endif
									</div>
									<!--end::Col-->
								</div>
								@isset($role_id)
									<input type="hidden" name="user_role_id" value="{{$role_id}}" />
								@else
								<div class="row fv-row mb-7">
									<!--begin::Input group-->
                                    <div class="fv-row mb-6">
                                        <label class="form-label fw-bolder text-dark fs-6">Profile <sup class="mySup">*</sup></label>
                                        <select name="user_role_id" aria-label="Selectionnez un profile" data-control="select2" data-placeholder="Attribuer un role..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="group">

											@foreach($roles as $key=> $role)
											<option value="{{$key}}">{{$role}}</option>
											@endforeach
                                        </select>
										@if($errors->has('user_role_id'))
										<div class="fv-plugins-message-container invalid-feedback"><div data-field="last_name" data-validator="notEmpty">{{$errors->first('user_role_id')}}</div></div>
										@endif
                                    </div>
                                    <!--end::Input group-->
								</div>
								@endisset
								<!--end::Input group-->
								<div class="row fv-row mb-7">
									<!--begin::Col-->
									<div class="col-xl-6">
										<label class="form-label fw-bolder text-dark fs-6">Institution </label>
										<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="form" autocomplete="off" value="<?=old('form')?>"/>
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-xl-6">
										<label class="form-label fw-bolder text-dark fs-6">Fonction </label>
										<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="fonction" autocomplete="off" required="required" value="<?= (isset($old_user)? ($old_user->fonction) : (old("fonction")))?>"/>
									</div>
									<!--end::Col-->
								</div>
								
								<!--begin::Input group-->
								<div class="mb-10 fv-row" data-kt-password-meter="true">
									<!--begin::Wrapper-->
									<div class="mb-1">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6">Mot de passe <sup class="mySup">*</sup></label>
										<!--end::Label-->
										<!--begin::Input wrapper-->
										<div class="position-relative mb-3">
											<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" autocomplete="off" />
											<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
												<i class="bi bi-eye-slash fs-2"></i>
												<i class="bi bi-eye fs-2 d-none"></i>
											</span>
											@if($errors->has('password'))
											<div class="fv-plugins-message-container invalid-feedback"><div data-field="last_name" data-validator="notEmpty">{{$errors->first('password')}}</div></div>
											@endif
										</div>
										<!--end::Input wrapper-->
										<!--begin::Meter-->
										<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
										</div>
										<!--end::Meter-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Hint-->
									<div class="text-muted">Un mot de passe sécurisé doit contenir au moins 8 caractères avec un mélange de lettres, numbres &amp; de symboles.</div>
									<!--end::Hint-->
								</div>
								<!--end::Input group=-->
								<!--begin::Input group-->
								<div class="mb-10 fv-row" data-kt-password-meter="true">
									<!--begin::Wrapper-->
									<div class="mb-1">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6">Confirmer mot de passe <sup class="mySup">*</sup></label>
										<!--end::Label-->
										<!--begin::Input wrapper-->
										<div class="position-relative mb-3">
											<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password_confirmation" autocomplete="off" />
											<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
												<i class="bi bi-eye-slash fs-2"></i>
												<i class="bi bi-eye fs-2 d-none"></i>
											</span>
										</div>
										<!--end::Input wrapper-->
										<!--begin::Meter-->
										<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
										</div>
										<!--end::Meter-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Hint-->
									<div class="text-muted">Un mot de passe sécurisé doit contenir au moins 8 caractères avec un mélange de lettres, numbres &amp; de symboles.</div>
									<!--end::Hint-->
								</div>
								<!--end::Input group=-->
								<!--end::Input group-->
								<!--begin::Input group-->
								<!-- <div class="fv-row mb-10">
									<label class="form-check form-check-custom form-check-solid form-check-inline">
										<input class="form-check-input" type="checkbox" name="toc" value="1" id="terms" onclick="toggleTerms()"/>
										<span class="form-check-label fw-bold text-gray-700 fs-6">J'accepte
										<a href="#" class="ms-1 link-primary">Les termes et conditions</a>.</span>
									</label>
								</div> -->
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center">
									<button type="submit" id="submit" class="btn btn-lg btn-primary"  >
										<span class="indicator-label"><?= isset($old_user)? 'Mettre à jour': 'Enregistrer'?></span>
										<span class="indicator-progress">Patientez...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
						<!--begin::Links-->
						<div class="d-flex flex-center fw-bold fs-6">
							<a href="#" class="text-muted text-hover-primary px-2" target="_blank">A propos</a>
							<a href="mailto:<?= getenv('DEV_MAIL') ?>" class="text-muted text-hover-primary px-2" target="_blank">Nous contacter</a>
						</div>
						<!--end::Links-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->

	@endsection

 
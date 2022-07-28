<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
	<meta name="description" content="IFORMAT, EFORMAT, PLATEFORME DE SUIVI DES FORMATIONS EN LIGNE" />
	<meta name="keywords" content="IFORMAT, EFORMAT, PLATEFORME DE SUIVI DES FORMATIONS EN LIGNE" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'IFORMAT') }}</title>
	<link href="{{ asset('assets/custom/css/style.css') }}" rel="stylesheet" type="text/css" />
	<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
	<link rel="shortcut icon" href="{{ asset('assets/logo/logo.ico') }}" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Vendor Stylesheets(used by this page)-->
	<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Page Vendor Stylesheets-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
	<!--end::Global Stylesheets Bundle-->

	<!-- BEGIN THEME GLOBAL STYLES -->
	<link href="{{ asset('assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
	<link href="{{ asset('assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/custom/css/custom_accordion.css') }}" rel="stylesheet" type="text/css" />
	<!-- END THEME GLOBAL STYLES -->
	@yield('css')

	<style>
		tr>th {

			/* color:blue;  */
			color: #005aab;

		}

		tr>td {

			/* color:blue;  */
			color: #000;

		}

		.total {
			font-weight: bold;
			color: #000;
			margin-right: 50px;
		}
	</style>
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="page d-flex flex-row flex-column-fluid">
			<!--begin::Aside-->
			@include('components.aside')
			<!--end::Aside-->
			<!--begin::Wrapper-->
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<!--begin::Header-->
				@include('components.header')
				<!--end::Header-->
				<!--begin::Content-->
				@yield('content')
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
					<!--begin::Container-->
					<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
						<!--begin::Copyright-->
						<div class="text-dark order-2 order-md-1">
							<span class="text-muted fw-bold me-1">2022</span>
							<a href="" target="_blank" class="text-gray-800 text-hover-primary">WIN AFRICA</a>
						</div>
						<!--end::Copyright-->
						<!--begin::Menu-->
						<ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
							<li class="menu-item">
								<a href="http://www.win-africa.com/htdocs/home/" target="_blank" class="menu-link px-2">A propos de nous</a>
							</li>
							<li class="menu-item">
								<a href="mailto:cyrdominicytos@gmail.com" target="_blank" class="menu-link px-2">Equipe de développeur</a>
							</li>

						</ul>
						<!--end::Menu-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::Root-->


	<!--begin::Javascript-->
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
	<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Page Vendors Javascript(used by this page)-->
	<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
	<!--end::Page Vendors Javascript-->
	<!--begin::Page Custom Javascript(used by this page)-->
	<script src="{{ asset('assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
	
	<script src="{{ asset('assets/js/widgets.bundle.js')}}"></script>
	<script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
	<script src="{{ asset('assets/js/custom/apps/chat/chat.js')}}"></script>
	<script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
	<script src="{{ asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
	<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
	<!--end::Page Custom Javascript-->

	<!-- BEGIN THEME GLOBAL SCRIPTS -->
	<script src="{{ asset('assets/global/scripts/app.min.j')}}" type="text/javascript"></script>
	<!-- END THEME GLOBAL SCRIPTS -->
	<script src="{{ asset('assets/global/scripts/bootstrap-tabdrop.j')}}" type="text/javascript"></script>
	@yield('js')
	<!--end::Javascript-->
	<script type="text/javascript">
		var success_message = "<?= Session::get('success_message') ? Session::get('success_message') : 0 ?>";
		var error_message = "<?= Session::get('error_message') ? Session::get('error_message') : 0 ?>";
		window.onload = function() {
			if (success_message != "0" || error_message != "0") {
				var toastMixin = Swal.mixin({
					toast: true,
					icon: 'success',
					title: 'General Title',
					animation: false,
					position: 'top-right',
					showConfirmButton: false,
					timer: 5000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				});

				//success toast
				if (success_message != "0")
					toastMixin.fire({
						animation: true,
						title: success_message
					});

				//error toast
				if (error_message != "0")
					toastMixin.fire({
						title: error_message,
						icon: 'error'
					});

			}

		};
	</script>

</body>
<!--end::Body-->

</html>
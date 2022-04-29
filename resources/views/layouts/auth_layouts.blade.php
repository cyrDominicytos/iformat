<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'IFORMAT') }}</title>
    <!-- Scripts -->
	<link rel="shortcut icon" type="text/css" href="http://www.win-africa.com/images/logo.png" />
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <link href="{{ asset('assets/custom/css/style.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
    @yield('css')
</head>
<body id="kt_body" class="bg-body">
		<!--begin::Main-->
        @yield('content')
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
        <!--end::Main-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                items: 1
            });
        });
    </script>
    <!--end::Javascript-->
		<script type="text/javascript">
			var success_message = "<?= Session::get('success_message') ? Session::get('success_message') : 0 ?>";
			var error_message = "<?= Session::get('error_message') ? Session::get('error_message') : 0 ?>";
				window.onload = function ()
			{
				if(success_message!="0" || error_message!="0")
				{
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
						if(success_message!="0")
							toastMixin.fire({
							animation: true,
							title: success_message
							});
                            
						//error toast
						if(error_message!= "0")
						toastMixin.fire({
						title: error_message,
						icon: 'error'
						});

				}
						
			};
		</script>
	@yield('js')
	</body>
	<!--end::Body-->
</html>

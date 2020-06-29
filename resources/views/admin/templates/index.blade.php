<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			BAE Portal - Dashboard
		</title>
		<script>
            var base_url = '<?= url('/'); ?>';
            var site_url = '<?= url('/'); ?>';
            var site_name = '.: Portal BAE :.';
        </script>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->  
        <!--begin::Page Vendors -->
		<link href="{{ asset('admin/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors -->
		<link href="{{ asset('admin/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('admin/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/global/plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="{{ asset('admin/assets/demo/default/media/img/logo/favicon.ico') }}" />

		<!--begin::Base Scripts -->
		<script src="{{ asset('admin/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('admin/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
		<!--end::Base Scripts -->   
        <!--begin::Page Vendors -->
		<script src="{{ asset('admin/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('admin/assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
		<script src="{{ asset('admin/assets/demo/default/custom/components/forms/widgets/bootstrap-daterangepicker.js') }}" type="text/javascript"></script>
		<!--end::Page Vendors -->  
		<script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/global/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/sweetalert.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/bootstrap-filestyle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/my_validator.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/session-timeout.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/global/plugins/select2/js/select2.js') }}" type="text/javascript"></script>
		
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >

		<div class="page-loader">
			<div class="page-loader-container">
				<div class="spinner">
				  <div class="ball"></div>
				  <p class="loader-text">LOADING</p>
				</div>
			</div>
		</div>
		
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			
			@include('admin/templates/header')

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				
				@include('admin/templates/sidemenu')

				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div id="_content_">
				    	{!!$_content_!!}
				    </div>
				</div>

			</div>
			<!-- end:: Body -->
			
			@include('admin/templates/footer')
			
		</div>
		<!-- end:: Page -->

	    <!-- begin::Scroll Top -->
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->

		<!-- custom script -->
		<script type="text/javascript">
			$('.page-loader').css('background','rgba(0, 0, 0, 0.2)');
			$('.page-loader-container').css({
		        'top' : '50%',
		        'left' : '50%',
		        'margin-left' : -$('.page-loader-container').width()/2,
		        'margin-top' : -$('.page-loader-container').height()/2
		    });
			window.onload = clearLoading();
		</script>
	</body>
	<!-- end::Body -->
</html>

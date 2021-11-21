<!DOCTYPE html>

<html lang="en">



	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title><?php echo e(__('text.login')); ?> </title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">


		<!--end::Web font -->

		<!--begin::Base Styles -->
		<link href="/admin/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="/admin/assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<link href="/admin/assets/demo/demo6/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="/admin/assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Base Styles -->
		<link rel="shortcut icon" href="/admin/assets/demo/demo6/media/img/logo/favicon.ico" />
		<style>

			.m-login.m-login--2 .m-login__wrapper .m-login__container {
				width: 430px !important;
				margin: 0 auto !important;
				padding: 20px !important;
				background: #Fff !important;
				border-radius: 8px;
				border: 1px solid #fff !important;
				box-shadow: 2px 3px 7px #8a818187 !important;
			}
			.m-login.m-login--2.m-login-2--skin-1 .m-login__container .m-login__head .m-login__title {
				color: #1F4282;
				font-weight: bold;
			}

			.m-login.m-login--2.m-login-2--skin-1 .m-login__container .m-login__form .form-control {
				background: rgb(255 255 255);
				border: 1px solid #DCDCDC !important;
				color: #000!important;
				border-radius: 8px !important;
			}
			.m-login.m-login--2.m-login-2--skin-1 .m-login__container .m-login__form .form-control::placeholder{
				color: #000!important;
			}
			.m-login.m-login--2.m-login-2--skin-1 .m-login__container .m-login__form .m-login__form-action .m-login__btn.m-login__btn--primary{
				border: 1px solid #DCDCDC !important;
				color: #fff!important;
				background: #1F4282 !important;
				height: calc(2.95rem + 2px) !important;
				padding-top: 9px !important;
				border-radius: 8px !important;
			}

			/* body .m-login.m-login--2.m-login-2--skin-1 .m-login__container .m-login__form .m-login__form-action .m-login__btn.m-login__btn--primary:hover
			,body .btn-focus.m-btn--air{
				box-shadow: 0px 5px 10px 2px (31,66,130,1,0.19) !important;
			} */
			
		</style> 
	</head>	

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
		<!-- background-image: url(/admin/assets/app/media/img//bg/bg-1.jpg); -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1" id="m_login" style="
			    background: linear-gradient(90deg,#2B5AB1,#1F4282);">
				<div class="m-grid__item m-grid__item--fluid m-login__wrapper" style=" ">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img alt="" src="/admin/assets/demo/demo1/media/img/logo/logo2.png" />
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title"><?php echo e(__('text.login')); ?> </h3>
							</div>
			        	<form class="m-login__form m-form" action="/admin/adminlogin" method="post">
                                <?php echo e(csrf_field()); ?>

                                <?php if(\Illuminate\Support\Facades\Session::has('danger')): ?>
                                <div class="alert alert-danger">
                                    <button class="close pt-1" data-close="alert"></button>
                                    <span>  <?php echo e(\Illuminate\Support\Facades\Session::get('danger')); ?> </span>
                                    </div>
                                <?php endif; ?>
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text"  autocomplete="off" placeholder="<?php echo e(__('text.username')); ?>" name="username" required>
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" type="password" autocomplete="off" placeholder="<?php echo e(__('text.password')); ?>" name="password" required>
								</div>
								<div class="row m-login__form-sub">


								</div>
								<div class="m-login__form-action">
									<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary"><?php echo e(__('text.login')); ?> </button>
								</div>
							</form>
						</div>



					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!--begin::Base Scripts -->
		<script src="/admin/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="/admin/assets/demo/demo6/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Base Scripts -->

		<!--begin::Page Snippets -->

		<!--end::Page Snippets -->
	</body>

	<!-- end::Body -->
</html>
<?php /**PATH /var/www/html/backend_yagot/resources/views/admin/login/index.blade.php ENDPATH**/ ?>
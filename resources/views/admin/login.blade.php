<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->

<head>
    <meta charset="utf-8" />

    <title>Bill Pulsa - Login</title>
    <meta name="description" content="Latest updates and statistic charts">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->

    <!--begin::Base Styles -->

    <link href="./admin/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="./admin/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->

    <link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />
</head>
<!-- end::Head -->

<!-- end::Body -->

<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(./admin/assets/app/media/img//bg/bg-3.jpg);">
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="/">
                            <img src="{{ asset('images/logo.png') }}" style="max-width: 50%">
                        </a>
                    </div>
                    <div class="m-login__signin">
                        <div class="m-login__head">
                            <h3 class="m-login__title">Sign In To Samsul's Restaurant Application</h3>
                        </div>
                        <form class="m-login__form m-form" action="">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
                            </div>
                            <div class="row m-login__form-sub">
                                <div class="col m--align-left m-login__form-left">
                                    <label class="m-checkbox  m-checkbox--focus">
                                        <!-- <input type="checkbox" name="remember"> Remember me <span></span> -->
                                    </label>
                                </div>
                                <div class="col m--align-right m-login__form-right">
                                    <a href="javascript:;" id="m_login_forget_password" class="m-link">Forget Password ?</a>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign In</button>
                            </div>
                        </form>
                    </div>
                    <div class="m-login__signup">
                        <div class="m-login__head">
                            <h3 class="m-login__title">Sign Up</h3>
                            <div class="m-login__desc">Enter your details to create your account:</div>
                        </div>
                        <form class="m-login__form m-form" action="">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Fullname" name="fullname">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="password" placeholder="Password" name="password">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">
                            </div>
                            <div class="row form-group m-form__group m-login__form-sub">
                                <div class="col m--align-left">
                                    <label class="m-checkbox m-checkbox--focus">
                                        <input type="checkbox" name="agree">I Agree the <a href="#" class="m-link m-link--focus">terms and conditions</a>.
                                        <span></span>
                                    </label>
                                    <span class="m-form__help"></span>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">Sign Up</button>&nbsp;&nbsp;
                                <button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div class="m-login__forget-password">
                        <div class="m-login__head">
                            <h3 class="m-login__title">Forgotten Password ?</h3>
                            <div class="m-login__desc">Enter your email to reset your password:</div>
                        </div>
                        <form class="m-login__form m-form" action="">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primaryr">Request</button>&nbsp;&nbsp;
                                <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div class="m-login__account">
                        <span class="m-login__account-msg">
							Don't have an account yet ?
						</span>&nbsp;&nbsp;
                        <a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end:: Page -->

    <!--begin::Base Scripts -->
    <script src="./admin/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
    <script src="./admin/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
    <!--end::Base Scripts -->

    <!--begin::Page Snippets -->
    <!-- <script src="./admin/assets/snippets/pages/user/login.js" type="text/javascript"></script> -->
    <script type="text/javascript">
    	//== Class Definition
		var SnippetLogin = function() {

		    var login = $('#m_login');

		    var showErrorMsg = function(form, type, msg) {
		        var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
					<span></span>\
				</div>');

		        form.find('.alert').remove();
		        alert.prependTo(form);
		        alert.animateClass('fadeIn animated');
		        alert.find('span').html(msg);
		    }

		    //== Private Functions

		    var displaySignUpForm = function() {
		        login.removeClass('m-login--forget-password');
		        login.removeClass('m-login--signin');

		        login.addClass('m-login--signup');
		        login.find('.m-login__signup').animateClass('flipInX animated');
		    }

		    var displaySignInForm = function() {
		        login.removeClass('m-login--forget-password');
		        login.removeClass('m-login--signup');

		        login.addClass('m-login--signin');
		        login.find('.m-login__signin').animateClass('flipInX animated');
		    }

		    var displayForgetPasswordForm = function() {
		        login.removeClass('m-login--signin');
		        login.removeClass('m-login--signup');

		        login.addClass('m-login--forget-password');
		        login.find('.m-login__forget-password').animateClass('flipInX animated');
		    }

		    var handleFormSwitch = function() {
		        $('#m_login_forget_password').click(function(e) {
		            e.preventDefault();
		            displayForgetPasswordForm();
		        });

		        $('#m_login_forget_password_cancel').click(function(e) {
		            e.preventDefault();
		            displaySignInForm();
		        });

		        $('#m_login_signup').click(function(e) {
		            e.preventDefault();
		            displaySignUpForm();
		        });

		        $('#m_login_signup_cancel').click(function(e) {
		            e.preventDefault();
		            displaySignInForm();
		        });
		    }

		    var handleSignUpFormSubmit = function() {
		        $('#m_login_signup_submit').click(function(e) {
		            e.preventDefault();

		            var btn = $(this);
		            var form = $(this).closest('form');

		            form.validate({
		                rules: {
		                    fullname: {
		                        required: true
		                    },
		                    email: {
		                        required: true,
		                        email: true
		                    },
		                    password: {
		                        required: true
		                    },
		                    rpassword: {
		                        required: true
		                    },
		                    agree: {
		                        required: true
		                    }
		                }
		            });

		            if (!form.valid()) {
		                return;
		            }

		            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

		            form.ajaxSubmit({
		                url: '',
		                success: function(response, status, xhr, $form) {
		                	// similate 2s delay
		                	setTimeout(function() {
			                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
			                    form.clearForm();
			                    form.validate().resetForm();

			                    // display signup form
			                    displaySignInForm();
			                    var signInForm = login.find('.m-login__signin form');
			                    signInForm.clearForm();
			                    signInForm.validate().resetForm();

			                    showErrorMsg(signInForm, 'success', 'Thank you. To complete your registration please check your email.');
			                }, 2000);
		                }
		            });
		        });
		    }

		    var handleSignInFormSubmit = function() {
		        $('#m_login_signin_submit').click(function(e) {
		            e.preventDefault();
		            var btn = $(this);
		            var form = $(this).closest('form');

		            form.validate({
		                rules: {
		                    email: {
		                        required: true,
		                        email: true
		                    },
		                    password: {
		                        required: true
		                    }
		                }
		            });

		            if (!form.valid()) {
		                return;
		            }

		            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

		            form.ajaxSubmit({
		            	type: 'POST',
		            	data: form.serialize(),
		            	url: 'postlogin',
		            	headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
		            	success: function(data, status, xhr) {
		                	setTimeout(function() {
			                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
			                    if(xhr.status == 200)
			                    {
			                    	var isiMsg = '';
					                var arrdata = data.split('#');

					                if (arrdata[0].trim()==='MSG')
					                {
					                    if (arrdata[1] === 'OK')
					                    {
					                        location.href = 'dashboard';
					                    }
					                    else
					                    {
					                    	isiMsg = arrdata[2];
					                    	showErrorMsg(form, 'danger', isiMsg);
					                    }
					                }
					                else 
					                {
					                    showErrorMsg(form, 'danger', data);
					                }
			                    }
			                    else
			                    {
					                showErrorMsg(form, 'danger', 'Login Failed. Please try again.'+ xhr.statusText);
			                    }
		                    }, 2000);
		                },
		                error: function(xhr) {
			                btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
			                if(xhr.status == 419)
					        	showErrorMsg(form, 'danger', 'Token Mismatch. Login Failed. Please <span onclick="location.reload()"><b>REFRESH</b></span> the page.');
			                else
					        	showErrorMsg(form, 'danger', 'Login Failed. '+ xhr.statusText);
		                }
		            });
		        });
		    }

		    
		    var handleForgetPasswordFormSubmit = function() {
		        $('#m_login_forget_password_submit').click(function(e) {
		            e.preventDefault();

		            var btn = $(this);
		            var form = $(this).closest('form');

		            form.validate({
		                rules: {
		                    email: {
		                        required: true,
		                        email: true
		                    }
		                }
		            });

		            if (!form.valid()) {
		                return;
		            }

		            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

		            form.ajaxSubmit({
		            	type: 'POST',
		            	data: form.serialize(),
		                url: 'forgotpassword',
		            	headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
		                success: function(data, status, xhr) { 
		                	// similate 2s delay
		                	setTimeout(function() {
		                		btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 

			                    if(xhr.status == 200)
			                    {
			                    	var isiMsg = '';
					                var arrdata = data.split('#');

					                if (arrdata[0].trim()==='MSG')
					                {
					                    if (arrdata[1] === 'OK')
					                    {
						                    form.clearForm(); // clear form
						                    form.validate().resetForm(); // reset validation states
					                        // display signup form
						                    displaySignInForm();
						                    var signInForm = login.find('.m-login__signin form');
						                    signInForm.clearForm();
						                    signInForm.validate().resetForm();

					                        isiMsg = arrdata[2];
						                    showErrorMsg(signInForm, 'success', isiMsg);
					                    }
					                    else
					                    {
					                        isiMsg = arrdata[2];
					                    	showErrorMsg(form, 'danger', isiMsg);
					                    }
					                }
					                else 
					                {
					                    showErrorMsg(form, 'danger', data);
					                }
			                    }
			                    else
			                    {
					                showErrorMsg(form, 'danger', 'Reset Password Failed. Please try again.'+ xhr.statusText);
			                    }
		                	}, 2000);
		                },
		                error : function(xhr) {
		                	btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
					        showErrorMsg(form, 'danger', 'Login Failed. '+ xhr.statusText);
		                }
		            });
		        });
		    }

		    @if(Session::has('OK'))
				var form = $('.m-login__signin').find('form');
				showErrorMsg(form, 'success', "@php echo Session::get('OK') @endphp");
			@elseif(Session::has('ERR'))
				displayForgetPasswordForm();
				var form = $('.m-login__forget-password').find('form');
				showErrorMsg(form, 'danger', "@php echo Session::get('ERR') @endphp");
			@endif

		    //== Public Functions
		    return {
		        // public functions
		        init: function() {
		            handleFormSwitch();
		            handleSignInFormSubmit();
		            handleSignUpFormSubmit();
		            handleForgetPasswordFormSubmit();
		        }
		    };
		}();

		//== Class Initialization
		jQuery(document).ready(function() {
		    SnippetLogin.init();
		});


    </script>
    <!--end::Page Snippets -->

</body>
<!-- end::Body -->

</html>
<script type="text/javascript">
	var user_role_id = '2';
</script>
					<!-- BEGIN: Subheader -->
					<!-- <div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									Management User
								</h3>
							</div>
						</div>
					</div> -->
					<!-- END: Subheader -->
					<div class="m-content">
						<div class="m-portlet m-portlet--tabs">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption" id="head_caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Cashier User
											<small>
											</small>
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools" id="m_portlet_tabs" style="display: none;">
									<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x" role="tablist" id="cashier_tab">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_portlet_tab_1_1" role="tab" aria-selected="true">
												Cashier Profile
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_tab_1_2" role="tab">
												Cashier User
											</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="m-portlet__body" id="_content_body_">
								<!--begin: Search Form -->
								<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
									<div class="row align-items-center">
										<div class="col-xl-8 order-2 order-xl-1">
											<div class="form-group m-form__group row align-items-center active" id="custom_search">
												<!-- <div class="col-md-4">
													<div class="m-form__group m-form__group--inline">
														<div class="m-form__label">
															<label>
																Status:
															</label>
														</div>
														<div class="m-form__control">
															<select class="form-control m-bootstrap-select" id="m_form_status">
																<option value="">
																	- Choose Status -
																</option>
																<option value="1">
																	Active
																</option>
																<option value="0">
																	Non Active
																</option>
															</select>
														</div>
													</div>
													<div class="d-md-none m--margin-bottom-10"></div>
												</div> -->
												<div class="col-md-4">
													<div class="m-input-icon m-input-icon--left">
														<input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
														<span class="m-input-icon__icon m-input-icon__icon--left">
															<span>
																<i class="la la-search"></i>
															</span>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-4 order-1 order-xl-2 m--align-right">
											<a href="#" id="btn_new_user" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" data-toggle="collapse" data-target="#div_form_user">
												<span>
													<i class="la la-user-plus"></i>
													<span id="btn_new_user_caption">
														New Cashier
													</span>
												</span>
											</a>
											<div class="m-separator m-separator--dashed d-xl-none"></div>
										</div>
									</div>
								</div>

								<div id="div_form_user" class="collapse">
									<div class="m-portlet m-portlet--bordered m-portlet--unair">
										<div class="m-portlet__head" style="background-color: #f7f8fa">
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
													<span class="m-portlet__head-icon">
														<i class="la la-user-plus"></i>
													</span>
													<h3 class="m-portlet__head-text">
														New Cashier User
													</h3>
												</div>			
											</div>
										</div>

										<!--begin: Portlet Body-->
										<div class="m-portlet__body m-portlet__body--no-padding">

											<!--begin: Form Wizard-->
											<div class="m-wizard m-wizard--4 m-wizard--brand" id="m_wizard">
												<div class="row m-row--no-padding">
													<div class="col-xl-3 col-lg-12 m--padding-top-20 m--padding-bottom-15">
														<!--begin: Form Wizard Head -->
														<div class="m-wizard__head">	 

												            <!--begin: Form Wizard Nav -->
															<div class="m-wizard__nav">
																<div class="m-wizard__steps">
																	<div class="m-wizard__step m-wizard__step--current" data-wizard-target="#m_wizard_form_step_1">
																		<div class="m-wizard__step-info">
																			<a href="#" class="m-wizard__step-number">							 
																				<span><span>1</span></span>							 
																			</a>										 
																			<div class="m-wizard__step-label">
																				Account Setup										
																			</div>
																			<div class="m-wizard__step-icon"><i class="la la-check"></i></div>
																		</div>
																	</div>
																	<div class="m-wizard__step" data-wizard-target="#m_wizard_form_step_2">
																		<div class="m-wizard__step-info">
																			<a href="#" class="m-wizard__step-number">							 
																				<span><span>2</span></span>							 
																			</a>										
																			<div class="m-wizard__step-label">
																				Profile Setup
																			</div>
																			<div class="m-wizard__step-icon"><i class="la la-check"></i></div>
																		</div>
																	</div>							 
																</div>
															</div>	
															<!--end: Form Wizard Nav -->
														</div>
														<!--end: Form Wizard Head -->					
													</div>
													<div class="col-xl-9 col-lg-12">
														<!--begin: Form Wizard Form-->
														<div class="m-wizard__form">
															<!--
																1) Use m-form--label-align-left class to alight the form input lables to the right
																2) Use m-form--state class to highlight input control borders on form validation
															-->
															<form class="m-form m-form--state m-form--label-align-left" id="m_form">
																<input type="hidden" name="act" value="create">
																<input type="hidden" name="role_id" value="{{ $role_id }}">
																<input type="hidden" name="type_user" value="new_user">
																<!--begin: Form Body -->
																<div class="m-portlet__body m-portlet__body--no-padding">
																	<!--begin: Form Wizard Step 1-->
																	<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
																		<div class="m-form__section m-form__section--first">
																			<div class="m-form__heading">
																				<h3 class="m-form__heading-title">Account Details</h3>
																			</div>
																			<div class="form-group m-form__group row">
																				<label class="col-xl-3 col-lg-3 col-form-label">* Name:</label>
																				<div class="col-xl-9 col-lg-9">
																					<input type="text" name="name" class="form-control m-input" placeholder="Enter Fullname" required="">
																				</div>
																			</div>
																			<div class="form-group m-form__group row">
																				<label class="col-xl-3 col-lg-3 col-form-label">* Email:</label>
																				<div class="col-xl-9 col-lg-9">
																					<input type="email" name="email" class="form-control m-input" placeholder="Enter Email Address" required="" onchange="checkEmailifExist(this.form.id, this.value);">
																				</div>
																			</div>
																			<div class="form-group m-form__group row">
																				<label class="col-xl-3 col-lg-3 col-form-label">* Password:</label>
																				<div class="col-xl-9 col-lg-9">
																					<input type="password" name="password" class="form-control m-input" placeholder="Enter Password" required="">
																				</div>
																			</div>
																			<div class="form-group m-form__group row">
																				<label class="col-xl-3 col-lg-3 col-form-label">* Confirm Password:</label>
																				<div class="col-xl-9 col-lg-9">
																					<input type="password" name="c_password" class="form-control m-input" placeholder="Enter Password Confirmation" required="">
																				</div>
																			</div>
																		</div>
																	</div>
																	<!--end: Form Wizard Step 1-->

																	<!--begin: Form Wizard Step 2-->
																	<div class="m-wizard__form-step" id="m_wizard_form_step_2">
																		<div class="m-form__section m-form__section--first">
																			<div class="m-form__heading">
																				<h3 class="m-form__heading-title">Company Profile</h3>
																			</div>
																			<div class="form-group m-form__group row">
																				<div class="col-lg-6 m-form__group-sub">
																					<label class="form-control-label">* Kode cashier:</label>
																					<input type="text" id="cashier_code" name="cashier_code" class="form-control m-input" placeholder="" required="" maxlength="4" onchange="checkCashierCodeifExist(this.form.id, this.value);">
																				</div>
																				<div class="col-lg-6 m-form__group-sub">
																					<label class="form-control-label">* Nama Cashier:</label>
																					<input type="text" name="cashier_name" class="form-control m-input" placeholder="" required="">
																				</div>
																			</div>																			
																			<div class="form-group m-form__group row">
																				<div class="col-lg-6 m-form__group-sub">
																					<label class="form-control-label">* Alamat:</label>
																					<input type="text" name="address" class="form-control m-input" placeholder="" required="">
																				</div>
																				<div class="col-lg-6 m-form__group-sub">
																					<label class="form-control-label">* Propinsi:</label>
																					<select class="form-control m-input" id="state" name="state" required="">
																						<option value="">- Pilih -</option>
																						@foreach($STATE as $PROP)
																							<option value="{{ $PROP->STATE_ID }}">{{ $PROP->STATE_NAME }}</option>
																						@endforeach
																					</select>
																				</div>
																			</div>
																			<div class="form-group m-form__group row">
																				<div class="col-lg-6 m-form__group-sub">
																					<label class="form-control-label">* Kab/Kota:</label>
																					<select class="form-control m-input" id="city" name="city" required="">
																						<option value="">- Pilih -</option>
																					</select>
																				</div>
																				<div class="col-lg-6 m-form__group-sub">
																					<label class="form-control-label">* Kecamatan:</label>
																					<select class="form-control m-input" id="district" name="district" required="">
																						<option value="">- Pilih -</option>
																					</select>
																				</div>
																			</div>
																			<div class="form-group m-form__group row">
																				<div class="col-lg-6 m-form__group-sub">
																					<label class="form-control-label">* Kelurahan:</label>
																					<select class="form-control m-input" id="sub_district" name="sub_district" required="">
																						<option value="">- Pilih -</option>
																					</select>
																				</div>
																				<div class="col-lg-6 m-form__group-sub">
																					<label class="form-control-label">* Kode Pos:</label>
																					<input type="text" name="post_code" class="form-control m-input" placeholder="" required="">
																				</div>
																			</div>
																			<div class="form-group m-form__group row">
																				<div class="col-lg-6 m-form__group-sub">
																					<label class="form-control-label">* Email:</label>
																					<input type="text" name="company_email" class="form-control m-input" placeholder="" required="">
																				</div>
																				<div class="col-lg-6 m-form__group-sub">
																					<label class="form-control-label">* Telepon:</label>
																					<input type="text" name="phone" class="form-control m-input" placeholder="" required="">
																				</div>
																			</div>																			
																		</div>
																	</div>
																	<!--end: Form Wizard Step 2-->								 
																</div>
																<!--end: Form Body -->

																<!--begin: Form Actions -->
																<div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">								
																	<div class="m-form__actions">
																		<div class="row">
																			<div class="col-lg-6 m--align-left">
																				<a href="#" class="btn btn-secondary m-btn m-btn--custom m-btn--icon" data-wizard-action="prev">
																					<span>
																						<i class="la la-arrow-left"></i>&nbsp;&nbsp;
																						<span>Back</span>
																					</span>
																				</a>
																			</div>
																			<div class="col-lg-6 m--align-right">
																				<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon" data-wizard-action="submit">
																					<span>
																						<i class="la la-check"></i>&nbsp;&nbsp;
																						<span>Submit</span>
																					</span>
																				</a>
																				<a href="#" class="btn btn-success m-btn m-btn--custom m-btn--icon" data-wizard-action="next">
																					<span>
																						<span>Save &amp; Continue</span>&nbsp;&nbsp;
																						<i class="la la-arrow-right"></i>
																					</span>
																				</a>
																			</div>
																		</div>
																	</div>								
																</div>
																<!--end: Form Actions -->
															</form>
														</div> 
														<!--end: Form Wizard Form-->
													</div>
												</div>
											</div>
											<!--end: Form Wizard-->

										</div>
										<!--end: Portlet Body-->

									</div>
								</div>
								<!--end: Search Form -->
								<!--begin: Datatable -->
								<button id="m_datatable_reload" style="display: none">Reload data</button>
								<div class="m_datatable" id="ajax_data"></div>
								<!--end: Datatable -->
							</div>
						</div>
					</div>



<script type="text/javascript">	

	$('#btn_new_user').click(function(){
		if($('#custom_search').hasClass('active'))
		{
			$('#custom_search').hide().removeClass('active');
			$('.m_datatable').hide();
			$('#btn_new_user_caption').html('Close');
		}
		else
		{
			$('#custom_search').show().addClass('active');
			$('.m_datatable').show();
			$('#btn_new_user_caption').html('New cashier User');
		}
	});

	$(":input").keyup(function () {
	    _validator($(this));
	});

	$(":input").blur(function () {
	    _validator($(this));
	});

	function save_user(formid)
	{
		validation = my_validator(formid);
		if(validation.fail)
		{
			swal("", "Isian Form belum lengkap", "error")
			return false;
		}

		var form = $('#'+formid);
		var datasend = form.serialize();

		$.ajax({
			type: 'POST',
            url: 'management-user/save',
            data: datasend,
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: function(data){
                var isiMsg = '';
                var arrdata = data.split('#');

                if (arrdata[0].trim()==='MSG')
                {
                    if (arrdata[1] === 'OK') {
                        isiMsg = arrdata[2];
                        swal("", isiMsg, "success");
                        $('#btn_new_user').click();
                        document.getElementById(formid).reset();

                        var act = $('#'+formid).find('input[name=act]').val();
                        if(act == 'create')
                        	call('management-user/list/cashier', '_content_', 'cashier User');
                        else
                        {
                        	var id = $('#'+formid).find('input[name=profile_id]').val();
                        	view(id, user_role_id);
                        }
                    } else {
                        isiMsg = arrdata[2];
                        swal("", isiMsg, "error");
                    }
                }
                else 
                {
                    swal("", data, "error");
                }
		    }

		})
	}

	
	$(document).ready(function () {

		$.ajax({
	        type:'GET',
	        url: '/management-user/list/cashier?ajax=1', 
	        data : '',
	        success: function(data){        	
	        	var dataJSONArray = JSON.parse(data);
	        	var datatable = $('.m_datatable').mDatatable({
				// datasource definition
				data: {
					type: 'local',
					source: dataJSONArray,
					pageSize: 10,
					saveState: {
						cookie: false,
						webstorage: false
					},
				},

				// layout definition
				layout: {
					theme: 'default', // datatable theme
					class: '', // custom wrapper class
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					// height: 450, // datatable's body's fixed height
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,

				pagination: true,

				search: {
					input: $('#generalSearch')
				},

				// columns definition
				columns: [{
					field: "PROFILE_KODE_CASHIER",
					title: "Kode Cashier"
				}, {
					field: "PROFILE_CASHIER_NAME",
					title: "Cashier Name"
				}, {
					field: "PROFILE_EMAIL",
					title: "Cashier Email"
				}, 
				{
					field: "Actions",
					// width: 110,
					title: "Actions",
					sortable: false,
					overflow: 'visible',
					template: function (row) {
						var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
						return '\
							<a href="#" onclick="view('+row.PROFILE_ID+', '+user_role_id+')" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">\
	                            <i class="la la-edit"></i>\
	                        </a>\
	                        <a href="#" onclick="hapus('+row.PROFILE_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete ">\
	                            <i class="la la-trash"></i>\
	                        </a>\
						';
					}
				}]
			});

				var query = datatable.getDataSourceQuery();

				$('#m_form_status').on('change', function () {
					datatable.search($(this).val(), 'USER_STATUS_ID');
				}).val(typeof query.USER_STATUS_ID !== 'undefined' ? query.USER_STATUS_ID : '');

				$('#m_form_status').selectpicker();

				$('#m_datatable_reload').on('click', function () {
					datatable.reload();
				});
	        }
		});

		return false;
	});

	function view(id, type)
	{
		$.ajax({
			type: 'GET',
			data: {id : id, type : type},
			url: 'management-user/view',
			success: function(data){
				$('#_content_body_').html(data);
			}
		})
	}

	function hapus(id)
	{
		swal({
		  title: "",
		  text: "Anda akan menghapus cashier ini?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Ya, Hapus!",
		  closeOnConfirm: false
		},
		function(){
			$.ajax({
				type: 'GET',
				data: {id : id},
				url: 'management-user/deletecashier',
				success: function(data){
					var isiMsg = '';
	                var arrdata = data.split('#');

	                if (arrdata[0].trim()==='MSG')
	                {
	                    if (arrdata[1] === 'OK') {
	                        isiMsg = arrdata[2];
	                        swal("", isiMsg, "success");
							call('management-user/list/cashier', '_content_', 'cashier User');
	                    } else {
	                        isiMsg = arrdata[2];
	                        swal("", isiMsg, "error");
	                    }
	                }
	                else 
	                {
	                    swal("", data, "error");
	                }
				}
			})
		});
	}

	function activate(status, id)
	{
		$.ajax({
			type: 'GET',
			data: {status : status, user_id : id},
			url: 'management-user/activate',
			success: function(data){
				call('management-user/list/cashier', '_content_', 'Cashier User');
			}
		})
	}

	//== Wizard

	var WizardDemo = function () {
	    //== Base elements
	    var wizardEl = $('#m_wizard');
	    var formEl = $('#m_form');
	    var validator;
	    var wizard;
	    
	    //== Private functions
	    var initWizard = function () {
	        //== Initialize form wizard
	        wizard = wizardEl.mWizard({
	            startStep: 1
	        });

	        //== Validation before going to next page
	        wizard.on('beforeNext', function(wizard) {
	        	var isvalid = wizard_validator(formEl.attr('id'), wizard.currentStep);
	        	if(isvalid.fail)
	        		return false;
	        })

	        //== Change event
	        wizard.on('change', function(wizard) {
	            $('html, body').animate({
			        scrollTop: $("#m_wizard").offset().top -150
			    }, 'slow');
	        });
	    }

	    var initValidation = function() {
	        validator = formEl.validate({
	            //== Validate only visible fields
	            ignore: ":hidden",

	            //== Validation rules
	            rules: {

	                accept: {
	                    required: true
	                }
	            },

	            //== Validation messages
	            messages: {
	                accept: {
	                    required: "You must accept the Terms and Conditions agreement!"
	                } 
	            },
	            
	            //== Display error  
	            invalidHandler: function(event, validator) {     
	                // mApp.scrollTop();

	                swal({
	                    "title": "", 
	                    "text": "There are some errors in your submission. Please correct them.", 
	                    "type": "error",
	                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
	                });
	            },

	            //== Submit valid form
	            submitHandler: function (form) {
	                
	            }
	        });   
	    }

	    var initSubmit = function() {
	        var btn = formEl.find('[data-wizard-action="submit"]');

	        btn.on('click', function(e) {
	            e.preventDefault();
	            	save_user('m_form');
	        });
	    }

	    return {
	        // public functions
	        init: function() {
	            wizardEl = $('#m_wizard');
	            formEl = $('#m_form');

	            initWizard(); 
	            initValidation();
	            initSubmit();
	        }
	    };
	}();

	jQuery(document).ready(function() {    
	    WizardDemo.init();
	});

	$('#state').change(function(){
		var state_id = $(this).val();
		$.ajax({
			type: 'GET',
			data: {type:'city', id:state_id},
			url: '/reference/address',
			success: function(data){
				$('#city').html('<option value="">- Pilih -</option>');
				$('#district').html('<option value="">- Pilih -</option>');
				$('#sub_district').html('<option value="">- Pilih -</option>');
				
				var htmldata = '<option value="">- Pilih -</option>';
				$.each(data, function(key, val){
					htmldata += '<option value="'+val.CITY_ID+'">'+val.CITY_NAME+'</option>'
				});

				$('#city').html(htmldata);
			}
		})
	});

	$('#city').change(function(){
		var state_id = $(this).val();
		$.ajax({
			type: 'GET',
			data: {type:'district', id:state_id},
			url: '/reference/address',
			success: function(data){
				$('#district').html('<option value="">- Pilih -</option>');
				
				var htmldata = '<option value="">- Pilih -</option>';
				$.each(data, function(key, val){
					htmldata += '<option value="'+val.DISTRICT_ID+'">'+val.DISTRICT_NAME+'</option>'
				});

				$('#district').html(htmldata);
			}
		})
	});

	$('#district').change(function(){
		var state_id = $(this).val();
		$.ajax({
			type: 'GET',
			data: {type:'subdistrict', id:state_id},
			url: '/reference/address',
			success: function(data){
				$('#sub_district').html('<option value="">- Pilih -</option>');
				
				var htmldata = '<option value="">- Pilih -</option>';
				$.each(data, function(key, val){
					htmldata += '<option value="'+val.SUB_DISTRICT_ID+'">'+val.SUB_DISTRICT_NAME+'</option>'
				});

				$('#sub_district').html(htmldata);
			}
		})
	});
</script>
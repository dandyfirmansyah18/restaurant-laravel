<script type="text/javascript">
	var user_role_id = '21';
	var del_type = 'user';
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
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											User Staff
											<small>
											</small>
										</h3>
									</div>
								</div>
							</div>

							<div class="m-portlet__body" id="_content_body_">
								<!--begin: Search Form -->
								<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
									<div class="row align-items-center">
										<div class="col-xl-8 order-2 order-xl-1">
											<div class="form-group m-form__group row align-items-center active" id="custom_search">
												<div class="col-md-4">
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
												</div>
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
										@if(Auth::user()->USER_ROLE_ID != 2)
										<div class="col-xl-4 order-1 order-xl-2 m--align-right">
											<a href="#" id="btn_new_user" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" data-toggle="collapse" data-target="#div_form_user">
												<span>
													<i class="la la-user-plus"></i>
													<span id="btn_new_user_caption">
														New User Staff
													</span>
												</span>
											</a>
											<div class="m-separator m-separator--dashed d-xl-none"></div>
										</div>
										@endif
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
														New User Staff
													</h3>
												</div>			
											</div>
											<!-- <div class="m-portlet__head-tools">
												<ul class="m-portlet__nav">
													<li class="m-portlet__nav-item">
														<a href="" class="m-portlet__nav-link m-portlet__nav-link--icon" id="form-user-close" data-toggle="collapse" data-target="#div_form_user"><i class="la la-close"></i></a>	
													</li>
												</ul>
											</div> -->
										</div>
										<!--begin::Form-->
										<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_user" data-validator="my_validator">
											<input type="hidden" name="act" value="create">
											<div class="m-portlet__body">
												<div class="form-group m-form__group row">
													<div class="col-lg-6">
														<label>
															Name:
														</label>
														<input class="form-control m-input" placeholder="Enter full name" type="text" name="name" required="">
													</div>
													<div class="col-lg-6">
														<label class="">
															Email:
														</label>
														<input class="form-control m-input" placeholder="Enter email address" type="email" name="email" required="" onchange="checkEmailifExist(this.form.id, this.value);">
													</div>
												</div>
												<div class="form-group m-form__group row">
													<div class="col-lg-6">
														<label>
															Password:
														</label>
														<input class="form-control m-input" placeholder="Enter Password" type="password" name="password" required="">
													</div>
													<div class="col-lg-6">
														<label class="">
															Confirm Password:
														</label>
														<input class="form-control m-input" placeholder="Enter Password Confirmation" type="password" name="c_password" required="">
													</div>
												</div>
											</div>
											<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
												<div class="m-form__actions m-form__actions--solid">
													<div class="row">
														<div class="col-lg-6">
															<button class="btn btn-primary" onclick="save_user(this.form.id);return false;">Save</button>
															<button type="reset" onclick="$('#btn_new_user').click();" class="btn btn-secondary">Cancel</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										<!--end::Form-->
									</div>
								</div>
								<!--end: Search Form -->
								<!--begin: Datatable -->
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
			$('#btn_new_user_caption').html('New Admin User');
		}
	});

	$(":input").keyup(function () {
	    _validator($(this));
	});

	$(":input").blur(function () {
	    _validator($(this));
	});

	$(document).ready(function () {

		$.ajax({
	        type:'GET',
	        url: '/management-user/emitenstaff/list?ajax=1', 
	        data : {id : {{Auth::user()->PROFILE_ID}}},
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
						field: "USER_EMAIL",
						title: "Email"
					}, {
						field: "USER_NAME",
						title: "Name"
					}, {
						field: "USER_STATUS_ID",
						title: "Status",
						// callback function support for column rendering
						template: function (row) {
							var status = {
								1: {'title': 'Active', 'class': 'm-badge--success'},
								0: {'title': 'Non Active', 'class': ' m-badge--danger'}
							};
							return '<span class="m-badge ' + status[row.USER_STATUS_ID].class + ' m-badge--wide">' + status[row.USER_STATUS_ID].title + '</span>';
						}
					}, 
					{
						field: "Actions",
						// width: 110,
						title: "Actions",
						sortable: false,
						overflow: 'visible',
						template: function (row) {
							var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
							var button_action = '';
							@if(Auth::user()->USER_ROLE_ID == 2)
							@else
								button_action = '<a href="#" onclick="hapus('+row.USER_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete ">\
		                            <i class="la la-trash"></i>\
		                        </a>';
							@endif

							return '\
								<a href="#" onclick="view('+row.USER_ID+', '+user_role_id+')" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">\
		                            <i class="la la-edit"></i>\
		                        </a>\
		                        '+button_action+'\
		                        <div class="dropdown ' + dropup + '">\
									<a href="#" class="btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
		                                <i class="la la-ellipsis-h"></i>\
		                            </a>\
								  	<div class="dropdown-menu dropdown-menu-right">\
								    	<a class="dropdown-item" href="#" onclick="activate(1,'+row.USER_ID+')"><i class="la la-check-circle"></i> Activate User</a>\
								    	<a class="dropdown-item" href="#" onclick="activate(0,'+row.USER_ID+')"><i class="la la-times-circle"></i> Deactivate User</a>\
								  	</div>\
								</div>\
							';

							
						}
					}
					]
				});

				var query = datatable.getDataSourceQuery();

				$('#m_form_status').on('change', function () {
					datatable.search($(this).val(), 'USER_STATUS_ID');
				}).val(typeof query.USER_STATUS_ID !== 'undefined' ? query.USER_STATUS_ID : '');

				$('#m_form_status').selectpicker();
	        }
		});

		return false;
	});

	function view(id, type)
	{
		$.ajax({
			type: 'GET',
			data: {id : id,  type : type},
			url: 'management-user/emitenstaff/view',
			success: function(data){
				$('#_content_body_').html(data);
			}
		})
	}

	function save_user(formid)
	{
		validation = my_validator(formid);
		if(validation.fail)
		{
			swal("", "Isian Form belum lengkap.", "error");
			return false;
		}

		var form = $('#'+formid);
		var datasend = form.serialize();

		$.ajax({
			type: 'POST',
            url: 'management-user/emitenstaff/save',
            data: datasend,
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
                        	call('management-user/emitenstaff/list', '_content_', 'User Staff');
                        else
                        {
                        	var user_id = $('#'+formid).find('input[name=user_id]').val();
                        	view(user_id, user_role_id);
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

	function save_user_emiten(formid)
	{
		validation = my_validator(formid);
		if(validation.fail)
		{
			swal("", "Isian Form belum lengkap.", "error");
			return false;
		}

		var form = $('#'+formid);
		var datasend = form.serialize();

		$.ajax({
			type: 'POST',
            url: 'management-user/emitenstaff/save',
            data: datasend,
		    success: function(data){
                var isiMsg = '';
                var arrdata = data.split('#');

                var act = $('#'+formid).find('input[name=act]').val();

                if (arrdata[0].trim()==='MSG')
                {
                    if (arrdata[1] === 'OK') {
                        isiMsg = arrdata[2];
                        swal("", isiMsg, "success");
                        
                    	var user_id = $('#'+formid).find('input[name=user_id]').val();
                    	view(user_id, user_role_id);

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

	function hapus(id)
	{
		swal({
		  title: "",
		  text: "Anda akan menghapus user ini?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Ya, Hapus!",
		  closeOnConfirm: false
		},
		function(){
			$.ajax({
				type: 'GET',
				data: {user_id : id},
				url: 'management-user/emitenstaff/delete',
				success: function(data){
					swal("Deleted!", "User berhasil dihapus.", "success");
					call('management-user/emitenstaff/list', '_content_', 'User Staff');
				}
			})
		});
	}

	function activate(status, id)
	{
		$.ajax({
			type: 'GET',
			data: {status : status, user_id : id},
			url: 'management-user/emitenstaff/activate',
			success: function(data){
				call('management-user/emitenstaff/list', '_content_', 'User Staff');
			}
		})
	}

	function cancel_emiten()
	{
		call('management-user/emitenstaff/list', '_content_', 'User Staff');
	}
</script>
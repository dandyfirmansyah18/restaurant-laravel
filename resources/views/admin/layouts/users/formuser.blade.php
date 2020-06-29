@if(explode('|', decrypt($ROLE))[0] != 2)
<div class="row">
	<div class="col-lg-6">
		<div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair">
			<!--begin::Form-->
			<form class="m-form m-form--state" id="form_user">
				<input type="hidden" name="act" value="update">
				<input type="hidden" name="type" value="user">
				<input type="hidden" name="user_id" value="{{ $USER->USER_ID }}">
				<input type="hidden" name="role_id" value="{{ $ROLE }}">
				<div class="m-portlet__body">
					<div class="m-form__heading">
						<h3 class="m-form__heading-title">Account Details</h3>
					</div>
					<div class="m-form__section m-form__section--first">
						<div class="form-group m-form__group">
							<label>
								Name:
							</label>
							<input class="form-control m-input" placeholder="Enter full name" type="text" name="name" value="{{ $USER->USER_NAME }}" required="">
						</div>
						<div class="form-group m-form__group">
							<label class="">
								Email:
							</label>
							<input class="form-control m-input" placeholder="Enter email address" type="email" name="email" value="{{ $USER->USER_EMAIL }}" required="" onchange="checkEmailifExist(this.form.id, this.value);">
						</div>
		            </div>
	            </div>
	            <div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions--solid">
						<button class="btn btn-primary" onclick="save_user(this.form.id);return false;">Save</button>
						<button onclick="cancel();return false;" class="btn btn-secondary">Cancel</button>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>
	</div>

	<div class="col-lg-6">
		<div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair">
			<!--begin::Form-->
			<form class="m-form m-form--state" id="form_password">
				<input type="hidden" name="act" value="update">
				<input type="hidden" name="type" value="password">
				<input type="hidden" name="user_id" value="{{ $USER->USER_ID }}">
				<div class="m-portlet__body">
					<div class="m-form__heading">
						<h3 class="m-form__heading-title">Change Password</h3>
					</div>
					<div class="m-form__section m-form__section--first">
						<div class="form-group m-form__group">
							<label>
								New Password:
							</label>
							<input class="form-control m-input" placeholder="" type="password" name="password" value="" required="">
						</div>
						<div class="form-group m-form__group">
							<label class="">
								Confirm Password:
							</label>
							<input class="form-control m-input" placeholder="" type="password" name="c_password" value="" required="">
						</div>
		            </div>
	            </div>
	            <div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions--solid">
						<button class="btn btn-primary" onclick="save_user(this.form.id);return false;">Save</button>
						<button onclick="cancel();return false;" class="btn btn-secondary">Cancel</button>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>
	</div>
</div>
@else
<div class="tab-content">
	<div class="tab-pane active" id="m_portlet_tab_1_1" aria-selected="true">
		<div class="row">
			<div class="col-lg-12">
				<div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair">
					<!--begin::Form-->
					<form class="m-form m-form--state" id="form_profile">
						<input type="hidden" name="act" value="update">
						<input type="hidden" name="type" value="profile">
						<input type="hidden" name="profile_id" value="{{ $PROFILE->PROFILE_ID }}">
						<div class="m-portlet__body">
							<div class="m-form__section m-form__section--first">
								<div class="m-form__heading">
									<h3 class="m-form__heading-title">Cashier Profile</h3>
								</div>
								<div class="form-group m-form__group row">
									<div class="col-lg-6 m-form__group-sub">
										<label class="form-control-label">* Cashier Code:</label>
										<input type="text" name="cashier_code" value="{{ $PROFILE->PROFILE_KODE_CASHIER }}" class="form-control m-input" placeholder="" required="" maxlength="4">
									</div>									
									<div class="col-lg-6 m-form__group-sub">
										<label class="form-control-label">* Cashier Name:</label>
										<input type="text" name="cashier_name" value="{{ $PROFILE->PROFILE_CASHIER_NAME}}" class="form-control m-input" placeholder="" required="">
									</div>
								</div>								
								<div class="form-group m-form__group row">
									<div class="col-lg-6 m-form__group-sub">
										<label class="form-control-label">* Alamat:</label>
										<input type="text" name="address" value="{{ $PROFILE->PROFILE_ADDRESS }}" class="form-control m-input" placeholder="" required="">
									</div>
									<div class="col-lg-6 m-form__group-sub">
										<label class="form-control-label">* Propinsi:</label>
										<select class="form-control m-input" id="state" name="state" required="">
											<option value="">- Pilih -</option>
											@foreach($STATE as $PROP)
												@if($PROP->STATE_ID == $PROFILE->PROFILE_STATE)
													<option selected value="{{ $PROP->STATE_ID }}">{{ $PROP->STATE_NAME }}</option>
												@else
													<option value="{{ $PROP->STATE_ID }}">{{ $PROP->STATE_NAME }}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group m-form__group row">
									<div class="col-lg-6 m-form__group-sub">
										<label class="form-control-label">* Kab/Kota:</label>
										<select class="form-control m-input" id="city" name="city" value="{{ $PROFILE->PROFILE_CITY }}" required="">
											<option value="">- Pilih -</option>
											@foreach($CITY as $KOTA)
												@if($KOTA->CITY_ID == $PROFILE->PROFILE_CITY)
													<option selected value="{{ $KOTA->CITY_ID }}">{{ $KOTA->CITY_NAME }}</option>
												@else
													<option value="{{ $KOTA->CITY_ID }}">{{ $KOTA->CITY_NAME }}</option>
												@endif
											@endforeach
										</select>
									</div>
									<div class="col-lg-6 m-form__group-sub">
										<label class="form-control-label">* Kecamatan:</label>
										<select class="form-control m-input" id="district" name="district" value="{{ $PROFILE->PROFILE_DISTRICT }}" required="">
											<option value="">- Pilih -</option>
											@foreach($DISTRICT as $KEC)
												@if($KEC->DISTRICT_ID == $PROFILE->PROFILE_DISTRICT)
													<option selected value="{{ $KEC->DISTRICT_ID }}">{{ $KEC->DISTRICT_NAME }}</option>
												@else
													<option value="{{ $KEC->DISTRICT_ID }}">{{ $KEC->DISTRICT_NAME }}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group m-form__group row">
									<div class="col-lg-6 m-form__group-sub">
										<label class="form-control-label">* Kelurahan:</label>
										<select class="form-control m-input" id="sub_district" name="sub_district" value="{{ $PROFILE->PROFILE_SUB_DISTRICT }}" required="">
											<option value="">- Pilih -</option>
											@foreach($SUB_DISTRICT as $KEL)
												@if($KEL->SUB_DISTRICT_ID == $PROFILE->PROFILE_SUB_DISTRICT)
													<option selected value="{{ $KEL->SUB_DISTRICT_ID }}">{{ $KEL->SUB_DISTRICT_NAME }}</option>
												@else
													<option value="{{ $KEL->SUB_DISTRICT_ID }}">{{ $KEL->SUB_DISTRICT_NAME }}</option>
												@endif
											@endforeach
										</select>
									</div>
									<div class="col-lg-6 m-form__group-sub">
										<label class="form-control-label">* Kode Pos:</label>
										<input type="text" name="post_code" value="{{ $PROFILE->PROFILE_POST_CODE }}" class="form-control m-input" placeholder="" required="">
									</div>
								</div>
								<div class="form-group m-form__group row">									
									<div class="col-lg-6 m-form__group-sub">
										<label class="form-control-label">* Email:</label>
										<input type="text" name="company_email" value="{{ $PROFILE->PROFILE_EMAIL }}" class="form-control m-input" placeholder="" required="">
									</div>
									<div class="col-lg-6 m-form__group-sub">
										<label class="form-control-label">* Telepon:</label>
										<input type="text" name="phone" value="{{ $PROFILE->PROFILE_PHONE }}" class="form-control m-input" placeholder="" required="">
									</div>
								</div>							
							</div>
			            </div>
			            <div class="m-portlet__foot m-portlet__foot--fit">
							<div class="m-form__actions m-form__actions--solid">
								<button class="btn btn-primary" onclick="save_user(this.form.id);return false;">Save</button>
								<button onclick="cancel();return false;" class="btn btn-secondary">Cancel</button>
							</div>
						</div>
					</form>
					<!--end::Form-->
				</div>
			</div>
		</div>
	</div>
	<div class="tab-pane active show" id="m_portlet_tab_1_2">
		<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30 active" id="form_headtool">
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
			</div>
		</div>		

		<div id="div_edit_user" style="display: none;">
		</div>
		
		<div class="m_datatable" id="ajax_data"></div>

	</div>
</div>
@endif

<script type="text/javascript">
	
	@if(explode('|', decrypt($ROLE))[0] == '2')		
		$("#m_portlet_tabs").show();
		$("#head_caption").hide();

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
				$('#btn_new_user_caption').html('New Emiten Staff');
			}
		});

		var datatable = $('.m_datatable').mDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/management-user/list/emitenusers/{{ $PROFILE->PROFILE_ID }}?ajax=1',
                        method: 'GET'
                    }
                },
                pageSize: 10,
                saveState: {
                    cookie: false,
                    webstorage: false
                },
            },

            layout: {
                theme: 'default',
                class: '',
                scroll: false,
                // height: 380,
                footer: false
            },

            sortable: true,

            pagination: true,

            search: {
					input: $('#generalSearch')
				},

            columns: [{
						field: "USER_EMAIL",
						title: "Email"
					}, {
						field: "USER_NAME",
						title: "Name"
					}, {
						field: "ROLE_NAME",
						title: "User Role"
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
							return '\
								<a href="#" onclick="view_user_emiten('+row.USER_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">\
		                            <i class="la la-edit"></i>\
		                        </a>\
		                        <a href="#" onclick="hapus_user_emiten('+row.USER_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete ">\
		                            <i class="la la-trash"></i>\
		                        </a>\
		                        <div class="dropdown ' + dropup + '">\
									<a href="#" class="btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
		                                <i class="la la-ellipsis-h"></i>\
		                            </a>\
								  	<div class="dropdown-menu dropdown-menu-right">\
								    	<a class="dropdown-item" href="#" onclick="activate_emiten(1,'+row.USER_ID+')"><i class="la la-check-circle"></i> Activate User</a>\
								    	<a class="dropdown-item" href="#" onclick="activate_emiten(0,'+row.USER_ID+')"><i class="la la-times-circle"></i> Deactivate User</a>\
								  	</div>\
								</div>\
							';

							
						}
					}]
        });

        var query = datatable.getDataSourceQuery();

		$('#m_form_status').on('change', function () {
			datatable.search($(this).val(), 'USER_STATUS_ID');
		}).val(typeof query.USER_STATUS_ID !== 'undefined' ? query.USER_STATUS_ID : '');

		$('#m_form_status').selectpicker();

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

		function view_user_emiten(id)
		{
			$.ajax({
				type: 'GET',
				data: {id : id},
				url: 'management-user/viewuseremiten',
				success: function(data){
					$('#form_headtool').slideUp().removeClass('active');
					$('.m_datatable').slideUp();
					$('#div_edit_user').html(data).slideDown('slow');	
				}
			})
		}

		function cancel_emiten()
		{
			$('#form_headtool').slideDown().addClass('active');
			$('.m_datatable').slideDown();
			$('#div_edit_user').slideUp('slow');
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
	            url: 'management-user/save',
	            data: datasend,
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(data){
	                var isiMsg = '';
	                var arrdata = data.split('#');

	                var act = $('#'+formid).find('input[name=act]').val();

	                if (arrdata[0].trim()==='MSG')
	                {
	                    if (arrdata[1] === 'OK') {
	                        isiMsg = arrdata[2];
	                        swal("", isiMsg, "success");
	                        datatable.reload();
	                        
	                        if(act == 'create')
	                        	$('#btn_new_user').click();
	                        else
	                        	cancel_emiten();

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

		function hapus_user_emiten(id)
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
					url: 'management-user/delete',
					success: function(data){
						swal("Deleted!", "User berhasil dihapus.", "success");
						datatable.reload();
					}
				})
			});
		}

		function activate_emiten(status, id)
		{
			$.ajax({
				type: 'GET',
				data: {status : status, user_id : id},
				url: 'management-user/activate',
				success: function(data){
					datatable.reload();
				}
			})
		}
	@endif
	
	$(":input").keyup(function () {
	    _validator($(this));
	});

	$(":input").blur(function () {
	    _validator($(this));
	});

	function cancel()
	{
		var role_id = {{ explode('|', decrypt($ROLE))[0] }};
		var role;
		
		if(role_id == '1') role = 'sales';
		else if(role_id == '2') role = 'emiten';
		else if(role_id == '3') role = 'admin';

		call('management-user/list/'+role, '_content_', 'Admin User');
	}

	$(function(){
		var target = '';
		$('#cashier_tab').find('li').each(function(){
			var a = $(this).find('a');
			if(a.hasClass('active'))
				target = a.attr('href');
		});
		
		$('.tab-content').find('.tab-pane').each(function(){
			if($(this).attr('id') == target.replace('#',''))
				$(this).addClass('active').addClass('show');
			else
				$(this).removeClass('active').removeClass('show');
		})
	})
</script>
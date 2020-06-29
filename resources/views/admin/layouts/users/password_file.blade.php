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
											Set Password for File
											<small>
											</small>
										</h3>
									</div>
								</div>
							</div>

							<div class="m-portlet__body" id="_content_body_">
								<div class="row">
									<div id="div_form_password" class="col-lg-6">
										<div class="m-portlet m-portlet--bordered m-portlet--unair">
											<!--begin::Form-->
											<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_password" data-validator="my_validator">
												<div class="m-portlet__body">
													<div class="form-group m-form__group">
														<div class="m-input-icon m-input-icon--right">
															<input type="password" name="password" id="password" value="{{($password) ? explode('|', decrypt($password))[0] : '' }}" class="form-control m-input" placeholder="Enter Password" required="">
															<span class="m-input-icon__icon m-input-icon__icon--right"><span><i onclick="show_password($(this).closest('form').attr('id'))" id="showicon" class="la la-eye" style="cursor: pointer;"></i></span></span>
														</div>
													</div>
												</div>
												<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
													<div class="m-form__actions m-form__actions--solid">
														<div class="row">
															<div class="col-lg-12">
																<button class="btn btn-primary" onclick="save_user(this.form.id);return false;">Save</button>
															</div>
														</div>
													</div>
												</div>
											</form>
											<!--end::Form-->
										</div>
									</div>
								</div>
								<!--end: Search Form -->
								<p style="font-size: 16px;">History Password File</p>	
								<div class="m_datatable" id="local_data"></div>							
							</div>
						</div>
					</div>


<script type="text/javascript">
	
$(document).ready(function () {
	$.ajax({
        type:'POST',
        url: 'management-user/password_file/history', 
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
				}
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

			// inline and bactch editing(cooming soon)
			// editable: false,

			// columns definition
			columns: [{
				field: "row_number",
				title: "No.",
				width: 50,
				sortable: false,
				selector: false,
				textAlign: 'center'
			}, {
				field: "HISTORY_PASS_DATE",
				title: "Tanggal"
			}, {
				field: "HISTORY_PASS_CONTENT",
				title: "Password",
				template: function (row) {					
					return '<div class="form-group m-form__group">\
								<div class="m-input-icon m-input-icon--right">\
									<input type="password" name="password" id="password_table'+row.HISTORY_PASS_ID+'" value="'+row.HISTORY_PASS_CONTENT+'" class="form-control m-input" disabled>\
									<span class="m-input-icon__icon m-input-icon__icon--right" >\
										<span>\
											<i onclick="show_password_table('+row.HISTORY_PASS_ID+')" id="showicon'+row.HISTORY_PASS_ID+'" class="la la-eye" style="cursor: pointer;"></i>\
										</span>\
									</span>\
								</div>\
							</div>';
				}
			}
			]
		});

		var query = datatable.getDataSourceQuery();

		// $('#m_form_status').on('change', function () {
		// 	datatable.search($(this).val(), 'ARTICLE_STATUS');
		// }).val(typeof query.ARTICLE_STATUS !== 'undefined' ? query.ARTICLE_STATUS : '');		

		// $('#m_form_status').selectpicker();
        }
	});

	return false;
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
			swal("", "Isian Form belum lengkap.", "error");
			return false;
		}

		var form = $('#'+formid);
		var datasend = form.serialize();

		$.ajax({
			type: 'POST',
            url: 'management-user/password_file/save',
            data: datasend,
		    success: function(data){
                var isiMsg = '';
                var arrdata = data.split('#');

                if (arrdata[0].trim()==='MSG')
                {
                    if (arrdata[1] === 'OK') {
                        isiMsg = arrdata[2];
                        swal("", isiMsg, "success");
                        call('management-user/password_file/draft', '_content_', 'Set Password for File');

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

	function show_password(formid)
	{
		var type = $('#'+formid).find('input').attr('type');

		if(type == 'password')
		{
			$('#'+formid).find('input').attr('type','text');
			$('#showicon').removeClass('la-eye').addClass('la-eye-slash');
		}
		else
		{
			$('#'+formid).find('input').attr('type','password');
			$('#showicon').removeClass('la-eye-slash').addClass('la-eye');
		}

	}

	function show_password_table(id)
	{
		var type = $('#password_table'+id).attr('type');

		if(type == 'password')
		{
			$('#password_table'+id).attr('type','text');
			$('#showicon'+id).removeClass('la-eye').addClass('la-eye-slash');
		}
		else
		{
			$('#password_table'+id).attr('type','password');
			$('#showicon'+id).removeClass('la-eye-slash').addClass('la-eye');
		}
	}
</script>
<!-- BEGIN: Subheader -->
<!-- <div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Management Report
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
						Management Report
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
											Periode:
										</label>
									</div>
									<div class="m-form__control">
										<input type="text" class="form-control m-input" id="periode" value="{{$periode}}" readonly placeholder="Select time" type="text"/>
									</div>
								</div>
								<div class="d-md-none m--margin-bottom-10"></div>
							</div>
							<!-- <div class="col-md-2">
								<div class="m-form__group m-form__group--inline">
									<div class="m-form__control">
										<span class="btn btn-primary btn-sm" onclick="searchperiode()">
											Search
										</span>
									</div>
								</div>
								<div class="d-md-none m--margin-bottom-10"></div>
							</div> -->
							<div class="col-md-4">
								<div class="m-form__group m-form__group--inline">
									<div class="m-form__label">
										<label>
											Type:
										</label>
									</div>
									<div class="m-form__control">
										<select class="form-control m-bootstrap-select" id="m_form_type">
											<option value="">
												- Choose Type -
											</option>
											@foreach($drop_type as $drop_types)
											<option value="{{$drop_types->REPORT_TYPE_ID}}">
												{{$drop_types->REPORT_TYPE_NAME}}
											</option>
											@endforeach
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
					@if(Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21)
					<div class="col-xl-4 order-1 order-xl-2 m--align-right">
						<a href="#" id="btn_new_report" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" data-toggle="collapse" data-target="#div_form_report">
							<span>
								<i class="la la-cart-plus"></i>
								<span id="btn_new_report_caption">
									Add Report
								</span>
							</span>
						</a>
						<div class="m-separator m-separator--dashed d-xl-none"></div>
					</div>
					@endif
				</div>
			</div>
			<!--end: Search Form -->
			<div id="div_form_report" class="collapse">
				<div class="m-portlet m-portlet--bordered m-portlet--unair">
					<div class="m-portlet__head" style="background-color: #f7f8fa">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon">
									<i class="la la-user-plus"></i>
								</span>
								<h3 class="m-portlet__head-text">
									New Data Report
								</h3>
							</div>			
						</div>
					</div>
					<!--begin::Form-->
					<form class="m-form m-form--state m-form--fit m-form--label-align-right" name="form_report" id="form_report" data-validator="my_validator">		
						<div class="m-portlet__body">													
							<!-- <div class="form-group m-form__group row">
								<div class="col-lg-12" style="margin-bottom: 20px !important;">
									<div class="m-radio-inline">
										<label class="m-radio">
											<input type="radio" name="type_upload" onchange="change_radio()" value="1">
											One Report
											<span></span>
										</label>
										<label class="m-radio">
											<input type="radio" name="type_upload" onchange="change_radio()" value="2">
											Multiple Report
											<span></span>
										</label>										
									</div>
								</div>								
								<div class="col-lg-6" id="DIV_REPORT_TYPE_ID">
									<label>
										Report Type:
									</label>
									<input type="hidden" class="form-control m-input" name="act" value="insert" />
									<select class="form-control m-input" id="REPORT_TYPE_ID" name="REPORT_TYPE_ID">
										<option value="">- Choose Type -</option>
										@foreach($drop_type as $drop)
										<option value="{{$drop->REPORT_TYPE_ID}}">{{$drop->REPORT_TYPE_NAME}}</option>										
										@endforeach
									</select> 
								</div>
								<div class="col-lg-6" id="DIV_PROFILE_ID">
									<label>
										Company Name:
									</label>
									<select class="form-control m-input" id="PROFILE_ID" name="PROFILE_ID">
										<option value="">- Choose Company -</option>
										@foreach($drop_profile as $drop_profiles)
										<option value="{{$drop_profiles->PROFILE_ID}}">{{$drop_profiles->PROFILE_NPWP}} - {{$drop_profiles->PROFILE_COMPANY_NAME}}</option>
										@endforeach
									</select> 
								</div>								
							</div> -->

							<div class="form-group m-form__group row">
								<!-- <div class="col-lg-6" id="DIV_REPORT_DATE">
									<label>
										Report Date:
									</label>
									<div class='input-group date' id='m_datepicker_2_modal'>
										<input type='text' class="form-control m-input" readonly id="REPORT_DATE" name="REPORT_DATE"  placeholder="Select date"/>
									</div>
								</div> -->
								<div class="col-lg-12" id="DIV_REPORT_PATH">
									<label for="">
										Report File: <small><span id="caption_filetype">(* zip, rar, 7z, pdf, doc, docx, xls, xlx, xlsx)</span></small>
									</label>
									<input type="hidden" class="form-control m-input" name="act" value="insert" />
									<input type="file" class="input04" id="REPORT_PATH" name="REPORT_PATH">
									<span class="m-form__help">*Max Size File Upload 10 MB</span><br>
									<span class="m-form__help" style="color: red;">*Pastikan Nama File Sesuai Dengan Format {KODE_EMITEN}_{DATE YYYMMDD}_{KODE_REPORT}.{EXTENTION}</span>
								</div>															
							</div>
						</div>
						<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
							<div class="m-form__actions m-form__actions--solid">
								<div class="row">
									<div class="col-lg-6">
										<button class="btn btn-primary" onclick="save_report(this.form.id);return false;">Save</button>
										<button type="reset" onclick="$('#btn_new_report').click();" class="btn btn-secondary">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<!--end::Form-->
				</div>
			</div>
<!--begin: Selected Rows Group Action Form -->
			<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30 collapse" id="m_datatable_group_action_form">
				<div class="row align-items-center">
					<div class="col-xl-12">
						<div class="m-form__group m-form__group--inline">
							<div class="m-form__label m-form__label-no-wrap">
								<label class="m--font-bold m--font-danger-">
									Selected
									<span id="m_datatable_selected_number"></span>
									records:
								</label>
							</div>
							<div class="m-form__control">
								<div class="btn-toolbar">
									<!-- <div class="dropdown">
										<button type="button" class="btn btn-accent btn-sm dropdown-toggle" data-toggle="dropdown">
											Update status
										</button>
										<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
											<a class="dropdown-item" href="#">
												Pending
											</a>
											<a class="dropdown-item" href="#">
												Delivered
											</a>
											<a class="dropdown-item" href="#">
												Canceled
											</a>
										</div>
									</div> -->
									&nbsp;&nbsp;&nbsp;
									<span class="btn btn-sm btn-danger" type="button" id="m_datatable_check_all">
										Download
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end: Selected Rows Group Action Form -->
<!--begin: Datatable -->
			<div class="m_datatable" id="record_selection"></div>
			<!--end: Datatable -->
		</div>
	</div>
</div>

<!--begin::Modal-->
<div class="modal fade" id="modal_code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					Input Kode Keamanan:
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						&times;
					</span>
				</button>
			</div>
			<form id="form_code">
				<div class="modal-body">
						<div class="form-group">
							<label for="code" class="form-control-label">
								Kode Keamanan:
							</label>
							<input type="hidden" class="form-control" id="report_id" name="report_id">
							<input type="text" class="form-control" id="code" name="code" maxlength="6" required>
							<span class="m-form__help" style="font-color:red;">
								*Kode dikirim ke email anda.
							</span>
						</div>
				</div>
				<div class="modal-footer">
					<a href="javascript:void(0)" onclick="resend_code()"><span>Resend Code ?</span></a>
					<!-- <button type="button" onclick="close_modal()" class="btn btn-secondary">
						Close
					</button> -->
					<button type="button" onclick="send_code(this.form.id);return false;" class="btn btn-primary">
						Download
					</button>
					<!-- <span onclick="testdownload()">Download</span> -->
				</div>
			</form>
		</div>
	</div>
</div>
<!--end::Modal-->

<script type="text/javascript">

	jQuery(document).ready(function() {  	

		$("#PROFILE_ID").select2({
			width:'100%'
		});

		$("#REPORT_TYPE_ID").select2({
			width:'100%'
		});

		$('.input04').filestyle({
			htmlIcon : '<i class="fa fa-folder-open"></i>',
			text: ''
		});

		$('#REPORT_DATE').datepicker({
		    format: 'dd-mm-yyyy',		    
        	autoclose: true
		});

		$('#REPORT_DATE').datepicker().datepicker("setDate", new Date());

		$('#periode').daterangepicker({
			autoUpdateInput: false,
			locale: {
			  cancelLabel: 'Clear',
			  format: 'DD-MM-YYYY'
			}
		});

		$('#periode').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
			var periode_value = picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY');
			searchperiode(periode_value);
		});

		$('#periode').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
	});

	// if radio button change

	// var rad = document.form_report.type_upload;
 //    var prev = null;
 //    for(var i = 0; i < rad.length; i++) {
 //        rad[i].onclick = function() {
 //            (prev)? console.log(prev.value):null;
 //            if(this !== prev) {
 //                prev = this;
 //            }
 //            console.log(this.value)
 //        };
 //    }

 	// function change_radio()
 	// {
 	// 	var value = $("input[name='type_upload']:checked").val();
 	// 	if (value == 1) { 			
 	// 		$("#REPORT_TYPE_ID").prop('required',true);
		// 	$("#PROFILE_ID").prop('required',true);
		// 	$("#REPORT_DATE").prop('required',true);
		// 	$("#REPORT_PATH").prop('required',true);

		// 	$("#DIV_REPORT_TYPE_ID").show();
		// 	$("#DIV_PROFILE_ID").show();
		// 	$("#DIV_REPORT_DATE").show();
		// 	$("#DIV_REPORT_PATH").show();

		// 	$('#caption_filetype').html('(* zip, rar, 7z, pdf, doc, docx, xlx, xlsx, jpg, jpeg, png)');

 	// 	}else{
 	// 		$("#REPORT_TYPE_ID").prop('required',false);
		// 	$("#PROFILE_ID").prop('required',false);
		// 	$("#REPORT_DATE").prop('required',false);
		// 	$("#REPORT_PATH").prop('required',true);

		// 	$("#DIV_REPORT_TYPE_ID").hide();
		// 	$("#DIV_PROFILE_ID").hide();
		// 	$("#DIV_REPORT_DATE").hide();
		// 	$("#DIV_REPORT_PATH").show();

		// 	$('#caption_filetype').html('(* zip, rar, 7z)');
 	// 	}
 	// }

	$('#btn_new_report').click(function(){		
		if($('#custom_search').hasClass('active'))
		{
			$('#custom_search').hide().removeClass('active');
			$('.m_datatable').hide();
			$('#btn_new_report_caption').html('Close');
			$('#act').val('insert');

		}
		else
		{
			$('#custom_search').show().addClass('active');
			$('.m_datatable').show();
			$('#btn_new_report_caption').html('Add Report');
			$('#act').val('');
		}
	});

	$(":input").keyup(function () {
	    _validator($(this));
	});

	$(":input").blur(function () {
	    _validator($(this));
	});

	$('#REPORT_PATH').bind('change', function (e) {
		// var value_radio = $("input[name='type_upload']:checked").val();
		// if (value_radio == undefined || value_radio == null || value_radio == '') {
		// 	swal("", "Pilih Dulu One Report atau Multiple Report", "error");
		// 	$(":file").filestyle('clear');						
		// 	return false;
		// }else{
		// if (value_radio == 1) {
		var file_ex = ["ZIP","RAR","7Z","PDF","DOC","DOCX","XLS","XLX","XLSX","zip","rar","7z","pdf","doc","docx","xls","xlx","xlsx"];
		// }else{
		// 	var file_ex = ["ZIP","RAR","7Z","zip","rar","7z"];
		// }

		if (document.getElementById("REPORT_PATH").files.length > 0) {
			var REPORT_PATH = document.getElementById('REPORT_PATH'); 
			REPORT_PATH = REPORT_PATH.files[0]['name'];
			REPORT_PATH = REPORT_PATH.split('.').pop();
			if ($.inArray(REPORT_PATH, file_ex) != -1)
			{
				if (this.files[0].size > 10485760) {
					swal('','Maaf, upload max size 10 MB','error');
					$(":file").filestyle('clear');
					return false;		
				}
			}else{
				// if (value_radio == 1) {
				swal('','Maaf, file Report harus zip, rar, 7z, pdf, doc, docx, xls, xlx atau xlsx.','error');
				// }else{
				// 	swal('','Maaf, file Report harus zip, rar atau 7z.','error');
				// }
				$(":file").filestyle('clear');
				return false;
			}
		}    
		// }
	});		


	function save_report(formid)
	{
		// var value_radio = $("input[name='type_upload']:checked").val();
		// if (value_radio == undefined || value_radio == null || value_radio == '') {
		// 	swal("", "Pilih Dulu One Report atau Multiple Report", "error");
		// 	return false;
		// }else{
		validation = my_validator(formid);
		if(validation.fail)
		{
			swal("", "Isian Form belum lengkap.", "error");
			return false;
		}

		var form = $('#'+formid);
		var datasend = new FormData(form[0]);					

		$.ajax({
			type: 'POST',
            url: 'management-report/save',
            data: datasend,
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    timeout: 1200000,
            processData: false,
            contentType: false,
		    success: function(data){
                var isiMsg = '';
                var arrdata = data.split('#');
                if (arrdata[0].trim()==='MSG')
                {
                    if (arrdata[1] === 'OK') {
                        isiMsg = arrdata[2];
                        swal("", isiMsg, "success");
                        $('#btn_new_report').click();
                        document.getElementById(formid).reset();
                        call('management-report/list','_content_','Report List')
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

		});
		// }		
	}

	function searchperiode(periode)
	{
		// var periode = $('#periode').val();

		if (periode == '' || periode == null || periode == undefined) {
			swal("", "Periode Harus Diisi", "error");
			return false;
		}else{
			call('management-report/list/'+periode,'_content_','Report List')
		}
	}
</script>

<script type="text/javascript">
	
$(document).ready(function () {
	var periode = $('#periode').val();	
	$.ajax({
        type:'GET',
        url: 'management-report/data/'+periode, 
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
				field: "REPORT_ID",
				title: "#",
				sortable: false, // disable sort for this column
				width: 40,
				textAlign: 'center',
				selector: {class: 'm-checkbox--solid m-checkbox--brand'}
			},
			{
				field: "row_number",
				title: "No.",
				width: 50,
				sortable: false,
				selector: false,
				textAlign: 'center'
			}, {
				field: "PROFILE_NPWP",
				title: "NPWP"
			}, {
				field: "PROFILE_COMPANY_NAME",
				title: "Company Name"
			}, {
				field: "REPORT_DATE_FORMAT",
				title: "Date"
			}, {
				field: "REPORT_TYPE_NAME",
				title: "Type",
			}
			@if(Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21)
			, {
				field: "Actions",
				width: 110,
				title: "Actions",
				sortable: false,
				overflow: 'visible',
				template: function (row) {
					// return '<p>test</p>';
					var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
					var btn = '';

					@if(Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21)
						btn = '<a href="#" onclick="view('+row.REPORT_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">\
	                            <i class="la la-edit"></i>\
	                        </a>\
	                        <a href="#" onclick="hapus('+row.REPORT_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete ">\
	                            <i class="la la-trash"></i>\
	                        </a>\
							';					
					@endif
					return btn;
				}
			}
			@endif
			]
		});

		var query = datatable.getDataSourceQuery();

		$('#m_form_type').on('change', function () {
			datatable.search($(this).val(), 'REPORT_TYPE_ID');
		}).val(typeof query.REPORT_TYPE_ID !== 'undefined' ? query.REPORT_TYPE_ID : '');

		$('#m_form_type').selectpicker();	

		// on checkbox checked event
		$('.m_datatable')
			.on('m-datatable--on-check', function (e, args) {
				var count = datatable.getSelectedRecords().length;
				$('#m_datatable_selected_number').html(count);
				if (count > 0) {
					$('#m_datatable_group_action_form').collapse('show');					
				}
			})
			.on('m-datatable--on-uncheck m-datatable--on-layout-updated', function (e, args) {
				var count = datatable.getSelectedRecords().length;
				$('#m_datatable_selected_number').html(count);
				if (count === 0) {
					$('#m_datatable_group_action_form').collapse('hide');
				}
			});

		$('#m_datatable_check_all').click(function(){
			
			$('#modal_code').modal();
			// send email
			$.ajax({
		        type:'GET',
		        url: 'management-report/sendotp/', 
		        data : '',
		        success: function(data){
		        	if (data=='success') {
		        	}else{
		        		swal("","Terjadi Kesalahan !","error");
		        		$('#modal_code').hide();
		        		return false;
		        	}
		    	}
			});

			var data123 = datatable.getSelectedRecords();			
			var rowsid = [];		
			if (data123.length > 0) {
				$.each(data123, function(key, val)
				{					
					rowsid.push($(val).find('input').val());
				})

				rowsid.toString();
				$('#report_id').val(rowsid);
			}else{
				swal("","Pilih Data Dahulu !","error");
			}
		});	

		}	


	});

	return false;
});

function view(id)
{
	$.ajax({
		type: 'GET',
		data: {report_id : id},
		url: 'management-report/view',
		success: function(data){
			$('#_content_body_').html(data);
		}
	})
}

function hapus(id)
{
	swal({
	  title: "",
	  text: "Are you sure delete it?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Yes, Delete!",
	  closeOnConfirm: false
	},
	function(){
		$.ajax({
			type: 'GET',
			data: {report_id : id},
			url: 'management-report/delete',
			success: function(data){
				swal("Deleted!", "Report Data Deleted.", "success");
				call('management-report/list', '_content_', 'Report List');
			}
		})
	});
}

function preview(id)
{
	var tipe = 'report';
	window.open(site_url+"/preview/"+tipe+"/"+id,"Preview Report","scrollbars=yes, resizable=yes,width=1100,height=700");
}

function resend_code(){
	$.ajax({
        type:'GET',
        url: 'management-report/sendotp/', 
        data : '',
        success: function(data){
        	if (data=='success') {
        		swal("Sended!","Check Your Email !","success");
        	}else{
        		swal("","Terjadi Kesalahan !","error");
        		
        		// return false;
        	}
    	}
	});
}

function close_modal()
{
	swal({
	  title: "",
	  text: "Are you sure close it?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Yes, Close!",
	  closeOnConfirm: true
	},
	function(){
		$.ajax({
			type: 'GET',
			data: '',
			url: 'management-report/sendotp/close',
			success: function(data){
				
				$('#modal_code').modal('hide');
			}
		})
	});
}

function send_code(formid)
{
	validation = my_validator(formid);
	if(validation.fail)
	{
		swal("", "Isian Form belum lengkap.", "error");
		return false;
	}

	var form = $('#'+formid);
	var datasend = new FormData(form[0]);				

	$.ajax({
		type: 'POST',
        url: 'management-report/sendcode',
        data: datasend,
		headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    timeout: 1200000,
        processData: false,
        contentType: false,
	    success: function(data){	    		    	
	    	if (data.type == 'error') {
	            var isiMsg = '';
	            var arrdata = (data.msg).split('#');
	            if (arrdata[0].trim()==='MSG')
	            {
	                if (arrdata[1] === 'OK') {
	                    isiMsg = arrdata[2];
	                    swal("", isiMsg, "success");
	                    document.getElementById(formid).reset();
	                    
	                    $('#modal_code').modal('hide');
	                } else {
	                    isiMsg = arrdata[2];
	                    swal("", isiMsg, "error");
	                }
	            }	            
	    	}else{
	    		if (data.count > 1) {
	    			var tipe = 'zip-report';	    		
                }else{
 					var tipe = 'one-report';	
                }

				window.location = site_url+"/downloadfile/"+tipe+"/"+data.report_id;

				$('#report_id').val('');
				$('#code').val('');
				
				$('#modal_code').modal('hide');
	    	}
	    }

	});
}

</script>
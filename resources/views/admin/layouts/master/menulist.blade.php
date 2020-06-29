<div class="m-content">
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Menu List						
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body" id="_content_body_">
			<!--begin: Search Form -->
			<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
				<div class="row align-items-center">
					<div class="col-xl-8 order-2 order-xl-1">
						<div class="form-group m-form__group row align-items-center  active" id="custom_search">						
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
						<a href="#" id="btn_new_menu" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" data-toggle="collapse" data-target="#div_form_menu">
							<span>
								<i class="la la-cart-plus"></i>
								<span id="btn_new_menu_caption">
									Add Menu
								</span>
							</span>
						</a>
						<div class="m-separator m-separator--dashed d-xl-none"></div>
					</div>
				</div>
			</div>
			<!--end: Search Form -->

			<div id="div_form_menu" class="collapse">
				<div class="m-portlet m-portlet--bordered m-portlet--unair">
					<div class="m-portlet__head" style="background-color: #f7f8fa">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon">
									<i class="la la-user-plus"></i>
								</span>
								<h3 class="m-portlet__head-text">
									New Master Menu
								</h3>
							</div>			
						</div>
					</div>
					<!--begin::Form-->
					<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_menu" data-validator="my_validator">						
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<div class="col-lg-6">
									<label>
										Menu Name:
									</label>
									<input class="form-control m-input" type="hidden" name="act" id="act" value="insert">									
									<input class="form-control m-input" placeholder="Enter Menu Name" type="text" name="MENU_NAME" required="">
								</div>
								<div class="col-lg-6">
									<label>
										Menu Price:
									</label>									
									<input class="form-control m-input" placeholder="Enter Menu Price" type="text" name="PRICE">
								</div>
							</div>
							<div class="form-group m-form__group row">
								<div class="col-lg-6">
									<label for="">
										Kind Of Menu:
									</label>									
									<select class="form-control m-input" name="KIND_MENU_ID" id="KIND_MENU_ID" required="">
										<option value="">- Choose Type -</option>
										@foreach($kom as $koms)
										<option value="{{$koms->KIND_MENU_ID}}">{{$koms->KIND_MENU_NAME}}</option>
										@endforeach					
									</select>
								</div>	
								<div class="col-lg-6">
									<label for="">
										Menu Photo: <small>(*jpg, jpeg, png)</small>
									</label>
									<input type="file" class="input04" id="PHOTO" name="PHOTO" required="">
									<span class="m-form__help">*Max Size File Upload 10 MB</span>
								</div>	
							</div>
						</div>
						<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
							<div class="m-form__actions m-form__actions--solid">
								<div class="row">
									<div class="col-lg-6">
										<button class="btn btn-primary" onclick="save_menu(this.form.id);return false;">Save</button>
										<button type="reset" onclick="$('#btn_new_menu').click();" class="btn btn-secondary">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<!--end::Form-->
				</div>
			</div>

<!--begin: Datatable -->
			<div class="m_datatable" id="local_data">
				
			</div>
			<!--end: Datatable -->
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#btn_new_menu').click(function(){		
		if($('#custom_search').hasClass('active'))
		{
			$('#custom_search').hide().removeClass('active');
			$('.m_datatable').hide();
			$('#btn_new_menu_caption').html('Close');
			$('#act').val('insert');

		}
		else
		{
			$('#custom_search').show().addClass('active');
			$('.m_datatable').show();
			$('#btn_new_menu_caption').html('Add slider');
			$('#act').val('');
		}
	});

	$(":input").keyup(function () {
	    _validator($(this));
	});

	$(":input").blur(function () {
	    _validator($(this));
	});


	function save_menu(formid)
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
            url: 'management-master/save/menu',
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
                        $('#btn_new_menu').click();
                        document.getElementById(formid).reset();
                        call('management-master/list/menu','_content_','Master Menu')
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

	var file_ex = ["JPG","JPEG","PNG","jpg","jpeg","png"];
	$('#PHOTO').bind('change', function (e) {
		if (document.getElementById("PHOTO").files.length > 0) {
			var PHOTO = document.getElementById('PHOTO'); 
			PHOTO = PHOTO.files[0]['name'];
			PHOTO = PHOTO.split('.').pop();
			if ($.inArray(PHOTO, file_ex) != -1)
			{
				if (this.files[0].size > 10485760) {
					swal('','Maaf, upload max size 10 MB','error');
					$(":file").filestyle('clear');
					return false;		
				}
			}else{
				swal('','Maaf, file harus jpg, jpeg atau png.','error');
				$(":file").filestyle('clear');
				return false;
			}
		}    
	});
</script>

<script type="text/javascript">
	
$(document).ready(function () {

	$('.input04').filestyle({
		htmlIcon : '<i class="fa fa-folder-open"></i>',
		text: ''
	});

	$.ajax({
        type:'GET',
        url: 'management-master/data/menu', 
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

			rowReorder: true,
			// column sorting
			sortable: true,
			pagination: true,
			fixedColumns:   {
	            heightMatch: 'none'
	        },
			search: {
				input: $('#generalSearch')
			},

			// inline and bactch editing(cooming soon)
			// editable: false,

			// columns definition
			columns: [
			// {
			// 	field: "row_number",
			// 	title: "No.",
			// 	width: 50,
			// 	sortable: false,
			// 	selector: false,
			// 	textAlign: 'center'
			// },
			{
				field: "MENU_NAME",
				title: "Menu Name"
			}, {
				field: "PRICE",
				title: "Menu Price",
				template: function (row) {
					return 'Rp. ' + (row.PRICE).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
				}
			}, {
				field: "KIND_MENU_ID",
				title: "Status",
				// callback form-groupnction support for column rendering
				template: function (row) {
					var status = {
						1: {'title': 'BREAKFAST', 'class': 'm-badge--success'},
						2: {'title': 'LUNCH', 'class': 'm-badge--info'},
						3: {'title': 'DRINKS', 'class': 'm-badge--warning'},
						4: {'title': 'SNACKS', 'class': ' m-badge--danger'}
					};
					return '<span class="m-badge ' + status[row.KIND_MENU_ID].class + ' m-badge--wide">' + status[row.KIND_MENU_ID].title + '</span>';
				}
			}, {
				field: "PHOTO",
				title: "Image",
				template: function(row){					
					var link = '<?php echo asset("/") ?>';
					var file = (row.PHOTO).substr(1);
					return '<img style="max-width:70%;max-height:70%;" src="'+link+file+'">';
				}
			}, {
				field: "Actions",
				width: 110,
				title: "Actions",
				sortable: false,
				overflow: 'visible',
				template: function (row) {
					// return '<p>test</p>';
					var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
					return '<a href="#" onclick="view('+row.MENU_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">\
	                            <i class="la la-edit"></i>\
	                        </a>\
	                        <a href="#" onclick="hapus('+row.MENU_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">\
	                            <i class="la la-trash"></i>\
	                        </a>\
							';
				}
			}
			]
		});

		var query = datatable.getDataSourceQuery();

		$('#m_form_status').on('change', function () {
			datatable.search($(this).val(), 'SLIDER_DISPLAY');
		}).val(typeof query.SLIDER_DISPLAY !== 'undefined' ? query.SLIDER_DISPLAY : '');

		$('#m_form_status').selectpicker();
        }
	});

	return false;
});

function view(id)
{
	$.ajax({
		type: 'GET',
		data: {MENU_ID : id},
		url: 'management-master/view/menu',
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
			data: {MENU_ID : id},
			url: 'management-master/delete/menu',
			success: function(data){
				swal("Deleted!", "Menu Data Has Been Deleted.", "success");
				call('management-master/list/menu', '_content_', 'Master Menu');
			}
		})
	});
}


</script>
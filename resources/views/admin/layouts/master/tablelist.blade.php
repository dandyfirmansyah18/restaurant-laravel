<div class="m-content">
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Table Master						
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
						<a href="#" id="btn_new_table" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" data-toggle="collapse" data-target="#div_form_table">
							<span>
								<i class="la la-cart-plus"></i>
								<span id="btn_new_table_caption">
									Add Table Master
								</span>
							</span>
						</a>
						<div class="m-separator m-separator--dashed d-xl-none"></div>
					</div>
				</div>
			</div>
			<!--end: Search Form -->

			<div id="div_form_table" class="collapse">
				<div class="m-portlet m-portlet--bordered m-portlet--unair">
					<div class="m-portlet__head" style="background-color: #f7f8fa">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon">
									<i class="la la-user-plus"></i>
								</span>
								<h3 class="m-portlet__head-text">
									New Data Master Table
								</h3>
							</div>			
						</div>
					</div>
					<!--begin::Form-->
					<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_table" data-validator="my_validator">						
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<div class="col-lg-6">
									<label>
										Table No:
									</label>
									<input class="form-control m-input" type="hidden" name="act" id="act" value="insert">
									<input class="form-control m-input" placeholder="Enter Table No" type="text" name="TABLE_NO" required="">
								</div>
								<div class="col-lg-6">
									<label>
										Table People Max:
									</label>
								  	<input class="form-control m-input" placeholder="Enter Table People Max" type="text" name="TABLE_PEOPLE_MAX" required="">									
								</div>
							</div>							
						</div>
						<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
							<div class="m-form__actions m-form__actions--solid">
								<div class="row">
									<div class="col-lg-6">
										<button class="btn btn-primary" onclick="save_table(this.form.id);return false;">Save</button>
										<button type="reset" onclick="$('#btn_new_table').click();" class="btn btn-secondary">Cancel</button>
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
	$('#btn_new_table').click(function(){		
		if($('#custom_search').hasClass('active'))
		{
			$('#custom_search').hide().removeClass('active');
			$('.m_datatable').hide();
			$('#btn_new_table_caption').html('Close');
			$('#act').val('insert');

		}
		else
		{
			$('#custom_search').show().addClass('active');
			$('.m_datatable').show();
			$('#btn_new_table_caption').html('Add Client');
			$('#act').val('');
		}
	});

	$(":input").keyup(function () {
	    _validator($(this));
	});

	$(":input").blur(function () {
	    _validator($(this));
	});

	function save_table(formid)
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
            url: 'management-master/save/table',
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
                        $('#btn_new_table').click();
                        document.getElementById(formid).reset();
                        call('management-master/list/table','_content_','Master Table')
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

</script>

<script type="text/javascript">
	
$(document).ready(function () {

	$('.input04').filestyle({
		htmlIcon : '<i class="fa fa-folder-open"></i>',
		text: ''
	});

	$.ajax({
        type:'GET',
        url: 'management-master/data/table', 
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
			fixedColumns:   {
	            heightMatch: 'none'
	        },
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
				field: "TABLE_NO",
				title: "Table Number"
			}, {
				field: "TABLE_PEOPLE_MAX",
				title: "People Max"
			}, {
				field: "Actions",
				width: 110,
				title: "Actions",
				sortable: false,
				overflow: 'visible',
				template: function (row) {
					// return '<p>test</p>';
					var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
					return '<a href="#" onclick="view('+row.TABLE_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">\
	                            <i class="la la-edit"></i>\
	                        </a>\
	                        <a href="#" onclick="hapus('+row.TABLE_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete ">\
	                            <i class="la la-trash"></i>\
	                        </a>\
							';
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

function view(id)
{
	$.ajax({
		type: 'GET',
		data: {TABLE_ID : id},
		url: 'management-master/view/table',
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
			data: {TABLE_ID : id},
			url: 'management-master/delete/table',
			success: function(data){
				swal("Deleted!", "Table Data Has Been Deleted.", "success");
				call('management-master/list/table', '_content_', 'Client List');
			}
		})
	});
}
</script>
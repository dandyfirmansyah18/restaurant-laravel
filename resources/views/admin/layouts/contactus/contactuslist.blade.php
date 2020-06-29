<!-- BEGIN: Subheader -->
<!-- <div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Management Contact Us  
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
						Messages
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
												Read
											</option>
											<option value="0">
												Unread
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
					<!-- <div class="col-xl-4 order-1 order-xl-2 m--align-right">
						<a href="#" id="btn_new_regulation" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" data-toggle="collapse" data-target="#div_form_regulation">
							<span>
								<i class="la la-cart-plus"></i>
								<span id="btn_new_regulation_caption">
									Add Regulation
								</span>
							</span>
						</a>
						<div class="m-separator m-separator--dashed d-xl-none"></div>
					</div> -->
				</div>
			</div>
			<!--end: Search Form -->

			<!--begin: Datatable -->
			<div class="m_datatable" id="local_data">
				
			</div>
			<!--end: Datatable -->
		</div>
	</div>
</div>

<script type="text/javascript">
	
$(document).ready(function () {

	$.ajax({
        type:'GET',
        url: 'management-contactus/data', 
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
			autoWidth: false,

			// columns definition
			columns: [{
				field: "row_number",
				title: "No.",
				width: 40,
				sortable: false,
				selector: false,
				textAlign: 'center'
			}, {
				field: "NAME",
				title: "Name",
				template: function(row){
					return '<div>'+row.CONTACT_US_NAME+'</div>\
					<div>'+row.CONTACT_US_EMAIL+'</div>';
				}
			}, {
				field: "CONTACT_US_TEXT2",
				title: "Message"
			}, {
				field: "CONTACT_US_READ",
				title: "Status",
				template: function (row) {
					var status = {
						1: {'title': 'Read', 'class': 'm-badge--success'},
						0: {'title': 'Unread', 'class': ' m-badge--danger'}
					};
					return '<span class="m-badge ' + status[row.CONTACT_US_READ].class + ' m-badge--wide">' + status[row.CONTACT_US_READ].title + '</span>';
				}
			}, {
				field: "Actions",
				width: 60,
				title: "Actions",
				sortable: false,
				overflow: 'visible',
				template: function (row) {
					var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
					return '<a href="#" onclick="view('+row.CONTACT_US_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="View Detail">\
	                            <i class="la la-eye"></i>\
	                        </a>\
							';
				}
			}
			]
		});

		var query = datatable.getDataSourceQuery();

		$('#m_form_status').on('change', function () {
			datatable.search($(this).val(), 'CONTACT_US_READ');
		}).val(typeof query.CONTACT_US_READ !== 'undefined' ? query.CONTACT_US_READ : '');		

		$('#m_form_status').selectpicker();
        }
	});

	return false;
});

function view(id)
{
	loading();
	$.ajax({
		type: 'GET',
		data: {contactus_id : id},
		url: 'management-contactus/view',
		success: function(data){
			clearLoading();
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
			data: {regulation_id : id},
			url: 'management-regulation/delete',
			success: function(data){
				swal("Deleted!", "Regulation Data Deleted.", "success");
				call('management-regulation/list', '_content_', 'Regulation List');
			}
		})
	});
}

function activate(status, id)
{
	$.ajax({
		type: 'GET',
		data: {status : status, regulation_id : id},
		url: 'management-regulation/activate',
		success: function(data){
			call('management-regulation/list', '_content_', 'News List');
		}
	})
}

function preview(id)
{
	var tipe = 'regulation';
	window.open(site_url+"/preview/"+tipe+"/"+id,'_blank');
}

</script>
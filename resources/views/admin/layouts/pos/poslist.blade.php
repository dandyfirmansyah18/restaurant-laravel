<!-- BEGIN: Subheader -->
<!-- <div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Management Kegiatan Pasar Modal
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
						History POS List						
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
				</div>
			</div>
			<!--end: Search Form -->

			<!--begin: Datatable -->
			<div class="m_datatable" id="local_data"></div>
			<!--end: Datatable -->

			<!--begin::Modal-->
			<div class="modal fade" id="modal_detail_pos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">
								Detail POS <span id="span_transaction_number"></span>
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">
									&times;
								</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group m-form__group row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="recipient-name" class="form-control-label">
											Transaction Number:
										</label>
										<input type="text" class="form-control" id="TRANSACTION_NUMBER" disabled>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="message-text" class="form-control-label">
											Customer Name:
										</label>
										<input type="text" class="form-control" id="TRANSACTION_CUSTOMER_NAME" disabled>
									</div>	
								</div>
							</div>
							<div class="form-group m-form__group row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="recipient-name" class="form-control-label">
											Table / TakeAway:
										</label>
										<input type="text" class="form-control" id="TABLE_NO" disabled>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="message-text" class="form-control-label">
											Transaction Note:
										</label>
										<textarea class="form-control" id="TRANSACTION_NOTE" disabled></textarea>
									</div>	
								</div>
							</div>
							<div class="form-group m-form__group row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="recipient-name" class="form-control-label">
											Cashier Name:
										</label>
										<input type="text" class="form-control" id="CASHIER_NAME" disabled>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="message-text" class="form-control-label">
											Transaction Date:
										</label>
										<input type="text" class="form-control" id="TRANSACTION_DATE" disabled>
									</div>	
								</div>
							</div>
							<br>
							<div id="detail_table"></div>						
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>							
						</div>
					</div>
				</div>
			</div>
			<!--end::Modal-->
		</div>
	</div>
</div>

<script type="text/javascript">	
	$(":input").keyup(function () {
	    _validator($(this));
	});

	$(":input").blur(function () {
	    _validator($(this));
	});

</script>

<script type="text/javascript">
	
$(document).ready(function () {

	$.ajax({
        type:'GET',
        url: 'management-pos/datapos', 
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
				field: "TRANSACTION_NUMBER",
				title: "Transaction Number"
			}, {
				field: "TRANSACTION_CUSTOMER_NAME",
				title: "Customer Name "
			}, {
				field: "TABLE_NO",
				title: "Table/TakeAway "
			}, {
				field: "TRANSACTION_PRICE",
				title: "Total",
				template: function (row) {
					return 'Rp. ' + (row.TRANSACTION_PRICE).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
				}
			}, {
				field: "TRANSACTION_TAX",
				title: "Tax",
				template: function (row) {
					return 'Rp. ' + (row.TRANSACTION_TAX).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
				}
			}, {
				field: "TRANSACTION_PRICE_TOTAL",
				title: "Grand Total",
				template: function (row) {
					return 'Rp. ' + (row.TRANSACTION_PRICE_TOTAL).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
				}
			}, {
				field: "Actions",
				width: 110,
				title: "Actions",
				sortable: false,
				overflow: 'visible',
				template: function (row) {					
					var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
					return '<a href="#" onclick="detailpos('+row.TRANSACTION_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Detail ">\
	                            <i class="la la-edit"></i>\
	                        </a>\
							';
				}
			}
			]
		});

		var query = datatable.getDataSourceQuery();
        }
	});

	return false;
});

function detailpos(id)
{
	$('#modal_detail_pos').modal('show');
	$.ajax({
		type: 'GET',
		data: {TRANSACTION_ID : id},
		url: 'management-pos/DetailPOS',
		success: function(data){
			// console.log(data.header['TRANSACTION_CUSTOMER_NAME']);			
			var myTable= '<table class="table table-sm m-table m-table--head-bg-brand">';
			myTable+= '<thead class="thead-inverse">\
							<tr>\
								<th width="5%" class="text-center">No.</th>\
								<th width="40%" class="text-center">Menu Name</th>\
								<th width="10%" class="text-center">Price/Item</th>\
								<th width="10%" class="text-center">Sum Deliver</th>\
								<th width="15%" class="text-center">Total</th>\
							</tr>\
						</thead>';
			myTable+= "<tbody>";
			var a = 0;
			data.detail.forEach(function(e){
				a = a+1;
				myTable+='<tr><td align="center"><strong>' + a + '</strong></td>';
				myTable+='<td>' + e['MENU_NAME'] + '</td>';
				myTable+='<td align="center">' + e['PRICE'] + '</td>';
				myTable+='<td align="center">' + e['TRANSACTION_MENU_AMOUNT'] + '</td>';
				myTable+='<td align="center">' + parseInt(e['TRANSACTION_MENU_AMOUNT']) * parseInt(e['PRICE']) + '</td>';
				myTable+='</tr>';						
			});
			myTable+='</tbody></table>';

			$('#detail_table').html(myTable);
			$('#TRANSACTION_NUMBER').val(data.header['TRANSACTION_NUMBER']);
			$('#TRANSACTION_CUSTOMER_NAME').val(data.header['TRANSACTION_CUSTOMER_NAME']);
			$('#TRANSACTION_NOTE').val(data.header['TRANSACTION_NOTE']);
			$('#TABLE_NO').val(data.header['TABLE_NO']);
			$('#CASHIER_NAME').val(data.header['PROFILE_CASHIER_NAME']);
			$('#TRANSACTION_DATE').val(data.header['CREATED_AT']);
		}
	})

}

</script>
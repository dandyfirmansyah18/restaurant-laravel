<div class="m-content">
	<div class="row">
		<div class="col-lg-4">
			<!--begin::Portlet-->
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Header Transaction
							</h3>
						</div>
					</div>
				</div>								
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right" id="form_pos" data-validator="my_validator">
					<div class="m-portlet__body">
						<div class="form-group m-form__group">
							<label for="exampleInputEmail1">
								Transaction Number
							</label>
							<input type="text" class="form-control m-input" id="TRANSACTION_NUMBER" name="TRANSACTION_NUMBER" value="{{$TRANSACTION_NUMBER}}" readonly="readonly">									
						</div>
						<div class="form-group m-form__group">
							<label for="exampleInputPassword1">
								Customer Name
							</label>
							<input type="text" class="form-control m-input" id="TRANSACTION_CUSTOMER_NAME" name="TRANSACTION_CUSTOMER_NAME" placeholder="Enter Customer Name" required>
						</div>
						
						<div class="form-group m-form__group">
							<label for="exampleSelect1">
								Table / TakeAway
							</label>
							<select class="form-control m-input" id="exampleSelect1" id="TRANSACTION_TABLE_ID" name="TRANSACTION_TABLE_ID" required>
								<option value="">-Silahkan Pilih-</option>
								@foreach($table_master as $tables)
									@if($tables->TABLE_NO != 'TAW')
									<option value="{{$tables->TABLE_ID}}">{{$tables->TABLE_NO}} ({{$tables->TABLE_PEOPLE_MAX}} Orang)</option>
									@else
									<option value="{{$tables->TABLE_ID}}">TakeAway</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="form-group m-form__group">
							<label for="exampleTextarea">
								Transaction Note
							</label>
							<textarea class="form-control m-input" id="exampleTextarea" id="TRANSACTION_NOTE" name="TRANSACTION_NOTE" rows="3" required></textarea>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions">
							<button class="btn btn-primary" onclick="save_pos(this.form.id);return false;">
								Submit
							</button>
							<button type="reset" class="btn btn-secondary">
								Cancel
							</button>
						</div>
					</div>
				</form>
				<!--end::Form-->
			</div>
			<!--end::Portlet-->
		</div>
		<div class="col-lg-8">
			<!--begin::Portlet-->
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								List Menu
							</h3>
						</div>
					</div>
				</div>
				<div class="m-portlet__body">
					<ul class="nav nav-pills" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1">
								BREAKFAST
							</a>
						</li>						
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#m_tabs_3_2">
								LUNCH
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#m_tabs_3_3">
								DRINKS
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#m_tabs_3_4">
								SNACKS
							</a>
						</li>
					</ul>
					<br>
					<div class="tab-content">
						<div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
							<div class="row">
							@foreach($food_breakfast as $breaks)
						    <div class="col-md-3">
						      <div class="thumbnail">
						        <a href="javascript:void(0)" onclick="addmenus('{{$breaks->MENU_ID}}')">
						          <img src="{{ asset($breaks->PHOTO) }}" class="img-responsive rounded" alt="Lights" style="width: 150px;height: 150px;object-fit: cover; display: block;margin-left: auto; margin-right: auto;">
						          <div class="caption center-block">
						            <p style="font-size: 13px; text-align: center;">{{ $breaks->MENU_NAME }}</p>
						          </div>
						        </a>
						      </div>
						    </div>
						    @endforeach						    
						  </div>
						</div>
						<div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
							<div class="row">
							@foreach($food_lunch as $lunchs)
						    <div class="col-md-3">
						      <div class="thumbnail">
						        <a href="javascript:void(0)" onclick="addmenus('{{$lunchs->MENU_ID}}')">
						          <img src="{{ asset($lunchs->PHOTO) }}" class="img-responsive rounded" alt="Lights" style="width: 150px;height: 150px;object-fit: cover; display: block;margin-left: auto; margin-right: auto;">
						          <div class="caption center-block">
						            <p style="font-size: 13px; text-align: center;">{{ $lunchs->MENU_NAME }}</p>
						          </div>
						        </a>
						      </div>
						    </div>
						    @endforeach						    
						  </div>
						</div>
						<div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
							<div class="row">
							@foreach($drink as $drinks)
						    <div class="col-md-3">
						      <div class="thumbnail">
						        <a href="javascript:void(0)" onclick="addmenus('{{$drinks->MENU_ID}}')">
						          <img src="{{ asset($drinks->PHOTO) }}" class="img-responsive rounded" alt="Lights" style="width: 150px;height: 150px;object-fit: cover; display: block;margin-left: auto; margin-right: auto;">
						          <div class="caption center-block">
						            <p style="font-size: 13px; text-align: center;">{{ $drinks->MENU_NAME }}</p>
						          </div>
						        </a>
						      </div>
						    </div>
						    @endforeach						    
						  </div>
						</div>
						<div class="tab-pane" id="m_tabs_3_4" role="tabpanel">
							<div class="row">
							@foreach($snack as $snacks)
						    <div class="col-md-3">
						      <div class="thumbnail">
						        <a href="javascript:void(0)" onclick="addmenus('{{$snacks->MENU_ID}}')">
						          <img src="{{ asset($snacks->PHOTO) }}" class="img-responsive rounded" alt="Lights" style="width: 150px;height: 150px;object-fit: cover; display: block;margin-left: auto; margin-right: auto;">
						          <div class="caption center-block">
						            <p style="font-size: 13px; text-align: center;">{{ $snacks->MENU_NAME }}</p>
						          </div>
						        </a>
						      </div>
						    </div>
						    @endforeach						    
						  </div>
						</div>
					</div>
				</div>
			</div>
			<!--end::Portlet-->
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<!--begin::Portlet-->
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Detail Transaction
							</h3>
						</div>
					</div>
				</div>								
				<div class="m-portlet__body">
					<!--begin::Section-->
					<div class="m-section">
						<div class="m-section__content">
							<div id="detail_table"></div>						
						</div>
					</div>
				</div>
			</div>
			<!--end::Portlet-->
		</div>
	</div>
</div>

<script type="text/javascript">
	
</script>

<script type="text/javascript">
	
$(document).ready(function () {

	var TRANSACTION_NUMBER = $('#TRANSACTION_NUMBER').val();
	table_detail(TRANSACTION_NUMBER);	

});

function table_detail(TRANSACTION_NUMBER)
{		
	$.ajax({
		type: 'GET',
		data: {TRANSACTION_NUMBER : TRANSACTION_NUMBER},
		url: 'management-pos/getDetailTransaction',
		success: function(data){
			if (data.length > 0) {
				var myTable= '<table class="table table-sm m-table m-table--head-bg-brand">';
				myTable+= '<thead class="thead-inverse">\
								<tr>\
									<th width="5%" class="text-center">No.</th>\
									<th width="40%" class="text-center">Menu Name</th>\
									<th width="10%" class="text-center">Price/Item</th>\
									<th width="10%" class="text-center">Sum Deliver</th>\
									<th width="15%" class="text-center">Action</th>\
								</tr>\
							</thead>';
				myTable+= "<tbody>";
				var a = 0;
				data.forEach(function(e){
					a = a+1;
					myTable+='<tr><td align="center"><strong>' + a + '</strong></td>';
					myTable+='<td>' + e['MENU_NAME'] + '</td>';
					myTable+='<td align="center">' + e['PRICE'] + '</td>';
					myTable+='<td><div class="input-group">\
								<span class="input-group-btn">\
									<button type="button" class="btn btn-danger btn-number btn-sm"  data-type="minus" data-field="quant[2]" href="javascript:void(0)" onclick="plusupdate('+e['TRANSACTION_TEMP_ID']+')">\
									<i class="fa fa-plus"></i>\
									</button>\
								</span>\
								<input type="text" name="quant[2]" id="amount_tx_'+e['TRANSACTION_TEMP_ID']+'" class="form-control form-control-sm m-input" value="'+e['TRANSACTION_TEMP_AMOUNT']+'" min="1" max="100">\
								<span class="input-group-btn">\
									<button type="button" class="btn btn-success btn-number btn-sm" data-type="plus" data-field="quant[2]" href="javascript:void(0)" onclick="minusupdate('+e['TRANSACTION_TEMP_ID']+')">\
									<i class="fa fa-minus"></i>\
									</button>\
								</span>\
							</div></td>';
					myTable+='<td align="center"><a href="javascript:void(0)" onclick="deletedetailtemp('+e['TRANSACTION_TEMP_ID']+')" class="btn btn-danger m-btn btn-sm m-btn m-btn--icon m-btn--pill">\
								<span>\
									<i class="la la-trash"></i>\
									<span>\
										Delete\
									</span>\
								</span>\
							</a></td>';
					myTable+='</tr>';						
				});
				myTable+='</tbody></table>';				
			}else{
				var myTable= '<table class="table table-sm m-table m-table--head-bg-brand">';
				myTable+= '<thead class="thead-inverse">\
								<tr>\
									<th width="5%">No.</th>\
									<th width="40%">Menu Name</th>\
									<th width="10%">Price/Item</th>\
									<th width="10%">Sum Deliver</th>\
									<th width="15%">Action</th>\
								</tr>\
							</thead>';
				myTable+= "<tbody>";					
				myTable+='</tbody></table>';
			}	

			$('#detail_table').html(myTable);			
		}
	})
}

function minusupdate(id)
{
	var value_amount = parseInt($('#amount_tx_'+id).val());
	value_amount = value_amount - 1;

	$.ajax({
		type: 'POST',
        url: 'management-pos/updateamounttemp',
        data: {TRANSACTION_TEMP_AMOUNT:value_amount, TRANSACTION_TEMP_ID:id},
		headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    success: function(data){                
			$('#amount_tx_'+id).val(value_amount);
	    }
	});
}

function plusupdate(id)
{
	var value_amount = parseInt($('#amount_tx_'+id).val());
	value_amount = value_amount + 1;

	$.ajax({
		type: 'POST',
        url: 'management-pos/updateamounttemp',
        data: {TRANSACTION_TEMP_AMOUNT:value_amount, TRANSACTION_TEMP_ID:id},
		headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    success: function(data){                
			$('#amount_tx_'+id).val(value_amount);
	    }
	})
}

function addmenus(idmenu)
{
	var TRANSACTION_NUMBER = $('#TRANSACTION_NUMBER').val();
	$.ajax({
		type: 'POST',
        url: 'management-pos/addmenus',
        data: {TRANSACTION_TEMP_ID_MENU:idmenu, TRANSACTION_TEMP_TRANSACTION_NUMBER:TRANSACTION_NUMBER},
		headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    success: function(data){                
			if (data == 'success') {
				table_detail(TRANSACTION_NUMBER);
			}else{
				swal("", "Add Menu Failed.", "error");
			}
	    }
	})
}

function deletedetailtemp(id)
{
	var TRANSACTION_NUMBER = $('#TRANSACTION_NUMBER').val();
	$.ajax({
		type: 'POST',
        url: 'management-pos/deletedetailtemp',
        data: {TRANSACTION_TEMP_ID:id},
		headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    success: function(data){           
			if (data == 'success') {
				table_detail(TRANSACTION_NUMBER);
			}else{
				swal("", "Delete Failed.", "error");
			}
	    }
	})
}

function save_pos(formid)
{
	var TRANSACTION_NUMBER = $('#TRANSACTION_NUMBER').val();
	validation = my_validator(formid);
	if(validation.fail)
	{
		swal("", "Isian Form belum lengkap.", "error");
		return false;
	}

	var form = $('#'+formid);
	var datasend = form.serializeArray();

	swal({
	  title: "",
	  text: "Are you sure submit this transaction ?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Yes, Delete!",
	  closeOnConfirm: false
	},
	function(){
		$.ajax({
			type: 'POST',
	        url: 'management-pos/save',
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
	                    document.getElementById(formid).reset();
	                    // call('management-pos/list','_content_','History POS');
	                    window.open(base_url+"/pos_form_print/"+arrdata[3],"Cetak POS "+TRANSACTION_NUMBER ,"scrollbars=yes, resizable=yes,width=1100,height=700");
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
</script>
<!--begin::Form-->
<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_news" data-validator="my_validator">	
	<input type="hidden" name="act" value="update">
	<input type="hidden" name="REPORT_ID" value="{{$REPORT->REPORT_ID}}">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<div class="col-lg-6">
				<label>
					Report Type:
				</label>				
				<select class="form-control m-input" id="REPORT_TYPE_ID" name="REPORT_TYPE_ID" required="">
					<option value="">- Choose Type -</option>
					@foreach($drop_type as $drop)
					<option value="{{$drop->REPORT_TYPE_ID}}" @if($drop->REPORT_TYPE_ID == $REPORT->REPORT_TYPE_ID) selected @endif>{{$drop->REPORT_TYPE_NAME}}</option>
					@endforeach
				</select> 
			</div>
			<div class="col-lg-6">
				<label>
					Company Name:
				</label>
				<select class="form-control m-input" id="PROFILE_ID" name="PROFILE_ID" required="">
					<option value="">- Choose Company -</option>
					@foreach($drop_profile as $drop_profiles)
					<option value="{{$drop_profiles->PROFILE_ID}}" @if($drop_profiles->PROFILE_ID == $REPORT->PROFILE_ID) selected @endif>{{$drop_profiles->PROFILE_NPWP}} - {{$drop_profiles->PROFILE_COMPANY_NAME}}</option>
					@endforeach
				</select> 
			</div>								
		</div>

		<div class="form-group m-form__group row">
			<div class="col-lg-6">
				<label>
					Report Date:
				</label>
				<div class='input-group date' id='m_datepicker_2_modal'>
					<input type='text' class="form-control m-input" readonly id="REPORT_DATE" name="REPORT_DATE" value="{{$REPORT->REPORT_DATE_FORMAT}}" placeholder="Select date"/>
				</div>
			</div>
			<div class="col-lg-6">
				<label for="exampleInputEmail1">
					Report File: <small>(* zip, rar, 7z, pdf, doc, docx, xls, xlx, xlsx, jpg, jpeg, png)</small>
				</label>
				<span id="pertama">					
					<div class="input-group row">
						<div class="col-lg-10">
							<input class="form-control" style="width: 100%" type="text" name="NAME_FILE" value="{{$REPORT->REPORT_FILENAME}}" disabled="">&nbsp;						
						</div>
						<div class="col-lg-2">
							<span class="input-group-btn">
								<span class="btn btn-primary" id="ganti">
									Ganti
								</span>
							</span>
						</div>
					</div>
				</span>
				<span id="kedua">					
					<div class="input-group row">
						<div class="col-lg-10">
							<input type="file" class="input04 form-control" id="REPORT_PATH" name="REPORT_PATH">&nbsp;
							<span class="m-form__help">*Max Size File Upload 10 MB</span>						
						</div>
						<div class="col-lg-2">
							<span class="input-group-btn">
								<span class="btn btn-danger" id="batalganti">
									Batal
								</span>
							</span>
						</div>
					</div>

				</span>				
			</div>														
		</div>
	</div>
	<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
		<div class="m-form__actions m-form__actions--solid">
			<div class="row">
				<div class="col-lg-6">
					<button class="btn btn-primary" onclick="save_report(this.form.id);return false;">Save</button>
					<button onclick="cancel();return false;" class="btn btn-secondary">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!--end::Form-->

<script type="text/javascript">	

	$(document).ready(function () {

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

		$(":input").keyup(function () {
		    _validator($(this));
		});

		$(":input").blur(function () {
		    _validator($(this));
		});

		var file_ex = ["ZIP","RAR","7Z","PDF","JPG","JPEG","PNG","DOC","DOCX","XLS","XLX","XLSX","zip","rar","7z","pdf","jpg","jpeg","png","doc","docx","xls","xlx","xlsx"];
		$('#REPORT_PATH').bind('change', function (e) {
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
					swal('','Maaf, file Corporate Action harus zip, rar, 7z, pdf, doc, docx, xls, xlx, xlsx, jpg, jpeg atau png.','error');
					$(":file").filestyle('clear');
					return false;
				}
			}    
		});	

		$('#kedua').hide();		
	});

	$('#ganti').click(function(){		
		$('#kedua').show();
		$('#pertama').hide();
		$("#REPORT_PATH").prop('required',true);
	});

	$('#batalganti').click(function(){		
		$('#kedua').hide();		
		$(":file").filestyle('clear');		
		$('#pertama').show();
		$("#REPORT_PATH").prop('required',false);
	});

	function cancel()
	{
		call('management-report/list', '_content_', 'Report List');
	}
</script>
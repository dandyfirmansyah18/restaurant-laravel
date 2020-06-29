<!--begin::Form-->
<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_menu" data-validator="my_validator">	
	<input type="hidden" name="act" value="update">
	<input type="hidden" name="MENU_ID" value="{{$MENU->MENU_ID}}">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<div class="col-lg-6">
				<label>
					Menu Name:
				</label>				
				<input class="form-control m-input" placeholder="Enter Menu Name" type="text" name="MENU_NAME" value="{{$MENU->MENU_NAME}}" required="">
			</div>
			<div class="col-lg-6">
				<label>
					Menu Price:
				</label>									
				<input class="form-control m-input" placeholder="Enter Price Menu" type="text" name="PRICE" value="{{$MENU->PRICE}}">
			</div>
		</div>
		<div class="form-group m-form__group row">
			<div class="col-lg-6">
				<label for="">
					Kind Of Menu:
				</label>				
				<select class="form-control m-input" name="KIND_MENU_ID" id="KIND_MENU_ID">
					<option value="">- Choose Type -</option>
					@foreach($kom as $koms)
					<option value="{{$koms->KIND_MENU_ID}}" @if($koms->KIND_MENU_ID == $MENU->KIND_MENU_ID) selected @endif>{{$koms->KIND_MENU_NAME}}</option>
					@endforeach					
				</select>
			</div>	
			<div class="col-lg-6">
				<label for="exampleInputEmail1">
					Menu Photo: <small>(* jpg, jpeg, png)</small>
				</label>
				<span id="pertama">					
					<div class="input-group row">
						<div class="col-lg-10">
							<input class="form-control" style="width: 100%" type="text" name="NAME_FILE" value="{{str_replace('/files/MenuImage/','',$MENU->PHOTO)}}" disabled="">&nbsp;
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
							<input type="file" class="input04 form-control" id="PHOTO" name="PHOTO">&nbsp;
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
					<button class="btn btn-primary" onclick="save_menu(this.form.id);return false;">Save</button>
					<button onclick="cancel();return false;" class="btn btn-secondary">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!--end::Form-->

<script type="text/javascript">	

	$(document).ready(function () {				

		$('.input04').filestyle({
			htmlIcon : '<i class="fa fa-folder-open"></i>',
			text: ''
		});		

		$(":input").keyup(function () {
		    _validator($(this));
		});

		$(":input").blur(function () {
		    _validator($(this));
		});

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

		$('#kedua').hide();
	});

	$('#ganti').click(function(){		
		$('#kedua').show();
		$('#pertama').hide();
		$("#PHOTO").prop('required',true);
	});

	$('#batalganti').click(function(){		
		$('#kedua').hide();		
		$(":file").filestyle('clear');		
		$('#pertama').show();
		$("#PHOTO").prop('required',false);
	});

	function cancel()
	{
		call('management-master/list/menu', '_content_', 'Master Menu');
	}
</script>
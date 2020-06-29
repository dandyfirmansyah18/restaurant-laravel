<!--begin::Form-->
<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_kpm" data-validator="my_validator">	
	<input type="hidden" name="act" value="update">
	<input type="hidden" name="KIND_MENU_ID" value="{{$KIND_MENU->KIND_MENU_ID}}">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">			
			<div class="col-lg-12">
				<label>
					Kind Of Menu Name:
				</label>				
				<input class="form-control m-input" placeholder="Enter Kind Of Menu Name" type="text" value="{{$KIND_MENU->KIND_MENU_NAME}}" name="KIND_MENU_NAME" required="">
			</div>
		</div>
	</div>
	<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
		<div class="m-form__actions m-form__actions--solid">
			<div class="row">
				<div class="col-lg-6">
					<button class="btn btn-primary" onclick="save_kom(this.form.id);return false;">Save</button>
					<button onclick="cancel();return false;" class="btn btn-secondary">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!--end::Form-->

<script type="text/javascript">
	$(document).ready(function () {
		
		$(":input").keyup(function () {
		    _validator($(this));
		});

		$(":input").blur(function () {
		    _validator($(this));
		});
			
	});

	function cancel()
	{
		call('management-master/list/kom', '_content_', 'Kind Of Menu');
	}
</script>
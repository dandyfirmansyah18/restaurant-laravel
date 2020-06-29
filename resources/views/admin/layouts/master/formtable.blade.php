<!--begin::Form-->
<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_news" data-validator="my_validator">	
	<input type="hidden" name="act" value="update">
	<input type="hidden" name="TABLE_ID" value="{{$TABLE->TABLE_ID}}">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<div class="col-lg-6">
				<label>
					Table Number:
				</label>				
				<input class="form-control m-input" placeholder="Enter Table Number" type="text" name="TABLE_NO" value="{{$TABLE->TABLE_NO}}" required="">
			</div>
			<div class="col-lg-6">
				<label>
					Table People Max:
				</label>				
				<input class="form-control m-input" placeholder="Enter Table People Max" type="text" name="TABLE_PEOPLE_MAX" value="{{$TABLE->TABLE_PEOPLE_MAX}}" required="">
			</div>			
		</div>	
	</div>
	<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
		<div class="m-form__actions m-form__actions--solid">
			<div class="row">
				<div class="col-lg-6">
					<button class="btn btn-primary" onclick="save_table(this.form.id);return false;">Save</button>
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
		
	});

	function cancel()
	{
		call('management-master/list/table', '_content_', 'Master Table');
	}
</script>
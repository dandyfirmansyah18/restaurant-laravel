<div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair">
	<div class="m-portlet__body">
		<div class="contactus_sender">
			<h5 style="margin-bottom: 0">
				{{$CONTACT_US->CONTACT_US_NAME}}
			</h5>
			<div class="row">
				<div class="col-lg-6">
					<small>{{$CONTACT_US->CONTACT_US_EMAIL}}</small>
				</div>
				<div class="col-lg-6">
					<small class="pull-right">{{ date('d-m-Y H:i:s', strtotime($CONTACT_US->CREATED_AT)) }}</small>
				</div>
			</div>
		</div>
		<div class="contactus_body">
			<p>{{$CONTACT_US->CONTACT_US_TEXT}}</p>
		</div>

		<!--begin::Form-->
		<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="contactus_reply" data-validator="my_validator">	
			<input type="hidden" name="act" value="update">
			<input type="hidden" name="CONTACT_US_ID" value="{{$CONTACT_US->CONTACT_US_ID}}">
			<label>
				Reply Message:
			</label>
			<textarea class="form-control m-input" name="CONTACT_US_REPLY" id="CONTACT_US_REPLY" rows="5" required=""></textarea> 
			
			<div class="contactus_btn">
				<button class="btn btn-primary" onclick="reply(this.form.id);return false;">Send</button>
				<button onclick="cancel();return false;" class="btn btn-secondary">Cancel</button>
			</div>
		</form>
		<!--end::Form-->
		
	</div>
</div>

<script type="text/javascript">	

	function reply(formid)
	{
		validation = my_validator(formid);
		if(validation.fail)
		{
			swal("", "Isian Form belum lengkap.", "error");
			return false;
		}
		var dataSend = $('#'+formid).serialize();

		$.ajax({
			type: 'GET',
			url: 'management-contactus/reply',
			data: dataSend,
			success: function(data){
				var isiMsg = '';
                var arrdata = data.split('#');

                if (arrdata[0].trim()==='MSG')
                {
                    if (arrdata[1] === 'OK') {
                        isiMsg = arrdata[2];
                        swal("", isiMsg, "success");
                        $('#btn_new_user').click();
                        document.getElementById(formid).reset();

                        var id = $('#'+formid).find('input[name=CONTACT_US_ID]').val();
                        view(id);
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

	function cancel()
	{
		call('management-contactus/list', '_content_', 'Contact Us List');
	}
</script>
    <!-- BEGIN: Subheader -->
    <!-- <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">My Profile</h3>
            </div>
        </div>
    </div> -->
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="m-portlet m-portlet--full-height  ">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            <div class="m-card-profile__title m--hide">
                                Your Profile
                            </div>
                            <div class="m-card-profile__pic">
                                <div class="m-card-profile__pic-wrapper">
                                    <img src="images/user.png" alt="">
                                </div>
                            </div>
                            <div class="m-card-profile__details">
                                <span class="m-card-profile__name">{{ $USER->USER_NAME }}</span>
                                <a href="" class="m-card-profile__email m-link">{{ $USER->USER_EMAIL }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="m-portlet m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                        Account Details
                                    </a>
                                </li>
                                @if($PROFILE)
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
										Company Profile
									</a>
                                </li>
                                @endif
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
										Change Password
									</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_user_profile_tab_1">
                            <form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_user">
                            	<input type="hidden" name="act" value="update">
								<input type="hidden" name="type" value="user">
								<input type="hidden" name="user_id" value="{{ $USER->USER_ID }}">
								<input type="hidden" name="role_id" value="{{ $USER->USER_ROLE_ID }}">
                                <div class="m-portlet__body">

                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Name</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="name" value="{{ $USER->USER_NAME }}" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Email</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="email" id="email" name="email" value="{{ $USER->USER_EMAIL }}" required="" onchange="checkEmailifExist(this.form.id, this.value);">
                                        </div>
                                    </div>

                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-7">
                                                <button class="btn btn-accent m-btn m-btn--air m-btn--custom" onclick="save_user(this.form.id);return false;">Save changes</button>&nbsp;&nbsp;
                                                <!-- <button class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if($PROFILE)
                        <div class="tab-pane " id="m_user_profile_tab_2">
                        	<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_profile">
                        		<input type="hidden" name="act" value="update">
								<input type="hidden" name="type" value="profile">
								<input type="hidden" name="user_id" value="{{ $USER->USER_ID }}">
								<input type="hidden" name="profile_id" value="{{ $USER->PROFILE_ID }}">
                                <div class="m-portlet__body">
                                	<!-- <div class="m-form__heading">
										<h3 class="m-form__heading-title">Company Details</h3>
									</div> -->
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Kode Emiten</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" id="emiten_code" name="emiten_code" value="{{ $PROFILE->PROFILE_KODE_EMITEN }}" required="" maxlength="4">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">NPWP</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" id="npwp" name="npwp" value="{{ $PROFILE->PROFILE_NPWP }}" required="" maxlength="15" onfocus="unFormatNPWP(this.id)" onblur="FormatNPWP(this.id)">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Nama Perusahaan</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="company_name" id="company_name" value="{{ $PROFILE->PROFILE_COMPANY_NAME }}" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Gedung</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="building" value="{{ $PROFILE->PROFILE_BUILDING }}" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Alamat</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="address" value="{{ $PROFILE->PROFILE_ADDRESS }}" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Propinsi</label>
                                        <div class="col-7">
                                            <select class="form-control m-input" id="state" name="state" required="">
												<option value="">- Pilih -</option>
												@foreach($STATE as $PROP)
													@if($PROP->STATE_ID == $PROFILE->PROFILE_STATE)
														<option selected value="{{ $PROP->STATE_ID }}">{{ $PROP->STATE_NAME }}</option>
													@else
														<option value="{{ $PROP->STATE_ID }}">{{ $PROP->STATE_NAME }}</option>
													@endif
												@endforeach
											</select>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Kab/Kota</label>
                                        <div class="col-7">
                                            <select class="form-control m-input" id="city" name="city" required="">
												<option value="">- Pilih -</option>
												@foreach($CITY as $KOTA)
													@if($KOTA->CITY_ID == $PROFILE->PROFILE_CITY)
														<option selected value="{{ $KOTA->CITY_ID }}">{{ $KOTA->CITY_NAME }}</option>
													@else
														<option value="{{ $KOTA->CITY_ID }}">{{ $KOTA->CITY_NAME }}</option>
													@endif
												@endforeach
											</select>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Kecamatan</label>
                                        <div class="col-7">
                                            <select class="form-control m-input" id="district" name="district" required="">
												<option value="">- Pilih -</option>
												@foreach($DISTRICT as $KEC)
													@if($KEC->DISTRICT_ID == $PROFILE->PROFILE_DISTRICT)
														<option selected value="{{ $KEC->DISTRICT_ID }}">{{ $KEC->DISTRICT_NAME }}</option>
													@else
														<option value="{{ $KEC->DISTRICT_ID }}">{{ $KEC->DISTRICT_NAME }}</option>
													@endif
												@endforeach
											</select>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Kelurahan</label>
                                        <div class="col-7">
                                            <select class="form-control m-input" id="sub_district" name="sub_district" required="">
												<option value="">- Pilih -</option>
												@foreach($SUB_DISTRICT as $KEL)
													@if($KEL->SUB_DISTRICT_ID == $PROFILE->PROFILE_SUB_DISTRICT)
														<option selected value="{{ $KEL->SUB_DISTRICT_ID }}">{{ $KEL->SUB_DISTRICT_NAME }}</option>
													@else
														<option value="{{ $KEL->SUB_DISTRICT_ID }}">{{ $KEL->SUB_DISTRICT_NAME }}</option>
													@endif
												@endforeach
											</select>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Kode Pos</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="post_code" value="{{ $PROFILE->PROFILE_POST_CODE }}" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Website</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="website" id="website" value="{{ $PROFILE->PROFILE_WEBSITE }}" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Email</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="company_email" id="company_email" value="{{ $PROFILE->PROFILE_EMAIL }}" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Telepon</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="phone" value="{{ $PROFILE->PROFILE_PHONE }}" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Fax</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="fax" value="{{ $PROFILE->PROFILE_FAX }}" required="">
                                        </div>
                                    </div>

									<div class="m-separator m-separator--dashed m-separator--lg"></div>
									<div class="m-form__heading">
										<h3 class="m-form__heading-title">PIC Information</h3>
									</div>

									<div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Nama PIC</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="pic_name" value="{{ $PROFILE->PROFILE_PIC }}" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Email PIC</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="pic_email" value="{{ $PROFILE->PROFILE_PIC_EMAIL }}" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Telepon PIC</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="pic_phone" value="{{ $PROFILE->PROFILE_PIC_PHONE }}" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Mobile Phone PIC</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="pic_mobile" value="{{ $PROFILE->PROFILE_PIC_MOBILE }}" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-7">
                                                <button class="btn btn-accent m-btn m-btn--air m-btn--custom" onclick="save_user(this.form.id);return false;">Save changes</button>&nbsp;&nbsp;
                                                <!-- <button class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                        <div class="tab-pane " id="m_user_profile_tab_3">
                        	<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_password">
                        		<input type="hidden" name="act" value="update">
								<input type="hidden" name="type" value="password">
								<input type="hidden" name="user_id" value="{{ $USER->USER_ID }}">
                                <div class="m-portlet__body">

                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Old Password</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="password" name="old_password" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">New Password</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="password" name="password" required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Confirm Password</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="password" name="c_password" required="">
                                        </div>
                                    </div>

                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-7">
                                                <button class="btn btn-accent m-btn m-btn--air m-btn--custom" onclick="change_password(this.form.id);return false;">Save changes</button>&nbsp;&nbsp;
                                                <!-- <button class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    @if(Auth::user()->USER_ROLE_ID == 2 || Auth::user()->USER_ROLE_ID == 21)
    FormatNPWP('npwp');
    $('#emiten_code').prop('readonly', true);
    $('#npwp').prop('readonly', true);
    $('#company_name').prop('readonly', true);
    $('#website').prop('readonly', true);
    $('#company_email').prop('readonly', true);
    $('#email').prop('readonly', true);
    @endif

	$(":input").keyup(function () {
	    _validator($(this));
	});

	$(":input").blur(function () {
	    _validator($(this));
	});

	function save_user(formid)
	{
		validation = my_validator(formid);
		if(validation.fail)
		{
			swal("", "Isian Form belum lengkap", "error")
			return false;
		}

		var form = $('#'+formid);
		var datasend = form.serialize();

		$.ajax({
			type: 'POST',
            url: 'management-user/save',
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
                        $('#btn_new_user').click();
                        document.getElementById(formid).reset();

                        var act = $('#'+formid).find('input[name=act]').val();
                        call('profile', '_content_', 'My Profile');
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

	function change_password(formid)
	{
		validation = my_validator(formid);
		if(validation.fail)
		{
			swal("", "Isian Form belum lengkap", "error")
			return false;
		}

		var form = $('#'+formid);
		var datasend = form.serialize();

		$.ajax({
			type: 'POST',
            url: 'management-user/changepassword',
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
                        $('#btn_new_user').click();
                        document.getElementById(formid).reset();

                        var act = $('#'+formid).find('input[name=act]').val();
                        call('profile', '_content_', 'My Profile');
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

	$('#state').change(function(){
		var state_id = $(this).val();
		$.ajax({
			type: 'GET',
			data: {type:'city', id:state_id},
			url: '/reference/address',
			success: function(data){
				$('#city').html('<option value="">- Pilih -</option>');
				$('#district').html('<option value="">- Pilih -</option>');
				$('#sub_district').html('<option value="">- Pilih -</option>');
				
				var htmldata = '<option value="">- Pilih -</option>';
				$.each(data, function(key, val){
					htmldata += '<option value="'+val.CITY_ID+'">'+val.CITY_NAME+'</option>'
				});

				$('#city').html(htmldata);
			}
		})
	});

	$('#city').change(function(){
		var state_id = $(this).val();
		$.ajax({
			type: 'GET',
			data: {type:'district', id:state_id},
			url: '/reference/address',
			success: function(data){
				$('#district').html('<option value="">- Pilih -</option>');
				
				var htmldata = '<option value="">- Pilih -</option>';
				$.each(data, function(key, val){
					htmldata += '<option value="'+val.DISTRICT_ID+'">'+val.DISTRICT_NAME+'</option>'
				});

				$('#district').html(htmldata);
			}
		})
	});

	$('#district').change(function(){
		var state_id = $(this).val();
		$.ajax({
			type: 'GET',
			data: {type:'subdistrict', id:state_id},
			url: '/reference/address',
			success: function(data){
				$('#sub_district').html('<option value="">- Pilih -</option>');
				
				var htmldata = '<option value="">- Pilih -</option>';
				$.each(data, function(key, val){
					htmldata += '<option value="'+val.SUB_DISTRICT_ID+'">'+val.SUB_DISTRICT_NAME+'</option>'
				});

				$('#sub_district').html(htmldata);
			}
		})
	});
</script>
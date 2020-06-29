			<div class="row">
				<div class="col-lg-6">
					<div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair">
						<!--begin::Form-->
						<form class="m-form m-form--state" id="form_edit_user">
							<input type="hidden" name="act" value="update">
							<input type="hidden" name="type" value="user">
							<input type="hidden" name="user_id" value="{{ $USER->USER_ID }}">
							<input type="hidden" name="role_id" value="{{ $USER->USER_ROLE_ID }}">
							<div class="m-portlet__body">
								<div class="m-form__heading">
									<h3 class="m-form__heading-title">Account Details</h3>
								</div>
								<div class="m-form__section m-form__section--first">
									<div class="form-group m-form__group">
										<label>
											Name:
										</label>
										<input class="form-control m-input" placeholder="Enter full name" type="text" name="name" value="{{ $USER->USER_NAME }}" required="">
									</div>
									<div class="form-group m-form__group">
										<label class="">
											Email:
										</label>
										<input class="form-control m-input" placeholder="Enter email address" type="email" name="email" value="{{ $USER->USER_EMAIL }}" required="" onchange="checkEmailifExist(this.form.id, this.value);">
									</div>
					            </div>
				            </div>
				            <div class="m-portlet__foot m-portlet__foot--fit">
								<div class="m-form__actions m-form__actions--solid">
									<button class="btn btn-primary" onclick="save_user_emiten(this.form.id);return false;">Save</button>
									<button onclick="cancel_emiten();return false;" class="btn btn-secondary">Cancel</button>
								</div>
							</div>
						</form>
						<!--end::Form-->
					</div>
				</div>

				<div class="col-lg-6">
					<div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair">
						<!--begin::Form-->
						<form class="m-form m-form--state" id="form_password">
							<input type="hidden" name="act" value="update">
							<input type="hidden" name="type" value="password">
							<input type="hidden" name="user_id" value="{{ $USER->USER_ID }}">
							<div class="m-portlet__body">
								<div class="m-form__heading">
									<h3 class="m-form__heading-title">Change Password</h3>
								</div>
								<div class="m-form__section m-form__section--first">
									<div class="form-group m-form__group">
										<label>
											New Password:
										</label>
										<input class="form-control m-input" placeholder="" type="password" name="password" value="" required="">
									</div>
									<div class="form-group m-form__group">
										<label class="">
											Confirm Password:
										</label>
										<input class="form-control m-input" placeholder="" type="password" name="c_password" value="" required="">
									</div>
					            </div>
				            </div>
				            <div class="m-portlet__foot m-portlet__foot--fit">
								<div class="m-form__actions m-form__actions--solid">
									<button class="btn btn-primary" onclick="save_user_emiten(this.form.id);return false;">Save</button>
									<button onclick="cancel_emiten();return false;" class="btn btn-secondary">Cancel</button>
								</div>
							</div>
						</form>
						<!--end::Form-->
					</div>
				</div>
			</div>
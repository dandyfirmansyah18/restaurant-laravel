<!-- BEGIN: Subheader -->
<!-- <div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Management Company Profile
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
						Management Company Profile						
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body" id="_content_body_">

			<div id="div_form_comprof">
				<div class="m-portlet m-portlet--bordered m-portlet--unair">					
					<!--begin::Form-->
					<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_comprof" data-validator="my_validator">
						<input type="hidden" name="role_id" value="3">
						<input type="hidden" name="ARTICLE_ID" value="{{ isset($COMPROF->ARTICLE_ID) ? $COMPROF->ARTICLE_ID : '' }}">
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<div class="col-lg-12">
									<label>
										Company Profile Title:
									</label>				
									<input class="form-control m-input" placeholder="Enter Company Profile Title" type="text" value="{{ isset($COMPROF->ARTICLE_TITLE) ? $COMPROF->ARTICLE_TITLE : '' }}" name="ARTICLE_TITLE" required="">
								</div>								
							</div>

							<div class="form-group m-form__group row">
								<div class="col-lg-12">
									<label>
										Company Profile Prolog:
									</label>
									<textarea class="form-control m-input" placeholder="Enter Company Profile Prolog" type="text" name="ARTICLE_PROLOG" required="">{{ isset($COMPROF->ARTICLE_PROLOG) ? $COMPROF->ARTICLE_PROLOG : '' }}</textarea> 
								</div>								
							</div>

							<div class="form-group m-form__group row">
								<div class="col-lg-12">
									<label>
										Company Profile Content:
									</label>
									<textarea placeholder="Enter Company Profile Content" type="text" name="ARTICLE_TEXT" id="ARTICLE_TEXT" required="">{{ isset($COMPROF->ARTICLE_TEXT) ? $COMPROF->ARTICLE_TEXT : '' }}</textarea> 
								</div>								
							</div>
						</div>
						<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
							<div class="m-form__actions m-form__actions--solid">
								<div class="row">
									<div class="col-lg-6">
										<button class="btn btn-primary" onclick="save_comprof(this.form.id);return false;">Save</button>					
									</div>
								</div>
							</div>
						</div>
					</form>
					<!--end::Form-->
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		
		CKEDITOR.replace( 'ARTICLE_TEXT', {
			toolbarGroups: [
				{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
				{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
				{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
				{ name: 'forms', groups: [ 'forms' ] },				
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
				{ name: 'links', groups: [ 'links' ] },
				{ name: 'insert', groups: [ 'insert' ] },
				'/',
				{ name: 'styles', groups: [ 'styles' ] },
				{ name: 'colors', groups: [ 'colors' ] },
				{ name: 'tools', groups: [ 'tools' ] },
				{ name: 'others', groups: [ 'others' ] },
				{ name: 'about', groups: [ 'about' ] }
			],
			removeDialogTabs: 'image:advanced;link:advanced',
			filebrowserBrowseUrl: 'http://localhost:8000/fileupload.php',
			filebrowserUploadUrl: 'http://localhost:8000/fileupload.php',			

			// Add plugins
			extraPlugins:  'filebrowser,uploadfile',
			removeButtons: 'Source,Save,NewPage,Preview,Print,Templates,PasteFromWord,PasteText,Replace,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,CreateDiv,Language,Anchor,Flash,PageBreak,Iframe,BGColor,ShowBlocks,About'

			// NOTE: Remember to leave 'toolbar' property with the default value (null).
		}); 
	});	

	$(":input").keyup(function () {
	    _validator($(this));
	});

	$(":input").blur(function () {
	    _validator($(this));
	});

	function save_comprof(formid)
	{	
		var ARTICLE_CONTENT = CKEDITOR.instances.ARTICLE_TEXT.getData();
		validation = my_validator(formid);
		if(validation.fail)
		{
			swal("", "Isian Form belum lengkap.", "error");
			return false;
		}

		var form = $('#'+formid);
		var datasend = form.serializeArray();

		// var data = $(this).serializeArray(); // convert form to array
		datasend.push({name: "ARTICLE_CONTENT", value: ARTICLE_CONTENT});		

		$.ajax({
			type: 'POST',
            url: 'management-comprof/save',
            data: $.param(datasend),
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
                        call('management-comprof/view','_content_','Company Profile');     
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
</script>
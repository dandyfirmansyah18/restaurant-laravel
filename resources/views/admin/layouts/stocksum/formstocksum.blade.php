<!--begin::Form-->
<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="form_kpm" data-validator="my_validator">	
	<input type="hidden" name="act" value="update">
	<input type="hidden" name="ARTICLE_ID" value="{{$KPM->ARTICLE_ID}}">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<div class="col-lg-12">
				<label>
					Kegiatan Pasar Modal Title:
				</label>				
				<input class="form-control m-input" placeholder="Enter Kegiatan Pasar Modal Title" type="text" value="{{$KPM->ARTICLE_TITLE}}" name="ARTICLE_TITLE" required="">
			</div>								
		</div>

		<div class="form-group m-form__group row">				
			<div class="col-lg-6">
				<label class="">
					Kegiatan Pasar Modal Highlight:
				</label>
				<select class="form-control m-input" name="ARTICLE_HIGHLIGHT" required="">
					<option value="">- Choose Highlight -</option>
					<option value="1" @if($KPM->ARTICLE_HIGHLIGHT == '1') selected @endif>Active</option>
					<option value="0" @if($KPM->ARTICLE_HIGHLIGHT == '0') selected @endif>Non Active</option>					
				</select> 
			</div>
			<div class="col-lg-6">
				<label class="">
					Kegiatan Pasar Modal Status:
				</label>
				<select class="form-control m-input" name="ARTICLE_STATUS" required="">
					<option value="">- Choose Status -</option>
					<option value="1" @if($KPM->ARTICLE_STATUS == '1') selected @endif>Active</option>
					<option value="0" @if($KPM->ARTICLE_STATUS == '0') selected @endif>Non Active</option>
				</select> 
			</div>
		</div>

		<div class="form-group m-form__group row">
			<div class="col-lg-12">
				<label>
					Kegiatan Pasar Modal Prolog:
				</label>
				<textarea class="form-control m-input" placeholder="Enter Kegiatan Pasar Modal Prolog" type="text" name="ARTICLE_PROLOG" required="">{{$KPM->ARTICLE_PROLOG}}</textarea> 
			</div>								
		</div>

		<div class="form-group m-form__group row">
			<div class="col-lg-12">
				<label>
					Kegiatan Pasar Modal Content:
				</label>
				<textarea placeholder="Enter Kegiatan Pasar Modal Content" type="text" name="ARTICLE_TEXT" id="ARTICLE_TEXT" required="">{{$KPM->ARTICLE_TEXT}}</textarea> 
			</div>								
		</div>
	</div>
	<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
		<div class="m-form__actions m-form__actions--solid">
			<div class="row">
				<div class="col-lg-6">
					<button class="btn btn-primary" onclick="save_kpm(this.form.id);return false;">Save</button>
					<button onclick="cancel();return false;" class="btn btn-secondary">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!--end::Form-->

<script type="text/javascript">
	$(document).ready(function () {

		// $('#ARTICLE_DATE').datepicker({
		//     format: 'dd-mm-yyyy',		    
	 //    	autoclose: true
		// });
	
		
		$(":input").keyup(function () {
		    _validator($(this));
		});

		$(":input").blur(function () {
		    _validator($(this));
		});
	
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
			filebrowserBrowseUrl: '/fileupload.php',
			filebrowserUploadUrl: '/fileupload.php',			

			// Add plugins
			extraPlugins:  'filebrowser,uploadfile',
			removeButtons: 'Source,Save,NewPage,Print,Templates,PasteFromWord,PasteText,Replace,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,CreateDiv,Language,Anchor,Flash,PageBreak,Iframe,BGColor,ShowBlocks,About'

			// NOTE: Remember to leave 'toolbar' property with the default value (null).
		}); 
	});

	function cancel()
	{
		call('management-kpm/list', '_content_', 'Kegiatan Pasar Modal List');
	}
</script>
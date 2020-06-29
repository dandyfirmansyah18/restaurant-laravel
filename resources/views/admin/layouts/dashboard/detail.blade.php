
<div class="m-content">
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						{{ $title }}
						<small>
						</small>
					</h3>
				</div>
			</div>
		</div>

		<div class="m-portlet__body" id="_content_body_">
			<!--begin: Search Form -->
			<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
				<div class="row align-items-center">
					<div class="col-xl-8 order-2 order-xl-1">
						<div class="form-group m-form__group row align-items-center active" id="custom_search">
							<div class="col-md-4">
								<div class="m-input-icon m-input-icon--left">
									<input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
									<span class="m-input-icon__icon m-input-icon__icon--left">
										<span>
											<i class="la la-search"></i>
										</span>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end: Search Form -->
			<!--begin: Datatable -->
			<div class="m_datatable" id="m_datatable_emiten_islogin"></div>
			<!--end: Datatable -->
		</div>
	</div>
</div>


<script type="text/javascript">
	
	$(document).ready(function () {

		var columndata = [];
		@foreach($datatable as $data)
			columndata.push({
				field : '{{ $data["field"] }}',
				title : '{{ $data["title"] }}',
			});
		@endforeach

		$('#m_datatable_emiten_islogin').mDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/dashboard/list/{{ $type }}',
                        method: 'GET'
                    }
                },
                pageSize: 5,
                saveState: {
                    cookie: false,
                    webstorage: false
                },
                serverPaging: false,
                serverFiltering: false,
                serverSorting: false
            },

            layout: {
                theme: 'default',
                class: '',
                scroll: false,
                // height: 300,
                footer: false
            },

            sortable: true,

            filterable: false,

            pagination: false,

            columns: columndata
        });
	});

</script>
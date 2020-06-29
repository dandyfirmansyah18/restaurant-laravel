<!-- BEGIN: Subheader -->
<!-- <div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Management Report
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
						Management Stock Summary
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
							@if(Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21)
							<div class="col-md-6">
								<div class="m-form__group m-form__group--inline" style="width: 100%">
									<div class="m-form__control">
										<select class="form-control m-input" id="emiten" name="emiten">
											<option value="">- Choose Emiten -</option>
											@foreach($emiten_list as $data)
											<option value="{{$data->TX_STOCK_SUM_STOCK_CODE}}" @if($data->TX_STOCK_SUM_STOCK_CODE == $emiten) selected @endif>{{$data->TX_STOCK_SUM_STOCK_CODE}} - {{$data->TX_STOCK_SUM_STOCK_NAME}}</option>											
											@endforeach
										</select> 
									</div>
								</div>
								<div class="d-md-none m--margin-bottom-10"></div>
							</div>
							@endif
							<div class="col-md-3">
								<div class="m-form__group m-form__group--inline" style="width: 100%">									
									<div class="m-form__control">
										<input type="hidden" name="kode_emiten_for_emiten" value="{{$emiten}}" id="kode_emiten_for_emiten">
										<input type="text" class="form-control m-input" id="periode" value="{{$periode}}" readonly placeholder="Select period" type="text"/>
									</div>
								</div>
								<div class="d-md-none m--margin-bottom-10"></div>
							</div>
							<div class="col-md-3">
								<div class="m-input-icon m-input-icon--left">
									<input type="text" class="form-control m-input" placeholder="General Search..." id="generalSearch">
									<span class="m-input-icon__icon m-input-icon__icon--left">
										<span>
											<i class="la la-search"></i>
										</span>
									</span>
								</div>
							</div>							
						</div>

						<div class="form-group m-form__group row align-items-center active" id="custom_button">							
							<div class="col-md-2">
								<div class="m-form__group m-form__group--inline">
									<div class="m-form__control">
										<span style="margin-right: 10px; width: 100%;" class="btn btn-success" onclick="searchperiode()">Search</span>
									</div>
								</div>
								<div class="d-md-none m--margin-bottom-10"></div>
							</div>
							<div class="col-md-2">
								<div class="m-form__group m-form__group--inline">
									<div class="m-form__control">
										<span style="width: 100%" class="btn btn-info dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Generate
										</span>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item" onclick="generate('pdf-dalam')">
												PDF
											</a>
											<a class="dropdown-item" onclick="generate('excel-dalam')">
												Excel
											</a>											
										</div>
									</div>
								</div>
								<div class="d-md-none m--margin-bottom-10"></div>
							</div>							
						</div>

					</div>	
					@if(Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21)				
					<div class="col-xl-4 order-1 order-xl-2 m--align-right">
						<a href="#" id="btn_new_stocksum" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" data-toggle="collapse" data-target="#div_form_stocksum">
							<span>
								<i class="la la-cart-plus"></i>
								<span id="btn_new_stocksum_caption">
									Add Stock Summary
								</span>
							</span>
						</a>

						<div class="m-separator m-separator--dashed d-xl-none"></div>
					</div>
					@endif
				</div>
			</div>
			<!--end: Search Form -->
			<div id="div_form_stocksum" class="collapse">
				<div class="m-portlet m-portlet--bordered m-portlet--unair">
					<div class="m-portlet__head" style="background-color: #f7f8fa">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon">
									<i class="la la-user-plus"></i>
								</span>
								<h3 class="m-portlet__head-text">
									New Data Stock Summary
								</h3>
							</div>			
						</div>
					</div>
					<!--begin::Form-->
					<form class="m-form m-form--state m-form--fit m-form--label-align-right" name="form_report" id="form_report" data-validator="my_validator">		
						<div class="m-portlet__body">																				
							<div class="form-group m-form__group row">
								<div class="col-lg-6">
									<label for="">
										Stock Summary Date:
									</label>									
									<input type="text" class="form-control m-input" name="DATESTOCKSUM" id="DATESTOCKSUM" placeholder="Select Stock Summary Date">
								</div>

								<div class="col-lg-6">
									<label for="">
										Stock Summary File: <small><span id="caption_filetype">(* xlx atau xlsx)</span></small>
									</label>
									<input type="hidden" class="form-control m-input" name="act" value="insert" />
									<input type="file" class="input04" id="FILESTOCKSUM" name="FILESTOCKSUM">
									<span class="m-form__help">*Max Size File Upload 10 MB</span><br>
								</div>
							</div>
						</div>
						<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
							<div class="m-form__actions m-form__actions--solid">
								<div class="row">
									<div class="col-lg-6">
										<button class="btn btn-primary" onclick="save_stocksum(this.form.id);return false;">Save</button>
										<button type="reset" onclick="$('#btn_new_stocksum').click();" class="btn btn-secondary">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<!--end::Form-->
				</div>
			</div>
<!--begin: Selected Rows Group Action Form -->
			<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30 collapse" id="m_datatable_group_action_form">
				<div class="row align-items-center">
					<div class="col-xl-12">
						<div class="m-form__group m-form__group--inline">
							<div class="m-form__label m-form__label-no-wrap">
								<label class="m--font-bold m--font-danger-">
									Selected
									<span id="m_datatable_selected_number"></span>
									records:
								</label>
							</div>
							<div class="m-form__control">
								<div class="btn-toolbar">
									<!-- <div class="dropdown">
										<button type="button" class="btn btn-accent btn-sm dropdown-toggle" data-toggle="dropdown">
											Update status
										</button>
										<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
											<a class="dropdown-item" href="#">
												Pending
											</a>
											<a class="dropdown-item" href="#">
												Delivered
											</a>
											<a class="dropdown-item" href="#">
												Canceled
											</a>
										</div>
									</div> -->
									&nbsp;&nbsp;&nbsp;
									<span class="btn btn-sm btn-danger" type="button" id="m_datatable_check_all">
										Delete
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end: Selected Rows Group Action Form -->
			<!--begin: Datatable -->
			<div class="m_datatable" id="record_selection"></div>
			<!--end: Datatable -->
			<div class="m_chart">				
				<div class="row"  id="chartarea" style="margin-top: 40px;display: none;">
		          <div class="col-md-6">
		            <div class="col-md-12" id="stocksummary_area1" style="border: 1px solid #bbb; padding: 20px 5px">
		              <canvas id="stockSummary1"></canvas>
		            </div>
		          </div>
		          <div class="col-md-6">
		            <div class="col-md-12" id="stocksummary_area2" style="border: 1px solid #bbb; padding: 20px 5px">
		              <canvas id="stockSummary2"></canvas>
		            </div>
		          </div>
		        </div>
		        <div class="row" id="chartarea2" style="margin-top: 40px;display: none;">
		          <div class="col-md-12" id="stocksummary_area3">
		            <canvas id="stockSummary3"></canvas>
		          </div>
		          <div class="col-md-12" id="stocksummary_area4">
		            <canvas id="stockSummary4"></canvas>
		          </div>
		        </div>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">

	jQuery(document).ready(function() {  			

		$('#DATESTOCKSUM').datepicker({
		    format: 'dd-mm-yyyy',		    
        	autoclose: true
		});

		$('#DATESTOCKSUM').datepicker().datepicker("setDate", new Date());

		$('.input04').filestyle({
			htmlIcon : '<i class="fa fa-folder-open"></i>',
			text: ''
		});

		$("#emiten").select2({
			width:'100%'
		});
		
		$('#periode').datepicker({
			autoclose: true,
		    format: "MM-yyyy",
		    startView: "months",
		    minViewMode: "months"
			// format: 'dd-mm-yyyy',			
		});

		drawChart();		
	});

	$('#btn_new_stocksum').click(function(){		
		if($('#custom_search').hasClass('active'))
		{
			$('#custom_search').hide().removeClass('active');
			$('#custom_button').hide().removeClass('active');
			$('.m_datatable').hide();
			$('.m_chart').hide();
			$('#btn_new_stocksum_caption').html('Close');
			$('#act').val('insert');

		}
		else
		{
			$('#custom_search').show().addClass('active');
			$('#custom_button').show().addClass('active');
			$('.m_datatable').show();
			$('.m_chart').show();
			$('#btn_new_stocksum_caption').html('Add Stock Summary');
			$('#act').val('');
		}
	});

	$(":input").keyup(function () {
	    _validator($(this));
	});

	$(":input").blur(function () {
	    _validator($(this));
	});

	$('#FILESTOCKSUM').bind('change', function (e) {
		var file_ex = ["XLS","XLX","XLSX","xlx","xlsx","xls"];		

		if (document.getElementById("FILESTOCKSUM").files.length > 0) {
			var FILESTOCKSUM = document.getElementById('FILESTOCKSUM'); 
			FILESTOCKSUM = FILESTOCKSUM.files[0]['name'];
			FILESTOCKSUM = FILESTOCKSUM.split('.').pop();
			if ($.inArray(FILESTOCKSUM, file_ex) != -1)
			{
				if (this.files[0].size > 10485760) {
					swal('','Maaf, upload max size 10 MB','error');
					$(":file").filestyle('clear');
					return false;		
				}
			}else{				
				swal('','Maaf, file Report harus xls, xlx atau xlsx.','error');				
				$(":file").filestyle('clear');
				return false;
			}
		}    		
	});		


	function save_stocksum(formid)
	{		
		validation = my_validator(formid);
		if(validation.fail)
		{
			swal("", "Isian Form belum lengkap.", "error");
			return false;
		}

		var form = $('#'+formid);
		var datasend = new FormData(form[0]);					

		$.ajax({
			type: 'POST',
            url: 'management-stocksum/save',
            data: datasend,
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    timeout: 1200000,
            processData: false,
            contentType: false,
		    success: function(data){
                var isiMsg = '';
                var arrdata = data.split('#');
                if (arrdata[0].trim()==='MSG')
                {
                    if (arrdata[1] === 'OK') {
                        isiMsg = arrdata[2];
                        swal("", isiMsg, "success");
                        $('#btn_new_stocksum').click();
                        document.getElementById(formid).reset();
                        call('management-stocksum/list','_content_','Stock Summary List')
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

		});	
	}

	function searchperiode()
	{
		var periode = $('#periode').val();		
		@if(Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21)
			var emiten = $('#emiten').val();
			if (periode == '' || periode == null || periode == undefined || emiten == '' || emiten == null || emiten == undefined) {
				swal("", "Periode dan Emiten Harus Diisi", "error");
				return false;
			}else{
				call('management-stocksum/list/'+emiten+'/'+periode,'_content_','Stock Summary List')
			}
		@else
			var emiten = 'null';
			if (periode == '' || periode == null || periode == undefined) {
				swal("", "Periode Harus Diisi", "error");
				return false;
			}else{
				call('management-stocksum/list/'+emiten+'/'+periode,'_content_','Stock Summary List')
			}
		@endif

	}

	function dataURItoBlob(dataURI) {
      // convert base64/URLEncoded data component to raw binary data held in a string
      var byteString;
      if (dataURI.split(',')[0].indexOf('base64') >= 0)
          byteString = atob(dataURI.split(',')[1]);
      else
          byteString = unescape(dataURI.split(',')[1]);

      // separate out the mime component
      var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

      // write the bytes of the string to a typed array
      var ia = new Uint8Array(byteString.length);
      for (var i = 0; i < byteString.length; i++) {
          ia[i] = byteString.charCodeAt(i);
      }

      return new Blob([ia], {type:mimeString});
  }

	function generate(type)
	{		

		var periode = $('#periode').val();		
		@if(Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21)
			var emiten = $('#emiten').val();
			if (periode == '' || periode == null || periode == undefined || emiten == '' || emiten == null || emiten == undefined) {
				swal("", "Periode dan Emiten Harus Diisi", "error");
				return false;
			}
		@else
			var emiten = 'null';
			if (periode == '' || periode == null || periode == undefined) {
				swal("", "Periode Harus Diisi", "error");
				return false;
			}
		@endif

		var chart1 = dataURItoBlob(($("#stockSummary3").get(0)).toDataURL('image/png'));
	    var chart2 = dataURItoBlob(($("#stockSummary4").get(0)).toDataURL('image/png'));      
	    
	    var data = new FormData();
	    data.append('chart1', chart1);
	    data.append('chart2', chart2);

	    $.ajax({
	      type: 'POST',
	      url: 'management-stocksum/saveChart',
	      data: data,            
	      timeout: 1200000,
	      processData: false,
	      contentType: false,
	      success: function(data){
	        var namafile = data;          	        
	        window.open(site_url+"/management-stocksum/export/"+type+"/"+emiten+"/"+periode+"/"+namafile,'_blank');
	      }

	    });
		

	}


	function drawChart()
	{
		@if(Auth::user()->USER_ROLE_ID == 2 || Auth::user()->USER_ROLE_ID == 21)
	    	var emiten = $('#kode_emiten_for_emiten').val();
		@else
			var emiten = $('#emiten').val();
		@endif

	    var month = $('#periode').val();
	    var periode = getMonthYear(month).toUpperCase();	   

	    $.ajax({
	      type: 'GET',
	      data: {emiten : emiten, month : month},
	      url: 'drawchart/stocksummary',
	      success: function(data){
	        if(data.chart.length > 0)
	        {
	          $('#stockSummary1').remove();
	          $('#chartarea').find('#stocksummary_area1').append('<canvas id="stockSummary1" style="height: 300px"></canvas>');
	          $('#stockSummary2').remove();
	          $('#chartarea').find('#stocksummary_area2').append('<canvas id="stockSummary2" style="height: 300px"></canvas>');

	          $('#stockSummary3').remove();
	          $('#chartarea2').find('#stocksummary_area3').append('<canvas id="stockSummary3"></canvas>');
	          $('#stockSummary4').remove();
	          $('#chartarea2').find('#stocksummary_area4').append('<canvas id="stockSummary4"></canvas>');

	          $('#chartarea').show();
	          $('#chartarea2').show();

	          var dates = [];
	          var chartdata1 = [];
	          var chartdata2 = [];
	          var chartdata3 = [];
	          
	          $.each(data.chart, function(key, val){
	            dates.push(val.DATE);
	            chartdata1.push(val.TX_STOCK_SUM_VOLUME);
	            chartdata2.push(val.TX_STOCK_SUM_CLOSE);
	            chartdata3.push(val.TX_STOCK_SUM_VALUE);
	          });

	          //Chart 1
	          var ctx = document.getElementById("stockSummary1");
	          var myChart = new Chart(ctx, {
	            type: 'line',
	            data: {
	              labels: dates,
	              datasets: [{
	                label: "Volume",
	                // fill: "false",
	                backgroundColor: "rgba(51, 122, 183,0)",
	                borderWidth: 2,
	                borderColor: "#01a89e",
	                pointRadius: 4,
	                pointBackgroundColor: "#01a89e",
	                pointBorderColor: "#fff",
	                pointHoverBackgroundColor: "#fff",
	                pointHoverBorderColor: "#01a89e",
	                yAxisID: "y-axis-0",
	                data: chartdata1
	              }, {
	                label: "Close",
	                // fill: "false",
	                backgroundColor: "rgba(196,88,80,0)",
	                borderWidth: 2,
	                borderColor: "#c45850",
	                pointRadius: 4,
	                pointBackgroundColor: "#c45850",
	                pointBorderColor: "#fff",
	                pointHoverBackgroundColor: "#fff",
	                pointHoverBorderColor: "#c45850",
	                yAxisID: "y-axis-1",
	                data: chartdata2
	              }]
	            },
	            options: {
	              title: {
	                  display: true,
	                  text: [emiten, 'PERKEMBANGAN HARGA SAHAM ' + periode]
	              },
	              tooltips: {
	                callbacks: {
	                  label: function(tooltipItem, data) {
	                    var value = data.datasets[0].data[tooltipItem.index];
	                    value = value.toString();
	                    value = value.split(/(?=(?:...)*$)/);
	                    value = value.join(',');
	                    return value;
	                  }
	                }
	              },
	              elements: {
	                  line: {
	                      tension: 0,
	                  }
	              },
	              animation: {
	                duration: 2500,
	                numStep: 60,
	                easing: 'easeOutQuart',
	              },
	              // responsive: true,
	              // maintainAspectRatio: false,
	              scales: {
	                xAxes: [{
	                  gridLines: {
	                    display: false,
	                    color: "#f0f0f0"
	                  },
	                }],
	                yAxes: [{
	                  gridLines: {
	                    display: true,
	                    color: "#f0f0f0"
	                  },
	                  ticks: {
	                    beginAtZero:true,
	                    userCallback: function(value, index, values) {
	                        value = value.toString();
	                        value = value.split(/(?=(?:...)*$)/);
	                        value = value.join(',');
	                        return value;
	                    }
	                  },
	                  position: "left",
	                  id: "y-axis-0"
	                }, {
	                  gridLines: {
	                    display: true,
	                    color: "#f0f0f0"
	                  },
	                  ticks: {
	                    beginAtZero:true,
	                    userCallback: function(value, index, values) {
	                        value = value.toString();
	                        value = value.split(/(?=(?:...)*$)/);
	                        value = value.join(',');
	                        return value;
	                    }
	                  },
	                  position: "right",
	                  id: "y-axis-1"
	                }]
	              },
	              // scaleOverride : true,
	              // scaleStepWidth : 10,
	            }
	          });

	          //Chart 2
	          var ctx2 = document.getElementById("stockSummary2");
	          var myChart2 = new Chart(ctx2, {
	            type: 'line',
	            data: {
	              labels: dates,
	              datasets: [{
	                label: "Value",
	                // fill: "false",
	                backgroundColor: "rgba(142,94,162,0)",
	                borderWidth: 2,
	                borderColor: "#8e5ea2",
	                pointRadius: 4,
	                pointBackgroundColor: "#8e5ea2",
	                pointBorderColor: "#fff",
	                pointHoverBackgroundColor: "#fff",
	                pointHoverBorderColor: "#8e5ea2",
	                yAxisID: "y-axis-0",
	                data: chartdata3
	              }]
	            },
	            options: {
	              title: {
	                  display: true,
	                  text: [emiten, 'NILAI TRANSAKSI SAHAM ' + periode]
	              },
	              tooltips: {
	                callbacks: {
	                  label: function(tooltipItem, data) {
	                    var value = data.datasets[0].data[tooltipItem.index];
	                    value = value.toString();
	                    value = value.split(/(?=(?:...)*$)/);
	                    value = value.join(',');
	                    return value;
	                  }
	                }
	              },
	              elements: {
	                  line: {
	                      tension: 0,
	                  }
	              },
	              animation: {
	                duration: 2500,
	                numStep: 60,
	                easing: 'easeOutQuart',
	              },
	              // responsive: true,
	              // maintainAspectRatio: false,
	              scales: {
	                xAxes: [{
	                  gridLines: {
	                    display: false,
	                    color: "#f0f0f0"
	                  },
	                }],
	                yAxes: [{
	                  gridLines: {
	                    display: true,
	                    color: "#f0f0f0"
	                  },
	                  ticks: {
	                    beginAtZero:true,
	                    userCallback: function(value, index, values) {
	                        value = value.toString();
	                        value = value.split(/(?=(?:...)*$)/);
	                        value = value.join(',');
	                        return value;
	                    }
	                  },
	                  position: "left",
	                  id: "y-axis-0"
	                }]
	              },
	              // scaleOverride : true,
	              // scaleStepWidth : 10,
	            }
	          });


	          // chart for download
	          //Chart 3
	          var ctx3 = document.getElementById("stockSummary3");
	          var myChart3 = new Chart(ctx3, {
	            type: 'line',
	            data: {
	              labels: dates,
	              datasets: [{
	                label: "Volume",
	                // fill: "false",
	                backgroundColor: "rgba(51, 122, 183,0)",
	                borderWidth: 6,
	                borderColor: "#01a89e",
	                pointRadius: 10,
	                pointBackgroundColor: "#01a89e",
	                pointBorderColor: "#fff",
	                pointHoverBackgroundColor: "#fff",
	                pointHoverBorderColor: "#01a89e",
	                yAxisID: "y-axis-0",
	                data: chartdata1
	              }, {
	                label: "Close",
	                // fill: "false",
	                backgroundColor: "rgba(196,88,80,0)",
	                borderWidth: 6,
	                borderColor: "#c45850",
	                pointRadius: 10,
	                pointBackgroundColor: "#c45850",
	                pointBorderColor: "#fff",
	                pointHoverBackgroundColor: "#fff",
	                pointHoverBorderColor: "#c45850",
	                yAxisID: "y-axis-1",
	                data: chartdata2
	              }]
	            },
	            options: {
	              title: {
	                  display: true,
	                  fontSize: 24,
	                  fontColor: '#000000',
	                  text: [emiten, 'PERKEMBANGAN HARGA SAHAM ' + periode]
	              },
	              legend: {
	                display: true,
	                labels: {
	                  fontSize: 15,
	                }
	              },
	              tooltips: {
	                callbacks: {
	                  label: function(tooltipItem, data) {
	                    var value = data.datasets[0].data[tooltipItem.index];
	                    value = value.toString();
	                    value = value.split(/(?=(?:...)*$)/);
	                    value = value.join(',');
	                    return value;
	                  }
	                }
	              },
	              elements: {
	                  line: {
	                      tension: 0,
	                  }
	              },
	              animation: {
	                duration: 2500,
	                numStep: 60,
	                easing: 'easeOutQuart',
	              },
	              // responsive: true,
	              // maintainAspectRatio: false,
	              scales: {
	                xAxes: [{
	                  gridLines: {
	                    display: false,
	                    color: "#f0f0f0"
	                  },
	                  ticks: {
	                    fontSize: 15,
	                    fontColor: '#000000',
	                  },
	                  scaleLabel: {
	                    display: true,
	                    labelString: '(STOCK DATE)',
	                    fontSize: 20,
	                    fontColor: '#000000',
	                  },
	                }],
	                yAxes: [{
	                  gridLines: {
	                    display: true,
	                    color: "#f0f0f0"
	                  },
	                  ticks: {
	                    beginAtZero:true,
	                    fontSize: 20,
	                    fontColor: '#000000',
	                    userCallback: function(value, index, values) {
	                        value = value.toString();
	                        value = value.split(/(?=(?:...)*$)/);
	                        value = value.join(',');
	                        return value;
	                    }
	                  },
	                  position: "left",
	                  id: "y-axis-0"
	                }, {
	                  gridLines: {
	                    display: true,
	                    color: "#f0f0f0"
	                  },
	                  ticks: {
	                    beginAtZero:true,
	                    fontSize: 20,
	                    fontColor: '#000000',
	                    userCallback: function(value, index, values) {
	                        value = value.toString();
	                        value = value.split(/(?=(?:...)*$)/);
	                        value = value.join(',');
	                        return value;
	                    }
	                  },
	                  position: "right",
	                  id: "y-axis-1"
	                }]
	              },
	              // scaleOverride : true,
	              // scaleStepWidth : 10,
	            }
	          });

	          //Chart 4
	          var ctx4 = document.getElementById("stockSummary4");
	          var myChart4 = new Chart(ctx4, {
	            type: 'line',
	            data: {
	              labels: dates,
	              datasets: [{
	                label: "Value",
	                // fill: "false",
	                backgroundColor: "rgba(142,94,162,0)",
	                borderWidth: 6,
	                borderColor: "#8e5ea2",
	                pointRadius: 10,
	                pointBackgroundColor: "#8e5ea2",
	                pointBorderColor: "#fff",
	                pointHoverBackgroundColor: "#fff",
	                pointHoverBorderColor: "#8e5ea2",
	                yAxisID: "y-axis-0",
	                data: chartdata3
	              }]
	            },
	            options: {
	              title: {
	                  display: true,
	                  fontSize: 24,
	                  fontColor: '#000000',
	                  text: [emiten, 'NILAI TRANSAKSI SAHAM ' + periode]
	              },
	              legend: {
	                display: true,
	                labels: {
	                  fontSize: 15,
	                }
	              },
	              tooltips: {
	                callbacks: {
	                  label: function(tooltipItem, data) {
	                    var value = data.datasets[0].data[tooltipItem.index];
	                    value = value.toString();
	                    value = value.split(/(?=(?:...)*$)/);
	                    value = value.join(',');
	                    return value;
	                  }
	                }
	              },
	              elements: {
	                  line: {
	                      tension: 0,
	                  }
	              },
	              animation: {
	                duration: 2500,
	                numStep: 60,
	                easing: 'easeOutQuart',
	              },
	              // responsive: true,
	              // maintainAspectRatio: false,
	              scales: {
	                xAxes: [{
	                  gridLines: {
	                    display: false,
	                    color: "#f0f0f0"
	                  },
	                  ticks: {
	                    fontSize: 15,
	                    fontColor: '#000000',
	                  },
	                  scaleLabel: {
	                    display: true,
	                    labelString: '(STOCK DATE)',
	                    fontSize: 20,
	                    fontColor: '#000000',
	                  },
	                }],
	                yAxes: [{
	                  gridLines: {
	                    display: true,
	                    color: "#f0f0f0"
	                  },
	                  ticks: {
	                    beginAtZero:true,
	                    fontSize: 20,
	                    fontColor: '#000000',
	                    userCallback: function(value, index, values) {
	                        value = value.toString();
	                        value = value.split(/(?=(?:...)*$)/);
	                        value = value.join(',');
	                        return value;
	                    }
	                  },
	                  position: "left",
	                  id: "y-axis-0"
	                }]
	              },
	              // scaleOverride : true,
	              // scaleStepWidth : 10,
	            }
	          });

	          $('#chartarea2').hide();
	        }
	        else
	        {
	          swal("", "Data tidak ditemukan.", "error");
	          $('#stockSummary1').remove();
	          $('#stockSummary2').remove();

	          $('#stockSummary3').remove();
	          $('#stockSummary4').remove();

	          $('#chartarea').hide();
	          $('#chartarea2').hide();

	          $('#tablearea').hide();
	        }
	      }
	    });
	}

</script>

<script type="text/javascript">
	
$(document).ready(function () {
	var periode = $('#periode').val();
	@if(Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21)
		var emiten = $('#emiten').val();
	@else
		var emiten = 'null';
	@endif

	$.ajax({
        type:'GET',
        url: 'management-stocksum/data/'+emiten+'/'+periode, 
        data : '',
        success: function(data){        	
        	var dataJSONArray = JSON.parse(data);
        	var datatable = $('.m_datatable').mDatatable({
				// datasource definition
				data: {
					type: 'local',
					source: dataJSONArray,
					pageSize: 10,
					saveState: {
						cookie: false,
						webstorage: false
					}
				},

				// layout definition
				layout: {
					theme: 'default', // datatable theme
					class: '', // custom wrapper class
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					// height: 450, // datatable's body's fixed height
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,

				pagination: true,

				search: {
					input: $('#generalSearch')
				},

				// inline and bactch editing(cooming soon)
				// editable: false,

				// columns definition
				columns: [
				// {
				// 	field: "TX_STOCK_SUM_ID",
				// 	title: "#",
				// 	sortable: false, // disable sort for this column
				// 	width: 40,
				// 	textAlign: 'center',
				// 	selector: {class: 'm-checkbox--solid m-checkbox--brand'}
				// },
				// {
				// 	field: "row_number",
				// 	title: "No.",
				// 	width: 50,
				// 	sortable: false,
				// 	selector: false,
				// 	textAlign: 'center'
				// }, 
				{
					field: "Tanggal",
					title: "Date"
				}, {
					field: "TX_STOCK_SUM_STOCK_CODE",
					title: "Stock Code"
				}, {
					field: "TX_STOCK_SUM_STOCK_NAME",
					title: "Stock Name"
				}, {
					field: "TX_STOCK_SUM_HIGH",
					title: "High",
					template: function(row){
						return '<span>'+(row.TX_STOCK_SUM_HIGH != null ? (ThousandSeparator(row.TX_STOCK_SUM_HIGH,0)) : 0)+'</span>';
					}
				}, {
					field: "TX_STOCK_SUM_LOW",
					title: "Low",
					template: function(row){
						return '<span>'+(row.TX_STOCK_SUM_LOW != null ? (ThousandSeparator(row.TX_STOCK_SUM_LOW,0)) : 0)+'</span>';
					}
				}, {
					field: "TX_STOCK_SUM_CLOSE",
					title: "Close",
					template: function(row){
						return '<span>'+(row.TX_STOCK_SUM_CLOSE != null ? (ThousandSeparator(row.TX_STOCK_SUM_CLOSE,0)) : 0)+'</span>';
					}
				}, {
					field: "TX_STOCK_SUM_CHANGE",
					title: "Change",
					template: function(row){
						return '<span>'+(row.TX_STOCK_SUM_CHANGE != null ? (ThousandSeparator(row.TX_STOCK_SUM_CHANGE,0)) : 0)+'</span>';
					}
				}, {
					field: "TX_STOCK_SUM_VOLUME",
					title: "Volume",
					template: function(row){
						return '<span>'+(row.TX_STOCK_SUM_VOLUME != null ? (ThousandSeparator(row.TX_STOCK_SUM_VOLUME,0)) : 0)+'</span>';
					}
				}, {
					field: "TX_STOCK_SUM_VALUE",
					title: "Value",
					template: function(row){
						return '<span>'+(row.TX_STOCK_SUM_VALUE != null ? (ThousandSeparator(row.TX_STOCK_SUM_VALUE,0)) : 0)+'</span>';
					}
				}, {
					field: "TX_STOCK_SUM_FREQUENCY",
					title: "Frequency",
					template: function(row){
						return '<span>'+(row.TX_STOCK_SUM_FREQUENCY != null ? (ThousandSeparator(row.TX_STOCK_SUM_FREQUENCY,0)) : 0)+'</span>';
					}
				}
				// {
				// 	field: "Actions",
				// 	width: 110,
				// 	title: "Actions",
				// 	sortable: false,
				// 	overflow: 'visible',
				// 	template: function (row) {
				// 		// return '<p>test</p>';
				// 		var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
				// 		var btn = '';
				// 			btn = '<a href="#" onclick="view('+row.TX_STOCK_SUM_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">\
		  //                           <i class="la la-edit"></i>\
		  //                       </a>\
		  //                       <a href="#" onclick="hapus('+row.TX_STOCK_SUM_ID+')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete ">\
		  //                           <i class="la la-trash"></i>\
		  //                       </a>\
				// 				';										
				// 		return btn;
				// 	}
				// }			
				]
			});

			var query = datatable.getDataSourceQuery();		

			// on checkbox checked event
			$('.m_datatable')
				.on('m-datatable--on-check', function (e, args) {
					var count = datatable.getSelectedRecords().length;
					$('#m_datatable_selected_number').html(count);
					if (count > 0) {
						$('#m_datatable_group_action_form').collapse('show');					
					}
				})
				.on('m-datatable--on-uncheck m-datatable--on-layout-updated', function (e, args) {
					var count = datatable.getSelectedRecords().length;
					$('#m_datatable_selected_number').html(count);
					if (count === 0) {
						$('#m_datatable_group_action_form').collapse('hide');
					}
				});

			$('#m_datatable_check_all').click(function(){
				// send email
				$.ajax({
			        type:'GET',
			        url: 'management-stocksum/delete/multiple', 
			        data : '',
			        success: function(data){
			        	if (data=='success') {
			        	}else{
			        		swal("","Terjadi Kesalahan !","error");		        		
			        		return false;
			        	}
			    	}
				});

				var data123 = datatable.getSelectedRecords();			
				var rowsid = [];		
				if (data123.length > 0) {
					$.each(data123, function(key, val)
					{					
						rowsid.push($(val).find('input').val());
					})
					rowsid.toString();				
				}else{
					swal("","Pilih Data Dahulu !","error");
				}
			});	
		}	
	});

	return false;
});

function view(id)
{
	$.ajax({
		type: 'GET',
		data: {report_id : id},
		url: 'management-report/view',
		success: function(data){
			$('#_content_body_').html(data);
		}
	})
}

function hapus(id)
{
	swal({
	  title: "",
	  text: "Are you sure delete it?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Yes, Delete!",
	  closeOnConfirm: false
	},
	function(){
		$.ajax({
			type: 'GET',
			data: {report_id : id},
			url: 'management-report/delete',
			success: function(data){
				swal("Deleted!", "Report Data Deleted.", "success");
				call('management-report/list', '_content_', 'Report List');
			}
		})
	});
}

function preview(id)
{
	var tipe = 'report';
	window.open(site_url+"/preview/"+tipe+"/"+id,"Preview Report","scrollbars=yes, resizable=yes,width=1100,height=700");
}

function resend_code(){
	$.ajax({
        type:'GET',
        url: 'management-report/sendotp/', 
        data : '',
        success: function(data){
        	if (data=='success') {
        		swal("Sended!","Check Your Email !","success");
        	}else{
        		swal("","Terjadi Kesalahan !","error");
        		
        		// return false;
        	}
    	}
	});
}

</script>
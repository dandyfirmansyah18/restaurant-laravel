	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">
					Dashboard
				</h3>
			</div>
		</div>
	</div>
	<!-- END: Subheader -->
	<div class="m-content">
		<!--Begin::Main Portlet-->
		<div class="m-portlet">
			<div class="m-portlet__body  m-portlet__body--no-padding">
				<div class="row m-row--no-padding m-row--col-separator-xl">
					<div class="col-xl-4">
						<!--begin:: Widgets/Stats2-1 -->
						<div class="m-widget1">
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title title_custom">
											Emiten
										</h3>
										<span class="m-widget1__desc">Total Emiten Registered</span>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-success">
											10
										</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title title_custom">
											Report
										</h3>
										<span class="m-widget1__desc">Total Report Uploaded</span>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-info">
											10
										</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title title_custom">
											Corporate Action
										</h3>
										<span class="m-widget1__desc">Total Corporate Action Uploaded</span>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-warning">
											10
										</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title title_custom">
											Regulation
										</h3>
										<span class="m-widget1__desc">Total Regulation Published</span>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-danger">
											10
										</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title title_custom">
											News
										</h3>
										<span class="m-widget1__desc">Total News Published</span>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-brand">
											10
										</span>
									</div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Stats2-1 -->
					</div>
					<div class="col-xl-4">
						<!--begin:: Widgets/Daily Sales-->
						<div class="m-widget14">
							<div class="m-widget14__header m--margin-bottom-30">
								<h3 class="m-widget14__title">
									Daily Login
								</h3>
								<span class="m-widget14__desc">
									Count User Login in Portal BAE
								</span>
							</div>
							<div class="m-widget14__chart" style="height:120px;">
								<canvas  id="m_chart_daily_login"></canvas>
							</div>
						</div>
						<!--end:: Widgets/Daily Sales-->
					</div>
					<div class="col-xl-4">
						<!--begin:: Widgets/Profit Share-->
						<div class="m-widget14">
							<div class="m-widget14__header">
								<h3 class="m-widget14__title">
									Report
								</h3>
								<span class="m-widget14__desc">
									Comparison of total reports
								</span>
							</div>
							<div class="row  align-items-center">
								<div class="col">
									<div id="m_chart_report_comparison" class="m-widget14__chart" style="height: 160px">
										<div class="m-widget14__stat">
											10
										</div>
									</div>
								</div>
								<div class="col">
									<div class="m-widget14__legends">										
										<div class="m-widget14__legend">
											<span class="m-widget14__legend-bullet m--bg-warning"></span>
											<span class="m-widget14__legend-text">
												47% Business Events
											</span>
										</div>
										<div class="m-widget14__legend">
											<span class="m-widget14__legend-bullet m--bg-brand"></span>
											<span class="m-widget14__legend-text">
												19% Others
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Profit Share-->
					</div>
				</div>
			</div>
		</div>
		<!--End::Main Portlet-->
	</div>

<script type="text/javascript">
//== Class definition
var Dashboard = function() {

    var daterangepickerInit = function() {
        if ($('#m_dashboard_daterangepicker').length == 0) {
            return;
        }

        var picker = $('#m_dashboard_daterangepicker');
        var start = moment();
        var end = moment();

        function cb(start, end, label) {
            var title = '';
            var range = '';

            if ((end - start) < 100) {
                title = 'Today:';
                range = start.format('MMM D');
            } else if (label == 'Yesterday') {
                title = 'Yesterday:';
                range = start.format('MMM D');
            } else {
                range = start.format('MMM D') + ' - ' + end.format('MMM D');
            }

            picker.find('.m-subheader__daterange-date').html(range);
            picker.find('.m-subheader__daterange-title').html(title);
        }

        picker.daterangepicker({
            startDate: start,
            endDate: end,
            opens: 'left',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end, '');
    }

    var datatableLatestEmiten = function() {
        if ($('#m_datatable_latest_emiten').length === 0) {
            return;
        }

        var datatable = $('#m_datatable_latest_emiten').mDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/dashboard/list/emiten/5',
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

            columns: [{
                    field: "PROFILE_KODE_EMITEN",
                    title: "Kode Emiten",
                    width: "100"
                }, {
                    field: "PROFILE_NPWP",
                    title: "NPWP"
                }, {
                    field: "PROFILE_COMPANY_NAME",
                    title: "Company Name"
                }]
        });
    }

    var datatableIsLoginEmiten = function() {
        if ($('#m_datatable_emiten_islogin').length === 0) {
            return;
        }

        var datatable = $('#m_datatable_emiten_islogin').mDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/dashboard/list/emitenislogin/5',
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

            columns: [{
                    field: "USER_EMAIL",
                    title: "Email"
                }, {
                    field: "PROFILE_COMPANY_NAME",
                    title: "Company Name"
                }, {
                    field: "USER_LAST_LOGIN",
                    title: "Login Time"
                }]
        });
    }

    var datatableDownloadHistory = function() {
        if ($('#m_datatable_download_history').length === 0) {
            return;
        }

        var datatable = $('#m_datatable_download_history').mDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/dashboard/list/downloadfile/5',
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

            columns: [{
                    field: "LOG_START",
                    title: "Date",
                }, {
                    field: "USER_EMAIL",
                    title: "Email"
                }, {
                    field: "PROFILE_COMPANY_NAME",
                    title: "Company Name"
                }, {
                    field: "REPORT_TYPE_NAME",
                    title: "Report Type"
                }, {
                    field: "REPORT_FILENAME",
                    title: "Filename"
                }]
        });
    }


    return {
        //== Init demos
        init: function() {
            // init charts
            // reportComparison();

            // init daterangepicker
            daterangepickerInit();

            // datatables
            datatableLatestEmiten();
            datatableIsLoginEmiten();
            datatableDownloadHistory();

            // calendar
            // calendarInit();

            // Messages
            messages();
        }
    };
}();

//== Class initialization on page load
jQuery(document).ready(function() {

	var arrDate = [];
    var arrValue = [];

    $.ajax({
		type: 'GET',
		data: '',
		url: 'dashboard-chart/dailylogin',
		success: function(data){
			data.forEach(function(entry) {
				arrDate.push(entry.dt);
				arrValue.push(entry.countlogin);
			});

			// console.log(arrDate);
			// console.log(arrValue);
		    
		    var dailylogin = function() {
		        var chartData = {
		            labels: arrDate,
		            datasets: [{
		                //label: 'Dataset 1',
		                backgroundColor: mUtil.getColor('success'),
		                data: arrValue
		            }]
		        };

		        var chartContainer = $('#m_chart_daily_login');

		        if (chartContainer.length == 0) {
		            return;
		        }

		        var chart = new Chart(chartContainer, {
		            type: 'bar',
		            data: chartData,
		            options: {
		                title: {
		                    display: true,
		                },
		                tooltips: {
		                    intersect: false,
		                    mode: 'nearest',
		                    xPadding: 10,
		                    yPadding: 10,
		                    caretPadding: 10
		                },
		                legend: {
		                    display: false
		                },
		                responsive: true,
		                maintainAspectRatio: false,
		                barRadius: 4,
		                scales: {
		                    xAxes: [{
		                        display: false,
		                        gridLines: false,
		                        stacked: true
		                    }],
		                    yAxes: [{
		                        display: false,
		                        stacked: true,
		                        gridLines: false
		                    }]
		                },
		                layout: {
		                    padding: {
		                        left: 0,
		                        right: 0,
		                        top: 0,
		                        bottom: 0
		                    }
		                }
		            }
		        });
		    }

		    dailylogin();
		}
	});

	var arrayReport = [];
    var arrayType = [];
	$.ajax({
		type: 'GET',
		data: '',
		url: 'dashboard-chart/countreport',
		success: function(data){
			// console.log(data);			

			//== Profit Share Chart.
		    //** Based on Chartist plugin - https://gionkunz.github.io/chartist-js/index.html

		    data.forEach(function(entry) {
		    	var report = {
			                    value: entry.value,
			                    className: 'custom',
			                    meta: {
			                        color: entry.colorpalette
			                    }
			                 };

				arrayReport.push(report);
				arrayType.push(entry.REPORT_TYPE_NAME);

			});			

		    var reportComparison = function() {
		        if ($('#m_chart_report_comparison').length == 0) {
		            return;
		        }

		        var chart = new Chartist.Pie('#m_chart_report_comparison', {
		            series: arrayReport,
				    // series: data,
		            labels: arrayType
		        }, {
		            donut: true,
		            donutWidth: 17,
		            showLabel: false
		        });

		        chart.on('draw', function(data) {
		            if (data.type === 'slice') {
		                // Get the total path length in order to use for dash array animation
		                var pathLength = data.element._node.getTotalLength();

		                // Set a dasharray that matches the path length as prerequisite to animate dashoffset
		                data.element.attr({
		                    'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
		                });

		                // Create animation definition while also assigning an ID to the animation for later sync usage
		                var animationDefinition = {
		                    'stroke-dashoffset': {
		                        id: 'anim' + data.index,
		                        dur: 1000,
		                        from: -pathLength + 'px',
		                        to: '0px',
		                        easing: Chartist.Svg.Easing.easeOutQuint,
		                        // We need to use `fill: 'freeze'` otherwise our animation will fall back to initial (not visible)
		                        fill: 'freeze',
		                        'stroke': data.meta.color
		                    }
		                };

		                // If this was not the first slice, we need to time the animation so that it uses the end sync event of the previous animation
		                if (data.index !== 0) {
		                    animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
		                }

		                // We need to set an initial value before the animation starts as we are not in guided mode which would do that for us

		                data.element.attr({
		                    'stroke-dashoffset': -pathLength + 'px',
		                    'stroke': data.meta.color
		                });

		                // We can't use guided mode as the animations need to rely on setting begin manually
		                // See http://gionkunz.github.io/chartist-js/api-documentation.html#chartistsvg-function-animate
		                data.element.animate(animationDefinition, false);
		            }
		        });

		        // For the sake of the example we update the chart every time it's created with a delay of 8 seconds
		        chart.on('created', function() {
		            if (window.__anim21278907124) {
		                clearTimeout(window.__anim21278907124);
		                window.__anim21278907124 = null;
		            }
		            window.__anim21278907124 = setTimeout(chart.update.bind(chart), 15000);
		        });
		    }
			
			reportComparison();
		}
	});

    var labelUpdown = [];
    var arrayUpload = [];	var sumUpload = 0;
    var arrayDownload = [];	var sumDownload = 0;
	$.ajax({
		type: 'GET',
		data: '',
		url: 'dashboard-chart/uploaddownload',
		success: function(data){

		    data.chart.forEach(function(entry) {
	            labelUpdown.push(entry.dt);
	            arrayUpload.push(entry.upload);
	            arrayDownload.push(entry.download);
			});

			$('#sumupload').text(data.sumupload);
			$('#uploadprogress').css('width','100%');
			$('#sumdownload').text(data.sumdownload);
			$('#downloadprogress').css('width','100%');

	    	var updownComparison = function() {
		        if ($('#m_chart_updown_comparison').length == 0) {
		            return;
		        }

		        var chart = new Chart($('#m_chart_updown_comparison'), {
		            type: 'line',
		            data: {
		                labels: labelUpdown,
		                datasets: [{
		                    label: "Upload",
		                    borderColor: mUtil.getColor('info'),
		                    // borderColor: '#3f7fbf',
		                    borderWidth: 2,
		                    pointBackgroundColor: mUtil.getColor('info'),

		                    backgroundColor: mUtil.getColor('info'),
		                    // backgroundColor: '#49aecf',

		                    pointHoverBackgroundColor: mUtil.getColor('info'),
		                    pointHoverBorderColor: Chart.helpers.color(mUtil.getColor('info')).alpha(0.2).rgbString(),
		                    data: arrayUpload
		                },{
		                    label: "Download",
		                    borderColor: mUtil.getColor('brand'),
		                    // borderColor: '#0f4e83',
		                    borderWidth: 2,
		                    pointBackgroundColor: mUtil.getColor('brand'),

		                    backgroundColor: mUtil.getColor('brand'),
		                    // backgroundColor: '#266da1',

		                    pointHoverBackgroundColor: mUtil.getColor('focus'),
		                    pointHoverBorderColor: Chart.helpers.color(mUtil.getColor('focus')).alpha(0.2).rgbString(),
		                    data: arrayDownload
		                }]
		            },
		            options: {
		                title: {
		                    display: false,
		                },
		                tooltips: {
		                    intersect: false,
		                    mode: 'nearest',
		                    xPadding: 10,
		                    yPadding: 10,
		                    caretPadding: 10
		                },
		                legend: {
		                    display: false,
		                    labels: {
		                        usePointStyle: false
		                    }
		                },
		                responsive: true,
		                maintainAspectRatio: false,
		                hover: {
		                    mode: 'index'
		                },
		                scales: {
		                    xAxes: [{
		                        display: false,
		                        gridLines: false,
		                        scaleLabel: {
		                            display: true,
		                            labelString: 'Date'
		                        }
		                    }],
		                    yAxes: [{
		                        display: false,
		                        gridLines: false,
		                        scaleLabel: {
		                            display: true,
		                            labelString: 'Value'
		                        }
		                    }]
		                },

		                elements: {
		                    point: {
		                        radius: 3,
		                        borderWidth: 0,

		                        hoverRadius: 8,
		                        hoverBorderWidth: 2
		                    }
		                }
		            }
		        });
		    }
			
			updownComparison();
		}
	});


    // Dashboard.init();
});
</script>
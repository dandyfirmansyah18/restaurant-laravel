<!DOCTYPE html>
<html>
<head>
	<title>{{$emiten_name}} ({{$monthname}})</title>
	<style type="text/css">
		table, th, td {
		   font-size: 7px;
		   font-family: "Calibri, sans-serif";
		   border-collapse: collapse;
		   padding-bottom: 4px; 
		}

		table th {			
			padding-top: 5px;
			padding-bottom: 5px;
		    background-color: #e46d0a;
		    color: white;
		    text-align: center;
		    border: 1px solid white;
		}

		.judul {
			text-align: center;
			font-family: "Calibri, sans-serif";
			margin-bottom: 35px;
			margin-top: 70px;
			font-weight: bold;			
		}

		.judul p {
			padding-bottom: -10px;
		}		

		#watermark {
			position: fixed;
			top: 21%;
			width: 100%;
			text-align: center;
			opacity: .2;
			/*transform: rotate(10deg);*/
			transform-origin: 80% 80%;
			z-index: -1000;
		}

		#img_watermark {
			width: 1000px;
			height: 280px;
		}

		.img_chart {
			width: 100%;
			height: 100%;
		}

		.class_chart {
			margin: 0 auto;
			margin-top: 100px;
			border: 1px solid #000000;
			padding: 20px 40px;
			width: 80%;
		}

		.page-break {
		    page-break-after: always;
		}

	</style>
</head>
<body>
	<div id="watermark">
		@if(Auth::check())	
		@else
			<img id="img_watermark" src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/files/Logo_EDIIBAE_Flat.png';?>"/>
		@endif
    	<!-- <img src="{{url('files/Logo EDII Flat.png')}}"> -->
	</div>
	<div class="judul">		
		<p style="font-size: 12px;">DATA PERDAGANGAN SAHAM</p>
		<p style="font-size: 14px;">{{$emiten_name}}</p>
		<p style="font-size: 8px;">{{$monthname}}</p>
	</div>
	<table class="tg">
		<tr>
			<th width="46px">Date</th>
			<th width="50px">Stock Code</th>
			<th width="33px">Previous</th>
			<th width="33px">High</th>
			<th width="33px">Low</th>
			<th width="33px">Close</th>
			<th width="33px">Change</th>
			<th width="58px">Volume</th>
			<th width="58px">Value</th>
			<th width="33px">Freq</th>
			<th width="42px">Index</th>
			<th width="67px">Listed Share</th>
			<th width="67px">Tradeable Shares</th>
			<th width="67px">Weight For Index</th>
			<th width="65px">Foreign Sell</th>
			<th width="65px">Foreign Buy</th>
			<th width="65px">Non Regular Volume</th>
			<th width="67px">Non Regular Value</th>
			<th width="51px">Non Regular Frequency</th>
		</tr>
		@foreach($stockdata as $datas)
		<tr>
			<td align="right">{{$datas->Tanggal}}</td>
			<td align="center">{{$datas->TX_STOCK_SUM_STOCK_CODE}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_PREVIOUS,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_HIGH,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_LOW,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_CLOSE,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_CHANGE,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_VOLUME,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_VALUE,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_FREQUENCY,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_INDEX,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_LISTED_SHARE,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_TRADEABLE_SH,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_WEIGHT_INDEX,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_FOREIGN_SELL,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_FOREIGN_BUY,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_NON_REG_VOL,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_NON_REG_VAL,0,",",".")}}</td>
			<td align="right">{{number_format($datas->TX_STOCK_SUM_NON_REG_FRE,0,",",".")}}</td>
		</tr>
		@endforeach

		<tr id="tr_sum">
			<td align="center" colspan="2" bgcolor="black;"><span style="color: white; font-weight: bold;">SUMMARY</span></td>			
			<td align="right" bgcolor="#e46d0a"><span style="color: white; font-weight: bold;">{{number_format($value_previous[0]->TX_STOCK_SUM_PREVIOUS,0,",",".")}}</span></td>
			<td align="right" bgcolor="#e46d0a"><span style="color: white; font-weight: bold;">{{number_format($stockSum[0]->value_high,0,",",".")}}</span></td>
			<td align="right" bgcolor="#e46d0a"><span style="color: white; font-weight: bold;">{{number_format($stockSum[0]->value_low,0,",",".")}}</span></td>
			<td align="right" bgcolor="#e46d0a"><span style="color: white; font-weight: bold;">{{number_format($value_close[0]->TX_STOCK_SUM_CLOSE,0,",",".")}}</span></td>
			<td align="right" bgcolor="#e46d0a"></td>
			<td align="right" bgcolor="#e46d0a"><span style="color: white; font-weight: bold;">{{number_format($stockSum[0]->sum_volume,0,",",".")}}</span></td>
			<td align="right" bgcolor="#e46d0a"><span style="color: white; font-weight: bold;">{{number_format($stockSum[0]->sum_value,0,",",".")}}</span></td>
			<td align="right" bgcolor="#e46d0a"><span style="color: white; font-weight: bold;">{{number_format($stockSum[0]->sum_frequency,0,",",".")}}</span></td>
			<td align="right" bgcolor="#e46d0a"></td>
			<td align="right" bgcolor="#e46d0a"></td>
			<td align="right" bgcolor="#e46d0a"></td>
			<td align="right" bgcolor="#e46d0a"></td>
			<td align="right" bgcolor="#e46d0a"></td>
			<td align="right" bgcolor="#e46d0a"></td>
			<td align="right" bgcolor="#e46d0a"><span style="color: white; font-weight: bold;">{{number_format($stockSum[0]->sum_nonvol,0,",",".")}}</span></td>
			<td align="right" bgcolor="#e46d0a"><span style="color: white; font-weight: bold;">{{number_format($stockSum[0]->sum_nonval,0,",",".")}}</span></td>
			<td align="right" bgcolor="#e46d0a"><span style="color: white; font-weight: bold;">{{number_format($stockSum[0]->sum_nonfreq,0,",",".")}}</span></td>
		</tr>

	</table>

	<div class="page-break"></div>

	<div class="class_chart">		
		<img class="img_chart" src="../storage/app/TempZIP/{{$chart1}}">
	</div>

	<div class="page-break"></div>

	<div class="class_chart">		
		<img class="img_chart" src="../storage/app/TempZIP/{{$chart2}}">
	</div>

</body>
</html>
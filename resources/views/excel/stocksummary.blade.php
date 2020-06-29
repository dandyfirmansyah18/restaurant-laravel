<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
</head>
<body> 


<table>
    <thead>
    <tr>
        <td colspan="19"><h3 align="center">DATA PERDAGANGAN SAHAM </h3></td>          
    </tr>
    <tr>
        <td colspan="19"><h2 align="center">{{$emiten_name}} </h2></td>          
    </tr>
    <tr>
        <td colspan="19"><h4 align="center">{{$monthname}} </h4></td>
    </tr>
    </thead>
</table>

<table>
    <thead>
    <tr>
        <td>&nbsp;</td>  
    </tr>
    </thead>
</table>

<table style="border: 1px solid black;">
    
    <tr>                
        <th width="19" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Date</th>
		<th width="19" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Stock Code</th>
		<th width="17" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Previous</th>
		<th width="17" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">High</th>
		<th width="17" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Low</th>
		<th width="17" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Close</th>
		<th width="17" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Change</th>
		<th width="22" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Volume</th>
		<th width="22" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Value</th>
		<th width="19" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Freq</th>
		<th width="19" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Index</th>
		<th width="22" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Listed Share</th>
		<th width="22" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Tradeable Shares</th>
		<th width="22" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Weight For Index</th>
		<th width="17" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Foreign Sell</th>
		<th width="17" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Foreign Buy</th>
		<th width="22" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Non Regular Volume</th>
		<th width="22" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Non Regular Value</th>
		<th width="20" valign="middle" style="background-color: #e46d0a;text-align: center; color: #ffffff; wrap-text: true;">Non Regular Frequency</th>
    </tr>



    <?php $z=0; ?>
    @foreach($stockdata as $datas)
    <?php
        
        $z++;
    ?>
    <tr>
        <td align="right">{{$datas->Tanggal}}</td>
		<td align="center">{{$datas->TX_STOCK_SUM_STOCK_CODE}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_PREVIOUS,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_HIGH,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_LOW,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_CLOSE,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_CHANGE,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_VOLUME,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_VALUE,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_FREQUENCY,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_INDEX,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_LISTED_SHARE,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_TRADEABLE_SH,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_WEIGHT_INDEX,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_FOREIGN_SELL,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_FOREIGN_BUY,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_NON_REG_VOL,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_NON_REG_VAL,0)}}</td>
		<td align="right">{{number_format($datas->TX_STOCK_SUM_NON_REG_FRE,0)}}</td>
    </tr>
    @endforeach

    <tr>
        <td align="center" style="background-color:#000000;" colspan="2"><span style="color: #ffffff; font-weight: bold;">SUMMARY</span></td>			
		<td align="right" style="background-color:#e46d0a;"><span style="color: #ffffff; font-weight: bold;">{{number_format($value_previous[0]->TX_STOCK_SUM_PREVIOUS,0)}}</span></td>
		<td align="right" style="background-color:#e46d0a;"><span style="color: #ffffff; font-weight: bold;">{{number_format($stockSum[0]->value_high,0)}}</span></td>
		<td align="right" style="background-color:#e46d0a;"><span style="color: #ffffff; font-weight: bold;">{{number_format($stockSum[0]->value_low,0)}}</span></td>
		<td align="right" style="background-color:#e46d0a;"><span style="color: #ffffff; font-weight: bold;">{{number_format($value_close[0]->TX_STOCK_SUM_CLOSE,0)}}</span></td>
		<td align="right" style="background-color:#e46d0a;"></td>
		<td align="right" style="background-color:#e46d0a;"><span style="color: #ffffff; font-weight: bold;">{{number_format($stockSum[0]->sum_volume,0)}}</span></td>
		<td align="right" style="background-color:#e46d0a;"><span style="color: #ffffff; font-weight: bold;">{{number_format($stockSum[0]->sum_value,0)}}</span></td>
		<td align="right" style="background-color:#e46d0a;"><span style="color: #ffffff; font-weight: bold;">{{number_format($stockSum[0]->sum_frequency,0)}}</span></td>
		<td align="right" style="background-color:#e46d0a;"></td>
		<td align="right" style="background-color:#e46d0a;"></td>
		<td align="right" style="background-color:#e46d0a;"></td>
		<td align="right" style="background-color:#e46d0a;"></td>
		<td align="right" style="background-color:#e46d0a;"></td>
		<td align="right" style="background-color:#e46d0a;"></td>
		<td align="right" style="background-color:#e46d0a;"><span style="color: #ffffff; font-weight: bold;">{{number_format($stockSum[0]->sum_nonvol,0)}}</span></td>
		<td align="right" style="background-color:#e46d0a;"><span style="color: #ffffff; font-weight: bold;">{{number_format($stockSum[0]->sum_nonval,0)}}</span></td>
		<td align="right" style="background-color:#e46d0a;"><span style="color: #ffffff; font-weight: bold;">{{number_format($stockSum[0]->sum_nonfreq,0)}}</span></td>
    </tr>

</table>

</body> 
</html>
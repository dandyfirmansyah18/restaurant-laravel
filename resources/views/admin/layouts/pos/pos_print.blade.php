<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
	    <thead>
	    <tr>
	        <td style="color:blue;"><h1><b><u>Samsul's Restaurant</u></b><h1></td>
	    </tr>
	    <tr>
	        <td><b>JL. Buah Manggis No. 178</b></td>
	    </tr>
	    <tr>
	        <td><b>Tlp.(021)08199582, 8194084 Fax.(021) 8506009</b></td>
	    </tr>
	    <tr>
	        <td>&nbsp;</td>
	    </tr>
	    <tr>
	        <td>&nbsp;</td>
	    </tr>
	    <tr>
	        <td>&nbsp;</td>
	    </tr>
	    </thead>
	</table>
	<br>
        <h3><center><b>KWITANSI PEMBELIAN</b></center></h3>
    <br>
    <br>
	<table>
	    <tr>
	        <td width="90">No. Transaction</td>
	        <td width="10">: </td>
	        <td width="140">{{ $posdata['header']->TRANSACTION_NUMBER }}</td>
	        <td width="10">&nbsp;</td>
	        <td width="90">Customer Name</td>
	        <td width="10">: </td>
	        <td width="140">{{ $posdata['header']->TRANSACTION_CUSTOMER_NAME }}</td>	
	    </tr>

	    <tr>
	        <td width="90">Table / TakeAway</td>
	        <td width="10">: </td>
	        <td width="140">{{ $posdata['header']->TABLE_NO }}</td>
	        <td width="10">&nbsp;</td>
	        <td width="90">Transaction Note</td>
	        <td width="10">: </td>
	        <td width="140">{{ $posdata['header']->TRANSACTION_NOTE }}</td>	
	    </tr>	    
	</table>
	<br>
	<br>
	<table class="table table-bordered">
        <tbody>
        	<tr>
	          <th style="text-align:center;background-color:#ECF542; width: 25;">No</th>	          
	          <th style="text-align:center;background-color:#ECF542; width: 240;">Menu Name</th>
	          <th style="text-align:center;background-color:#ECF542; width: 35;">Qty</th>
	          <th style="text-align:center;background-color:#ECF542; width: 115;">Price/Item</th>
	          <th style="text-align:center;background-color:#ECF542; width: 115;">SubTotal</th>
        	</tr>
        	<?php $no = 1; ?>
        	@foreach($posdata['detail'] as $details)
	        <tr>
	          <td>{{ $no }}</td>
	          <td>{{ $details->MENU_NAME }}</td>
	          <td align="right">{{ $details->TRANSACTION_MENU_AMOUNT }}</td>	          
	          <td align="right">{{ number_format($details->PRICE) }}</td>
	          <td align="right">{{ number_format($details->TRANSACTION_MENU_AMOUNT * $details->PRICE) }}</td>
	        </tr>
	        <?php $no++; ?>
	        @endforeach

      	</tbody>
    </table>
    <hr>
    <table>
	    <thead>
	    <tr>
	    	<td width="350">&nbsp;</td>
	        <td width="50">Total</td>
	        <td width="20">Rp</td>
	        <td width="110" style="text-align: right;">{{ number_format($posdata['header']->TRANSACTION_PRICE) }}</td>
	    </tr>
	    <tr>
	    	<td width="350">&nbsp;</td>
	        <td>Tax 10%</td>
	        <td width="10">Rp</td>
	        <td style="text-align: right;">{{ number_format($posdata['header']->TRANSACTION_TAX) }}</td>
	    </tr>
	    <tr>
	    	<td width="350">&nbsp;</td>
	        <td>Grand Total</td>
	        <td width="10">Rp</td>
	        <td style="text-align: right;">{{ number_format($posdata['header']->TRANSACTION_PRICE_TOTAL) }}</td>
	    </tr>
	    </thead>
	</table>
	<hr>    	   
    <br>
	<br>
	<table>
	    <thead>
	    <tr>
	        <td>Cashier</td>
	        <td>:</td>
	        <td width="250">{{ $posdata['header']->PROFILE_CASHIER_NAME }}</td>
	        <td width="100">&nbsp;</td>
	        <td width="100">&nbsp;</td>
	    </tr>	    
	    </thead>
	</table>

</body>
</html>
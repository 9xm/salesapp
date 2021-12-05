<?php defined('BASEPATH') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->lang->line('sale') . ' ' . $inv->reference_no; ?></title>
<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Calibri"; font-size:x-small }
		.heading { font-size: 20px; font-weight: bold;}
		.normalbold { font-size: 12px; font-weight: bold; line-height:1;}
		.normalboldPlus { font-size: 16px; font-weight: bold;}
		table{border-collapse: collapse;}
		
	</style>
</head>
<body>
<table align="left" cellspacing="0" border="1" style="border-color:black;vertical-align: top">
<tr>
	<td align="right" colspan=13 class="normalbold" style="border-top-color:#FFFFFF;">Original for Recipient</td>
</tr>
	<tr>
		<td colspan=13 align="center" valign=top>
			<table border="0" width="100%">
				<tr><td align="left" valign="top"><img src="<?=base_url("assets/pdfimg/logo-left.jpg") ?>" width="170"  height="85"></td><td>
					<table>
						<tr><td class="heading">SIGTEL ENGINEERING</td></tr>
						<tr><td class="normalbold">NORTH BONGAIGAON | 
							BONGAIGAON | ASSAM | PIN:783380</td></tr>
							<tr><td class="normalbold">email:sigtelengineering@gmail.com</td></tr>
								<tr><td class="normalbold">GSTIN -18AHBPS0035R2ZY | PAN-AHBPS0035R</td></tr>
						<tr><td height="5"></td></tr>
						<tr><td style="padding-left: 78px;"  class="normalboldPlus">TAX INVOICE</td></tr>
						<tr><td height="5"></td></tr>
		
					</table>	
				</td><td align="right" valign="top"><img src="<?=base_url("assets/pdfimg/logo-right.png") ?>" height="85" ></td></tr>

			</table>
			</td>
	</tr>
		<tr>
			<td colspan="5" height="85" align="left">
				<table border="0" align="left" width="100%">
					<tr>
						<td  class="normalboldPlus" width="40%" height="15" align="left" valign=middle>MAGIEC Code:</td>
						<td width="10%"></td>
						<td  class="normalbold" align="left" valign=middle>EBU52819</td>
					</tr>
				<?php
				$serviceType= service_type
			
				?>

					<tr>
						<td  class="normalboldPlus" height="15" align="left" valign=middle>Service Type:</td>
						<td></td>
						<td  class="normalbold" align="left" valign=middle><?= (!empty($inv->service_type))? $inv->service_type : ''; ?></td>
					</tr>
                    	<tr>
						<td  class="normalboldPlus" height="15" align="left" valign=middle>Engine No:</td>
						<td></td>
						<td  class="normalbold" align="left" valign=middle><?= (!empty($inv->engine_no))? $inv->engine_no : ''; ?></td>
					</tr>
					<tr>
						<td  class="normalboldPlus" height="15" align="left" valign=middle>PO No:</td>
						<td></td>
						<td  class="normalbold" align="left" valign=middle><?= (!empty($inv->po_number))? $inv->po_number : ''; ?></td>
					</tr>
					<tr>
						<td  class="normalboldPlus" height="15" align="left" valign=middle>PO Date:</td>
						<td></td>
						<td  align="left" valign=middle  class="normalbold"><?= (!empty($inv->po_date))? date('d/m/Y',strtotime($inv->po_date)): ''; ?></td>
					</tr>
				</table>
			</td>
			<td colspan="3"><br></td>
			<td colspan="5" align="left">
				<table border="0" align="left" width="100%">
					<tr>
						<td  class="normalboldPlus"  width="45%" height="15" align="left" valign=middle>Invoice No:</td>
						<td width="5%"></td>
						<td  class="normalbold" align="left" valign=middle><?= $inv->reference_no; ?></td>
					</tr>
					<tr>
						<td  class="normalboldPlus" height="15" align="left" valign=middle>Invoice Date:</td>
						<td></td>
						<td  class="normalbold" align="left" valign=middle><?= $this->sma->hrld($inv->date); ?></td>
					</tr>

					<tr>
						<td  class="normalboldPlus" height="15" align="left" valign=middle>PI No:</td>
						<td></td>
						<td  class="normalbold" align="left" valign=middle><?=(!empty($pi_number))? $pi_number: ''; ?></td>
					</tr>
					<tr>
						<td  class="normalboldPlus" height="15" align="left" valign=middle>PI Date:</td>
						<td></td>
						<td  align="left" valign=middle  class="normalbold"><?=(!empty($pi_date))? date('d/m/Y',strtotime($pi_date)): ''; ?></td>
					</tr>
					<tr>
						<td colspan="3" height="20" class="normalbold" align="left" valign=middle>Tax is payable on reverse charge -   No</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
		<td colspan=6 width="55%" align="left" 
		valign=top style="padding-bottom: 10px;border-bottom-color:black;">
		<table border="0" width="100%" align="left">
			<tr><td align="left" height="20" valign="middle" class="normalboldPlus"><u>Bill to Party:</u></td></tr>
			<tr><td align="left" height="15" valign="middle" class="normalbold"><?= $customer->company && $customer->company != '-' ? $customer->company : $customer->name; ?></td></tr>
			<tr><td align="left" height="15" valign="middle" class="normalbold"><?=$customer->address ?></td></tr>
			<tr><td align="left" height="15" valign="middle" class="normalbold"><?=$customer->city ?>  <?=$customer->state ?> - <?=$customer->postal_code ?> </td></tr>
			<tr><td align="left" height="15" valign="middle" class="normalbold">GSTIN No: <?=$customer->gst_no ?></td></tr>
		</table>	
		</td>
		<td colspan=7 width="45%" align="left" valign=top 
		style="padding-bottom: 10px;border-bottom-color:black;">
		<table border="0" width="100%">
				<tr><td align="left" height="20" valign="middle" class="normalboldPlus"><u>Place of Supply /Consignee Address:</u></td></tr>
				<tr><td align="left" height="15" valign="middle" class="normalbold"><?= $biller->company && $biller->company != '-' ? $biller->company : $biller->name; ?></td></tr>
				<tr><td align="left" height="15" valign="middle" class="normalbold"><?=$biller->address ?></td></tr>
				<tr><td align="left" height="15" valign="middle" class="normalbold"><?=$biller->city ?> <?=$biller->state ?> - <?=$biller->postal_code ?></td></tr>
				<tr><td align="left" height="15" valign="middle" class="normalbold">GSTIN No: <?= $biller->gst_no ?></td></tr>
			</table>
		</td>
	</tr>

	
	<tr>
		<td height="50" valign=middle align="center" rowspan="2" class="normalbold"><b>Sr. No</b></td>
		<td valign=middle align="center" rowspan="2" class="normalbold"><b>Part No.</b></td>
		<td width="25%" valign=middle align="center" rowspan="2" class="normalbold"><b>Description</b></td>
		<td valign=middle align="center" rowspan="2" class="normalbold"><b>HSN/SAC</b></td>
		<td valign=middle align="center" rowspan="2" class="normalbold"><b>Qty</b></td>
		<td valign=middle align="center" rowspan="2" class="normalbold"><b>UOM</b></td>
		<td valign=middle align="center" rowspan="2" class="normalbold"><b>Rate</b></td>
		<td valign=middle align="center" rowspan="2" class="normalbold"><b>Total Value</b></td>
		<td valign=middle align="center" rowspan="2" class="normalbold"><b>Discount Rate</b></td>
		<td valign=middle align="center" rowspan="2" class="normalbold"><b>Discount Amount</b></td>
		<td valign=middle align="center" rowspan="2" class="normalbold"><b>Taxable Value</b></td>
		<td valign=middle align="center" colspan="2" class="normalbold"><b>Tax Amount(GST)</b></td>
	</tr>
	<tr>	
		
		<td valign=middle align="center" class="normalbold"><b>Rate</b></td>
		<td valign=middle align="center" class="normalbold"><b>Amount</b></td>
		
	</tr>

	<?php
	$r   = 1;
	$totalItemValue=0;
	$totalDiscount=0;
	$totalTaxableAmt=0;
	$totalTaxAmt=0;
	//$taxableAmount =0;
	$rows1=array();
	foreach ($rows as $row): 
		/*echo "<pre>";
		print_r($row);
		echo "</pre>";*/

		if($row->product_type == 'service'){
			$rows1[]=$row;
			continue;
		}
		
		$itemTotalPrice=$row->unit_quantity*$row->real_unit_price;
		$taxableAmount=$itemTotalPrice-$row->item_discount;

		$taxAmout=$row->item_tax;//$taxableAmount*$row->tax_rate/100;

		$totalItemValue = $totalItemValue+$itemTotalPrice;
		$totalDiscount=$totalDiscount+$row->item_discount;
		$totalTaxableAmt=$totalTaxableAmt+$taxableAmount;
		$totalTaxAmt=$totalTaxAmt+$taxAmout;

		//$tTaxAmt=$tTaxAmt+$row->item_tax;
	?>
	<tr>
		<td height="20" valign=middle align="center" class="normalbold sr-no" style="border-bottom-color: #FFF;"><b><?=$r ?></b></td>
		<td valign=middle align="center" class="normalbold part-no"  style="border-bottom-color: #FFF;border-right-color: black;"><b><?=$row->product_code ?></b></td>
		<td valign=middle align="center" class="normalbold description" style="border-bottom-color: #FFF;"><b><?=$row->product_name . ($row->variant ? ' (' . $row->variant . ')' : '') ?></b></td>
		<td valign=middle align="center" class="normalbold hsn-code" style="border-bottom-color: #FFF;"><b><?=($row->hsn_code) ? $row->hsn_code : '' ?></b></td>
		<td valign=middle align="center" class="normalbold qty" style="border-bottom-color: #FFF;"><b><?= $this->sma->formatQuantity($row->unit_quantity)  ?></b></td>
		<td valign=middle align="center" class="normalbold umo" style="border-bottom-color: #FFF;"><b><?=$row->product_unit_code ?></b></td>
		<td valign=middle align="center" class="normalbold rate" style="border-bottom-color: #FFF;"><b><?= $this->sma->formatMoney($row->real_unit_price); ?></b><!--b>
		<?= $row->unit_price != $row->real_unit_price && $row->item_discount > 0 ? '<del>' . $this->sma->formatMoney($row->real_unit_price) . '</del>' : ''; ?>
                                    <?= $this->sma->formatMoney($row->unit_price); ?></b--></td>
		<td valign=middle align="center" class="normalbold total-value " style="border-bottom-color: #FFF;"><b><?=$this->sma->formatMoney($itemTotalPrice) ?></b></td>
		<td valign=middle align="center" class="normalbold discount-rate" style="border-bottom-color: #FFF;"><b><?php
			if (strpos($row->discount,'%') !== false) {
				echo $row->discount;
			} ?></b></td>
		<td valign=middle align="center" class="normalbold discount-amt" style="border-bottom-color: #FFF;"><b><?= $this->sma->formatMoney($row->item_discount) ?></b></td>
		<td valign=middle align="center" class="normalbold tax-val" style="border-bottom-color: #FFF;"><b><?=$this->sma->formatMoney($taxableAmount) ?></b></td>
		<td valign=middle align="center" class="normalbold tax-rate" style="border-bottom-color: #FFF;"><b><?=$Settings->indian_gst ? $row->tax : $row->tax_code ?></b></td>
		<td valign=middle align="center" class="normalbold pamt" style="border-bottom-color: #FFF;"><b><?= $this->sma->formatMoney($taxAmout); ?></b></td>
		</tr>
		<?php $r++; endforeach;
		$s=$r;
		if(count($rows1)>0)
		foreach ($rows1 as $row): 

			/*echo "<pre>";
			print_r($row);
			echo "</pre>";*/
			
			$itemTotalPrice=$row->unit_quantity*$row->real_unit_price;
			$taxableAmount=$itemTotalPrice-$row->item_discount;
	
			$taxAmout=$taxableAmount*$row->tax_rate/100;
	
			$totalItemValue = $totalItemValue+$itemTotalPrice;
			$totalDiscount=$totalDiscount+$row->item_discount;
			$totalTaxableAmt=$totalTaxableAmt+$taxableAmount;
			$totalTaxAmt=$totalTaxAmt+$taxAmout;
	
			//$tTaxAmt=$tTaxAmt+$row->item_tax;
		?>
		<tr>
			<td height="20" valign=middle align="center" class="normalbold sr-no" style="border-bottom-color: #FFF;"><b><?=$s ?></b></td>
			<td valign=middle align="center" class="normalbold part-no"  style="border-bottom-color: #FFF;border-right-color: black;"><b><?=$row->product_code ?></b></td>
			<td valign=middle align="center" class="normalbold description" style="border-bottom-color: #FFF;"><b><?=$row->product_name . ($row->variant ? ' (' . $row->variant . ')' : '') ?></b></td>
			<td valign=middle align="center" class="normalbold hsn-code" style="border-bottom-color: #FFF;"><b><?=($row->hsn_code) ? $row->hsn_code : '' ?></b></td>
			<td valign=middle align="center" class="normalbold qty" style="border-bottom-color: #FFF;"><b><?= $this->sma->formatQuantity($row->unit_quantity)  ?></b></td>
			<td valign=middle align="center" class="normalbold umo" style="border-bottom-color: #FFF;"><b><?=$row->product_unit_code ?></b></td>
			<td valign=middle align="center" class="normalbold rate" style="border-bottom-color: #FFF;"><b><?= $this->sma->formatMoney($row->real_unit_price); ?></b><!--b>
			<?= $row->unit_price != $row->real_unit_price && $row->item_discount > 0 ? '<del>' . $this->sma->formatMoney($row->real_unit_price) . '</del>' : ''; ?>
										<?= $this->sma->formatMoney($row->unit_price); ?></b--></td>
			<td valign=middle align="center" class="normalbold total-value " style="border-bottom-color: #FFF;"><b><?=$this->sma->formatMoney($itemTotalPrice) ?></b></td>
			<td valign=middle align="center" class="normalbold discount-rate" style="border-bottom-color: #FFF;"><b><?php
			if (strpos($row->discount,'%') !== false) {
				echo $row->discount;
			} ?></b></td>
			<td valign=middle align="center" class="normalbold discount-amt" style="border-bottom-color: #FFF;"><b><?= $this->sma->formatMoney($row->item_discount) ?></b></td>
			<td valign=middle align="center" class="normalbold tax-val" style="border-bottom-color: #FFF;"><b><?=$this->sma->formatMoney($taxableAmount) ?></b></td>
			<td valign=middle align="center" class="normalbold tax-rate" style="border-bottom-color: #FFF;"><b><?=$Settings->indian_gst ? $row->tax : $row->tax_code ?></b></td>
			<td valign=middle align="center" class="normalbold pamt" style="border-bottom-color: #FFF;"><b><?= $this->sma->formatMoney($taxAmout); ?></b></td>
			</tr>
			<?php $s++; endforeach;?>
			
			<tr>
				<td height="20" valign=middle align="center" class="normalbold"><b><br></b></td>
				<td valign=middle align="center" class="normalbold"><b></b></td>
				<td valign=middle align="center" class="normalbold"><b></b></td>
				<td valign=middle align="center" class="normalbold"><b></b></td>
				<td valign=middle align="center" class="normalbold"><b></b></td>
				<td valign=middle align="center" class="normalbold"><b></b></td>
				<td valign=middle align="center" class="normalbold"><b></b></td>
				<td valign=middle align="center" class="normalbold"><b></b></td>
				<td valign=middle align="center" class="normalbold"><b></b></td>
				<td valign=middle align="center" class="normalbold"><b></b></td>
				<td valign=middle align="center" class="normalbold"><b></b></td>
				<td valign=middle align="center" class="normalbold"><b></b></td>
				<td valign=middle align="center" class="normalbold"><b></b></td>
			</tr>


	<tr>
		<td height="20" valign=middle align="letf" class="normalbold" colspan="7" ><b>TOTAL</b></td>
		<td valign=middle align="center" class="normalbold"><b><?=$this->sma->formatMoney($totalItemValue) ?></b></td>
		<td valign=middle align="center" class="normalbold"><b><br></b></td>
		<td valign=middle align="center" class="normalbold"><b><?=$this->sma->formatMoney($totalDiscount) ?></b></td>
		<td valign=middle align="center" class="normalbold"><b><?=$this->sma->formatMoney($totalTaxableAmt) ?></b></td>
		<td valign=middle align="center" class="normalbold"><b><br></b></td>
		<td valign=middle align="center" class="normalbold"><b><?= $this->sma->formatMoney($totalTaxAmt); ?></b></td>
	</tr>
<?php $totalBeforeTax=$totalTaxableAmt; ?>

	<tr>
		<td height="20"  valign=middle align="letf" class="normalbold" colspan="8" style="border-bottom-color: #FFF;border-right-color: #FFF;"><b><br></b></td>
		<td valign=middle align="center" class="normalbold" colspan="4" style="border-bottom-color: #FFF; border-right-color: #FFF;"><b>Total Amount Before Tax</b></td>
		<td valign=middle align="center" class="normalbold" style="border-bottom-color: #FFF;border-left-color: #FFF;"><b> <?= $this->sma->formatMoney($totalBeforeTax); ?></b></td>
	</tr>
	<?php 
	/*echo '<pre>';
	print_r($inv);
	echo '</pre>'; */
		$cgst=$sgst=$igst=0;
	if($inv->cgst > 0 ):
		$cgst=$inv->cgst;//$totalBeforeTax-$totalBeforeTax*$inv->cgst;
	?>

	<tr>
		<td  height="20"  valign=middle align="letf" class="normalbold" colspan="8" style="border-bottom-color: #FFF;border-right-color: #FFF;"><b><br></b></td>
		<td valign=middle align="center" class="normalbold" colspan="4" style="border-bottom-color: #FFF;border-right-color: #FFF;"><b><?php echo lang('cgst'); ?></b></td>
		<td valign=middle align="center" class="normalbold" style="border-bottom-color: #FFF;border-left-color: #FFF;"><b><?=$this->sma->formatMoney($cgst) ?></b></td>
	</tr>
	<?php endif; ?>	
	<?php if($inv->sgst > 0): 
			$sgst=$inv->sgst;//$totalBeforeTax-$totalBeforeTax*$inv->sgst;
		?>

	<tr>
		<td  height="20"  valign=middle align="letf" class="normalbold" colspan="8" style="border-bottom-color: #FFF;border-right-color: #FFF;"><b><br></b></td>
		<td valign=middle align="center" class="normalbold" colspan="4" style="border-bottom-color: #FFF;border-right-color: #FFF;"><b><?php echo lang('sgst'); ?></b></td>
		<td valign=middle align="center" class="normalbold" style="border-bottom-color: #FFF;border-left-color: #FFF;"><b><?=$this->sma->formatMoney($sgst) ?></b></td>
	</tr>

	<?php endif; ?>	
	<?php if($inv->igst > 0):
				$igst=$inv->igst;//$totalBeforeTax-$totalBeforeTax*$inv->igst;
		?>
	<tr>
		<td  height="20"  valign=middle align="letf" class="normalbold" colspan="8" style="border-bottom-color: #FFF;border-right-color: #FFF;"><b><br></b></td>
		<td  valign=middle align="center" class="normalbold" colspan="4" style="border-bottom-color: #FFF;border-right-color: #FFF;"><b><?php echo lang('igst'); ?></b></td>
		<td valign=middle align="center" class="normalbold" style="border-bottom-color: #FFF;border-left-color: #FFF;"><b><?= $this->sma->formatMoney($igst) ?></b></td>
	</tr>
	<?php endif; ?>	
	<?php $totalTaxAm=$cgst+$sgst+$igst; 
	
		$grandTotal=$totalBeforeTax+$totalTaxAm;
	?>
	<tr>
		<td  height="20"  valign=middle align="letf" class="normalbold" colspan="8" style="border-bottom-color: #FFF;border-right-color: #FFF;"><b><br></b></td>
		<td  valign=middle align="center" class="normalbold" colspan="4" style="border-bottom-color: #FFF;border-right-color: #FFF;"><b>Total Tax Amount </b></td>
		<td valign=middle align="center" class="normalbold" style="border-bottom-color: #FFF;border-left-color: #FFF;"><b><?= $this->sma->formatMoney($totalTaxAm) ?></b></td>
	</tr>
	<tr>
		<td  height="20"  valign=middle align="letf" class="normalbold" colspan="8" style="border-bottom-color: #FFF;border-right-color: #FFF;"><b><br></b></td>
		<td  valign=middle align="center" class="normalbold" colspan="4" style="border-bottom-color: #FFF;border-right-color: #FFF;"><b>Grand Total</b></td>
		<td valign=middle align="center" class="normalbold" style="border-bottom-color: #FFF;border-left-color: #FFF;"><b><?= $this->sma->formatMoney($grandTotal) ?></b></td>
	</tr>
	<tr>
		<td  height="20"  valign=middle align="letf" class="normalbold" colspan="13" style="border-bottom-color: #FFF;"><b>In Words:</b></td>
	</tr>
	<?php if($totalTaxAm>0): ?>
	<tr>
		<td height="20"  valign=middle align="letf" class="normalbold" colspan="13" style="border-bottom-color: #FFF;"><b>Total Tax amount: <?=ucwords($this->sma->number2word($totalTaxAm)) ?></b></td>
	</tr>
	<?php endif; ?>
	<?php if($grandTotal>0): ?>
	<tr>
		<td height="20"  valign=middle align="letf" class="normalbold" colspan="13"><b>Total amount: <?=ucwords($this->sma->number2word($grandTotal)) ?>
		</b></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td  colspan=6 align="left" valign=top style="padding-bottom: 20px;"><br>
		</td>
		
		<td colspan=7 align="left" valign=top style="padding-bottom: 20px;">
			<table border="0" width="100%">
				<tr><td align="left" height="15" valign="middle" class="normalboldPlus"><u>For ,Sigtel Engineering</u></td></tr>
				<tr><td align="left" height="30" valign="middle" class="normalbold"></td></tr>
				<tr><td align="left" height="15" valign="middle" class="normalbold">Authorised Signatory</td></tr>
			</table>
		</td>
	</tr>
	
</table>
</body>
</html>
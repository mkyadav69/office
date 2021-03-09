<?php // echo "<pre>";print_r($quotation_info); echo "</pre>";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--[if !mso]><!-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chromatography</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800,700italic' rel='stylesheet' type='text/css'>
    <style type="text/css">
    /* Basics */
    body {
    margin: 0 !important;
    padding: 0;
    background-color: #ffffff;
    font-family: 'Open Sans', sans-serif;
}
table {
    border-spacing: 0;
    font-family: sans-serif;
    color: #333333;
}
td {
    padding: 0;
}
img {
    border: 0;
    max-width: 100%;
}
div[style*="margin: 16px 0"] { 
    margin:0 !important;
}
.wrapper {
    width: 100%;
    table-layout: fixed;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
}
.webkit {
    max-width:1000px;
    margin: 0 auto;
}
    .table-outer
    {
        max-width: 620px;
        width: 100%;
        margin:0 auto;
    }



    </style>
    <!--[if (gte mso 9)|(IE)]>
    <style type="text/css">
        table {border-collapse: collapse;}
    </style>
    <![endif]-->
</head>
<body style="background-color: #d6d6d6; color:#5c5c5c">
    <center class="wrapper">
        <div class="webkit">
            <table class="table-outer" align="center" style="background:#ffffff; max-width:1000px; width: 100%; margin:0 auto;">
              <tr style="background:#f1f1f1;">
                <td style="font-size:12px;color: #333333; background: #f1f1f1;padding:10px">
                    <img src="http://office.chromatographyworld.com/assets/images/logo.png" style="max-width: 200px" >
                  </td>
                 <td style="font-size:12px; color: #333333;background: #f1f1f1;padding:10px;">
                    <p style="margin: 0 !important;"> <Strong>Regd Add:</Strong> 217, 2nd Floor, Champaklal Industrial Estate, Sion East, Mumbai - 400022. India </p>           
                    <p style="margin: 0 !important;"> <strong style="color:#074e90;"> GSTN: 27AAGFC1217K1ZM</strong> | <strong>Land:</strong> 91-022-43159100/24082098/99  
                       <strong>Email:</strong> | sales@chromatographyworld.com </strong></p> 
                    <p style="margin: 0 !important;"> <strong>Bank Detail:</strong>Kotak Mahindra Bank |  Account No.4611234274 | IFSC :  KKBK0000644 </p>
                 </td>
             </tr>
            <tr>
                <td align="center" colspan="2" style="background:#0b91d5; color:#ffffff; padding:8px; font-size:13px;">Authorised For: Perkin Elmer, Macherey Nagel , E.S. Industries, Mitsubishi Chemical Corporation, G. L. Science - Inertcap , Sepax, Vigour, SAS Corporation, Qualisil</td>
            </tr>
               <tr style="background:#f1f1f1;">
                    <td colspan="2">
                        <table class="body" style="font-size:12px;  max-width:1100px; padding:0px 20px; width: 100%; background: #ffffff;">
                            <tr>
                                <td colspan="6" align="center" style="padding:5px;"><strong style="color: #800712; font-size:22px;">Quotation</strong></td>
                            </tr>

                            <tr style=" background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; border-top:1px solid #808080; padding:5px; border-right:1px solid #808080; border-bottom:1px solid #808080; color:#052390;"><strong>Company Name</strong></td>

                               <td colspan="4" style="border-top:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"> <?php echo $customer_info['st_com_name']; ?></td>
                                <td colspan="2" style="border-top:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Contact Person</strong></td>
                               
                                <td colspan="2" style="border-top:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo $customer_info['st_con_person1']; ?></td>

                                 
                            </tr>

                            <tr style="background: #f1f1f1;">

                                  <td style="border-left:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Address</strong></td>
                                <td colspan="8" style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;  ">
                                    <p style="margin: 0;">
                                        <?php echo $quotation_info['st_shiping_add']; ?>  
                                    </p>
                                </td>
                            </tr>
                              <!--<tr style="background: #f1f1f1;">

                              
                                <td colspan="7" style="border-left:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; font-size:14px;">
                                    <p style="margin: 0;">
                                       &nbsp;
                                    </p>
                                </td>
                            </tr>-->

                          
                            <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Country</strong></td>
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"> <?php echo "India"; ?></td>
                                
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>State</strong></td>
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo $quotation_info['st_shiping_state']; ?></td>

                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>City</strong></td>
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"> <?php echo $quotation_info['st_shiping_city']; ?></td>
                                
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Pincode</strong></td>
                                <td style="padding:5px;border-right:1px solid #808080; border-bottom:1px solid #808080;"><?php echo $quotation_info['st_shiping_pincode']; ?></span></td> 
                            </tr>

                             <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Landline with std</strong></td>

                               <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;">  

                               	<?php echo $quotation_info['st_landline']; ?>
                               </td>
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Mobile</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo $quotation_info['st_shipping_phone']; ?></td>

                                 <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Email Id</strong></td>
                               
                                <td colspan="3" style="padding:5px;border-right:1px solid #808080; border-bottom:1px solid #808080;"><?php echo $quotation_info['st_shipping_email']; ?></td> 
                            </tr>

                             <tr style="background: #f1f1f1;">
                                <td colspan="2"style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Quotation No. #</strong></td>

                               <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"> ---- </td>
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Quotation Date</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo  $quotation_info['dt_ref'];?></td>

                                 <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Enq. Ref.</strong></td>
                               
                                <td colspan="2" style="padding:5px;border-right:1px solid #808080; border-bottom:1px solid #808080;"><?php echo $quotation_info['st_enq_ref_number']; ?></td> 
                            </tr>

                    </table>

                </td>
            </tr>
              
              <tr style="background:#f1f1f1;">
                    <td colspan="2">
                        <table class="body" style=" font-size:12px; max-width:1200px; padding:10px 20px; width: 100%; background: #ffffff;">
                            <tr style="background: #f1f1f1; border-top:1px solid #808080;">
                                 <th style="border-left:1px solid #808080; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px; color:#052390;">Sr. No.</th>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Part No.</th>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Description</th>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">HSN Code</th>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Qty</th>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Price</th>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Disc</th>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Net Amount</th>
								<?php if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] != 'Maharashtra'){
											
								?>
                                <th colspan="2"  style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">IGST </th>
								<?php } else{ ?>
                                <th colspan="2" style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">SGST </th>
                                <th colspan="2" style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">CGST </th>
								<?php } ?>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Total</th>
                                <th  style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Delivery</th>
                            </tr>

                            <tr style="background: #f1f1f1;">
                                 <th style="border-left:1px solid #808080; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th style=" border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
								<?php if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] != 'Maharashtra'){
											
								?>
                                <th  style="color:#052390; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Rate </th>
                                <th style="color:#052390; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Amount </th>
								<?php } else{ ?>
                                <th  style="color:#052390; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Rate </th>
                                <th style="color:#052390; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Amount</th>
                                <th  style="color:#052390; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Rate </th>
                                <th style="color:#052390; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Amount</th>
								<?php } ?>
                                <th  style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th  style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                            </tr>
                           
							<?php
							$cnt = 1;
							$mh_gst_total = 0;
							$out_of_mh_gst_total = 0;
							$prod_unit_price_total = 0;
							$prod_net_amt_total = 0;
							foreach($quotation_details as $row_key => $row_val):
	
							$prod_unit_price_total += $row_val->fl_pro_unitprice;
							$prod_net_amt_total += $row_val->fl_net_price;
							?>
                            <tr style="background:#d7f1ec">
                            
                            <td align="center" style="border-top:1px solid #808080;border-left:1px solid #808080; border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $cnt; ?></td>

                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val->st_part_no; ?></td>

                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val->st_product_desc; ?></td>

                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val->stn_hsn_no; ?></td>

                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val->in_pro_qty; ?></td>

                            <td align="left"  style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">
							<?php   echo $currency." ".number_format($row_val->fl_pro_unitprice); ?></td>

                            <td align="right" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 2px;"><?php echo $row_val->fl_discount; ?> %</td>

                            <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $currency." ".number_format($row_val->fl_net_price); ?></td>
							<?php if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] != 'Maharashtra'){

							//$igst_amt_calculation = (($row_val['fl_net_price']*$row_val['in_pro_qty'])*($row_val['in_igst_rate']/100));
							$igst_amt_calculation = $row_val->fl_net_price*$row_val->in_igst_rate/100;
							
							$out_of_mh_gst_total +=$igst_amt_calculation;
							?>
                             <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo number_format($row_val->in_igst_rate); ?>%</td>
                             <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $currency." ".number_format($igst_amt_calculation); ?></td>
							<?php } else if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] == 'Maharashtra') {
								$igst_cgst_rate = $row_val->in_igst_rate / 2;
								//$gst_amt_calculation = (($row_val['fl_net_price']*$row_val['in_pro_qty'])*($igst_cgst_rate/100));
								$gst_amt_calculation = ($row_val->fl_net_price*$igst_cgst_rate/100);

								$mh_gst_total += $gst_amt_calculation;
							?>
                           <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo number_format($igst_cgst_rate); ?>%</td>
                           <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $currency." ".number_format($gst_amt_calculation); ?></td>

                            <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo number_format($igst_cgst_rate); ?>%</td>
                            <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $currency." ".number_format($gst_amt_calculation); ?></td>
							<?php } ?>
                            <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $currency." ".number_format($row_val->fl_row_total); ?></td>
                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val->in_pro_deli_period; ?></td>

                            </tr>
				<?php if(isset($row_val->prod_comments) && $row_val->prod_comments !=''){?>			
                             <tr style="background:#fff;">
                                <td colspan="16" style="border-left:1px solid #808080;"><p style="margin: 5px;"><b>Comments :</b><?php echo isset($row_val->prod_comments)?$row_val->prod_comments:''; ?></p></td>
                             </tr>
                                <?php }
                                        $cnt++;
                                        endforeach; ?>
							<!--
							<tr style="background:#d7f1ec">
                                <td align="center" style="border-left:1px solid #808080; border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>

                            <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">FP</td>

                            <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">Freight & Packing Charges</td>

                            <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>

                            <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>

                            <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>

                            <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">-</td>

                            <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>
							<?php if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] != 'Maharashtra'){
											
							?>
                             <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">18 %</td>
                             <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>
							<?php } else if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] == 'Maharashtra') {
									
							?>
                           <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">9%</td>
                           <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>

                            <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">9%</td>
                            <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>
							<?php } ?>

                            <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $quotation_info['fl_fleight_pack_charg']; ?></td>
                            <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>

                            </tr>
							-->

                            <tr style="background:#c0d8d3">
								<td align="center" style="border-left:1px solid #808080; border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>

								<td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>

								<td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong>Grand Total</strong></td>

								<td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>

								<td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>

								<td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $currency." ".number_format($prod_unit_price_total); ?></td>

								<td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>

								<td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $currency." ".number_format($prod_net_amt_total); ?></td>

								<td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>
								
								<?php if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] != 'Maharashtra'){ ?>

								<td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $currency." ".number_format($out_of_mh_gst_total); ?></td>

									<td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $currency." ".number_format($quotation_info['fl_nego_amt']); ?></td>
								<?php } else { ?> 
								<td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $currency." ".number_format($mh_gst_total); ?></td>
								<td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>
								<td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $currency." ".number_format($mh_gst_total); ?></td>
								<?php }?>
								

								
								<?php if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] == 'Maharashtra'){ ?>
								<td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $currency." ".number_format($quotation_info['fl_nego_amt']); ?></td>

								<td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>

								<?php }  else {?> 
								<td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>
								<?php } ?>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr  style="font-size: 12px;">
                    <td style="padding:0 0px;" colspan="2">
                        <table class="table-outer" align="center" style="background:#ffffff; max-width:1000px; width: 100%; margin:0 auto; padding: 5px 10px; border:1px solid #8c8c8c;">
                            <tr>
                                <td style="float: left; margin: 10px;">
                                    <strong>Terms & Conditions</strong>
								   <p>
									A)     Quotation is Valid for 30 days<br/>

									B)     Payment Terms : <?php if(isset($quotation_info['payment_turm'])) echo $quotation_info['payment_turm'];?><br/>

									C)     Comments : If any,.. this is optional</p>
								</td>  
								<td>
							<table class="table-outer" align="center" style="background:#ffffff; max-width:1000px; width: 100%; margin:0 auto; padding: 5px 20px;">
								<tr>
									<td>
									   
									</td>
									<td align="right" style="padding:0px 12px">
										 <strong>For Chromatography World</strong><br/>
										<strong>Quotation Made by:</strong>
										<p style="margin:0"><?php echo $preparing_by; ?></p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
                  </table>
                        <br/>
               </td>
            </tr>
                
                <tr  style="background:#c4d79b; font-size: 13px;">
                   <td align="center" colspan="2">
						<!--
                    <p style="margin: 0; padding:8px 5px;">Branch - Secunderabad:  Plot no 15/B, First floor, S.P. Road, Beside Anand theatre, Paigah Colony, Secunderabad - 500003. Phone No. +0244 54657476</p> 
					-->
					<?php  if(isset($BillAddress['stn_branch_add'])){  echo "CRM : ".$BillAddress['stn_branch_add']; } ?>
                   </td>
                </tr>
                <tr style="background:#002060;  font-size: 13px; color: #ffffff;">
                 <td align="center" colspan="2"><p style="margin: 0; padding:8px 5px;">We look Forward to your valuable Order! Thank You!</p></td>
               </tr>
            </table>
        </div>
    </center>
</body>
</html>

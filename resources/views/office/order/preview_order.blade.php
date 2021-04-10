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
</head>
<body style="background-color: #d6d6d6; color:#5c5c5c">
    <center class="wrapper">
        <div class="webkit">
            <table class="table-outer" align="center" style="background:#ffffff; max-width:1000px; width: 100%; margin:0 auto;">
               <tr style="background:#f1f1f1;">
                    <td>
                        <table class="body" style="font-size:12px;  max-width:1100px; padding:0px 20px; width: 100%; background: #ffffff;">
                            <tr>
							<td colspan="2"  style="padding:10px">
                                       <img src="{{asset('images/icon/cromo.png')}}" width="200">
                                </td>
                                <td colspan="6" align="" style="padding:5px;"><strong style="color: #800712;float:right; font-size:22px;padding: 30px;">Purchase Order</strong></td>
                            </tr>

                             <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong>Customer Order No. #</strong></td>

                               <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080;"><?php echo isset($result['customer_info']['order_no']) ? $result['customer_info']['order_no'] :''; ?></td>

                                <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong>Order Date</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080;"><<?php echo  date("d/m/Y", strtotime($result['customer_info']['order_date']));?></td>

                                 <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong>Quotation No.</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080; border-top:1px solid #808080;"><?php echo $result['order_info']['in_quot_num'] ?></td> 

                                <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong>GSTN No.</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080; border-top:1px solid #808080;"><?php echo isset($result['customer_info']['auto_pop_pincod'])? $result['customer_info']['auto_pop_pincod'] : ''; ?></td> 
                            </tr>

                            <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong> Order Ref No. #</strong></td>

                               <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080;"><?php echo $result['order_info']['st_enq_ref_number'] ?></td>

                                <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong> Date</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080;"><?php echo isset($result['customer_info']['order_date']) ? $result['customer_info']['order_date'] : ""; ?></td>

                                 <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong>Credit Terms</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080; border-top:1px solid #808080;"><?php $result['order_info']['payment_turm'] ?></td> 

                                <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong>Prefered Courier</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080; border-top:1px solid #808080;"><?php echo $result['customer_info']['courier']; ?></td> 
                            </tr>


                            <tr style=" background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; border-top:1px solid #808080; padding:5px; border-right:1px solid #808080; border-bottom:1px solid #808080; color:#052390;"><strong>Company Name</strong></td>

                               <td colspan="3" style="border-top:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"> <?php echo $result['customer_info']['st_com_name']; ?></td>
                                <td colspan="2" style="border-top:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Contact Person</strong></td>
                               
                                <td colspan="3" style="border-top:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo $result['customer_info']['st_com_name']; ?></td>

                                 
                            </tr>


                          
                            <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Billiing Address</strong></td>

                               <td colspan="5" style="padding:5px;  border-bottom:1px solid #808080;"> <?php if(isset($result['customer_info']['auto_pop_addr'])) {  echo $result['customer_info']['auto_pop_addr']; }?></td>

                               <td style="border-left:1px solid #808080; padding:5px;   border-bottom:1px solid #808080; color:#052390;"><strong>Pincode </strong></td>

                               <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong> <?php echo $result['customer_info']['auto_pop_pincod']; ?></strong></td>
                              
                            </tr>

                             <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Phone</strong></td>

                               <td colspan="2" style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;">  <?php echo $result['customer_info']['auto_pop_landline']; ?>
								</td>
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Mobile</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo isset($result['customer_info']['auto_pop_phone'])? $result['customer_info']['auto_pop_phone']:''; ?></td>

                                 <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Email Id</strong></td>
                               
                                <td  colspan="2" style="padding:5px;border-right:1px solid #808080; border-bottom:1px solid #808080;"><?php echo isset($result['customer_info']['auto_pop_email'])?$result['customer_info']['auto_pop_email']:''; ?></td> 
                            </tr>

                             <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Shipping Address</strong></td>

                            
                               <td colspan="5" style="padding:5px;  border-bottom:1px solid #808080;"><?php echo $result['order_info']['st_shiping_add']; ?></td>

                               <td style="border-left:1px solid #808080; padding:5px;   border-bottom:1px solid #808080; color:#052390;"><strong>Pincode </strong></td>

                               <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong> <?php echo $result['order_info']['st_shiping_pincode']; ?></strong></td>
                              
                            </tr>
							<tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Country </strong></td>

                               <td  colspan="2" style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;">  <?php echo "India";?>
								</td>
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>State</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo isset($result['order_info']['st_shiping_state'])?$result['order_info']['st_shiping_state']:''; ?></td>

                                 <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>City</strong></td>
                               
                                <td  colspan="2" style="padding:5px;border-right:1px solid #808080; border-bottom:1px solid #808080;"><?php echo isset($result['order_info']['st_shiping_city'])?$result['order_info']['st_shiping_city']:''; ?></td> 
                            </tr>
                             <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Phone </strong></td>

                               <td  colspan="2" style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;">  <?php echo $result['order_info']['shipping_lanline'];?>
								</td>
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Mobile</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo isset($result['order_info']['st_shipping_phone'])?$result['order_info']['st_shipping_phone']:''; ?></td>

                                 <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Email Id</strong></td>
                               
                                <td  colspan="2" style="padding:5px;border-right:1px solid #808080; border-bottom:1px solid #808080;"><?php echo isset($result['order_info']['st_ord_ship_email'])?$result['order_info']['st_shipping_email']:''; ?></td> 
                            </tr>

                            
                    </table>

                </td>
            </tr>
              
              <tr style="background:#f1f1f1;">
                    <td>
                        <table class="body" style=" font-size:12px; max-width:1200px; padding:10px 20px; width: 100%; background: #ffffff;">
                            <tr style="background: #f1f1f1; border-top:1px solid #808080;">
                                 <th style="border-left:1px solid #808080; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px; color:#052390;">Sr. No.</th>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Part No.</th>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Description</th>
								<!--
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">HSN Code</th> -->
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Qty</th>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">List</th>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Disc</th>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Net Amount</th>
								<?php if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] != 'Maharashtra'){
											
								?>
                                <th colspan="2"  style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">IGST </th>
								<?php
								}
								else
								{
								?>
                                <th colspan="2" style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">SGST </th>
                                <th colspan="2" style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">CGST </th>
								<?php
								}
								?>
                                <th style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Total</th>
                                <!--<th  style="color:#052390; border-top:1px solid #808080;border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Delivery</th>-->
                            </tr>

                            <tr style="background: #f1f1f1;">
                                 <th style="border-left:1px solid #808080; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th style=" border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
								<!--
                                <th style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th> -->
                                <th style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                                <th style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
								<?php if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] != 'Maharashtra'){
											
								?>
                                <th  style="color:#052390; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Rate </th>
                                <th style="color:#052390; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Amount </th>
								<?php
								}
								else
								{
								?>
                                <th  style="color:#052390; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Rate </th>
                                <th style="color:#052390; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Amount</th>
                                <th  style="color:#052390; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Rate </th>
                                <th style="color:#052390; border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">Amount</th>
								<?php
								}
								?>
                                <th  style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>
                               <!-- <th  style="border-right:1px solid #808080; border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</th>-->
                            </tr>
                           
                        <?php
							$cnt = 1;
							
							$mh_gst_total = 0;
							$out_of_mh_gst_total = 0;
							$prod_unit_price_total = 0;
							$prod_net_amt_total = 0;
							$prod_qty_total = 0;

							// echo "<pre>";print_r($order_details);echo "</pre>";exit; 
							foreach($result['order_details'] as $row_key => $row_val):
							$prod_unit_price_total += $row_val['fl_pro_unitprice'];
							$prod_net_amt_total += $row_val['fl_net_price'];
							$prod_qty_total += $row_val['in_pro_qty'];

							
							
						?>
                            <tr style="background:#d7f1ec">
                                <td align="center" style="border-top:1px solid #808080;border-left:1px solid #808080; border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $cnt; ?></td>

                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['st_part_no']; ?></td>

                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['st_product_desc']; ?></td>
							
<!--
                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['stn_hsn_no']; ?></td>
-->
                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['in_pro_qty']; ?></td>

                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $result['currency']." ".number_format($row_val['fl_pro_unitprice']);?></td>

                            <td align="right" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['fl_discount']; ?>%</td>

                            <td align="right" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $result['currency']." ".number_format($row_val['fl_net_price']);?></td>
							<?php if(isset($result['customer_info']['auto_pop_state']) and $result['customer_info']['auto_pop_state'] != 'Maharashtra'){

							$igst_amt_calculation = $row_val['fl_net_price']*$row_val['in_igst_rate']/100;
							
							$out_of_mh_gst_total +=$igst_amt_calculation;
											
							?>
                             <td align="right" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $result['currency']." ".number_format($row_val['in_igst_rate']); ?>%</td>
                             <td align="right" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $result['currency']." ".number_format($igst_amt_calculation); ?></td>
							<?php
							}
							else
							{
								$igst_cgst_rate = $row_val['in_igst_rate'] / 2;
								//$gst_amt_calculation = (($row_val['fl_net_price']*$row_val['in_pro_qty'])*($igst_cgst_rate/100));
								$gst_amt_calculation = ($row_val['fl_net_price']*$igst_cgst_rate/100);

								$mh_gst_total += $gst_amt_calculation;
							?>

                           <td align="right" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $igst_cgst_rate; ?>%</td>
                           <td align="right" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $result['currency']." ".number_format($gst_amt_calculation); ?></td>

                            <td align="right" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $igst_cgst_rate; ?>%</td>
                            <td align="right" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $result['currency']." ".number_format($gst_amt_calculation); ?></td>
							<?php
							}
							?>
                            <td align="right" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $result['currency']." ".number_format($row_val['fl_row_total']);?></td>
                           <!-- <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">-</td>-->

                            </tr>
							<!--
                             <tr style="background:#e6eaed;">
                                <td colspan="16" style="border-left:1px solid #808080;"><p style="margin: 5px;">&nbsp;<i>Comments section comes up here, you can write comments</i></p></td>
                             </tr>
-->
						<?php 
							$cnt++;
							endforeach;
						?>

                            <tr style="background:#c0d8d3">
                                 <td align="center" style="border-left:1px solid #808080; border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>

                            <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>

                            <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong>Grand Total</strong></td>
<!--
                            <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td> -->

                            <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong><?php echo $prod_qty_total;?></strong></td>

                            <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $result['currency']." ".number_format($prod_unit_price_total); ?></td>

                            <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>

                            <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong><?php echo $result['currency']." ".number_format($prod_net_amt_total); ?></strong></td>
							<?php if(isset($result['customer_info']['auto_pop_state']) and $result['customer_info']['auto_pop_state'] != 'Maharashtra'){
											
							?>
                             <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong>IGST</strong></td>
                             <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><Strong><?php echo $result['currency']." ".number_format($out_of_mh_gst_total); ?></Strong></td>
							<?php
							 }
							else
							{
						   ?>
                           <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong>SGST</strong></td>
                           <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong><?php echo $result['currency']." ".number_format($mh_gst_total); ?></strong></td>
						   

                            <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong>CGST</strong></td>
                            <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong><?php echo $result['currency']." ".number_format($mh_gst_total); ?></strong></td>
							<?php } ?>
                            <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong><?php echo $result['currency']." ".number_format($result['order_info']['fl_nego_amt']);?></strong></td>
                           <!-- <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">-</td>-->

                            </tr>
                        </table>
                    </td>
                </tr>
             
            </table>
        </div>
    </center>
</body>
</html>
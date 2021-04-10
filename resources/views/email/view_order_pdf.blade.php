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
            <table class="table-outer" align="center" style="page-break-inside: avoid;background:#ffffff; max-width:1000px; width: 100%; margin:0 auto;">
             
                <!--<tr style="background:#f1f1f1;">
                    <td>
                        <table class="header" style="font-size:12px; max-width:1000px; padding:0; width: 100%; background: #f1f1f1;">
                            <tr>
                                 <td rowspan="2"  style="padding:15px">
                                       <img src="http://office.chromatographyworld.com/assets/images/logo.png" width="200">
                                </td>
                                <td>
                                        <p style="color:#333333;"><Strong>Regd Add:</Strong> 217, 2nd Floor, Champaklal Industrial Estate, Sion East, Mumbai - 400022. India     &nbsp;&nbsp;   &nbsp;&nbsp;
                                    <strong style="color:#074e90;"> GSTN No. 27AAGFC1217K1ZM</strong>
                                        </p>
                                </td>
                                
                               
                            </tr>
                            <tr>
                                <td colspan="2" align="center" ><strong style="color:#074e90;">
                                     <strong>Call:</strong> 91-022-43159100/24082098/99 &nbsp;&nbsp;&nbsp;&nbsp;

                                      <strong>Email:</strong> sales@chromatographyworld.com  &nbsp;&nbsp;
                                www.chromatographyworld.com</strong> &nbsp;&nbsp;  &nbsp;&nbsp;
                                    <p style="color:#333333;"><strong>Bank Name:</strong> Kotak Mahindra Bank  &nbsp;&nbsp; &nbsp;&nbsp;
                        <strong>Branch:</strong>  Matunga  &nbsp;&nbsp; &nbsp;&nbsp;
                              
                                    <strong>IFSC Code:</strong>    KKBK0000644 &nbsp;&nbsp; &nbsp;&nbsp;
                                <strong>Current A/C:</strong> 4611234274</p>
                                 </td>
                            </tr>
                            <tr>
                                <td align="center" colspan="2" style="background:#0b91d5; color:#ffffff; padding:8px; font-size:13px;">Authorised For: Perkin Elmer, Macherey Nagel , E.S. Industries, Mitsubishi Chemical Corporation, G. L. Science - Inertcap , Sepax, Vigour, SAS Corporation, Qualisil</td>
                            </tr>
                           
                        </table>
                    </td>
                </tr>-->
              

               <tr style="background:#f1f1f1;">
                    <td>
                        <table class="body" style="font-size:12px;  max-width:1100px; padding:0px 20px; width: 100%; background: #ffffff;">
							<tr>
								<td colspan="2"  style="padding:15px">
                                       <img src="http://office.chromatographyworld.com/assets/images/logo.png" width="200">
                                </td>
							
                                <td colspan="6" align="" style="padding:5px;"><strong style="color: #800712;float:right; font-size:22px;padding: 30px;">Purchase Order</strong></td>
                            </tr>

                             <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong>Customer Order No. #</strong></td>

                               <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080;"><?php echo $order_info['st_cust_order_num']; ?></td>

                                <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong>Order Date</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080;"><?php echo  date("d/m/Y", strtotime($order_info['dt_cust_order_date']));?></td>

                                 <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong>Quotation No.</strong></td>
                               
                                 <td style="padding:5px;border-right:1px solid #808080; border-top:1px solid #808080;"><?php echo $order_info['in_qoute_uniqu_id'] ?></td> 

                                <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong>GSTN No.</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080; border-top:1px solid #808080;"><?php echo isset($customer_info['cust_pin_no'])?$customer_info['cust_pin_no']:''; ?></td> 
                            </tr>

                            <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong> Order Ref No. #</strong></td>

                               <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080;"><?php echo $order_info['in_uniq_order_id'] ?></td>

                                <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong> Date</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080;"><?php echo isset($orderCreateDate) ? $orderCreateDate : ""; 
                                //date("d/m/Y");?></td>

                                 <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong>Credit Terms</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080; border-top:1px solid #808080;"><?php echo $order_info['st_pay_turm']; ?></td> 

                                <td style="padding:5px;border-right:1px solid #808080;  border-top:1px solid #808080; color:#052390;"><strong>Prefered Courier</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080; border-top:1px solid #808080;"><?php echo $order_info['st_courier_option']; ?></td> 
                            </tr>


                            <tr style=" background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; border-top:1px solid #808080; padding:5px; border-right:1px solid #808080; border-bottom:1px solid #808080; color:#052390;"><strong>Company Name</strong></td>

                               <td colspan="3" style="border-top:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"> <?php echo $customer_info['st_com_name']; ?></td>
                                <td colspan="2" style="border-top:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Contact Person</strong></td>
                               
                                <td colspan="3" style="border-top:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo $customer_info['st_con_person1']; ?></td>

                                 
                            </tr>


                          <?php /* Billiing Address start here*/ ?>
                            <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Billiing Address</strong></td>

                               <td colspan="5" style="padding:5px;  border-bottom:1px solid #808080;"> <?php if(isset($customer_info['st_com_address'])) {  echo $customer_info['st_com_address']; }?></td>

                               <td style="border-left:1px solid #808080; padding:5px;   border-bottom:1px solid #808080; color:#052390;"><strong>Pincode </strong></td>

                               <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"> <?php echo $customer_info['in_pincode']; ?></td>
                              
                            </tr>

                             <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Phone</strong></td>

                               <td colspan="2" style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;">  <?php echo $customer_info['st_cust_mobile'];?></td>
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Mobile</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo isset($customer_info['st_con_person1_mobile'])?$customer_info['st_con_person1_mobile']:''; ?></td>

                                 <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Email Id</strong></td>
                               
                                <td  colspan="2" style="padding:5px;border-right:1px solid #808080; border-bottom:1px solid #808080;"><?php echo $customer_info['st_con_person1_email']; ?></td> 
                            </tr>
							<?php 
							/* Billiing Address end here */
							
							/* Shiping Address start here*/ ?>
                             <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Shipping Address</strong></td>

                            
                               <td colspan="5" style="padding:5px;  border-bottom:1px solid #808080;"><?php echo $order_info['st_ord_ship_adds']; ?></td>

                               <td style="border-left:1px solid #808080; padding:5px;   border-bottom:1px solid #808080; color:#052390;"><strong>Pincode </strong></td>

                               <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><?php echo $order_info['st_ord_ship_pincode']; ?></td>
                              
                            </tr>
							<tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Country </strong></td>

                               <td  colspan="2" style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;">  <?php echo "India";?>
								</td>
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>State</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo isset($order_info['st_ord_ship_state'])?$order_info['st_ord_ship_state']:''; ?></td>

                                 <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>City</strong></td>
                               
                                <td  colspan="2" style="padding:5px;border-right:1px solid #808080; border-bottom:1px solid #808080;"><?php echo isset($order_info['st_ord_ship_city'])?$order_info['st_ord_ship_city']:''; ?></td> 
                            </tr>
                             <tr style="background: #f1f1f1;">
                                <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Lanline </strong></td>

                               <td  colspan="2" style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;">  <?php echo $order_info['st_landline'];?></td>
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Mobile</strong></td>
                               
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo $order_info['in_ord_ship_tel'];?></td>

                                 <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>Email Id</strong></td>
                               
                                <td  colspan="2" style="padding:5px;border-right:1px solid #808080; border-bottom:1px solid #808080;"><?php echo $order_info['st_ord_ship_email']; ?></td> 
                            </tr>
							<?php 
							/* Shiping Address end here */ ?>
                            
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
								<?php if(isset($customer_info['st_cust_state']) and $customer_info['st_cust_state'] != 'Maharashtra'){
											
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
								<?php if(isset($customer_info['st_cust_state']) and $customer_info['st_cust_state'] != 'Maharashtra'){
											
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
							foreach($order_details as $row_key => $row_val):
							$prod_unit_price_total += $row_val['flt_ord_pro_price'];
							$prod_net_amt_total += $row_val['flt_ord_pro_net_price'];
							$prod_qty_total += $row_val['in_ord_pro_qty'];

							
							
						?>
                            <tr style="background:#d7f1ec">
                                <td align="center" style="border-top:1px solid #808080;border-left:1px solid #808080; border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $cnt; ?></td>

                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['st_part_no']; ?></td>

                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['in_ord_pro_desc']; ?></td>
							
<!--
                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['st_hsn_no']; ?></td>
-->
                            <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><?php echo $row_val['in_ord_pro_qty']; ?></td>

                            <td   style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><?php echo $this->common_function->currencyCodes[$order_info['st_currency_applied']]." ".number_format($row_val['flt_ord_pro_price']);?></td>

                            <td align="right" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['flt_ord_pro_disct']; ?>%</td>

                            <td   style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><?php echo $this->common_function->currencyCodes[$order_info['st_currency_applied']]." ".number_format($row_val['flt_ord_pro_net_price']);?></td>
							<?php if(isset($customer_info['st_cust_state']) and $customer_info['st_cust_state'] != 'Maharashtra'){

							$igst_amt_calculation = $row_val['flt_ord_pro_net_price']*$row_val['in_igst_rate']/100;
							
							$out_of_mh_gst_total +=$igst_amt_calculation;
											
							?>
                             <td  style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['in_igst_rate']; ?>%</td>
                             <td   style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><?php echo $igst_amt_calculation; ?></td>
							<?php
							}
							else
							{
								$igst_cgst_rate = $row_val['in_igst_rate'] / 2;
								//$gst_amt_calculation = (($row_val['fl_net_price']*$row_val['in_pro_qty'])*($igst_cgst_rate/100));
								$gst_amt_calculation = ($row_val['flt_ord_pro_net_price']*$igst_cgst_rate/100);

								$mh_gst_total += $gst_amt_calculation;
							?>

                           <td  style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $igst_cgst_rate; ?>%</td>
                           <td  style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><?php echo $this->common_function->currencyCodes[$order_info['st_currency_applied']]." ".number_format($gst_amt_calculation); ?></td>

                            <td  style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $igst_cgst_rate; ?>%</td>
                            <td  style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><?php echo $this->common_function->currencyCodes[$order_info['st_currency_applied']]." ".number_format($gst_amt_calculation); ?></td>
							<?php
							}
							?>
                            <td  style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><?php echo $this->common_function->currencyCodes[$order_info['st_currency_applied']]." ".number_format($row_val['flt_ord_pro_row_total']);?></td>
                            <!--<td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">-</td>
-->
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

                            <td  style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><strong><?php echo $prod_qty_total;?></strong></td>

                            <td  style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><?php echo $this->common_function->currencyCodes[$order_info['st_currency_applied']]." ".number_format($prod_unit_price_total); ?></td>

                            <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>

                            <td  style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><strong><?php echo $this->common_function->currencyCodes[$order_info['st_currency_applied']]." ".number_format($prod_net_amt_total); ?></strong></td>
							<?php if(isset($customer_info['st_cust_state']) and $customer_info['st_cust_state'] != 'Maharashtra'){
											
							?>
                             <td  style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong>IGST</strong></td>
                             <td  style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><Strong><?php echo $this->common_function->currencyCodes[$order_info['st_currency_applied']]." ".number_format($out_of_mh_gst_total); ?></Strong></td>
							<?php
							 }
							else
							{
						   ?>
                           <td  style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong>SGST</strong></td>
                           <td  style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><strong><?php echo $this->common_function->currencyCodes[$order_info['st_currency_applied']]." ".number_format($mh_gst_total); ?></strong></td>
						   

                            <td  style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong>CGST</strong></td>
                            <td  style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong><?php echo $this->common_function->currencyCodes[$order_info['st_currency_applied']]." ".number_format($mh_gst_total); ?></strong></td>
							<?php } ?>
                            <td  style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;text-align: right;"><strong><?php echo $this->common_function->currencyCodes[$order_info['st_currency_applied']]." ".number_format($order_info['flt_ord_total']);?></strong></td>
                            <!--<td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">-</td>-->

                            </tr>
                        </table>
                    </td>
                </tr>
              <?php   /*<tr  style="font-size: 13px;">
                    <td style="padding:0 20px;">
                        <table class="table-outer" align="center" style="background:#ffffff; max-width:1000px; width: 100%; margin:0 auto; padding: 5px 10px; border:1px solid #8c8c8c;">
                            <tr>
                                <td>
                                    <strong>Terms & Conditions</strong>
                       <p>
                        A)     Quotation is Valid for 30 days<br/>

                        B)      Payment Terms : Advance Against Proforma / PDC / 30 Days / 45 Days / 60 Days / 75 Days / 90 Days<br/>

                        C)      Comments : If any,.. this is optional</p>
                    </td>   
                    </tr>
                        </table>
                        <br/>
                    </td>
                </tr>*/ ?>
                <tr>
                    <td>
                         <table class="table-outer" align="center" style="background:#ffffff; max-width:1000px; width: 100%; margin:0 auto; padding: 5px 20px;">
                            <tr>
                                <td>
                                   
                                </td>
                                <td align="right">
                                	 <strong>For Chromatography World</strong><br/>
                                    <strong>Authorized signatory:</strong>
                                    <p style="margin:0"><?php if(isset($preparing_by)) { echo $preparing_by;}?></p>
                                </td>
                            </tr>
                         </table>
                    </td>
                </tr>
                <tr  style="background:#c4d79b; font-size: 13px;">
                   <td align="center">

                    <p style="margin: 0; padding:8px 5px;"><?php  if(isset($BillAddress)){  echo "CRM : ".$BillAddress; } ?></p>
                   </td>
                </tr>
               <!-- <tr style="background:#002060;  font-size: 13px; color: #ffffff;">
                 <td align="center"><p style="margin: 0; padding:8px 5px;color: #ffffff;">We look Forward to your valuable Order! Thank You!</p></td>
              </tr-->
            </table>
        </div>
    </center>
</body>
</html>

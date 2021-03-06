<div class="row  form-group">
    <div class="login-logo col-3">
        <a href="#">
            <img src="{{asset('images/icon/cromo.png')}}" alt="CoolAdmin">
        </a>
    </div>
    <div class="col-9">
        <p style="margin: 0 !important;"> <Strong>Regd Add : </Strong> 217, 2nd Floor, Champaklal Industrial Estate, Sion East, Mumbai - 400022. India </p>           
        <p style="margin: 0 !important;"> <strong style="color:#074e90;"> GSTN: 27AAGFC1217K1ZM</strong></p>
        <p style="margin: 0 !important;"> <strong> Land : </strong>91-022-43159100/24082098/99</p>
        <p style="margin: 0 !important;"> <strong> Email : </strong>sales@chromatographyworld.com</p>
        <p style="margin: 0 !important;"> <strong>Bank Detail : </strong>Kotak Mahindra Bank <strong>,</strong>  Account No.4611234274 <strong>,</strong> IFSC :  KKBK0000644 </p>
        <p></p>
        <p  align="center" colspan="2" style="background:#0b91d5; color:#ffffff; padding:8px; font-size:13px;"><strog><b>Authorised For : </b></strong> Perkin Elmer, Macherey Nagel , E.S. Industries, Mitsubishi Chemical Corporation, G. L. Science - Inertcap , Sepax, Vigour, SAS Corporation, Qualisil</p>
    </div>
</div>
<div class="row  form-group">
    <div class="table--no-card m-b-30">
        <div class="table--no-card m-b-30">
            <table class="table table-borderless table-striped table-earning">
                <tr>
                        <td>
                            <table class="table table-borderless table-striped table-earning">
                                <tr style="background: #f1f1f1;">
                                    <td style="border-left:1px solid #808080; border-top:1px solid #808080; padding:5px; border-right:1px solid #808080; border-bottom:1px solid #808080; color:#052390;"><strong >Company Name</strong></td>
                                <td colspan="4" style="border-top:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"> <?php echo $customer_info['st_com_name']; ?></td>
                                    <td colspan="2" style="border-top:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong >Contact Person</strong></td>
                                    <td colspan="2" style="border-top:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo $customer_info['auto_pop_cust_name']; ?></td>
                                </tr>

                                <tr style="background: #f1f1f1;">
                                    <td style="border-left:1px solid #808080; padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong >Address</strong></td>
                                    <td colspan="8" style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;  ">
                                        <p style="margin: 0;">
                                            <?php echo $quotation_info['st_shiping_add']; ?>  
                                        </p>
                                    </td>
                                </tr>
                                <tr style="background: #f1f1f1;">
                                    <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong >Country</strong></td>
                                    <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"> <?php echo "India"; ?></td>
                                    
                                    <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong >State</strong></td>
                                    <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo $quotation_info['st_shiping_state']; ?></td>
                                    <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong>City</strong></td>
                                    <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"> <?php echo $quotation_info['st_shiping_city']; ?></td>
                                    <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong >Pincode</strong></td>
                                    <td style="padding:5px;border-right:1px solid #808080; border-bottom:1px solid #808080;"><?php echo $quotation_info['st_shiping_pincode']; ?></span></td> 
                                </tr>
                                <tr style="background: #f1f1f1;">
                                    <td style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong >Landline with std</strong></td>
                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;">  
                                    <?php echo $quotation_info['st_landline']; ?>
                                </td>
                                    <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong >Mobile</strong></td>
                                    <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo $quotation_info['st_shipping_phone']; ?></td>
                                    <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong >Email Id</strong></td>
                                    <td colspan="3" style="padding:5px;border-right:1px solid #808080; border-bottom:1px solid #808080;"><?php echo $quotation_info['st_shipping_email']; ?></td> 
                                </tr>
                                <tr style="background: #f1f1f1;">
                                    <td colspan="2"style="border-left:1px solid #808080; padding:5px; border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong >Quotation No. #</strong></td>

                                <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"> ---- </td>
                                    <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong >Quotation Date</strong></td>
                                    <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080;"><?php echo  $quotation_info['dt_ref'];?></td>
                                    <td style="padding:5px;border-right:1px solid #808080;  border-bottom:1px solid #808080; color:#052390;"><strong >Enq. Ref.</strong></td>
                                    <td colspan="2" style="padding:5px;border-right:1px solid #808080; border-bottom:1px solid #808080;"><?php echo $quotation_info['st_enq_ref_number']; ?></td> 
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-borderless table-striped table-earning">
                                <tr style="background: #f1f1f1;">
                                    <th style="border-left:1px solid #808080; border-top:1px solid #808080; padding:5px; border-right:1px solid #808080; border-bottom:1px solid #808080; color:#052390;"><strong tyle="color: brown">Sr. No.</strong></th>
                                    <th style="border-left:1px solid #808080; border-top:1px solid #808080; padding:5px; border-right:1px solid #808080; border-bottom:1px solid #808080; color:#052390;"><strong tyle="color: brown">Part No.</strong></th>
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
                                        $prod_unit_price_total += $row_val['fl_pro_unitprice'];
                                        $prod_net_amt_total += $row_val['fl_net_price'];
                                ?>
                                <tr style="background: #f1f1f1;">
                                    <td align="center" style="border-top:1px solid #808080;border-left:1px solid #808080; border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $cnt; ?></td>
                                    <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['st_part_no']; ?></td>
                                    <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['st_product_desc']; ?></td>
                                    <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['stn_hsn_no']; ?></td>
                                    <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['in_pro_qty']; ?></td>
                                    <td align="left"  style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">
                                    <?php   echo "rrrrrr"." ".number_format($row_val['fl_pro_unitprice']); ?></td>
                                    <td align="right" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 2px;"><?php echo $row_val['fl_discount']; ?> %</td>
                                    <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo "rrrrrr"." ".number_format($row_val['fl_net_price']); ?></td>
                                    <?php if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] != 'Maharashtra'){
                                    $igst_amt_calculation = $row_val['fl_net_price']*$row_val['in_igst_rate']/100;
                                    $out_of_mh_gst_total +=$igst_amt_calculation;
                                    ?>
                                    <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo number_format($row_val['in_igst_rate']); ?>%</td>
                                    <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo "rrrrrr"." ".number_format($igst_amt_calculation); ?></td>
                                    <?php } else if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] == 'Maharashtra') {
                                        $igst_cgst_rate = $row_val['in_igst_rate'] / 2;
                                        $gst_amt_calculation = ($row_val['fl_net_price']*$igst_cgst_rate/100);

                                        $mh_gst_total += $gst_amt_calculation;
                                    ?>
                                    <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo number_format($igst_cgst_rate); ?>%</td>
                                    <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo "rrrrrr"." ".number_format($gst_amt_calculation); ?></td>

                                    <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo number_format($igst_cgst_rate); ?>%</td>
                                    <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo "rrrrrr"." ".number_format($gst_amt_calculation); ?></td>
                                    <?php } ?>
                                    <td align="left" style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo "rrrrrr"." ".number_format($row_val['fl_row_total']); ?></td>
                                    <td style="border-top:1px solid #808080;border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo $row_val['in_pro_deli_period']; ?></td>

                                </tr>
                                <?php if(isset($row_val['prod_comments']) && $row_val['prod_comments'] !=''){?>			
                                <tr style="background:#fff;">
                                    <td colspan="16" style="border-left:1px solid #808080;"><p style="margin: 5px;"><b>Comments :</b><?php echo isset($row_val['prod_comments'])?$row_val['prod_comments']:''; ?></p></td>
                                </tr>
                                    <?php }
                                            $cnt++;
                                            endforeach; ?>

                                <tr style="background: #f1f1f1;">
                                    <td align="center" style="border-left:1px solid #808080; border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>
                                    <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"></td>
                                    <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><strong>Grand Total</strong></td>
                                    <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>
                                    <td style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>
                                    <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo "rrr".number_format($prod_unit_price_total); ?></td>
                                    <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>
                                    <td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo "rrr".number_format($prod_net_amt_total); ?></td>
                                    <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>
                                    <?php if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] != 'Maharashtra'){ ?>
                                    <td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo "rrr".number_format($out_of_mh_gst_total); ?></td>
                                        <td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo "rrr".number_format($quotation_info['fl_nego_amt']); ?></td>
                                    <?php } else { ?> 
                                    <td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo "rr".number_format($mh_gst_total); ?></td>
                                    <td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>
                                    <td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo "rr"." ".number_format($mh_gst_total); ?></td>
                                    <?php }?>
                                    <?php if(isset($customer_info['auto_pop_state']) and $customer_info['auto_pop_state'] == 'Maharashtra'){ ?>
                                    <td align="left" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;"><?php echo "rr".number_format($quotation_info['fl_nego_amt']); ?></td>
                                    <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>
                                    <?php }  else {?> 
                                    <td align="right" style="border-right:1px solid #808080;border-bottom:1px solid #808080;padding: 10px 5px;">&nbsp;</td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 0px;" colspan="2">
                            <table class="table table-borderless table-striped table-earning">
                                <tr>
                                    <td style="float: left; margin: 10px;">
                                        <strong>Terms & Conditions</strong>
                                    <p>
                                        A)     Quotation is Valid for 30 days<br/>

                                        B)     Payment Terms : <?php if(isset($quotation_info['payment_turm'])) echo $quotation_info['payment_turm'];?><br/>

                                        C)     Comments : If any,.. this is optional</p>
                                    </td>  
                                    <td>
                                    <table class="table table-borderless table-striped table-earning">
                                        <tr>
                                            <td>
                                            
                                            </td>
                                            <td align="right" style="padding:0px 12px">
                                                <strong>For Chromatography World</strong><br/>
                                                <strong>Quotation Made by:</strong>
                                                <p style="margin:0"><?php echo $customer_info['preparing_by']; ?></p>
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
                    <?php  if(isset($BillAddress)){  echo "CRM : ".$BillAddress; } ?>
                    </td>
                </tr>
                <tr style="background:#002060;  font-size: 13px; color: #ffffff;">
                    <td align="center" colspan="2"><p style="margin: 0; padding:8px 5px;">We look Forward to your valuable Order! Thank You!</p></td>
                </tr>
                </table>
        </div>
    </div>
</div>
                        


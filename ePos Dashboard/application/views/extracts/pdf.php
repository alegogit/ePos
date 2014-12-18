<?php                                                        
    $filename = date("Y-m-d")."_".trim($this->extracts->get_restaurant_name($rest_id))."_data.pdf";
    header('Content-Description: File Transfer');
    header("Content-type: application/pdf"); 
    header('Content-type: application/octet-stream');
    header("Content-Disposition: attachment; filename=".$filename);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    ob_start();
    ob_flush();
    //header("Expires: 0");
    $result = $this->extracts->get_orders_data(date('Y-m-d', strtotime($_GET['startdate'])),date('Y-m-d', strtotime($_GET['enddate'])),$_GET['rest_id']); 
    //$output = $result[0]."\n";
    foreach($result[2] as $row){
      //$output .= $row->ORDER_NUMBER."\t".$row->MENU_NAME."\t".$row->PRICE."\t";
      //$output .= $row->QUANTITY."\t".$row->KITCHEN_NOTE."\t".$row->ITEM_VOID."\t".$row->ITEM_VOID_REASON."\t".$row->CUSTOMER_NAME."\t".$row->STARTED."\t".$row->ENDED."\t";
      //$output .= $row->NO_OF_GUEST."\t".$row->TOTAL_AMOUNT."\t".$row->PAID_AMOUNT."\t".$row->CURRENCY."\t".$row->PAYMENT_METHOD."\t".$row->TIP."\t".$row->DISCOUNT."\t";
      //$output .= $row->ORDER_VOID."\t".$row->ORDER_VOID_REASON."\t".$row->RESTAURANT_NAME."\t".$row->ORDER_CREATED_DATE."\t".$row->ORDER_LAST_UPDATED_DATE."\t".$row->ORDER_LAST_UPDATED_BY."\t";
      //$output .= "\n";
    }
    //print $output;
    echo "eek";
    //print $this->extracts->get_orders_data(date('Y-m-d', strtotime($_GET['startdate'])),date('Y-m-d', strtotime($_GET['enddate'])),$_GET['rest_id']); 
?>
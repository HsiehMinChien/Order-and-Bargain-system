<!DOCTYPE>
<html>
<head><title>Customer Reply Order Done (DEMO System)</title>
</head>
<body>
<?php

require('config.php');
$ticket = $_POST['P_order'];
$amount = $_POST['P_amount'];
$total_price = $_POST['P_total_price'];
$comment = $_POST['P_comment'];
$status = $_POST['status'];
$title = array("Order or not" ,"Product Name" ,"Product Description" ,"Quantity to Order" ,"Price" ,"Total Price" ,"Comment" ,"Creator" , "Editor" , "Create/Modify Time" );
$check_email_take_action = 0;
$reply_order = 0;

$con = mysql_connect($db_host, $db_user, $db_pass);

if (!$con) {
    die('Could not connect:'.mysql_error());
} 

mysql_select_db($db_name, $con);

//Get email of current user.
$guid = $_COOKIE['session_id'];
$query1 = "SELECT email FROM ".$tb_name." WHERE guid = '".$guid."'";
$result1 = mysql_query($query1, $con) or die('Error in query2');

if ( mysql_num_rows($result1) ) {
    $data1 = mysql_fetch_row($result1);
    $email = $data1[0];
    $check_email_take_action = 1;
} else {
    echo "<h2>System cannot know who you are.</h2>";
    echo "<h2>Please try to re-login system</h2>";
}

if ( $check_email_take_action == 1 ) {

    echo "<p>The Order Handle Page</p>";

    // Get order info
    $query2 = "SELECT * FROM ".$tb_name2." WHERE userid=".$ticket;
    $result2 = mysql_query($query2, $con) or die('Error in query1');

    if( !$result2 ) {   
        die('Could not connect:'.mysql_error());
    } else {
        $data2 = mysql_fetch_row($result2);
    }

    // Get products info
    $query = "SELECT * FROM products WHERE userid=".$data2[3];
    $result = mysql_query($query, $con) or die('Error in query');

    if( !$result ) {   
        die('Could not connect:'.mysql_error());
    } else {
        $data = mysql_fetch_row($result);
    }
    
    // 1. Check product amount is enough or not.
    // 2. Keep amount and total price when product be ordered or canceled.
    if ( $status == "Order" ) {
        if ($amount > $data[3]) {
            $status = "Product Quantity Not Enough";
        }
        $amount = $data2[6];      //Avoid customer to change amount when product be ordered.
        $total_price = $data2[7]; //Avoid customer to change total price when product be ordered.
    } else if ( $status == "Cancel" ) {
        $amount = $data2[6];      //Avoid customer to change amount when product be ordered.
        $total_price = $data2[7]; //Avoid customer to change total price when product be ordered.        
    }

    // Insert new item in order table.
    $query2 = "INSERT INTO ".$tb_name2." (userid, nex_userid, pre_userid, P_userid, P_name, P_description, P_amount, P_total_price, P_comment, C_email, editor, status, Time) 
    VALUES (NULL, 0, ".$ticket.", ".$data2[3].", '".$data[1]."', '".$data[2]."', ".$amount.", ".$total_price.", '".$comment."', '".$email."','N/A', '".$status."', NULL);";

    $result3 = mysql_query($query2, $con) or die('Error in query3');
    
    if( !$result3 ) {   
        die('Could not connect:'.mysql_error());
    } else {
        $reply_order = 1;
    }

    if ( $reply_order == 1 ) {

    // Update amount in stock
    if ( ($status == "Order") || ($status == "Product Quantity Not Enough") ) {
        $In_stock = $data[3] - $amount;
        $query3 = "UPDATE ".$tb_name1." SET P_amount='".$In_stock."' WHERE userid='".$data2[3]."';";
        $result4 = mysql_query($query3, $con) or die('Error in query4'); 
        if ( !$result4 ) {
            echo "Update the quantity of product in stock fail!!<br>";
        }
    }

    // Update nex_userid, status, and editor in old item.
    $query4 = "SELECT userid FROM ".$tb_name2." WHERE pre_userid='".$ticket."' AND C_email='".$email."' AND editor='N/A' ;";
    $result5 = mysql_query($query4, $con) or die('Error in query5');

    if ( $result5 ) {
        $data3 = mysql_fetch_row($result5);
        $nex_userid = $data3[0];
    }
    
    $query5 = "UPDATE ".$tb_name2." SET nex_userid='".$nex_userid."', status='Has been replied', editor='".$email."' WHERE userid='".$ticket."';";
    $result6 = mysql_query($query5, $con) or die('Error in query6');
    
    }

    // Display finial result on website. 
    if ( $result3 ){

        echo "You submit order success, this order status is ".$status." , we will confirm it ASAP.";
    
    } else {
        echo "You submit order fail!!";
    }   

}

?>
</body>
</html>
<!DOCTYPE>
<html>
<head><title>List all of orders that created by you</title>
</head>
<body>
<?php
require('config.php');
$title = array("Reply" ,"Ticket of Product" ,"Product Name" ,"Product Description" ,"Quantity to Order" ,"Total Price" ,"Comment" ,"Creator" ,"Editor" ,"Status" , "Create/Modify Time");
$check_email_take_action = 0;

$con = mysql_connect($db_host, $db_user, $db_pass);

if (!$con) {
    die('Could not connect:'.mysql_error());
} 

mysql_select_db($db_name, $con);

// Get email of current user.
$guid = $_COOKIE['session_id'];
$query1 = "SELECT email FROM ".$tb_name." WHERE guid = '".$guid."'";
$result1 = mysql_query($query1, $con) or die('Error in query1');

if ( mysql_num_rows($result1) ) {
    $data1 = mysql_fetch_row($result1);
    $email = $data1[0];
    $check_email_take_action = 1;
} else {
    echo "<h2>System cannot know who you are.</h2>";
    echo "<h2>Please try to re-login system</h2>";
}

if ( $check_email_take_action == 1 ) {

echo "<p>List all orders that created by you</p>";

$query = "SELECT * FROM ".$tb_name2;
$result = mysql_query($query, $con) or die('Error in query');

if ( ($row_amount = mysql_num_rows($result)) && ($col_amount = mysql_num_fields($result)) ) {

    echo "<table style='width:100% border:3px #FFD382 dashed;' cellpadding='10' border='0'>";
    echo "<tr>";
    for( $k=0 ; $k < count($title) ; $k++ ) {
        echo "<th bgcolor='yellow'>".$title[$k]."</th>";
    }
    echo "</tr>";
 
    $i = 1;
    $counts = 1;
    $color_counts = 1;
    while ( $counts <= $row_amount ) {
        
        $query = "SELECT * FROM ".$tb_name2." WHERE userid = ".$i;
        $result = mysql_query($query, $con) or die('Error in query1');
        $data = mysql_fetch_row($result);

        if ( $data == "" ) { // Do not handle it when if data is empty.
            $i++;
        } else {
            
            // list items when if 1. Those items be created by current user.
            //                    2. The pre_userid is 0.
            if ( $data[9] == $email && $data[2] == 0 ) { 
                
                $nex_userid = $data[1]; // Check next item exist or not.

                while ( $nex_userid != 0 ) { // Find the last item and "0" is mean not exist.
                
                    $query1 = "SELECT * FROM ".$tb_name2." WHERE userid = ".$nex_userid;
                    $result1 = mysql_query($query1, $con) or die('Error in query2');

                    if ( $result1 ){
                        $data = mysql_fetch_row($result1);
                        $nex_userid = $data[1];
                    } else {
                        $nex_userid = 0;
                        echo "mysql query fail.";
                    }

                }
            
            // Set back ground color.
            if ( $color_counts%2 == 0 ) {
                echo "<tr bgcolor=#ABFFFF>";
            } else {
                echo "<tr>";
            }

            for ( $j=0 ; $j < $col_amount ; $j++ ) {

                if ( $j == 0 ) { // Don't display userid then swap as button.
                    if ( $data[11] == "Shipping" || $data[11] == "Cancel" || $data[11] == "Has been replied" || ( $data[9] == $email && $data[10] == "N/A" ) ) {
                        // Note: System doesn't display button when if status is "出貨", "取消", or "已回覆" （已回覆for old item, please refer to new item to track order status)
                        //       For customer, no button display when if this order still not be replied.
                        echo "<th>N/A</th>";
                    } else {
                        echo "<th>";
                        echo "<form action='C_reply_order.php' method='post' target='_blank'>";
                        echo "<input type='hidden' name='P_order' value='".$data[0]."'>";
                        echo "<input type='submit' name='submit' value='Reply'>";
                        echo "</form>";
                        echo "</th>";
                    }
                } else if ( $j == 1 || $j == 2 ) { // Don't display nex_userid and pre_userid
                } else {
                    echo "<th>".$data[$j]."</th>";
                }
            }
            echo "</tr>";
            $color_counts++;
            }

            $i++;
            $counts++;
        } 

    }
    echo "</table>";
} else {
    echo "Get order information fail!";
} // if ( ($row_amount = mysql_num_rows($result)) && ($col_amount = mysql_num_fields($result)) ) {

} // if ( $check_email_take_action == 1 ) {

?>
</body>
</html>
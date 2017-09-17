<!DOCTYPE>
<html>
<head><title>List All Orders (DEMO System)</title>
</head>
<body>
<?php
require('config.php');
$title = array("Handle Order" ,"Ticket of Product" ,"Product Name" ,"Product Description" ,"Quantity to Order" ,"Total Price" ,"Comment" ,"Creator" ,"Editor" ,"Status" , "Create/Modify Time");

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

echo "<p>List All Orders</p>";

$query = "SELECT * FROM ".$tb_name2;
$result = mysql_query($query, $con) or die('Error in query');

if ( ($row_amount = mysql_num_rows($result)) && ($col_amount = mysql_num_fields($result)) ) {

    echo "<table style='width:100% border:3px #FFD382 dashed;' cellpadding='10' border='0'>";
    echo "<tr>";
    for( $k=0 ; $k < count($title) ; $k++ ) {
        echo "<th bgcolor='yellow'>".$title[$k]."</th>";
    }
    echo "</tr>";
    //for ( $i=1 ; $i<=$row_amount ; $i++ ) {
    $i = 1;
    $counts = 1;
    while ( $counts <= $row_amount ) {
        
        $query = "SELECT * FROM ".$tb_name2." WHERE userid = ".$i;
        $result = mysql_query($query, $con) or die('Error in query1');
        $data = mysql_fetch_row($result);

        if ( $data == "" ) { // Do not handle it when if data is empty.
            $i++;
        } else {

            // Set back ground color.
            if ( $counts%2 == 0 ) {
                echo "<tr bgcolor=#ABFFFF>";
            } else {
                echo "<tr>";
            }

            for ( $j=0 ; $j < $col_amount ; $j++ ) {

                if ( $j == 0 ) { // Don't display userid then swap as button.
                    if ( $data[11] == "Shipping" || $data[11] == "Has been handled" || $data[11] == "Cancel" || $data[11] == "Has been replied" ) {
                        echo "<th></th>";
                    } else {
                        echo "<th>";
                        echo "<form action='handle_order.php' method='post' target='_blank'>";
                        echo "<input type='hidden' name='P_order' value='".$data[0]."'>";
                        echo "<input type='submit' name='submit' value='Handle It'>";
                        echo "</form>";
                        echo "</th>";
                    }
                } else if ( $j == 1 || $j == 2 ) { // Don't display nex_userid and pre_userid
                } else {
                    echo "<th>".$data[$j]."</th>";
                }
            }
            echo "</tr>";
            $i++;
            $counts++;
        }

    }
    echo "</table>";
} else {
    echo "Get information fail or no order in databases!";
} // if ( ($row_amount = mysql_num_rows($result)) && ($col_amount = mysql_num_fields($result)) ) {

} // if ( $check_email_take_action == 1 ) {

?>
</body>
</html>
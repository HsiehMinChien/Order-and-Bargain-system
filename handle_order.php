<!DOCTYPE>
<html>
<head><title>Handle Order (DEMO System)</title>
<script src="check_fill.js"></script>
</head>
<body>
<?php

require('config.php');
$ticket = $_POST['P_order'];
$title = array("Ticket","Product Name","Product Description","Quantity in Stock","Cost","Price","Comment","Creator", "Editor", "Create/Modify Time");
$title1 = array( "", "", "", "Ticket of Product", "Product Name", "Product Description", "Quantity to Order", "Total Price", "Comment", "Creator", "Editor", "Status", "Create/Modify Time");

$con = mysql_connect($db_host, $db_user, $db_pass);

if (!$con) {
    die('Could not connect:'.mysql_error());
} 

mysql_select_db($db_name, $con);

//Get email of current user.
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

// Get order info
$query = "SELECT * FROM ".$tb_name2." WHERE userid=".$ticket;
$result = mysql_query($query, $con) or die('Error in query');

if( !$result ) {   
    die('Could not connect:'.mysql_error());
} else {
    $data = mysql_fetch_row($result);
    $col_amount = mysql_num_fields($result);
}

// Get product info
$query2 = "SELECT * FROM ".$tb_name1." WHERE userid=".$data[3];
$result2 = mysql_query($query2, $con) or die('Error in query2');

if( !$result2 ) {   
    die('Could not connect:'.mysql_error());
} else {
    $data2 = mysql_fetch_row($result2);
    $col_amount2 = mysql_num_fields($result2);
}

echo "<b>Product Information</b>";
echo "<table style='width:100% border:3px #FFD382 dashed;' cellpadding='10' border='0'>";
echo "<tr bgcolor=#FFD4D4>";
for ( $i=0 ; $i < $col_amount2 ; $i++ ) {
        echo "<th>".$title[$i]."</th>";
}
echo "</tr>";
echo "<tr>";
for ( $i=0 ; $i < $col_amount2 ; $i++ ) {
        echo "<th>".$data2[$i]."</th>";
}
echo "</tr>";
echo "</table><br>";

echo "<b>Order Information</b>";
echo "<table style='width:100% border:3px #FFD382 dashed;' cellpadding='10' border='0'>";
echo "<tr bgcolor=#BFFFFF>";
for ( $i=0 ; $i < count($title1) ; $i++ ) {
    if ( $i == 0 || $i == 1 || $i == 2 || $i == 9 ) {
        // Do nothing.
    } else {
        echo "<th>".$title1[$i]."</th>";
    }
}
echo "</tr>";

echo "<tr>";
for ( $i=0 ; $i < count($title1) ; $i++ ) {
    if ( $i == 0 || $i == 1 || $i == 2 || $i == 9 ) {
        // Do nothing.
    } else {
        echo "<th>".$data[$i]."</th>";
    }
}
echo "</tr>";

    echo "</table>";
    echo "<br>";
    echo "<form name='reg' action='handle_order_done.php' method='post'>";
    echo "Quantity to Order: ";
    echo "<input type='value' name='P_amount' value='".$data[6]."'><br>";
    echo "Expectation Price: ";
    echo "<input type='value' name='P_total_price' value='".$data[7]."'><br>";
    echo "Comment: ";
    echo "<input type='text' name='P_comment' style='width:300px; height:100px;'><br>";
    echo "<br>Status of Order: <br>";
    echo "<input type='radio' name='status' value='Shipping'> Shipping<br>";
    echo "<input type='radio' name='status' value='Has been handled'> Has been handled<br>";
    echo "<input type='radio' name='status' value='Cancel'> Cancel<br>";
    //echo "<input type='submit' name='submit' value='Submit'>";
    echo "<input type='button' value='Submit' onClick='check_handle_order()'>";
    echo "<input type='reset' value='Reset'>";
    echo "<input type='hidden' name='P_order' value='".$ticket."'><br>";
    echo "</form>";

}

?>
</body>
</html>
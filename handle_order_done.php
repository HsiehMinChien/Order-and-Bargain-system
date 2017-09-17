<!DOCTYPE>
<html>
<head><title>Handle Order Done (DEMO System)</title>
</head>
<body>
<?php
require('config.php');
$ticket = $_POST['P_order'];
$status = $_POST['status'];
$amount = $_POST['P_amount'];
$total_price = $_POST['P_total_price'];
$comment = $_POST['P_comment'];
$check_email_take_action = 0; //Defatul disable all function.

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

// Enable all function when if user be confirmed.
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

// Replay this order!!
$query3 = "INSERT INTO ".$tb_name2." (userid, nex_userid, pre_userid, P_userid, P_name, P_description, P_amount, P_total_price, P_comment, C_email, editor, status, Time) 
VALUES (NULL, 0, ".$data[0].", ".$data[3].", '".$data[4]."', '".$data[5]."', ".$amount.", ".$total_price.", '".$comment."', '".$email."','N/A', '".$status."', NULL);";

if (mysql_query($query3, $con) or die('Error in query3')) {
    echo "<br>You reply this order success!";
    $reply_order = 1;
} else {
    echo "<br>You reply this order fail: ". mysql_error($con);
}

if ( $reply_order == 1 ) {

// When order be canceled.
if ( $status == "Cancel" && $data[11] == "Order" ) {
    $In_stock = $amount + $data2[3];
    $query4 = "UPDATE ".$tb_name1." SET P_amount='".$In_stock."', P_editor='".$email."' WHERE userid='".$data[2]."';";
    
    if ( mysql_query($query4, $con) or die('Error in query4') ) {
        //Do nothing!
    } else {
        echo "Update the quantity of product in warehouse fail!!<br>";
    }
    
}

// Update nex_userid
$query6 = "SELECT userid FROM ".$tb_name2." WHERE pre_userid='".$data[0]."' AND C_email='".$email."' AND editor='N/A' ;";
$result6 = mysql_query($query6, $con) or die('Error in query6');

if ( $result6 ) {
    $data3 = mysql_fetch_row($result6);
    $nex_userid = $data3[0];
}
    
$query7 = "UPDATE ".$tb_name2." SET nex_userid='".$nex_userid."', status='Has been replied', editor='".$email."' WHERE userid='".$data[0]."';";
$result7 = mysql_query($query7, $con) or die('Error in query6');

}

}

?>
</body>
</html>

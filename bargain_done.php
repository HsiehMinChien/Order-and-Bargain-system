<!DOCTYPE>
<html>
<head><title>Bargain Page (DEMO System)</title>
</head>
<body>
<?php

require('config.php');
$ticket = $_POST['P_order'];
$amount = $_POST['P_amount'];
$comment = $_POST['P_comment'];
$total_price = $_POST['P_total_price'];
$status = $_POST['status'];
$check_email_take_action = 0;

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

$query = "SELECT * FROM ".$tb_name1." WHERE userid=".$ticket;
$result = mysql_query($query, $con) or die('Error in query');

if( !$result ) {   
    die('Could not connect:'.mysql_error());
} else {
    $data = mysql_fetch_row($result);
}

    if ( ($status == "Order") || ($status == "NoEnough") ) { //Un-use

        $query2 = "INSERT INTO ".$tb_name2." (userid, Old_userid, P_userid, P_name, P_description, P_amount, P_total_price, P_comment, C_email, editor, status, Time) 
        VALUES (NULL, 0, ".$ticket.", '".$data[1]."', '".$data[2]."', ".$amount.", ".$total_price.", '".$comment."', '".$data[7]."','".$email."', '".$status."', NULL);";
    
    } else if ( $status == "Bargain" ) { // This item will be use.

        $query2 = "INSERT INTO ".$tb_name2." (userid, nex_userid, pre_userid, P_userid, P_name, P_description, P_amount, P_total_price, P_comment, C_email, editor, status, Time) 
        VALUES (NULL, 0, 0, ".$ticket.", '".$data[1]."', '".$data[2]."', ".$amount.", ".$total_price.", '".$comment."', '".$email."','N/A', '".$status."', NULL);";

    } else if ( $status == "Has been Reply" ) {

        $query2 = "UPDATE ".$tb_name2." SET 
        Old_userid='N/A', 
        P_userid='".$ticket."', 
        P_name='".$data[1]."', 
        P_description='".$data[2]."', 
        P_amount=".$amount.", 
        P_total_price=".$total_price.", 
        P_comment='".$data[6]."', 
        C_email='".$data[7]."', 
        editor='".$email."', 
        status='".$status."';";

    }

    $result3 = mysql_query($query2, $con) or die('Error in query3');

    // Update amount in stock
    if ( ($status == "Order") || ($status == "NoEnough") ) {

        $query3 = "UPDATE ".$tb_name1." SET P_amount='".$In_stock."' WHERE userid='".$ticket."';";
        $result4 = mysql_query($query3, $con) or die('Error in query4'); 

        if ( !$result4 ) {
            echo "Update product information fail!!<br>";
        }

    }

    if ( $result3 ){
        echo "You submit the bragain success, we will confirm it ASAP.";
    } else {
        echo "You submit the bragain fail!!";
    }

} // if ( $check_email_take_action == 1 ) {

?>
</body>
</html>
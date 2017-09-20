<!DOCTYPE>
<html>
<head><title>Update Product Information</title>
</head>
<body>
<?php
require('config.php');
$check_ticket_take_action = 0;
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

if (mysql_num_rows($result1)) {
    $data1 = mysql_fetch_row($result1);
    $email = $data1[0];
    $check_email_take_action = 1;
} else {
    echo "<h2>System cannot know who you are.</h2>";
    echo "<h2>Please try to re-login system</h2>";
}

if ($check_email_take_action == 1) {

// Get product information from ticket.
$query = "SELECT * FROM ".$tb_name1." WHERE userid = ".$_POST['ticket'];
$result = mysql_query($query, $con) or die('Error in query1');
$confirm = mysql_num_rows($result);

if ( $confirm == "" ) {
    echo "<font color='red'>System cannot find out any product by ticket<b>".$_POST['ticket']."</b>!!</font>";
} else if (!$confirm) {
    die('Could not connect:'.mysql_error());
} else {
    $data = mysql_fetch_row($result);
    $check_ticket_take_action = 1;
}

// Confirm every data not be empty!
if ( $_POST['P_name'] == "" ) {
    $P_name = $data[1];
} else {
    $P_name = $_POST['P_name'];
}

if ( $_POST['P_description'] == "" ) {
    $P_description = $data[2];
} else {
    $P_description = $_POST['P_description'];
}

if ( $_POST['P_amount'] == "" ) {
    $P_amount = $data[3];
} else {
    $P_amount = $_POST['P_amount'];
}

if ( $_POST['P_in_price'] == "" ) {
    $P_in_price = $data[4];
} else {
    $P_in_price = $_POST['P_in_price'];
}

if ( $_POST['P_out_price'] == "" ) {
    $P_out_price = $data[5];
} else {
    $P_out_price = $_POST['P_out_price'];
}

if ( $_POST['P_comment'] == "" ) {
    $P_comment = $data[6];
} else {
    $P_comment = $_POST['P_comment'];
}

if ( $check_ticket_take_action == 1 ) {

    $query2 = "UPDATE ".$tb_name1." SET 
    P_name='".$P_name."', 
    P_description='".$P_description."',
    P_amount=".$P_amount.",
    P_in_price=".$P_in_price.",
    P_out_price=".$P_out_price.", 
    P_comment='".$P_comment."', 
    P_editor='".$email."' 
    WHERE userid='".$_POST['ticket']."';";
    $result3 = mysql_query($query2, $con) or die('Error in query3');

    if ($result3){
        echo "Update product information success!!";
    } else {
        echo "Update product information fail!!";
    }
    
}

}
?>
</body>
</html>

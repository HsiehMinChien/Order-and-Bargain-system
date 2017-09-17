<!DOCTYPE>
<html>
<head>
</head>
<body>
<?php
require('config.php');

$con = mysql_connect($db_host, $db_user, $db_pass);

if (!$con) {
    die('Could not connect:'.mysql_error());
}

mysql_select_db($db_name, $con);


// Create connection
//$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
// Check connection
//if (!$conn) {
//    die("Connection failed: " . mysqli_connect_error());
//}


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

    $query = "INSERT INTO ".$tb_name1." (userid, P_name, P_description, P_amount, P_in_price, P_out_price, P_comment, email, P_editor, Time) 
    VALUES (NULL, '".$_POST['P_name']."', '".$_POST['P_description']."', ".$_POST['P_amount'].", ".$_POST['P_in_price'].", ".$_POST['P_out_price'].", '".$_POST['P_comment']."', '".$_POST['email']."','NA', NULL);";

    if (mysql_query($query, $con) or die('Error in query')) {
        echo "<br>New product has been created successfully.";
    } else {
        echo "<br>Create new product fail: " . mysql_error($con);
    }

}

//Close connect
mysql_close($con);
?>
<br>
<!-- <a href=”http://localhost/~shiemingchen/bar/Test.php“>返回主選單</a><br> -->
<!-- <a href=Test.php>返回主選單2</a><br> -->
<!-- <a href=”http://localhost/~shiemingchen/bar/index.html“>返回index</a><br> -->
</body>
</html>

<!DOCTYPE>
<html>
<head>
</head>
<body>
<p>Product that you select: </p>
<?php
require('config.php');
$check_email_take_action = 0;
$con = mysql_connect($db_host, $db_user, $db_pass);

if (!$con) {
    die('Could not connect:'.mysql_error());
}

mysql_select_db($db_name, $con);

//Get email of current user.
$guid = $_COOKIE['session_id'];
$query1 = "SELECT email FROM ".$tb_name." WHERE guid = '$guid'";
$result1 = mysql_query($query1, $con) or die('Error in query');

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
    $result = mysql_query($query, $con) or die('Error in query');
    $confirm = mysql_num_rows($result);

    if ( $confirm == "" ) {
        echo "<font color='red'>System cannot find out any product by ticket:<b>".$_POST['ticket']."</b>!!</font>";
    } else if (!$confirm) {
        die('Could not connect:'.mysql_error());
    } else {
        $data = mysql_fetch_row($result);
    }

}

?>
<form action="modify_product_action_2.php" method="POST">
- 商品名稱<br>
<input type="text" name="P_name" value="<?php echo $data[1]; ?>">
<br>
- 商品說明<br>
<input type="text" name="P_description" style="width:300px; height:100px;" value="<?php echo $data[2]; ?>">
<br>
- 商品數量<br>
<input type="value" name="P_amount" value="<?php echo $data[3]; ?>">
<br>
- 單品成本<br>
<input type="value" name="P_in_price" value="<?php echo $data[4]; ?>">
<br>
- 出售單價<br>
<input type="value" name="P_out_price" value="<?php echo $data[5]; ?>">
<br>
- 備註<br>
<input type="text" name="P_comment" style="width:300px; height:100px;" value="<?php echo $data[6]; ?>">
<br>
<input type="submit" name="submit" value="Submit"><br>
<input type="hidden" name="P_editor" value="<?php echo $email; ?>">
<input type="hidden" name="ticket" value="<?php echo $data[0]; ?>">
</form>
</body>
</html>


<!DOCTYPE>
<html>
<head><title>Create New Products (DEMO System)</title>
<script src="check_fill.js"></script>
</head>
<body>
<?PHP
// Get the email and force upload to database.
require('config.php');

$con = mysql_connect($db_host, $db_user, $db_pass);

if (!$con) {
    die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_name, $con);

$guid = $_COOKIE['session_id'];
//echo "<br> Guid is ".$guid;

$query = "SELECT email FROM ".$tb_name." WHERE guid = '$guid'";

$result = mysql_query($query, $con) or die('Error in query');

if (mysql_num_rows($result))
{
    $row = mysql_fetch_row($result);
    $email = $row[0];
}

?>
<p><b> Please fill following content to create new product </b></p>
<form name="reg" action="check_create_product.php" method="POST">
- Product Name<br>
<input type="text" name="P_name">
<br>
- Product Description<br>
<input type="text" name="P_description" style="width:300px; height:100px;">
<br>
- Amount<br>
<input type="value" name="P_amount" value="0">
<br>
- Cost<br>
<input type="value" name="P_in_price" value="0">
<br>
- Price<br>
<input type="value" name="P_out_price" value="0">
<br>
- Comment<br>
<input type="text" name="P_comment" style="width:300px; height:100px;">
<br>
<!-- <input type="submit" name="submit" value="Create"><br> -->
<input type="button" value="Create" onClick="check_create_product()">
<input type="reset" value="Reset">
<input type="hidden" name="email" value="<?php echo $email; ?>">
</form>
</body>
</html>

<!DOCTYPE>
<html>
<head><title>Customer Main Page for DEMO</title>
</head>
<body>
<?PHP
include('incsession.php');
require('config.php');

$con = mysql_connect($db_host, $db_user, $db_pass);

if (!$con) {
    die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_name, $con);
$guid = $_COOKIE['session_id'];
$query = "SELECT email FROM ".$tb_name." WHERE guid = '$guid'";
$result = mysql_query($query, $con) or die('Error in query');

if (mysql_num_rows($result))
{
    $row = mysql_fetch_row($result);
    $email = $row[0];
}

  echo "Welcome to login the user page: <b>".$email."</b>";
?>
<br>
<br>
<b>Select The Service That You Want</b><br>
- <a href="products_list.php" target="_blank">Check and Order products</a><br>
- <a href="check_order.php" target="_blank">Check your order</a>
</body>
</html>

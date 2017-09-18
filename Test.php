<html>
<head><title>Sales Main Page for DEMO</title>
</head>
<body>
<?PHP
include('incsession.php');
require('config.php');

$con = mysql_connect($db_host, $db_user, $db_pass);

if ( !$con ) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db($db_name, $con);
$guid = $_COOKIE['session_id'];
$query = "SELECT email FROM ".$tb_name." WHERE guid = '$guid'";
$result = mysql_query($query, $con) or die('Error in query');

if ( mysql_num_rows($result) ) {
    $row = mysql_fetch_row($result);
    $email = $row[0];
}

echo "Welcome to login Sales page: <b>".$email."</b>";

if ( !$con ) {
    die('Could not connect: ' . mysql_error());
}

mysql_close($con);

?>

<br><p>Functional List</p>
1. <a href="list_all_products.php" target="_blank">List All Products</a><br>
2. <a href="create_new_product.php" target="_blank">Add News Products</a><br>
3. <a href="modify_product.php" target="_blank">Update Products Information</a><br>
4. <a href="list_all_order.php" target="_blank">List All Orders</a><br>
5. <a href="order_overdue.php" target="_blank">Check Overdue Orders</a><br>
</body>
</html>

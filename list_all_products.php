<!DOCTYPE>
<html>
<head><title>List All Products (DEMO System)</title>
</style>
</head>
<body>
<?php
require('config.php');
$title = array("Ticket","Product Name","Product Description","Quantity in Stock","Cost","Price","Comment","Creator", "Editor", "Create/Modify Time");

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

echo "<p>List All Products</p>";

$query = "SELECT * FROM ".$tb_name1;
$result = mysql_query($query, $con) or die('Error in query');

if ( ($row_amount = mysql_num_rows($result)) && ($col_amount = mysql_num_fields($result)) ) {

    echo "<table style='width:100% border:3px #FFD382 dashed;' cellpadding='10' border='0'>";

    // List Titles
    echo "<tr>";
    for( $k=0 ; $k < $col_amount ; $k++ ) {
        echo "<th bgcolor='yellow'>".$title[$k]."</th>";
    }
    echo "</tr>";

    //for ( $i=1 ; $i<=$row_amount ; $i++ ) {
    $i = 1;
    $counts = 1;
    while ( $counts <= $row_amount ) {

        $query = "SELECT * FROM ".$tb_name1." WHERE userid = ".$i;
        $result = mysql_query($query, $con) or die('Error in query');
        $data = mysql_fetch_row($result);

        if ( $data == "" ) {
            $i++;
        } else {
            // Set back ground color
            if ( $counts%2 == 0 ) {
                echo "<tr bgcolor=#ABFFFF>";
            } else {
                echo "<tr>";
            }

            // List data
            for ( $j=0 ; $j < $col_amount ; $j++ ) {
                echo "<th>".$data[$j]."</th>"; 
            }
            echo "</tr>";
            $i++;
            $counts++;
        }
    }
    echo "</table>";
} else {
    echo "Get Products Information fail or no product in database!";
} // if ( ($row_amount = mysql_num_rows($result)) && ($col_amount = mysql_num_fields($result)) ) {

} // if ( $check_email_take_action == 1 ) {

?>
</body>
</html>

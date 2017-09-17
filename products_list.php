<!DOCTYPE>
<html>
<head><title>Check and Order Products (DEMO System)</title>
</head>
<body>
<?php
require('config.php');
$title = array("Buy it","Product Name","Product Description","Quantity in Stock","Cost","Price","Comment","Creator", "Editor", "Create Time");

// Connect mysql server
$con = mysql_connect($db_host, $db_user, $db_pass);

if (!$con) {
    die('Could not connect:'.mysql_error());
} 

// Select database
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

    echo "<p>Check and Order Products</p>";
    echo "<b>All of products be listed on following table!</b>";

    // Get products info from mysql server.
    $query = "SELECT * FROM ".$tb_name1;
    $result = mysql_query($query, $con) or die('Error in query');

    if ( ($row_amount = mysql_num_rows($result)) && ($col_amount = mysql_num_fields($result)) ) {

        echo "<table style='width:100% border:3px #FFD382 dashed;' cellpadding='10' border='0'>";
        echo "<tr bgcolor=#E3E3E3>";
        
        // List title
        for( $k=0 ; $k < $col_amount ; $k++ ) {
            // Pick up those items which you want.
            if( $k == 0 || $k == 1 || $k == 2 || $k == 3 || $k == 5 ){
                echo "<th>".$title[$k]."</th>";
            }
        }
        echo "</tr>";
    
        // List products
        for ( $i=1 ; $i<=$row_amount ; $i++ ) {

            $query = "SELECT * FROM ".$tb_name1." WHERE userid = ".$i;
            $result = mysql_query($query, $con) or die('Error in query');
            $data = mysql_fetch_row($result);

            if ( ($i%2) == 0 ) {
                echo "<tr bgcolor=#E3E3E3>";
            } else {
                echo "<tr>";
            }

            for ( $j=0 ; $j < $col_amount ; $j++ ) {

                if ($j == 0) {
                    echo "<th>";
                    echo "<form action='order_products.php' method='post' target='_blank'>";
                    echo "<input type='radio' name='action' value='Order'> Order<br>";
                    echo "<input type='radio' name='action' value='Bargain'> Bargain<br>";
                    echo "<input type='hidden' name='P_order' value='".$data[$j]."'>";
                    echo "<input type='submit' name='submit' value='Submit'>";
                    echo "</form>";
                    echo "</th>";
                } else if( $j == 1 || $j ==2 || $j ==3 || $j ==5 ) {
                    echo "<th>".$data[$j]."</th>";
                } else {
                    // Do nothing.
                }

            }
            echo "</tr>";

        }
        echo "</table>";
    } else {
        echo "<br>Get Products Information Fail!";
    }

}
?>
</body>
</html>


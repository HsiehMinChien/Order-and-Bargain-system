<!DOCTYPE>
<html>
<head><title>Order Page (DEMO System)</title>
</head>
<body>
<?php
require('config.php');
$title = array("Order or not", "Product Name", "Product Description", "Quantity in Stock", "Cost", "Price", "Comment", "Creator", "Editor", "Create/Modify Time");
$ticket = $_POST['P_order'];
$action = $_POST['action'];

if ( $action == "order" ) {
    echo "<b>Thank for order this product, please confirm again!</b><br>";
} else {
    echo "<b>You would like to bargain, please help us to confirm again!</b><br>";
}

$con = mysql_connect($db_host, $db_user, $db_pass);

if (!$con) {
    die('Could not connect:'.mysql_error());
} 

mysql_select_db($db_name, $con);

$query = "SELECT * FROM ".$tb_name1." WHERE userid = ".$ticket;
$result = mysql_query($query, $con) or die('Error in query');

if ( ($row_amount = mysql_num_rows($result)) && ($col_amount = mysql_num_fields($result)) ) {

    echo "<table style='width:100% border:3px #FFD382 dashed;' cellpadding='10' border='0'>";
    
    $data = mysql_fetch_row($result);

    for( $k=0 ; $k < $col_amount ; $k++ ) {
        
        // Pick up those items which you want.
        if( $k == 1 || $k == 2 || $k == 5 ){
            echo "<tr>";
            echo "<th bgcolor=#BFFFFF>".$title[$k]."</th>";
            echo "<th>".$data[$k]."</th>";
            echo "</tr>";
        }
    }
    
    if ( $action == "Order" ) { // When customer select order.
        echo "</table>";
        echo "<form action='order_done.php' method='post'>";
        echo "Expect to Order: ";
        echo "<input type='value' name='P_amount' value='1'><br>";
        echo "Comment: ";
        echo "<input type='text' name='P_comment' style='width:300px; height:100px;' placeholder='Type Comment'><br>";
        echo "<input type='submit' name='submit' value='Submit'>";
        echo "<input type='hidden' name='P_order' value='".$ticket."'><br>";
        echo "</form>";
    } else { // When customer select bargain.
        echo "</table>";
        echo "<form action='bargain_done.php' method='post'>";
        echo "Expect to Order: ";
        echo "<input type='value' name='P_amount' value='1'><br>";
        echo "Expectation Total Price: ";
        echo "<input type='value' name='P_total_price' value='".$data[5]."'><br>";
        echo "Comment: ";
        echo "<input type='text' name='P_comment' style='width:300px; height:100px;' placeholder='Type Comment'><br>";
        echo "<input type='submit' name='submit' value='Submit'>";
        echo "<input type='hidden' name='status' value='Bargain'><br>";
        echo "<input type='hidden' name='P_order' value='".$ticket."'><br>";
        echo "</form>";
    }
} else {
    echo "Get Information Fail!";
}

?>
</body>
</html>

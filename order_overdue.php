<!DOCTYPE>
<html>
<head><title>Order Overdue</title>
</head>
<body>
<?PHP
require('config.php');
$title = array("Ticket of product" ,"Product Name" ,"Product Description" ,"Quantity to Order" ,"Total Price" ,"Comment" ,"Creator" ,"Editor" ,"Status" , "Create/Modify Time");
$check_email_take_action = 0;

$con = mysql_connect($db_host, $db_user, $db_pass);

if (!$con) {
    die('Could not connect:'.mysql_error());
} 

mysql_select_db($db_name, $con);

//Get email of current user.
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

?>

    <h2>This page for check all overdue orders.</h2>
    <b>List orders which be created more than</b><br>

    <form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
    <input type='radio' name='action' value='0'> Zero day</option><br>
    <input type='radio' name='action' value='1'> One day</option><br>
    <input type='radio' name='action' value='2'> Two day</option><br>
    <input type='radio' name='action' value='3'> Three day</option><br>
    <input type='radio' name='action' value='4'> Four day</option><br>
    <input type='radio' name='action' value='5'> Five days</option><br>
    <input type='radio' name='action' value='6'> Six days</option><br>
    <input type='radio' name='action' value='7'> One week</option><br>
    <input type='radio' name='action' value='14'> Two weeks</option><br>
    <input type='radio' name='action' value='21'> There weeks</option><br>
    <input type='radio' name='action' value='30'> One month</option><br>
    </select><br>
    <input type='submit' name='submit' value='Submit'>
    </form>

<?PHP

if ( $check_email_take_action == 1 ) {

    // Get current time.
    date_default_timezone_set("Asia/Taipei");
    $Cur_Time = Time();
    $Overdue = $_POST['action'];

    if ($Overdue == "") {

       echo "The overdue day still not be selected.<br>";
    
    } else {

        switch ($Overdue) {
            case 0:
                $Overdue_express = "Zero day";
            break;
            case 1:
                $Overdue_express = "One day";
            break;
            case 2:
                $Overdue_express = "Two days";
            break;
            case 3:
                $Overdue_express = "Three days";
            break;
            case 4:
                $Overdue_express = "Four days";
            break;
            case 5:
                $Overdue_express = "Five days";
            break;
            case 6:
                $Overdue_express = "Six days";
            break;
            case 7:
                $Overdue_express = "One weeks";
            break;
            case 14:
                $Overdue_express = "Two weeks";
            break;
            case 21:
                $Overdue_express = "Three weeks";
            break;
            case 30:
                $Overdue_express = "One month";
            break;
        }
        echo "Following orders be created more than <font color='red'>".$Overdue_express."</font>.<br>";

        $query = "SELECT * FROM ".$tb_name2;
        $result = mysql_query($query, $con) or die('Error in query');
    
        if ( ($row_amount = mysql_num_rows($result)) && ($col_amount = mysql_num_fields($result)) ) {
    
            echo "<br><table style='width:100% border:3px #FFD382 dashed;' cellpadding='10' border='0'>";
            echo "<tr>";
            for( $k=0 ; $k < count($title) ; $k++ ) {
                echo "<th bgcolor='yellow'>".$title[$k]."</th>";
            }
            echo "</tr>";

            $i = 1;
            $counts = 1;
            $counts_2 = 1;
            while ( $counts <= $row_amount ) {
            
                $query = "SELECT * FROM ".$tb_name2." WHERE userid = ".$i;
                $result = mysql_query($query, $con) or die('Error in query1');
                $data = mysql_fetch_row($result);
    
                if ( $data == "" ) { // Do not handle it when if data is empty.
                    $i++;
                } else {
    
                    if ( $data[11] == "Shipping" || $data[11] == "Has been handled" || $data[11] == "Cancel" || $data[11] == "Has been replied" ) {
                    // System don't list those status order.
                    } else {

                        if ( (($Cur_Time - strtotime($data[12]))/(60*60*24)) > $Overdue ) {
                        // Set back ground color.
                        if ( $counts_2%2 == 0 ) {
                            echo "<tr bgcolor=#ABFFFF>";
                        } else {
                            echo "<tr>";
                        }
    
                        for ( $j=0 ; $j < $col_amount ; $j++ ) {
                    
                            if ( $j==0 || $j == 1 || $j == 2 ) { // Don't display nex_userid and pre_userid
                        
                            } else {
                                echo "<th>".$data[$j]."</th>";
                            }

                        }
                        $counts_2++;
                        }
                    }
                    echo "</tr>";
                    $i++;
                    $counts++;
                }
    
            }
            echo "</table>";
        } else {
            echo "System cannot get order data!";
        } // if ( ($row_amount = mysql_num_rows($result)) && ($col_amount = mysql_num_fields($result)) ) {
    $Overdue = "";
    }

}

?>
</body>
</html>

<!DOCTYPE>
<html>
<head><title>Show All Orders Status!</title>
<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"> </script>
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>

<?PHP
require('config.php');
$ticket = $_POST['P_order'];
$title = array("Order","Product Quantity Not Enough","Bargain","Cancel","Has been replied","Has been handled","Shipping");

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

if ( $check_email_take_action == 1 ) {

// Get order info
$query = "SELECT * FROM ".$tb_name2;
$result = mysql_query($query, $con) or die('Error in query');

if( !$result ) {
    die('Could not connect:'.mysql_error());
} else {
    //$col_amount = mysql_num_fields($result);
    $row_amount = mysql_num_rows($result);
    $data = mysql_fetch_row($result);
}
// Six different status: Order, Product Quantity Not Enough, Bargain, Cancel, Has been replied, Has been handled, Shipping
$status_counts = array(0,0,0,0,0,0,0);
$i = 1;
$counts = 1;
while ( $counts <= $row_amount ) {
    
    $query = "SELECT * FROM ".$tb_name2." WHERE userid = ".$i;
    $result = mysql_query($query, $con) or die('Error in query1');
    $data = mysql_fetch_row($result);

    if ( $data == "" ) { // Do not handle it when if data is empty.
        $i++;
    } else {

        // Count every status!
        if ( $data[11] == "Order" ) {
            $status_counts[0]++;
        } else if ( $data[11] == "Product Quantity Not Enough" ) {
            $status_counts[1]++;
        } else if ( $data[11] == "Bargain" ) {
            $status_counts[2]++;
        } else if ( $data[11] == "Cancel" ) {
            $status_counts[3]++;
        } else if ( $data[11] == "Has been handled" ) {
            $status_counts[5]++;
        } else if ( $data[11] == "Shipping" ) {
            $status_counts[6]++;
        } else { // Has been replied
            $status_counts[4]++;
        } 
        $i++;
        $counts++;
    }
}
echo "<h2>Show Orders Status</h2>";
echo "Thg graphic to display all status:";
}
?>

<script>
    var user = "<?PHP echo $check_email_take_action?>";

    if (user == 1) {
    //var data = [1, 2, 3, 4, 5];
    var data = ["<?PHP echo $status_counts[0] ?>", 
                "<?PHP echo $status_counts[1] ?>",
                "<?PHP echo $status_counts[2] ?>",
                "<?PHP echo $status_counts[3] ?>",
                "<?PHP echo $status_counts[5] ?>",
                "<?PHP echo $status_counts[6] ?>"];
    var title = ["<?PHP echo $title[0] ?>", 
                 "<?PHP echo $title[1] ?>",
                 "<?PHP echo $title[2] ?>",
                 "<?PHP echo $title[3] ?>",
                 "<?PHP echo $title[5] ?>",
                 "<?PHP echo $title[6] ?>"];
    var count = 0;
    var height = 260; 
    var width = 300;
    // body and container
    var body = d3.select('body');
    var wrap = body.append('div')
               .style({
                   'height': height + 'px'
               })
               .classed('wrap', true);
    // render, & update
    var status_bar = function () {
                    wrap.selectAll('.bar')
                    .data(data)
                    .enter()
                    .append('div')
                    .classed('bar', true)
                    .text(function (d) {
                        return d ;
                    })
                    .style({
                        'height': function (d) {
                            return d * 10 + 'px';
                        },
                        'top': function (d) {
                            return (height - d * 10) + 'px';
                        },
                        'background-color': function(d) {
                            // Set diff color for diff status!
                            if (count == 0) {
                                count++;
                                return 'red';
                            } else if (count == 1) {
                                count++;
                                return 'black';
                            } else if (count == 2) {
                                count++;
                                return 'green';
                            } else if (count == 3) {
                                count++;
                                return 'gray';
                            } else if (count == 4) {
                                count++;
                                return 'orange';
                            }
                        }
                    });
                };
    // Call render
    status_bar();
    }
</script>

<div id="dis_sta_color">
</div>

<script type="text/javascript">
        var pdata = title;
        var count1 = 0;
        var selectDIV = d3.select("#dis_sta_color");
        selectDIV.selectAll("div")
             .data(pdata)
             .enter()
             .append("div")
             .classed('bar', true)
             .text(function(d){return d;})
             .style({
             //'float': function(d){return 'none';},
             //'height': function(d){return 10 + 'px';},
             'background-color': function(d) {
                            // Set diff color for diff status!
                            if (count1 == 0) {
                                count1++;
                                return 'red';
                            } else if (count1 == 1) {
                                count1++;
                                return 'black';
                            } else if (count1 == 2) {
                                count1++;
                                return 'green';
                            } else if (count1 == 3) {
                                count1++;
                                return 'gray';
                            } else if (count1 == 4) {
                                count1++;
                                return 'orange';
                            }
                        }
             });
</script>

<?PHP

if ( $check_email_take_action == 1 ) {

echo "<br><br><br><b>Thg table to display all status:</b><br>";
echo "<table cellpadding='10' border='0'>";
echo "<tr bgcolor=#C5F7F7>";
for ( $i=0 ; $i<count($title) ; $i++ ) {
    if ( $i != 4) {
        echo "<td width='100px' align='center'>".$title[$i]."</td>";
    }
}
echo "</tr>";
echo "<tr>";
for ( $i=0 ; $i<count($status_counts) ; $i++ ) {
    if ( $i != 4) {
        echo "<td width='5em' align='center'>".$status_counts[$i]."</td>";
    }
}
echo "</tr>";
echo "</table>";

}

?>
</body>
</html>
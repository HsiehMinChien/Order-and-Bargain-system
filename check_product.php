<?PHP

require('config.php');
$con = mysql_connect($db_host, $db_user, $db_pass);

if (!$con) {
    die('Could not connect:'.mysql_error());
} 

mysql_select_db($db_name, $con);

// For aviod maximum execution time of 30 seconds exceeded
//set_time_limit(0);

	/* Get data from _GET['Product'] */
	if ( isset($_GET['Product']) && $_GET['Product'] != '' ) {
	
		/* Transfer string to UTF-8 format */
        $product = $_GET['Product'];
        $product_utf8 = iconv(mb_detect_encoding($product), "UTF-8", $product);

        $query = "SELECT * FROM ".$tb_name1;
        $result = mysql_query($query, $con) or die('Error in query');
        $Check_result = 0;

        if ($row_amount = mysql_num_rows($result)) {

            $i = 1;
            $counts = 1;
            $Check_result = 1;
            $ticket = 0;
            while ( $counts <= $row_amount ) {
        
                $query1 = "SELECT * FROM ".$tb_name1." WHERE userid = ".$i;
                $result1 = mysql_query($query1, $con) or die('Error in query1');
                if ($result1) {

                $data = mysql_fetch_row($result1);
        
                    if ( $data == "" ) {
                        $i++;
                    } else {
                        $i++;
                        $counts++;
                        $p_data = $data[1];
                        $p_data_utf8 = iconv(mb_detect_encoding($p_data), "UTF-8", $p_data);
                        if ( $p_data_utf8 == $product_utf8 ) {
                            $Check_result = 0;
                            $ticket = $data[0];
                            break;
                        }
                }
                } else {
                    $Check_result = 2;
                }
            }
        } else {
            $Check_result = 2;
        }
        
        if ($Check_result == 0) {
			echo $ticket;
		} else if ($Check_result == 1) {
			echo 'valid';
		} else if ($Check_result == 2) {
            echo 'ServerFail';
        }
	} else if (isset($_GET['Product']) && $_GET['Product'] == '') {
        echo 'Empty';
    }

mysql_close($con);

?>
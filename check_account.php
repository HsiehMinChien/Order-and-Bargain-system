<?php 
require('config.php');

// Set connect
$con = mysql_connect($db_host, $db_user, $db_pass);

if (!$con) {
    die('Could not connect:'.mysql_error());
} 

// Select data base
mysql_select_db($db_name, $con);

	// Get data from 'GET'
	if ( isset($_GET['email']) && $_GET['email'] != '' ) {

        $email = $_GET['email'];

        // Get data from DB for confirm how many data in DB.
        $query = "SELECT * FROM ".$tb_name;
        $result = mysql_query($query, $con) or die('Error in query');
        $Check_result = 0;

        if ($row_amount = mysql_num_rows($result)) {

            $i = 1;
            $counts = 1;
            $Check_result = 1;
            while ( $counts <= $row_amount ) {
        
                // Get each data form DB to compate with input data.
                $query1 = "SELECT * FROM ".$tb_name." WHERE userid = ".$i;
                $result1 = mysql_query($query1, $con) or die('Error in query1');
                $data = mysql_fetch_row($result1);
        
                if ( $data == "" ) {
                    $i++;
                } else {
                    $i++;
                    $counts++;
                    // Compare
                    if ( $data[1] == $email ) {
                        $Check_result = 0;
                        break;
                    }
                }
            }
        } else {
            // Connect Server Fail
            $Check_result = 2;
        }
        
        // Set status for script to confirm.
        if ($Check_result == 0) {
			echo 'invalid';
		} else if ($Check_result == 1) {
			echo 'valid';
		} else if ($Check_result == 2) {
            echo 'ServerFail';
        }
	} else if (isset($_GET['email']) && $_GET['email'] == '') {
        // Forget to type account
        echo 'Empty';
    }
	
?>
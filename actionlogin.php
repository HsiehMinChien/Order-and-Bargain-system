<?php
require('config.php');

$email = $_POST['email'];
$password = $_POST['password'];
$refer = $_POST['refer'];
$input_v_num = $_POST['input_v_num'];
$auto_v_num = $_POST['auto_v_num'];

if ($email == '' || $password == '' || $input_v_num != $auto_v_num )
{
    header('Location: refer.php');
}
else
{
    // Authenticate user
    $con = mysql_connect($db_host, $db_user, $db_pass);
    mysql_select_db($db_name, $con);
    
    $query = "SELECT userid, MD5(UNIX_TIMESTAMP() + userid + RAND(UNIX_TIMESTAMP()))
        guid, authority FROM ".$tb_name." WHERE email = '$email' AND password = password('$password')";

    $result = mysql_query($query, $con)
    	or die ('Error in query');
    
    if (mysql_num_rows($result))
    {
        $row = mysql_fetch_row($result);
        // Update the user record
        $query = "UPDATE ".$tb_name." SET guid = '$row[1]' WHERE userid = $row[0]";
            
        mysql_query($query, $con)
        	or die('Error in query');
        
        // Set the cookie and redirect
        // setcookie( string name [, string value [, int expire [, string path
        // [, string domain [, bool secure]]]]])
        // Setting cookie expire date, 6 hours from now
        $cookieexpiry = (time() + 21600);
        setcookie("session_id", $row[1], $cookieexpiry);

        if (empty($refer) || !$refer)
        {
            $refer = 'Test.php';
        }
        if ($row[2] == 10) {
            header('Location: '.$refer);
        } else {
            header('Location: Test1.php');
        }
        
    }
    else
    {
        // Not authenticated
        header('Location: refer.php');
    }
}
?>

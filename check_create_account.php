<!DOCTYPE>
<html>
<head><title>Create Account Page (DEMO System)</title>
</head>
<body>
<?php

require('config.php');
$name = $_POST['A_name'];
$password = $_POST['A_password'];
$identity = $_POST['identity'];
$input_v_num = $_POST['input_v_num'];
$auto_v_num = $_POST['auto_v_num'];

if( $name == "" || $password == "" || $identity == "" || $input_v_num != $auto_v_num ) {
    echo "<font color='red'>There have some data not be filled or the verification code is incorrect!!</font>";
} else {

    $con = mysql_connect($db_host, $db_user, $db_pass);

    if (!$con) {
        die('Could not connect:'.mysql_error());
    }

    mysql_select_db($db_name, $con);

    if ( $identity == "sales" ) {
        $identity = 10;
    } else if ( $identity == "customer" ) {
        $identity = 20;
    }

    $query = "INSERT INTO ".$tb_name." (userid, email, password, guid, authority, Time)
    VALUES (NULL, '".$name."', password('".$password."'), NULL, ".$identity.", NULL);";

    $result = mysql_query($query, $con) or die('Error in query');

    if ($result){

        echo "Create Account Success!";

    } else {
        echo "Create Account Fail!";
    }

}

?>
</body>
</html>
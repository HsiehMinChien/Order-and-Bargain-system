<!DOCTYPE>
<html>
<head><title>Login Page (DEMO System)</title>
<style type="text/css">
     /*將CSS寫在HTML中*/
fieldset {
    border:0;
    padding:10px;
    margin-bottom:10px;
    background:#EEE;

    border-radius: 8px;
    -moz-border-radius: 8px;
    -webkit-border-radius: 8px;

    background:-webkit-liner-gradient(top,#EEEEEE,#FFFFFF);
    background:linear-gradient(top,#EFEFEF,#FFFFFF);

    box-shadow:3px 3px 10px #666;
    -moz-box-shadow:3px 3px 10px #666;
    -webkit-box-shadow:3px 3px 10px #666;
    }

legend {
    padding:5px 10px;
    background-color:#4F709F;
    color:#FFF;

    border-radius:3px;
    -moz-border-radius:3px;
    -webkit-border-radius:3px;

    box-shadow:2px 2px 4px #666;
    -moz-box-shadow:2px 2px 4px #666;
    -webkit-box-shadow:2px 2px 4px #666;
    }

</style>
</head>
<body>

<?php
$a = time();
if( $a%3 == 0 ) {
    $a1 = $a*2;  
} else if ( $a%3 == 1 ) {
    $a1 = $a;
} else {
    $a1 = $a*3;
}
$v = substr($a1,-4);
//echo "1. ".substr($a1,-4,1);
//echo "<br>2. ".substr($a1,-3,1);
//echo "<br>3. ".substr($a1,-2,1);
//echo "<br>4. ".substr($a1,-1,1);
$v1 = array(substr($a1,-4,1), substr($a1,-3,1), substr($a1,-2,1), substr($a1,-1,1));

/*
if($v%2 == 0) {

} else {
for ( $i=0 ; $i<4 ; $i++) {
    //echo "<br>1.v1:".$v1[$i];
    switch ( $v1[$i] ) {
        case 0:
            $v1[$i] = "零";
        break;
        case 1:
            $v1[$i] = "壹";
        break;
        case 2:
            $v1[$i] = "二";
        break;
        case 3:
            $v1[$i] = "三";
        break;
        case 4:
            $v1[$i] = "四";
        break;
        case 5:
            $v1[$i] = "五";
        break;
        case 6:
            $v1[$i] = "六";
        break;
        case 7:
            $v1[$i] = "七";
        break;
        case 8:
            $v1[$i] = "八";
        break;
        case 9:
            $v1[$i] = "九";
        break;
    }
    //echo "<br>2.v1:".$v1[$i];
}
}
*/
?>
<b> Welcome to the login page, please typing your account and password. </b><br><br>

<form action="actionlogin.php" method="POST">
<fieldset bgcolor=#C9FFC9>
<legend>LOGIN</legend>
<label for="input_username">- Account:<br>
<input type="text" name="email" id="input_username">
<br>
<label for="input_userpassword">- Password:<br>
<input type="password" name="password" id="input_userpassword">
<br>
<label for="input_v">- Verification code<br>
<input type="value" name="input_v_num" id="input_v"> <?php echo $v1[0].$v1[1].$v1[2].$v1[3]; ?><br>
<input type="submit" name="submit" value="Login">
<input type="hidden" name="refer" value="<?php echo (isset($_GET['refer'])) ? $_GET['refer'] : 'Test.php'; ?>">
<input type="hidden" name="auto_v_num" value="<?php echo $v; ?>">
</fieldset>
</form>
<br>
<a href="create_account.php" target="_blank">Create New Account</a>
<?php //echo "Print _GET['refer']: ".$_GET['refer']; ?>

</body>
</html>

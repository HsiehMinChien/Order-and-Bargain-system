<!DOCTYPE>
<html>
<head><title>Create New Account (DEMO System)</title>
<script src="check_fill.js"></script>
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
?><br>
<p><b> Please fill following content to create new account </b></p>
<form name="reg" action="check_create_account.php" method="POST">
- Account:<br>
<input type="text" name="A_name">
<br><br>
- Password:<br>
<input type="password" name="A_password">
<br><br>
- Confirm Password:<br>
<input type="password" name="A_password_confirm">
<br><br>
- Identify:<br>
<input type='radio' name='identity' value='sales'> Customer Service Staff<br>
<input type='radio' name='identity' value='customer'> Customer<br>
<br>
- Verification code:<br>
<input type="value" name="input_v_num"> <?php echo $v1[0].$v1[1].$v1[2].$v1[3]; ?><br>
<!-- <input type="submit" name="submit" value="Create"><br> -->
<input type="button" value="Create" onClick="check_create_account()">
<input type="reset" value="Reset">
<input type="hidden" name="auto_v_num" value="<?php echo $v; ?>">
</form>
</body>
</html>

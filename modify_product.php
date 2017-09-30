<!DOCTYPE>
<html>
<head><title>Update product information (DEMO System)</title>
<link rel="stylesheet" type="text/css" href="format.css">
<style type="text/css">
fieldset {
    width: 200px;
		/*height: 800px;*/
    margin: 0 auto;
}
</style>
<script src="check_fill.js"></script>
</head>
<body>
<?php
?>
<h2 align="center">Update product infomation - Please type the product ticket which you want to modify.</h2>
<fieldset bgcolor=#C9FFC9>
<form name="reg" action="modify_product_action.php" method="POST">
- Ticket Number<br>
<input type="value" name="ticket" value="0"><br>
<!-- <input type="submit" name="submit" value="Submit"><br> -->
<input type="button" value="Submit" onClick="check_update_pro_info()">
<input type="reset" value="Reset">
</form>
</fieldset>
</body>
</html>

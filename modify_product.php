<!DOCTYPE>
<html>
<head><title>Update product information (DEMO System)</title>
<script src="check_fill.js"></script>
</head>
<body>
<?php
?>
<p>Update product infomation - Please type the product ticket which you want to modify.</p>
<form name="reg" action="modify_product_action.php" method="POST">
- Ticket Number<br>
<input type="value" name="ticket" value="0"><br>
<!-- <input type="submit" name="submit" value="Submit"><br> -->
<input type="button" value="Submit" onClick="check_update_pro_info()">
<input type="reset" value="Reset">
</form>
</body>
</html>

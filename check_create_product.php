<!DOCTYPE>
<html>
<head>
<title>Create New Product Confirm Page (DEMO System)</title>
<link rel="stylesheet" type="text/css" href="format.css">
<style type="text/css">
fieldset {
    width: 500px;
		/*height: 800px;*/
    margin: 0 auto;
}
</style>
</head>
<body>

<fieldset bgcolor=#C9FFC9>
<legend>Double Confirm </legend>
<table style="width:100% border:3px #FFD382 dashed;" cellpadding='10' border='1'>
  <tr>
  <th bgcolor="gray">Product Name</th>
  <th><?PHP echo $_POST['P_name']; ?></th>
  </tr>
  <tr>
  <th bgcolor="gray">Product Description</th>
  <th><?PHP echo $_POST['P_description']; ?></th>
  </tr>
  <tr>
  <th bgcolor="gray">Amount</th>
  <th><?PHP echo $_POST['P_amount']; ?></th>
  </tr>
  <tr>
  <th bgcolor="gray">Cost</th>
  <th><?PHP echo $_POST['P_in_price']; ?></th>
  </tr>
  <tr>
  <th bgcolor="gray">Price</th>
  <th><?PHP echo $_POST['P_out_price']; ?></th>
  </tr>
  <tr>
  <th bgcolor="gray">Comment</th>
  <th><?PHP echo $_POST['P_comment']; ?></th>
  </tr>
  <tr>
  <th bgcolor="gray">Creator</th>
  <th><?PHP echo $_POST['email']; ?></th>
  </tr>
  </table>
<form action="action_create_product.php" method="POST">
  <input type="hidden" name="P_name" value="<?PHP echo $_POST['P_name']; ?>">
  <input type="hidden" name="P_description" value="<?PHP echo $_POST['P_description']; ?>">
  <input type="hidden" name="P_amount" value="<?PHP echo $_POST['P_amount']; ?>">
  <input type="hidden" name="P_in_price" value="<?PHP echo $_POST['P_in_price']; ?>">
  <input type="hidden" name="P_out_price" value="<?PHP echo $_POST['P_out_price']; ?>">
  <input type="hidden" name="P_comment" value="<?PHP echo $_POST['P_comment']; ?>">
  <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
  <input type="submit" name="submit" value="Submit">
</form>
</fieldset>
</body>
</html>

<?php
session_start();
if(!isset($_SESSION['us']) || (trim($_SESSION['us'])=='')) {
header("location: index.php");
exit();
}
?>
<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
 <script src="js/jquery-1.9.1.js"></script>
<script>
<?php

?>
	function changeVal(x,y)
	{
		  var q = document.getElementById("amt" + x).value;		
		  var w = document.getElementById("f" + x);
		 
		  w.value = q*y;
		  var e = x+1;
		  document.frmPayPal1.elements["quantity_" + e].value = document.getElementById("amt" + x).value;
		//alert(document.frmPayPal1.elements["quantity_" + x].value);
	}
	function checkMax(x,y,z,g)
	{
		if(z>=g)
		{
			//alert("1");
			document.getElementById("amt" + x).value = g;
			changeVal(x,y);
		}
		else
		{
			changeVal(x,y);
		}
		
	}
	  $(document).ready(function() {
            
         
            $('.numonly').keydown(function(event) {
   
                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) 
                    || (event.keyCode >= 35 && event.keyCode <= 39)){
                        return;
                }else {

                    if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                        event.preventDefault(); 
                    }   
                }
            });
            
        });

</script>
</head>
	<div id="container">
			 <?php
		
			function getInfox($x,$y)
{
	@include "conn.php";
	$mysqli = new mysqli($host, $user, $pass, $db);
	$res = $mysqli->query("SELECT * FROM tblSettings where var='$x' LIMIT 1");
	$x="";
	while ($row = $res->fetch_object())
	{
		if($y=='value')
		{
			$x= $row->value;
		}
		elseif($y=='opt1')
		{
			$x= $row->opt1;
		}
		elseif($y=='opt2')
		{
			$x= $row->opt2;
		}
		elseif($y=='pic')
		{
			$x= $row->pic;
		}
	}
return $x;
}
?>
			<div id="header" style="background-image:url(images/<?php echo getInfox('banner','pic'); ?>);">
		</div>
		<?php include 'nav.php'; ?>
		<body>
		<div id="body">
		<?php 
			if (isset($_SESSION['cart']))
			{
			$cart = $_SESSION['cart'];
			}
			else
			{
			$cart="";
			}
			
			if (isset($_GET['action']))
			{
			$action = $_GET['action'];
			}
			else
			{
				$action="";
			}
			
		


	switch ($action) {
	
		case 'add':
			if ($cart) {
				$cart .= ','.$_GET['id'];
			} else {
				$cart = $_GET['id'];
			}
			break;

			}

			$_SESSION['cart'] = $cart;
			
			if (!$cart) {
			echo'<p>No Product Selected</p>';
		}
	
	if ($cart) {
		$items = explode(',',$cart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$output[] = '<form action="tempcart.php" method="post" id="frmcart" name="frmcart">';
		$output[] = '<table class="table table-striped table-bordered table-condensed">';
		$output[] = '<tr>';
		//$output[] = '<td>Code</td>';
		$output[] = '<td>Item</td>';
		$output[] = '<td>Quantity</td>';
		$output[] = '<td>Price</td>';
		$output[] = '<td></td>';
		$output[] = '</tr>';
		$x = 0;
		$d=0;
		$totalf="";
		foreach ($contents as $id=>$qty) {
			include "conn.php";
			$mysqli = new mysqli($host, $user, $pass, $db);
			$res = $mysqli->query("SELECT * FROM tblcatalog where id='$id'");
		

			while ($row = $res->fetch_object())
			{
			$output[] = '<tr>';
			$output[] = '<td>'.$row->fname.'</td>';
			$output[] = '<td><input type="number" class="numonly" maxlength="5" max="'.getItemQty($row->id).'" onchange="checkMax('.$x.','.$row->price.',this.value,'.getItemQty($row->id).');" name="amt'.$x.'"  id="amt'.$x.'" value="1"><input type="hidden" name="'.$x.'" value="'.$row->id.'">  On Stock:'.getItemQty($row->id).'</td>';			
			//$output[] = '<td><input type="number"  disabled="disabled" class="numonly" maxlength="5" max="'.getItemQty($row->id).'" onchange="changeVal('.$x.','.$row->price.');" name="amt'.$x.'"  id="amt'.$x.'" value="1"><input type="hidden" name="'.$x.'" value="'.$row->id.'">  On Stock:'.getItemQty($row->id).'</td>';			
			$output[] = '<td><input type="text" name="f'.$x.'" id="f'.$x.'" value="'.$row->price.'" readonly></td>';
			$output[] = '<td><a class="my-'.getInfo('theme','value').'" href="remove.php?name='.$row->id.'">Remove</a></td>';
			$output[] = '</tr>';
			$totalf = $totalf + $row->price;
			$d = $d + $row->price;

			$x=$x+1;
			}
			
		}
		$x=$x-1;
		echo join('',$output);
	echo'</table>';
	echo '<input type="hidden" name="tt" value="'.$x.'">';
	echo '</form>';
		// $output[] = '<tr>';		
		// $output[] = '<td colspan="3">Total</td>';
		// $output[] = '<td>'.$totalf.'</td>';		
		// $output[] = '</tr>';
		// $output[] = '<tr>';
		// $output[] = '<td colspan=4><input type="hidden" name="tt" value="'.$x.'"></td>';
		// $output[] = '</form>';
		
// $output[] = '<script src="https://www.paypalobjects.com/js/external/paypal-button.min.js?merchant=pogipol.facilitator@gmail.com" ';
 // $output[] = '   data-button="buynow" ';
// $output[] = '    data-name="Subjects" ';
// $output[] = '    data-amount="'.$d.'" ';
// $output[] = '    data-currency="PHP" ';
 // $output[] = '   data-shipping="0" ';
 // $output[] = '   data-tax="0" ';
  // $output[] = '  data-env="sandbox"></script>';



		//$output[] = '<td><input type="submit" value="Enroll"></td>';
		
			$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr';
$paypal_id='carinoedwin.08-facilitator@gmail.com'; 

	?>
	
	<form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1" id="frmPayPal1" >
    <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
    
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<?php
$i = 1;

	foreach ($contents as $id=>$qty) {
			include "conn.php";
			$mysqli = new mysqli($host, $user, $pass, $db);
			$res = $mysqli->query("SELECT * FROM tblcatalog where id='$id'");
		
			
			while ($row = $res->fetch_object())
			{
				echo'<input type="hidden" name="item_name_'.$i.'" value="'.$row->fname.'">';
				echo'<input type="hidden" name="item_number_'.$i.'" value="'.$row->id.'">';
				echo'<input type="hidden" name="amount_'.$i.'" value="'.$row->price.'">';
				echo'<input type="hidden" name="quantity_'.$i.'"  id="quantity_'.$i.'" value="1">';		
				$i=$i+1;
			}
			
		}
?>
 
 
<!--
	
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="cpp_header_image" value="">
	-->
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="PHP">
    <input type="hidden" name="handling" value="0">
	<input type="hidden" name="rm" value="2">
    <input type="hidden" name="cancel_return" value="http://localhost:8080/NuOnlineStore/cancel.php">
    <input type="hidden" name="return" value="http://localhost:8080/NuOnlineStore/success.php?ggg=asdd">
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>
	
<?php
	} else {
		$output[] = '<p>.</p>';
	}
	function getItemQty($x)
	{
		@include 'conn.php';
		$qwe =0;	
		$mysqli = new mysqli($host, $user, $pass, $db);

		if ($result = $mysqli->query("select * from tblcatalog where id='$x'"))
		{
			while ($row = $result->fetch_object())
			{
				$qwe = $row->qty;

			}
		}
		return $qwe;
	}
	
?>

		<?php include 'footer.php'; ?>
		
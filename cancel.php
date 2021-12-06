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
</head>
	<div id="container">
		<div id="header">
		</div>
		<?php include 'nav.php'; ?>
		<body>
		<div id="body">
		<h1>You cancelled your order</h1>
  
		
		<?php include 'footer.php'; ?>
		
<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<link href="css/bootstrap.css" rel="stylesheet">

<script src="js/jquery-1.9.1.js"></script>

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
		<div id="qwe"></div>
		<div id="leftadmin" class="panel panel-<?php echo getInfox('theme','value'); ?>">
		<div class="panel-heading">Send us a Message</div>
  <div class="panel-body">
 <form role="form" method="post" id="frmcomment" action="auth.php?action=frmcomment">
      <div class="form-group">
        <label for="title">Name</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Name" required/>
      </div>
	   <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required/>
      </div>
      <div class="form-group">
	   <label for="descr">Comment</label>
        <textarea class="form-control" rows="10" id="descr" name="descr"></textarea>
      </div>
           <input type="submit" class="btn btn-<?php echo getInfox('theme','value'); ?>">
    </form>
  </div>
    
  </div>
  <div id="rightadmin" class="panel panel-<?php echo getInfox('theme','value'); ?>">
  <div class="panel-heading">Contact Us</div>
  <div class="panel-body">
 <?php echo getInfox('contactus','value'); ?>
  </div>
  </div>



		<?php include 'footer.php'; ?>
		
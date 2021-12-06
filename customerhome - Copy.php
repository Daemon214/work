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
		  <div id="leftadmin" class="panel panel-<?php echo getInfox('theme','value'); ?>">
  

  <div class="panel-heading">Information</div>
  <div class="panel-body">
	<?php echo getInfox('aboutus','value'); ?>

  </div>

    
	 

  </div>
  <div id="rightadmin" class="panel panel-<?php echo getInfox('theme','value'); ?>">
  <div class="panel-heading">News and Updates</div>
  <div class="panel-body" id="panelright">
  
  <?php
	@include 'conn.php';
		$link = mysqli_connect($host,$user,$pass,$db) or die("Error " . mysqli_error($link));
		$query = "Select * from tblnews order by id desc limit 0,5" or die(mysqli_error($link));
		$result = $link->query($query);
		while ($row = $result->fetch_object())
		{
		echo '<h3>'.$row->topic.'</h3>';
		echo '<blockquote>';
		echo '<p style="font-size:14px">';
		echo $row->content;
		echo '</p>';
		echo '<footer>Posted by admin on <cite title="Source Title">'.$row->ddate.'</cite></footer>';
		echo '</blockquote>';	
		}
		
	
  
  ?>
</div>
</div>

  
		
		<?php include 'footer.php'; ?>
		
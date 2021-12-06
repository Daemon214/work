<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<link href="css/bootstrap.css" rel="stylesheet">

<style>
.carousel {
    height: 500px;
    margin-bottom: 60px;
}
/* Since positioning the image, we need to help out the caption */
 .carousel-caption {
    z-index: 10;
}
/* Declare heights because of positioning of img element */
 .carousel .item {
    width: 100%;
    height: 500px;
    background-color: #777;
}
.carousel-inner > .item > img {
    position: absolute;
    top: 0;
    left: 0;
    min-width: 100%;
    height: 500px;
}
@media (min-width: 768px) {
    .carousel-caption p {
        margin-bottom: 20px;
        font-size: 21px;
        line-height: 1.4;
    }
}
img {

}
</style>

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
		<div class="panel panel-<?php echo getInfox('theme','value'); ?>">
		  <div class="panel-heading">About Us</div>
  <div class="panel-body">
<?php echo getInfox('aboutus','value'); ?>
</div>
</div>
</div>

		<?php include 'footer.php'; ?>
		
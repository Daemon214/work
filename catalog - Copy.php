<?php
session_start();

?>
<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script>
	function regfirst()
	{
		alert("please register first");
		
	}
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
		<div id="leftcustomer">
		<h3>Categories</h3>
		<ul class="list-unstyled">


		<?php
		
		@include 'conn.php';
		$mysqli = new mysqli($host, $user, $pass, $db);
		if ($result = $mysqli->query("SELECT * FROM tblcategory"))
		{
			echo '<li><a class="my-'.getInfo('theme','value').'" href="catalog.php">All ('.getItemCount(0).')</a></li>';
			while ($row = $result->fetch_object())
			{
				echo '<li><a class="my-'.getInfo('theme','value').'" href="catalog.php?cat='.$row->id.'">'.$row->descr.' ('.getItemCount($row->id).')</a></li>';
			}
		}
		
		function getItemCount($x)
		{
			@include 'conn.php';
			$mysqli = new mysqli($host, $user, $pass, $db);
			if($x==0)
			{
			$result = $mysqli->query("SELECT * FROM tblcatalog");
			}
			else
			{
			$result = $mysqli->query("SELECT * FROM tblcatalog where cat=$x");
			}
			
			$count = $result->num_rows;
			return $count;
		}
		?>
		</ul>
  </div>
  <div id="rightcustomer" class="panel panel-<?php echo getInfox('theme','value'); ?>">
  <div class="panel-heading">Product List</div>
  <div class="panel-body" style="overflow:auto;height:650px;">
 <?php
	@include 'conn.php';	
	if(isset($_GET['cat']))
	{
		$cat = $_GET['cat'];
		$str="SELECT * FROM tblcatalog where cat=$cat";
	}
	else
	{
		$str="SELECT * FROM tblcatalog";
	}
	$mysqli = new mysqli($host, $user, $pass, $db);
	if ($result = $mysqli->query($str))
	{
		$ct = 0;
		$count = $result->num_rows;
		while ($row = $result->fetch_object())
		{
			if($ct==0)
			{
				echo '<div class="row">';
				
			}
			echo '<div class="col-sm-6 col-sm-3">';
			echo '  <div class="thumbnail">';
			echo '	 <img src="images/'.$row->pic.'" alt="" style="min-height:100px;height:100px;">';
			echo '  </div>';
			echo '  <div class="caption">';
			echo '	 <h3>'.$row->fname.'</h3>';
			echo '	 <p>'.$row->descr.'</p>';
			echo '	 <p>';
			echo '<h4><span class="label label-success">'.$row->price.'</span> ';
			if(isset($_SESSION['us']))
			{
				if(getQuantity($row->id)>=1)
				{
				echo '<span class="label label-primary pull-right"><a href="checkout.php?action=add&id='.$row->id.'" class="label label-primary" role="button">Add to Cart</a></span></h4>';
				}
				else
				{
				echo '<span class="label label-primary pull-right">Out of Stock</span></h4>';
				}
			}
			else
			{
				if(getQuantity($row->id)>=1)
				{
				echo '<span class="label label-primary pull-right"><a href="registration.php" onclick="regfirst()" class="label label-primary" role="button">Add to Cart</a></span></h4>';
				}
				else
				{
				echo '<span class="label label-primary pull-right">Out of Stock</span></h4>';
				}
			}
			
			
		
			echo '	 </p>';
			echo '  </div>';
			echo '</div>';
			
			
			$ct=$ct+1;
			if($ct>=4)
			{
				echo '</div>';
				$ct=0;
			}
			
		}
		if($count<=3)
		{
		echo '</div>';
		}
		else
		{
			echo '</div>';
		}	
		
	}
	
	function getQuantity($x)
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
  
</div>
</div>
		<?php include 'footer.php'; ?>
		
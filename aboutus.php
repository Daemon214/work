<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
 <?php
		
			function getInfox($x,$y)
{
	@include "conn.php";
	$mysqli = new mysqli($host, $user, $pass, $db);
	$res = $mysqli->query("SELECT * FROM tblsettings where var='$x' LIMIT 1");
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
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo getInfox('companyname','value'); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
    <!-- Add custom CSS here -->
    <link href="css/business-casual.css" rel="stylesheet">
</head>

<body>

    <div class="brand"><?php echo getInfox('companyname','value'); ?></div>
    <div class="address-bar"><?php echo getInfox('companyaddr','value'); ?> | <?php echo getInfox('companyphone','value'); ?></div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo getInfox('companyname','value'); ?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
        <?php include 'newnav.php'; ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

     <div class="container">

        <div class="row">
            <div class="box">
               <div class="col-lg-12">
                   
                    <h2 class="intro-text text-center">About Us</h2>
                   <img class="img-responsive" style="width:1200px;height:18px;top:1004px;" src="images/heading-2-border.png"/>
				   <br/>
				   <h2 style="color:#6a9b06;">About Marsha's</h2>
				   <p>Marsha's Tapsilogam opened in March 2014. It is a food place restaurant.  With the aim to promote health and wellness while breaking down the misconception that a plant-based diet is lacking in flavor and expensive, Marsha's became an established sustainable business. 7 years on and with an ever-increasing loyal following, Marsha's remains a byword of a pure Tapsilogan business in the Philippines.</p>
				    <br/>
				   <h2 style="color:#6a9b06;">Mission</h2>
				   <p>Our mission is to prepare and serve healthy and flavorful tapsilogan food to people from all walks of life. We have a continued commitment to incorporating, wholesome and natural ingredients and promoting business practices that respect the Earth.</p>
				   <br/>
				   <h2 style="color:#6a9b06;">Vision</h2>
				   <p>Our vision is that Marsha's will successfully promote tapsilogan by providing quality food to as many people possible, especially Filipinos.</p>
				   
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
		 

    </div>
    <!-- /.container -->

    <?php
	include 'footermain.php';
  ?>

    <!-- JavaScript -->
      <script src="js/jquery-1.11.0.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>
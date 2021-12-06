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
                <div class="col-md-6">
                   
                    <h2 class="intro-text text-center" style="font-family: 'Vollkorn', serif;">Find Us</strong>
                    </h2>
                    <img class="img-responsive" style="width:100%;height:18px;top:1004px;" src="images/heading-2-border.png"/>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.2564360697866!2d121.10796671385577!3d14.698085089740447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ba46fa0bdd91%3A0x7b9f9206ccc34469!2sMarsha&#39;s%20Tapsilogan!5e0!3m2!1sen!2sph!4v1637293547171!5m2!1sen!2sph" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
					<p>Address: <strong><?php echo getInfox('companyaddr','value'); ?></strong><br/>
					Phone: <strong><?php echo getInfox('companyphone','value'); ?></strong><br/>                    
                    Email: <strong><?php echo getInfox('email','value'); ?></strong>                   
                    
                    </p>
                </div>
                
				<div class="col-md-6">
                   
                    <h2 class="intro-text text-center" style="font-family: 'Vollkorn', serif;">Get In Touch
                    </h2>
                     <img class="img-responsive" style="width:100%;height:18px;top:1004px;" src="images/heading-2-border.png"/>
					<p> How can we help you? Got a question, a comment, or suggestion? We’d love to hear from you.</p>
					<br/>
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
					   <label for="descr">Nature</label>
						<select name="type" class="form-control">
							<option value="inquiry">Inquiry</option>
							<option value="suggestion">Suggestion</option>
							<option value="Complaints">Complaints</option>
							<option value="others">Others</option>
						</select>
					  </div>
					  <div class="form-group">
					   <label for="descr">Comment</label>
						<textarea class="form-control" rows="10" id="descr" name="descr"></textarea>
					  </div>
						   <input type="submit" class="btn btn-<?php echo getInfox('theme','value'); ?>">
					</form>
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
    <script>
    // Activates the Carousel
    $('.carousel').carousel({
        interval: 3000
    })
    </script>

</body>

</html>

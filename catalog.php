<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<?php
		function getInfox($x,$y) {
			@include "conn.php";
			$mysqli = new mysqli($host, $user, $pass, $db);
			$res = $mysqli->query("SELECT * FROM tblsettings where var='$x' LIMIT 1");
			$x="";
			while ($row = $res->fetch_object()) {
				if($y=='value')
					$x = $row->value;
				elseif($y=='opt1')
					$x = $row->opt1;
				elseif($y=='opt2')
					$x = $row->opt2;
				elseif($y=='pic')
					$x = $row->pic;
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
		<!-- Add custom CSS here -->
		<script src="js/jquery-1.9.1.js"></script>
		<script src="js/bootbox.js"></script>
		<link href="css/business-casual.css" rel="stylesheet">
		<style>
			.menutext {
				letter-spacing: -1px;
			}
			#cont ul {		 
				padding:0 0 0 0;
				margin:0 0 0 0;
			}
			#cont ul li img {
				cursor: pointer;
			}
			.controls {
				width:50px;
				display:block;
				font-size:11px;
				padding-top:8px;
				font-weight:bold;		  
			}
			.next {
				float:right;
				text-align:right;
			}
		</style>
		<script>
			var prodno;
			var bmr;
			var platecount;
			$(document).ready(function(){
				$(".viewprod").click(function(e){
					$('#qwe').empty();
					$.ajax({
						type: 'post',
						url: 'auth.php?action=viewprod&prodno='+prodno,
						success: function (data) {
							//alert(data);
							$("#qwe").append(data);
							$('#ViewModal').modal('show');
						}
					});
					e.preventDefault();	
				});
			});

			function setProdNo(x, y) {
				prodno = x;
				bmr = y;
			}

			function regfirst() {
				alert("Please register first");
			}

			$(document).ready(function() {
				$("#myok").click(function(){
					$('#myplatecount').text(platecount);
					$('.mymsg').html('<strong>Success</strong> Added to tray');
					$("#confirm-delete").modal('hide');
				}); 
			});

			$(document).ready(function(){
				$(".addtotray").click(function(e) {
					<?php if(isset($_SESSION['us'])) { ?>
						$('#qwe').empty();
						$.ajax({
							type: 'GET',
							url: 'auth.php?action=addtotray&prodno='+prodno,
							dataType: "json",
							success: function (data) {
								// $("#qwe").append(data);
								// platecount = data.num;
								// if(data.cal > <?php echo getBMR($_SESSION['us']) ?>) {
								// 	alert("Added to tray " + data.num + " " + "<?php echo getBMR($_SESSION['us']) ?>");
								// 	$('#confirm-delete').modal('show');
								// }
								// else {
									$('#myplatecount').text(data.num);
								// }
							}
						});
						e.preventDefault();
					<?php } else { ?>
						$('#qwe').empty();
						$.ajax({
							type: 'post',
							url: 'auth.php?action=addtotray&prodno='+prodno,
							success: function (data) {
								// $("#qwe").append(data);			 			
								$('#myplatecount').text(data);
								//alert("Added to tray");
							}
						});
						e.preventDefault();
					<?php } ?>
				});
			});

			$(document).ready(function(){
				//$(".success-alert").hide();
				<?php 
					@include 'conn.php';
					$mysqli = new mysqli($host, $user, $pass, $db);
					$str="SELECT * FROM tblcatalog where cat=".$_GET['cat_id'];
					if ($result = $mysqli->query($str)) {
						while ($row = $result->fetch_object()) {
							echo '$("#vv'.$row->id.'").hide();';
						}
					}
				?>
				$(".labasvalue").click(function showAlert() {
					$("#xx" + prodno).hide();
					$(".hhd" + prodno).hide();
					$("#vv" + prodno).alert();
					$("#vv" + prodno).fadeTo(2000, 500).slideUp(1, function(){
						$("#vv" + prodno).alert('close');
						$("#xx" + prodno).show();
						$(".hhd" + prodno).show();			  
						$(".hhd" + prodno).css({'margin-left':'+=180px'});
					});   
				});
			});
		</script>
		<?php
			if(isset($_GET['itemno'])) {
				//alert("Settings !" + prodno)
				echo '<script>setProdNo('.$_GET['itemno'].');</script>';
				echo '<script>
					$.ajax({
						type: "post",
						url: "auth.php?action=viewprod&prodno="+'.$_GET['itemno'].'+"&cat_id="+'.$_GET['cat_id'].',
						success: function (data) {
							$("#qwe").append(data);
							$("#ViewModal").modal("show");
						}
					});
				</script>';
			}
		?>
	</head>

	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					Oops!! Daily Calorie Intake Reached..				
				</div>
				<div class="modal-body">
					Are you sure you want to add this to tray?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<input id = "myok" class="btn btn-confirm" type="submit" value="Okay"/>

				</div>
			</div>
		</div>
	</div>
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

	<body id="body">
		<div class="container">
			<?php
				//echo checkCartCal();
				@include 'conn.php';
				$mysqli = new mysqli($host, $user, $pass, $db);
				// if ($result = $mysqli->query("SELECT * FROM tblcategory")) {
				// 	echo '<li><a class="my-'.getInfox('theme','value').'" href="catalog.php">All ('.getItemCount(0).')</a></li>';
				// 	while ($row = $result->fetch_object()) {
				// 		echo '<li><a class="my-'.getInfox('theme','value').'" href="catalog.php?cat='.$row->id.'">'.$row->descr.' ('.getItemCount($row->id).')</a></li>';
				// 	}
				// }

				function getSomething($x) {
					@include 'conn.php';
					$mysqli = new mysqli($host, $user, $pass, $db);
					$count = "";
					if($result = $mysqli->query("SELECT * FROM tblcategory where id = $x")) {
						while ($row = $result->fetch_object()) {
							$count = $row->descr;
						}
					}
					return $count;
				}

				function getItemCount($x) {
					@include 'conn.php';
					$mysqli = new mysqli($host, $user, $pass, $db);
					if($x==0)
						$result = $mysqli->query("SELECT * FROM tblcatalog");
					else
						$result = $mysqli->query("SELECT * FROM tblcatalog where cat=$x");

					$count = $result->num_rows;
					return $count;
				}

				echo '<div class="row">
					<div class="box">
						<div class="col-lg-12">
							<h2 class="intro-text text-center">'.getSomething($_GET['cat_id']).'</h2>
							<img class="img-responsive" style="width:1200px;height:18px;top:1004px;" src="images/heading-2-border.png"/>
							<br/>
							<ul id="cont" class="row">';

				$str = "SELECT * FROM tblcatalog where cat=".$_GET['cat_id'];

				if ($result = $mysqli->query($str)) {
					$ct = 0;
					$count = $result->num_rows;
					while ($row = $result->fetch_object()) {
						if(isset($_SESSION['us'])) {
							echo '<div class="col-sm-4 text-center" style="padding:0px 10px 0px 0px;">';
							echo '<a href="" class="viewprod" onclick="setProdNo('.$row->id.','.getBMR($_SESSION['us']).')">
								<img class="img-responsive" src="images/'.$row->pic.'" style="width:450px;height:200px" alt="">
							</a>';
							echo '<h4 class="menutext">'.$row->fname.'</h4>';	
							
							if(getQuantity($row->id) >= 1) {
								//echo '<h4><span class="label label-success"><a href="" class="label label-success addtotray labasvalue" onclick="setProdNo('.$row->id.')" role="button">Add to Tray</a></span></h4>';
								echo '<div class="alert alert-success" id="xx'.$row->id.'"><a href="" class="label label-success addtotray labasvalue" onclick="setProdNo('.$row->id.','.getBMR($_SESSION['us']).')" role="button">Add to Tray</a></div>';
							 	//echo '<div class="alert alert-success" id="xx'.$row->id.'"><input type="submit" class="btn btn-success addtotray labasvalue" onclick="setProdNo('.$row->id.')"  value="Add to Tray"></div>';
								echo '<div class="alert alert-success" id="vv'.$row->id.'">	
									<span class="mymsg">
										<strong>Success! </strong> Added to tray
									</span>
								</div>';
							}
							else {
								//echo '<h4><span class="label label-success">Php'.$row->price.'</span><!-- <span class="label label-primary"><a href="#" class="label label-primary" role="button">Out of Stock</a></span>--></h4>';
							}
						}
						else {
							echo '<div class="col-sm-4 text-center" style="padding:0px 10px 0px 0px;">';
							echo '<a href="" class="viewprod" onclick="setProdNo('.$row->id.',0)"><img class="img-responsive" src="images/'.$row->pic.'" style="width:450px;height:200px" alt=""></a>';
							echo '<h4 class="menutext">'.$row->fname.'</h4>';

							if(getQuantity($row->id) >= 1) {
								//echo '<h4><span class="label label-success"><a href="registration.php" onclick="regfirst()" class="label label-success" role="button">Add to Tray</a></span></h4>';	
								echo '<div class="alert alert-success" id="xx'.$row->id.'"><a href="registration.php" class="label label-success" onclick="regfirst()" role="button">Add to Tray</a></div>';
							}
							else {
								//echo '<h4><span class="label label-success">Php'.$row->price.'</span><!-- <span class="label label-primary"><a href="#" class="label label-primary" role="button">Out of Stock</a></span>--></h4>';
							}
						}
						echo '</div>';
						//echo '<li class="col-sm-4" style="list-style:none; margin-bottom:25px; "><img  alt="'.$row->fname.'" class="img-responsive"  src="images/'.$row->pic.'"/></li>';
					}

					echo '		</ul>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>';
				}

				function getQuantity($x) {
					@include 'conn.php';
					$qwe = 0;
					$mysqli = new mysqli($host, $user, $pass, $db);

					if ($result = $mysqli->query("select * from tblcatalog where id='$x'")){
						while ($row = $result->fetch_object()) {
							$qwe = $row->qty;
						}
					}
					return $qwe;
				}
			?>
		</div>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div  class="modal-dialog" style="width: 90%;">
				<div class="modal-content">		 
					<div class="modal-body">
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<script>
			$(document).ready(function(){		
				$('li img').on('click',function(){
					var src = $(this).attr('src');
					var alt = $(this).attr('alt');
					var img = '<img src="' + src + '" alt="' + alt + '" width="100%" height="100%" class="img-responsive"/>';

					var index = $(this).parent('li').index();   

					var html = '';
					html += '<div style="float:left;width:50%;padding:5px;">';
					html += 	img; 
					html += '	<h3 class="text-center" id="qxx">' + alt + '</h3>';
					html += '</div>';
					html += '<div style="float:left;width:50%;padding:5px;">';
					html += '	<h4 class="text-center">Nutrition Facts<br><span><h6>amount/per serving (gluten-free)</h6></span></h4><h4>Total Calories</h4>';
					html += '	<h6>Total Fat(G)<br/>Saturated Fat(G)<br/>Cholesterol(G)<br/>Sodium (mg)<br/>Total Carbohydrates (g)<br/>Fiber (mg)<br/>Sugar (mg)<br/>	Protien (mg)<br/>Calcium (mg)<br/>	Iron (mg)</h6>';
					html += '	<hr>';
					// html += '<h4 class="text-center">Workout Plan<br></h4>';
					// html += '<form>';
					// html += '<table style="width:80%">';
					// html += '<tr><td><h6>Gender</h6></td><td><h6><select><option>male</option><option>female</option></select></h6></td>	</tr>';
					// html += '<tr><td><h6>Routine</h6></td><td><h6><select><option>Intermediate</option><option>Hard</option><option>Intense</option><option>Elderly</option></select></h6></td></tr>';
					// html += '<tr><td><input type="submit" value="submit"></td></tr>';
					// html += '</table>';
					// html += '</form>';
					html += '</div>';

					html += '<div style="height:25px;clear:both;display:block;">';
					html += '	<a class="controls next" href="'+ (index+2) + '">next &raquo;</a>';
					html += '	<a class="controls previous" href="' + (index) + '">&laquo; prev</a>';
					html += '</div>';
					
					$('#myModal').modal();
					$('#myModal').on('shown.bs.modal', function(){
						$('#myModal .modal-body').html(html);
						$('a.controls').trigger('click');
					});

					$('#myModal').on('hidden.bs.modal', function(){
						$('#myModal .modal-body').html('');
					});
				});
			});

			$(document).on('click', 'a.controls', function() {
				var index = $(this).attr('href');
				var src = $('ul.row li:nth-child('+ index +') img').attr('src');
				var alt = $('ul.row li:nth-child('+ index +') img').attr('alt');
				
				$('.modal-body img').attr('src', src);
				$('#qxx').text(alt);
				
				var newPrevIndex = parseInt(index) - 1; 
				var newNextIndex = parseInt(newPrevIndex) + 2; 

				if($(this).hasClass('previous')) {
					$(this).attr('href', newPrevIndex); 
					$('a.next').attr('href', newNextIndex);
				}
				else {
					$(this).attr('href', newNextIndex); 
					$('a.previous').attr('href', newPrevIndex);
				}

				var total = $('ul.row li').length + 1; 
				if(total === newNextIndex){
					$('a.next').hide();
				}
				else {
					$('a.next').show()
				}			
				
				if(newPrevIndex === 0){
					$('a.previous').hide();
				}
				else {
					$('a.previous').show()
				}

				return false;
			});
		</script>
		<!-- /.container -->

		<div id="qwe"></div>
		<?php
			function getBMR($x) {
				return 0; // TEMPORARY
				@include "conn.php";
				$mysqli = new mysqli($host, $user, $pass, $db);
				$res = $mysqli->query("SELECT * FROM tblcustomers where us='$x'");
				$gender="";
				$wt="";
				$ht1="";
				$ht2="";
				$age="";
				$dp ="";
				
				while ($row = $res->fetch_object()) {
					$str = $row->dp;
					$gender = $row->gender;
					$wt=$row->wt;
					$ht1=$row->ht1;
					$ht2=$row->ht2;
					$age=$row->age;
					$al = $row->al;
					$dp= $row->dp;
				}
				
				//BMR FORMULA
				if($gender=='male') {
					$bmr = 10 * ($wt*0.453592) + 6.25 * (($ht1*30.48)+($ht2*2.54)) - 5 * $age + 5;
				}
				else {
					$bmr = 10 * ($wt*0.453592) + 6.25 * (($ht1*30.48)+($ht2*2.54)) - 5 * $age - 161;
				}

				//sedentary = 1.4
				//light 1.5
				//moderate 1.6
				//veryactive 1.9

				if ($al == "s") {
					$bmr = $bmr*1.4;
				}
				else if ($al == "l") {
					$bmr =  $bmr*1.5;
				}
				else if($al == "m") {
					$bmr = $bmr*1.6;
				}
				else if($al=="a") {
					$bmr =  $bmr*1.9;
				}

				if($dp == 'wl') {
					$bmr = $bmr-500;
				}
				else if($dp == 'gd') {
					$bmr = $bmr+500;
				}
				else if($dp == 'wg') {
					$bmr = $bmr+1000;
				}
				else if($dp=='hp') {
					$bmr = $bmr+500;
				}
				return $bmr;
			}
			include 'footermain.php';
		?>
		<!-- JavaScript -->
		<script src="js/jquery-1.11.0.js"></script>
		<script src="js/bootstrap.js"></script>

	</body>

	</html>
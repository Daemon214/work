<?php
session_start();
if(!isset($_SESSION['us']) || (trim($_SESSION['us'])=='')) {
header("location: index.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
	<?php
		function getInfox($x, $y) {
			@include "conn.php";
			$mysqli = new mysqli($host, $user, $pass, $db);
			$res = $mysqli->query("SELECT * FROM tblsettings where var='$x' LIMIT 1");
			$x = "";

			while ($row = $res->fetch_object()) {
				if($y=='value') {
					$x= $row->value;
				}
				elseif($y=='opt1') {
					$x= $row->opt1;
				}
				elseif($y=='opt2') {
					$x= $row->opt2;
				}
				elseif($y=='pic') {
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
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
		<title><?php echo getInfox('companyname','value'); ?></title>

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="css/font-awesome.css">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-flex.css" rel="stylesheet">
		<!-- Add custom CSS here -->
		<script src="js/jquery-1.9.1.js"></script>
		<link href="css/business-casual.css" rel="stylesheet">
		
		<script>
			var calbu = "";
			$(function() {
				$('#xasd').on("click",function(e) {
					var ct = 0;
					calbu += '<table class="tg">';
					calbu += '<tr><th class="tg-26t4">30 Mins</th><th class="tg-26t4"> Estimated calories burned</th></tr>';
					
					$('#calburn *').filter(':input').each(function(){
						if(ct == 0) {
							calbu += '<tr><td class="tg-3rwt">' + this.value + '</td>';
							ct=1;
						}
						else {
							calbu += '<td class="tg-3rwt">' + this.value + '</td></tr>';
							ct=0;
						}
					});
					
					calbu += '</table>';
					$('#frmcart').submit();
					//alert(calbu);
				});
			});
			
			$(function () {
				$('#frmcart').on('submit', function (e) {
					$.ajax({
						type: 'post',
						url: 'auth.php?action=sendemail&calbu='+calbu,
						data: $('form').serialize(),
						success: function (data) {
							// alert(data);
							$("#qwe").append(data);
							// location.reload();
						}
					});
					e.preventDefault();
				});
			});

			function validate(evt) {
				var theEvent = evt || window.event;
				var key = theEvent.keyCode || theEvent.which;
				key = String.fromCharCode( key );
				var regex = /[0-9]|\./;
				if( !regex.test(key) ) {
					theEvent.returnValue = false;
					if(theEvent.preventDefault)
						theEvent.preventDefault();
				}
			}

			function updatePrice(element, key) {
				let obj = $(element);
				let total = $("#total_"+key);
				let price = $("#price_"+key).val();

				total.val(parseFloat(price * obj.val()).toFixed(2));
				updateTotal();
			}

			function updateTotal() {
				let total = $('#zx');
				let inputTotal = $('.input-total');

				let sum = 0;
				inputTotal.each((k, v) => {
					sum += parseFloat($(v).val());
				});

				total.val(sum.toFixed(2));
			}
		</script>
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

		<form role="form" method="post" class="container" action="order.php" enctype="multipart/form-data">
			<div class="row">
				<div class="box">
					<div class="col-lg-12">
						  <h2 class="intro-text text-center">My Cart</h2>
					   <img class="img-responsive" style="width:1200px;height:18px;top:1004px;" src="images/heading-2-border.png"/>
					   <br/>
					</div>
				  
					<div class="col-lg-12">
					   	<div id="qwe"></div>
						<?php
							if (isset($_SESSION['cart'])) {
								$cart = $_SESSION['cart'];
							}
							else {
								$cart="";
							}
							
							if (isset($_GET['action'])) {
								$action = $_GET['action'];
							}
							else {
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
								echo'<p>Cart Empty!!</p>';
							}
							
							if ($cart) {
								$items = explode(',',$cart);
								$contents = array();
								foreach ($items as $item) {
									$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
								}
								
								$output[] = '<div id="frmcart" name="frmcart">';
								$output[] = '<table class="table table-bordered table-condensed">';
								$output[] = '<thead>';
								$output[] = '<th>Item</th>';
								$output[] = '<th>QTY</th>';
								$output[] = '<th style="width:100px;">Price</th>';
								$output[] = '<th style="width:100px;">Total</th>';
								$output[] = '<th></th>';
								$output[] = '</thead>';
								$x = 0;
								$d = 0;
								$totalf = 0;
								foreach ($contents as $id=>$qty) {
									include "conn.php";
									$mysqli = new mysqli($host, $user, $pass, $db);
									$res = $mysqli->query("SELECT * FROM tblcatalog where id='$id'");

									while ($row = $res->fetch_object()) {
										$output[] = '<tr>';
										$output[] = '<td>'.$row->fname.'<input type="hidden" name="pi[]" value="'.$row->id.'"></td>';
										$output[] = '<td>
											<input class="form-control numonly" type="number" style="width:50px;" onkeypress="validate(event)" maxlength="5" min="1" onchange="updatePrice(this,\''.preg_replace('/\s+/','_',strtolower($row->fname)).'\');" name="amt[]"  id="amt'.$x.'" value="1"><input type="hidden" name="'.$x.'" value="'.$row->id.'">
										</td>';	
										// $output[] = getNut($row->id,$x);
										// $output[] = '<td><input type="number" onkeypress="validate(event)"  class="numonly" maxlength="5" min="1" max="'.getItemQty($row->id).'" onchange="checkMax('.$x.','.$row->price.',this.value,'.getItemQty($row->id).');" name="amt'.$x.'"  id="amt'.$x.'" value="1"><input type="hidden" name="'.$x.'" value="'.$row->id.'">  On Stock:'.getItemQty($row->id).'</td>';			
										// $output[] = '<td><input type="number"  disabled="disabled" class="numonly" maxlength="5" max="'.getItemQty($row->id).'" onchange="changeVal('.$x.','.$row->price.');" name="amt'.$x.'"  id="amt'.$x.'" value="1"><input type="hidden" name="'.$x.'" value="'.$row->id.'">  On Stock:'.getItemQty($row->id).'</td>';			
										$output[] = '<td>
											<input class="form-control" type="text" name="pp[]" id="price_'.preg_replace('/\s+/','_',strtolower($row->fname)).'" value=" ₱'.$row->price.'" readonly>
										</td>';
										$output[] = '<td>
											<input class="form-control input-total" type="text" name="pt[]" id="total_'.preg_replace('/\s+/','_',strtolower($row->fname)).'" value="₱'.$row->price.'" readonly>
										</td>';
										$output[] = '<td>
											<a class="btn btn-default" href="remove.php?name='.$row->id.'">Remove</a>
										</td>';
										$output[] = '</tr>';
										$totalf = $totalf + $row->price;
										$d = $d + $row->price;

										$x = $x + 1;
									}
								}
								$x = $x - 1;
								echo join('',$output);

								echo '<tr>';
								echo '<td></td>';
								echo '<td style="width:15px"></td>';
								echo '<td></td>';
								// echo '<td id="tcarbs"></td>';
								// echo '<td id="tprot"></td>';
								// echo '<td id="tfat"></td>';
								// echo '<td id="tkal"></td>';
								echo '<td><input class="form-control" type="text" name="zx" id="zx" value="'.number_format($d, 2).'" readonly></td>';
								echo '<td><a class="btn btn-default" href="catalog.php?cat_id=1">Add Order</a></td>';
								echo '<td></td>';
								echo '</tr>';
								
								echo'</table>';
								echo '<input type="hidden" name="tt" id="tt" value="'.$x.'">';
								
								if(!$cart) {}
								else {
									echo '';
								}
								echo '</div>';
								// $output[] = '<tr>';		
								// $output[] = '<td colspan="3">Total</td>';
								// $output[] = '<td>'.$totalf.'</td>';		
								// $output[] = '</tr>';
								// $output[] = '<tr>';
								// $output[] = '<td colspan=4><input type="hidden" name="tt" value="'.$x.'"></td>';
								// $output[] = '</form>';
								
								// $output[] = '<script src="https://www.paypalobjects.com/js/external/paypal-button.min.js?merchant=pogipol.facilitator@gmail.com" ';
								// $output[] = '   data-button="buynow" ';
								// $output[] = '	data-name="Subjects" ';
								// $output[] = '	data-amount="'.$d.'" ';
								// $output[] = '	data-currency="PHP" ';
								// $output[] = '   data-shipping="0" ';
								// $output[] = '   data-tax="0" ';
								// $output[] = '  data-env="sandbox"></script>';


								//$output[] = '<td><input type="submit" value="Enroll"></td>';
							}
							else {
								$output[] = '<p>.</p>';
							}

							function getItemQty($x) {
								@include 'conn.php';
								$qwe =0;	
								$mysqli = new mysqli($host, $user, $pass, $db);

								if ($result = $mysqli->query("select * from tblcatalog where id='$x'")) {
									while ($row = $result->fetch_object()) {
										$qwe = $row->qty;
									}
								}
								return $qwe;
							}

							function getNut($x, $uu) {
								@include "conn.php";
								$mysqli = new mysqli($host, $user, $pass, $db);
								$res = $mysqli->query("SELECT * FROM tblingredients where prod_id='$x'");
								$s="";
								$g ="";
								$tep = "";
								$tc=0;
								$tp=0;
								$tf =0;
								$tcal = 0;
								$tt=0;

								while ($row = $res->fetch_object()) {
									$totcal = ($row->grams/100)*$row->kcal;
									$totcarbs = ($row->grams/100)*$row->carb;
									$totalpro = ($row->grams/100)*$row->protein;
									$totalfat = ($row->grams/100)*$row->fat;
									$tt = $tt + $totcal;
									$tc = $tc + $totcarbs;
									$tp = $tp + $totalpro;
									$tf = $tf + $totalfat;
								}
								$GLOBALS['b'] = (isset($GLOBALS['b']) ? $GLOBALS['b'] : 0) + $tt;
								$s = '<td class="carbs" id="carbs'.$x.'" name="carbspr">'.number_format($tc,2).'</td>
									<td class="prot" id="prot'.$x.'" name="protpr">'.number_format($tp,2).'</td>
									<td class="fat" id="fat'.$x.'"name="fatpr">'.number_format($tf,2).'</td>
									<td class="kcal" id="kcal'.$x.'"name="kcalpr">'.number_format($tt,2).'</td>
									<input type="hidden" id="ocarbs'.$x.'" value="'.number_format($tc,2).'"/>
									<input type="hidden" id="oprot'.$x.'" value="'.number_format($tp,2).'"/>
									<input type="hidden" id="ofat'.$x.'" value="'.number_format($tf,2).'"/>
									<input type="hidden" id="okcal'.$x.'" value="'.number_format($tt,2).'"/>';
								
								return $s;
							}
						?>
						<br/><br/>

						
					</div>

					<div class="modal fade" id="disclamer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<h4 class="modal-title" id="myModalLabel">Disclaimer</h4>
								</div>
								
								<div class="modal-body">
									<p>
										This website is simply a tool that responds like a dietician,
										considered as an expert system that uses formula handed over by a licensed dietician and nutritionist.
										This is no way a replacement for a real medical advice because there are a lot of factors to consider aside
										from the things considered here in the website. These are randomly generated diets built by a licensed dietician
										and nutritionist. Though there shouldn’t be anything technically wrong with the meal plans that the system
										generated, I am not responsible for anything that may happen to you while using this service.
										Basically, don’t follow a diet that’s making you uncomfortable or uneasy.
										Have any questions? Read the FAQ page or send us an email at greensresto@gmail.com
									</p>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>

					<div class="clearfix"></div>
				</div>
			</div>
			
			<?php
				@include "conn.php";
				$mysqli = new mysqli($host, $user, $pass, $db);
				$username = $_SESSION['us'];
				$user = $mysqli->query("SELECT * FROM tblcustomers where us='$username'")->fetch_object();
			?>

			<div class="row">
				<div id="myplan" class="box">
					<div class="col-lg-12">
						<h2 class="intro-text text-center">Checkout</h2>
						<img class="img-responsive" style="width:1200px;height:18px;top:1004px;" src="images/heading-2-border.png"/>
						<br/>
					</div>

					<div class="col-md-6 text-center">
						<h2 class="intro-text text-center">Billing & Payment</h2>
						
						<p style="width: 75%;" class="d-flex flex-row mx-auto"><span>First Name:</span><span class="ml-auto"><?php echo $user->fname ?></span></p>
						<p style="width: 75%;" class="d-flex flex-row mx-auto"><span>Last Name:</span><span class="ml-auto"><?php echo $user->lname ?></span></p>
						<p style="width: 75%;" class="d-flex flex-row mx-auto"><span>Contact  No.:</span><span class="ml-auto"><?php echo $user->mobile ?></span></p>
						<p style="width: 75%;" class="d-flex flex-row mx-auto"><span>Address:</span><span class="ml-auto"><?php echo $user->addr ?></span></p>
						<p style="width: 75%;" class="d-flex flex-row mx-auto"><span>Payment Method:</span><span class="ml-auto">COD</span></p>

						<input type="hidden" name="billing_username" value="<?php echo $username ?>">
					</div>

					<div class="col-md-6 text-center">
						<h2 class="intro-text text-center">Shipping Address</h2>
						
						<p style="width: 75%;" class="d-flex flex-row mx-auto">
							<span>First Name:</span>
							<span class="ml-auto my-auto">
								<input type="text" class="form-control" name="shipping_first_name" value="<?php echo $user->fname ?>">
							</span>
						</p>
						
						<p style="width: 75%;" class="d-flex flex-row mx-auto">
							<span>Last Name:</span>
							<span class="ml-auto my-auto">
								<input type="text" class="form-control" name="shipping_last_name" value="<?php echo $user->lname ?>">
							</span>
						</p>
						
						<p style="width: 75%;" class="d-flex flex-row mx-auto">
							<span>Contact  No.:</span>
							<span class="ml-auto my-auto">
								<input type="text" class="form-control" name="shipping_contact" value="<?php echo $user->mobile ?>">
							</span>
						</p>
						
						<p style="width: 75%;" class="d-flex flex-row mx-auto">
							<span>Address:</span>
							<span class="ml-auto my-auto">
								<input type="text" class="form-control" name="shipping_address" value="<?php echo $user->addr ?>">
							</span>
						</p>
					</div>

					<div class="col-lg-12 text-center">
						<br/>
						<input type="submit" class="btn btn-default" value="Submit"/>
					</div>
					
					<div class="clearfix"></div>
				</div>
			</div>
		</form>
		<!-- /.container -->

		<?php include 'footermain.php'; ?>

		<!-- JavaScript -->
		<script src="js/jquery-1.11.0.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<script>
			var nowTemp = new Date();
			var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

			$('#dpd1').datepicker({
				beforeShowDay: function (date){
					var xd = new Date(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0, 0);
					
					if(xd < now) {
						return false;
					}
					else {
						return true;
					}
				}
			});	

			var totcarbs=0.00;
			var totprot=0.00;
			var totfat=0.00;
			var totkal=0.00;
			$(document).ready(function() {
				$(".carbs").each(function() {				
					totcarbs = parseFloat(totcarbs) + parseFloat($(this).html());
				});
				
				$(".prot").each(function() {
					totprot = parseFloat(totprot) + parseFloat($(this).html());
				});

				$(".fat").each(function() {
					totfat = parseFloat(totfat) + parseFloat($(this).html());
				});

				$(".kcal").each(function() {
					totkal = parseFloat(totkal) + parseFloat($(this).html());
				});

				$('#tcarbs').html(totcarbs.toFixed(2).toString());
				$('#tprot').html(totprot.toFixed(2).toString());
				$('#tfat').html(totfat.toFixed(2).toString());
				$('#tkal').html(totkal.toFixed(2).toString());
			});

			$(function() {
				$("#ppp").click(function() {
					$(this).toggleClass("active");
				});
			});

			// Activates the Carousel
			$('.carousel').carousel({
				interval: 3000
			});
		</script>
	</body>
</html>
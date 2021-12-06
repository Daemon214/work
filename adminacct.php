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
	<link rel="stylesheet" type="text/css" href="lib/bootstrap3-wysihtml5.min.css"></link>
	<script src="js/jquery-1.9.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />




	<script>
		$(function () {
			$('#qwe').empty();
			$('#frmchangepass').on('submit', function (e) {
				$.ajax({
					type: 'post',
					url: 'auth.php?action=addacct',
					data: $('form').serialize(),
					success: function (data) {
						$("#qwe").append(data);
			//$(data).appendTo('#qwe');
              //alert('form was submitted');
			  //location.reload();

			}
		});
				e.preventDefault();
			});
		});

		$(function () {
			$('#qwe').empty();
			$('#formSettings').on('submit', function (e) {
				var formData = new FormData($(this)[0]);

				$.ajax({
					type: 'post',
					url: 'auth.php?action=formSettings',
					data: formData,
					async: false,
					cache: false,
					contentType: false,
					processData: false,
					success: function (data) {
						$("#qwe").append(data);
			//$(data).appendTo('#qwe');
              //alert('form was submitted');
			  //location.reload();

			}
		});
				e.preventDefault();
			});
		});


		function confirmdelx() {
			var answer = confirm("Are you Sure you want to delete?");
			if (answer){


					//window.location('auth.php?action=delcat&id'+catno);
					return true;
				}
				else{
					alert("Cancelled!");
					return false;
				}
			}


		</script>
	</head>
	<div id="container">
		<div id="header" style="background-image:url(images/<?php echo getInfox('banner','pic'); ?>);">
		</div>
		<?php include 'nav.php'; ?>
		<body>
			<div id="body">
				<div style=" display: flex; flex-direction:column">
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



					<!---admin--->
					<div style="display:flex;flex-direction:row;flex-grow:1;max-width:100%;margin-bottom:2.5rem;">
						<div class="panel panel-<?php echo getInfo('theme','value'); ?>" style="width:45%;margin: 0 2.5%;">
							<div class="panel-heading">User Admin</div>
							<div class="panel-body">
								<table class="table table-striped table-bordered table-condensed">
									<thead>
										<tr>
											<th>User Name</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php
										@include "conn.php";
										$mysqli = new mysqli($host, $user, $pass, $db);
										$str= "";

										$str="select * from tblusers where stat='admin'";


										if ($result = $mysqli->query($str))
										{
											while ($row = $result->fetch_object())
											{
												echo '<tr>';
												echo '<td>'.$row->us.'</td>';							
												echo '<td><a href="auth.php?action=delacct&id='.$row->id.'"  class="my-'.getInfo('theme','value').'" onclick="return confirmdelx();">Delete</a></td>';						
												echo '</tr>';

											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>


						<!----Users--->
						<div class="panel panel-<?php echo getInfo('theme','value'); ?>" style="width:45%;margin: 0 2.5%;">
							<div class="panel-heading">Users</div>
							<div class="panel-body" style = "height: 115px; overflow: auto;">
								<table class="table table-striped table-bordered table-condensed">
									<thead>
										<tr>
											<th>User Name</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php
										@include "conn.php";
										$mysqli = new mysqli($host, $user, $pass, $db);
										$str= "";

										$str="select * from tblusers where stat='customer'";


										if ($result = $mysqli->query($str))
										{
											while ($row = $result->fetch_object())
											{
												echo '<tr>';
												echo '<td>'.$row->us.'</td>';							
												echo '<td><a href="auth.php?action=delacct&id='.$row->id.'"  class="my-'.getInfo('theme','value').'" onclick="return confirmdelx();">Delete</a></td>';						
												echo '</tr>';

											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>


					<!---order details-->
					<div style="display:flex;flex-direction: row;flex-grow:1;">
						<div class="panel panel-<?php echo getInfo('theme','value'); ?>" style="width:45%;margin: 0 2.5%;">
							<div class="panel-heading">Orders</div>
							<form action ="adminacct.php" method ="get" style = "padding-top:5px; padding-left: 5px;">
								<button value = "submit" style = "margin-top:10px; margin-left: 10px;"> Sort by</button>
								<select name = "filter">
									
									<option value="0" <?php  echo (isset($_GET['filter']) ? ($_GET['filter'] == '0' ? '' : 'selected') : '') ?>>Pending</option>
									<option value="1" <?php  echo (isset($_GET['filter']) ? ($_GET['filter'] == '1' ? 'selected' : '') : '') ?>>Completed</option>
																	
								</select>

							</form>
							<div class="panel-body" style = "height: 100%; overflow: auto;">
								<table class="table table-striped table-bordered table-condensed">
									<thead>
										<tr>
											<th>User Name</th>
											<th>Order</th>
											<th>Date</th>
											
											<th>total</th>
											<th>status</th>
											<th>update</th>

										</tr>
									</thead>
									<tbody>
										<?php
										@include "conn.php";
										$mysqli = new mysqli($host, $user, $pass, $db);
										$mysqli2 = new mysqli($host, $user, $pass, $db);
										$mysqli3 = new mysqli($host, $user, $pass, $db);
										$str= "";
										$str="select * from tbltransactions";

										$str2="select * from tbltransactiondetails";
										$fil = $_GET['filter'];

										if (isset($_GET['filter'])) {
											$str="select * from tbltransactions where status =".$_GET['filter'];
											$str2="select itemid from tbltransactiondetails";						
										}

										if ($result = $mysqli->query($str))
										{
											while ($row = $result->fetch_object())
											{
												echo '<tr>';
												echo '<td>'.$row->fname.'</td>';
												echo '<td>';
												if ($result2 = $mysqli2->query("SELECT * FROM `tbltransactiondetails` WHERE `tid` = $row->id")) {
													echo '<div id="item' . $row->id . '" class="modal">';

													while ($row2 = $result2->fetch_object()) {
														if ($result3 = $mysqli3->query("SELECT * FROM `tblcatalog` WHERE `id` = $row2->itemid")) {
															echo '<div style="display:flex;flex-direction:row;justify-content:center;">';
															echo 	'<span style="width:50%;text-align:left;margin-left:auto;">' . $result3->fetch_array()[2] . '</span>';
															echo 	'<span style="width:25%;text-align:center;margin-right:auto;">x' . $row2->qty . '</span>';
															//echo 	'<span style="width:25%;text-align:center;margin-right:auto;">' . $row2->price . '</span>';
															echo '</div>';
														}
													}

													echo '
													</div>
													<p><a href="#item' . $row->id . '" rel="modal:open">Order Details</a></p>';
												}
												echo '</td>';

												echo '<td>'.$row->ddate.'</td>';
												
												echo '<td>₱'.$row->total.'</td>';

												if ($row->status == 0) {
													echo '<td style ="color:red;">pending</td>';
												}
												else{

													echo '<td style= "color:green;">completed</td>';
												}



												if ($fil == true){
													echo '<td>	
													<button>
													<a class="my-'.getInfo('theme','value').'" onclick="remove('.$row->id.');">remove</a>
													</button>
													</td>';						
													echo '</tr>';
												}

												else{																			
													echo '
													<td style = "color: orange;">
													<button>
													<a class="my-'.getInfo('theme','value').'" onclick="setcomplete('.$row->id.');">set as complete</a>
													</button>
													</td>';						
													
													echo '</tr>';
												}

											}

										}

										?>
									</tbody>
								</table>
							</div>
						</div>

						<div id="rightadmin" class="panel panel-<?php echo getInfo('theme','value'); ?>" style="width:45%;margin: 0 2.5%;">
							<div class="panel-heading">Add User</div>
							<div class="panel-body" id="panelright">

								<form role="form" id="frmchangepass" method="post">

									<div class="form-group">
										<label for="old">User Name</label>
										<input type="text" class="form-control" id="old" name="old" placeholder="Username" required>
									</div>
									<div class="form-group">
										<label for="newpass">New Password</label>
										<input type="password" class="form-control" id="newpass" name="newpass" placeholder="Password" required>
									</div>
									<div class="form-group">
										<label for="rpw">Repeat Password</label>
										<input type="password" class="form-control" id="rpw" name="rpw" placeholder="Repeat Password"  required>
									</div>

									<input type="submit" class="btn btn-<?php echo getInfo('theme','value'); ?> pull-right" id="submit">
								</form>
								<div id="qwe"></div>
							</div>
						</div>
					</div>
				</div>

				<script>
					function setcomplete(id){
						$.get("setcomplete.php", {
							id: id
						});
					}

					function remove(id){
						$.get("complete.php", {
							id: id
						});
					}



				</script>
				



				<?php include 'footer.php'; ?>
				
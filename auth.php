<?php
session_start();

error_reporting(E_ALL); ini_set('display_errors', 1); 

include 'conn.php';
$link = mysqli_connect($host,$user,$pass,$db) or die("Error " . mysqli_error($link));
$at = $_GET['action'];

switch ($at)
{
		case 'login':
		$us = $link->real_escape_string($_POST['us']);
		$pw = $link->real_escape_string($_POST['pw']);
		$query = "Select * from tblusers where us='$us' and pw='$pw'" or die("Error in the consult.." . mysqli_error($link));
		$result = $link->query($query);
		$count = $result->num_rows;
		if($count>=1)
		{
				while ($row = $result->fetch_object())
				{
					if($row->active==0)
					{
						echo modalMe('Login Failed!','Account Deactivated!!!');
					}
					else
					{
						if($row->stat=="admin")
						{
						$_SESSION['us'] = $us;
						$_SESSION['stat'] =$row->stat;
						$_SESSION['uid'] =$row->id;
						 if (isset($_SESSION['us'])) {
							//header("Location: admin.php");
							echo "<script type='text/javascript'>window.location = 'admin.php'</script>";
						}
						}
						else if($row->stat=="customer")
						{
							$_SESSION['us'] = $us;
							$_SESSION['stat'] =$row->stat;
							$_SESSION['uid'] = $row->id;
							 if (isset($_SESSION['us'])) {
								//header("Location: index.php");
								echo "<script type='text/javascript'>window.location = 'index.php'</script>";
								
							}
						}
						
					}
					
								
				}
						
		}
		else
		{
			//echo "<script type='text/javascript'>alert ('Wrong Username/Password !!')</script>";
			echo modalMe('Login Failed!','Wrong Username/Password !!!');
			//echo "<script type='text/javascript'>window.location = 'login.php'</script>";
		}
	
		
	break;
	
	case 'insert':

	$fname = $_POST['fname'];
	$category = $_POST['category'];
	$descr = $_POST['descr'];
	$price = $_POST['price'];
	$target_path = "images/";
	$target_path = $target_path . basename($_FILES['uploadedfile']['name']); 

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	$pic = basename($_FILES['uploadedfile']['name']);
	$sql ="insert into tblcatalog (cat,fname,descr,pic,qty,price) values('$category','$fname','$descr','$pic',1,'$price')";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	//echo "<script type='text/javascript'>alert ('Entry Saved !!')</script>";
	echo "<script type='text/javascript'>window.location = 'admincatalog.php'</script>";
	}
	else
	{
		echo "Error! File too large";
	}
	break;
	
	case 'addcustomer':
	$mysqli1 = new mysqli($host, $user, $pass, $db); 
	
	include_once 'securimage/securimage.php';
	$securimage = new Securimage();
	if ($securimage->check($_POST['captcha_code']) == false) {
	
	echo "<script type='text/javascript'>alert ('Wrong Captcha!!')</script>";
	//echo modalMes('Registration Failed!','Wrong Captcha!',false);
	echo "<script type='text/javascript'>history.go(-1)</script>";
		
	 
	}
	else
	{
		$fname = $mysqli1->real_escape_string($_POST['fname']);
		$mname = $mysqli1->real_escape_string($_POST['mname']);
		$lname = $mysqli1->real_escape_string($_POST['lname']);
		$age = $mysqli1->real_escape_string($_POST['age']);
		$addr = $mysqli1->real_escape_string($_POST['addr']);
		$mobile = $_POST['mobile'];
		$email = $mysqli1->real_escape_string($_POST['email']);
		$gender = $_POST['gender'];
		// $ht1 = $_POST['ht1'];
		// $ht2 = $_POST['ht2'];
		// $wt = $_POST['wt'];
		$us = $_POST['us'];
		$pw = $_POST['pw'];
		// $dp = $_POST['dp'];
		// $al = $_POST['al'];
		// $newsletter = $_POST['newsletter'];
		if(checkIfExist($us))
		{
			echo "<script type='text/javascript'>alert ('Username Already Exist!!')</script>";
			echo "<script type='text/javascript'>window.location = 'registration.php'</script>";
			//echo modalMe('Registration Failed!','Username Already Exist.!');
		}
		else
		{
			$sql1 = "insert into tblusers (us,pw,stat) values ('$us','$pw','customer')";
			
			$res = mysqli_query($mysqli1, $sql1) or die(mysqli_error($mysqli1));
			$sql = "insert into tblcustomers (fname,mname,lname,addr,mobile,email,us,age,gender) values ('$fname','$mname','$lname','$addr','$mobile','$email','$us','$age','$gender')";
			$mysqli = new mysqli($host, $user, $pass, $db); 
			mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
			echo "<script type='text/javascript'>alert ('Registration Successfull !!')</script>";
			//echo modalMe('Registration Successfull!','You can now login your Greens Account!');
			echo "<script type='text/javascript'>window.location = 'index.php'</script>";
		
		}
		
	}
	
	break;
	
	case 'news':
	$mysqli = new mysqli($host, $user, $pass, $db); 
	
	$topic=$mysqli->real_escape_string($_POST['title']);
	$desc=$mysqli->real_escape_string($_POST['desc']);
	$ddate = date("m-d-Y"); 
	$sql = "insert into tblnews (topic,content,ddate) values ('$topic','$desc','$ddate')";
	
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	header("location:admin.php");
	
	break;
	
	case 'editprofile':
	$fname = $_POST['fname'];
	$addr = $_POST['addr'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$us = $_SESSION['us'];

	$sql = "update tblcustomers set fname='$fname',addr='$addr',mobile='$mobile',email='$email' where us='$us'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	echo '<script>alert("Profile Changed!")</script>';
	echo '<script>location.reload()</script>';
	
	break;
	
	case 'changepass';
	$old = $_POST['old'];
	$newpass = $_POST['newpass'];
	$rpw = $_POST['rpw'];
	$us=$_SESSION['us'];
	$sql = "select * from tblusers where pw='$old' and us='$us'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	$count = $result->num_rows;
	if($count>=1)
	{
		if($newpass==$rpw)
		{
			mysqli_query($mysqli, "update tblusers set pw='$newpass' where us='$us'") or die(mysqli_error($mysqli));
			echo '<script>alert("Password Changed!")</script>';
		
			echo '<script>location.reload()</script>';
		}
		else
		{
			echo '<script>alert("Password did not match")</script>';
		}
	}
	else
	{
		echo '<script>alert("Incorrect Old Password")</script>';
	}
	break;
	
		case 'addacct';
	$old = $_POST['old'];
	$newpass = $_POST['newpass'];
	$rpw = $_POST['rpw'];
	$us=$_SESSION['us'];
	$sql = "select * from tblusers where us='$old'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	$count = $result->num_rows;
	if($count>=1)
	{
		echo '<script>alert("Username Already Taken")</script>';
	}
	else
	{
		if($newpass==$rpw)
		{
			mysqli_query($mysqli, "insert into tblusers (us,pw,stat) values ('$old','$rpw','admin') ") or die(mysqli_error($mysqli));
			echo '<script>alert("User Account Created!")</script>';
		
			echo '<script>location.reload()</script>';
		}
		else
		{
			echo '<script>alert("Password did not match")</script>';
		}
	}
	break;
	
	
	case 'addstock':
	$sampleno = $_GET['no'];
	$id = $_GET['id'];
	$sql = "update tblcatalog set qty=qty+$sampleno where id='$id'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

	break;
	
	case 'editproduct':
	$medrepno=$_GET['medrepno'];	
	$mysqli = new mysqli($host, $user, $pass, $db);
	if ($result = $mysqli->query("SELECT * FROM tblcatalog where id='$medrepno'"))
	{
		while ($row = $result->fetch_object())
		{
			echo '<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
			echo '  <div class="modal-dialog">';
			echo '	<div class="modal-content">';
			echo '	  <div class="modal-header">';
			echo '		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
			echo '		<h4 class="modal-title" id="myModalLabel">Edit Item</h4>';
			echo '	  </div>';
			echo '	  <div class="modal-body">';
			echo '<form role="form" id="myformedit">';
			echo '  <div class="form-group">';
			echo '	<label for="fname">Name</label>';
			echo '	<input type="text" class="form-control" id="fname" name="fname" placeholder="Name" value="'.$row->fname.'" required>';
			echo ' </div>';
			echo '  <div class="form-group">';
			echo '	<label for="descr">Description</label>';
			echo '	<textarea class="form-control" rows="10" id="descr" name="descr">'.$row->descr.'</textarea>';
			echo ' </div>';
			echo ' <div class="form-group">';
			echo '	<label for="Price">Price #</label>';
			echo '	<input type="number" class="form-control" id="price" value="'.$row->price.'" name="price"  min="0" max="999999" step="0.01" size="4" required/>';
			echo '  </div>';
			echo '  	 <input type="hidden" id="hd" name="hd" value="editmedrep">';
			echo '  	 <input type="hidden" id="medrepno" name="medrepno" value="'.$row->id.'">';
			echo ' <input type="submit" class="btn btn-'.getInfox('theme','value').'" id="submit">';
			echo '</form>';
			echo '	  </div>';
			echo '	  <div class="modal-footer">';
			echo '		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
			echo '		</div>';
			echo '	</div>';
			echo '  </div>';
			echo '</div>';
			
			echo '<script>';
			echo '$(function () {';
			echo '$("#myformedit").on("submit", function (e) {';
			echo '  $.ajax({';
			echo '	type: "post",';
			echo '	url: "auth.php?action=editproductinfo",';
			echo '	data: $("form").serialize(),';
			echo '	success: function (data) {';
			echo '	$(data).appendTo("#qwe");';
			echo '	  alert("Item Edited");';
			echo 'location.reload();';
			echo '	 $("#EditModal").modal("hide");';
			echo '	}';
			echo '	});';
			echo '	e.preventDefault();';
			echo '	});';
			echo '  });';
			echo '</script>';
		}
	}
	break;
	
	case 'editinfo':
	$mysqli = new mysqli($host, $user, $pass, $db);
	$medrepno=$_GET['medrepno'];	
	
	if ($result = $mysqli->query("SELECT * FROM tblcustomers where us='$medrepno'"))
	{
		while ($row = $result->fetch_object())
		{
			echo '<div class="modal fade" id="editinfos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
			echo '  <div class="modal-dialog">';
			echo '	<div class="modal-content">';
			echo '	  <div class="modal-header">';
			echo '		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
			echo '		<h4 class="modal-title" id="myModalLabel">Edit Info</h4>';
			echo '	  </div>';
			echo '	  <div class="modal-body">';
			echo '<form role="form" id="myformedit">';
			echo '  <div class="form-group">';
			echo '	<label for="fname">Name</label>';
			echo '	<input type="text" class="form-control" id="fname" name="fname" placeholder="Name" value="'.$row->fname.'" required>';
			echo ' </div>';
			
			echo '  <div class="form-group">';
			echo '	<label for="addr">Address</label>';
			echo '	<input type="text" class="form-control" id="addr" name="addr" placeholder="Address" value="'.$row->addr.'" required>';
			echo ' </div>';
			
			echo '  <div class="form-group">';
			echo '	<label for="mobile">Mobile #</label>';
			echo '	<input type="text" class="form-control numonly" id="mobile" onkeypress="validate(event)" name="mobile" placeholder="Mobile #" maxlength="11" value="'.$row->mobile.'" required>';
			echo ' </div>';
			
			echo '  <div class="form-group">';
			echo '	<label for="email">Email</label>';
			echo '	<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="'.$row->email.'" required>';
			echo ' </div>';
			
			echo '  <div class="form-group">';
			echo '	<label for="age">Age</label>';
			echo '	<input type="text" class="form-control numonly" id="age" onkeypress="validate(event)" name="age" placeholder="Age" maxlength="2" value="'.$row->age.'" required>';
			echo ' </div>';
			
			$male = "";
			$female = "";
			if($row->gender=='male')
			{
				$male = "selected";
			}
			else
			{
				$female = "selected";
			}
			echo '  <div class="form-group">';
			echo '	<label for="gender">Gender</label>';
			echo '	<select name="gender" id="gender" class="form-control" required>
										<option value="male" '.$male.'>Male</option>
										<option value="female" '.$female.'>Female</option>
									</select>';
			echo ' </div>';
			
			
			echo '  <div class="form-group">';
			echo '	<label for="ht1">Height</label>';
			echo '	<input type="text" class="form-control numonly" id="ht1" onkeypress="validate(event)" name="ht1" placeholder="Height (Feet)" maxlength="2" value="'.$row->ht1.'" required>';
			echo '	<input type="text" class="form-control numonly" id="ht2" onkeypress="validate(event)" name="ht2" placeholder="Height (Inches)" maxlength="2" value="'.$row->ht2.'" required>';
			echo ' </div>';
			
			echo '  <div class="form-group">';
			echo '	<label for="wt">Weight</label>';
			echo '	<input type="text" class="form-control numonly" id="wt" onkeypress="validate(event)" name="wt" placeholder="Weight (Lbs)" maxlength="2" value="'.$row->wt.'" required>';			
			echo ' </div>';
			
			
			$gd="";
			$wl="";
			$wg="";
			$hp="";
			if($row->dp=="gd")
			{
				$gd="selected";
			}
			else if($row->dp=="wl")
			{
				$wl="selected";
			}
			else if($row->dp=="wg")
			{
				$wg="selected";
			}
			else if($row->dp=="hp")
			{
				$hp="selected";
			}
			
			echo '  <div class="form-group">';
			echo '	<label for="dp">Diet Plan</label>';
			echo '	<select name="dp" id="dp" class="form-control" required>
										<option value="gd" '.$gd.'>General Diet</option>
										<option value="wl" '.$wl.'>Weight Loss</option>
										<option value="wg" '.$wg.'>Weight Gain</option>
										<option value="hp" '.$hp.'>High Protein</option>
									</select>';
			echo ' </div>';
			
			
			$s="";
			$l="";
			$m="";
			$a="";
			if($row->al=="s")
			{
				$s="selected";
			}
			else if($row->al=="l")
			{
				$l="selected";
			}
			else if($row->al=="m")
			{
				$m="selected";
			}
			else if($row->al=="a")
			{
				$a="selected";
			}
			
			echo '  <div class="form-group">';
			echo '	<label for="al">Activity Level</label>';
			echo '	<select name="al" id="al" class="form-control" required>
										<option value="s" '.$s.'>Sedentary</option>
										<option value="l" '.$l.'>Light activity</option>
										<option value="m" '.$m.'>Moderate activity</option>
										<option value="a" '.$a.'>Very Active:</option>
									</select>';
			echo ' </div>';
			
			
			
			
			echo '  	 <input type="hidden" id="hd" name="hd" value="editmedrep">';
			echo '  	 <input type="hidden" id="medrepno" name="medrepno" value="'.$row->id.'">';
			echo ' <input type="submit" class="btn btn-success" id="submit">';
			echo '</form>';
			echo '	  </div>';
			echo '	  <div class="modal-footer">';
			echo '		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
			echo '		</div>';
			echo '	</div>';
			echo '  </div>';
			echo '</div>';
			
			echo '<script>';
			echo '$(function () {';
			echo '$("#myformedit").on("submit", function (e) {';
			echo '  $.ajax({';
			echo '	type: "post",';
			echo '	url: "auth.php?action=editcustomer",';
			echo '	data: $("form").serialize(),';
			echo '	success: function (data) {';
			echo '	$(data).appendTo("#qwe");';
			echo '	  alert("Done!!");';
			//echo ModalMe("Success","Done Editing!");
			echo 'location.reload();';
			echo '	 $("#EditModal").modal("hide");';
			echo '	}';
			echo '	});';
			echo '	e.preventDefault();';
			echo '	});';
			echo '  });';
			echo '</script>';
		
		}
	}
	break;
	
	
	case 'deactivate':
	$mysqli = new mysqli($host, $user, $pass, $db);
	$medrepno=$_SESSION['us'];	
	mysqli_query($mysqli,"update tblusers set active=0 where us='$medrepno'") or die(mysqli_error($mysqli));
	
	echo '<script>window.location = "logout.php"</script>';
	echo modalMe("","Account Deactivated");
		
	
	break;
	
	
	case 'changepass2':
	$mysqli = new mysqli($host, $user, $pass, $db);
	$medrepno=$_GET['medrepno'];	
	
	$old = $_POST['old'];
	$newpass = $_POST['newpass'];
	$rpw = $_POST['rpw'];
	$us=$_SESSION['us'];
	$sql = "select * from tblusers where pw='$old' and us='$us'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	$count = $result->num_rows;
	if($count>=1)
	{
		if($newpass==$rpw)
		{
			mysqli_query($mysqli, "update tblusers set pw='$newpass' where us='$us'") or die(mysqli_error($mysqli));
			
			echo '<script>location.reload()</script>';
			echo modalMe("Success","Password Changed");
			//echo '<script>alert("Password Changed!")</script>';
		
			
		}
		else
		{
			echo modalMe("Error!","password did not match");
			//echo '<script>alert("Password did not match")</script>';
		}
	}
	else
	{
		echo modalMe("Error!","Incorrect Old Password");
		//echo '<script>alert("Incorrect Old Password")</script>';
	}
	
	break;
	
	case 'sendreply':
	$medrepno=$_GET['medrepno'];	
	$mysqli = new mysqli($host, $user, $pass, $db);
	if ($result = $mysqli->query("SELECT * FROM tblcomments where id='$medrepno'"))
	{
		while ($row = $result->fetch_object())
		{
			echo '<div class="modal fade" id="SendReplyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
			echo '  <div class="modal-dialog">';
			echo '	<div class="modal-content">';
			echo '	  <div class="modal-header">';
			echo '		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
			echo '		<h4 class="modal-title" id="myModalLabel">Send Reply</h4>';
			echo '	  </div>';
			echo '	  <div class="modal-body">';
			echo '<form role="form" id="myformedit2">';
			echo '  <div class="form-group">';
			echo '	<label for="fname">Reply To</label>';
			echo '	<input type="text" class="form-control" id="fname" name="fname" placeholder="Name" readonly value="'.$row->email.'" required>';
			echo ' </div>';
			echo '  <div class="form-group">';
			echo '	<label for="descr2">Reply</label>';
			echo '	<textarea class="form-control" rows="10" id="descr2" name="descr2" required></textarea>';
			echo ' </div>';		
			echo '  	 <input type="hidden" id="hd" name="hd" value="editmedrep">';
			echo '  	 <input type="hidden" id="medrepno" name="medrepno" value="'.$row->fname.'">';
			echo ' <input type="submit" class="btn btn-'.getInfox('theme','value').'" id="submit">';
			echo '</form>';
			echo '	  </div>';
			echo '	  <div class="modal-footer">';
			echo '		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
			echo '		</div>';
			echo '	</div>';
			echo '  </div>';
			echo '</div>';
			
			echo '<script>';
			echo '$(function () {';
			echo '$("#myformedit2").on("submit", function (e) {';
			echo '  $.ajax({';
			echo '	type: "post",';
			echo '	url: "auth.php?action=reply",';
			echo '	data: $("form").serialize(),';
			echo '	success: function (data) {';
			echo '	$(data).appendTo("#qwe");';
			echo '	  alert("Reply Sent");';
			echo 'location.reload();';
			echo '	 $("#SendReplyModal").modal("hide");';
			echo '	}';
			echo '	});';
			echo '	e.preventDefault();';
			echo '	});';
			echo '  });';
			echo '</script>';
		}
	}
	break;
	
	case 'adding':
		$prodno=$_POST['prod_id'];
		$fname = $_POST['fname'];
		$wt = $_POST['wt'];
		$ep = $_POST['ep'];
		$c = $_POST['c'];
		$p = $_POST['p'];
		$f = $_POST['f'];
		$e = $_POST['e'];
		$sql = "insert into tblingredients (prod_id,fname,grams,ep,carb,protein,fat,kcal) values ('$prodno','$fname','$wt','$ep','$c','$p','$f','$e')";
		$mysqli = new mysqli($host, $user, $pass, $db); 
		mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
		header("location:adminingredients.php?prod_id=$prodno");
	break;
	
	case 'viewprod':
	$prodno=$_GET['prodno'];
	if(isset($_GET['cat_id'])) {
		$cat_id=$_GET['cat_id'];
	}

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ($result = $mysqli->query("SELECT * FROM tblcatalog where id='$prodno'")) {
		while ($row = $result->fetch_object()) {
			echo '<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
			echo '	<div class="modal-dialog">';
			echo '		<div class="modal-content">';
			echo '			<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>';

			echo '			<div class="modal-body">';
			echo '				<div style="padding:5px;">';
			echo '					<img src="images/'.$row->pic.'" alt="'.$row->fname.'" width="100%" height="100%" class="img-responsive"/>';
			echo '					<h3 class="text-center" id="qxx">'.$row->fname.'</h3>';
			echo '					<h4 class="text-center">Php '.$row->price.'</h4>';
			echo '				</div>';
			// echo '				<div style="padding:5px;">';
			// echo '					<h4 class="text-center">Nutrition Facts<br><span><h6>amount/per serving (gluten-free)</h6></span></h4>';
			// echo 					getNut($prodno);
			// echo '					<hr>';
		
			// echo '				</div>';
			echo '			</div>';

			echo '			<div style="height:25px;clear:both;display:block;"></div>';
			echo '		</div>';
			echo '	</div>';
			echo '</div>';
		}
	}
	break;
	
	case 'editp' :
	$fname = $_POST['fname'];
	$descr = $_POST['descr'];
	$price = $_POST['price'];
	$medrepno =$_POST['medrepno'];
	$sql = "update tblcatalog set fname='$fname',descr='$descr',price='$price' where id='$medrepno'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));		
	break;
	
	case 'editproductinfo' :
	$mysqli = new mysqli($host, $user, $pass, $db); 
	$medrepno = $_POST['medrepno'];
	$fname = $mysqli->real_escape_string($_POST['fname']);
	$descr = $mysqli->real_escape_string($_POST['descr']);
	$price = $mysqli->real_escape_string($_POST['price']);
	
	$sql = "update tblcatalog set fname='$fname',descr='$descr',price='$price' where id='$medrepno'";
	
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));		
	break;
	
	
	case 'editcustomer' :
	$medrepno = $_SESSION['us'];
	$fname = $_POST['fname'];
	$age = $_POST['age'];
	$addr = $_POST['addr'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$ht1 = $_POST['ht1'];
	$ht2 = $_POST['ht2'];
	$wt = $_POST['wt'];
	$dp = $_POST['dp'];
	$al = $_POST['al'];
	$sql = "update tblcustomers set fname='$fname',age='$age',addr='$addr',mobile='$mobile',email='$email',gender='$gender',ht1='$ht1',ht2='$ht2',wt='$wt',dp='$dp',al='$al' where us='$medrepno'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));		
	break;
	
	
	case 'editcatp' :
	$id = $_POST['id'];
	$descr = $_POST['fname'];
	$sql = "update tblcategory set descr='$descr' where id='$id'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));		
	break;
	
	
	
	case 'sendemail':
	$mysqli = new mysqli($host, $user, $pass, $db);
	$calbu=$_GET['calbu'];
	$tt = $_POST['tt'];
	$output[] = "<table border=1>";
	$output[] = "<tr><td>Name</td><td>QTY</td><td>Carbs</td><td>Protein</td><td>Fats</td><td>Calories</td></tr>";
	for($i=0; $i<=$tt; $i++)
	{
		$f = "f".$i;
		$x = "amt".$i;
		$price = $_POST[$f];
		$qty = $_POST[$x];

		$output[] = "<tr><td>".getMenuName($_POST[$i])."</td><td>".$qty."</td><td>".getCPF($_POST[$i],$qty,'c')."</td><td>".getCPF($_POST[$i],$qty,'p')."</td><td>".getCPF($_POST[$i],$qty,'f')."</td><td>".getCPF($_POST[$i],$qty,'k')."</td></tr>";
		
		//$tid = date("Y")."-".sprintf('%05d', getNextID());	
		//mysqli_query($mysqli,"insert into tbltransactiondetails (tid,itemid,qty) values ('$tid','$_POST[$i]','$qty')");
		 
	 }
	$output[] = "</table>";
	
	$ddd[]="<html> 
			<head>
			<style type='text/css'>
			<!--
			body {
				background-color: #FFFFFF;
				font-family: 'Verdana', Verdana, Sans-serif;
				font-size: 10px;
			}
			-->
			
			.tg  {border-collapse:collapse;border-spacing:0;border-color:#aabcfe;}
			.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#669;background-color:#e8edff;}
			.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#039;background-color:#b9c9fe;}
			.tg .tg-26t4{background-color:#9aff99;color:#656565}
			.tg .tg-3rwt{background-color:#ffffff;color:#656565}

			</style>
			</head> 
			<body>
				".getCustomerInfo($_SESSION['us'],'fname')."<br/>
				<br/>
				<h3>My Saved Tray</h3>
				".join('',$output)."		
				<br/>
				<h3>My workout plan</h3>				
				".$calbu."
				</body>
			</html>
			";
			require 'PHPMailerAutoload.php';
			$mail = new PHPMailer;
			$mail->isSMTP();                                    
			$mail->Host = 'cloud.httpdns.co:465';  
			$mail->SMTPAuth = true;                              
			$mail->Username = 'newsletter@greensresto.com'; 
			$mail->Password = 'potaka0118';                         
			$mail->SMTPSecure = 'ssl';            

			$mail->From = 'newsletter@greensresto.com';
			$mail->FromName = 'Greens Vegetarian Restaurant';
			$email = getCustomerInfo($_SESSION['us'],"email");
			$mail->addAddress($email);
			$mail->isHTML(true);                            

			$mail->Subject = 'Saved Tray';
			$mail->Body    = join('',$ddd);

			if(!$mail->send()) {
			   echo modalMe("Error","Email Not Sent! SMTP Error!");
			   exit;
			}
			else {
				//echo '<script>location.reload()</script>';
				echo modalMe("Success","Email Sent");		
			}
	//echo join('',$output);
	break;
	
	
	case 'frmcomment':
	$fname = $_POST['title'];
	$descr = $_POST['descr'];
	$email = $_POST['email'];
	$type = $_POST['type'];
	$ddate = date("m-d-Y"); 
	$sql = "insert into tblcomments (fname,email,descr,ddate,type) values ('$fname','$email','$descr','$ddate','$type')";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	echo "<script type='text/javascript'>alert ('Message Sent !!')</script>";
	echo "<script type='text/javascript'>window.location = 'contact.php'</script>";
	break;
	
	case 'reply':
	$email = $_POST['fname'];
	$descr = $_POST['descr2'];
	$fname = $_POST['medrepno'];
	$output[]="<html> 
			<head>
			<style type='text/css'>
			<!--
			body {
				background-color: #FFFFFF;
				font-family: 'Verdana', Verdana, Sans-serif;
				font-size: 10px;
			}
			-->
			</style>
			</head> 
			<body>
				Dear ".$fname.",<br/>
				<br/>
				".$descr."		
				<br/>
				</table></body>
			</html>
			";
			require 'PHPMailerAutoload.php';
			$mail = new PHPMailer;
			$mail->isSMTP();                                    
			$mail->Host = 'ssl://smtp.gmail.com:465';  
			$mail->SMTPAuth = true;                              
			$mail->Username = 'theteabarcompany@gmail.com'; 
			$mail->Password = 'password0118';                         
			$mail->SMTPSecure = 'tls';            

			$mail->From = 'theteabarcompany@gmail.com';
			$mail->FromName = 'Teabar Company';
			$mail->addAddress($email);
			//$mail->addAddress('ellen@example.com');       
			//$mail->addReplyTo('info@example.com', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			//$mail->WordWrap = 50;                                
			//$mail->addAttachment('/var/tmp/file.tar.gz');        
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');  
			$mail->isHTML(true);                            

			$mail->Subject = 'Teabar Company';
			$mail->Body    = join('',$output);

			if(!$mail->send()) {
			   echo 'Message could not be sent.';
			   echo 'Mailer Error: ' . $mail->ErrorInfo;
			   exit;
			}
			else {}
	break;
	
	case 'addtotray':
		$cart = $_SESSION['cart'];
		$prodno = $_GET['prodno'];
		
		$cart .= ','.$prodno;
		$_SESSION['cart'] = $cart;
		$messages = array();
		$messages['num'] = checkCart();
		$messages['cal'] = checkCartCal();
		echo json_encode($messages);
	break;

	case 'addatt':
		$prodno = $_GET['prodno'];		
		$mysqli = new mysqli($host, $user, $pass, $db); 
		if(checkIfFeatured($prodno)==1)
		{
			
			$str ="delete from tblfeatured where prodno='$prodno'";
			mysqli_query($mysqli, $str) or die(mysqli_error($mysqli));
		}
		else
		{
			
			$str ="insert into tblfeatured (prodno) values ('$prodno')";
			mysqli_query($mysqli, $str) or die(mysqli_error($mysqli));
			
		}
	break;
	
	case 'bs':
		$prodno = $_GET['prodno'];		
		$mysqli = new mysqli($host, $user, $pass, $db); 
		
		$str ="update tblcatalog set bs=0";
		mysqli_query($mysqli, $str) or die(mysqli_error($mysqli));	
		
		$str1 ="update tblcatalog set bs=1 where id='$prodno'";
		mysqli_query($mysqli, $str1) or die(mysqli_error($mysqli));
		//echo 'wtf '.$prodno;
		
	break;
	
	case 'deletecomment':
	$id = $_GET['id'];	
	$sql = "delete from tblcomments where id='$id'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	echo "<script type='text/javascript'>alert ('Message Sent !!')</script>";
	echo "<script type='text/javascript'>window.location = 'comments.php'</script>";
	break;
	
	case 'memcomment':
	$descr = $_POST['descr'];
	$us = $_SESSION['us'];
	$ddate = date("m-d-Y"); 
	$sql = "insert into tblfeedback (uid,content,ddate,stat) values ('$us','$descr','$ddate','member')";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	//echo $us;
	echo "<script type='text/javascript'>alert ('Message Sent !!')".$us."</script>";
	echo "<script type='text/javascript'>window.location = 'msg.php'</script>";	
	break;
	
	
	
	
	case 'replytocom':
	$descr = $_POST['descr'];
	$us = $_GET['uid'];
	$ddate = date("m-d-Y"); 
	//echo $us."asdada";
	$sql = "insert into tblfeedback (uid,content,ddate,stat) values ('$us','$descr','$ddate','admin')";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	//echo $us;
	//echo "<script type='text/javascript'>alert ('Message Sent !!')</script>";
	//echo "<script type='text/javascript'>window.location = 'comments.php'</script>";	
	break;
	
	
	case 'formSettings':
	$companyname = $_POST['companyname'];
	$sql = "update tblsettings set value='$companyname' where var='companyname'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	
	$target_path = "images/";
	$target_path = $target_path . basename($_FILES['uploadedfile']['name']); 

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	$pic = basename($_FILES['uploadedfile']['name']);
	$sql = "update tblsettings set pic='$pic' where var='banner'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	//echo '1';
	}
	else
	{
			//echo '2';
	}
	
	$theme = $_POST['theme'];
	$sql = "update tblsettings set value='$theme' where var='theme'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	
	$email = $_POST['email'];
	$sql = "update tblsettings set value='$email' where var='email'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	
	$num = $_POST['num'];
	$sql = "update tblsettings set value='$num' where var='companyphone'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	
	$addr = $_POST['addr'];
	$sql = "update tblsettings set value='$addr' where var='companyaddr'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	
	
	echo '<script>alert("Settings Changed!")</script>';
	echo '<script>location.reload()</script>';
	
	break;
	
	case 'editsiteinfo':
	$txt= $_POST['txt'];
	$tp= $_POST['tp'];
	$str="";
	$sql = "update tblsettings set value='$txt' where var='$tp'";
		
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));	
	echo '<script>alert("Settings Changed!")</script>';
	echo "<script type='text/javascript'>window.location = 'settings.php'</script>";			
	break;
	
		
	case 'editcat':
	$catno=$_GET['catno'];	
	//echo $catno;
	$mysqli = new mysqli($host, $user, $pass, $db);
	if ($result = $mysqli->query("SELECT * FROM tblcategory where id='$catno'"))
	{
		while ($row = $result->fetch_object())
		{
			echo '<div class="modal fade" id="EditCat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
			echo '  <div class="modal-dialog">';
			echo '	<div class="modal-content">';
			echo '	  <div class="modal-header">';
			echo '		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
			echo '		<h4 class="modal-title" id="myModalLabel">Edit Category</h4>';
			echo '	  </div>';
			echo '	  <div class="modal-body">';
			echo '<form role="form" id="myformeditcat">';
			echo '  <div class="form-group">';
			echo '	<label for="fname">Category Name</label>';
			echo '	<input type="text" class="form-control" id="fname" name="fname" placeholder="Name" value="'.$row->descr.'" required>';
			echo ' </div>';		
			echo '  	 <input type="hidden" id="hd" name="hd" value="editmedrep">';
			echo '  	 <input type="hidden" id="id" name="id" value="'.$row->id.'">';
			echo ' <input type="submit" class="btn btn-'.getInfox('theme','value').'" id="submit">';
			echo '</form>';
			echo '	  </div>';
			echo '	  <div class="modal-footer">';
			echo '		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
			echo '		</div>';
			echo '	</div>';
			echo '  </div>';
			echo '</div>';
			
			echo '<script>';
			echo '$(function () {';
			echo '$("#myformeditcat").on("submit", function (e) {';
			echo '  $.ajax({';
			echo '	type: "post",';
			echo '	url: "auth.php?action=editcatp",';
			echo '	data: $("form").serialize(),';
			echo '	success: function (data) {';
			echo '	$(data).appendTo("#qwe");';
			echo '	  alert("Category Edited");';
			echo 'location.reload();';
			echo '	 $("#EditCat").modal("hide");';
			echo '	}';
			echo '	});';
			echo '	e.preventDefault();';
			echo '	});';
			echo '  });';
			echo '</script>';
		}
	}
	break;
	
	case 'addcat':
	$catname = $_POST['catname'];
	$sql ="insert into tblcategory (descr) values('$catname')";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	echo '<script>alert("Category Saved!")</script>';
	echo "<script type='text/javascript'>window.location = 'admincatalog.php'</script>";			
	break;
	
	case 'delcat':
	$id= $_GET['id'];
	$sql ="delete from tblcategory where id='$id'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	echo '<script>alert("Category Deleted!")</script>';
	echo "<script type='text/javascript'>window.location = 'admincatalog.php'</script>";	
	break;
	
	case 'delacct':
	$id= $_GET['id'];
	$sql ="delete from tblusers where id='$id'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	echo '<script>alert("User Account Deleted!")</script>';
	echo "<script type='text/javascript'>window.location = 'adminacct.php'</script>";	
	break;
	
	case 'delnews':
	$id= $_GET['id'];
	$sql ="delete from tblnews where id='$id'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	echo '<script>alert("News Deleted!")</script>';
	echo "<script type='text/javascript'>window.location = 'admin.php'</script>";	
	break;
	
	
	case 'delpro':
	$id= $_GET['id'];
	$sql ="delete from tblcatalog where id='$id'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	echo '<script>alert("Product Deleted!")</script>';
	echo "<script type='text/javascript'>window.location = 'admincatalog.php'</script>";	
	break;
	
	case 'deling':
	$id= $_GET['id'];
	$prod_id = $_GET['prod_id'];
	$sql ="delete from tblingredients where id='$id'";
	$mysqli = new mysqli($host, $user, $pass, $db); 
	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	echo '<script>alert("Product Deleted!")</script>';
	echo "<script type='text/javascript'>window.location = 'adminingredients.php?prod_id=$prod_id'</script>";	
	break;
	
	case 'gcash':
	$g = generateRandomString();
	echo '<script>alert("Transaction code '.$g.' Please Wait for Confirmation")</script>';
	echo "<script type='text/javascript'>window.location = 'catalog.php'</script>";	
	//echo $cp1.$cp2;
	break;
	
	case 'selsel':
		$val= $_GET['val'];
		$mysqli = new mysqli($host, $user, $pass, $db);
		if ($result = $mysqli->query("SELECT * FROM tblsettings where var='$val'"))
		{
			while ($row = $result->fetch_object())
			{
				echo $row->value;
			}
			
		}
	break;
	
	case 'checktray':
		echo checkCartCal();
	break;
	
	
	
}

function checkCartCal()
{
	$str = "";
	if (isset($_SESSION['cart']))
	{
		$cart = $_SESSION['cart'];
		$items = explode(',',$cart);
		$contents = array();
		$str = "";
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
			
		}
		$x=0;
		foreach ($contents as $id=>$qty) {
			include "conn.php";
			$mysqli = new mysqli($host, $user, $pass, $db);
			$res = $mysqli->query("SELECT kcal,grams FROM tblingredients where prod_id='$id'");
		

			while ($row = $res->fetch_object())
			{
				$x=$x+(($row->grams/100)*$row->kcal);
				
				$str = $str.','.$row->kcal;
			}
			
		}
		return $x;
	}
	else
	{
		return 0;
	}

}
					
					
function generateRandomString($length = 18) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


function checkIfExist($x)
{	
	@include 'conn.php';
	$link = mysqli_connect($host,$user,$pass,$db) or die("Error " . mysqli_error($link));
	$query = "Select * from tblusers where us='$x'" or die("Error in the consult.." . mysqli_error($link));
	$result = $link->query($query);
	$count = $result->num_rows;
	return $count;


}
function getCustomerInfo($x,$y)
{
	@include "conn.php";
	$mysqli = new mysqli($host, $user, $pass, $db);
	$res = $mysqli->query("SELECT * FROM tblcustomers where us='$x'");
	$r="";
	while ($row = $res->fetch_object())
	{
		if($y=="fname")
		{
			$r= $row->fname;
		}
		else if($y=="email")
		{
			$r= $row->email;
		}
		
		
	}
return $r;
}

function getMenuName($x)
{
	@include "conn.php";
	$mysqli = new mysqli($host, $user, $pass, $db);
	$res = $mysqli->query("SELECT * FROM tblcatalog where id='$x' LIMIT 1");
	$x="";
	while ($row = $res->fetch_object())
	{
		$x= $row->fname;
		
	}
return $x;
}
function getCPF($x,$y,$z)
{
	@include "conn.php";
	$mysqli = new mysqli($host, $user, $pass, $db);
	$res = $mysqli->query("SELECT * FROM tblingredients where prod_id='$x'");
	$r="";
	
		$s="";
		$g ="";
		$tep = "";
		$tc = "";
		$tp="";
		$tf ="";
		$tcal = "";
		$tt="";
		while ($row = $res->fetch_object())
		{
			$totcal = ($row->grams/100)*$row->kcal;
			$totcarbs = ($row->grams/100)*$row->carb;
			$totalpro = ($row->grams/100)*$row->protein;
			$totalfat = ($row->grams/100)*$row->fat;
			$tt = $tt + $totcal;
			$tc = $tc + $totcarbs;
			$tp = $tp + $totalpro;
			$tf = $tf + $totalfat;
		}
		

	if($z=="c")
	{
		$r=$tc;
	}
	else if($z=="p")
	{
		$r=$tp;
	}
	else if($z=="f")
	{
		$r=$tf;
	}
	else if($z=="k")
	{
		$r=$tt;
	}
	
return floatval($r)*floatval($y);
}

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
function getNut($x)
{
	@include "conn.php";
	$mysqli = new mysqli($host, $user, $pass, $db);
	$res = $mysqli->query("SELECT * FROM tblingredients where prod_id='$x'");
	$x="";
	$g ="";
	$TotalEP = "";
	$carbs = "";
	$protein="";
	$fat="";
	$tf ="";
	$tp="";
	$tcal = "";
	$tt="";
	$tc="";
	while ($row = $res->fetch_object())
	{
		$g =$g + $row->grams;
		$TotalEP = $TotalEP + $row->ep;
		$carbs = $carbs + $row->carb;
		$protein = $protein + $row->protein;
		$fat = $fat + $row->fat;
		$tcal = $tcal + $row->kcal;
		$totcal = ($row->grams/100)*$row->kcal;
		$totcarbs = ($row->grams/100)*$row->carb;
		$totalpro = ($row->grams/100)*$row->protein;
		$totalfat = ($row->grams/100)*$row->fat;
		$tt = $tt + $totcal;
		$tc = $tc + $totcarbs;
		$tp = $tp + $totalpro;
		$tf = $tf + $totalfat;
	}
	$x= '<table>
		
			<tr><td style="width:200px;">Carbohydrates(g)</td><td>'.number_format($tc,2).'g</td></tr>
			<tr><td style="width:200px;">Protein(g)</td><td>'.number_format($tp,2).'g</td></tr>
			<tr><td style="width:200px;">Fat(g)</td><td>'.number_format($tf,2).'g</td></tr>
			<tr><td style="width:200px;">Calories(g)</td><td>'.number_format($tt,2).'g</td></tr>
		
	</table>';
return $x;
}

function modalMes($title,$content,$refresh)
{
	$str = "";
	$str ='<div class="modal fade" id="custommodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">'.$title.'</h4>
      </div>
      <div class="modal-body">
        '.$content.'
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
 
      </div>
    </div>
  </div>
</div>
<script>
$("#custommodal").modal("show");

';
if($refresh==true)
{
$str=$str.'$("#custommodal").on("hidden.bs.modal", function () {
 location.reload();
});
';
}

$str = $str."</script>";
return $str;
}
function modalMe($title,$content)
{
	$str = "";
	$str ='<div class="modal fade" id="custommodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">'.$title.'</h4>
      </div>
      <div class="modal-body">
        '.$content.'
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
 
      </div>
    </div>
  </div>
</div>
<script>
$("#custommodal").modal("show");
</script>';

	return $str;
}

function checkIfFeatured($x)
{
	@include "conn.php";
	$mysqli = new mysqli($host, $user, $pass, $db);
	$res = $mysqli->query("SELECT * FROM tblfeatured where prodno='".$x."'");
	$count = $res->num_rows;
	$str = "";
		
	return $count;
}
function checkCart()
{
	if (isset($_SESSION['cart']))
	{
		$cart = $_SESSION['cart'];
		$items = explode(',',$cart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
			
		}
		$x=0;
		foreach ($contents as $id=>$qty) {
			$x=$x+1;
		}
		return $x-1;
	}
	else
	{
		return 0;
	}

}

?>
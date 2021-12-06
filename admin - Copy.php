<?php
session_start();
if(!isset($_SESSION['us']) || (trim($_SESSION['us'])=='')) {
header("location: index.php");
exit();
}
include_once 'function.php'; 
?>
<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery-1.9.1.js"></script>
<script>
  $(function () {
	$('#events').on('submit', function (e) {
	  $.ajax({
		type: 'post',
		url: 'auth.php?action=news',
		data: $('form').serialize(),
		success: function (data) {
		  alert('Message Posted!');
		  location.reload();
		
		}
	  });
	  e.preventDefault();
	});
  });
	  
	  
	  
</script>
<?php
	
?>
</head>
	<div id="container">
		<div id="header" style="background-image:url(images/<?php echo getInfo('banner','pic'); ?>);">
		</div>
		<?php include 'nav.php'; ?>
		<body>
		<div id="body">
		<div id="leftadmin">
    <form role="form" method="post" id="events">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
      </div>
      <div class="form-group">
	   <label for="desc">Description</label>
        <textarea class="form-control" rows="10" id="desc" name="desc"></textarea>
      </div>
           <input type="submit" class="btn btn-<?php echo getInfo('theme','value'); ?>">
    </form>
  </div>
  <div id="rightadmin" class="panel panel-<?php echo getInfo('theme','value'); ?>">
  <div class="panel-heading">Put something here</div>
  <div class="panel-body">
  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
  </div>


		
		</div>
		<?php include 'footer.php'; ?>
		
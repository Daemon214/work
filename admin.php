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
<link rel="stylesheet" type="text/css" href="lib/bootstrap3-wysihtml5.min.css"></link>
<script src="js/jquery-1.9.1.js"></script>
<style>
*{margin:0;
 padding:0;
 }
</style>
<script>
function confirmdel() {
	var answer = confirm("Are you sure you want to delete this?");
	if (answer){


					//window.location('auth.php?action=delcat&id'+catno);
					return true;
	}
	else{
		alert("Cancelled!");
		return false;
	}
}

  $(function () {
	$('#events').on('submit', function (e) {
	  $.ajax({
		type: 'post',
		url: 'auth.php?action=news',
		data: $('form').serialize(),
		success: function (data) {
		  alert('Events Posted!');
		  location.reload();
		
		}
	  });
	  e.preventDefault();
	});
  });
	  
	
 function preview()
 {
	var cont = document.getElementById("some-textarea").value;
	var title = $("#title").val();
	window.open('preview.php?title=' + title + "&cont="+ cont, '_blank');
	//alert("asd");
 }
	  
</script>
<?php
	
?>
</head>
	<div id="container">
		<div id="header" style="background-image:url(images/<?php echo getInfo('banner','pic'); ?>);">
		</div>
		<?php include 'nav.php'; ?>
		<body>
		<div id="body" style="height:1040px">
		<form role="form" method="post" id="events">
		
		<div class="panel panel-<?php echo getInfo('theme','value'); ?>">
  <div class="panel-heading">News and Updates</div>
  <div class="panel-body" id="panelright">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
      </div>
      <div class="form-group">
	   <label for="desc">Content</label>
       <!-- <textarea class="form-control" rows="10" id="desc" name="desc" required></textarea>-->
	   <textarea  id="some-textarea" class="textarea" name="desc" placeholder="Enter text ..." style="width: 100%; height: 300px">
		
		</textarea>
      </div>
           <input type="submit" class="btn btn-<?php echo getInfo('theme','value'); ?>">
		   <input type="Button" class="btn btn-<?php echo getInfo('theme','value'); ?>" value="Preview" onclick="preview();">
    </form>
	
		
  </div>
  </div>
  
		
  <div class="panel panel-<?php echo getInfo('theme','value'); ?>">
  <div class="panel-heading">News List</div>
  <div class="panel-body">
  <table class="table table-striped">
   <?php
	@include 'conn.php';
		$link = mysqli_connect($host,$user,$pass,$db) or die("Error " . mysqli_error($link));
		$query = "Select * from tblnews order by id desc limit 0,5" or die(mysqli_error($link));
		$result = $link->query($query);
		while ($row = $result->fetch_object())
		{
		// echo '<h3>'.$row->topic.'</h3>';
		// echo '<blockquote>';
		// echo '<p style="font-size:14px">';
		// echo $row->content;
		// echo '</p>';
		// echo '<footer>Posted by admin on <cite title="Source Title">'.$row->ddate.'</cite></footer>';
		// echo '</blockquote>';	
		echo '<tr>';
		echo '<td style="width:200px">';
		echo $row->topic;
		echo '</td>';
		echo '<td>';
		echo $row->content;
		echo '</td>';
		echo '<td>';
		echo '<td><a href="auth.php?action=delnews&id='.$row->id.'" class="my-success" onclick="return confirmdel();">Delete</a></td>';
		echo '</td>';
		echo '</tr>';
		}
		
	
  
  ?>
  </table>
  </div>


		<script type="text/javascript">
$(window).on('load', function load(){
$('#some-textarea').wysihtml5({
    "font-styles": true, 
    "emphasis": true, 
    "lists": true, 
    "html": false,
    "link": true, 
    "image": true,
    "color": false, 
    "blockquote": true,
  "size": 'sm' 
});
    
})

</script>
		</div>
		<?php include 'footer.php'; ?>
		
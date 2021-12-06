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
 <script src="js/jquery-1.9.1.js"></script>
<script>
var medrepno;
var sampleno;
function setCommentId(x)
{
	if (confirm('Are you sure you want to delete this comment?')) {
	  $.ajax({
				type: 'post',
				url: 'auth.php?action=deletecomment&id='+x,
				success: function (data) {
				 $("#qwe").append(data);
				  
				}
			  });
				e.preventDefault();    
	} else {
		
	}	
}


 $(document).ready(function(){
  $(".sendreply").click(function(e){
$('#qwe').empty();
   $.ajax({
            type: 'post',
            url: 'auth.php?action=sendreply&medrepno='+medrepno,
            success: function (data) {
			 $("#qwe").append(data);
			   $('#SendReplyModal').modal('show');  
            }
          });
		    e.preventDefault();    
  });
});

  $(document).ready(function(){
  $(".editproduct").click(function(e){
$('#qwe').empty();
   $.ajax({
            //type: 'post',
            //url: 'auth.php?action=repcom1&medrepno='+medrepno,
            success: function (data) {
			 //alert(sampleno);
			 //$("#qwe").append(data);
			 $('#myModal').modal('show');  
            }
          });
		    e.preventDefault();    
  });
});

// $(function () {
        // $('#repcom').on('submit', function (e) {
          // $.ajax({
            // type: 'post',
            // url: 'auth.php?action=replytocom'+medrepno,
            // data: $('form').serialize(),
            // success: function (data) {		
   			  // $(data).appendTo('#qwe');
			 //$('#EditModal').modal('hide');
            // }
          // });
          // e.preventDefault();
        // });
      // });
	  

	  $(function () {
        $('#repcom').on('submit', function (e) {
          $.ajax({
            type: 'post',
            url: 'auth.php?action=replytocom&uid='+sampleno,
            data: $('form').serialize(),
            success: function (data) {
			$(data).appendTo('#thanks');
              alert('form was submitted');
			  location.reload();
			 $('#myModal').modal('hide');
            }
          });
          e.preventDefault();
        });
      });
	  
	  
 // $(document).ready(function(){
  // $("#repcom").submit(function(){ 
   //alert("Added!" + sampleno);
   // $.ajax({
			// type: 'post',
			// url: 'auth.php?action=replytocom&uid='+sampleno,
			// success: function (data) {
			$("#qwe").append(data);
				location.reload();
				alert("Added!");
			// }
		  // });
  // });
// });

function setMedRepNo(x) {
medrepno = x;
}
function setSample(x){
sampleno = x;
}

</script>
</head>
	<div id="container">
		<div id="header" style="background-image:url(images/<?php echo getInfox('banner','pic'); ?>);">
		</div>
		<?php include 'nav.php'; ?>
		<body>
		<div id="body">
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
		<?php
			include "conn.php";
			$mysqli = new mysqli($host, $user, $pass, $db);
			$uid = $_SESSION['us'];
			$res = $mysqli->query("SELECT * FROM tblusers where us='$uid' LIMIT 1");
			while ($row = $res->fetch_object())
			{
			?>
			 
		   <div class="panel panel-<?php echo getInfo('theme','value'); ?>">
  <div class="panel-heading">Comments/Suggestions</div>
  <div class="panel-body" id="panelright">
 
  <table class="table table-striped table-bordered table-condensed">
			<thead>
					<th>Type</th>
					<th>Name</th>
					<th>Email</th>
					<th>Comment</th>
					<th>Date</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			   <?php
				$mysqli = new mysqli($host, $user, $pass, $db);
				$str="select * from tblcomments";
			
				if ($result = $mysqli->query($str))
					{
						while ($row = $result->fetch_object())
						{
							echo '<tr>';
							echo '<td>'.$row->type.'</td>';
							echo '<td>'.$row->fname.'</td>';
							echo '<td>'.$row->email.'</td>';
							echo '<td>'.$row->descr.'</td>';
							echo '<td>'.$row->ddate.'</td>';
							echo '<td><a href="" class="my-'.getInfo('theme','value').' sendreply" onclick="setMedRepNo('.$row->id.')">Reply</a></td>';							
							echo '<td><a href="auth.php?action=deletecomment&id='.$row->id.'" class="my-'.getInfo('theme','value').'" onclick="setCommentId('.$row->id.')">Delete Comment</a></td>';							
							echo '</tr>';
					
						}
					}
			   ?>
			</tbody>
		</table>
		 <div id="qwe"></div>
</div>
</div>

			
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Reply To Comment</h4>
      </div>
      <div class="modal-body">
	  
 <form role="form" id="repcom" method="post">  
     <div class="form-group">
	   <label for="descr">Comment</label>
       <textarea class="form-control" rows="10" id="descr" name="descr"></textarea>
   </div>
 <input type="submit" class="btn btn-primary" id="submit"/>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

			
	
	
			<?php
			}
			
			function getCustomerName($x)
				{
					@include 'conn.php';
					$qwe =0;	
					$mysqli = new mysqli($host, $user, $pass, $db);

					if ($result = $mysqli->query("select * from tblcustomers where us='$x'"))
					{
						while ($row = $result->fetch_object())
						{
							$qwe = $row->fname;

						}
					}
					return $qwe;
				}
	
		
		?>
	
		<?php include 'footer.php'; ?>
		
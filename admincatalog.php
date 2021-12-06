<?php include 'header.php'; ?>
		<?php include 'nav.php'; ?>
			<button class="btn btn-<?php echo getInfo('theme','value'); ?> btn-lg" data-toggle="modal" data-target="#myModal">Add Product</button>
			<div id="thanks"><p></p><form method="post" action="admincatalog.php"><input type="text" id="search" name="search" placeholder="Search"/><input type="submit" value="submit"/></form></div>
		<div id="body" style="overflow:auto;height:400px;">
	<div class="panel panel-<?php echo getInfo('theme','value'); ?>">
  <div class="panel-heading">Inventory</div>
  <div class="panel-body">
		
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Product</h4>
      </div>
      <div class="modal-body">
	  
 <form role="form" id="addproduct" method="post" action="auth.php?action=insert" enctype="multipart/form-data" >
  <div class="form-group">
    <label for="fname">Name</label>
    <input type="text" class="form-control" id="fname" name="fname" placeholder="Name" required/>
  </div>
  <div class="form-group">
    <label for="category">Category</label>
    <select class="form-control" name="category">
	  <?php
		include 'conn.php';
		$mysqli = new mysqli($host, $user, $pass, $db);
		if ($result = $mysqli->query("SELECT * FROM tblcategory"))
		{
			while ($row = $result->fetch_object())
			{
				echo '<option value='.$row->id.'>';
				echo '<td>'.$row->descr.'</td>';
				echo '</option>';

			}
		}
	  ?>
	</select>
  </div>
   <div class="form-group">
	   <label for="descr">Description</label>
       <textarea class="form-control" rows="10" id="descr" name="descr"></textarea>
   </div>
    <div class="form-group">
	   <label for="price">Price</label>
       <input type="number" class="form-control" id="price" name="price"  min="0" max="999999" step="0.01" size="4" required/>
   </div>
   <div class="form-group">
			<label for="desc">Image</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
			<input name="uploadedfile" name="id" type="file" required />
   </div>
   <a id="ppp" class="has-spinner" style="width:50px">
	 <button type="submit" class="btn btn-<?php echo getInfo('theme','value'); ?>" id="xasd">
	Submit
	  <span class="spinner"><i class="icon-spin icon-refresh"></i></span>
	 </button>
	 </a>
</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


		<table class="table table-striped table-bordered table-condensed">
			<thead>
					<th></th>
					<th>Item Name</th>
					<th>Description</th>
					<!--<th>Quantity</th>-->
					<th>Price</th>
					<!--<th>Price</th>-->
					<th></th>
					<th></th>
					<th>featured</th>
					<th>best seller</th>
				</tr>
			</thead>
			<tbody>
			   <?php
				$mysqli = new mysqli($host, $user, $pass, $db);
				$str= "";
				if(isset($_POST['search']))
				{
					$sear=$_POST['search'];
					$str="select * from tblcatalog where fname LIKE '%$sear%'";
				}
				else
				{
					$str="select * from tblcatalog";
				}
				if ($result = $mysqli->query($str))
					{
						while ($row = $result->fetch_object())
						{
							echo '<tr>';
					
							echo '<td style="width:150px;height:100px;"><img src="images/'.$row->pic.'" style="width:150px;height:100px;"></td>';
							echo '<td style="width:150px;">'.$row->fname.'</td>';
							echo '<td>'.$row->descr.'</td>';
							//echo '<td>'.$row->qty.'</td>';
							
							echo '<td>₱'.$row->price.'</td>';

							/*
							echo '<td><a href="adminingredients.php?prod_id='.$row->id.'" class="my-'.getInfo('theme','value').' editing" onclick="setMedRepNo('.$row->id.')">Ingredients('.getIngredientCount($row->id).')</a></td>';
							*/						


							//echo '<td>'.$row->price.'</td>';
							echo '<td><a href="" class="my-'.getInfo('theme','value').' editproduct" onclick="setMedRepNo('.$row->id.')">Edit</a></td>';
							echo '<td><a href="auth.php?action=delpro&id='.$row->id.'"  class="my-'.getInfo('theme','value').'" onclick="setProdNo('.$row->id.');return confirmdelpro();">Delete</a></td>';						
							$strx = "";
							if(checkAtt($row->id)==1)
							{ 
								$strx= 'checked';
							}
							echo '<td><input class="chkbox" type="checkbox" onchange="setProdNo('.$row->id.')" '.$strx.'></td>';
							echo '<td><input class="radiochk" type="radio" name="rd" onchange="setProdNo('.$row->id.')"></td>';
							echo '</tr>';
					
						}
					}
			   ?>
			</tbody>
		</table>
	</div>
	</div>
			
		</div>
		<br/>
		<div>
		
		<div id="leftadmin" class="panel panel-<?php echo getInfo('theme','value'); ?>" style="height:220px;overflow:auto;">
		 <div class="panel-heading">Category List</div>
  <div class="panel-body" >
		<table class="table table-striped table-bordered table-condensed">
			<thead>
			
					<th>Category Name</th>
					<th>Edit</th>
					<th>Delete</th>
				
				</tr>
			</thead>
			<tbody>
			   <?php
				$mysqli = new mysqli($host, $user, $pass, $db);
				$str= "";
				
					$str="select * from tblcategory";
			
		
				if ($result = $mysqli->query($str))
					{
						while ($row = $result->fetch_object())
						{
							echo '<tr>';
							echo '<td>'.$row->descr.'</td>';
							echo '<td><a href="" class="my-'.getInfo('theme','value').' editcategory" onclick="setCategoryNo('.$row->id.')">Edit</a></td>';					
							echo '<td><a href="auth.php?action=delcat&id='.$row->id.'"  class="my-'.getInfo('theme','value').'" onclick="setCategoryNo('.$row->id.');return confirmdel();">Delete</a></td>';						
							echo '</tr>';
					
						}
					}
					
				function checkAtt($x)
				{
					@include "conn.php";
					$mysqli = new mysqli($host, $user, $pass, $db);
					$res = $mysqli->query("SELECT * FROM tblfeatured where prodno='".$x."'");
					$count = $res->num_rows;
					$str = "";
					if($count>=1)
					{
						$str='1';
					}
					else
					{
						$str='0';
					}
					return $str;
				}
				function getIngredientCount($x)
				{
					@include "conn.php";
					$mysqli = new mysqli($host, $user, $pass, $db);
					$res = $mysqli->query("SELECT * FROM tblingredients where prod_id='".$x."'");
					$count = $res->num_rows;
					$str = "";
					if($count>=1)
					{
						$str=$count ;
					}
					else
					{
						$str='0';
					}
					return $str;
				}
			   ?>
			</tbody>
		</table>
		</div>
		</div>
		<div id="rightadmin" class="panel panel-<?php echo getInfo('theme','value'); ?>" style="height:220px;">
		 <div class="panel-heading">Add Category</div>
		<div class="panel-body" >
		<form method="post" action="auth.php?action=addcat" onsubmit="return confirmation()">
		  <div class="form-group">
		   <label for="catname">Category</label>
		   <input type="text" id="catname" name="catname" required>
		</div>
			
			<input type="submit" value="submit" class="btn btn-<?php echo getInfo('theme','value'); ?> pull-right">
		</form>
		</div>
		</div>
	<div id="qwe"></div>
		<script>

			$(function(){
    $("#ppp").click(function() {
        $(this).toggleClass("active");
    });
});
	</script>
		<?php include 'footer.php'; ?>
		
<?php include 'header.php'; ?>
		<?php include 'nav.php'; ?>
			<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add Category</button>
			<div id="thanks"><p></p><form method="post" action="admincatalog.php"><input type="text" id="search" name="search" placeholder="Search"/><input type="submit" value="submit"/></form></div>
		<div id="body" style="overflow:auto;height:650px;">
	
		
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Category</h4>
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
 <input type="submit" class="btn btn-primary" id="submit"/>
</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<div>


		<table class="table table-striped table-bordered table-condensed">
			<thead>
					<th></th>
					<th>Item Name</th>
					<th>Description</th>
					<th>Quantity</th>
					<th>Stocks</th>
					<th>Price</th>
					<th></th>
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
				
						
							echo '</tr>';
					
						}
					}
			   ?>
			</tbody>
		</table>
	
			<div id="qwe"></div>
			</div>
		<br/>
		<div >
		<table class="table table-striped table-bordered table-condensed">
			<thead>
					<th></th>
					<th>Item Name</th>
					<th>Description</th>
					<th>Quantity</th>
					<th>Stocks</th>
					<th>Price</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			   <tr><td>Glassware</td></tr><tr><td>Microscopes</td></tr><tr><td>Lab Utilities</td></tr>			</tbody>
		</table>
		
		<?php include 'footer.php'; ?>
		
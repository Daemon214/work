<?php include 'header.php'; ?>
		<?php include 'nav.php'; ?>
		
		
		
			<button class="btn btn-<?php echo getInfo('theme','value'); ?> btn-lg" data-toggle="modal" data-target="#myModal">Add Ingredients</button>
			<div id="thanks"><p></p><form method="post" action="adminingredients.php"><input type="text" id="search" name="search" placeholder="Search"/><input type="submit" value="submit"/></form></div>
		<div id="body" style="overflow:auto;height:400px;">
	<div class="panel panel-<?php echo getInfo('theme','value'); ?>">
  <div class="panel-heading"><?php echo getVal($_GET['prod_id']); ?></div>
  <div class="panel-body">
		
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Ingredients</h4>
      </div>
      <div class="modal-body">
	  
 <form role="form" id="addproduct" method="post" action="auth.php?action=adding" enctype="multipart/form-data" >
  <div class="form-group">
    <label for="fname">Name</label>
    <input type="text" class="form-control" id="fname" name="fname" placeholder="Name" required/>
  </div>
 
   
    <div class="form-group">
	   <label for="wt">Weight(G)</label>
       <input type="number" class="form-control" id="wt" name="wt"  min="0" max="9999" step="0.01" onkeypress="validate(event)" maxlength="2" size="1" required/>
   </div>
    <div class="form-group">
	   <label for="ep">EP %</label>
       <input type="number" class="form-control" id="ep" name="ep"  min="0" max="9999" step="0.01" onkeypress="validate(event)" maxlength="2" size="1" required/>
   </div>
    <div class="form-group">
	   <label for="c">Carbohydrate per 100g</label>
       <input type="number" class="form-control" id="c" name="c"  min="0" max="9999" step="0.01" onkeypress="validate(event)" maxlength="2" size="1" required/>
   </div>
    <div class="form-group">
	   <label for="p">Protein per 100g</label>
       <input type="number" class="form-control" id="p" name="p"  min="0" max="9999" step="0.01" onkeypress="validate(event)" maxlength="2" size="1" required/>
   </div>
    <div class="form-group">
	   <label for="f">FAT per 100g</label>
       <input type="number" class="form-control" id="f" name="f"  min="0" max="9999" step="0.01" onkeypress="validate(event)" maxlength="2" size="1" required/>
   </div>
    <div class="form-group">
	   <label for="e">Energy per 100g</label>
       <input type="number" class="form-control" id="e" name="e"  min="0" max="9999" step="0.01" onkeypress="validate(event)" maxlength="2" size="1" required/>
   </div>
  <input type="hidden" name="prod_id" value="<?php echo $_GET['prod_id']; ?>" />
<!-- <input type="submit" class="btn btn-<?php echo getInfo('theme','value'); ?>" id="submit"/>-->
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
					
					<th style="width:250px">Item Name</th>
					<th>Weight(G)</th>
					<th>EP% per 100g</th>
					<th>Carbohydrate per 100g</th>
					<th>Protein per 100g</th>
					<th>Fat per 100g</th>
					<th>Calories per 100g</th>
					<th>Calorie</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			   <?php
			   @include 'conn.php';
				$mysqli = new mysqli($host, $user, $pass, $db);
				$str= "";
				$prod_id = $_GET['prod_id'];
				if(isset($_POST['search']))
				{
					$sear=$_POST['search'];
					$str="select * from tblingredients where fname LIKE '%$sear%' and prod_id='$prod_id'";
					//$str="select * from tblingredients where prod_id='$prod_id'";
				}
				else
				{
					$str="select * from tblingredients where prod_id='$prod_id'";
				}
				if ($result = $mysqli->query($str))
				{
					$g ="";
					$tep = "";
					$tc = "";
					$tp="";
					$tf ="";
					$tcal = "";
					$tt="";
					
					while ($row = $result->fetch_object())
					{
						echo '<tr>';
				
						
						echo '<td style="width:150px;">'.$row->fname.'</td>';
						echo '<td>'.$row->grams.'</td>';
						echo '<td>'.$row->ep.'</td>';
						echo '<td>'.$row->carb.'</td>';
						echo '<td>'.$row->protein.'</td>';
						echo '<td>'.$row->fat.'</td>';
						echo '<td>'.$row->kcal.'</td>';
						$g =$g + $row->grams;
						$tep = $tep + $row->ep;
						$tc = $tc + $row->carb;
						$tp = $tp + $row->protein;
						$tf = $tf + $row->fat;
						$tcal = $tcal + $row->kcal;
						$totcal = ($row->grams/100)*$row->kcal;
						$tt = $tt + $totcal;
						echo '<td>'.$totcal.'</td>';
						echo '<td><a href="auth.php?action=deling&id='.$row->id.'&prod_id='.$prod_id.'" onclick="return confirmdelx();">delete</a></td>';
						echo '</tr>';
				
					}
						// echo '<tr>';					
						// echo '<td style="width:150px;"><b></b></td>';						
						// echo '<td><b>'.$g.'</b></td>';
						// echo '<td><b>'.$tep.'</b></td>';
						// echo '<td><b>'.$tc.'</b></td>';
						// echo '<td><b>'.$tp.'</b></td>';
						// echo '<td><b>'.$tf.'</b></td>';
						// echo '<td><b>'.$tcal.'</b></td>';						
						// echo '<td><b>'.$tt.'</b></td>';
						// echo '<td></td>';
						// echo '</tr>';
				}
				
				function getVal($x)
				{
					@include "conn.php";
					$mysqli = new mysqli($host, $user, $pass, $db);
					$res = $mysqli->query("SELECT * FROM tblcatalog where id='$x'");
					$str = "";
					while($row =$res->fetch_object())
					{
						$str = $row->fname;
					}
					return $str;
				}
			   ?>
			</tbody>
		</table>
	</div>
	</div>
			
		</div>
		<br/>
		<div>
		
		
	
	<div id="qwe"></div>
	<script>

			$(function(){
    $("#ppp").click(function() {
        $(this).toggleClass("active");
    });
});
	</script>
		<?php include 'footer.php'; ?>
		
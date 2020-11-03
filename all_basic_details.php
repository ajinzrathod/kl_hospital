<?php
include ('checksession.php');

include_once ('first.php');
include_once ('navbar.php');
include_once ('connectDb.php');
?>
<link href="css/show_details.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/bootstrap3.4.1.css">

<?php
@session_start();
include ('recordsPerPage_Session.php');

?>
<body>
	<center>
		<?php
		include ('recordsPerPage_Form.php');
		?>
	</center>

	<div class="container-fluid">
		<div class="panel filterable">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-list"></span>
						Patients Basic Details
						<div class="pull-right action-buttons">
						</div>

						<div class="pull-right">
							<button class="btn btn-default btn-sm btn-filter">
								<span class="glyphicon glyphicon-filter"></span> Filter
							</button>
						</div>
						
					</div>
					<?php
					// "$pageno1" and "$recordsperpage" from recordsPerPage_Session
					$into10=$pageno1*$recordsPerPage;
					$minus9=$into10-$recordsPerPage; 
					$sel11 = "SELECT * FROM personal_details WHERE doctor_id =". $_SESSION['doctor_id'] . " ORDER BY visit_date DESC LIMIT $minus9,$recordsPerPage";
					$result = mysqli_query($conn2,$sel11);

					?>

					<div class="panel-body">
						<!-- Above Line has panel-body class, removed for getting more space -->
						<ul class="list-group">


							<?php echo "<table border='0' class='table table-responsive table-striped table-borderless'>"; ?>


							<thead>
								<tr class="filters">
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
									<th><input  style="font-weight: bolder;" type="text" class="form-control" disabled></th>
								</tr>
							</thead>


							<?php echo "<tr style='background-color:#63a0d4;'>" ?>
							<?php echo "<td>id</td>"; ?>
							<?php echo "<td>Full Name</td>"; ?>
							<?php echo "<td>Mobile No</td>"; ?>
							<?php echo "<td>Email</td>"; ?>
							<?php echo "<td>Address</td>"; ?>
							<?php echo "<td>Date of Birth</td>"; ?> 
							<?php echo "<td>Gender</td>"; ?>
							<?php echo "<td>Marital Status</td>"; ?>
							<?php echo "<td>Occupation</td>"; ?>
							<?php echo "<td>Insurance Id</td>"; ?>
							<?php echo "<td>Referred by</td>"; ?>
							<?php echo "<td>Visit Date</td>"; ?>
							<?php echo "<td>Follow up Date</td>"; ?>

							<?php echo "<td>Edit</td>"; ?>
							<?php echo "<td>Delete</td>"; ?>
							<?php echo "</tr>" ?>
							<?php
							while($fetch=mysqli_fetch_array($result)){
								?>
								<?php echo "<tr>" ?>
								<?php echo '<td><a href="edit_details.php?pageno='.$pageno1.'&id='.$fetch[0].'">'.$fetch[0].'</a></td>'; ?>

								<?php echo "<td>".$fetch[1]."</td>"; ?>
								<?php echo "<td>".$fetch[2]."</td>"; ?>
								<?php echo "<td>".$fetch[3]."</td>"; ?>
								<?php echo "<td>".$fetch[4]."</td>"; ?>
								<?php echo "<td>".date("d-m-y", strtotime($fetch[5]))."</td>"; ?>
								<?php echo "<td>".$fetch[6]."</td>"; ?>
								<?php echo "<td>".$fetch[7]."</td>"; ?>
								<?php echo "<td>".$fetch[8]."</td>"; ?>
								<?php echo "<td>".$fetch[9]."</td>"; ?>
								<?php echo "<td>".$fetch[10]."</td>"; ?>
								<?php echo "<td>".date("d-m-y h:i a", strtotime($fetch[11]))."</td>"; ?>
								<?php echo "<td>".date("d-m-y", strtotime($fetch[12]))."</td>"; ?>

								<div class="pull-right action-buttons">
									<?php echo "<td>" ?>
									<?php
									echo '
									<a href="edit_details.php?pageno='.$pageno1.'&id='.$fetch[0].'"><span class="glyphicon glyphicon-pencil"></span></a>
									';
									?>
									<?php echo "</td>" ?>
									<?php echo "<td>" ?>
									<?php
									echo '
									<a href="delete_record.php?pageno='.$pageno1.'&id='.$fetch[0].'" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
									';
									?>
									<?php echo "</td>" ?>
								</div>
								<?php echo "</tr>" ?>
								<?php 
							}
							echo "</table>";
							?>                        
						</ul>
					</div>
					<?php
					$my_pagination_query="SELECT email FROM personal_details WHERE doctor_id =". $_SESSION['doctor_id'] . " ORDER BY visit_date DESC";
					include ('pagination.php');
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
	include('footer.php');
	?>
</body>
<?php

include_once('footer.php');
include_once('loader_alljs.php');

?>

<script type="text/javascript" src="js/filter_data.js"></script>

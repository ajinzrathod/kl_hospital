<form method="post">
	<div class="row">
		<div class="form-group col-md-12">
			Maximum Records Per Page
			<select name="recordsPerPage" class="form-control"  style="max-width: 200px">
				<?php
				if(isset($_SESSION['recordsPerPage'])){
					echo "<option selected disabled value = \"".$recordsPerPage."\">$recordsPerPage</option>";
				}
				?>
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
		</div>
		<div class="col-md-12" class="form-control">
			<button type="submit" name="sbt" class="btn btn-md btn-primary">Submit</button>
		</div>
	</div>
</form>


<?php
@session_start();
if (isset($_POST['sbt'])) {
	$_SESSION['recordsPerPage'] = $_POST['recordsPerPage'];
	echo "<script>location='".basename($_SERVER['PHP_SELF'])."'</script>";
}
?>
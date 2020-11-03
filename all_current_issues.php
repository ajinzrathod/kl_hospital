<?php
include ('checksession.php');

include_once ('first.php');
include_once ('navbar.php');
include_once ('connectDb.php');
?>
<style type="text/css">
	.aj_alert {
		margin-right: 10px;
		margin-left: 10px;
	}
</style>

<section class="ftco-section">
	<div class="container">
		<div class="row"> 
			<div class="col-md-2 alert alert-primary aj_alert fade show"><center> <a href = "all_history_of_present_illness.php" class = "alert-link">History of present Illness</a></center></div>

			<div class="col-md-2 alert alert-primary aj_alert fade show"><center> <a href = "all_laboratary.php" class = "alert-link">Laboratary</a></center></div>					

			<div class="col-md-2 alert alert-primary aj_alert fade show"><center> <a href = "all_medications.php" class = "alert-link">Medication</a></center></div>
		</div>
	</div>
</section>
<?php

include_once('footer.php');
include_once('loader_alljs.php');

?>
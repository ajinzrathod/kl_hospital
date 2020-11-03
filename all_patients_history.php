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
			<div class="col-md-2 alert alert-primary aj_alert fade show"><center> <a href = "all_personal_history.php" class = "alert-link">Personal History</a></center></div>

			<div class="col-md-2 alert alert-primary aj_alert fade show"><center> <a href = "all_pedia_history.php" class = "alert-link">Pedia History</a></center></div>

			<div class="col-md-2 alert alert-primary aj_alert fade show"><center> <a href = "all_feeding_history.php" class = "alert-link">Feeding History</a></center></div>

			<div class="col-md-2 alert alert-primary aj_alert fade show"><center> <a href = "all_age_of_milestone_history.php" class = "alert-link">Age of Milestone History</a></center></div>

			<div class="col-md-2 alert alert-primary aj_alert fade show"><center> <a href = "all_general_habit_history.php" class = "alert-link">General History</a></center></div>					

			<div class="col-md-2 alert alert-primary aj_alert fade show"><center> <a href = "all_ob_history.php" class = "alert-link">Ob History</a></center></div>

		</div>
	</div>
</section>
<?php

include_once('footer.php');
include_once('loader_alljs.php');

?>
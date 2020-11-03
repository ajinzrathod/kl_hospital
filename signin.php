<?php
include ('checksession.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>KL Hospital</title>
	<?php
	include_once ('first.php');
	?>
</head>
<body>

	<?php
	include_once ('navbar.php');
	?>	
	
	<section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb" style="margin-top: 100px;">
		<div class="overlay"></div>
		<div class="container">
			<div class="row d-md-flex justify-content-center">
				<div class="col-md-6">
					<div class="wrap-appointment d-md-flex">
						<div class="col-md-12 bg-primary p-5 heading-section heading-section-white">
							<h2 class="mb-4">Sign In</h2>
							<form class="appointment" name="signin_form" method="post">
								<div class="row justify-content-center">

									<div class="col-md-12">
										<div class="form-group">
											<input type="email" class="form-control" placeholder="Email" name="email" required>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<input type="password" class="form-control" placeholder="Password" name="password" required>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<input type="submit" value="Sign In" class="btn btn-secondary py-3 px-4" name="sbt">
										</div>
									</div>

									<span class="subheading">Dont have a id?</span>


								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
 	include_once ('loader_alljs.php');
	?>

</body>
</html>


<?php

if(isset($_POST['sbt'])) {
	include_once ('connectDb.php');
	include_once ('check_signin_details.php');
}
?>
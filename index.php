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

	<div class="hero-wrap">
		<div class="home-slider owl-carousel">
			<div class="slider-item" style="background-image:url(images/new1.jpg);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text align-items-center justify-content-end">
						<div class="col-md-6 ftco-animate">
							<div class="text w-100">
								<h1 class="mb-4">Med Info By Shah Kajal</h1>
								<p>The presence of the doctor is the beginning of the cure.</p>
								<p><a href="signin.php" class="btn btn-primary">Sign In</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="slider-item" style="background-image:url(images/new2.jpg);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text align-items-center justify-content-end">
						<div class="col-md-6 ftco-animate">
							<div class="text w-100">
								<h1 class="mb-4">Med Info By Shah Kajal</h1>
								<p>An apple a day keeps the doctor away, But if the doctor is cute forget the fruit.</p>
								<p><a href="signin.php" class="btn btn-primary">Sign In</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb">
		<div class="overlay"></div>
		<div class="container">
			<div class="row d-md-flex justify-content-center">
				<div class="col-md-12">
					<div class="wrap-appointment d-md-flex">
						<div class="col-md-12 bg-primary p-5 heading-section heading-section-white">
							<span class="subheading">Dont have a id?</span>
							<h2 class="mb-4">Sign Up</h2>
							<form class="appointment" name="signin_form" method="post">
								<div class="row justify-content-center">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Your Name" name="full_name" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="email" class="form-control" placeholder="Email" name="email" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<input type="password" class="form-control" placeholder="Password" name="password" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<input type="password" class="form-control" placeholder="Confirm Password" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<input type="submit" value="Sign In" class="btn btn-secondary py-3 px-4" name="sbt">
										</div>
									</div>


								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	include_once ('footer.php');
	?>

	<?php
	include_once ('loader_alljs.php')
	?>

</body>
</html>



<?php

if(isset($_POST['sbt'])) {
	include_once ('connectDb.php');
	include_once ('signup_db.php');
}
?>
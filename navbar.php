<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="fa fa-bars"></span> Menu
		</button>
		<div class="order-lg-last">
			<?php
			
			// if session exists
			if((isset($_SESSION['doctor_id']) && !empty($_SESSION['doctor_id']))) {
				echo '<a href = "doctor_index.php"><button class="btn btn-primary">';
				echo $_SESSION['doctor_fullname'];
				echo "(" .$_SESSION['doctor_id'] . ")";

				echo '</button></a>';

				echo '<a href = "destroy_sessions.php"><button class="btn btn-danger" style = "margin-left:5px;">';
				echo "Logout";
				echo '</button></a>';
			}

			// if session does NOT exists
			else {
				if(basename($_SERVER['PHP_SELF']) == 'index.php') {
					echo '<a href = "signin.php" style = "color:white;"> <button class="btn btn-primary">';
					echo " Sign In ";
					echo '</button> </a>';
				}
				if(basename($_SERVER['PHP_SELF']) == 'signin.php') {
					echo '<a href = "index.php" style = "color:white;"> <button class="btn btn-primary">';
					echo " Sign Up ";
					echo '</button> </a>';
				}
			}

			?>
		</div>
		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active"><a href="doctor_index.php" class="nav-link">Home</a></li>
				<!-- <li class="nav-item"><a href="about.html" class="nav-link">About</a></li> -->
				<!-- <li class="nav-item"><a href="team.html" class="nav-link">Team</a></li> -->
				<!-- <li class="nav-item"><a href="services.html" class="nav-link">Services</a></li> -->
				<li class="nav-item"><a href="appointments.php" class="nav-link">My Appointments</a></li>
				<!-- <li class="nav-item"><a href="department.html" class="nav-link">Departments</a></li> -->
				<!-- <li class="nav-item"><a href="gallery.html" class="nav-link">Gallery</a></li> -->
				<!-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li> -->
				<li class="nav-item"><a href="contact.html" class="nav-link">Locate Us</a></li>
			</ul>
		</div>
	</div>
</nav>
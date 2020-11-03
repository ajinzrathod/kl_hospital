<?php
include ('checksession.php');

include_once ('first.php');
include_once ('navbar.php');
include_once ('connectDb.php');
?>


<section class="ftco-section">
	<div class="container">
		<div class="row">

			<?php

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// $stmt = $conn->prepare("SELECT * FROM personal_details LIMIT 0, 5");
				// $_SESSION['doctor_id'] = 4;
				$stmt = $conn->prepare("SELECT * FROM personal_details WHERE doctor_id = :doctor_id ORDER BY `follow_up_date`");
				
				$stmt->bindParam(':doctor_id', $doctor_id);
				$doctor_id = $_SESSION['doctor_id'];

				$stmt->execute();
				$stmt->execute();

				$row = $stmt->rowCount();
				

				$i = 0;
				while($data = $stmt->fetch( PDO::FETCH_ASSOC )) { 
					$num_padded = sprintf("%06d", $data['id']);
					if((date("Y-m-d") <= $data['follow_up_date']) == true) { 
						$i++;
						echo '<div class="col-md-6">
						<div class="tab-content" style = "border: 3px solid grey; padding: 10px; margin: 10px;">
						<div class="tab-pane container p-0 active" id="services-1">
						<div class="img" style="background-image: url(images/work-2.jpg);"></div>
						<h3><a href="#">
						';
						echo date("M d, Y", strtotime($data["follow_up_date"])) . "<br>";
						echo '</a></h3>
						<p>Meet <strong>' .$data['full_name'] . '</strong> whose id is <strong>' .$data['email'] . '</strong> </p>
						</div>
						</div>
						</div>';

					}
				}
		echo '</div>';

				if(!$i) {
					echo '
					<div class="col-md-12">
					<div class="form-group">
					$row Records found
					</div>
					</div>';
				} else {
					echo "<b>$i Appointments</b>";
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;

			?>


	</div>
</section>
<?php

include_once('footer.php');
include_once('loader_alljs.php');

?>
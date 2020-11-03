
<?php
include ('checksession.php');
include_once ('connectDb.php');

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM personal_details WHERE id = :id and doctor_id = :doctor_id");

$stmt->bindParam(':id', $patient_id);
$stmt->bindParam(':doctor_id', $doctor_id);

$doctor_id = $_SESSION['doctor_id'];

if(isset($_GET['id'])) {
	$patient_id = $_GET['id'];
	$modal_title = $patient_id;
} else {
	echo "Unable to perform action";
}
$stmt->execute();

$row = $stmt->fetch();
if(!$row) {
	$modal_body = 'You are not authorized to view this page';

	include ('modal.php');

	// echo "You are not authorized to view this id";
	exit();
}

include_once ('first.php');
include_once ('navbar.php');
?>
<style type="text/css">
	.aj-dark-color {
		color: #2D3E50 !important;
	}
	.aj_dropdown {
		padding: 10px;
		margin-right: 10px;
		margin-left: 10px;
	}
	.aj_dropdown:hover {
		transform: scale(1.2);
		background: #01d28e;
	}
	.aj_dropdown:hover a{
		color: white;		
	}

	.aj_alert {
		margin-right: 10px;
		margin-left: 10px;
	}
</style>
<section class="ftco-section bg-light">
	<div class="container">

		<!-- <div class="dropdown">
			<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Other Details
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				
				<li class="aj_dropdown"><a href="all_clinical_findings.php">Clinicial Findings</a></li>
				<li class="aj_dropdown"><a href="current">Current Issues</a></li>
				<li class="aj_dropdown"><a href="#">Patients History</a></li>
			</ul>
		</div> -->
		<?php

		echo "<div class = 'row'>";

		echo "<div class=\"col-md-3 alert alert-primary aj_alert fade show\"><center> <a href = \"all_clinical_findings.php\" class = \"alert-link\">Clinicial Findings</a></center></div>";					
		echo "<div class=\"col-md-3 alert alert-primary aj_alert fade show\"><center> <a href = \"all_current_issues.php\" class = \"alert-link\">Current Issues</a></center></div>";					
		echo "<div class=\"col-md-3 alert alert-primary aj_alert fade show\"><center> <a href = \"all_patients_history.php\" class = \"alert-link\">Patients History</a></center></div>";							

		echo "</div>";

		?>
		<br>

		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="wrapper">
					<div class="row no-gutters">
						<div class="col-md-12 d-flex">
							<div class="contact-wrap w-100 p-md-5 p-4">
								<h3 class="mb-4"> ID |
									<?php
									$num_padded = sprintf("%06d", $patient_id);
									echo $num_padded; 
									?>
								</h3>
								<form method="POST" id="contactForm" class="contactForm" name="editform1">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												Full name
												<input type="text" class="form-control" name="full_name" id="name" placeholder="Full Name" value="<?php echo $row['full_name']; ?>">
											</div>
										</div>
										<div class="col-md-6"> 
											<div class="form-group">
												Email Id
												<input disabled style="background-color: #ddd !important;" type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $row['email']; ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												Mobile No
												<input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="mobile_no" value="<?php echo $row['mobile_no']; ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												Occupation
												<input type="text" class="form-control" name="occupation" id="occupation" placeholder="occupation" value="<?php echo $row['occupation']; ?>">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												Inrurance Id
												<input type="text" class="form-control" name="insurance_id" id="insurance_id" placeholder="insurance_id" value="<?php echo $row['insurance_id']; ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												Referred By
												<input type="text" class="form-control" name="referred_by" id="referred_by" placeholder="referred_by" value="<?php echo $row['referred_by']; ?>">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<select class="form-control" name="gender" id="gender">
													<?php
													if($row['gender'] == 0) {
														echo '<option value="0" selected disabled>Select Gender</option>';
														echo '<option value="1">Male</option>';
														echo '<option value="2">Female</option>';
													}
													elseif($row['gender'] == 1){
														echo '<option disabled value="0">Select Gender</option>';
														echo '<option selected value="1">Male</option>';
														echo '<option value="2">Female</option>';
													}
													elseif($row['gender'] == 2){
														echo '<option disabled value="0">Select Gender</option>';
														echo '<option value="1">Male</option>';
														echo '<option selected value="2">Female</option>';
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<select class="form-control" name="marital_status" id="marital_status">
													<?php
													if($row['marital_status'] == 0) {
														echo '<option value="0" selected disabled>Marital Status</option>';
														echo '<option value="1">Married</option>';
														echo '<option value="2">Unmarried</option>';
													}
													elseif($row['marital_status'] == 1){
														echo '<option disabled value="0">Marital Status</option>';
														echo '<option selected value="1">Married</option>';
														echo '<option value="2">Unmarried</option>';
													}
													elseif($row['marital_status'] == 2){
														echo '<option disabled value="0">Marital Status</option>';
														echo '<option value="1">Married</option>';
														echo '<option value="2" selected>Umarried</option>';
													}
													?>
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<?php
											if($row["dob"] == NULL) {
												echo '
												Follow up Date<input type="date" class="form-control" name="dob" id="dob">
												';
											}
											else {
												$dob = strftime('%Y-%m-%d', strtotime($row["dob"]));
												echo '
												Date of Birth<input type="date" class="form-control" name="dob" id="dob" value="'.$dob.'">
												';
											}
											?>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php
												if(!$row["follow_up_date"]) {
													echo '
													Follow up Date<input type="date" class="form-control" name="follow_up_date" id="follow_up_date">
													';
												}
												else {
													$follow_up_date = strftime('%Y-%m-%d', strtotime($row["follow_up_date"]));
													echo '
													Follow up Date<input type="date" class="form-control" name="follow_up_date" id="follow_up_date" value="'.$follow_up_date.'">
													';
												}
												?>
											</div>
										</div>


										<div class="col-md-12">
											<div class="form-group">
												Address
												<textarea name="address" class="form-control" id="address" cols="30" rows="7" placeholder="address"><?php echo $row['address'] ?></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<input type="submit" value="Save Edits" class="btn btn-primary" name="sbt1">
												<div class="Saving Edits"></div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>


						<!-- <div class="col-md-5 d-flex align-items-stretch">
							<div class="info-wrap bg-primary w-100 p-lg-5 p-4">
								<h3 class="mb-4 mt-md-4 aj-dark-color">Basic Details</h3>
								<div class="dbox w-100 d-flex align-items-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-globe"></span>
									</div>
									<div class="text pl-3">
										<p><span class="aj-dark-color">Unique Id: </span> <a href="#" class="aj-dark-color"><?php echo $patient_id; ?></a></p>
									</div>
								</div>
								<div class="dbox w-100 d-flex align-items-start">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-map-marker"></span>
									</div>
									<div class="text pl-3">
										<p><span class="aj-dark-color">Name:</span> <a class="aj-dark-color"><?php echo $row['full_name']; ?></a> </p>
									</div>
								</div>
								<div class="dbox w-100 d-flex align-items-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-phone"></span>
									</div>
									<div class="text pl-3">
										<p><span class="aj-dark-color">Phone:</span>
											<?php echo '<a class="aj-dark-color" href="tel://'.$row['mobile_no'].'">' ?>
											<?php echo $row['mobile_no']; ?>		
										</a>
									</p>
								</div>
							</div>
							<div class="dbox w-100 d-flex align-items-center">
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="fa fa-paper-plane"></span>
								</div>
								<div class="text pl-3">
									<p><span class="aj-dark-color">Email:</span> 
										<?php
										echo '<a class="aj-dark-color" href="mailto:'.$row['email'].'">';
										?>
										<?php echo $row['email']; ?>
									</a>
								</p>
							</div>
						</div> -->

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</section>

<?php

include_once('footer.php');
include_once('loader_alljs.php');

?>




<?php
if(isset($_POST['sbt1'])) {
	if($_POST['full_name']) {
		$full_name = $_POST['full_name'];
	}
	if($_POST['mobile_no']){
		$mobile_no = $_POST['mobile_no'];
	}
	if($_POST['occupation']){
		$occupation = $_POST['occupation'];
	}
	if($_POST['insurance_id']){
		$insurance_id = $_POST['insurance_id'];
	}
	if($_POST['referred_by']){
		$referred_by = $_POST['referred_by'];
	}
	if($_POST['gender']){
		$gender = $_POST['gender'];
	}
	if($_POST['marital_status']){
		$marital_status = $_POST['marital_status'];
	}
	if($_POST['dob']){
		$dob = $_POST['dob'];
	}
	if($_POST['follow_up_date']){
		$follow_up_date = $_POST['follow_up_date'];
	}
	if($_POST['address']){
		$address = htmlspecialchars($_POST['address']);
	}
	
	// echo "full_name => " . $full_name . "<br>";
	// echo "mobile_no => " . $mobile_no . "<br>";
	// echo "occupation => " . $occupation . "<br>";
	// echo "insurance_id => " . $insurance_id . "<br>";
	// echo "referred_by => " . $referred_by . "<br>";
	// echo "gender => " . $gender . "<br>";
	// echo "marital_status => " . $marital_status . "<br>";
	// echo "dob => " . $dob . "<br>";
	// echo "follow_up_date => " . $follow_up_date . "<br>";
	// echo "address => " . $address . "<br>";

	include('personal_details_db.php');
}
?>

<!-- Edit only when patient belongs to that doctor id, else anyone can deleet :lol -->
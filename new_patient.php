
<?php
include ('checksession.php');
include_once ('connectDb.php');


include_once ('first.php');
include_once ('navbar.php');
?>
<style type="text/css">
	.aj-dark-color {
		color: #2D3E50 !important;
	}
</style>
<section class="ftco-section bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="wrapper">
					<div class="row no-gutters">
						<div class="col-md-12 d-flex">
							<div class="contact-wrap w-100 p-md-5 p-4">
								<h3 class="mb-4"> New Patient
								</h3>
								<form method="POST" id="contactForm" class="contactForm" name="editform1">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												Full name
												<input type="text" class="form-control" name="full_name" id="name" placeholder="Full Name" 
												<?php 
												if(isset($_POST['full_name']))  { 
													echo "value = \"" . $_POST['full_name'] . "\""; 
												}
												?>
												>
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<div id="email_label">Email Id</div>
												<input type="email" class="form-control" name="email" id="email" placeholder="Email"
												<?php 
												if(isset($_POST['email']))  { 
													echo "value = \"" . $_POST['email'] . "\""; 
												}
												echo ' autofocus';
												?>
												>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												Mobile No
												<input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile no"
												<?php 
												if(isset($_POST['mobile_no']))  { 
													echo "value = \"" . $_POST['mobile_no'] . "\""; 
												}
												?>
												>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												Occupation
												<input type="text" class="form-control" name="occupation" id="occupation" placeholder="occupation"
												<?php 
												if(isset($_POST['occupation']))  { 
													echo "value = \"" . $_POST['occupation'] . "\""; 
												}
												?>
												>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												Inrurance Id
												<input type="text" class="form-control" name="insurance_id" id="insurance_id" placeholder="insurance_id"
												<?php 
												if(isset($_POST['insurance_id']))  { 
													echo "value = \"" . $_POST['insurance_id'] . "\""; 
												}
												?>
												>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												Referred By
												<input type="text" class="form-control" name="referred_by" id="referred_by" placeholder="referred_by"
												<?php 
												if(isset($_POST['referred_by']))  { 
													echo "value = \"" . $_POST['referred_by'] . "\""; 
												}
												?>
												>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<select class="form-control" name="gender" id="gender">
													<?php 
													if(isset($_POST['gender']))  {
														echo '<option value="0"disabled>Select Gender</option>'; 
														if ($_POST['gender'] == 1) { 
															echo '<option value="1" selected>Male</option>'; 
															echo '<option value="2">Female</option>'; 
														} else if ($_POST['gender'] == 2) {
															echo '<option value="1">Male</option>'; 
															echo '<option value="2" selected>Female</option>'; 
														}
													}
													else {
														echo '<option value="0" selected disabled>Select Gender</option>'; 
														echo '<option value="1">Male</option>'; 
														echo '<option value="2">Female</option>'; 
													} 

													?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<select class="form-control" name="marital_status" id="marital_status">
													<?php
													if(!isset($_POST['marital_status']))  {

														echo '<option value="0" selected disabled>Marital Status</option>';
														echo '<option value="1">Married</option>';
														echo '<option value="2">Unmarried</option>';
													}
													else {
														echo '<option value="0" disabled>Marital Status</option>';
														if($_POST['marital_status'] == 1) {
															echo '<option value="1" selected>Married</option>';
															echo '<option value="2">Unmarried</option>';
														}	
														else if($_POST['marital_status'] == 2) {
															echo '<option value="1">Married</option>';
															echo '<option value="2" selected>Unmarried</option>';
														}													
													}
													?>
												</select>
											</div>
										</div>

										<div class="col-md-6">

											Date of Birth<input type="date" class="form-control" name="dob" id="dob"
											<?php
											if(isset($_POST['dob'])) {
												$dob = strftime('%Y-%m-%d', strtotime($_POST["dob"]));
												echo "value = $dob";
											}
											?>
											>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												Follow up Date<input type="date" class="form-control" name="follow_up_date" id="follow_up_date"
												<?php
												if(isset($_POST['follow_up_date'])) {
													$follow_up_date = strftime('%Y-%m-%d', strtotime($_POST["follow_up_date"]));
													echo "value = $follow_up_date";
												}	
												?>
												>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												Address
												<textarea name="address" class="form-control" id="address" cols="30" rows="7" placeholder="address"><?php if(isset($_POST['address']))  { 
													echo $_POST['address']; 
												}
												?></textarea>
												<!-- CAUTION: If there is space between <textarea> and </textarea>, browser will take spaces in textarea. -->
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<input type="submit" value="Insert Record" class="btn btn-primary" name="sbt1">
												<div class="Saving Edits"></div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</section>

<?php

// include_once('footer.php');
include_once('loader_alljs.php');

?>




<?php
if(isset($_POST['sbt1'])) {
	if($_POST['full_name']) {
		$full_name = $_POST['full_name'];
	}else {
		$full_name = NULL;
	}

	if($_POST['email']){
		$email = $_POST['email'];
	}else {
		$email = NULL;
	}

	if($_POST['mobile_no']){
		$mobile_no = $_POST['mobile_no'];
	}else {
		$mobile_no = NULL;
	}

	if($_POST['occupation']){
		$occupation = $_POST['occupation'];
	}else {
		$occupation = NULL;
	}

	if($_POST['insurance_id']){
		$insurance_id = $_POST['insurance_id'];
	}else {
		$insurance_id = NULL;
	}

	if($_POST['referred_by']){
		$referred_by = $_POST['referred_by'];
	}else {
		$referred_by = NULL;
	}

	if($_POST['gender']){
		$gender = $_POST['gender'];
	}else {
		$gender = NULL;
	}

	if($_POST['marital_status']){
		$marital_status = $_POST['marital_status'];
	}else {
		$marital_status = NULL;
	}

	if($_POST['dob']){
		$dob = $_POST['dob'];
	}else {
		$dob = NULL;
	}

	if($_POST['follow_up_date']){
		$follow_up_date = $_POST['follow_up_date'];
	}else {
		$follow_up_date = NULL;
	}

	if($_POST['address']){
		$address = htmlspecialchars($_POST['address']);
	}else {
		$address = NULL;
	}

	
	// echo "full_name => " . $full_name . "<br>";
	// echo "email => " . $email . "<br>";
	// echo "mobile_no => " . $mobile_no . "<br>";
	// echo "occupation => " . $occupation . "<br>";
	// echo "insurance_id => " . $insurance_id . "<br>";
	// echo "referred_by => " . $referred_by . "<br>";
	// echo "gender => " . $gender . "<br>";
	// echo "marital_status => " . $marital_status . "<br>";
	// echo "dob => " . $dob . "<br>";
	// echo "follow_up_date => " . $follow_up_date . "<br>";
	// echo "address => " . $address . "<br>";
	// echo "doctor_id => " . $_SESSION['doctor_id'] . "<br>";

	include('new_patient_db.php');
}
?>

<!-- Edit only when patient belongs to that doctor id, else anyone can deleet :lol -->
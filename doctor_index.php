
<?php
include ('checksession.php');

include_once ('first.php');
include_once ('navbar.php');
include_once ('connectDb.php');
?>
<style type="text/css">
	.result {
		/*line-height: 300%; */
		padding-right:10px;
		padding-left:10px;
		font-size: 20px;
		cursor: pointer; 
		background-color: #F8F9FD;
		opacity: 0.8;
		border-radius: 0.5rem;
	}
	.edit_btn {
		width: 210px;
		font-size: 0.85em;
		font-family: sans-serif;
		max-width: auto;
		margin-bottom: 10px; 
		/*margin-top: 10px; */
	}
	.dropdown-menu{
		/*color: red;*/
		font-size: 10px;
	}
	.aj_alert {
		margin-right: 10px;
		margin-left: 10px;
	}
</style>
<script src="js/jquery-1.12.4.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.search-box input[type="text"]').on("keyup input", function(){
			/* Get input value on change */
			var inputVal = $(this).val();
			var resultDropdown = $(this).siblings(".result");
			if(inputVal.length){
				$.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
			} else{
				resultDropdown.empty();
			}
		});

    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
    	$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
    	$(this).parent(".result").empty();
    });
});
</script>


<section class="ftco-section">
	<div class="container">

		<?php

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// $stmt = $conn->prepare("SELECT * FROM personal_details LIMIT 0, 5");
				// $_SESSION['doctor_id'] = 4;
			$stmt = $conn->prepare("SELECT * FROM personal_details WHERE doctor_id = :doctor_id ORDER BY `id` DESC");

			$stmt->bindParam(':doctor_id', $doctor_id);
			$doctor_id = $_SESSION['doctor_id'];

			$stmt->execute();
			$stmt->execute();

			$row = $stmt->rowCount();
			
			if(!$row) {
				echo "<div class=\"col-md-12 alert alert-primary fade show\">
				<center> No Records to show 
				<a href = \"new_patient.php\" class = \"alert-link\">
				<u>Click to Insert</u>
				</a>
				</center>
				</div>";

			} else {
				echo "<div class = 'row'>";
				echo "<div class=\"col-md-2 alert alert-primary aj_alert fade show\"><center> <a href = \"all_basic_details.php\" class = \"alert-link\">Basic Details</a></center></div>";					
				echo "<div class=\"col-md-2 alert alert-primary aj_alert fade show\"><center> <a href = \"all_clinical_findings.php\" class = \"alert-link\">Clinicial Findings</a></center></div>";					
				echo "<div class=\"col-md-2 alert alert-primary aj_alert fade show\"><center> <a href = \"all_current_issues.php\" class = \"alert-link\">Current Issues</a></center></div>";					
				echo "<div class=\"col-md-2 alert alert-primary aj_alert fade show\"><center> <a href = \"all_patients_history.php\" class = \"alert-link\">Patients History</a></center></div>";					

				echo "<div class=\"col-md-2 alert alert-primary aj_alert fade show\"><center> <a href = \"new_patient.php\" class = \"alert-link\"><u>Insert New Patient</u></a></center></div>";					

				echo "</div>";
					// echo "<input type = 'text' class = 'form-control' placeholder = 'Search Patients'>";

				echo '
				<form class= "contactForm" style = "z-index:10;">
				<div class="row">
				<div class="col-md-12">

				<div class="form-group">
				<div class="search-box">
				<input type="text" autocomplete="off" placeholder="Search Patient Id here without zero..." class = "form-control"/>
				<div class="result"></div>
				</div>
				</div>
				</div>
				</div>
				</form>
				';
			}
			echo "<div class='col-md-12'>
			<div class='form-group'>
			$row Records found
			</div>
			</div>
			";

			echo '<div class="row">';

			while($data = $stmt->fetch( PDO::FETCH_ASSOC )) { 
				echo '<div class="col-md-4 d-flex ftco-animate bg-light" style = \'margin-bottom: 10px\'">
				<div class="blog-entry align-self-stretch">
				<div class="text mt-3">

				<h5 class="heading">';
				$num_padded = sprintf("%06d", $data['id']);
				echo $num_padded; 
				echo "</h5><h6>";
				echo ''. $data['full_name'] .'</h6>

				<div>
				<a href="edit_details.php?id='.$data['id'].'" class="btn edit_btn btn-primary">Personal Details</a>
				</div>


				';
				// echo '
				// <div>
				// <a href="delete_record.php?id='.$data['id'].'" class="btn edit_btn btn-danger">Remove Patient</a>
				// </div>
				// ';
				
				echo '
				</form>
				</div>
				</div>
				</div>';
			}
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;

		?>


	</div>
</div>
</section>

<?php

include_once('footer.php');
include_once('loader_alljs.php');

?>
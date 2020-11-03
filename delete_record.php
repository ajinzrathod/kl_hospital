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
	$modal_body = 'You are not authorized to view this id';

	include ('modal.php');

	// echo "You are not authorized to view this id";
	exit();
}


try {

  // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // prepare sql and bind parameters
  $stmt = $conn->prepare("DELETE FROM `personal_details` WHERE id = :patient_id;");

  $stmt->bindParam(':patient_id', $patient_id);

  $stmt->execute();

  echo "Record Deleted";

  $modal_title = "Deleted";
  $modal_body = "Record Deleted Forever";

  include_once ('modal.php');
} 

catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>
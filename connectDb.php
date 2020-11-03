<?php
@session_start();
$servername = "localhost";
$username = "root";
$password = "google";
$dbname = "kl_hospital";

// $servername = "localhost";
// $username = "theunite_kajal";
// $password = "Gamma@0227";
// $dbname = "theunite_kl_hospital";



try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;



// BY mysqli
$conn2 = new mysqli($servername, $username, $password, $dbname);

if ($conn2->connect_error) {
	die("Connection failed: " . $conn2->connect_error);
} else{
	// echo "Connected successfully";
}



$mysqli = new mysqli($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
	echo json_encode(array('mysqli' => 'Failed to connect to MySQL: ' . mysqli_connect_error()));
	exit;
}

?>
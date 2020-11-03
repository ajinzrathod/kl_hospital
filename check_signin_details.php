<?php
@session_start();
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
 	 // set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt = $conn->prepare("SELECT id, full_name FROM doctor_details WHERE email = :email AND password = :password");
	
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':password', $password);

	
	$email = $_POST['email'];
	$password = $_POST['password'];

	$stmt->execute();

	$row = $stmt->fetch();

	if (!$row) {
		$modal_title = "# Invalid Credentials"; 
		$modal_body = "Please double check your email id and password. <br>Password is case sensitive";

		include ('modal.php');
	} else {
		include ('set_session.php');
		echo "<script>location='doctor_index.php'</script>";
	}
	
}
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}

$conn = null;

?>
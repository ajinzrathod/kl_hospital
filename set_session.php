<?php
@session_start();
try {
	
	$stmt = $conn->prepare("SELECT id, full_name FROM doctor_details WHERE email = :email");
	
	$stmt->bindParam(':email', $email);
	$stmt->execute();

	$row = $stmt->fetch();

	$_SESSION['doctor_id'] = $row[0];
	$_SESSION['doctor_fullname'] = $row[1];

	echo $_SESSION['doctor_id'];
	echo $_SESSION['doctor_fullname'];

}
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}

$conn = null;

?>


<?php
// Does not work in where condition

// $sth = $dbh->prepare("SELECT name, colour FROM fruit");
// $sth->execute();

// print("Fetch the first column from the first row in the result set:\n");
// $result = $sth->fetchColumn();
// print("name = $result\n");

// print("Fetch the second column from the second row in the result set:\n");
// $result = $sth->fetchColumn(1);
// print("colour = $result\n");
?>
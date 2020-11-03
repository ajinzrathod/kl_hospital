<?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



  // Check if email id exist
  $stmt = $conn->prepare("SELECT email FROM doctor_details WHERE email = :email");
  
  $stmt->bindParam(':email', $email);
  
  $email = $_POST['email'];

  $stmt->execute();

  $row = $stmt->fetch();

  if ($row) {
    $modal_title = "# Email Id Exists"; 
    $modal_body = "This Email Id already exists <br>Create a new id or login with new id";
    include ('modal.php');
    exit();
  }
  // Check if email id exist ends



  $stmt = $conn->prepare("INSERT INTO doctor_details (full_name, email, password)
  VALUES (:full_name, :email, :password)");

  $stmt->bindParam(':full_name', $full_name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $password);

  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt->execute();

  echo "New records created successfully";

  $modal_title = "Success ! ! !";
  $modal_body = "Signup Successfull. Thank you for being a part of us";

  include ('set_session.php');
  include_once ('modal.php');

} 

catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>

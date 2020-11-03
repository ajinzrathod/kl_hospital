<?php
try {
  // echo "asd";
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);





  // Check if email id exist
  $stmt = $conn->prepare("SELECT email FROM personal_details WHERE email = :email");
  $stmt->bindParam(':email', $email);
  
  $email = $_POST['email'];

  $stmt->execute();

  $row = $stmt->fetch();

  if ($row) {
    $modal_title = "# Duplicate Found"; 
    $modal_body = "This Email Id already exists";
    $go_to_another_page = 0;
    echo " <script>
    document.getElementById('email_label').innerHTML = 'Email Id already exist';
    document.getElementById('email_label').style.color = 'red';
    </script>";
    // include ('modal.php');
    exit();
  } else {
    echo "asdassda";
  }
  // Check if email id exist ends






  // prepare sql and bind parameters
  $stmt = $conn->prepare("INSERT INTO personal_details (full_name, mobile_no, email, address, dob, gender, marital_status, occupation, insurance_id, referred_by, follow_up_date, doctor_id)
  VALUES (:full_name, :mobile_no, :email, :address, :dob, :gender, :marital_status, :occupation, :insurance_id, :referred_by, :follow_up_date, :doctor_id)");

  $stmt->bindParam(':full_name', $full_name);
  $stmt->bindParam(':mobile_no', $mobile_no);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':address', $address);

  $dob = strftime('%Y-%m-%d', strtotime($dob));
  $stmt->bindParam(':dob', $dob);
  $stmt->bindParam(':gender', $gender);
  $stmt->bindParam(':marital_status', $marital_status);
  $stmt->bindParam(':occupation', $occupation);
  $stmt->bindParam(':insurance_id', $insurance_id);
  $stmt->bindParam(':referred_by', $referred_by);
  
  $follow_up_date = strftime('%Y-%m-%d', strtotime($follow_up_date));
  $stmt->bindParam(':follow_up_date', $follow_up_date);
  $stmt->bindParam(':doctor_id', $_SESSION['doctor_id']);

  $stmt->execute();

  echo "New records created successfully";

  $modal_title = "Patient Added ! ! !";
  $modal_body = "Patient Record Added Successfully";
  $go_to_another_page = 1;
  include_once ('modal.php');

} 

catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>

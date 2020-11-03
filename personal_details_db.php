<?php
try {

  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // prepare sql and bind parameters
  $stmt = $conn->prepare("
    UPDATE `personal_details` SET `full_name`=:full_name,`mobile_no`=:mobile_no,`address`= :address,`occupation`= :occupation,`insurance_id`= :insurance_id,`referred_by`= :referred_by, `gender` = :gender, `marital_status` = :marital_status, `dob` = :dob, `follow_up_date` = :follow_up_date WHERE id = :patient_id;
    ");

  $stmt->bindParam(':full_name', $full_name);
  $stmt->bindParam(':mobile_no', $mobile_no);
  $stmt->bindParam(':address', $address);
  $stmt->bindParam(':occupation', $occupation);
  $stmt->bindParam(':insurance_id', $insurance_id);
  $stmt->bindParam(':referred_by', $referred_by);
  $stmt->bindParam(':patient_id', $patient_id);
  $stmt->bindParam(':gender', $gender);
  $stmt->bindParam(':marital_status', $marital_status);

  $dob = strftime('%Y-%m-%d', strtotime($dob));
  $stmt->bindParam(':dob', $dob);

  $follow_up_date = strftime('%Y-%m-%d', strtotime($follow_up_date));
  $stmt->bindParam(':follow_up_date', $follow_up_date);

  $stmt->execute();

  echo "Record updated successfully";

  $modal_title = "Success ! ! !";
  $modal_body = "Records Updates Successfully";

  include_once ('modal.php');
} 

catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>

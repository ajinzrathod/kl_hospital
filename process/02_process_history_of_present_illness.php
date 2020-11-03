
<?php
include_once ('../connectDb.php');
@session_start();

if(isset($_GET['pageno'])){
	$pageno1=$_GET['pageno'];
}
else{
	$pageno1=1;
}

if(isset($_SESSION['recordsPerPage'])){
	$recordsPerPage = $_SESSION['recordsPerPage'];
}
else{
	$_SESSION['recordsPerPage'] = 10;
	$recordsPerPage = 10;
}

$into10=$pageno1*$recordsPerPage;
$minus9=$into10-$recordsPerPage;

$doctor_id = $_SESSION['doctor_id'];

$page =isset($_GET['p'])? $_GET['p'] : '' ;


if($page == 'view') {
	$query = 
	$result2 = $result = $mysqli->query('

		SELECT * FROM `history_of_present_illness` 
		WHERE 
		`patient_id` 
		IN (
		SELECT `id`
		FROM `personal_details` 
		WHERE `account_active` = 1 AND `doctor_id` = "'.$doctor_id.'"
		)
		ORDER BY `patient_id` DESC
		LIMIT '.$minus9.', '.$recordsPerPage.'
		');

	while ($row = $result->fetch_assoc()) {
		++$count_records;
		if(!$row) {
			echo "No records";
		}
		?>
		<tr>
			<?php echo "<td class = 'td-href'>" . $row['patient_id'] . "</td>"?>
			<td><?php echo $row['date_time']; ?></td>
			<td><?php echo $row['quality']; ?></td>
			<td><?php echo $row['quantity']; ?></td>
			<td><?php echo $row['provocative_factors']; ?></td>
			<td><?php echo $row['associated_symptoms']; ?></td>
			<td><?php echo $row['treatment_given_before']; ?></td>
		</tr>
		<?php
	}		

} else {

	// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
	// Note that is just an example. Should take precautions such as filtering the input data.

	header('Content-Type: application/json');

	$input = filter_input_array(INPUT_POST);

	// Edit
	if ($input['action'] == 'edit') {
		$mysqli->query("
			UPDATE `history_of_present_illness`
			
			SET

			date_time='" . $input['date_time'] . "',
			quality ='" . $input['quality'] . "',
			quantity ='" . $input['quantity'] . "',
			provocative_factors ='" . $input['provocative_factors'] . "',
			associated_symptoms ='" . $input['associated_symptoms'] . "',
			treatment_given_before ='" . $input['treatment_given_before'] . "'
			WHERE patient_id='" . $input['patient_id'] . "'");

	} 

	// Move to trash
	else if ($input['action'] == 'delete') {
		$mysqli->query("UPDATE `personal_details` SET `account_active`=0 WHERE id='" . $input['patient_id'] . "'");
	} 

	// // Restore trash item
	// else if ($input['action'] == 'restore') {
	// 	$mysqli->query("UPDATE users SET deleted=0 WHERE id='" . $input['id'] . "'");
	// }

	mysqli_close($mysqli);

	echo json_encode($input);
}
?>


<script type="text/javascript">
	$("#tabledit .td-href").on("click", function() {
		var patient_id = $(this).text();
		location.href = 'edit_details.php?id=' + patient_id;
	});
</script>
<?php
include_once ('../connectDb.php');

@session_start();

if(isset($_GET['pageno'])) {
	$pageno1=$_GET['pageno'];
}

else {
	$pageno1=1;
}

if(isset($_SESSION['recordsPerPage'])){
	$recordsPerPage = $_SESSION['recordsPerPage'];
}

else {
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

		SELECT * FROM `age_of_milestone_history` 
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
			<td><?php echo $row['smile']; ?></td>
			<td><?php echo $row['sit']; ?></td>
			<td><?php echo $row['crawl']; ?></td>
			<td><?php echo $row['stand']; ?></td>
			<td><?php echo $row['walk']; ?></td>
			<td><?php echo $row['talk']; ?></td>
			<td><?php echo $row['control_of_bladder_and_bowel']; ?></td>
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
			UPDATE `age_of_milestone_history`
			
			SET

			smile='" . $input['smile'] . "',
			sit='" . $input['sit'] . "',
			crawl='" . $input['crawl'] . "',
			stand='" . $input['stand'] . "',
			walk='" . $input['walk'] . "',
			talk='" . $input['talk'] . "',
			control_of_bladder_and_bowel ='" . $input['control_of_bladder_and_bowel'] . "'
			
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
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

		SELECT * FROM `ob_history` 
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
			<td><?php echo $row['delievery_dates']; ?></td>
			<td><?php echo $row['pregnancy_length']; ?></td>
			<td><?php echo $row['del_type']; ?></td>
			<td><?php echo $row['baby_weight']; ?></td>
			<td><?php echo $row['gender']; ?></td>
			<td><?php echo $row['complications_before']; ?></td>
			<td><?php echo $row['during_after_delievery']; ?></td>
			<td><?php echo $row['lmp']; ?></td>
			<td><?php echo $row['regularity_of_normal_cycle']; ?></td>
			<td><?php echo $row['previous_contraception']; ?></td>
			<td><?php echo $row['antenatal_problems']; ?></td>
			<td><?php echo $row['curr_pregnancy']; ?></td>
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
			UPDATE `ob_history`
			
			SET

			delievery_dates='" . $input['delievery_dates'] . "',
			pregnancy_length='" . $input['pregnancy_length'] . "',
			del_type='" . $input['del_type'] . "',
			baby_weight='" . $input['baby_weight'] . "',
			gender='" . $input['gender'] . "',
			complications_before='" . $input['complications_before'] . "',
			during_after_delievery='" . $input['during_after_delievery'] . "',
			lmp='" . $input['lmp'] . "',
			regularity_of_normal_cycle='" . $input['regularity_of_normal_cycle'] . "',
			previous_contraception='" . $input['previous_contraception'] . "',
			antenatal_problems='" . $input['antenatal_problems'] . "',
			curr_pregnancy='" . $input['curr_pregnancy'] . "'
						
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
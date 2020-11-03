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

		SELECT * FROM `pedia_history` 
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
			<td><?php echo $row['hn_status']; ?></td>
			<td><?php echo $row['illness_during_preg']; ?></td>
			<td><?php echo $row['infc_during_preg']; ?></td>
			<td><?php echo $row['drugs_taken']; ?></td>
			<td><?php echo $row['past_obs']; ?></td>
			<td><?php echo $row['gestation_time']; ?></td>
			<td><?php echo $row['rupture_time']; ?></td>
			<td><?php echo $row['labor_time']; ?></td>
			<td><?php echo $row['type_of_delievery']; ?></td>
			<td><?php echo $row['complication']; ?></td>
			<td><?php echo $row['first_cry']; ?></td>
			<td><?php echo $row['basic_problem']; ?></td>
			<td><?php echo $row['birth_weight']; ?></td>
			<td><?php echo $row['birth_injury']; ?></td>
			<td><?php echo $row['other']; ?></td>
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
			UPDATE `pedia_history`
			
			SET

			hn_status='" . $input['hn_status'] . "',
			illness_during_preg='" . $input['illness_during_preg'] . "',
			infc_during_preg='" . $input['infc_during_preg'] . "',
			drugs_taken='" . $input['drugs_taken'] . "',
			past_obs='" . $input['past_obs'] . "',
			gestation_time='" . $input['gestation_time'] . "',
			rupture_time='" . $input['rupture_time'] . "',
			labor_time='" . $input['labor_time'] . "',
			type_of_delievery='" . $input['type_of_delievery'] . "',
			complication='" . $input['complication'] . "',
			first_cry ='" . $input['first_cry'] . "',
			basic_problem ='" . $input['basic_problem'] . "',
			birth_weight ='" . $input['birth_weight'] . "',
			birth_injury ='" . $input['birth_injury'] . "',
			other ='" . $input['other'] . "'
			
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
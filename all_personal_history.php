<?php
include ('checksession.php');
include_once ('first.php');
include_once ('navbar.php');
include_once ('connectDb.php');
?>
<style>
	.td-href:hover{
		text-decoration: underline;
		cursor: pointer;
	}
</style>

<!-- Just for fa icons -->
<link rel="stylesheet" type="text/css" href="css/bootstrap3.4.1.css">

<?php
@session_start();
include ('recordsPerPage_Session.php');
?>

<body onload="viewData()">
	<div class="container-fluid">
		<center>
			<?php
			include ('recordsPerPage_Form.php');
			?>
		</center>
	</div>
	<section class="">
		<!-- AND `doctor_id` = " . $_SESSION['doctor_id']. " -->
		<div class="container-fluid">
			<h2> personal_history </h2>
			<div class="table-responsive">
				<table id="tabledit" class="table table-striped table-hover">
					<thead>
						<tr>
							<th> ID <br> &nbsp; </th>
							<th> disease </th>
							<th> hospitalization </th>
							<th> allergies </th>
							<th> immunization </th>
							<th> implanted_device </th>
							<th> smoking </th>
							<th> drinking </th>
							<th> physical_activity </th>
							<th> diet </th>
							<th> source </th>
							<th> other </th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>

			<?php
			$doctor_id = $_SESSION['doctor_id'];
			$my_pagination_query='
			SELECT * FROM `personal_history`
			WHERE 
			`patient_id` 
			IN (
			SELECT `id`
			FROM `personal_details` 
			WHERE `account_active` = 1 AND `doctor_id` = "'.$doctor_id.'"
			)
			';
			include ('pagination.php');
			?>
		</div>
	</section>

	<?php
	include_once('footer.php');
	include_once('loader_alljs.php');
	?>

	<!-- YouTube Tutorial: https://www.youtube.com/watch?v=oxZj82kh4FA&t=514s -->
	<!-- This is the main js File -->
	<script type="text/javascript" src="js/jquery.tabledit.js"></script>
	<!-- Its downloaded from here -->
	<!-- http://markcell.github.io/jquery-tabledit/#examples -->
	<!-- SHAYAD (bower.json has also to do something with this[see js folder]) -->

	<script type="text/javascript">
		function viewData() {
			$.ajax({
				url: 'process/all_process_personal_history.php?p=view&pageno=<?php echo $pageno1?>',
				method: 'GET'
			}).done(function(data){
				$('tbody').html(data)
				tableData()
			})
		}
		function tableData() {
			console.log("1");
			$('#ftco-loader').addClass('show');
			$('#tabledit').Tabledit({
				// url: 'waiting_using_js.php',
				url: 'process/all_process_personal_history.php',
				eventType: 'dblclick',
				editButton: true,
				// editButton: false,
				deleteButton: true,
				hideIdentifier: false, //id is hidden if set to true
				buttons: {
					edit: {
						class: 'btn btn-sm btn-primary',
						html: '<span class="glyphicon glyphicon-pencil"></span>Edit',
						action: 'edit'
					},
					delete: {
						class: 'btn btn-sm btn-danger',
						html: '<span class="glyphicon glyphicon-trash"></span>Trash',
						action: 'delete'
					},
					save: {
						class: 'btn btn-sm btn-success',
						html: 'Save'
					},
					// restore: {
						// class: 'btn btn-sm btn-warning',
						// html: 'Restore',
						// action: 'restore'
					// },
					confirm: {
						class: 'btn btn-sm btn-danger',
						html: 'Confirm'
					}
				},
				columns: {
					identifier: [0, 'patient_id'],
					editable: [
					[1, 'disease'],
					[2, 'hospitalization'],
					[3, 'allergies'],
					[4, 'immunization'],
					[5, 'implanted_device'],
					[6, 'smoking'],
					[7, 'drinking'],
					[8, 'physical_activity'],
					[9, 'diet'],
					[10, 'source'],
					[11, 'other']
					]
				},
				onSuccess: function(data, textStatus, jqXHR) {
					viewData()
				},
				onFail: function(jqXHR, textStatus, errorThrown) {
					console.log('onFail(jqXHR, textStatus, errorThrown)');
					console.log(jqXHR);
					console.log(textStatus);
					console.log(errorThrown);
				},
				onAjax: function(action, serialize) {
					console.log('onAjax(action, serialize)');
					console.log(action);
					console.log(serialize);
				}
			});
			$('#ftco-loader').removeClass('show');
			console.log("2");
		}
	</script>
</body>
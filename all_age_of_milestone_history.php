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
			<h2> Age of Milestone History </h2>
			<div class="table-responsive">
				<table id="tabledit" class="table table-striped table-hover">
					<thead>
						<tr>
							<th> ID <br> &nbsp; </th>
							<th> Smile </th>
							<th> Sit </th>
							<th> Crawl </th>
							<th> Stand </th>
							<th> Walk </th>
							<th> Talk </th>
							<th> Ctrl of bladder & bowel </th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>

			<?php
			$doctor_id = $_SESSION['doctor_id'];
			$my_pagination_query='
			SELECT * FROM `age_of_milestone_history`
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
				url: 'process/all_process_age_of_milestone_history.php?p=view&pageno=<?php echo $pageno1?>',
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
				url: 'process/all_process_age_of_milestone_history.php',
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
					[1, 'smile'],
					[2, 'sit'],
					[3, 'crawl'],
					[4, 'stand'],
					[5, 'walk'],
					[6, 'talk'],
					[7, 'control_of_bladder_and_bowel']
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
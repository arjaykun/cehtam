<?php 
	$additional_styles = '<link href="../../assets/vendor/datatables/dataTables.bulma.min.css" rel="stylesheet">';
	
	include '../../includes/layouts/header.php';

	include '../../includes/loadclasses.php';

	$employee = new Employee;
	$employees = $employee->get();

	switch ($_SERVER['REQUEST_URI']) {
		case '/dashboard/employees/':
			echo "all";
			break;
		case (preg_match('/^\/dashboard\/employees\/[0-9]+$/', $_SERVER['REQUEST_URI']) ? true: false) :
			echo "specific";
			break;
		default:
			header("Location: /404.html");
			break;
	}
?>

<div class="container is-max-desktop p-2 has-background-white">

	<section class="section pb-1">
		<h1 class="title">Employee Management</h1>
		<h3 class="subtitle">Add, Update & Delete Employee.</h3>
		
		<div class="buttons">		
			<button class="button is-outlines is-info mb-4">Add New</button>
			<button class="button is-outlines is-danger mb-4">Export to PDF</button>
		</div>
	</section>

	<section class="section pt-1">
		<table id="table" class="table is-striped" style="width:100%;">
			<thead>
				<tr>
					<th>Employee ID</th>
					<th>Name</th>
					<th>Position</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($employees as $emp): ?>
					<tr>
						<td><?php echo $emp->emp_id ?></td>
						<td><?php echo $emp->name ?></td>
						<td><?php echo $emp->job_title ?></td>
						<td>
							<a href="/dashboard/employees/<?php echo $emp->id ?>">
								<i class="icon has-text-info-dark fa fa-chevron-circle-right fa-lg"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>


</div>



<?php 

$additional_scripts = '
<script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/vendor/datatables/dataTables.bulma.min.js"></script>
<script>
  // Call the dataTables jQuery plugin
  $(document).ready(function() {
    $("#table").DataTable();
  });

</script>';

include '../../includes/layouts/footer.php' ?>



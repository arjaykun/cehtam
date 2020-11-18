<?php 
	$additional_styles = '<link href="../../assets/vendor/datatables/dataTables.bulma.min.css" rel="stylesheet">';
	
	include '../includes/layouts/header.php';

	include '../includes/loadclasses.php';

	$employee = new Employee;
	$employees = $employee->get();
?>

<div class="container is-max-desktop p-2 has-background-white">

	<section class="section pb-1">
		
		<?php if(isset($_GET['delete']) && $_GET['delete'] == 1 ): ?>
			<article class="message is-primary">
			  <div class="message-body">
			    <strong>Success! </strong> Employee Deleted.
				</div>
			</article>
		<?php endif; ?>

		<h1 class="title">Employee Management</h1>
		<h3 class="subtitle">Add, Update & Delete Employee.</h3>
		
		<div class="buttons">		
			<a class="button is-outlines is-info mb-4"  href="/dashboard/employees/create">Add New</a>
			<a href="/includes/process/generate-employee-pdf.php" target="_blank" class="button is-outlines is-danger mb-4" id="export-btn">Export to PDF</a>
		</div>
	</section>

	<section class="section pt-1">
		<table id="table" class="table is-striped" style="width:100%;">
			<thead>
				<tr>
					<th>Employee ID</th>
					<th>Name</th>
					<th class="is-hidden-mobile">Position</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($employees as $emp): ?>
					<tr>
						<td><?php echo $emp->emp_id ?></td>
						<td><?php echo $emp->name ?></td>
						<td class="is-hidden-mobile"><?php echo $emp->job_title ?></td>
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
$(document).ready(function() {
   $("#table").DataTable({

	   	"columnDefs": [
		    { "orderable": false, "targets": [3] }
		  ]

   });
});

</script>';

include '../includes/layouts/footer.php' ?>



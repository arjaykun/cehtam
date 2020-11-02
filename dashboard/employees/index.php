<?php 
	$additional_styles = '<link href="../../assets/vendor/datatables/dataTables.bulma.min.css" rel="stylesheet">';
	
	include '../../includes/layouts/header.php';
?>

<div class="container is-max-desktop p-2 has-background-white">

	<section class="section pb-1">
		<h1 class="title">Employee Management</h1>
		<h3 class="subtitle">Add, Update & Delete Employee.</h3>
		
		<button class="button is-outlines is-info mb-4">Add New</button>
	</section>

	<section class="section pt-1">
		<table id="table" class="table is-striped" style="width:100%;">
			<thead>
				<tr>
					<th>Employee ID</th>
					<th>Name</th>
					<th>Position</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>20200002</td>
					<td>John Doe</td>
					<td>CEO</td>
				</tr>
				<tr>
					<td>20200003</td>
					<td>Jane Doe</td>
					<td>COO</td>
				</tr>
				<tr>
					<td>20200001</td>
					<td>Mark Zuckerberg</td>
					<td>Web Developer</td>
				</tr>
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



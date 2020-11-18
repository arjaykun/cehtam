<?php 
	$additional_styles = '<link href="../../assets/vendor/datatables/dataTables.bulma.min.css" rel="stylesheet">';
	
	include '../includes/layouts/header.php';

	include '../includes/loadclasses.php';

	$log = new TimeLog;
	$logs = $log->get();

?>

<div class="container is-max-desktop p-2 has-background-white">

	<section class="section pb-1">
		<h1 class="title">Time Logs</h1>
		<h3 class="subtitle">View & Filter Employee Time Logs.</h3>
	</section>

	<section class="section pt-1">
		<table id="table" class="table is-striped" style="width:100%;">
			<thead>
				<tr>
					<th>Employee</th>
					<th>Time-in</th>
					<th>Time-out</th>
					<th>Work/ Day</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($logs as $timeLog): ?>
					<tr>
						<td><a href="/dashboard/logs/<?php echo $timeLog->id ?>"><?php echo $timeLog->name ?></a></td>
						<td><?php echo date("m/d/Y h:i a", strtotime($timeLog->time_in)) ?></td>
						<td><?php echo date("h:i a", strtotime($timeLog->time_out)) ?></td>
						<td><?php echo round($timeLog->time_work/60, 2)?>h</td>
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
		    { "orderable": false, "targets": [3] },
		  ], 
		  "order": [[1, "desc"]],
		  aLengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
   });
});

</script>';

include '../includes/layouts/footer.php' ?>



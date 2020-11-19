<?php 
	$additional_styles = '
	<link href="../../assets/vendor/datatables/dataTables.bulma.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../../assets/vendor/jquery-ui/jquery-ui.min.css">';
	
	include '../includes/layouts/header.php';

	include '../includes/loadclasses.php';

	$log = new TimeLog;
	$export_url = "/includes/process/generate-logs-pdf.php";
	if (isset($_GET['to']) && isset($_GET['from'])) {
		$logs = $log->get($_GET['from'], $_GET['to']);
		$export_url.='?from='.$_GET['from'].'&to='.$_GET['to'];
	} else {
		$logs = $log->get();
	}


?>

<div class="container is-max-desktop p-2 has-background-white">

	<section class="section pb-1">
		<h1 class="title">Time Log</h1>
		<h3 class="subtitle">View & Filter Employee Time Log.</h3>

		<div class="buttons">			
			<button class="button is-outlines is-info mb-4" id="filter">Filter</button>
			<a class="button is-outline is-danger mb-4" href="<?php echo $export_url ?>" target="_blank">Export to PDF</a>
		</div>
	</section>
	
	<section class="section pt-1">
		<table id="table" class="table is-striped" style="width:100%;">
			<thead>
				<tr>
					<th>Employee</th> 
					<th>Time-in</th>
					<th>Time-out</th>
					<th>Hrs. Work</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($logs as $timeLog): ?>
					<?php $time = $log->get_hours_work($timeLog->time_work, $timeLog->time_in, $timeLog->time_out); ?>
					<tr>
						<td><a href="/dashboard/logs/<?php echo $timeLog->id ?>"><?php echo $timeLog->name ?></a></td>
						<td><?php echo date("m/d/Y h:i a", strtotime($timeLog->time_in)) ?></td>
						<td><?php echo date("h:i a", strtotime($timeLog->time_out)) ?></td>
						<td><?php echo $time['regular'] + $time['overtime'] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>


</div>

<?php include_once './views/logs/filter-modal.php' ?>

<?php 

$additional_scripts = '
<script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/vendor/datatables/dataTables.bulma.min.js"></script>
<script src="../../assets/vendor/moment/moment.min.js"></script>
<script src="../../assets/vendor/jquery-ui/jquery-ui.js"></script>

';

include_once '../includes/layouts/footer.php' ?>

<script>

$(document).ready(function() {
   $("#table").DataTable({

	   	"columnDefs": [
		    { "orderable": false, "targets": [3] },
		  ], 
		  "order": [[1, "desc"]],
		  aLengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
   });

   <?php include_once './views/logs/filter-js-scripts.php' ?>
   
		$("#all").click(function() {
		      window.location.href = "/dashboard/logs";
		})
});

</script>


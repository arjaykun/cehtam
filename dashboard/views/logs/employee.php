<?php 
	$additional_styles = '<link href="../../assets/css/loader.css" rel="stylesheet">';
	include '../includes/layouts/header.php';
	include '../includes/loadclasses.php';

	$employee = new Employee;
	$log = new TimeLog;

	//validate if employee id exist
	$emp = $employee->find($id);
	if(!$emp) {
		header('Location: /404.html');
		exit();
	}

	$export_url = "/includes/process/generate-employee-log-pdf.php?emp=".$emp->emp_id;
	if (isset($_GET['to']) && isset($_GET['from'])) {
		$logs = $log->get_by_emp($emp->emp_id, 0, $_GET['from'], $_GET['to']);
		$export_url.='&from='.$_GET['from'].'&to='.$_GET['to'];
	} else {
		$logs = $log->get_by_emp($emp->emp_id);
	}
?>

<div class="container is-max-desktop mt-6">


	<div class="columns">
		<div class="column has-background-info pt-6 pl-5 ">
		  <h1 class="title has-text-white">Employee Time Log</h1>
			<h3 class="subtitle has-text-white">View & Filter this employee time log history.</h3>
		</div>
		<div class="column has-background-white px-5">
			
			<h1 class="title has-text-info">
				<i class="icon fa fa-user-circle-o mr-2">	</i><?php echo ucwords($emp->name) ?>
			</h1>
			<h3 class="subtitle is-size-5">
				<i class="icon fa fa-suitcase mr-2">	</i><?php echo ucwords($emp->job_title) ?>
			</h3>
		

			<div class="buttons py-2">
				<button class="button is-info" id="filter">Filter</button>
				<a class="button is-danger" href="<?php echo $export_url ?>" target="_blank">Export to PDF</a>
			</div>

			<div class="">
				<table id="table" class="table is-striped" style="width:100%;">
					<thead>
						<tr>
							<th>Time-in</th>
							<th>Time-out</th>
							<th>Regular</th>
							<th>OT</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$total_regular = 0;
							$total_ot = 0;
						?>
						<?php foreach($logs as $timeLog): ?>
							<?php 
								$time = $log->get_hours_work($timeLog->time_work, $timeLog->time_in, $timeLog->time_out); 
								$total_regular += $time['regular'];
								$total_ot += $time['overtime']
							?>
							<tr>
								<td><?php echo date("m/d/Y h:i a", strtotime($timeLog->time_in)) ?></td>
								<td><?php echo date("h:i a", strtotime($timeLog->time_out)) ?></td>
								<td><?php echo $time['regular'] ?></td>
								<td><?php echo $time['overtime'] ?></td>
							</tr>
						<?php endforeach; ?>
						<tr>
							<td colspan="2" class="has-text-right has-text-weight-bold">Total Hours:</td>
							<td><?php echo $total_regular ?>h</td>
							<td><?php echo $total_ot ?>h</td>
						</tr>
					</tbody>
			</table>

			</div>
				
	</div>
</div>

<section>
	<div class="loading is-hidden">
		<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
	</div>
</section>

<?php 
include_once './views/logs/filter-modal.php';

$additional_scripts = '
<script src="../../assets/vendor/moment/moment.min.js"></script>
<script src="../../assets/vendor/jquery-ui/jquery-ui.js"></script>

';
?>



<?php include '../includes/layouts/footer.php'; ?>

<script>
	$(document).ready(function() {
		<?php include_once './views/logs/filter-js-scripts.php' ?>
		
		$("#all").click(function() {
		   window.location.href = "/dashboard/logs/<?php echo $emp->id ?>";
		})
	})
</script>



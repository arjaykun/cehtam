<?php 
	$additional_styles = '<link href="../../assets/css/loader.css" rel="stylesheet">';
	include '../includes/layouts/header.php';
	include '../includes/loadclasses.php';

	$employee = new Employee;
	$log = new TimeLog;

	$emp = $employee->find($id);
	if(!$emp) {
		header('Location: /404.html');
		exit();
	}
	$logs = $log->get_by_emp($emp->emp_id);
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
				<button class="button is-small is-info" >
	    		Filter by month (<?php echo Date("M") ?>)
				</button>
				<button class="button is-small is-info">
	    		Filter by year (<?php echo Date("Y") ?>)
				</button>
				<button class="button is-small is-warning">
	    		View All
				</button>
				<button class="button  is-small is-primary" id="delete-btn">
					Custom Filter
				</button>
			</div>

			<div class="">
				<table id="table" class="table is-striped" style="width:100%;">
					<thead>
						<tr>
							<th>Time-in</th>
							<th>Time-out</th>
							<th>Work/ Day</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($logs as $timeLog): ?>
							<tr>
								<td><?php echo date("m/d/Y h:i a", strtotime($timeLog->time_in)) ?></td>
								<td><?php echo date("h:i a", strtotime($timeLog->time_out)) ?></td>
								<td><?php echo round($timeLog->time_work/60, 2)?>h</td>
							</tr>
						<?php endforeach; ?>
						<tr>
							<td colspan="2" class="has-text-right has-text-weight-bold">Total Hours:</td>
							<td><?php echo $log->get_total_work_time($emp->emp_id) ?>h</td>
						</tr>
					</tbody>
			</table>

			</div>
				
	</div>


<section>
	<div class="loading is-hidden">
		<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
	</div>
</section>



<?php include '../includes/layouts/footer.php'; ?>
<script>
	$(document).ready(function() {
		alert("hero")
	})
</script>



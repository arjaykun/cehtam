<?php 
	$additional_styles = '
	<link href="../../assets/vendor/datatables/dataTables.bulma.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../../assets/vendor/jquery-ui/jquery-ui.min.css">';
	
	include '../includes/layouts/header.php';

	include '../includes/loadclasses.php';

	$log = new TimeLog;
	$export_url = "../includes/process/generate-logs-pdf.php";
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
					<tr>
						<td><a href="/dashboard/logs/<?php echo $timeLog->id ?>"><?php echo $timeLog->name ?></a></td>
						<td><?php echo date("m/d/Y h:i a", strtotime($timeLog->time_in)) ?></td>
						<td><?php echo date("h:i a", strtotime($timeLog->time_out)) ?></td>
						<td><?php echo $log->get_hours_work($timeLog->time_work, $timeLog->time_in, $timeLog->time_out) ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>


</div>

<!-- filter modal -->
<div class="modal px-2" id="filter-modal">
  <div class="modal-background"></div>
  <div class="modal-content ">
   	<div class="card">
   		<div class="card-content">
   			<h1 class="title is-3">Filter Time Logs</h1>
   			<div class="is-size-5 has-text-weight-semibold mt-2 mb-2">Quick Filters</div>
				<div class="buttons">				
					<button class="button is-small is-primary" id="today">Today</button>			
					<button class="button is-small is-dark" id="this_week">This Week</button>	
					<button class="button is-small is-dark" id="this_month">This Month</button>	
					<button class="button is-small is-dark" id="this_year">This Year</button>	
					<button class="button is-small is-dark" id="last_7_days">Last 7 Days</button>	
					<button class="button is-small is-dark" id="last_15_days">Last 15 Days</button>	
					<button class="button is-small is-dark" id="last_30_days">Last 30 Days</button>	
					<button class="button is-small is-info" id="all">View All</button>	
				</div>
				<div class="is-size-5 has-text-weight-semibold mb-2">Custom Filter</div>
				<form id="confirm-form">
				
			    <div class="field">
			      <label class="label">From</label>
			      <div class="control">
			        <input class="input datepicker" type="text" name="from" id="from">
			      </div>
			    </div>

			    <div class="field">
			      <label class="label">To</label>
			      <div class="control">
			        <input class="input datepicker" type="text" name="to" id="to">
			      </div>
			    </div>

			
					<button class="button is-info mr-1 is-fullwidth" type="submit">
			     SUBMIT
			    </button>
				</form>
			    
   		</div>
   	</div>			
  </div>
  <button class="modal-close is-large" aria-label="close"></button>
</div>

<?php 

$additional_scripts = '
<script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/vendor/datatables/dataTables.bulma.min.js"></script>
<script src="../../assets/vendor/moment/moment.min.js"></script>
<script src="../../assets/vendor/jquery-ui/jquery-ui.js"></script>

';

include '../includes/layouts/footer.php' ?>

<script>

$(document).ready(function() {
   $("#table").DataTable({

	   	"columnDefs": [
		    { "orderable": false, "targets": [3] },
		  ], 
		  "order": [[1, "desc"]],
		  aLengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
   });

   $("#today").click(function() {
   		$("#to").val(moment().format('YYYY-MM-DD'));
   		$("#from").val(moment().format('YYYY-MM-DD'));
   });

   $("#this_week").click(function() {
   		$("#from").val(moment().startOf("week").format('YYYY-MM-DD'));
   		$("#to").val(moment().endOf("week").format('YYYY-MM-DD'));
   });

   $("#this_month").click(function() {
   		$("#from").val(moment().startOf("month").format('YYYY-MM-DD'));
   		$("#to").val(moment().endOf("month").format('YYYY-MM-DD'));
   });

   $("#this_year").click(function() {
   		$("#from").val(moment().startOf("year").format('YYYY-MM-DD'));
   		$("#to").val(moment().endOf("year").format('YYYY-MM-DD'));
   });

   $("#last_7_days").click(function() {
   		$("#from").val(moment().subtract(7, "d").format('YYYY-MM-DD'));
   		$("#to").val(moment().format('YYYY-MM-DD'));
   });

   $("#last_15_days").click(function() {
   		$("#from").val(moment().subtract(15, "d").format('YYYY-MM-DD'));
   		$("#to").val(moment().format('YYYY-MM-DD'));
   });

   $("#last_30_days").click(function() {
   		$("#from").val(moment().subtract(30, "d").format('YYYY-MM-DD'));
   		$("#to").val(moment().format('YYYY-MM-DD'));
   });

   $("#all").click(function() {
   		window.location.href = "/dashboard/logs";
   })


   $(".datepicker").datepicker({ dateFormat: "yy-mm-dd"});

   $("#filter").click(function() {
   		$("#filter-modal").addClass("is-active")
   })

});

</script>


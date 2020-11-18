<?php 

include '../includes/layouts/header.php'; 

include '../includes/loadclasses.php';

$departmentObj = new Department;
$department = $departmentObj->find($id);

$employee = new Employee;
$employees = $employee->get(['dept_id' => $id]);

?>

<div class="container is-max-desktop mt-6 has-background-white">

	<div class="columns fixed">

		<div class="column is-half has-background-info py-6 pl-5">
			<h1 class="title has-text-white"><?php echo strtoupper($department->dept_id) ?></h1>
			<h3 class="subtitle has-text-white"><?php echo strtoupper($department->dept_name) ?></h3>
		</div>

		<div class="column -is-half py-5">
			<h3 class="is-size-4">Department's Members</h3>
			<table class="table is-striped is-bordered" style="width: 100%">
				<thead>
					<tr>
						<th>Name</th>
						<th>Position</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($employees) > 0): ?>
						<?php foreach($employees as $emp): ?>
						<tr>
							<td><?php echo $emp->name ?></td>
							<td><?php echo $emp->job_title ?></td>
						</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="2" class="has-text-centered">No Member</td>
						</tr>
					<?php endif ?>
					
				</tbody>
			</table>
		</div>

	</div>

</div>


<?php include '../includes/layouts/footer.php' ?>



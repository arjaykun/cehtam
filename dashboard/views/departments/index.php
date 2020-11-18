<?php 

include '../includes/layouts/header.php'; 

include '../includes/loadclasses.php';

$departmentObj = new Department;
$departments = $departmentObj->get();
 
?>

<div class="container is-max-desktop p-1 ">
	<section class="section">
		<div class="columns fixed">
			<div class="column is-half has-background-info py-6 pl-5">
				<h1 class="title has-text-white">Departments</h1>
				<h3 class="subtitle has-text-white">Add, Update & Delete Department.</h3>
			</div>

			<div class="column -is-half py-5 has-background-white">

				<?php if(isset($_GET['update']) && $_GET['update'] == 1 ): ?>
				<article class="message is-primary">
				  <div class="message-body">
				    <strong>Success! </strong> Department Updated.
					</div>
				</article>
				<?php elseif(isset($_GET['delete']) && $_GET['delete'] == 1 ): ?>
				<article class="message is-primary">
				  <div class="message-body">
				    <strong>Success! </strong> Department Deleted.
					</div>
				</article>
				<?php elseif(isset($_GET['delete']) && $_GET['delete'] == 0 ): ?>
				<article class="message is-danger">
				  <div class="message-body">
				    <strong>Oops! </strong> Failed to Delete.
					</div>
				</article>
				<?php elseif(isset($_GET['pwd']) && $_GET['pwd'] == 1 ): ?>
				<article class="message is-danger">
				  <div class="message-body">
				    <strong>Oops! </strong>Wrong Password.
					</div>
				</article>
				<?php endif; ?>
				
				<div class="is-flex is-justify-content-space-between">
					<h3 class="is-size-4 has-text-weight-bold">Department List</h3>
					<a href="/dashboard/departments/create" class="button is-info mb-5">Add New</a>
				</div>

				<table class="table is-striped is-bordered" style="width: 100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Department</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($departments as $dept): ?>
							<tr>
								<td><?php echo $dept->dept_id ?></td>
								<td><a href="/dashboard/departments/<?php echo $dept->dept_id ?>"><?php echo $dept->dept_name ?></a></td>
								<td class="has-text-centered">
									<a href="/dashboard/departments/<?php echo $dept->dept_id ?>/edit">
										<i class="icon has-text-info-dark fa fa-pencil"></i>
									</a>

									<a href="#" class="delete-dept" id="<?php echo $dept->dept_id ?>">
										<i class="icon has-text-grey fa fa-trash"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

			</div>
		</div>
	</section>
</div>

<?php include_once './components/confirmation.php' ?>

<?php 

$additional_scripts = '
<script>
$(document).ready(function() {
	let id = "";

	function delete_department() {
		$.ajax({
			url: "/includes/process/delete-department.php",
			type: "POST",
			data: {id},
			dataType: "text",
			success: function(data) {
				window.location.href = "/dashboard/departments?delete=1";
			},
			error: function(error) {
				window.location.href = "/dashboard/departments?delete=0";
			}
		});
	}


	$(".delete-dept").click( function() {
		id = $(this).attr("id");
		$("#confirm-modal").addClass("is-active")
	})

	$("#confirm-form").submit(function(e) {
		e.preventDefault();

		const password = $("#confirm-password-input").val();

		$.ajax({
			url: "../../includes/process/confirm-password.php",
			type: "POST",
			data: {password},
			dataType: "text",
			success: function(data) {
				if(data == 1)
					delete_department();
				else if(data == 0) {
					window.location.href = "/dashboard/departments/?pwd=1"
				}
			}
		});
		$("#confirm-password-input").val("");
		$("#confirm-modal").removeClass("is-active")
	});

})
</script>
';

include '../includes/layouts/footer.php' ?>



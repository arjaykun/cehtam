<?php 
	include '../includes/layouts/header.php';

	include '../includes/loadclasses.php';

	$employee = new Employee;
	$emp = $employee->find($id);
	$department = new Department;
	$dept_name = $department->find($emp->dept_id)->dept_name;

	if(!$emp) {
		header('Location: /404.html');
		exit();
	}

?>

<div class="container is-max-desktop p-2">

	<?php if(isset($_GET['update']) && $_GET['update'] == 1 ): ?>
		<article class="message is-primary">
		  <div class="message-body">
		    <strong>Success! </strong> Employee Updated.
			</div>
		</article>
	<?php elseif(isset($_GET['delete']) && $_GET['delete'] == 0 ): ?>
		<article class="message is-danger">
		  <div class="message-body">
		  	<strong>Oops! </strong> Wrong password.
			</div>
	</article>
	<?php endif; ?>

	

	<div class="columns">
		<div class="column has-background-info is-hidden-mobile"></div>
		<div class="column has-background-white">
			
			<div class="is-flex is-justify-content-center is-flex-direction-column is-align-items-center">
				<figure class="mx-auto image is-128x128">
				  <img class="is-rounded" src=	"/assets/images/employees/<?php echo $emp->emp_image ?>" alt="<?php echo $emp->name ?>">
				</figure>
				<h1 class="title has-text-info">
					<i class="icon fa fa-user-circle-o mr-2">	</i><?php echo ucwords($emp->name) ?>
				</h1>
				<h3 class="subtitle is-size-5">
					<i class="icon fa fa-suitcase mr-2">	</i><?php echo ucwords($emp->job_title) ?>
				</h3>
			</div>
			

			<div class="buttons is-centered py-5">
				<a class="button is-info" href="/dashboard/employees/<?php echo $emp->id  ?>/edit">
					<span class="icon mr-1">
			      <i class="fa fa-pencil"></i>
			    </span> 
	    		Update
				</a>
				<a class="button is-danger" id="delete-btn">
					<span class="icon mr-1">
			      <i class="fa fa-trash"></i>
			    </span> 
					Delete
				</a>
			</div>

			<div class="content is-medium px-2">
				<h1 class="is-size-3 has-text-grey">Other Information:</h1>
				
				<div>
					<span class="is-size-6 has-text-weight-bold has-text-info">E-mail:</span>
					<?php echo $emp->email ?>
				</div>

				<div>
					<span class="is-size-6 has-text-weight-bold has-text-info">Contact #:</span>
					<?php echo $emp->contact_num ?>
				</div>
				
				<div>
					<span class="is-size-6 has-text-weight-bold has-text-info">Employee ID:</span>
					<?php echo $emp->emp_id ?>
				</div>

				<div>
					<span class="is-size-6 has-text-weight-bold has-text-info">Status: </span>
					<span class="tag is-info"><?php echo ucwords($emp->emp_status) ?></span>	
				</div>
				
				<div>
					<span class="is-size-6 has-text-weight-bold has-text-info">Department:</span>
					<?php echo $dept_name ?> 
				</div>
				
				<hr>
					
			</div>
		</div>
	</div>

	<?php include_once './components/confirmation.php' ?>

</div>


<?php $additional_scripts = ' 
<script>

$(document).ready( function() {
	
	$("#delete-btn").click( function() {
		$("#confirm-modal").addClass("is-active")
		$("#confirm-password-input").focus();
	});


	function delete_employee() {
		$.ajax({
			url: "../../includes/process/delete-employee.php",
			type: "POST",
			data: {id: '.$emp->id.'},
			dataType: "text",
			success: function(data) {
				window.location.href = "/dashboard/employees?delete=1";
			},
			error: function(error) {
				window.location.href = "/dashboard/employees?delete=0";
			}
		});
	}


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
					delete_employee();
				else if(data == 0) {
					window.location.href = "/dashboard/employees/'.$emp->id.'?delete=0"
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



<?php 
	include_once '../includes/layouts/header.php'; 
	include_once '../includes/loadclasses.php'; 

	$deptObject = new Department;
	$employeeObject = new Employee;
	
	$employee = $employeeObject->find($id);
	$edit = true;
	include_once '../includes/process/update-employee.php'; 
?>

<div class="container is-max-desktop">
	<section class="section">
		
		<div class="columns">

			<div class="column is-half has-background-info py-6 pl-5 is-hidden-tablet">
		    <h1 class="title has-text-white">Update  Employee</h1>
				<h3 class="subtitle has-text-white">Edit the employee' personal & employment information.</h3>
		  </div>

		  <div class="column has-background-white p-5">
		  		<?php if($msg != ''): ?>
						<article class="message is-danger">
						  <div class="message-body">
						    <?php echo $msg; ?>
							 </div>
						</article>
					<?php endif; ?>
		    <?php include_once './views/employees/employees-form.php';  ?>
		  </div>

		  <div class="column is-half has-background-info py-6 pl-5 is-hidden-mobile">
		    <h1 class="title has-text-white">Update  Employee</h1>
				<h3 class="subtitle has-text-white">Edit the employee' personal & employment information.</h3>
		  </div>
		  
		</div>


	</section>
</div>
<?php include_once '../includes/layouts/footer.php' ?>
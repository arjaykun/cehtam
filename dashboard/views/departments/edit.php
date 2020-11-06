<?php 
	include_once '../includes/layouts/header.php'; 
	include_once '../includes/loadclasses.php'; 

	$deptObject = new Department;

	$department = $deptObject->find($id);
	$edit = true;
	include_once '../includes/process/update-department.php'; 
?>

<div class="container is-max-desktop p-1">

	<div class="columns mt-5">

		<div class="column is-half has-background-info py-6 pl-5">
			<h1 class="title  has-text-white"><?php echo $edit ? "Update" : "Add New" ?> Department</h1>
			<h3 class="subtitle has-text-white">Enter the department I.D. & name.</h3>	
		</div>

		<div class="column is-half has-background-white py-6 px-5">
			<?php if($msg != ''): ?>
				<article class="message is-danger">
				  <div class="message-body">
				    <?php echo $msg; ?>
				 </div>
				</article>
			<?php endif; ?>
			<?php include_once './views/departments/department-form.php' ?>

		</div>
		
	</div>
		
</div>
<?php include_once '../includes/layouts/footer.php' ?>
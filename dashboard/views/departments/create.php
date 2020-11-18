<?php 
	include_once '../includes/layouts/header.php'; 
	include_once '../includes/loadclasses.php'; 

	$deptObject = new Department;

	include_once '../includes/process/add-department.php'; 
?>

<div class="container is-max-desktop p-1">

	<section class="section">
		<div class="columns mt-5">
			
			<div class="column is-half has-background-info py-6 pl-5">
				<h1 class="title  has-text-white">Add New Department</h1>
				<h3 class="subtitle has-text-white">Enter the department I.D. & name.</h3>	
			</div>

			<div class="column is-half has-background-white py-6 px-5"">
				<?php if($msg != ''): ?>
					<article class="message is-<?php echo $error? 'danger':'primary' ?>">
					  <div class="message-body">
					    <?php echo $msg; ?>
						 </div>
					</article>
				<?php endif; ?>
				<?php include_once './views/departments/department-form.php' ?>

			</div>
		
		</div>
	</section>
		
</div>
<?php include_once '../includes/layouts/footer.php' ?>
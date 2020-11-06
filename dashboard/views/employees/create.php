<?php 
	include_once '../includes/layouts/header.php'; 
	include_once '../includes/loadclasses.php'; 

	$deptObject = new Department;

	include_once '../includes/process/add-employee.php'; 
?>

<div class="container is-max-desktop">
	<section class="section">
		<h1 class="title">Add New Employee</h1>
		<h3 class="subtitle">Enter the employee personal & employment information.</h3>
		<?php if($msg != ''): ?>
			<article class="message is-<?php echo $error? 'danger':'primary' ?>">
			  <div class="message-body">
			    <?php echo $msg; ?>
				 </div>
			</article>
		<?php endif; ?>
		<?php include_once './views/employees/employees-form.php' ?>

	</section>
</div>
<?php include_once '../includes/layouts/footer.php' ?>
<?php 
	include_once '../includes/layouts/header.php'; 
	include_once '../includes/loadclasses.php'; 

	$deptObject = new Department;

	include_once '../includes/process/add-employee.php'; 
?>

<div class="container is-max-desktop">
	<section class="section">
		<div class="columns">

			<div class="column is-half has-background-info py-6 pl-5 is-hidden-tablet">
		    <h1 class="title has-text-white">Add New Employee</h1>
				<h3 class="subtitle has-text-white">Enter the employee personal & employment information.</h3>
		  </div>

		  <div class="column has-background-white p-5">
		  	<?php if($msg != ''): ?>
					<article class="message is-<?php echo $error? 'danger':'primary' ?>">
					  <div class="message-body">
					    <?php echo $msg; ?>
						 </div>
					</article>
				<?php endif; ?>
		    <?php include_once './views/employees/employees-form.php' ?>
		  </div>

		  <div class="column is-half has-background-info py-6 pl-5 is-hidden-mobile">
		    <h1 class="title has-text-white">Add New Employee</h1>
				<h3 class="subtitle has-text-white">Enter the employee personal & employment information.</h3>
		  </div>
		  
		</div>

	</section>
</div>
<?php 

$additional_scripts = '
<script>
	$(document).ready(function() {
		 function readURL(input) {
	    if (input.files && input.files[0]) {
	      var reader = new FileReader();

	      reader.onload = function (e) {
	        $("#image").attr("src", e.target.result);
	      }

	      reader.readAsDataURL(input.files[0]); // convert to base64 string
	    }
	  }

	  $("#emp_image").change(function () {
	    readURL(this);
	  });
	});
</script>
';

include_once '../includes/layouts/footer.php'; ?>
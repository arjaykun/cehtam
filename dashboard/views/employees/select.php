<?php 
	$additional_styles = '<link href="../../assets/css/loader.css" rel="stylesheet">';
	

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

<div class="container is-max-desktop mt-6">

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
		<div class="column has-background-info pt-6 pl-5 ">
		  <h1 class="title has-text-white">Employee Information</h1>
			<h3 class="subtitle has-text-white">Delete/ Edit the employee information.</h3>
		</div>
		<div class="column has-background-white">
			
			<div class="is-flex is-justify-content-center is-flex-direction-column is-align-items-center">
				<figure class="mx-auto image is-256x256 is-clickable relative" id="img_placeholder">
				  <img class="is-rounded" src="/assets/images/employees/<?php echo $emp->emp_image ?>" alt="<?php echo $emp->name ?>" style="height: 256px; width: 256px">
				  <button class="button has-text-info" style="position: absolute; top:5px; right: 5px" id="btn-edit-img">
				  	<span class="icon"><i class="fa fa-pencil fa-lg"></i></span>
				  </button>
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

			<div class="px-2">
				<?php include_once '../includes/process/add-rfid.php' ?>
				<form  method="POST">
					<div class="field">
					  <div class="field-label"></div>
					  <div class="field-body">
					    <div class="field is-expanded">
					      <div class="field has-addons has-addons-right">
					        <p class="control">
					          <a class="button is-static">
					            RFID TAG
					          </a>
					        </p>
					        <p class="control is-expanded">
					          <input class="input <?php echo $error ? 'is-danger' : '' ?>" type="text" value="<?php echo $rfid ?? $emp->rfid_tag  ?>" placeholder="None" name="rfid">
					          <input type="hidden" name="id" value="<?php echo $emp->id ?>">
					        </p>
					        <p class="control">
					        	<button type="submit" class="button is-primary">
								      <i class="icon fa fa-save"></i>
								    </button>        	
					        </p>
					      </div>
					      <?php if(!empty($msg)): ?>
					      	<p class="help is-<?php echo $error ? 'danger' : 'primary' ?>"><?php echo $msg ?></p>
					      <?php endif; ?>
					    </div>
					  </div>
					</div>
			
				</form>
			</div>

			<hr>	

			<div class="px-2">
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

				<a class="button is-dark" href="/dashboard/logs/<?php echo $emp->id ?>">View Time Log Summary</a>
					
			</div>
		</div>
	</div>

	<?php include_once './components/confirmation.php' ?>
	<!-- edit image modal -->
	<div class="modal px-2" id="img-modal">
	  <div class="modal-background"></div>
	  <div class="modal-content ">
	   	<div class="card">
	   		<div class="card-content">
	   			<h1 class="title is-3" id="form-title">Update Image</h1>
	   			<h3 class="subtitle"><?php echo $emp->name ?></h3>
	   			<form enctype="multipart/form-data" id="img-form" method="POST">
	   	
					    <div class="is-flex is-justify-content-center">     
					      <figure class="image" style="height: 156px; width: 156px">
					        <img class="is-rounded" src="/assets/images/employees/<?php echo $emp->emp_image ?>" id="image" style="height: 156px; width: 156px">
					      </figure>
					    </div>

					   	<p class="is-size-7 has-text-centered">
					   		<i>Upload the new image of the employee.</i>
					   	</p>

					    <div class="is-flex is-align-items-center is-justify-content-center">
					    	<div class="field mt-3">
						      <div class="file is-centered">
						        <label class="file-label">
						          <input class="file-input" type="file" name="emp_image" id="emp_image">
						          <span class="file-cta">
						            <span class="file-icon">
						              <i class="fa fa-upload"></i>  
						            </span>
						            <span class="file-label">
						              Upload Image
						            </span>
						          </span>
						        </label>
						      </div>
						    </div>
						    <input type="hidden" name="id" value="<?php echo $emp->id ?>">
						    <input type="hidden" name="name" value="<?php echo $emp->name ?>">
						    <input type="hidden" name="old_image" value="<?php echo $emp->emp_image ?>">
	   						<button class="button is-info ml-2" type="submit">
	   							<i class="fa fa-save mr-2"></i>Save
	   						</button>
					    </div>
					    

	   			</form>
	   		</div>
	   	</div>			
	  </div>
	  <button class="modal-close is-large" aria-label="close"></button>
	</div>
</div>

<section>
	<div class="loading is-hidden">
		<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
	</div>
</section>



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

	$("#img_placeholder").click(function() {
		$("#img-modal").addClass("is-active")
	})

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

	  $("#img-form").submit( function(e) {
	  	e.preventDefault();
	  	if($("#emp_image").val() == ""){
	  		$("#img-modal").removeClass("is-active")
	  	} else {
	  		$(".loading").removeClass("is-hidden");
		  	$.ajax({
					url: "../../includes/process/update-employee-image.php",
					type: "POST",
					data: new FormData(this),
					contentType: false,
					processData: false,
					success: function(data) {
						window.location.href = "/dashboard/employees/'.$emp->id.'?update=1"
					}, 
					error: function(error) {
						window.location.href = "/dashboard/employees/'.$emp->id.'?update=0"
					}, 
					complete: function() {
						$(".loading").addClass("is-hidden");
					}
				});
	  	}
	  
	  })

})

</script>
';

include '../includes/layouts/footer.php' ?>



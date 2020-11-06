<?php 
	$additional_styles = '<link href="../assets/css/loader.css" rel="stylesheet">';

	include_once '../includes/layouts/header.php'; 
	include_once '../includes/loadclasses.php';
	$auth = new Auth;
	$user = $auth->user();
?>

<div class="container is-max-desktop p-2">

	<?php 
		$dashboard_menu = 'profile';
		include_once './components/dashboard-nav.php';
	?>

	<section class="section has-background-white">
		<div class="container">
			<h1 class="title">Account Profile </h1>
			<h3 class="subtitle">View & edit your account information.</h3>

			<div class="is-flex">			
				<div class="is-text-4 pb-2 is-clickable has-text-info mr-2" id="edit">
					<span class="icon">
	      		<i class="fa fa-edit"></i>
	    		</span>
					Edit Account Profile 
	    	</div>

	    	<div class="is-text-4 pb-2 is-clickable has-text-primary" id="change-pass">
					<span class="icon">
	      		<i class="fa fa-edit"></i>
	    		</span>
					Change Password
	    	</div>
			</div>

			<article class="message is-danger is-hidden" id="error-msg">
			  <div class="message-body">
			  </div>
			</article>

			<form method="POST" id="account-form">

				<div class="field">
				  <label class="label">Name</label>
				  <div class="control">
				    <input class="input" type="text" name="name" id="name" disabled value="<?php echo $user->name ?>">
				  </div>
				</div>


				<div class="field">
				  <label class="label">Email</label>
				  <div class="control">
				    <input class="input" type="text" name="email" id="email" value="<?php echo $user->email ?>" disabled >
				  </div>
				</div>


				<div class="field">
				  <label class="label">Username</label>
				  <div class="control">
				    <input class="input" type="text" name="username" id="username" disabled value="<?php echo $user->username ?>">
				  </div>
				</div>


				<div class="field" id="password-div">
				  <label class="label">Password</label>
				  <div class="control has-icons-right">
				    <input class="input" type="password" name="password" id="password" value="<?php echo $user->password ?>" disabled>
				    <span class="icon is-small is-right">
				      <i class="fa fa-lock"></i>
				    </span>
				  </div>
				</div>

				<input type="hidden" name="old_username" value="<?php echo $user->username ?>">
				<input type="hidden" name="old_email" value="<?php echo $user->email ?>">

				<button class="button is-info" disabled id="submit">
					<span class="icon mr-2"><i class="fa fa-save"></i></span> Save Changes
				</button>
			</form>


		</div>
	</section>

</div>

<?php 
	include_once './components/confirmation.php'; 
?>

<section>
	<div class="loading is-hidden">
		<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
	</div>
</section>

<?php $additional_scripts = ' 
<script>
	$(document).ready(function() {
		$("#edit").click( function() {
			$("#name").removeAttr("disabled");
			$("#name").focus();
			$("#email").removeAttr("disabled");
			$("#username").removeAttr("disabled");
			$("#submit").removeAttr("disabled");
		});

		$("#submit").click(function(e) {
			e.preventDefault();

			$("#confirm-modal").addClass("is-active")
			$("#confirm-password-input").focus();
		});

		$("#confirm-form").submit(function(e) {
			e.preventDefault();
			
			const password = $("#confirm-password-input").val();

			$(".loading").removeClass("is-hidden");
			$.ajax({
				url: "../includes/process/confirm-password.php",
				type: "POST",
				data: {password},
				dataType: "text",
				success: function(data) {
					if(data == 1)
						update_account();
					else if(data == 0) {
						$("#error-msg").removeClass("is-hidden");
						$("#error-msg").children(".message-body").html("<strong>Oops! </strong> Wrong password.")
					}
				}
			});
			$("#confirm-password-input").val("");
			$(".loading").addClass("is-hidden");
			$("#confirm-modal").removeClass("is-active")
		});

		function update_account() {
			$.ajax({
				url: "../includes/process/update-account.php",
				type: "POST",
				data: $("#account-form").serialize(),  
				dataType: "json",
				success: function(data) {
					window.location.href="/logout.php?update=1";
				}, 
				error: function(error) {
					let errors = [];
					if (error.responseText)
					 errors = JSON.parse(error.responseText);
					$("#error-msg").removeClass("is-hidden");

					$("#error-msg").children( ".message-body").html("<strong>Oops! </strong>" + errors[0][Object.keys(errors[0])[0]] );
				}
			});
		}
	});
</script>
';

include '../includes/layouts/footer.php' ?>


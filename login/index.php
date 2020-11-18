<?php 
	session_start();

	if(isset($_SESSION['auth'])){
		header('Location: /dashboard');
		exit();
	}

	include_once '../includes/process/login.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Handsfree Tracing and Monitoring - Login</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/css/bulma/css/bulma.min.css">
	<link rel="stylesheet"  href="../assets/css/style.css">

</head>
<body>

<section class="hero is-white is-fullheight">

  <div class="hero-body">
    <div class="container has-text-centered">
    	<!-- messages here -->
    	<?php if(isset($_GET['u']) && $_GET['u'] == 1): ?>
    	<article class="message is-primary">
			  <div class="message-body">
			    We have updated your account profile. Please login again to see the changes.
			  </div>
			</article>
			<?php elseif(isset($_GET['s']) && $_GET['s'] == 1): ?>
			<article class="message is-primary">
			  <div class="message-body">
			    You've logged out successfully. Login again to start your session. 
			  </div>
			</article>
			<?php elseif(isset($_GET['p']) && $_GET['p'] == 1): ?>
			<article class="message is-primary">
			  <div class="message-body">
			    Your password has been updated. Login again to start your session. 
			  </div>
			</article>
			<?php endif; ?>

			<!-- login form here -->
      <div class="column is-4 is-offset-4">
        <h1 class="is-size-1">
        	<div class="is-flex is-justify-content-center is-align-items-center py-2">					
						<figure class="image ">
						  <img class="is-rounded" src="/assets/images/bg/scan.jpg" style="height: 80px; width: 120px">
						</figure>
						<h1 class="is-size-3 has-text-weight-bold">CEHTAM</h1>
					</div>
        </h1>
        <div class="box">
        	<form method="POST">

        		<h3 class="title has-text-black">Login</h3>
        		<p class="subtitle has-text-black is-size-6">Please enter your credentials to proceed.</p>


        		<?php if($error): ?>
							<p class="is-text-5 has-text-danger pb-2">
								<i class="icon fa fa-warning"></i> Invalid Credentials. 
							</p>
						<?php endif; ?>

        		<div class="field">
						  <p class="control has-icons-left">
						    <input class="input" type="text" placeholder="Username / Email" name="user" value="<?php echo $user ?>">
						    <span class="icon is-small is-left">
						      <i class="fa fa-user-o"></i>
						    </span>    
						  </p>
						</div>

					  <div class="field has-addons has-addons-right">
					  	<p class="control has-icons-left is-expanded">
					  	 <input class="input" type="password" placeholder="Password" name="password" id="password">
						   
					   	 <span class="icon is-small is-left">
						      <i class="fa fa-lock"></i>
						    </span>
					  	</p>
				   		
					    <p class="control">						    	
					     	<span class="button" id="show"> <i class="fa fa-eye"></i></span>
					    </p>
					    
					  </div>

						<div class="field">
						  <p class="control">
						    <input class="button is-info is-fullwidth" value="Login" type="submit" name="submit">
 						  </p>
						</div>

          </form>
        </div>
        <p class="has-text-info">
          Company Employee Handsfree Tracing and Monitoring using RFID v.1.1 <br>
          &copy; 2020
        </p>
      </div>
    </div>
  </div>
</section>


<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script>

$(document).ready( function() {

	$("#show").click( function() {
		let icon = $(this).children(0);
		if(icon.attr("class").includes("fa-eye-slash")) {
			$('#password').attr("type", "password");
			icon.removeClass("fa-eye-slash");
			icon.addClass("fa-eye");
		} else {
			$('#password').attr("type", "text");
			icon.removeClass("fa-eye");
			icon.addClass("fa-eye-slash");
		}
		
	})

})

</script>

</body>
</html>
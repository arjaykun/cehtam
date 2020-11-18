<?php 
	session_start();

	if (!isset($_SESSION['auth'])) {
		header("Location: /login");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CEHTAM - Dashboard</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../../assets/css/bulma/css/bulma.min.css">
	<link rel="stylesheet"  href="../../../assets/css/style.css">

	<?php echo ($additional_styles ?? '') ?>

</head>
<body>

<!-- START NAV -->
<nav class="navbar is-white">
	<div class="container">

		<div class="navbar-brand">

			<a class="navbar-item brand-text has-text-weight-bold" href="../index.html">
				<figure class="image ">
				  <img class="is-rounded" src="/assets/images/bg/scan.jpg" style="height: 30px; width: 40px">
				</figure>
				CEHTAM
			</a>

			<div class="navbar-burger burger">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>

		<div id="navMenu" class="navbar-menu navbar">

			<div class="navbar-end">
				<a class="navbar-item" href="/dashboard">
					Dashboard
				</a>
				<a class="navbar-item" href="/dashboard/employees">
					Employees
				</a>
				<a class="navbar-item" href="/dashboard/departments">
					Departments
				</a>
				<a class="navbar-item" href="/dashboard/logs">
					Time Logs
				</a>

				<div class="navbar-item has-dropdown is-hoverable">
				  <a class="navbar-link is-arrowless has-text-info">
				   	<i class="icon fa fa-user-circle-o fa-lg mr-1"></i> 
				   	<?php echo $_SESSION['auth']->name; ?>
				  </a>
				  <div class="navbar-dropdown">
				    <a class="navbar-item" href="/dashboard/profile">
				     	Profile
				    </a>
				    <a class="navbar-item" href="/logout.php">
				      Logout <i class="icon fa fa-sign-out ml-1 fa-lg"></i>
				    </a>
				  </div>
				</div>

			</div>

		</div>

	</div>
</nav>
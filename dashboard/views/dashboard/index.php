<?php 
	include_once '../includes/layouts/header.php';
	include_once '../includes/loadclasses.php' ;

	$auth = new Auth;
?>
<div class="container is-max-desktop p-2">

	<?php 
		$dashboard_menu = 'dashboard';
		include_once './components/dashboard-nav.php';
	?>

	<section class="hero is-info welcome is-small">
		<div class="hero-body">
			<div class="container">
				<h1 class="title">
				  Hello, <?php echo ucwords($auth->user()->name) . " (<small class='has-text-light'>".$auth->user()->username."</small>)" ?>.
				</h1>
				<h2 class="subtitle">
				  I hope you are having a great day!
				</h2>
			</div>
		</div>
	</section>

	<section class="info-tiles">
		<div class="tile is-ancestor has-text-centered">

			<div class="tile is-parent">
				<article class="tile is-child box">
				  <p class="title">69</p>
				  <p class="subtitle">Employees</p>
				</article>
			</div>

			<div class="tile is-parent">
				<article class="tile is-child box">
				  <p class="title">10</p>
				  <p class="subtitle">Departments</p>
				</article>
			</div>

			<div class="tile is-parent">
				<article class="tile is-child box">
				  <p class="title">10,123</p>
				  <p class="subtitle">Time Logs</p>
				</article>
			</div>

		</div>
	</section>

</div>

<?php include '../includes/layouts/footer.php' ?>

<?php 
	$additional_styles = '
		<link href="../../assets/vendor/datatables/dataTables.bulma.min.css" rel="stylesheet">
		<link href="../../assets/css/loader.css" rel="stylesheet">';
	
	include_once '../includes/layouts/header.php';
	include_once '../includes/loadclasses.php';

	$account = new Account;

?>

<div class="container is-max-desktop p-2">
	
	<?php 
		$dashboard_menu = 'accounts';
		include_once './components/dashboard-nav.php';
	?>

	<section class="section has-background-white">

		<?php if(isset($_GET['add']) && $_GET['add'] == 1): ?>			
			<article class="message is-primary">
			  <div class="message-body">
			    <strong>Success! </strong> New account created.
			  </div>
			</article>
		<?php elseif(isset($_GET['update']) && $_GET['update'] == 1): ?>
			<article class="message is-primary">
			  <div class="message-body">
			    <strong>Success! </strong> Account Updated.
			  </div>
			</article>
		<?php elseif(isset($_GET['delete']) && $_GET['delete'] == 1): ?>
			<article class="message is-primary">
			  <div class="message-body">
			    <strong>Success! </strong> Account deleted.
			  </div>
			</article>
		<?php elseif(isset($_GET['delete']) && $_GET['delete'] == 0): ?>
			<article class="message is-danger">
			  <div class="message-body">
			    <strong>Oops! </strong> Failed to delete account, Pleast try again.
			  </div>
			</article>
		<?php endif; ?>

		<div class="pb-3">
			<h1 class="title">Account List</h1>
			<h3 class="subtitle">Add, Update & Delete Account</h3>
		</div>

		<button class="button is-info mt-2 mb-3" id="add-btn">Add Account</button>

		<div class="table-container-mobile">
			<table id="table" class="table is-striped is-fullwidth is-hoverable">
				<thead>
					<tr>
						<th class="is-hidden-mobile"Username</th>
						<th>Name</th>
						<th class="is-hidden-mobile">E-mail</th>
						<th class="is-hidden-mobile">Account Type</th>
						<th ></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($account->get() as $index =>$data): ?>
						<?php include './views/accounts/account-row.php' ?>
					<?php endforeach; ?>		
				</tbody>
			</table>
		</div>
	</section>

</div>

<div class="modal px-2" id="form-modal">
  <div class="modal-background"></div>
  <div class="modal-content ">
   	<div class="card">
   		<div class="card-content">
   			<h1 class="title is-3" id="form-title">New Account</h1>
   			<form id="account-form">

   				<?php include_once './views/accounts/accounts-form.php' ?>

					<input class="button is-info is-fullwidth mt-2" type="submit" name="submit" value="Add Account" id="submit">

   			</form>
   		</div>
   	</div>			
  </div>
  <button class="modal-close is-large" aria-label="close"></button>
</div>


<!-- delete modal -->
<div class="modal px-2" id="delete-modal">
  <div class="modal-background"></div>
  <div class="modal-content ">
   	<div class="card">
   		<div class="card-content">
   			<h1 class="title is-5">Delete Confirmation</h1>
   			<h3 class="subtitle">
   				Are you sure you want to delete this account?
   			</h3>
				<div class="buttons"> 
					<form id="confirm-form">
						<input type="hidden" id="confirm-id" name="id">
						<button class="button is-danger mr-1" type="submit">
				      Delete
				    </button>
					</form>
			    
			    <button class="button" id="cancel">
			      Cancel
			    </button>
				</div>
   		</div>
   	</div>			
  </div>
  <button class="modal-close is-large" aria-label="close"></button>
</div>

<section>
	<div class="loading is-hidden">
		<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
	</div>
</section>


<?php $additional_scripts = ' 
<script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/vendor/datatables/dataTables.bulma.min.js"></script>
<script src="../../assets/js/accounts.js"></script>
';

include '../includes/layouts/footer.php' ?>

<div class="tabs">
  <ul>
    <li class="<?php echo $dashboard_menu == 'dashboard' ?  'is-active' : '' ?>">
    	<a href="/dashboard"><i class="fa fa-dashboard fw mr-1"></i>Dashboard</a>
		</li>

		<?php if ($_SESSION['auth']->is_admin): ?>
			<li class="<?php echo $dashboard_menu == 'accounts' ?  'is-active' : '' ?>">
				<a href="/dashboard/accounts"><i class="fa fa-users fw mr-1"></i>Accounts</a>
			</li>
		<?php endif ?>
	
		<li class="<?php echo $dashboard_menu == 'profile' ?  'is-active' : '' ?>">
			<a href="/dashboard/profile"><i class="fa fa-user-circle fw mr-1"></i>Profile</a>
		</li>
  </ul>
</div>
<form method="POST">
	<h4 class="is-size-4 has-text-info has-font-weight-bold pb-2">Department Information</h4>
	
	<div class="field">
		<label class="label">Department I.D.</label>
		<div class="control">
		  <input class="input <?php echo $v->error('dept_id')? 'is-danger' : '' ?>" type="text" placeholder="e.g. DPT1" name="dept_id" value="<?php echo $department->dept_id ?? $dept_id ?>">
		</div>
		 <?php if($v->error('dept_id')): ?>
		  <p class="help is-danger"><?php echo $v->error('dept_id') ?></p>
		 <?php endif; ?>
	</div>

	<?php if(isset($edit) && $edit): ?>
		<input type="hidden" name="old_dept_id" value="<?php echo $department->dept_id ?>">
	<?php endif; ?>

	<div class="field">
		<label class="label">Department Name</label>
		<div class="control">
		  <input class="input <?php echo $v->error('dept_name')? 'is-danger' : '' ?>" type="text" placeholder="e.g. Marketing, Accounting " name="dept_name" value="<?php echo $department->dept_name ?? $dept_name ?>">
		</div>
		 <?php if($v->error('dept_name')): ?>
		  <p class="help is-danger"><?php echo $v->error('dept_name') ?></p>
		 <?php endif; ?>
	</div>

	 <input type="submit" value="<?php echo (isset($edit) && $edit==1 ? 'Update Department' : 'Add Department')?>" name="submit" class="button is-dark is-fullwidth">

</form>
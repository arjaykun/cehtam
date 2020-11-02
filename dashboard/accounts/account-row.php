<tr>
	<td class="is-hidden-mobile">
		<?php echo $data->username ?>
	</td>
	<td><?php echo $data->name ?></td>
	<td class="is-hidden-mobile"><?php echo $data->email ?></td>
	<td class="is-hidden-mobile"><?php echo $data->is_admin ? 
			'<span class="tag is-primary">admin</span>' : '<span class="tag is-info">user</span>' ?>
		
	</td>
	<td>
		<?php if(!$data->is_admin ): ?>
			
			<span id="<?php echo $data->username ?>" class="edit icon has-text-info is-clickable">
				<i class="fa fa-pencil-square fa-lg"></i>	
			</span>
				
			<span id="<?php echo $data->username ?>" class="pwd icon has-text-primary is-clickable">
				<i class="fa fa-eye fa-lg"></i>	
			</span>

			<span id="<?php echo $data->username ?>" class="del icon has-text-danger is-clickable">
				<i class="fa fa-trash fa-lg"></i>	
			</span>
			
		<?php else: ?>
			<i class="fa fa-lock fa-lg"></i>
		<?php endif; ?>
	</td>
</tr>
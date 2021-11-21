<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center"><?php echo e(trans('lang.full_name')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.email')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.mobile')); ?></th>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change_status_users')): ?>
						<th class="text-center"><?php echo e(trans('lang.status')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_users')): ?>
						<th class="text-center"><?php echo e(trans('lang.edit')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change_password_user')): ?>
						<th class="text-center"><?php echo e(trans('lang.change_password')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_users')): ?>
						<th class="text-center"><?php echo e(trans('lang.permission')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_users')): ?>
						<th class="text-center"><?php echo e(trans('lang.delete')); ?></th>
						<?php endif; ?>
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				<?php 
					$i =1;
				?>
				<?php if(count($data['users']) > 0): ?>
					<?php $__currentLoopData = $data['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php 
						if($users->status==1)
								{
								$class='btn btn-success m-btn m-btn--icon m-btn--pill';
								$color='green'; 
								$icon='check';
								$text = trans("lang.on");
							}else{
								$class='btn btn-danger m-btn m-btn--icon m-btn--pill';
								$color='red';
								$icon='check';
								$text = trans("lang.off");
							}
					?>
					<tr class="m-datatable__row">
						<td class="text-center">
							<?php echo e($i++); ?>

						</td>
						<td class="text-center">
							<?php echo e($users->fullname); ?>

						</td>
						<td class="text-center">
							<?php echo e($users->email); ?>

						</td>
						<td class="text-center">
							<?php echo e($users->mobile); ?>

						</td>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change_status_users')): ?>
						<td class="text-center">
							<a  color="<?php echo e($color); ?>" data-id="<?php echo e($users->id); ?>" class="<?php echo e($class); ?> UpdateStats "  href="javaScript:;">  <span><?php echo e($text); ?></span> </a>
						</td>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_users')): ?>
						<td class="text-center">
							<a href="#" data-id="<?php echo e($users->id); ?>" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change_password_user')): ?>
						<td class="text-center">
							<a href="#"  data-id="<?php echo e($users->id); ?>" style="background:#1F4282 !important;border-color:#1F4282 !important;box-shadow:0px 5px 10px 2px rgba(31, 66, 130, 0.3) !important" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							password-modal"> <i class="fa fa-lock"></i> </a>
						</td>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_users')): ?>
						<td class="text-center">
							<a href="#" data-id="<?php echo e($users->id); ?>" style="background:#F88732 !important;border-color:#F88732 !important;box-shadow:0px 5px 10px 2px rgba(248, 115, 50, 0.25) !important"  class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							permission"> <i class="fas fa-user"></i></a>
						</td>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_users')): ?>
						<td class="text-center"><a href="#" data-id="<?php echo e($users->id); ?>" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							delete"> <i class="fa fa-trash"></i> </a>
						</td>
						<?php endif; ?>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
				<tr class="m-datatable__row text-center"><td colspan="9"><?php echo e(trans('lang.no_data')); ?></td></tr>
				<?php endif; ?>
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div style="text-align: center;">
			<?php echo $data['users']->render(); ?>

	</div>
</div><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/users/table-data.blade.php ENDPATH**/ ?>
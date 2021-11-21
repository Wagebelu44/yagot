<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center"><?php echo e(__('lang.image')); ?></th>
						<th class="text-center"><?php echo e(__('lang.url')); ?></th>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_status_social')): ?>
						<th class="text-center"><?php echo e(__('lang.status')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_social')): ?>
						<th class="text-center"><?php echo e(__('lang.edit')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_social')): ?>
						<th class="text-center"><?php echo e(__('lang.delete')); ?></th>
						<?php endif; ?>
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				<?php 
					$i =1;
				?>
				<?php if(count($data['social']) > 0): ?>
					<?php $__currentLoopData = $data['social']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php 
						if($slider->status == 1 )
								{
								$class='btn btn-success m-btn m-btn--icon m-btn--pill';
								$color='green'; 
								$icon='check';
								$text = __('lang.active');
							}else{
								$class='btn btn-danger m-btn m-btn--icon m-btn--pill';
								$color='red';
								$icon='check';
								$text = __('lang.inactive');
							}
					?>
					<tr class="m-datatable__row">
						<td class="text-center">
							<?php echo e($i++); ?>

						</td>
						<td class="text-center">
							<img src="/uploads/<?php echo e($slider->file); ?>" style="width:35px" alt="">
						</td>
						<td class="text-center">
							<?php echo e($slider->url); ?>

						</td>
						
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_status_social')): ?>
						<td class="text-center">
						<a  color="<?php echo e($color); ?>" data-id="<?php echo e($slider->id); ?>" class="<?php echo e($class); ?> UpdateStats "  href="javaScript:;">  <span><?php echo e($text); ?></span> </a>
						</td>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_social')): ?>
						<td class="text-center">
						<a href="#" data-id="<?php echo e($slider->id); ?>" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                     	updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_social')): ?>
						<td class="text-center">
							<a href="#" data-id="<?php echo e($slider->id); ?>" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air	delete"> <i class="fa fa-trash"></i> </a>
						</td>
						<?php endif; ?>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
				<tr class="m-datatable__row text-center"><td colspan="8"><?php echo e(__('lang.no_data_found')); ?> </td></tr>
				<?php endif; ?>
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div style="text-align: center;">
			<?php echo $data['social']->render(); ?>

	</div>
</div><?php /**PATH /Users/fadymondy/Sites/yagot/resources/views/admin/social/table-data.blade.php ENDPATH**/ ?>
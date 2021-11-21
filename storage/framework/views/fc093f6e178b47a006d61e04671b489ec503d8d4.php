<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center"><?php echo e(trans('lang.name')); ?></th>

						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('status_categorys')): ?>
						<th class="text-center"><?php echo e(trans('lang.status')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_categorys')): ?>
						<th class="text-center"><?php echo e(trans('lang.edit')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_categorys')): ?>
				
						<th class="text-center"><?php echo e(trans('lang.delete')); ?></th>
						<?php endif; ?>
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				<?php 
					$i =1;
				?>
				<?php if(count($data['category']) > 0): ?>
					<?php $__currentLoopData = $data['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php 
					if($slider->status==1)
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
							<?php echo e($slider->name); ?>

						</td>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('status_categorys')): ?>
						<td class="text-center">
						<a  color="<?php echo e($color); ?>" data-id="<?php echo e($slider->id); ?>" class="<?php echo e($class); ?> UpdateStats "  href="javaScript:;">  <span><?php echo e($text); ?></span> </a>
						</td>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_categorys')): ?>
						<td class="text-center">
						<a href="#" data-id="<?php echo e($slider->id); ?>" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                     	updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_categorys')): ?>
						<td class="text-center">
							<a href="#" data-id="<?php echo e($slider->id); ?>" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air	delete"> <i class="fa fa-trash"></i> </a>
						</td>
						<?php endif; ?>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
				<tr class="m-datatable__row text-center"><td colspan="8"><?php echo e(trans('lang.no_data')); ?></td></tr>
				<?php endif; ?>
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div class="table_page" style="text-align: center;">
			<?php echo $data['category']->render(); ?>

	</div>
</div><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/category/table-data.blade.php ENDPATH**/ ?>
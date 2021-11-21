<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center"><?php echo e(trans('lang.title')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.images')); ?></th>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_slider')): ?>
						<th class="text-center"><?php echo e(trans('lang.edit')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_slider')): ?>
						<th class="text-center"><?php echo e(trans('lang.delete')); ?></th>
						<?php endif; ?>
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				<?php 
					$i =1;
				?>
				<?php if(count($data['slider']) > 0): ?>
					<?php $__currentLoopData = $data['slider']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php 
							if($slider->status==1){
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
							<?php echo e($slider->title); ?>

						</td>
					
						<td class="text-center">
						<a href="#" data-id="<?php echo e($slider->id); ?>" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                     	AllImages"> <i class="fa fa-images"></i> </a>
						</td>
						
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_slider')): ?>
						<td class="text-center">
						<a href="#" data-id="<?php echo e($slider->id); ?>" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
						updateDetailsParent"> <i class="fa fa-edit"></i> </a>
						</td>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_slider')): ?>
						<td class="text-center">
							<a href="#" data-id="<?php echo e($slider->id); ?>"  class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air	deleteParent"> <i class="fa fa-trash"></i> </a>
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
	<div style="text-align: center;">
			<?php echo $data['slider']->render(); ?>

	</div>
</div><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/slider/table-data.blade.php ENDPATH**/ ?>
<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center"><?php echo e(trans('lang.name_bank')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.account_no')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.IBAN')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.tax_number')); ?></th>
						
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('status_banks')): ?>
						<th class="text-center"><?php echo e(trans('lang.status')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_banks')): ?>
						<th class="text-center"><?php echo e(trans('lang.edit')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_banks')): ?>
						
						<th class="text-center"><?php echo e(trans('lang.delete')); ?></th>
						<?php endif; ?>
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				<?php 
					$i =1;
				?>
				<?php if(count($data['banks']) > 0): ?>
					<?php $__currentLoopData = $data['banks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php 
							if($b->status==1){
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
							<?php echo e($b->name); ?>

						</td>
						<td class="text-center">
							<?php echo e($b->account_no); ?>

						</td>
						<td class="text-center">
							<?php echo e($b->iban); ?>

						</td>
						<td class="text-center">
							<?php echo e($b->tax_number); ?>

						</td>

						 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('status_banks')): ?>
						<td class="text-center">
						<a  color="<?php echo e($color); ?>" data-id="<?php echo e($b->id); ?>" class="<?php echo e($class); ?> UpdateStats "  href="javaScript:;">  <span><?php echo e($text); ?></span> </a>
						</td>
						 <?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_banks')): ?> 

						<td class="text-center">
						<a href="#" data-id="<?php echo e($b->id); ?>" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                     	updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>

						<?php endif; ?>

				
						
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_banks')): ?>
						<td class="text-center">
							<a href="#" data-id="<?php echo e($b->id); ?>" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air	delete"> <i class="fa fa-trash"></i> </a>
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
			<?php echo $data['banks']->render(); ?>

	</div>
</div><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/banks/table-data.blade.php ENDPATH**/ ?>
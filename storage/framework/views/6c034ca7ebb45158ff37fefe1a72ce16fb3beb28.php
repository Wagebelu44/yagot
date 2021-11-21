<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center"><?php echo e(trans('lang.client_name')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.transfer_name')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.mobile')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.payment_type')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.currency')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.send_date')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.transaction_id')); ?></th>
						
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change_status_banks_transfer')): ?>
						<th class="text-center"><?php echo e(trans('lang.status')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('details_banks_transfer')): ?>
						<th class="text-center"><?php echo e(trans('lang.details')); ?></th>
						<?php endif; ?>
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				<?php 
					$i =1;
				?>
				<?php if(count($data['transfer']) > 0): ?>
					<?php $__currentLoopData = $data['transfer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php 
					 
				 if($transfer->status == -1 )
							{
                                $class='btn btn-success btn-sm m-btn text-white m-btn--icon m-btn--pill';
                            }else  if($transfer->status == 1 ){
                                $class='btn btn-warning btn-sm text-white m-btn m-btn--icon m-btn--pill';
							}
							else  {
                                $class='btn btn-danger btn-sm text-white m-btn m-btn--icon m-btn--pill';
                            }
							$text = $transfer->status_sys;

					?>

					<tr class="m-datatable__row">
						<td class="text-center">
							<?php echo e($i++); ?>

						</td>
						<td class="text-center">
							<?php echo e($transfer->client_name); ?>

						</td>
						<td class="text-center">
							<?php echo e($transfer->name_tranfer); ?>

						</td>
						<td class="text-center">
							<?php echo e($transfer->mobile); ?>

						</td>
						<td class="text-center">
							<?php echo e($transfer->fees_type); ?>

						</td>
						<td class="text-center">
							<?php echo e($transfer->currency_name); ?>

						</td>
						<td class="text-center">
							<?php echo e($transfer->date); ?>

						</td>
						<td class="text-center">
							<?php echo e($transfer->transaction_id ?? '-'); ?>

						</td>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change_status_banks_transfer')): ?>

						<td class="text-center">
							<?php if($transfer->status != -1): ?>

							<a class="<?php echo e($class); ?>" ><span><?php echo e($text); ?></span> </a>
							
							<?php else: ?>

							<a href="#" data-id="<?php echo e($transfer->id); ?>" class="btn btn-warning text-white m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							yes"> <i class="fa fa-check"></i> </a>

							<a href="#" data-id="<?php echo e($transfer->id); ?>" class="btn btn-danger text-white m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							no"> <i class="fa fa-times"></i> </a>
																	
							<?php endif; ?>
						
						</td>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('details_banks_transfer')): ?>
						<td class="text-center">
							<a href="#" data-id="<?php echo e($transfer->id); ?>" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air details"> <i class="fa fa-book"></i> </a>
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
			<?php echo $data['transfer']->render(); ?>

	</div>
</div><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/transfer/table-data.blade.php ENDPATH**/ ?>
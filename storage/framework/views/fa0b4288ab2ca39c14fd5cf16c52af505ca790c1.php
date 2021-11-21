<div class="table-responsive">

<table class="table table-bordered" id="html_table" width="100%">

			<thead class="m-datatable__head">

				<tr>

						<th class="text-center">#</th>

						<th class="text-center"><?php echo e(trans('lang.name')); ?> </th>
						<th class="text-center"><?php echo e(trans('lang.price')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.number_days')); ?></th>
						<th class="text-center"><?php echo e(trans('lang.number_products')); ?></th>

						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_subscriptions')): ?>

						<th class="text-center"><?php echo e(trans('lang.edit')); ?></th>

						<?php endif; ?>

						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_subscriptions')): ?>

						<th class="text-center"><?php echo e(trans('lang.delete')); ?></th>

						<?php endif; ?>

				</tr>

			</thead>

			<tbody class="m-datatable__body load">

				<?php 

					$i =1;

				?>

				<?php if(count($data['static']) > 0): ?>

					<?php $__currentLoopData = $data['static']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $static): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					<?php 

						if($static->status==1)

								{

								$class='btn btn-success m-btn m-btn--icon m-btn--pill';

								$color='green'; 

								$icon='check';

								$text = 'مفعل';

							}else{

								$class='btn btn-danger m-btn m-btn--icon m-btn--pill';

								$color='red';

								$icon='check';

								$text = 'غير مفعل';

							}

					?>

					<tr class="m-datatable__row">

						<td class="text-center">

							<?php echo e($i++); ?>


						</td>

						<td class="text-center">

							<?php echo e($static['name']); ?>


						</td>

						<td class="text-center">

							<?php echo e($static['price']); ?> <?php echo e($static['currency_name']); ?>



						</td>
						<td class="text-center">

							<?php echo e($static->number_days); ?>



						</td>
						<td class="text-center">
							<?php echo e($static->number_products); ?>


						</td>

						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_subscriptions')): ?>

						<td class="text-center">

						<a href="#" data-id="<?php echo e($static->id); ?>" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air

                     	updateDetails"> <i class="fa fa-edit"></i> </a>

						</td>

						<?php endif; ?>

						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_subscriptions')): ?>

						<td class="text-center">
							<?php if($static->id != 4): ?>
							<a href="#" data-id="<?php echo e($static->id); ?>" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air

							delete"> <i class="fa fa-trash"></i> </a>
							<?php else: ?> 
								-
							<?php endif; ?>
						</td>

						<?php endif; ?>

					</tr>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<?php else: ?>

				<tr  class="m-datatable__row"><td colspan="10" class="text-center"><?php echo e(trans('lang.no_data')); ?></td></tr>

				<?php endif; ?>

			</tbody>

			<tbody class="m-datatable__body DataUsers">

		</tbody>

	</table>

	<div style="text-align: center;">

			<?php echo $data['static']->render(); ?>


	</div>

</div><?php /**PATH /Users/fadymondy/Sites/yagot/resources/views/admin/subscriptions/table-data.blade.php ENDPATH**/ ?>
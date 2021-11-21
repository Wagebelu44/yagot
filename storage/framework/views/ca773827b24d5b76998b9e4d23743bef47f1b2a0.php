<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center">الاسم</th>
						<th class="text-center">الصورة</th>
						<th class="text-center">الجوال</th>
						<th class="text-center">الايميل</th>
						<th class="text-center">المنطقة</th>
						<th class="text-center">النوع</th>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change_status_clients')): ?>
						<th class="text-center"><?php echo e(__('lang.status')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_clients')): ?>
						<th class="text-center"><?php echo e(__('lang.edit')); ?></th>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_clients')): ?>
						<th class="text-center"><?php echo e(__('lang.delete')); ?></th>
						<?php endif; ?>
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				<?php 
					$i =1;
				?>
				<?php if(count($data['clients']) > 0): ?>
					<?php $__currentLoopData = $data['clients']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php 
						$lang = \App::getLocale();
						if($client->type==1)
								{
								$class1='btn btn-dark m-btn m-btn--icon m-btn--pill';
								$color1='green'; 
								$icon1='check';
								$text1 = 'هاوي';
							}elseif($client->type==2){
								$class1='btn btn-warning  m-btn m-btn--icon m-btn--pill';
								$color1='red';
								$icon1='check';
								$text1 = 'شركة';
							}else{
								$class1='btn btn-danger  m-btn m-btn--icon m-btn--pill';
								$color1='red';
								$icon1='check';
								$text1 = 'عميل';
							}
							if($client->status==1)
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
							<?php echo e($client['name']); ?>

						</td>
						<td class="text-center">
							<a  data-fancybox="gallery" href ="<?php echo e($client->image); ?>"  >
								<img src="<?php echo e($client->image); ?>" width="50px" style="height:50px" alt="">
							</a>
						</td>
						<td class="text-center">
							<?php echo e($client->phone); ?>

						</td>
						<td class="text-center">
							<?php echo e($client['email']); ?>

						</td>
						<td class="text-center">
							<?php if($client->zone): ?><?php echo e($client->zone->name); ?><?php endif; ?>
						</td>
						
						<td class="text-center">
							<a  href="javascript:void(0);"   color="<?php echo e($color1); ?>" data-id="<?php echo e($client->id); ?>" class="<?php echo e($class1); ?>" >  <span><?php echo e($text1); ?></span> </a>
						</td>

						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change_status_clients')): ?>
						<td class="text-center">
						<a  href="javascript:void(0);"  color="<?php echo e($color); ?>" data-id="<?php echo e($client->id); ?>" class="<?php echo e($class); ?> UpdateStats " >  <span><?php echo e($text); ?></span> </a>
						</td>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_clients')): ?>
						<td class="text-center">
						<a href="javascript:void(0);" data-id="<?php echo e($client->id); ?>" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                     	updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_clients')): ?>
						<td class="text-center"><a href="javascript:void(0);" data-id="<?php echo e($client->id); ?>" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							delete"> <i class="fa fa-trash"></i> </a>
						</td>
						<?php endif; ?>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
				<tr  class="m-datatable__row"><td colspan="10" class="text-center"><?php echo e(__('lang.no_data')); ?> </td></tr>
				<?php endif; ?>
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div style="text-align: center;">
			<?php echo $data['clients']->render(); ?>

	</div>
</div><?php /**PATH /Users/fadymondy/Sites/yagot/resources/views/admin/clients/table-data.blade.php ENDPATH**/ ?>
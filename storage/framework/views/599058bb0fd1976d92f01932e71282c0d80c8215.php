<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center"><?php echo e(trans('lang.name')); ?></th>
                        <th class="text-center"><?php echo e(trans('lang.mobile')); ?></th>	
						<th class="text-center"><?php echo e(trans('lang.email')); ?></th>	
						<th class="text-center"><?php echo e(trans('lang.date')); ?></th>						
						<th class="text-center"><?php echo e(trans('lang.show')); ?></th>
					
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reply_contact')): ?>
                        <th class="text-center"><?php echo e(trans('lang.send_reply')); ?></th>
						<?php endif; ?>	
					
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_contact')): ?>
                        <th class="text-center"><?php echo e(trans('lang.delete')); ?></th>
						<?php endif; ?>		
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				<?php 
					$i =1;
				?>
				<?php if(count($data['message']) > 0): ?>
					<?php $__currentLoopData = $data['message']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php 
						$color = '';
						
						$length = strlen((string)$message->mobile);
						if($length == 10){
							$mobile = substr($message->mobile, 1);
						}else{	
							$mobile = $message->mobile;
						}

						if($message->admin_view == 1){
						 	$color = 'success';
						}else{
						 	$color = 'danger';
						}
					?>
					<tr class="m-datatable__row">
						<td class="text-center">
							<?php echo e($i++); ?>

						</td>
						<td class="text-center">
							<?php echo e($message->name); ?>

						</td>
						<td class="text-center">
						<?php echo e($mobile); ?>

                        </td>   
						<td class="text-center">
						<?php echo e($message->email); ?>

						</td>  
						<td class="text-center">
						<?php echo e($message->created_at); ?>

                        </td>                       
                        
						
						<td class="text-center">
                            <a href="" class="show_message btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" data-id="<?php echo e($message->id); ?>"><i class="far fa-eye"></i></a>
                        </td>	
						
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reply_contact')): ?>
                        <td class="text-center">
                            <a href="" class="send_message  btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" data-id="<?php echo e($message->id); ?>"><i class="fas fa-reply"></i></a>
                        </td>	
						<?php endif; ?>	
						
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_contact')): ?>
							<td class="text-center"><a href="#" data-id="<?php echo e($message->id); ?>" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
								delete"> <i class="fa fa-trash"></i> </a>
							</td>
						<?php endif; ?>	
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
				<tr class="m-datatable__row"><td class="text-center" colspan="10">لا يوجد بيانات </td></tr>
				<?php endif; ?>
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div style="text-align: center;">
			<?php echo $data['message']->render(); ?>

	</div>
</div><?php /**PATH /Users/fadymondy/Sites/yagot/resources/views/admin/contact/table-data.blade.php ENDPATH**/ ?>
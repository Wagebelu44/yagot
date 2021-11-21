<div class="table-responsive">
  <table class="table table-bordered" id="html_table" width="100%">
        <thead class="m-datatable__head">
          <tr>
              <th class="text-center">#</th>
              <th class="text-center"><?php echo e(__('lang.title')); ?></th>
              <th class="text-center"><?php echo e(__('lang.client_name')); ?></th>
              <th class="text-center"><?php echo e(__('lang.category')); ?></th>
              <th class="text-center"><?php echo e(__('lang.price')); ?></th>
              <th class="text-center"><?php echo e(__('lang.currency')); ?></th>
              <th class="text-center"><?php echo e(__('lang.city')); ?></th>
              <th class="text-center"><?php echo e(__('lang.certificated')); ?></th>
              <th class="text-center"><?php echo e(__('lang.status')); ?></th>
              <th class="text-center"><?php echo e(__('lang.show')); ?></th>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_product')): ?>
              <th class="text-center"><?php echo e(__('lang.edit')); ?></th>
              <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_product')): ?>
              <th class="text-center"><?php echo e(__('lang.delete')); ?></th>
              <?php endif; ?>
          </tr>
        </thead>
        <tbody class="m-datatable__body load">
          <?php 
            $i =1;
          ?>
          <?php if(count($data['product']) > 0): ?>
            <?php $__currentLoopData = $data['product']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php 

							if($product->certified == 1)
								{
								$class='btn btn-success m-btn m-btn--icon m-btn--pill';
								$color='green'; 
								$icon='check';
								$text = __('lang.certificated');
							}else{
								$class='btn btn-danger m-btn m-btn--icon m-btn--pill';
								$color='red';
								$icon='check';
								$text = __('lang.uncertificated');
							}


              ?>
            <tr class="m-datatable__row">
              <td class="text-center">
                <?php echo e($i++); ?>

              </td>
              <td class="text-center">
                <?php echo e($product['title']); ?>

              </td>
              <td class="text-center">
                <?php echo e($product['client_name']); ?>

              </td>
              <td class="text-center">
                <?php echo e($product->category); ?>

              </td>
              <td class="text-center">
                <?php echo e($product->price); ?>

              </td>
              <td class="text-center">
                <?php echo e($product->curreny_name); ?>

              </td>
              <td class="text-center">
                <?php echo e($product->city_name); ?>

              </td>
              <td class="text-center">
					    	<a  href="javascript:void(0);"  color="<?php echo e($color); ?>" data-id="<?php echo e($product->id); ?>" class="<?php echo e($class); ?> certificated" >  <span><?php echo e($text); ?></span> </a>
						</td>
              <td class="text-center">
                <select data-id="<?php echo e($product->id); ?>" name="news_status_change" class="form-control news_status_change UpdateStatus"  placeholder="الحالة" data-live-search="true">
                  <?php $__currentLoopData = $data['product_status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status->id); ?>" <?php echo e($product->status==$status->id?"selected":""); ?>><?php echo e($status['name']); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              </td>
              <td style="text-align:center">
                  <a href="#" data-id="<?php echo e($product->id); ?>" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                    viewDetails"> <i class="flaticon-eye"></i></a>
              </td>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_product')): ?>
              <td class="text-center">
              <a href="#" data-id="<?php echo e($product->id); ?>" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                         updateDetails"> <i class="fa fa-edit"></i> </a>
              </td>
              <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_product')): ?>
              <td class="text-center"><a href="#" data-id="<?php echo e($product->id); ?>" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                delete"> <i class="fa fa-trash"></i> </a>
              </td>
              <?php endif; ?>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
          <tr  class="m-datatable__row"><td colspan="10" class="text-center"><?php echo e(__('lang.no_data')); ?></td></tr>
          <?php endif; ?>
        </tbody>
        <tbody class="m-datatable__body DataUsers">
      </tbody>
    </table>
    <div style="text-align: center;">
        <?php echo $data['product']->render(); ?>

    </div>
  </div><?php /**PATH /Users/fadymondy/Sites/yagot/resources/views/admin/news/table-data.blade.php ENDPATH**/ ?>
<div class="table-responsive">
    <table class="table table-bordered" id="html_table" width="100%">
                <thead class="m-datatable__head">
                    <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"><?php echo e(trans('lang.title_zone')); ?></th>
                            
                            
                            
                            
                            <th class="text-center"><?php echo e(trans('lang.edit')); ?></th>
                            
                            <th class="text-center"><?php echo e(trans('lang.delete')); ?></th>
                            
                    </tr>
                </thead>
                <tbody class="m-datatable__body load">
                    <?php 
                        $i =1;
                    ?>
                    <?php if(isset($data['zone_sub']) ): ?>
                    <?php if($data['zone_sub'] and count($data['zone_sub']) > 0): ?>
                        <?php $__currentLoopData = $data['zone_sub']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $z): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                            if($z->status == 1 )
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
                                <?php echo e($z->name_ar); ?>

                            </td>
                           
                            
                            
                            
                            <td class="text-center">
                            <a href="#" data-id="<?php echo e($z->id); ?>" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                             updateDetailssub"> <i class="fa fa-edit"></i> </a>
                            </td>
                            
                            <td class="text-center">
                                <a href="#" data-id="<?php echo e($z->id); ?>" data-parent="<?php echo e($z->parent_id); ?>" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air	delete"> <i class="fa fa-trash"></i> </a>
                            </td>
                            
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <tr class="m-datatable__row text-center"><td colspan="4"><?php echo e(trans("lang.no_data")); ?> </td></tr>
                    <?php endif; ?>
                    <?php endif; ?>
                </tbody>
                <tbody class="m-datatable__body DataUsers">
            </tbody>
        </table>
        <div style="text-align: center;">
            <?php if(isset($data['zone_sub'])): ?>
            <?php echo $data['zone_sub']->render(); ?>

        <?php endif; ?>
        </div>
    </div><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/zone/table-data-sub.blade.php ENDPATH**/ ?>
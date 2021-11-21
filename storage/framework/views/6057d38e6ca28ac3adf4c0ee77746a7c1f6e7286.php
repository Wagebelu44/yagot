<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(trans('lang.add_page')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php $i = 0; ?>
                    <?php $__currentLoopData = $data['system']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $i++; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if($system->value2 == \Lang::getLocale() ): ?> active  <?php endif; ?>" id="tab<?php echo e($i); ?>" data-toggle="tab" href="#lang_<?php echo e($system->value2); ?>" role="tab" aria-controls="lang_<?php echo e($system->value2); ?>" 
                        aria-selected="<?php if($system->value2 == \Lang::getLocale() ): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($system->name); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <?php $i = 0; ?>
                <?php $__currentLoopData = $data['system']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $i++; ?>
                    <div class="tab-pane fade <?php if($system->value2 == \Lang::getLocale() ): ?> show active <?php endif; ?>" id="lang_<?php echo e($system->value2); ?>" role="tabpanel" aria-labelledby="tab<?php echo e($i); ?>">
                               
                                <div class="form-group m-form__group row">
                                        <div class="col-md-12">
                                            <label><?php echo e(trans('lang.title')); ?><span class="required">*</span></label>
                                            <div class="form-valid">
                                                <input type="text" name="title_<?php echo e($system->value2); ?>" class="form-control title_<?php echo e($system->value2); ?>" placeholder="<?php echo e(trans('lang.title')); ?>">
                                            </div>
                                        </div>
                                    </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-md-12">
                                        <label for="recipient-name" class="form-control-label"><?php echo e(trans('lang.details')); ?><span
                                                    class="required">*</span></label>
                                        <div class="form-valid">
                                            <textarea  name="details_<?php echo e($system->value2); ?>" class="form-control details_<?php echo e($system->value2); ?> ckeditor" placeholder="<?php echo e(trans('lang.details')); ?>" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                    </div>  
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                         
                <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label><?php echo e(trans('lang.slug')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="slug" class="form-control slug" placeholder="<?php echo e(trans('lang.slug')); ?>">
                            </div>
                        </div>
                </div>

                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label> <?php echo e(trans('lang.status')); ?> <span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="checkbox" name="activeValue" id="activeValue"
                                 data-on-color="success" class="make-switch status activeValue"
                                 data-size="normal" data-on-text="<?php echo e(trans('lang.on')); ?>"
                                 data-off-text="<?php echo e(trans('lang.off')); ?>">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label><?php echo e(trans('lang.image')); ?><span class="required"></span></label>
                            <div class="form-valid">
                                <input type="file" name="image" class="form-control image" id="image">
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button onClick="CKupdate();$('#addNewpageForm').ajaxSubmit();" type="submit" class="btn btn-primary btn_save_page"><?php echo e(trans('lang.save')); ?></button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal"><?php echo e(trans('lang.hide')); ?></button>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/static_page/sub/add.blade.php ENDPATH**/ ?>
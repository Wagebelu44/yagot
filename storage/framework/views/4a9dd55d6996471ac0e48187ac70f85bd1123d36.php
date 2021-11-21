<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(trans('lang.add_site')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
               <div class="form-group m-form__group row">

                <div class="col-md-12 mb-3">
                            <label><?php echo e(trans('lang.name_ar')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_ar" class="form-control name_ar" placeholder="<?php echo e(trans('lang.name_ar')); ?>">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label><?php echo e(trans('lang.name_en')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_en" class="form-control name_en" placeholder="<?php echo e(trans('lang.name_en')); ?>">
                            </div>
                        </div>
                        </div>

                    <div class="form-group m-form__group row">
                        <div class="col-md-6">
                            <label> <?php echo e(trans('lang.status')); ?> <span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="checkbox" value="on" name="activeValue" id="activeValue"
                                 data-on-color="success" class="make-switch status activeValue"
                                 data-size="normal" data-on-text="<?php echo e(trans('lang.on')); ?>"
                                 data-off-text="<?php echo e(trans('lang.off')); ?>">
                            </div>
                        </div>

                    </div>
                
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_save_page"><?php echo e(trans('lang.save')); ?></button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal"><?php echo e(trans('lang.hide')); ?></button>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH /Users/fadymondy/Sites/yagot/resources/views/admin/category/sub/add.blade.php ENDPATH**/ ?>
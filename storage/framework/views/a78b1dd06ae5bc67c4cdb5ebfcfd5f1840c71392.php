<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(trans('lang.add_banks')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                               
                <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label><?php echo e(trans('lang.name_bank')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" autocomplete="off" placeholder="<?php echo e(trans('lang.name_bank')); ?>" name="name_bank" class="form-control name_bank"  id="name_bank">
                            </div>
                        </div>     
                </div>
                <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label><?php echo e(trans('lang.name_en')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" autocomplete="off" placeholder="<?php echo e(trans('lang.name_en')); ?>" name="name_en" class="form-control name_en"  id="name_en">
                            </div>
                        </div>     
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-md-12">
                        <label><?php echo e(trans('lang.account_no')); ?><span class="required">*</span></label>
                        <div class="form-valid">
                            <input type="text" autocomplete="off"  placeholder="<?php echo e(trans('lang.account_no')); ?>" name="account_no" class="form-control account_no"  id="account_no">
                        </div>
                    </div>     
               </div>
               <div class="form-group m-form__group row">
                <div class="col-md-6">
                    <label><?php echo e(trans('lang.IBAN')); ?><span class="required">*</span></label>
                    <div class="form-valid">
                        <input type="text" autocomplete="off" placeholder="<?php echo e(trans('lang.IBAN')); ?>" name="IBAN" class="form-control IBAN"  id="IBAN">
                    </div>
                </div>  
                <div class="col-md-6">
                        <label><?php echo e(trans('lang.tax_number')); ?><span class="required">*</span></label>
                        <div class="form-valid">
                            <input type="text" autocomplete="off" placeholder="<?php echo e(trans('lang.tax_number')); ?>" name="tax_number" class="form-control tax_number"  id="tax_number">
                        </div>
                    </div>     
                </div>
            
           
              <div class="form-group m-form__group row">
                <div class="col-md-6">
                    <label><?php echo e(trans('lang.status')); ?><span class="required">*</span></label>
                    <input type="checkbox" value="on" name="activeValue" id="activeValue"
                    data-on-color="success" class="make-switch status activeValue"
                    data-size="normal" data-on-text="<?php echo e(trans('lang.on')); ?>"
                    data-off-text="<?php echo e(trans('lang.off')); ?>">                            
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
</div><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/banks/sub/add.blade.php ENDPATH**/ ?>
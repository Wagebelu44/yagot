<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(trans('lang.add_zone')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group m-form__group row">
                    <div class="col-md-12">

                        <label

                          >النوع</label

                        >

                        <div class="form-valid">

                          <select

                            name="parent_type_id"

                            class="parent_type_id form-control"

                          >

                            <option value=""  disabled>النوع</option>

                            <option value="1">منطقة</option>

                            <option value="2">مدينة</option>

                          </select>

                        </div>
                    </div>
                </div>

                    <div class="form-group m-form__group row ">
                        <div class="col-md-12 country_div d-none">

                            <label
    
                              ><?php echo e(__("lang.country")); ?><span class="required">*</span></label
    
                            >
    
                            <div class="form-valid">
    
                              <select
    
                                name="country_id"
    
                                class="country_id form-control selectpicker" data-live-search="true"
    
                              >
    
                                <option value=""  disabled>
                                  اختر الدولة
                                </option>
    
                                <?php $__currentLoopData = $data['countries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
                                <option
    
                                  value="<?php echo e($country['value']); ?>"
    
                                  ><?php echo e($country['name']); ?></option
    
                                >
    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
                              </select>
    
                            </div>
    
                          </div>


                          <div class="col-md-12  parent_div d-none">

                            <label
    
                              >المنطقة الرئيسية</label
    
                            >
    
                            <div class="form-valid">
    
                              <select
    
                                name="parent_id"
    
                                class="parent_id form-control"
    
                              >
    
                                <option value="" >المنطقة الرئيسية</option>
    
                                <?php $__currentLoopData = $data['parents']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
                                <option
    
                                  value="<?php echo e($parent['id']); ?>"
    
                                  ><?php echo e($parent['name']); ?></option
    
                                >
    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
                              </select>
    
                            </div>
    
                          </div>

                    </div>


                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label><?php echo e(trans('lang.title_ar')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_ar" autocomplete="off" class="form-control name_ar" id="name_ar" placeholder="<?php echo e(trans('lang.title_ar')); ?>">
                            </div>
                        </div>
                     
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label><?php echo e(trans('lang.title_en')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_en" autocomplete="off" class="form-control name_en" id="name_en" placeholder="<?php echo e(trans('lang.title_en')); ?>">
                            </div>
                        </div>

                    </div>

                    <div class="form-group m-form__group row">
                    <div class="col-md-12">
                            <label><?php echo e(trans('lang.notes')); ?><span class="required"></span></label>
                            <div class="form-valid">
                                <textarea
                                id="notes"
                                name="notes"
                                class="form-control notes"
                                rows="5 "
                                cols="30"
                                placeholder="<?php echo e(trans('lang.notes')); ?>"
                              ></textarea>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(trans('lang.hide')); ?></button>
                </div>
                
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
                <input type="hidden" class="sub_zone" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>


<?php /**PATH /var/www/html/backend_yagot/resources/views/admin/zone/sub/add.blade.php ENDPATH**/ ?>
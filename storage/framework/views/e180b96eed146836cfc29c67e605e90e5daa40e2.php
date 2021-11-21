<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('lang.add_new_clients')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      
                           
                                <div class="form-group m-form__group row">
                                    <div class="col-md-6 mb-2">
                                        <label> الاسم  <span class="required">*</span> </label>
                                        <div class="form-valid">
                                            <input type="text" name="fname" class="form-control fname" placeholder="الاسم ">
                                        </div>
                                    </div>
                                  
                                    
                                    <div class="col-md-6 mb-2">
                                        <label> المنطقه <span class="required">*</span> </label>
                                        <div class="form-valid">
                                            <select name="zone_id" class="form-control zone" id="zone_id">
                                                <option value="">إختر المنطقه </option>
                                                <?php $__currentLoopData = $data['zones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($b->id); ?>"><?php echo e($b->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                            </select>                                           </div>
                                    </div>
                                   
                                    <div class="col-md-6 mb-2">
                                        <label> البريد الإلكتروني <span class="required"></span> </label>
                                        <div class="form-valid">
                                            <input type="email" name="email" class="form-control email" placeholder="البريد الإلكتروني" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label>  رقم الجوال <span class="required">*</span> </label>
                                        <div class="form-valid row" style="margin-left: 0px !important ; margin-right: 0px !important;">
                                            <input type="text" name="mobile" class="form-control mobile col-9" placeholder="رقم الجوال" autocomplete="off" >
                                            <select class="form-control country_code col-3" name="country_code" id="country_code" >
                                                <?php $__currentLoopData = $data['country_code']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($b->value2); ?>"><?php echo e($b->value2); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label> كلمة المرور  <span class="required">*</span> </label>
                                        <div class="form-valid">
                                            <input type="password" name="password" class="form-control password" placeholder="كلمة المرور">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label> تاكيد كلمة المرور <span class="required">*</span> </label>
                                        <div class="form-valid">
                                            <input type="password" name="cpassword" class="form-control cpassword" placeholder=" تاكيد كلمة المرور ">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>  الصورة  <span class="required"></span> </label>
                                        <div class="form-valid">
                                            <input type="file"  name="image" class="form-control image" id="image" >                                         
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2  img_review d-none">
                                        <label> صورة الملف الشخصي  <span class="required">*</span> </label>
                                        <div class="form-valid" >
                                            <img src="" alt="" width="30%">                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-md-6 mb-3">
                                        <label>النوع<span class="required">*</span> </label>
                                        <div class="form-valid ">
                                            <select class="form-control type" name="type" id="type" >
                                                <option value=""> اختر النوع </option>
                                                <option value="1">هاوي </option>
                                                <option value="2">شركة </option>
                                                <option value="3">عميل </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2 commercial_photo attachments">
                                        <label>  السجل التجاري  <span class="required"></span> </label>
                                        <div class="form-valid">
                                            <input type="file"  name="commercial_photo" class="form-control commercial_photo" id="commercial_photo" >                                         
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2 passport attachments">
                                        <label>  جواز السفر  <span class="required"></span> </label>
                                        <div class="form-valid">
                                            <input type="file"  name="passport" class="form-control passport" id="passport" >                                         
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2 identity attachments">
                                        <label>  صورة الهوية <span class="required"></span> </label>
                                        <div class="form-valid">
                                            <input type="file"  name="identity" class="form-control identity" id="identity" >                                         
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-md-12">
                                    <div class="table_attachments"></div>
                                    </div>
                                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_save_page"><?php echo e(__('lang.save')); ?></button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal"><?php echo e(__('lang.hide')); ?></button>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade in" id="add_conversion_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="conversion_typeform" id="conversion_typeform" action="" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تحديد تنصيف الشاعر </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label  style="font-weight: 900; font-size: 14px;">يرجى إختيار تصنيف الشاعر <span class="required">*</span> </label>
                            <br>
                            <div class="row form-valid all_conversion_type" >
                                <?php $__currentLoopData = $data['party_type']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6 ">
                                        <label for="checkboxRule<?php echo e($b->value); ?>" style="font-weight: 700; font-size: 14px;">
                                                <input value="<?php echo e($b->value); ?>" type="checkbox" name="poet_type[]" class="zt-control poet_type" id="poet_type<?php echo e($b->value); ?>">
                                                <?php echo e($b->name); ?>

                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onClick="CKupdate();$('#conversion_type').ajaxSubmit();" type="submit" class="btn btn-primary btn_save_page"><?php echo e(__('lang.save')); ?></button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal"><?php echo e(__('lang.hide')); ?></button>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH /Users/fadymondy/Sites/yagot/resources/views/admin/clients/sub/add.blade.php ENDPATH**/ ?>
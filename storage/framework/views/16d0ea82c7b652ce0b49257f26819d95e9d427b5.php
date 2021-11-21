<div class="modal fade in" id="add_slider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(trans('lang.slider')); ?></h5>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_slider')): ?>
				<button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
    			padding-bottom: 15px;margin-right: auto;"><i class="fa fa-plus"></i> <?php echo e(trans('lang.add_slider')); ?></button>
                <?php endif; ?>
                    <button type="button" class="close ml-0 mt-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
              
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal"><?php echo e(trans('lang.hide')); ?></button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
        </div>
    </div>
</div>


<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(trans('lang.add_slider')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <div class="form-group m-form__group row">
                    <div class="col-md-6">  
                        <label><?php echo e(trans('lang.type')); ?><span class="required"></span></label>
                        <select name="type" class="form-control type" id="type">
                            <option value=""><?php echo e(trans('lang.type')); ?></option>
                            <?php $__currentLoopData = $data['slider_type']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($s->id); ?>"><?php echo e($s->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label><?php echo e(trans('lang.image')); ?><span class="required"></span></label>
                        <div class="form-valid">
                            <input type="file" name="photo" class="form-control photo"  id="photo">
                        </div>
                    </div>
                </div>
               

                
                <div class="form-group m-form__group row">

                    <div class="col-md-6 product_div div_select">  
                            <label><?php echo e(trans('lang.products')); ?><span class="required"></span></label>
                            <select name="product"  data-live-search="true" class="form-control product product_select selectpicker" id="ajax-select">
                                <option value=""><?php echo e(trans('lang.products')); ?></option>
                            </select>
                        </div>

                        <div class="col-md-6 category_div div_select">  
                            <label><?php echo e(trans('lang.category')); ?><span class="required"></span></label>
                            <select name="category" class="form-control category" id="category">
                                <option value=""><?php echo e(trans('lang.category')); ?></option>
                                <?php $__currentLoopData = $data['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-6 url_div div_select">
                            <label><?php echo e(trans('lang.url')); ?><span class="required"></span></label>
                            <div class="form-valid">
                                <input type="url" name="url" class="form-control url"  placeholder="<?php echo e(trans('lang.url')); ?>" id="url">
                            </div>
                        </div>

                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
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
                    <button  type="submit" class="btn btn-primary btn_save_page"><?php echo e(trans('lang.save')); ?></button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal"><?php echo e(trans('lang.hide')); ?></button>
                </div>
                <input type="hidden" name="parent_id" class="parent_id" value="0">
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade in" id="add_parent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="addParentForm" id="addParentForm" action="" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(trans('lang.add_slider')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <div class="form-group m-form__group row">
                    
                    <div class="col-md-12">
                        <label><?php echo e(trans('lang.title_ar')); ?><span class="required"></span></label>
                        <div class="form-valid">
                            <input type="text" name="title_ar" class="form-control title_ar" placeholder="<?php echo e(trans('lang.title_ar')); ?>"  id="title_ar">
                        </div>
                    </div>
                </div>
                
                <div class="form-group m-form__group row">
                    <div class="col-md-12">
                        <label><?php echo e(trans('lang.title_en')); ?><span class="required"></span></label>
                        <div class="form-valid">
                            <input type="text" name="title_en" class="form-control title_en"  placeholder="<?php echo e(trans('lang.title_en')); ?>" id="title_en">
                        </div>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <button  type="submit" class="btn btn-primary btn_save_page"><?php echo e(trans('lang.save')); ?></button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal"><?php echo e(trans('lang.hide')); ?></button>
                </div>
                <input type="hidden" name="hidden" class="rowIdParent" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>


<?php /**PATH /var/www/html/backend_yagot/resources/views/admin/slider/sub/add.blade.php ENDPATH**/ ?>
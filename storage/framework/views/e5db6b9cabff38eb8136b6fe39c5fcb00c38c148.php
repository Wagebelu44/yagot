<div
  class="modal fade in"
  id="add_page"
  tabindex="-1"
  role="dialog"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form
        class="addNewpageForm"
        id="addNewpageForm"
        action=""
        method="post"
        enctype="multipart/form-data"
      >
        <?php echo csrf_field(); ?>
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
          <?php echo e(__('lang.add_products')); ?>

          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="">
            <div class="m-portlet__head">
              <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                  <h3 class="m-portlet__head-text"></h3>
                </div>
              </div>
              <div class="m-portlet__head-tools">
                <ul
                  class="nav nav-tabs" id="myTab"
                  role="tablist"
                >
                  <li class="nav-item">
                    <a
                      class="nav-link active"
                      data-toggle="tab"
                      role="tab"
                      href="#informationTab"
                      ><?php echo e(__("lang.news_info")); ?></a
                    >
                  </li>
                 
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      data-toggle="tab"
                      role="tab"
                      href="#additionalInfoTab"
                      ><?php echo e(__("lang.additional_images")); ?></a
                    >
                  </li>
                </ul>
              </div>
            </div>
            <div class="m-portlet__body">
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane  show active" id="informationTab">

                  <div class="row">
                      <div class="col-md-6 form-group m-form__group">
                            <label
                              ><?php echo e(__("lang.title")); ?><span class="required">*</span></label
                            >
                            <div class="form-valid">
                              <input
                                type="text"
                                name="title"
                                class="form-control title"
                                placeholder="<?php echo e(__('lang.title')); ?>"
                              />
                            </div>
                      </div>
                              
                      <div class="col-md-6">
                      <label
                        ><?php echo e(__("lang.client")); ?><span class="required">*</span></label
                      >
                      <div class="form-valid">
                        <select
                          name="client_id"
                          class="client_id form-control selectpicker"
                          id="ajax-select"
                          data-live-search="true"
                        > 
                          <option value=""><?php echo e(__('lang.client')); ?></option>
                        </select>
                      </div>
                    </div>

                      
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group m-form__group">
                          <label
                            ><?php echo e(__("lang.details")); ?><span class="required">*</span></label
                          >
                          <div class="form-valid">
                            <textarea
                              name="details"
                              class="form-control details"
                              rows="7"
                              cols="30"
                              placeholder="<?php echo e(__('lang.details')); ?>"
                            ></textarea>
                          </div>
                    </div>
                    
                  </div>
                  
                  <div class="form-group m-form__group row">
                  
                    <div class="col-md-4">
                      <label
                        ><?php echo e(__("lang.category")); ?><span class="required">*</span></label
                      >
                      <div class="form-valid">
                        <select
                          name="category_id"
                          class="category_id form-control"
                        >
                          <option value="" ><?php echo e(__("lang.choose_category")); ?></option>
                          <?php $__currentLoopData = $data['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option
                            value="<?php echo e($category['id']); ?>"
                            ><?php echo e($category['name']); ?></option
                          >
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <label
                        ><?php echo e(__("lang.city")); ?><span class="required">*</span></label
                      >
                      <div class="form-valid">
                        <select
                          name="city_id"
                          class="city_id form-control"
                        >
                          <option value="" ><?php echo e(__("lang.choose_city")); ?></option>
                          <?php $__currentLoopData = $data['zones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zones): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option
                            value="<?php echo e($zones['id']); ?>"
                            ><?php echo e($zones['name']); ?></option
                          >
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4 form-group m-form__group">
                            <label
                              ><?php echo e(__("lang.price")); ?><span class="required">*</span></label
                            >
                            <div class="form-valid">
                              <input
                                type="text"
                                name="price"
                                class="form-control price"
                                placeholder="<?php echo e(__('lang.price')); ?>"
                              />
                            </div>
                      </div>

                  </div>


                  <div class="row form-group">
                  <div class="col-md-6 form-group m-form__group">
                      <label
                              ><?php echo e(__("lang.main_image")); ?><span class="required">*</span></label
                            >
                      <div class="form-valid ">
                        <div class="custom-file">
                            
                          <input
                            type="file"
                            id="<?php echo e(__('lang.main_image')); ?>"
                            name="main_image"
                            class="custom-file-input main_image image_input"
                            placeholder="<?php echo e(__('lang.main_image')); ?>"
                            accept="image/jpg,image/jpeg,image/png,image/gif"
                          />
                          <label class="custom-file-label"><?php echo e(__("lang.choose_image")); ?></label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="image-preview">
                          <img src="" width="200px" id="mainImagePreview" class="img-fluid img-thumbnail"/>
                         </div>
                      </div>

                    </div>
                  </div>

                
                </div>
           
                <div class="tab-pane fade" id="additionalInfoTab">
                  
                  <div id="additionalImagesPreview" class="row"></div>
                  <div id="newAdditionalImagesPreview" class="row"></div>
                  <div class="form-group m-form__group row">
                          <div class="col-md-5">
                              <div class="form-valid ">
                                <div class="custom-file">
                                  <input
                                    type="file"
                                    id="additional_images"
                                    name="additional_images"
                                    class="custom-file-input additional_images image_input"
                                    placeholder="<?php echo e(__('lang.additional_images')); ?>"
                                    accept="image/jpg,image/jpeg,image/png,image/gif"
                                  />
                                  <label class="custom-file-label"><?php echo e(__("lang.choose_images")); ?></label>
                                </div>
                              </div>
                            </div>

                      <div class="col-md-1">
                          <div class="form-valid ">
                            <a href="#" class="btn btn-success m-btn--pill m-btn--air btnAddAdditionalImage"><i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn_save_page">
            <?php echo e(__("lang.save")); ?>

          </button>
          <button
            type="button"
            class="btn btn-secondary  "
            data-dismiss="modal"
          >
            <?php echo e(__("lang.cancel")); ?>

          </button>
        </div>
        <input type="hidden" name="hidden" class="rowIdUpdate" value="0" />
        <div id="loading">
          <img
            id="loading-image"
            src="/admin/assets/ajax-loader.gif"
            alt="Loading..."
          />
        </div>
      </form>
    </div>
  </div>
</div>
<?php /**PATH /Users/fadymondy/Sites/yagot/resources/views/admin/news/sub/add.blade.php ENDPATH**/ ?>
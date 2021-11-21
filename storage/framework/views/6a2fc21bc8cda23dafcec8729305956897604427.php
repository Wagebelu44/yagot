
<?php $__env->startSection('title'); ?>
   لوحة التحكم
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-content'); ?>
<!-- <div class="m-subheader-search">
		<span class="m-subheader-search__desc">
		<div class="mr-auto">
</div>
</span>
					</div> -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="#" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="/admin/dashborad" class="m-nav__link">
											<span class="m-nav__link-text"><?php echo e(trans('lang.home')); ?></span>
										</a>
									</li>
									
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="/admin/dashboard/profile" class="m-nav__link">
											<span class="m-nav__link-text"><?php echo e(trans('lang.profile')); ?></span>
										</a>
									</li>
								</ul>
							</div>
	
	<div>

</div>
</div>
</div>

<div class="m-grid__item m-grid__item--fluid m-wrapper">
<!-- BEGIN: Subheader -->
<!-- END: Subheader -->
<div class="m-content">
<div class="row">
<div class="col-lg-12">
<!--begin::Portlet-->
<div class="m-portlet m-portlet--mobile" id="m_blockui_2_portlet">
	<div class="m-portlet__head">
<div class="m-portlet__head-caption">
<div class="m-portlet__head-title">
<h3 class="m-portlet__head-text">
<?php echo e(trans('lang.profile')); ?>

</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
    <form class="profileForm" id="profileForm" action="" method="post">
                <?php echo csrf_field(); ?>
                    <div class="form-group m-form__group row">
                        <div class="col-md-4 mb-4">
                            <label><?php echo e(trans('lang.user_name')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" disabled value="<?php echo e(\Auth::user()->fullname); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label><?php echo e(trans('lang.email')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="email" disabled  value="<?php echo e(\Auth::user()->email); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                                <label
                                ><?php echo e(__("lang.language")); ?><span class="required">*</span></label
                            >
                            <div class="form-valid">
                                <select
                                name="lang_id"
                                class="lang_id form-control"
                                >
                                <option value="" selected disabled><?php echo e(__("lang.choose_language")); ?></option>
                                <?php $__currentLoopData = $data['language']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($lang['value']); ?>" <?php if(\Auth::user()->lang_id == $lang['value']): ?> selected <?php endif; ?>
                                    ><?php echo e($lang['name']); ?></option
                                >
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                             <label><?php echo e(trans('lang.password')); ?><span class="required"></span></label>
                            <div class="form-valid">
                                <input type="password" name="password" value="" class="form-control password">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_save_page"><?php echo e(trans('lang.save')); ?></button>
                </div>
            </form>
	</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
            $('#profileForm').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);
                $.ajax({
                    url: '/admin/dashboard/password',
                    dataType:'json',
                    type: 'POST',
                    cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        if (data["status"] == true) {
                                Swal(
                                data['data'],
                                '',
                                'success'
                                );
                                $('.password').val('');
                        }else {
                            Swal({
                                type: 'error',
                                title: 'عذرا',
                                text: data['data']
                            })
                        }
                    },
                });
            });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/dashboard/profile.blade.php ENDPATH**/ ?>
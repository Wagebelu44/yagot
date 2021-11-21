
<?php $__env->startSection('title'); ?>
   لوحة التحكم
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    #terms_modal .modal-dialog{
				max-width: initial;
				width: 95vw;
    }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-content'); ?>

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
										<a href="/admin/home_order" class="m-nav__link">
											<span class="m-nav__link-text"><?php echo e(trans('lang.home_order')); ?></span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">
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
<?php echo e(trans('lang.home_order')); ?>

</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
	<div id="table-container">
		<form method="post" class="form_order" action="<?php echo e(URL::to('/')); ?>/admin/home_order/save_order">
			<?php echo csrf_field(); ?>
			<div class="row" id="gridDemo">
				<?php $__currentLoopData = $data['home_order']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-md-12" style="display:block;cursor:pointer">
					<div class="px-3 mb-2 py-2" style="border: 1px solid #ccc;">
						<?php if($h->type == 1): ?>
							<?php if(App::getLocale() == 'ar'): ?>
								<h6 class="mb-0"><?php echo e($h->title); ?></h6>
							<?php else: ?>
								<h6 class="mb-0"><?php echo e($h->title_en); ?></h6>
							<?php endif; ?>
						<?php else: ?>
							<h6 class="mb-0"><?php echo e(trans("lang.$h->title")); ?></h6>
						<?php endif; ?>
						<input type="hidden" name="type[]" value="<?php echo e($h->type); ?>">
						<input type="hidden" name="title[]" value="<?php echo e($h->title); ?>">
						<input type="hidden" name="title_en[]" value="<?php echo e($h->title_en); ?>">
						<input type="hidden" name="reference_id[]" value="<?php echo e($h->reference_id); ?>">
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
			<div class="row mt-2">
				<div class="col-md-12">
					<button class="btn btn-primary btn-sm"><?php echo e(trans('lang.save')); ?></button>
				</div>
			</div>
		</form>
	</div>

	</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>   

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(URL::to('/')); ?>/js/Sortable.min.js"></script>
<script type="text/javascript">
	var example1 = document.getElementById('gridDemo');
	new Sortable(example1, {
		animation: 150,
		ghostClass: 'blue-background-class'
	});

	$('.form_order').on('submit', function(e){
            e.preventDefault();
            $('#load').show();
            var formData = new FormData(this);
       
                $.ajax({
                    url: '/admin/home_order/save_order',
                    dataType:'json',
                    type: 'POST',
                    cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#load').hide();
                        if (data["status"] == true) {
                                Swal.fire(
                                data['message'],
                                '',
                                'success'
                                );
                        }else {
                            Swal.fire({
                                type: 'error',
                                title: 'عذرا',
                                text: data['message']
                            })
                        }
                    },
                });
            });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/home_order/index.blade.php ENDPATH**/ ?>
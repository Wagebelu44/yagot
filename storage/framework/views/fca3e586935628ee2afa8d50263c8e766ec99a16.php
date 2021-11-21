
<?php $__env->startSection('title'); ?>
<?php echo e(__('lang.dashboard')); ?>

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
					<a href="/admin/dashboard" class="m-nav__link">
					<span class="m-nav__link-text"><?php echo e(__('lang.home')); ?></span>
					</a>
				</li>
				<li class="m-nav__separator">-</li>
				<li class="m-nav__item">
					<a href="/admin/social" class="m-nav__link">
					<span class="m-nav__link-text"><?php echo e(__('lang.social_media')); ?></span>
					</a>
				</li>
			</ul>
		</div>
		<div class="m-demo__preview  m-demo__preview--btn">
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_social')): ?>
			<button type="button" data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
				padding-bottom: 15px;"><i class="fa fa-plus"></i> <?php echo e(__('lang.add_social')); ?></button>
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="m-portlet m-portlet--mobile" id="m_blockui_2_portlet">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									<?php echo e(__('lang.social_media')); ?>

								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div id="table-container">
							<?php echo $__env->make('admin.social.table-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $__env->make('admin.social.sub.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
	$('#activeValue').bootstrapSwitch('state', false, true);

	$('body').on('click','.UpdateStats',function(){
		$(this).addClass('disabled');
		$('.loadImg').removeClass('hidden');
		$('.loadMSG').html('<?php echo e(__('lang.updating_status')); ?>');
		var thisTag = $(this);
		var id = $(this).data('id');
		$('#load').show();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "/admin/social/UpdateStats",
			type: "POST",
			dataType: "JSON",
			data:{id:id},
			success: function(data) {
				$('#load').hide();
				if(data["status"] == true){
					var url = $(this).attr('href');
					getData(url);
					window.history.pushState("", "", url); 
				}
			}
		});
		$(thisTag).removeClass('disabled');
		$('.loadImg').addClass('hidden');
	});
</script>
<script>
	$(document).on('click', '.pagination a',function(event) {
		event.preventDefault();
		$('li').removeClass('active');
		$(this).parent('li').addClass('active');
		var url = $(this).attr('href');
		getData(url);
		window.history.pushState("", "", url);
	});
	  
	function getData(url) {
		// $('#load')
		$.ajax({
			url : url
		}).done(function (data) {
			$("#table-container").empty().html(data);
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on('click', '.btnAddCustomer', function () {
			$('#addNewpageForm').find(".url").val('');
			$('#addNewpageForm').find(".social").val('');
			$('#addNewpageForm').find(".file").val('');
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
		});
		
		/*************************************************/
		$(document).on('click', '.updateDetails', function () {
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
			var id = $(this).data('id');
			$('#addNewpageForm').find(".file").val('');
			$('.rowIdUpdate').val(id);
			$.ajax({
				url: "/admin/social/edit",
				type: "get",
				dataType: "JSON",
				data: {
					id: id
				},
				success: function(data){
					if(data['status'] == true){
						if(data['data']['status'] == 1){
							$('#activeValue').bootstrapSwitch('state', true, true);
						}else{
							$('#activeValue').bootstrapSwitch('state', false, true);
						}
						$(".url").val(data['data']['url']);
						$('#addNewpageForm').find(".social").val(data['data']['class_icon']);
					}
				},
				complete: function () {
					$('#add_page').modal('show');
				},
				error: function (jqXHR, textStatus, errorThrown) {
					swal({title: '<?php echo e(__('lang.whoops')); ?>', type: "error"});
				}
			});
	
			$('.modal-title').html('<?php echo e(__('lang.edit')); ?> بيانات');
			$('.btn_save_user').html('<?php echo e(__('lang.edit')); ?>');
	
		});
		/*************************************************/
		$('.addNewpageForm').on('submit', function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$('.loader_add_user').css('display', 'initial');
			setTimeout(function () {
				$('.btn_save_customer').removeClass('disabled');
				$('.loader_add_user').css('display', 'none');
			}, 30000);
			var id = $(".rowIdUpdate").val();
			$('#loading').show();
			var action_url = (id == 0)? "/admin/social/add" : "/admin/social/update";
			$.ajax({
				url: action_url,
				type: "post",
				cache:false,
				contentType: false,
				processData: false,
				data: formData,
				success: function (data) {
					$('#loading').hide();
					if (data["status"] == true) {
						swal({
							title: "",
							text: data["data"],
							type: "success",
							showCancelButton: false,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "<?php echo e(__('lang.ok')); ?>",
							cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",
							closeOnConfirm: true,
							closeOnCancel: true
						});
						$('#addNewpageForm').find(".url").val('');
						$('#addNewpageForm').find(".file").val('');
						$('#addNewpageForm').find(".social").val('');
						$('#addNewpageForm').find('.rowIdUpdate').val(0);
						$('#add_page').modal('hide');
						var url = $(this).attr('href');
						getData(url);
						// window.history.pushState("", "", url); 
					} else {
						swal({
							title: "",
							text: data["data"],
							type: "error",
							showCancelButton: false,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "<?php echo e(__('lang.ok')); ?>",
							cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",
							closeOnConfirm: true,
							closeOnCancel: true
						});
					}
				}
			});
		});
	});
	
	$(document).on('click','.delete',function(e){
	var id = $(this).data('id');
	Swal.fire({
	title: '<?php echo e(__('lang.are_you_sure')); ?>',
	text: "",
	type: 'warning',
	showCancelButton: true,
	confirmButtonColor: '#3085d6',
	cancelButtonColor: '#d33',
	confirmButtonText: '<?php echo e(__('lang.ok')); ?>',
	cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",
	}).then((result) => {
	if (result.value) {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
				url: "/admin/social/delete",
				type: "post",
				dataType: "JSON",
				data: {
					id: id
				},
				success: function(data){
		if(data['status'] == true){
			Swal.fire(
			'<?php echo e(__('lang.success')); ?>',
			'',
			'success'
			)
			var url = $(this).attr('href');
			getData(url);
			// window.history.pushState("", "", url); 
		}else{
			swal({
								title: "",
								text: data["data"],
								type: "error",
								showCancelButton: false,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "<?php echo e(__('lang.ok')); ?>",
								cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",
								closeOnConfirm: true,
								closeOnCancel: true
							});
		}
				},
			});
	}
	})
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/social/index.blade.php ENDPATH**/ ?>
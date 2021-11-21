
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
										<a href="/admin/stones" class="m-nav__link">
											<span class="m-nav__link-text"><?php echo e(trans('lang.stones')); ?></span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_stones')): ?> 
				<button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
                padding-bottom: 15px;"><i class="fa fa-plus"></i> <?php echo e(trans('lang.add_stones')); ?></button>
              <?php endif; ?>
           
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
<?php echo e(trans('lang.stones')); ?>

</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
    <div class="form-group m-form__group row">
            <!-- <div class="col-md-3">
                <input type="text" name="name"  class="form-control name" placeholder="<?php echo e(__('lang.name')); ?>">
            </div> -->
    </div>
	<div id="table-container">
        <?php echo $__env->make('admin.stones.table-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>

	</div>
</div>
</div>
</div>
</div>
</div>

<?php echo $__env->make('admin.stones.sub.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>   

<?php $__env->startSection('js'); ?>
<script type="text/javascript">

$('#activeValue').bootstrapSwitch('state', false, true);
$('#show').bootstrapSwitch('state', false, true);

// $('.name').on('input',function(e){
//     var url = $(this).attr('href');
//     getData(url);
// })

$(document).on('click',".m_blockui_2_3",function() {
    mApp.block("#m_blockui_2_portlet", {
        overlayColor: "#000000",
        type: "loader",
        state: "success",
        size: "lg"
    }), setTimeout(function() {
        mApp.unblock("#m_blockui_2_portlet")
    }, 2e3);
});
/***********************************************************************************************************************/
        $('body').on('click','.UpdateStats',function(){
            $(this).addClass('disabled');
            $('.loadImg').removeClass('hidden');
            $('.loadMSG').html('جاري تحديث الحالة');
            var thisTag = $(this);
            var id = $(this).data('id');
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#load').show();
            $.ajax({
            	url: "/admin/stones/UpdateStats",
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
        $(document).on('click', '.table_page .pagination a',function(event)
        {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            getData(url);
            window.history.pushState("", "", url);
        });
        $(document).on('click', '.terms_page .pagination a',function(event)
        {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            url = url.replace('category','terms');
            getTermData(url);
            // window.history.pushState("", "", url);
        });
  
    function getData(url) {
        name = $('.name').val();
        $.ajax({
            url : url,data:{name:name}
        }).done(function (data) {
            $("#table-container").empty().html(data);
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        /*************************************************/
        $(document).on('click', '.btnAddCustomer', function () {
			$('#addNewpageForm').find(".name_ar").val('');
            $('#addNewpageForm').find(".name_en").val('');
			$('#addNewpageForm').find(".status").val('');
            $('.images').val('');
            $('#addNewpageForm').find(".details_ar").val('');
            $('#addNewpageForm').find(".photo").val('');
            $('.remove_images').val('');
            $('#addNewpageForm').find(".details_en").val('');
            $('.modal-title').html('<?php echo e(__('lang.add_data')); ?>');
            $('#activeValue').bootstrapSwitch('state', true, true);
            $('#show').bootstrapSwitch('state', true, true);
            $('.table_attachments').html('');
            removes = [];
            $('#addNewpageForm').find('.rowIdUpdate').val(0);
        });

        
        /*************************************************/
        $(document).on('click', '.updateDetails', function () {
			$('#addNewpageForm').find('.addNewpageForm .rowIdUpdate').val(0);
            var id = $(this).data('id');
            $('.remove_images').val('');
            removes = [];
            $('.images').val('');
            $('.addNewpageForm .rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/stones/edit",
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
                      
                        $(".name_ar").val(data['data']['name_ar']);
                        $(".name_en").val(data['data']['name_en']);
                        $(".details_ar").val(data['data']['details_ar']);
                        $(".details_en").val(data['data']['details_en']);
                        $('.table_attachments').html(data['html']);
					}
                },
                complete: function () {
                    $('#add_page').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                }
            });
            $('.modal-title').html('<?php echo e(__('lang.edit_data')); ?>');

        });
        /*************************************************/
        $('.addNewpageForm').on('submit', function(e){
            e.preventDefault();
            $('#loading').show();
			var formData = new FormData(this);
            $('.loader_add_user').css('display', 'initial');
            setTimeout(function () {
                $('.btn_save_customer').removeClass('disabled');
                $('.loader_add_user').css('display', 'none');
            }, 30000);
            var id = $(".addNewpageForm .rowIdUpdate").val();
            if (id == 0) {
                $.ajax({
                    url: "/admin/stones/add",
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
                                confirmButtonText: '<?php echo e(__('lang.ok')); ?>',
                                cancelButtonText: '<?php echo e(__('lang.cancel')); ?>',
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            $('#addNewpageForm').find(".name_ar").val('');
                            $('#addNewpageForm').find(".name_en").val('');
                            $('#addNewpageForm').find(".status").val('');
                            $('#addNewpageForm').find(".photo").val('');
                            $('.table_attachments').html('');
                            $('#addNewpageForm').find(".details_ar").val('');
                            $('#addNewpageForm').find(".details_en").val('');
                            $('.remove_images').val('');
                            $('.images').val('');
                            $('#activeValue').bootstrapSwitch('state', true, true);
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
                                confirmButtonText: '<?php echo e(__('lang.ok')); ?>',
                                cancelButtonText: '<?php echo e(__('lang.cancel')); ?>',
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });

                        }
                    }
                });
            } else {
				$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
                });
                $('#loading').show();
                $.ajax({
                    url: "/admin/stones/update",
                    type: "POST",
                    dataType: "JSON",
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
                                confirmButtonText: '<?php echo e(__('lang.ok')); ?>',
                                cancelButtonText: '<?php echo e(__('lang.cancel')); ?>',
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            $('#addNewpageForm').find(".name_ar").val('');
                            $('#addNewpageForm').find(".name_en").val('');
                            $('#addNewpageForm').find(".status").val('');
                            $('.table_attachments').html('');
                            $('.images').val('');
                            $('#addNewpageForm').find(".details_ar").val('');
                            $('#addNewpageForm').find(".details_en").val('');
                            $('#addNewpageForm').find(".photo").val('');
                            $('.remove_images').val('');
                            $('#activeValue').bootstrapSwitch('state', true, true);
                            $('#show').bootstrapSwitch('state', true, true);
                            $('#addNewpageForm').find('.rowIdUpdate').val(0);
                            $("#add_page").modal('hide');
                            var url = $(this).attr('href');
                            getData(url);
                        } else {
                            swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: '<?php echo e(__('lang.ok')); ?>',
                                cancelButtonText: '<?php echo e(__('lang.cancel')); ?>',
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });

                        }
                    }
                });
            }
        });
        /****************************************************/
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
				confirmButtonText: "<?php echo e(__('lang.ok')); ?>",
				cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",
			}).then((result) => {
				if (result.value) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
                url: "/admin/stones/delete",
                type: "post",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
						Swal.fire(
                        data["data"],
						'',
						'success'
						)
						var url = $(this).attr('href');
						getData(url);
						window.history.pushState("", "", url); 
					}else{
						swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: '<?php echo e(__('lang.ok')); ?>',
                                cancelButtonText: '<?php echo e(__('lang.cancel')); ?>',
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
					}
                },
            });
				}
			})
    });


    var removes = [];
	$(document).on('click','.delete_image',function(e){
		var id = $(this).data('id');
        $this = $(this);
		Swal.fire({
				title: '<?php echo e(__('lang.are_you_sure')); ?>',
				text: "",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: "<?php echo e(__('lang.ok')); ?>",
				cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",
			}).then((result) => {
				if (result.value) {
                    removes.push(id);
                    $('.remove_images').val(removes); 
                    $($this).parent().parent().remove();
				
				}
			})
    });
    
//************************************************************************
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/stones/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title'); ?>
   لوحة التحكم
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style> 
    .edit_data .status_season{
        display:none !important;
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
										<a href="/admin/system_constants" class="m-nav__link">
											<span class="m-nav__link-text"><?php echo e(trans('lang.system_constants')); ?></span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">
             <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_system_constants')): ?>
				<button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
    			padding-bottom: 15px;"><i class="fa fa-plus"></i> <?php echo e(trans('lang.add_constant')); ?></button>
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
<?php echo e(trans('lang.system_constants')); ?>

</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
    <div class="form-group m-form__group row">
			<div class="col-md-3">
				<input type="text" name="user_name_seach"  class="form-control user_name_seach" placeholder="<?php echo e(trans('lang.name')); ?>">
		</div>
        <div class="col-md-3">
                            <div class="form-valid">
                                <select name="type" class="form-control type" id="">
                                    <option value=""><?php echo e(trans('lang.type')); ?></option>
                                    <?php $__currentLoopData = $data['all_constant']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $constant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($constant->value3); ?>"><?php echo e($constant->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
        </div>
	</div>
	<div id="table-container">
        <?php echo $__env->make('admin.system_constants.table-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>

	</div>
</div>
</div>
</div>
</div>
</div>

<?php echo $__env->make('admin.system_constants.sub.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    $('#activeValue').bootstrapSwitch('state', false, true);

/********************************************************************************************************/
$('.user_name_seach').on('input',function(e){
    name =  $('.user_name_seach').val();
    if(name.length >= 3 || name == ''){
        var type = $('.type').val();
        var url = $(this).attr('href');
        getData(url,name,type);
    }
});

$('.type').on('change',function(e){
    name =  $('.user_name_seach').val();
    var type = $('.type').val();
    var url = $(this).attr('href');
    getData(url,name,type);
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
            $.ajax({
            	url: "/admin/system_constants/UpdateStats",
                type: "POST",
                dataType: "JSON",
                data:{id:id},
                success: function(data) {
                    if(data["status"] == true){
						var url = $(this).attr('href');
						getData(url);
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
                }
            });
            $(thisTag).removeClass('disabled');
            $('.loadImg').addClass('hidden');
        });
</script>

<script>
$(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            name =  $('.user_name_seach').val();
            var type = $('.type').val();
            getData(url,name,type);
        });
  
    function getData(url,name,type) {
        $('#load').show();
        name =  $('.user_name_seach').val();
        type = $('.type').val();
        $.ajax({
            url : url,
            data:{name:name,type:type}
        }).done(function (data) {
            $("#table-container").empty().html(data);
            $('#load').hide();
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        /*************************************************/
        $(document).on('click', '.btnAddCustomer', function () {
            $('#addNewpageForm').removeClass('edit_data');
			$('#addNewpageForm').find(".name_ar,.name_en,.type_constant").val('');
			$('#addNewpageForm').find("select").val('');
			$('#addNewpageForm').find("textarea").val('');
            $('#addNewpageForm').find('.rowIdUpdate').val(0);
            $("#add_page").removeClass('edit_data');
            $('.table_attachments').html('');
            $('.modal-title').html('<?php echo e(__('lang.add_data')); ?>');
        });

/*****************************************************************/
        $(document).on('click', '.updateDetails', function () {
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
            $('#addNewpageForm').addClass('edit_data');
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/system_constants/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
                        $(".name_ar").val(data['data']['name_ar']);
                        $(".name_en").val(data['data']['name_en']);
                        $(".type_constant").val(data['data']['type']);
                     
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
			var formData = new FormData(this);
            $('.loader_add_user').css('display', 'initial');
            setTimeout(function () {
                $('.btn_save_customer').removeClass('disabled');
                $('.loader_add_user').css('display', 'none');
            }, 30000);
            var id = $(".rowIdUpdate").val();
            $('#loading').show();
            if (id == 0) {
                $.ajax({
                    url: "/admin/system_constants/add",
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
                            var url = $(this).attr('href');
                            getData(url);
                            $('#addNewpageForm').find(".status").val('');
                            $('#addNewpageForm').find(".name").val('');
                            $('.table_attachments').html('');
                            $('#addNewpageForm').find(".type_constant").val('');
                            $('#addNewpageForm').find(".year").val('');
                            $("#add_page").modal("hide");
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
            } else {
				$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $.ajax({
                    url: "/admin/system_constants/update",
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
                                confirmButtonText: "<?php echo e(__('lang.ok')); ?>",
                                cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
							var url = $(this).attr('href');
                            getData(url);
                            $('#addNewpageForm').find(".status").val('');
                            $('#addNewpageForm').find(".name").val('');
                            $('#addNewpageForm').find(".type_constant").val('');
                            $('#addNewpageForm').find(".year").val('');
                            $('.table_attachments').html('');
							$('#addNewpageForm').find('.rowIdUpdate').val(0);
                            $("#add_page").modal("hide");
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
            }
//	}
        });
        /****************************************************/
    });
/**************************************************************************************************************************/
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
				cancelButtonText: '<?php echo e(__('lang.cancel')); ?>',
			}).then((result) => {
				if (result.value) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
                url: "/admin/system_constants/delete",
                type: "post",
                data:{id:id},
                dataType: "JSON",
                success: function(data){
					if(data['status'] == true){
						Swal.fire(
						data['data'],
						'',
						'success'
						)
						var url = $(this).attr('href');
						getData(url);
					}else{
						swal({
                                title: "",
                                text: data['data'],
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
/************************************************************************** */
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/fadymondy/Sites/yagot/resources/views/admin/system_constants/index.blade.php ENDPATH**/ ?>
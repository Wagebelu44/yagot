
<?php $__env->startSection('title'); ?>
   لوحة التحكم
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .div_select{
            display:none;
        }

        @media (min-width: 992px){
#add_slider .modal-lg {
    max-width: 1100px;
}}
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
										<a href="/admin/slider" class="m-nav__link">
											<span class="m-nav__link-text"><?php echo e(trans('lang.slider')); ?></span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_slider')): ?>
				<button type="button"  data-toggle="modal" data-target="#add_parent" class="btn btn-danger m-btn m-btn--custom btnAddParent" style="line-height: 15px;
    			padding-bottom: 15px;"><i class="fa fa-plus"></i> <?php echo e(trans('lang.add_slider')); ?></button>
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
<?php echo e(trans('lang.slider')); ?>

</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
	<div id="table-container">
        <?php echo $__env->make('admin.slider.table-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>

	</div>
</div>
</div>
</div>
</div>
</div>

<?php echo $__env->make('admin.slider.sub.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="/admin/assets/select_with_ajax/js/ajax-bootstrap-select.js"></script>
<script src="/admin/assets/app/js/search.js"></script>
<script type="text/javascript">

$('#activeValue').bootstrapSwitch('state', false, true);

function CKupdate(){
	for ( instance in CKEDITOR.instances )
		CKEDITOR.instances[instance].updateElement();
}


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
            	url: "/admin/slider/UpdateStats",
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
$(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            getData(url);
            window.history.pushState("", "", url);
        });
  
    function getData(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $("#table-container").empty().html(data);
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {

        
        $(document).on('click', '.btnAddParent', function () {
			$('#addParentForm').find(".status").val('');
            $('#addParentForm').find(".title_ar").val('');
            $('#addParentForm').find(".title_en").val('');
            $('#addParentForm  .modal-title').html('<?php echo e(__('lang.add_data')); ?>');
            $('#addParentForm').find('.rowIdParent').val(0);
        });

        $('.addParentForm').on('submit', function(e){
            e.preventDefault();
            $('#add_parent #loading').show();
            var parent_id = $('.parent_id').val();
			var formData = new FormData(this);
            var id = $(".rowIdParent").val();
            if (id == 0) {
                $.ajax({
                    url: "/admin/slider/add_parent",
                    type: "post",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#add_parent  #loading').hide();
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
                            $('#addParentForm').find(".status").val('');
                            $('#addParentForm').find(".title_ar").val('');
                            $('#addParentForm').find(".title_en").val('');
                            $('#addParentForm  .modal-title').html('<?php echo e(__('lang.add_data')); ?>');
                            $('#addParentForm').find('.rowIdParent').val(0);
                            $('#add_parent').modal('hide');
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
                $('#add_parent  #loading').show();
                $.ajax({
                    url: "/admin/slider/update_parent",
                    type: "POST",
                    dataType: "JSON",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#add_parent  #loading').hide();
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
                            
                            $('#addParentForm').find(".status").val('');
                            $('#addParentForm').find(".title_ar").val('');
                            $('#addParentForm').find(".title_en").val('');
                            $('#addParentForm  .modal-title').html('<?php echo e(__('lang.add_data')); ?>');
                            $('#addParentForm').find('.rowIdParent').val(0);
                            $('#add_parent').modal('hide');
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

        $(document).on('click', '.updateDetailsParent', function () {
            $('#addParentForm').find(".title_ar").val('');
            $('#addParentForm').find(".title_en").val('');
            $('#addParentForm').find('.rowIdParent').val(0);
            var id = $(this).data('id');
            $('.rowIdParent').val(id);
            $.ajax({
                url: "/admin/slider/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
                        $('#addParentForm .title_ar').val(data['data']['title_ar']);
                        $('#addParentForm .title_en').val(data['data']['title_en']);
					}
                },
                complete: function () {
                    $('#add_parent').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                }
            });
            $('#add_parent .modal-title').html('<?php echo e(__('lang.edit_data')); ?>');

        });
        

        $(document).on('click','.deleteParent',function(e){
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
                url: "/admin/slider/delete_parent",
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

        /*************************************************/
        $(document).on('click', '.btnAddCustomer', function () {
			$('#addNewpageForm').find(".status").val('');
            $('#addNewpageForm').find(".photo").val('');
            $('#addNewpageForm').find(".url").val('');
            $('#addNewpageForm').find(".category").val('');
            $('#addNewpageForm .selectpicker').val('');
            $('.select_div').css('display','none');
            $('#addNewpageForm .selectpicker').selectpicker('refresh');
            $('#addNewpageForm').find(".type").val('');
            $('#addNewpageForm').find(".url").val('');
            $('#addNewpageForm  .modal-title').html('<?php echo e(__('lang.add_data')); ?>');
            $('#activeValue').bootstrapSwitch('state', true, true);
            $('#addNewpageForm').find('.rowIdUpdate').val(0);
        });
        
        /*************************************************/
        $(document).on('click', '.updateDetails', function () {
            $('#addNewpageForm').find(".status").val('');
            $('#addNewpageForm').find(".photo").val('');
            $('#addNewpageForm').find(".url").val('');
            $('#addNewpageForm').find(".category").val('');
            $('#addNewpageForm .selectpicker').val('');
            $('.select_div').css('display','none');
            $('#addNewpageForm .selectpicker').selectpicker('refresh');
            $('#addNewpageForm').find(".type").val('');
            $('#addNewpageForm').find(".url").val('');
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $('.div_select').css('display','none');
            $.ajax({
                url: "/admin/slider/edit",
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
                        $('.type').val(data['data']['type']);
                        if(data['data']['type'] == 1){
                            $('.url_div').css('display','block');
                            $('#addNewpageForm .url').val(data['data']['url']);
                        }
                        if(data['data']['type'] == 2){
                            $('.product_div').css('display','block');
                            var newOption = new Option(data['product']['title'], data['product']['id'], true, true);
                            $('#addNewpageForm #ajax-select').append(newOption).trigger('change');
                            $('#addNewpageForm #ajax-select').val(data['product']['id']).trigger('change');
                            $('#addNewpageForm .selectpicker').selectpicker('refresh');
                        }
                        if(data['data']['type'] == 3){
                            $('#addNewpageForm .category').val(data['data']['reference_id']);
                            $('.category_div').css('display','block');
                        }
                        $('#addNewpageForm').find(".url").val(data['data']['url']);
					}
                },
                complete: function () {
                    $('#add_page').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                }
            });
            $('#addNewpageForm .modal-title').html('<?php echo e(__('lang.edit_data')); ?>');

        });
        /*************************************************/
        $('.addNewpageForm').on('submit', function(e){
            e.preventDefault();
            $('#add_page #loading').show();
            var parent_id = $('.parent_id').val();
			var formData = new FormData(this);
            $('.loader_add_user').css('display', 'initial');
            setTimeout(function () {
                $('.btn_save_customer').removeClass('disabled');
                $('.loader_add_user').css('display', 'none');
            }, 30000);
            var id = $(".rowIdUpdate").val();
            if (id == 0) {
                $.ajax({
                    url: "/admin/slider/add",
                    type: "post",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#add_page  #loading').hide();
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
                            $('#addNewpageForm').find(".status").val('');
            $('#addNewpageForm').find(".photo").val('');
            $('#addNewpageForm').find(".url").val('');
            $('#addNewpageForm').find(".category").val('');
            $('#addNewpageForm .selectpicker').val('');
            $('.select_div').css('display','none');
            $('#addNewpageForm .selectpicker').selectpicker('refresh');
            $('#addNewpageForm').find(".type").val('');
            $('#addNewpageForm').find(".url").val('');
                            $('#add_page').modal('hide');
                            GetImages(parent_id);
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
                $('#add_page  #loading').show();
                $.ajax({
                    url: "/admin/slider/update",
                    type: "POST",
                    dataType: "JSON",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#add_page  #loading').hide();
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
                            $('#addNewpageForm').find(".status").val('');
            $('#addNewpageForm').find(".photo").val('');
            $('#addNewpageForm').find(".url").val('');
            $('#addNewpageForm').find(".category").val('');
            $('#addNewpageForm .selectpicker').val('');
            $('.select_div').css('display','none');
            $('#addNewpageForm .selectpicker').selectpicker('refresh');
            $('#addNewpageForm').find(".type").val('');
            $('#addNewpageForm').find(".url").val('');
                            $("#add_page").modal('hide');
                            GetImages(parent_id);
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
        var parent_id = $('.parent_id').val();
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
                url: "/admin/slider/delete",
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
						GetImages(parent_id);
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

</script>
<script>
    $('.type').on('change',function(e){
        var id = $(this).val();
        $('#addNewpageForm').find(".url").val('');
 $('#addNewpageForm').find(".category").val('');
$('#addNewpageForm .selectpicker').val('');
$('#addNewpageForm .selectpicker').selectpicker('refresh');
        $('.div_select').css('display','none');
        if(id == 1){
            $('.url_div').css('display','block');
        }else if(id == 2){
            $('.product_div').css('display','block');
        }else if(id == 3){
            $('.category_div').css('display','block');
        }
    });
</script>
<script>
    $(document).on('click','.AllImages',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('.parent_id').val(id);
        $.ajax({
                url: "/admin/slider/GetImages",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
						$('#add_slider .modal-body').html(data['data']);
					}
                },
                complete: function () {
                    $('#add_slider').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                }
            });

        

    });

    function GetImages(id){
        $('.parent_id').val(id);
        $.ajax({
                url: "/admin/slider/GetImages",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
						$('#add_slider .modal-body').html(data['data']);
					}
                },
                complete: function () {
                    
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                }
            });

        
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/slider/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title'); ?>

    <?php echo e(__('lang.control_panel')); ?>


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

										<a href="/admin/dashboard" class="m-nav__link">

											<span class="m-nav__link-text"><?php echo e(trans('lang.home')); ?></span>

										</a>

									</li>

									

									<li class="m-nav__separator">-</li>

									<li class="m-nav__item">

										<a href="/admin/subscriptions" class="m-nav__link">

											<span class="m-nav__link-text"><?php echo e(trans('lang.subscriptions')); ?></span>

										</a>

									</li>

								</ul>

							</div>



		<div class="m-demo__preview  m-demo__preview--btn">

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_subscriptions')): ?>

				<button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;

    			padding-bottom: 15px;"><i class="fa fa-plus"></i> إضافة باقة جديدة</button>

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

	<?php echo e(trans('lang.subscriptions')); ?>


</h3>

</div>

</div>

</div>

	<div class="m-portlet__body">

	<div id="table-container">

        <?php echo $__env->make('admin.subscriptions.table-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	</div>



	</div>

</div>

</div>

</div>

</div>

</div>



<?php echo $__env->make('admin.subscriptions.sub.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>

<script >



$('#activeValue').bootstrapSwitch('state', false, true);

/***********************************************************************************************************************/

        $('body').on('click','.UpdateStats',function(){

            $(this).addClass('disabled');

            $('.loadImg').removeClass('hidden');

            // $('.loadMSG').html('جاري تحديث الحالة');

            var thisTag = $(this);

            var id = $(this).data('id');

			$.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $.ajax({

            	url: "/admin/subscriptions/UpdateStats",

                type: "POST",

                dataType: "JSON",

                data:{id:id},

                success: function(data) {

                    if(data["status"] == true){

						var url = $(this).attr('href');

						getData(url);

						window.history.pushState("", "", url); 

                    }

                },

                complete:function(){

                    $(thisTag).removeClass('disabled');

                    $('.loadImg').addClass('hidden');

                }

            });

            

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

<script >

    $(document).ready(function () {

        

// CKEDITOR.replace('details');

        /*************************************************/

        $(document).on('click', '.btnAddCustomer', function () {

            $('.modal-title').html("<?php echo e(trans('lang.add_subscriptions')); ?>");
			$('#addNewpageForm').find(".name_ar").val('');
            $('#addNewpageForm').find(".name_en").val('');
            $('#addNewpageForm').find(".number_products").val('');
            $('#addNewpageForm').find(".number_days").val('');
			$('#addNewpageForm').find(".price").val('');
            $('#addNewpageForm').find(".number_slider").val('');
            $('#addNewpageForm').find(".numbers").css('display','none');
			$('#addNewpageForm').find(".timeplan").val('');
            $('.all_tplan').prop('checked',false);
            $('#addNewpageForm').find(".order_no").val('');


            $('#addNewpageForm').find('.rowIdUpdate').val(0);

        });

        

        /*************************************************/

        $(document).on('click', '.updateDetails', function () {
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/subscriptions/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
                        // all_terms
                        $('#addNewpageForm').find(".numbers").css('display','none');
                        
                        $('.modal-title').html("<?php echo e(trans('lang.edit_data')); ?>");
                        $(".name_en").val(data['data']['name_en']);
                        $('#addNewpageForm').find(".name_ar").val(data['data']['name_ar']);
                        $('#addNewpageForm').find(".price").val(data['data']['price']);
                        $('#addNewpageForm').find(".number_products").val(data['data']['number_products']);
                        $('#addNewpageForm').find(".all_plans_check").html(data['options']);
                        
                        if(data['data']['number_products']){
                            $('#addNewpageForm').find(".number_products").val(data['data']['number_products']);
                            $('#addNewpageForm').find(".products_div").css('display','block');
                        }
                        if(data['data']['number_slider']){
                            $('#addNewpageForm').find(".number_slider").val(data['data']['number_slider']);
                            $('#addNewpageForm').find(".slider_div").css('display','block');
                        }
                        if(data['data']['number_days']){
                            $('#addNewpageForm').find(".number_days").val(data['data']['number_days']);
                            $('#addNewpageForm').find(".days_div").css('display','block');
                        }
					}
                },
                complete: function () {
                    $('#add_page').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: '<?php echo e(__('lang.update_fail')); ?>', type: "error"});
                }
            });
            $('.modal-title').html('<?php echo e(__('lang.edit_data')); ?>');
            $('.btn_save_user').html('<?php echo e(__('lang.edit')); ?>');
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

            var id = $(".rowIdUpdate").val();

            if (id == 0) {

                $.ajax({

                    url: "/admin/subscriptions/add",

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

                                text: "<?php echo e(__('lang.save_success')); ?>",

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

                            $('#addNewpageForm').find(".name_ar").val('');
            $('#addNewpageForm').find(".name_en").val('');
            $('#addNewpageForm').find(".number_products").val('');
            $('#addNewpageForm').find(".number_days").val('');
            $('#addNewpageForm').find(".number_slider").val('');
            $('#addNewpageForm').find(".numbers").css('display','none');
            
			$('#addNewpageForm').find(".price").val('');
            $('#addNewpageForm').find('.rowIdUpdate').val(0);
                            $("#add_page").modal("hide");

                        } else {

                            var errorMessage = "";

                            for (const error in data["data"]) {

                                if (data["data"].hasOwnProperty(error)) {

                                    errorMessage += '<p>'+data["data"][error]+'</p>';

                                }

                            }

                            swal({

                                title: "",

                                html: errorMessage,

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

                    url: "/admin/subscriptions/update",

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

                                text: "<?php echo e(__('lang.update_success')); ?>",

                                type: "success",

                                showCancelButton: false,

                                confirmButtonColor: "#DD6B55",

                                confirmButtonText: "<?php echo e(__('lang.ok')); ?>",

                                cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",

                                closeOnConfirm: true,

                                closeOnCancel: true

                            });

                            
                            $('#addNewpageForm').find(".name_ar").val('');
            $('#addNewpageForm').find(".name_en").val('');
            $('#addNewpageForm').find(".number_products").val('');
            $('#addNewpageForm').find(".number_days").val('');
			$('#addNewpageForm').find(".price").val('');
            $('#addNewpageForm').find(".number_slider").val('');
            $('#addNewpageForm').find(".numbers").css('display','none');
            $('#addNewpageForm').find('.rowIdUpdate').val(0);

                            $("#add_page").modal("hide");

                            var url = $(this).attr('href');

                            getData(url);

                            // window.history.pushState("", "", url); 

                        } else {

                            var errorMessage = "";

                            

                            for (const error in data["data"]) {

                                if (data["data"].hasOwnProperty(error)) {

                                    errorMessage += '<p>'+data["data"][error]+'</p>';

                                }

                            }

                            swal({

                                title: "",

                                html:errorMessage ,

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



	$(document).on('click','.delete',function(e){

		var id = $(this).data('id');

		Swal.fire({

				title: "<?php echo e(__('lang.are_you_sure')); ?>",

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

                url: "/admin/subscriptions/delete",

                type: "post",

                dataType: "JSON",

                data: {

                    id: id

                },

                success: function(data){

					if(data['status'] == true){

						Swal.fire(

                            "<?php echo e(__('lang.success')); ?>",

						'',

						'success'

						)

						var url = $(this).attr('href');

						getData(url);

						window.history.pushState("", "", url); 

					}else{

						swal({

                                title: "",

                                text: "<?php echo e(__('lang.delete_fail')); ?>",

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
<script>

    $(document).on('change','.all_tplan',function(e){
        $this = $(this);
        id = $this.val();
        if(id == 1 || id == 2 || id == 3){
            if(id == 1){
                if($this.prop('checked')){
                    $('.slider_div').css('display','block');
                }else{
                    $('.slider_div').css('display','none');
                }
                $('.number_slider').val('');
            }
            if(id == 2){
                if($this.prop('checked')){
                    $('.products_div').css('display','block');
                }else{
                    $('.products_div').css('display','none');
                }
                $('.number_products').val('');
            }
            if(id == 3){
                if($this.prop('checked')){
                    $('.days_div').css('display','block');
                }else{
                    $('.days_div').css('display','none');
                }
                $('.number_days').val('');

               
            }
        }
    });

days_div
products_div
slider_div
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/fadymondy/Sites/yagot/resources/views/admin/subscriptions/index.blade.php ENDPATH**/ ?>
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

											<span class="m-nav__link-text"><?php echo e(__('lang.home')); ?></span>

										</a>

									</li>

									

									<li class="m-nav__separator">-</li>

									<li class="m-nav__item">

										<a href="/admin/clients" class="m-nav__link">

											<span class="m-nav__link-text">العملاء</span>

										</a>

									</li>

								</ul>

							</div>



		<div class="m-demo__preview  m-demo__preview--btn">

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_clients')): ?>

				<button type="button"  data-toggle="modal" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;

    			padding-bottom: 15px;"><i class="fa fa-plus"></i> إضافة عميل </button>

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

	العملاء

</h3>

</div>

</div>

</div>

	<div class="m-portlet__body">

        <div class="form-group m-form__group row">

			<div class="col-md">

				<input type="text" name="name_search "  class="form-control name_search filter" placeholder="الاسم">

            </div>

            <div class="col-md">

				<input type="text" name="phone_search "  class="form-control phone_search filter" placeholder="رقم الجوال">

            </div>

            <div class="col-md">

				<input type="text" name="email_search "  class="form-control email_search filter" placeholder="الايميل">

            </div>

			<div class="col-md">
                <select
                name="zone_serach"
                class="zone_search filter form-control" data-live-search="true"
              >
                <option value="" >اختر المنطقة</option>
                <?php $__currentLoopData = $data['zones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                  value="<?php echo e($zone['id']); ?>"
                  ><?php echo e($zone['name']); ?></option
                >
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </select>

            </div>

            
            <div class="col-md">

                <select name="type_search" class="type_search filter form-control">
                <option value=""  > اختر النوع </option>
                <option value="1">هاوي </option>
                <option value="2">شركة </option>
                <option value="3">عميل </option>
              </select>

            </div>

            



	</div>

	<div id="table-container">

        <?php echo $__env->make('admin.clients.table-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	</div>



	</div>

</div>

</div>

</div>

</div>

</div>



<?php echo $__env->make('admin.clients.sub.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.layout.details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>

<script type="text/javascript">



$('#status').bootstrapSwitch('state', false, true);





function CKupdate(){

	for ( instance in CKEDITOR.instances )

		CKEDITOR.instances[instance].updateElement();

}



/***********************************************************************************************************************/
        $('body').on('click','.UpdateStats',function(){
            $(this).addClass('disabled');
            $('.loadImg').removeClass('hidden');
            var thisTag = $(this);
            var id = $(this).data('id');
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            	url: "/admin/clients/UpdateStats",
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



        $(document).on('input',".filter",function (e) { 

            e.preventDefault();

            getData();

        });

  

    function getData(url) {

        $('#load').show();
        $.ajax({

            url : url,

            data:{

                name:$(".name_search").val(),

                email:$(".email_search").val(),

                phone:$(".phone_search").val(),

                zone:$(".zone_search").val(),

                city:$(".city_search").val(),

                list:$(".list_search").val(),

                type_search:$(".type_search").val(),


            }

        }).done(function (data) {
            $('#load').hide();
            $("#table-container").empty().html(data);

        });

    }

</script>

<script type="text/javascript">

    $(document).ready(function () {


        $(document).on('click','.showDetails',function(){
        const id = $(this).data('id');
        const url = $(this).data('url');
             $.get(url, null,
                function (data, textStatus, jqXHR) {
                    $("#details_page").find('.modal-lg').removeClass('modal-lg');
                    $("#details_page").find('.modal-dialog').addClass('modal-lg');
                    $("#details_page").find('.modal-body').html(data.data);
                    $("#details_page").modal('show');
                }
            );
        });
        
        $(document).on('click','.poet',function(){
        const id = $(this).data('id');
        const url = $(this).data('url');
             $.get(url, null,
                function (data, textStatus, jqXHR) {
                        $("#details_page").find('.modal-body').html(data.data);
                        $("#details_page").find('.modal-lg').removeClass('modal-lg');
                        $("#details_page").modal('show');
                }
            );
        });

        $(document).on('click','.birthday',function(){
        const id = $(this).data('id');
        const url = $(this).data('url');
             $.get(url, null,
                function (data, textStatus, jqXHR) {
                        $("#details_page").find('.modal-body').html(data.data);
                        $("#details_page").find('.modal-lg').removeClass('modal-lg');
                        $("#details_page").modal('show');
                }
            );
        });
        

    // CKEDITOR.replace('details');

        /*************************************************/

        $(document).on('click', '.btnAddCustomer', function () {

            $('.modal-title').html(' إضافة عميل جديد ');
            $("#add_page").find('.fname').val('');
            $("#add_page").find('.lname').val('');

            $('.attachments').css('display','none');
            $('.commercial_photo').val('');
            $('.passport').val('');
            $('.identity').val('');

            $("#add_page").find('.zone').val('');
            $("#add_page").find('.city').val('');
            $("#add_page").find('.email').val('');
            $("#add_page").find('.mobile').val('');
            $("#add_page").find('.password').val('');
            $('.table_attachments').html('');
            $("#add_page").find('.cpassword').val('');
            $("#add_page").find('.type').val('');
            $('#addNewpageForm .type_poet').addClass('d-none');                            
            $('.poet_type').prop('checked',false);

            $("#add_page").find('.image').val('');
            $('#addNewpageForm .img_review').addClass('d-none');
            $('#add_page #addNewpageForm').find('.rowIdUpdate').val(0);
            $("#add_page").modal('show');

            
        });

        

        /*************************************************/

        $(document).on('click', '.updateDetails', function () {
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/clients/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
                        $('#addNewpageForm').find(".type").val(data['data']['type']);
                        $('#addNewpageForm').find(".fname").val(data['data']['name']);
                        $('#addNewpageForm').find(".zone").val(data['data']['zone_id']);
                        $('#addNewpageForm').find(".email").val(data['data']['email']);
                        $('#addNewpageForm').find(".mobile").val(data['data']['mobile']);
                        $('#addNewpageForm').find(".country_code").val(data['data']['country_code']);
                        $('#addNewpageForm .img_review ').removeClass('d-none');
                        $('#addNewpageForm .img_review img').attr('src',data['data']['image']);
                        $('.table_attachments').html(data['html']);
                        $('.attachments').css('display','none');
                        if(data['data']['type'] == 1){
                            $('.passport').css('display','block');
                            $('.identity').css('display','block');
                        }else if(data['data']['type'] == 2){
                            $('.commercial_photo').css('display','block');
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

            CKupdate();

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

                    url: "/admin/clients/add",

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
                                text: data['data'],
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
                            $("#add_page").find('.fname').val('');
                            $("#add_page").find('.lname').val('');
                            $("#add_page").find('.zone').val('');
                            $("#add_page").find('.city').val('');
                            $("#add_page").find('.email').val('');
                            $("#add_page").find('.mobile').val('');
                            $("#add_page").find('.password').val('');
                            $("#add_page").find('.cpassword').val('');
                            $("#add_page").find('.image').val('');
                            $("#add_page").find('.type').val('');
                            $('.table_attachments').html('');
                            $('.attachments').css('display','none');
                            $('.commercial_photo').val('');
                            $('.passport').val('');
                            $('.identity').val('');
                            $('#addNewpageForm .type_poet').addClass('d-none');                            
                            $('.poet_type').prop('checked',false);
                            $('#addNewpageForm .img_review').addClass('d-none');

                            $('#add_page #addNewpageForm').find('.rowIdUpdate').val(0);
                            $("#add_page").modal("hide");

                        } else {
                            swalError(data.data);
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

                    url: "/admin/clients/update",

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
                                text: data['data'],
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "<?php echo e(__('lang.ok')); ?>",
                                cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });

                            $("#add_page").find('.fname').val('');
                            $("#add_page").find('.lname').val('');
                            $("#add_page").find('.zone').val('');
                            $("#add_page").find('.city').val('');
                            $("#add_page").find('.email').val('');
                            $("#add_page").find('.mobile').val('');
                            $('.table_attachments').html('');
                            $("#add_page").find('.password').val('');
                            $("#add_page").find('.cpassword').val('');
                            $("#add_page").find('.image').val('');
                            $("#add_page").find('.type').val('');
                            $('.attachments').css('display','none');
                            $('.commercial_photo').val('');
                            $('.passport').val('');
                            $('.identity').val('');
                            $('#addNewpageForm .type_poet').addClass('d-none');                            
                            $('.poet_type').prop('checked',false);
                            $('#addNewpageForm .img_review').addClass('d-none');
                            $('#add_page #addNewpageForm').find('.rowIdUpdate').val(0);
                            $("#add_page").modal("hide");

                            var url = $(this).attr('href');
                            getData(url);


                        } else {

                            swalError(data.data);

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

                url: "/admin/clients/delete",

                type: "post",

                dataType: "JSON",

                data: {

                    id: id

                },

                success: function(data){

					if(data['status'] == true){

                        swal({
                                title: "",
                                text: data['data'],
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

						window.history.pushState("", "", url); 

					}else{

                        swal({
                                title: "",
                                html: data.data,
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "<?php echo e(__('lang.ok')); ?>",
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
            $('.attachments').css('display','none');
            $('.passport').val('');
            $('.identity').val('');
            $('.commercial_photo').val('');
            if(id == 1){
                $('.passport').css('display','block');
                $('.identity').css('display','block');
            }else if(id == 2){
                $('.commercial_photo').css('display','block');
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/fadymondy/Sites/yagot/resources/views/admin/clients/index.blade.php ENDPATH**/ ?>
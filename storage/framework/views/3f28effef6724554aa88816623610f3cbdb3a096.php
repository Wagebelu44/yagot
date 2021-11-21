
<?php $__env->startSection('title'); ?>
   لوحة التحكم
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    #terms_modal .modal-dialog{
				max-width: initial;
				width: 95vw;
    }
    @media (min-width: 992px){
            .modal-lg {
                max-width: 1300px;
            }
        }
        .btn.btn-warning:hover:not(:disabled) {
    color: #fff !important;
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
										<a href="/admin/banks_transfer" class="m-nav__link">
											<span class="m-nav__link-text"><?php echo e(trans('lang.banks_transfer')); ?></span>
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
<?php echo e(trans('lang.banks_transfer')); ?>

</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
	<div id="table-container">
        <?php echo $__env->make('admin.transfer.table-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>

	</div>
</div>
</div>
</div>
</div>
</div>
<?php echo $__env->make('admin.transfer.sub.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">

$('#activeValue').bootstrapSwitch('state', false, true);
$('#show').bootstrapSwitch('state', false, true);

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
            	url: "/admin/transfer/UpdateStats",
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
        $.ajax({
            url : url
        }).done(function (data) {
            $("#table-container").empty().html(data);
        });
    }

    function getTermData(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $("#terms_table_container").empty().html(data);
            $.each($('.updateDetailsTerm'), function (indexInArray, valueOfElement) { 
                    $(this).removeClass('btn-warning');
                    $(this).addClass('btn-accent');
            });
            $('#addTermForm').find('.rowIdUpdate').val(0);
            $("#addTermForm .text_ar").val('');
            $("#addTermForm .text_en").val('');
        });
    }
</script>
<script type="text/javascript">
        /*************************************************/
        $(document).on('click', '.details',function(event)
        {
            var id = $(this).data('id');
            $.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
                url: "/admin/banks_transfer/details",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },success: function(data){
                        
                        $('#details #table-container').html(data['data']);                 
                        $('#details').modal('show');           
                },complete:function () {                                        
                        $('#details').modal('show'); 
                },

                })
        });
</script>
<script type="text/javascript">
        /*************************************************/
        $(document).on('click', '.yes',function(event)
        {
            var id = $(this).data('id');
            var status = 1;
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
                 $('#load').show();
				$.ajax({
                url: "/admin/banks_transfer/status_transfer",
                type: "post",
                dataType: "JSON",
                data: {
                    id: id,status:status
                },success: function(data){
                    $('#load').hide();
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
                }

                })
                }
			})

           
        });
</script>
<script type="text/javascript">
        /*************************************************/
        $(document).on('click', '.no',function(event)
        {
            var id = $(this).data('id');
            var status = 2;
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
                $('#load').show();
				$.ajax({
                url: "/admin/banks_transfer/status_transfer",
                type: "post",
                dataType: "JSON",
                data: {
                    id: id,status:status
                },success: function(data){
                    $('#load').hide();
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
                }

                })
                }
			})

        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/transfer/index.blade.php ENDPATH**/ ?>
@extends('admin.layout.master_layout')
@section('title')
   لوحة التحكم
@stop

@section('css')
<style>
    #terms_modal .modal-dialog{
				max-width: initial;
				width: 95vw;
    }
    </style>
@stop

@section('page-content')
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
											<span class="m-nav__link-text">{{trans('lang.home')}}</span>
										</a>
									</li>
									
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="/admin/category" class="m-nav__link">
											<span class="m-nav__link-text">{{trans('lang.category')}}</span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">
            @can('add_categorys') 
				<button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
                padding-bottom: 15px;"><i class="fa fa-plus"></i> {{trans('lang.add_category')}}</button>
              @endcan
           
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
{{trans('lang.category')}}
</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
	<div id="table-container">
        @include('admin.category.table-data')
	</div>

	</div>
</div>
</div>
</div>
</div>
</div>

@include('admin.category.sub.add')
@stop   

@section('js')
<script type="text/javascript">

$('#activeValue').bootstrapSwitch('state', false, true);
$('#show').bootstrapSwitch('state', false, true);


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
            	url: "/admin/category/UpdateStats",
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
    $(document).ready(function () {
        /*************************************************/
        $(document).on('click', '.btnAddCustomer', function () {
			$('#addNewpageForm').find(".name_ar").val('');
            $('#addNewpageForm').find(".name_en").val('');
			$('#addNewpageForm').find(".status").val('');
            $('#addNewpageForm').find(".service1").prop('checked', false);
            $('#addNewpageForm').find(".service-1").prop('checked', false);
            $('#addNewpageForm').find(".service2").prop('checked', false);
            $('.modal-title').html('{{__('lang.add_data')}}');
            $('#activeValue').bootstrapSwitch('state', true, true);
            $('#show').bootstrapSwitch('state', true, true);
            $('#addNewpageForm').find('.rowIdUpdate').val(0);
        });

        $(document).on('click', '.btnTerms', function () {
			$('#addTermForm').find(".text_ar").val('');
            $('#addTermForm').find(".text_en").val('');
			$('#addTermForm').find(".status").val('');
            $('#addTermForm').find(".service1").prop('checked', false);
            $('#addTermForm').find(".service-1").prop('checked', false);
            $('#addTermForm').find(".service2").prop('checked', false);
            $('#activeValue').bootstrapSwitch('state', true, true);
            $('#show').bootstrapSwitch('state', true, true);
            $('#addTermForm').find('.rowIdUpdate').val(0);
        });
        
        /*************************************************/
        $(document).on('click', '.updateDetails', function () {
			$('#addNewpageForm').find('.addNewpageForm .rowIdUpdate').val(0);
            var id = $(this).data('id');
            $('.addNewpageForm .rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/category/edit",
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

                        $.each(data['data']['services'], function(index, value) {
                            if(value['service_id'] == 1){
                                $('#addNewpageForm').find(".service1").prop('checked', true);
                            }else{
                                $('#addNewpageForm').find(".service1").prop('checked', false);
                            }
                            if(value['service_id'] == 2){
                                $('#addNewpageForm').find(".service2").prop('checked', true);
                            }else{
                                $('#addNewpageForm').find(".service2").prop('checked', false);
                            }
                            if(value['service_id'] == -1){
                                $('#addNewpageForm').find(".service-1").prop('checked', true);
                            }else{
                                $('#addNewpageForm').find(".service-1").prop('checked', false);
                            }
                            

                        });
					}
                },
                complete: function () {
                    $('#add_page').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                }
            });
            $('.modal-title').html('{{__('lang.edit_data')}}');

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
                    url: "/admin/category/add",
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
                                confirmButtonText: '{{__('lang.ok')}}',
                                cancelButtonText: '{{__('lang.cancel')}}',
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            $('#addNewpageForm').find(".name_ar").val('');
                            $('#addNewpageForm').find(".name_en").val('');
                            $('#addNewpageForm').find(".status").val('');
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
                                confirmButtonText: '{{__('lang.ok')}}',
                                cancelButtonText: '{{__('lang.cancel')}}',
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
                    url: "/admin/category/update",
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
                                confirmButtonText: '{{__('lang.ok')}}',
                                cancelButtonText: '{{__('lang.cancel')}}',
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            $('#addNewpageForm').find(".name_ar").val('');
                            $('#addNewpageForm').find(".name_en").val('');
                            $('#addNewpageForm').find(".status").val('');
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
                                confirmButtonText: '{{__('lang.ok')}}',
                                cancelButtonText: '{{__('lang.cancel')}}',
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
				title: '{{__('lang.are_you_sure')}}',
				text: "",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: "{{__('lang.ok')}}",
				cancelButtonText: "{{__('lang.cancel')}}",
			}).then((result) => {
				if (result.value) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
                url: "/admin/category/delete",
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
                                confirmButtonText: '{{__('lang.ok')}}',
                                cancelButtonText: '{{__('lang.cancel')}}',
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
					}
                },
            });
				}
			})
    });


//************************************************************************
</script>
@stop
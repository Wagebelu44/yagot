@extends('admin.layout.master_layout')
@section('title')
   لوحة التحكم
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
										<a href="/admin/static_page" class="m-nav__link">
											<span class="m-nav__link-text">{{trans('lang.static_page')}}</span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">
                @can('add_page')
				<button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
    			padding-bottom: 15px;"><i class="fa fa-plus"></i> {{trans('lang.add_page')}}</button>
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
    {{trans('lang.static_page')}}   
</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
	<div id="table-container">
        @include('admin.static_page.table-data')
	</div>

	</div>
</div>
</div>
</div>
</div>
</div>

@include('admin.static_page.sub.add')
@stop

@section('js')
<script type="text/javascript">

$('#activeValue').bootstrapSwitch('state', false, true);

function CKupdate(){
	for ( instance in CKEDITOR.instances )
		CKEDITOR.instances[instance].updateElement();
}

/***********************************************************************************************************************/
        $('body').on('click','.UpdateStats',function(){
            $(this).addClass('disabled');
            // $('.loadImg').removeClass('hidden');
            // $('.loadMSG').html('جاري تحديث الحالة');
            var thisTag = $(this);
            var id = $(this).data('id');
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#load').show();
            $.ajax({
            	url: "/admin/static_page/UpdateStats",
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
        /*************************************************/
        $(document).on('click', '.btnAddCustomer', function () {
			CKEDITOR.instances['details_ar'].setData('');
            CKEDITOR.instances['details_en'].setData('');
			$('#addNewpageForm').find(".slug").val('');
			$('#addNewpageForm').find(".title_ar").val('');
            $('#addNewpageForm').find(".details_en").val('');
			$('#addNewpageForm').find(".title_en").val('');
			$('#addNewpageForm').find(".image").val('');
            $('#addNewpageForm').find('.rowIdUpdate').val(0);
        });
        
        /*************************************************/
        $(document).on('click', '.updateDetails', function () {
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/static_page/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
						$(".title_ar").val(data['data']['title_ar']);
                        $(".title_en").val(data['data']['title_en']);
						CKEDITOR.instances['details_ar'].setData(data['data']['details_ar']);
                        CKEDITOR.instances['details_en'].setData(data['data']['details_en']);
						if(data['data']['status'] == 1){
							$('#activeValue').bootstrapSwitch('state', true, true);
						}else{
							$('#activeValue').bootstrapSwitch('state', false, true);
						}
						$(".slug").val(data['data']['slug']);
					}
                },
                complete: function () {
                    $('#add_page').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                }
            });


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
                    url: "/admin/static_page/add",
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
                                confirmButtonText: "{{__('lang.ok')}}",
                                cancelButtonText: "{{__('lang.cancel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            var url = $(this).attr('href');
                            getData(url);
                            // window.history.pushState("", "", url); 
                            CKEDITOR.instances['details_ar'].setData('');
                            CKEDITOR.instances['details_en'].setData('');
                            $('#addNewpageForm').find(".slug").val('');
                            $('#addNewpageForm').find(".title_ar").val('');
                            $('#addNewpageForm').find(".details_en").val('');
                            $('#addNewpageForm').find(".title_en").val('');
                            $('#addNewpageForm').find(".image").val('');
                            $('#addNewpageForm').find('.rowIdUpdate').val(0);
                            $("#add_page").modal("hide");
                        } else {
                            swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{__('lang.ok')}}",
                                cancelButtonText: "{{__('lang.cancel')}}",
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
                    url: "/admin/static_page/update",
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
                                confirmButtonText: "{{__('lang.ok')}}",
                                cancelButtonText: "{{__('lang.cancel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            CKEDITOR.instances['details_ar'].setData('');
                            CKEDITOR.instances['details_en'].setData('');
                            $('#addNewpageForm').find(".slug").val('');
                            $('#addNewpageForm').find(".title_ar").val('');
                            $('#addNewpageForm').find(".details_en").val('');
                            $('#addNewpageForm').find(".title_en").val('');
                            $('#addNewpageForm').find(".image").val('');
                            $('#addNewpageForm').find('.rowIdUpdate').val(0);
                            $("#add_page").modal("hide");
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
                                confirmButtonText: "{{__('lang.ok')}}",
                                cancelButtonText: "{{__('lang.cancel')}}",
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
				title: "{{__('lang.are_you_sure')}}",
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
                url: "/admin/static_page/delete",
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
						// window.history.pushState("", "", url); 
					}else{
						swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{__('lang.ok')}}",
                                cancelButtonText: "{{__('lang.cancel')}}",
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
@stop
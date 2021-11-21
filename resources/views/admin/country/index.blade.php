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
										<a href="/admin/counrty" class="m-nav__link">
											<span class="m-nav__link-text">الدول</span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">
{{--  --}}
                {{-- @can('add_zones') --}}
				<button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
    			padding-bottom: 15px;"><i class="fa fa-plus"></i> إضافة دولة</button>
                {{-- @endcan --}}
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
الدولة
</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
	<div id="table-container">
        @include('admin.country.table-data')
	</div>

	</div>
</div>
</div>
</div>
</div>
</div>
@include('admin.country.sub.add')

@stop

@section('js')
<script type="text/javascript">


$('#activeValue').bootstrapSwitch('state', false, true);

/***********************************************************************************************************************/
        $('body').on('click','.UpdateStats',function(){
            $(this).addClass('disabled');
            $('.loadImg').removeClass('hidden');
            $('.loadMSG').html('جاري تحديث الحالة');
            var thisTag = $(this);
            var id = $(this).data('id');
            var parent=$(this).data('parent');
            $('#load').show();
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            	url: "/admin/country/UpdateStats",
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
        /*************************************************/
        $(document).on('click', '.btnAddCustomer', function () {
			      $('#addNewpageForm').find(".name_ar").val('');
		     	  $('#addNewpageForm').find(".name_en").val('');
            $('#addNewpageForm').find('.country_code').val(''); 
            $('#addNewpageForm').find('.rowIdUpdate').val(0); 
            $('#add_page .modal-title').html("{{__('lang.add_data')}}");
        });
      
        
        /*************************************************/
        $(document).on('click', '.updateDetailssub', function () {
			      $('#addNewpageForm').find('.rowIdUpdate').val(0);
            $('#addNewpageForm').find('.parent_id').val(''); 
            $(".country_div").addClass('d-none');
            $(".parent_div").addClass('d-none');
            $(".parent_id").val('');
            $(".country_id").val('');
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/country/edit",
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
                        $(".rowIdUpdate").val(data['data']['id']);
                        $(".name_ar").val(data['data']['name_ar']);
                        $(".name_en").val(data['data']['name_en']);
                        $(".country_code").val(data['data']['value2']);
                 
					}
                },
                complete: function () {
                    $('#add_page').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                }
            });

            $('#add_page .modal-title').html("{{__('lang.edit_data')}}");
            $('.btn_save_user').html('تعديل');

        });

        $(document).on('click', '.updateDetails', function () {
          var id = $(this).data('id');
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/country/edit",
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
                        $(".rowIdUpdate").val(data['data']['id']);
                        $(".name_ar").val(data['data']['name_ar']);
                        $(".name_en").val(data['data']['name_en']);
                        $(".country_code").val(data['data']['value2']);
					}
                },
                complete: function () {
                    $('#add_page').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                }
            });

            $('#add_page .modal-title').html("{{__('lang.edit_data')}}");
            $('.btn_save_user').html('تعديل');

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
          
            var sub_zone = $('.sub_zone').val();
            
            $('#loading').show();
            if (id == 0) {
                $.ajax({
                    url: "/admin/country/add",
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
                                confirmButtonText: "حسنا",
                                cancelButtonText: "الغاء",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            $('#addNewpageForm').find(".name_ar").val('');
                            $('#addNewpageForm').find(".name_en").val('');
                            $('#addNewpageForm').find('.country_code').val(''); 
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
                $('#loading').show();
                $.ajax({
                    url: "/admin/country/update",
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
                            $('#addNewpageForm').find(".name_ar").val('');
                            $('#addNewpageForm').find(".name_en").val('');
                            $('#addNewpageForm').find('.country_code').val(''); 
                    
                            $('#addNewpageForm').find('.rowIdUpdate').val(0);
                  
                                var url = $(this).attr('href');
                                getData(url);
                            
                            // window.history.pushState("", "", url); 
                       
                            $("#add_page").modal('hide');
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
        });
        /****************************************************/
    });

    $(document).on('click','.delete',function(e){
		    var id = $(this).data('id');
        var p = $(this).data('parent');


		Swal.fire({
				title: '{{__('lang.are_you_sure')}}',
				text: "",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '{{__('lang.ok')}}',
				cancelButtonText: "{{__('lang.cancel')}}",
			}).then((result) => {
				if (result.value) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
                url: "/admin/country/delete",
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
</script>
@stop
@extends('admin.layout.master_layout')
@section('title')
   لوحة التحكم
@stop
@section('css')
    <style>
        #loading{
            display:none;
        }
    </style>
@endsection
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
										<a href="/dashborad" class="m-nav__link">
											<span class="m-nav__link-text">{{trans('lang.home')}}</span>
										</a>
									</li>
									
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="/users" class="m-nav__link">
											<span class="m-nav__link-text">{{trans('lang.users')}}</span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">
                @can('add_users')
				<button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
    			padding-bottom: 15px;"><i class="fa fa-plus"></i> {{trans('lang.add_user')}}</button>
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
{{trans('lang.users')}}
</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
    <div class="form-group m-form__group row">
			<div class="col-md-3">
				<input type="text" name="user_name_seach"  class="form-control user_name_seach" placeholder="{{trans('lang.user_name')}}">
		</div>

	</div>
	<div id="table-container">
        @include('admin.users.table-data')
	</div>

	</div>
</div>
</div>
</div>
</div>
</div>

@include('admin.users.sub.add')
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function(e){
    getpermission();
});

$(document).on('click','.permission',function(e){
    var id = $(this).data('id');
    $('.user_id').val(id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    $.ajax({
        url: "/admin/users/userpermission",
        type: "post",
        dataType: "JSON",
        data:{id:id},
        success: function(data) {
            if(data['status'] == true){
                $('#permission-body').html(data['data']);
            }
        },
        complete:function(data){
            $('#permission_users').modal('show');
        }
    });

})
/****************************************************************************** */
function getpermission(){
    $.ajax({
        url: "/admin/users/getpermission",
        type: "get",
        dataType: "JSON",
        data:{},
        success: function(data) {
            if(data['status'] == true){
                console.log(1);
            }
        }
    });
}
/******************************************************************************************************* */
$('#activeValue').bootstrapSwitch('state', false, true);

function CKupdate(){
	for ( instance in CKEDITOR.instances )
		CKEDITOR.instances[instance].updateElement();
}
/************************************************************************************************************* */
$('.user_name_seach').on('input',function(e){
    name =  $('.user_name_seach').val();
    if(name.length >= 3 || name == ''){
        var url = $(this).attr('href');
        getData(url,name);
    }
});

/***********************************************************************************************************************/
        $('body').on('click','.UpdateStats',function(){
            $('#load').show();
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
                // $('#load').show();
            	url: "/admin/users/UpdateStats",
                type: "POST",
                dataType: "JSON",
                data:{id:id},
                success: function(data) {
                    $('#load').hide();
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
                                confirmButtonText: "حسنا",
                                cancelButtonText: "الغاء",
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
            getData(url);
        });
  
    function getData(url,name) {
        $('#load').show();
        $.ajax({
            url : url,
            data:{name:name}
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
			$('#addNewpageForm').find(".status").val('');
			$('#addNewpageForm').find(".name").val('');
			$('#addNewpageForm').find(".email").val('');
            $('#addNewpageForm').find(".password").val('');
            $('#addNewpageForm').find(".mobile").val('');
            $('#addNewpageForm').find('.lang_id').val('');
            $('#activeValue').bootstrapSwitch('state', true, true);
            $('#addNewpageForm').find('.rowIdUpdate').val(0);
            // $('.modal-title').html('إضافة مستخدم جديد');
        });

        // 
        $(document).on('click', '.group_per', function () {
            var check = $(this).is(':checked');
            // var uncheck = $(this).is(':unchecked');
            var id = $(this).data('id');
            $('.' + id).each(function () {
                $(this).prop('checked', check);
            });
        });

        $(document).on('click','.password-modal',function(e){
            id = $(this).data('id');
            $.ajax({
                url: "/admin/users/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
                    $('#changepassword #loading').hide();
					if(data['status'] == true){
                        $('.password').val('');
						$(".confirm_password").val('');
                        $('.name').val(data['data']['fullname']);
                        $('.userIdUpdate').val(data['data']['id'])
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
                complete: function () {
                    $('#changepassword').modal('show');
                }
            });
            
        });
        
        /*************************************************/
        $(document).on('click', '.updateDetails', function () {
            $('#addNewpageForm #loading').show();
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/users/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
                    $('#addNewpageForm #loading').hide();
					if(data['status'] == true){
						$(".username").val(data['data']['name']);
                        $(".fullname").val(data['data']['fullname']);
                        $(".email").val(data['data']['email']);
                        $('#add_page').find('.lang_id').val(data['data']['lang_id']);
                        $(".mobile").val(data['data']['mobile']);
						if(data['data']['status'] == 1){
							$('#activeValue').bootstrapSwitch('state', true, true);
						}else{
							$('#activeValue').bootstrapSwitch('state', false, true);
						}
					}
                },
                complete: function () {
                    $('#add_page').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                }
            });

            // $('.modal-title').html('تعديل بيانات');
            // $('.btn_save_user').html('تعديل');

        });
        /*************************************************/
        $('.addNewpageForm').on('submit', function(e){
            $('#addNewpageForm #loading').show();
            e.preventDefault();
			var formData = new FormData(this);
            $('.loader_add_user').css('display', 'initial');
            setTimeout(function () {
                $('.btn_save_customer').removeClass('disabled');
                $('.loader_add_user').css('display', 'none');
            }, 30000);
            var id = $(".rowIdUpdate").val();
            if (id == 0) {
                $.ajax({
                    url: "/admin/users/add",
                    type: "post",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#addNewpageForm #loading').hide();
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
                            $('#addNewpageForm').find(".status").val('');
                            $('#addNewpageForm').find(".username").val('');
                            $('#addNewpageForm').find(".fullname").val('');
                            $('#addNewpageForm').find(".email").val('');
                            $('#addNewpageForm').find(".mobile").val('');
                            $('#addNewpageForm').find(".password").val('');
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
                    url: "/admin/users/update",
                    type: "POST",
                    dataType: "JSON",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#addNewpageForm #loading').hide();
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
                            $('#addNewpageForm').find(".status").val('');
                            $('#addNewpageForm').find(".name").val('');
                            $('#addNewpageForm').find(".email").val('');
                            $('#addNewpageForm').find(".password").val('');
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
            }
//	}
        });
        /****************************************************/
    });
/**************************************************************************************************************************/
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
                url: "/admin/users/delete",
                type: "post",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
						Swal.fire(
						data['data'],
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
    /*************************************************************************************************************************/

    $('#changepasswordform').on('submit', function(e){
            e.preventDefault();
            $('#changepasswordform #loading').show();
			var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $.ajax({
                    url: "/admin/users/changepassword",
                    type: "post",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#changepasswordform #loading').hide();
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
                            var url = $(this).attr('href');
                            getData(url);
                            $('#changepasswordform').find(".password").val('');
                            $('#changepasswordform').find(".confirm_password").val('');
                            $('#changepasswordform').find(".userIdUpdate").val('');
                            $("#changepassword").modal("hide");
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
            
    });

    $('#permission_users_form').on('submit', function(e){
            e.preventDefault();
            $('#permission_users_form #loading').show();
			var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $.ajax({
                    url: "/admin/users/permission",
                    type: "post",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#permission_users_form #loading').hide();
                        if (data["status"] == true) {
                            swal({
                                title: "",
                                text: data["data"],
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{__('lang.ok')}}",
                                cancelButtonText:"{{__('lang.cancel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            $('#permission_users').modal('hide');
                            var url = $(this).attr('href');
                            getData(url);
                            $('#permission_users_form').find(".permissions").val('');
                            $("#changepassword").modal("hide");
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
            
    });
</script>
@stop
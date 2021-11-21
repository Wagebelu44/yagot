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
										<a href="/admin/contact" class="m-nav__link">
											<span class="m-nav__link-text">{{trans('lang.contact_us')}}</span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">
			{{-- <form action="/{{App::getLocale()}}/admin/excel" method="post">
                @csrf
                <input type="hidden" name="hidden" value="1">
                <button  type="submit" class="btn btn-success m-btn m-btn--custom btnAddNews" style="line-height: 15px;
    			padding-bottom: 15px;"><i class="far fa-file-excel"></i> {{trans('lang.excel')}}</button>
            </form>	 --}}
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
{{trans('lang.contact_us')}}
</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
    <div class="form-group m-form__group row">
			<div class="col-md-3">
				<input type="text" name="user_name_seach"  class="form-control user_name_seach" placeholder="{{trans('lang.sender_name')}}">
            </div>
	</div>
	<div id="table-container">
        @include('admin.contact.table-data')
	</div>

	</div>
</div>
</div>
</div>
</div>

<div class="modal  fade in" role="dialog" id="message_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">{{trans('lang.contact_us')}}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body message">
            <div class="form-group">
            <label for="">{{trans('lang.name')}}</label>
                <input type="text" disabled value="" class="form-control name" id="name">
            </div>
            <div class="form-group">
            <label for="">{{trans('lang.email')}}</label>
                <input type="text" disabled value="" class="form-control email">
            </div>
            <div class="form-group">
            <label for="">{{trans('lang.mobile')}}</label>
                <input type="text" disabled value="" class="form-control mobile">
            </div>
            <div class="form-group">
            <label for="">{{trans('lang.details')}}</label>
                <textarea disabled   rows="5" class="form-control details"></textarea>
            </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button"  class="btn btn-danger" data-dismiss="modal">{{trans('lang.hide')}}</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade in" role="dialog" id="reply_modal">
  <div class="modal-dialog">
     <form action="" method="post" id="reply_form">
            <div class="modal-content">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{trans('lang.send_to')}} <b><span class="sender_name"></span></b></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body reply">
                    <div class="form-group">
                        <label for="">{{trans('lang.title')}}</label>
                        <input type="text" name="response_title" value="" class="form-control response_title">
                        <input type="hidden" class="sender_id" name="sender_id">
                    </div>
                    <div class="form-group">
                        <label for="">{{trans('lang.reply')}}</label>
                        <textarea type="text"  value="" name="response" rows="5" class="form-control response"></textarea>
                    </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                 <button type="submit"  class="btn btn-primary">{{trans('lang.send')}}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('lang.hide')}}</button>
            </div>
            <div id="loading">
                <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
            </div>
            </div>
    </form>
  </div>
</div>

</div>


@stop

@section('js')
<script type="text/javascript">
/****************************************************************************** */

$('.user_name_seach').on('input',function(e){
    name =  $('.user_name_seach').val();
    var url = $(this).attr('href');
    getData(url,name);
});

/***********************************************************************************************************************/
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
        $.ajax({
            url : url,
            data:{name:name}
        }).done(function (data) {
            $("#table-container").empty().html(data);
        });
    }
</script>
<script>
    $(document).on('click','.show_message',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            	url: "/admin/contact/view",
                type: "get",
                dataType: "JSON",
                data:{id:id},
                success: function(data) {
                    if(data["status"] == true){
                        $('.name').val(data['data']['name']);
                        $('.email').val(data['data']['email']);
                        $('.mobile').val(data['data']['mobile']);
                        $('.details').val(data['data']['details']);
                        name =  $('.user_name_seach').val();
                        var url = $(this).attr('href');
                        getData(url,name);
                    }
                },
                complete:function(){
                    $('#message_modal').modal('show');
                }
            });
    });

    $(document).on('click','.send_message',function(e){
        $('.sender_id').val(0);
        e.preventDefault();
        var id = $(this).data('id');
        $('.sender_id').val(id);
        $.ajax({
            	url: "/admin/contact/view",
                type: "get",
                dataType: "JSON",
                data:{id:id},
                success: function(data) {
                    if(data["status"] == true){
                        $('.sender_name').html(data['data']['name']);
                    }
                },
                complete:function(){
                    $('#reply_modal').modal('show');
                }
            });
    });

    $('#reply_form').on('submit', function(e){
            $('#loading').show();
            e.preventDefault();
			var formData = new FormData(this);
                $.ajax({
                    url: "/admin/contact/reply_view",
                    type: "post",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#loading').hide();
                        if (data["status"] == true) {
                                Swal.fire(
                                data['message'],
                                '',
                                'success'
                                )
                                $('#reply_form').find('input').val('');
                                $('#reply_form').find('textarea').val('');
                                $('.sender_id').val(0);
                                var url = $(this).attr('href');
                                getData(url,name);
                                $('#reply_modal').modal('hide');
                        } else {
                            swal({
                                title: "",
                                text: data['message'],
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

<script>
	$(document).on('click','.delete',function(e){
		var id = $(this).data('id');
		Swal.fire({
				title: '{{__('lang.are_you_sure')}}',
				text: "",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '{{__('lang.ok')}}',
				cancelButtonText: '{{__('lang.cancel')}}',
			}).then((result) => {
				if (result.value) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
                url: "/admin/contact/delete",
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
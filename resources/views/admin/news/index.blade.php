@extends('admin.layout.master_layout')
@section('title')
   {{__('lang.control_panel')}}
@stop

@section('css')
<style>
    #loading {
        display: none;
    }

    .details-table tr th{
        width: 15%;
        font-weight: bold;
    }

    .removable{
        position: relative;
        display: inline-block ;
    }
    .removable .btn-remove {
        position: absolute;
        top: 2px;
        left: 2px;
        z-index: 100;
        border-radius: 50%;
        display: none;
        /* padding:4px 6px; */

    }

    .removable .btn-remove:hover {
        cursor: pointer;
    }
    #details_page .tag span{
        display: none;
    }
    #details_page .tag span{
        display: none;
    }
    #details_page .bootstrap-tagsinput{
        border:none;
    }
    .bootstrap-tagsinput input{
        display: none;
    }
    .custom-file-label{
        overflow: hidden;
    }
</style>
@endsection

@section('page-content')
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
											<span class="m-nav__link-text">{{__('lang.home')}}</span>
										</a>
									</li>

									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="/admin/products" class="m-nav__link">
                                        <span class="m-nav__link-text">{{__('lang.products')}}</span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">
                @can('add_product')
				<button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddNews" style="line-height: 15px;
    			padding-bottom: 15px;"><i class="fa fa-plus"></i> {{__('lang.add_products')}}</button>
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
{{__('lang.products')}}
</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
  <div class="form-group m-form__group row">
            <div class="col-md">
                <input type="text" name="title_search"  class="form-control title_search" placeholder="{{__('lang.title')}}">
            </div>
           

<div class="col-md">

    <input type="text" name="name_search "  class="form-control name_search filter" placeholder="{{__('lang.client_name')}}">

</div>


<div class="col-md">

    <select name="category_search" class="category_search filter form-control">
    <option value="" >{{
                            __("lang.choose_category")
                          }}</option>
                          @foreach ($data['category'] as $category)
                          <option
                            value="{{ $category['id'] }}"
                            >{{$category['name']}}</option
                          >
                          @endforeach
  </select>

</div>

<div class="col-md">
    <select
    name="zone_serach"
    class="zone_search filter form-control" 
  >
    <option value="" >اختر المنطقة</option>
    @foreach ($data['zones'] as $zone)
    <option
      value="{{ $zone['id'] }}"
      >{{$zone['name']}}</option
    >
    @endforeach

  </select>

</div>

<div class="col-md">
<select  name="status_search" class="form-control status_search" >
<option value="">{{trans('lang.status')}}</option>

@foreach ($data['product_status'] as $status)
<option value="{{$status->id}}">{{$status['name']}}</option>
@endforeach
</select>
</div>

	</div>
	<div id="table-container">
        @include('admin.news.table-data')
	</div>

	</div>
</div>
</div>
</div>
</div>
</div>

@include('admin.news.sub.add')
@include('admin.news.sub.details')
@stop

@section('js')
<script src="/admin/assets/select_with_ajax/js/ajax-bootstrap-select.js"></script>
<script src="/admin/assets/app/js/search.js"></script>
<script type="text/javascript">


$('#activeValue').bootstrapSwitch('state', false, true);
/***********************************************************************************************************************/
</script>

<script>
const STORAGE_PATH = '/uploads/';

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
        $('#load').show();
        const title = $(".title_search").val();
        const name_search = $(".name_search").val();
        const category_search = $(".category_search").val();
        const zone_search = $(".zone_search").val();
        const status_search = $(".status_search").val();
        
        
        $.ajax({
            url : url,
            data:{
                title:title,
                name_search:name_search,
                category_search:category_search,
                zone_search:zone_search,
                status_search:status_search
            },
        }).done(function (data) {
            $('#load').hide();
            $("#table-container").empty().html(data);
        });
    }


    function readURL(input,target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $(target).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            return true;
        }
        else{
            $(target).attr('src', '');
            $(input).next('label').text('{{__("lang.choose_image")}}');
            return false;
        }
    }

    function createFancyBoxImage(path,imageId='',imageClasses=[]){
        const classes = imageClasses.join(' ');
        return '<a style="width:120px;margin:5px;"  data-fancybox="gallery" href ="'+path+'"  ><img id="'+imageId+'" width="200px" class="img-thumbnail detailsImageClick '+classes+'" src="'+path+'" /></a>'
    }

    function createFancyBoxImageWithTitle(path,title,imageId='',imageClasses=[]){
        return createFancyBoxImage(path,imageId,imageClasses)+'<p style="text-align:center">'+title+'</p>'
    }

    function createRemoveButton(dataAction,dataId=0){
        return '<span style="font-family: monospace" class="badge badge-danger btn-remove" data-id="'+dataId+'" data-action="'+dataAction+'">&times;</span>'
    }


    $('body').on('mouseenter','.removable',function(){
        $(this).find('.btn-remove').css('display','initial');
    });

    $('body').on('mouseleave','.removable',function(){
        $(this).find('.btn-remove').css('display','none');
    });


</script>
<script type="text/javascript"> /*franchising*/
    $(document).ready(function () {
       

        $('.title_search').on('input',function(e){
            name =  $('.title_search').val();
            if(name.length >= 3 || name == ''){
                var url = $(this).attr('href');
                getData(url);
            }
        });
        $('.summary_search').on('input',function(e){
            name =  $('.summary_search').val();
            if(name.length >= 3 || name == ''){
                var url = $(this).attr('href');
                getData(url);
            }
        });
        $('.author_search').on('input',function(e){
            name =  $('.author_search').val();
            if(name.length >= 3 || name == ''){
                var url = $(this).attr('href');
                getData(url);
            }
        });

      
        /*************************************************/
        $(document).on('click', '.btnAddNews', function () {
            $('#addNewpageForm').find(".title").val('');
            $('#addNewpageForm').find(".details").val('');

            $('#addNewpageForm').find(".main_image").val('');
            $('#addNewpageForm').find(".additional_images").val('');
            $('#addNewpageForm').find(".city_id").val('');
            $('#addNewpageForm').find(".price").val('');
            $('#addNewpageForm').find(".client_id").val('');
            $('#addNewpageForm').find(".category_id").val('');
            $('#additionalImagesPreview').html('');

            $('#addNewpageForm').find('.rowIdUpdate').val(0);
            $('#addNewpageForm .modal-title').html('{{__('lang.add_products')}}');
        });

        /*************************************************/

        $('.UpdateStatus').on('change',function(e){
            $('#load').show();
            $(this).addClass('disabled');
            $('.loadImg').removeClass('hidden');
            $('.loadMSG').html('جارٍ تحديث الحالة');
            var thisTag = $(this);
            var id = $(this).attr('data-id');
            const status = $(this).val();
            console.log(id,status);

			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            	url: "/admin/news/updateStatus",
                type: "POST",
                dataType: "JSON",
                data:{id:id,status:status},
                success: function(data) {
                    $('#load').hide();
                    if(data["status"] == true){
						var url = $(this).attr('href');
						// getData(url);
                    }else{
                        swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "حسنا",
                                cancelButtonText: "الغاء",
                                closeOnCancel: true
                            });
                    }
                }
            });
            $(thisTag).removeClass('disabled');
            $('.loadImg').addClass('hidden');
        });
        /*************************************************/

        $('#add_page').on('hidden.bs.modal', function () {
            $("#mainImagePreview").attr('src','');
            $("#additionalImagesPreview").html('');
            $("#newAdditionalImagesPreview").html('');

            //remove custom file input label
            $(".main_image").next('label').text('{{__("lang.choose_image")}}');
            $(".additional_images").next('label').text('{{__("lang.choose_images")}}');
        });

        $('#details_page').on('hidden.bs.modal', function () {
            $('#details_page').find(".show_row").css('display','none');
        });


        /*************************************************/


        $('body').on("click",".btn-remove",function(e){
            Swal.fire({
                title: "{{__('lang.are_you_sure')}}",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "{{__('lang.ok')}}",
                cancelButtonText: "{{__('lang.cancel')}}"
            }).then(result => {
                if (result.value) {
                    e.preventDefault();
                    console.log("any");
                    if($(this).attr('data-action')=='update'){
                        const dataId = $(this).attr('data-id');
                        $(this).parent().replaceWith('<input type="hidden" name="remove_additional_image[]" value="'+dataId+'"/>');
                    }
                    else{
                        $(this).parent().remove();
                    }
                }
            });
        });
        /*************************************************/

        /*************************************************/
        $(".main_image").change(function(e) {
            e.preventDefault();
            if(!readURL(this,'#mainImagePreview'))  {
                $(".main_image").next('label').text('{{__("lang.choose_image")}}');
            }
        });
        $(".additional_images").change(function(e) {
            if(!$(this).val()){
                $(".additional_images").next('label').text('{{__("lang.choose_images")}}');
            }
        });
        /*************************************************/

        $(".btnAddAdditionalImage").on('click',function(e){
            e.preventDefault();

            const imageInput = $("#add_page .additional_images");
            const titleInput = $("#add_page .additional_images_title");
            const title = titleInput.val();
            if(!(imageInput.val())) return;
            const additionalImagePreviewCount= $('.additionalImageAdd').length+1;
            // var element = '<img width="200" class="img-fluid img-thumbnail" id="additionalImagePreview'+additionalImagePreviewCount+'" src="">';
            // element += '<p style="text-align:center">'+title+'</p>';
            var element = createFancyBoxImageWithTitle("",'','additionalImagePreview'+additionalImagePreviewCount,['additionalImageAdd']);
            const imageInputClone  = imageInput.clone();
            const titleInputClone  = titleInput.clone();
            imageInputClone.css('display','none');
            imageInputClone.attr('name','additional_image[]');
            imageInputClone.removeClass('additional_images');
            titleInputClone.css('display','none');
            titleInputClone.attr('name','additional_image_title[]');
            titleInputClone.removeClass('additional_images_title');
            var removable = '<div class="removable">';
            removable += createRemoveButton('')+element;
            removable+= "</div>"
            $("#newAdditionalImagesPreview").append(removable);
            $("#newAdditionalImagesPreview .removable").last().append(imageInputClone);
            $("#newAdditionalImagesPreview .removable").last().append(titleInputClone);

            $(".additional_images").next('label').text('{{__("lang.choose_images")}}');


            readURL(imageInput[0],"#additionalImagePreview"+additionalImagePreviewCount);
            imageInput.val('');
            titleInput.val('');
            return false;
        });

        /*************************************************/



        $(document).on("click", ".viewDetails", function() {
            $("#details_page #loading").show();
            var id = $(this).attr('data-id');
            $.ajax({
                url: "/admin/news/" + id,
                type: "get",
                dataType: "JSON",
                success: function(data) {
                    $("#details_page #loading").hide();
                    const modal = $('#details_page');
                    modal.find(".title").text(data["data"]["title"]);
                    modal.find(".main_image").html(createFancyBoxImage(data["data"]["image"]));
                    modal.find(".category").text(data["data"]["category"]);
                    modal.find(".language").text(data["data"]["city_name"]);
                    modal.find(".status").text(data["data"]["status_name"]);
                    modal.find(".details").html(data["data"]["details"]);
                    modal.find(".client_name").text(data["data"]["client_name"]);
                    modal.find(".price").html(data["data"]["price"]+' '+data["data"]["curreny_name"]);
                    var pictureStr = '<div style="text-align:center" class="row">';
                    const images = data['data']['images'];
                    for (let i = 0; i < images.length; i++) {
                        const image = images[i];
                        pictureStr += '<div class="removable">';
                        pictureStr += createFancyBoxImageWithTitle(image['attachment'],'');
                        pictureStr += '</div>';
                    }
                    pictureStr += '</div>';
                    modal.find(".pictures").html(pictureStr);

                    pictureStr = '<div style="text-align:center" class="row">';
                    const certified_images = data['data']['certified_images'];
                    for (let i = 0; i < certified_images.length; i++) {
                        const image = certified_images[i];
                        pictureStr += '<div class="removable">';
                        pictureStr += createFancyBoxImageWithTitle(image['attachment'],'');
                        pictureStr += '</div>';
                    }
                    pictureStr += '</div>';
                    modal.find(".certified_pictures").html(pictureStr);
                },
                complete: function() {
                    $("#details_page").modal("show");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal({
                        title: "حدث خطأ غير معروف، الرجاء المحاولة فيما بعد",
                        type: "error"
                    });
                }
            });
    });


        /*************************************************/


        $(document).on('click', '.updateDetails', function () {
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/news/edit/"+id,
                type: "get",
                dataType: "JSON",
                success: function(data){
              if(data['status'] == true){
                    $('#addNewpageForm').find(".title").val(data['data']['title']);
                    $('#addNewpageForm').find(".details").val(data['data']['details']);
                    $("#mainImagePreview").attr('src',data["data"]["image"]);
                    $('#addNewpageForm').find(".price").val(data['data']['price']);
                    // $('#addNewpageForm').find(".additional_images").val(data['data']['additional_images']);
                    $('#addNewpageForm').find(".city_id").val(data['data']['city_id']);
                    $('#addNewpageForm').find(".category_id").val(data['data']['category_id']);
                    
                    var newOption = new Option(data['data']['client']['name'], data['data']['client']['id'], true, true);
                    $('#addNewpageForm #ajax-select').append(newOption).trigger('change');
                    $('#addNewpageForm #ajax-select').val(data['data']['client']['id']).trigger('change');
                    $('#addNewpageForm .selectpicker').selectpicker('refresh');

                    var pictureStr = '<div style="text-align:center" class="col-md-4">';
                    const images = data['data']['images'];
                    for (let i = 0; i < images.length; i++) {
                        const image = images[i];
                        pictureStr += '<div class="removable">';
                        pictureStr += createRemoveButton('update',image['id'])+createFancyBoxImageWithTitle(image['attachment'],'');
                        pictureStr += '</div>';
                    }
                    pictureStr += '</div>';
                    $('#additionalImagesPreview').html(pictureStr);
                }
                // if(data['status'] == true){
                //     $('#add_page').modal('show');

                // }
            }
            ,
                complete: function () {
                    $('#add_page').modal('show');
                    $('#addNewpageForm .modal-title').html('{{__('lang.edit_data')}}');
                    $('.btn_save_user').html('{{__('lang.edit')}}');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: '{{__('lang.error')}}', type: "error"});
                }
            });



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
                    url: "/admin/news",
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
                                confirmButtonText: "{{__('lang.ok')}}",
                                cancelButtonText: "{{__('lang.cancel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            var url = $(this).attr('href');
                            getData(url);
                            window.history.pushState("", "", url);
                            $('#addNewpageForm').find(".title").val('');
                            $('#addNewpageForm').find(".details").val('');
                            $('#addNewpageForm').find(".price").val('');
                            $('#addNewpageForm').find(".main_image").val('');
                            $('#addNewpageForm').find(".additional_images").val('');
                            $('#addNewpageForm').find(".city_id").val('');
                             $('#addNewpageForm').find(".client_id").val('');
                            $('#addNewpageForm').find(".price").val('');
                            $('#addNewpageForm').find(".category_id").val('');
                            $('#addNewpageForm').find('.rowIdUpdate').val(0);
                            $('#additionalImagesPreview').html('');
                            $("#add_page").modal("hide");
                        } else {
                           
                            swal({
                                title: "",
                                html: data["data"],
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
                    url: "/admin/news/update/"+id,
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
                                title: '',
                                text: data['data'],
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
                            window.history.pushState("", "", url);
                            $('#addNewpageForm').find(".title").val('');
                            $('#addNewpageForm').find(".details").val('');
                            $('#addNewpageForm').find(".price").val('');
                            $('#addNewpageForm').find(".main_image").val('');
                            $('#addNewpageForm').find(".additional_images").val('');
                            $('#addNewpageForm').find(".city_id").val('');
                            $('#addNewpageForm').find(".client_id").val('');
                            $('#addNewpageForm').find(".price").val('');
                            $('#addNewpageForm').find(".category_id").val('');
                            $('#addNewpageForm').find('.rowIdUpdate').val(0);
                            $('#additionalImagesPreview').html('');
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
				cancelButtonText: "{{__('lang.cancel')}}",
			}).then((result) => {
				if (result.value) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
                url: "/admin/news/delete/"+id,
                type: "post",
                dataType: "JSON",
                success: function(data){
					if(data['status'] == true){
						Swal.fire(
						'{{__('lang.delete_success')}}',
						'',
						'success'
						)
						var url = $(this).attr('href');
						getData(url);
						window.history.pushState("", "", url);
					}else{
						swal({
                                title: "",
                                text: data['data'],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{__('lang.ok')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
					}
                },
                error:function(jqXHR, textStatus, errorThrown){
                    console.log("any");

                    swal({
                        title: "",
                        text: '{{__('lang.delete_fail')}}',
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{__('lang.ok')}}",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    });
                }
            });
				}
			})
    });
    /////////////////////////////////////////////////////////
</script>
<script>
    $('.title_search').on('input',function(e){
        var url = $(this).attr('href');
        getData(url);
    });
    $('.name_search').on('input',function(e){
        var url = $(this).attr('href');
        getData(url);
    });
    $('.category_search').on('change',function(e){
        var url = $(this).attr('href');
        getData(url);
    });
    $('.zone_search').on('change',function(e){
        var url = $(this).attr('href');
        getData(url);
    });
    $('.status_search').on('change',function(e){
        var url = $(this).attr('href');
        getData(url);
    });

    /***********************************************************************************************************************/
    $('body').on('click','.certificated',function(){
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
            	url: "/admin/products/UpdateCertificated",
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
@stop

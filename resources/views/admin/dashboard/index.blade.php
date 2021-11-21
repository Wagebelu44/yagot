@extends('admin.layout.master_layout')
@section('title')
   لوحة التحكم
@stop

@section('page-title')
    <div class="m-subheader-search">
        <span class="m-subheader-search__desc">
            <div class="mr-auto">
                    <h3 class="page-title"> {{trans('lang.home')}}
                        <small>
                        {{trans('lang.hello')}} ،
                            {{ Auth::user()->fullname }}
                        </small>
                </h3>
            </div>
        </span>
    </div>
    
@stop

@section('page-content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
<!-- BEGIN: Subheader -->
<!-- END: Subheader -->

<div class="m-content">
<div class="row">
<div class="col-lg-12">
<!-- BEGIN: Subheader -->
<!--begin::Portlet-->
<div class="m-portlet m-portlet--mobile" id="m_blockui_2_portlet">
	<div class="m-portlet__head">
<div class="m-portlet__head-caption">
<div class="m-portlet__head-title">
<h3 class="m-portlet__head-text">
{{trans('lang.Control_Panel')}} ~ {{trans('lang.statistics')}}</h3>
</div>
</div>
</div>

	<div class="m-portlet__body">
	
		<br>
		<div class="">
			<div class="">
  <div class="m-portlet__body  m-portlet__body--no-padding">
    <div class="row m-row--no-padding m-row--col-separator-xl " style="justify-content: center;">
    
      <div class="col-md-3 col-lg-6 col-xl-3" style="background-color: #1f4282cf !important;
             margin-bottom: 30px;
            border-radius: 0.675rem;    margin-left: 25px;position:relative;

">
<!-- background:url(/admin/bg-logo.png); -->
        <div class="m-widget24" style="padding: 2rem 2.25rem;
             margin-bottom: 0.75rem !important;
             margin-top: 0.75rem !important;
           
             background-repeat: no-repeat;
    background-position: top left;
    
">
          <div class="m-widget24__item" style="">
            <div style="position:absolute;top:10px;left:11px"><i class="fas fa-users text-white" style="    font-size: 70px;
    opacity: 0.2;"></i></div>
            <span class="m-widget24__stats m--font-brand numscroller text-white d-block text-center mx-auto"  data-min="1" data-max="{{$data['client']}}" data-delay="2" data-increment="2" data-slno="5" style="color: #fff !important;
                font-size: 46px !important;width:100%
"> 
                 {{$data['client']}}
            </span>
            <br>

            <h4 class="m-widget24__title  d-block text-center mx-auto text-white"  style="color: #fff !important;
                 font-size: 1.175rem  !important;
">
عدد العملاء             </h4>
          </div>
        </div>
     </div>
   


     


<div class="col-md-3 col-lg-6 col-xl-3" style="background-color: #1f4282cf !important;
             margin-bottom: 30px;
            border-radius: 0.675rem;    margin-left: 25px;position:relative;

">
        <div class="m-widget24" style="padding: 2rem 2.25rem;
             margin-bottom: 0.75rem !important;
             margin-top: 0.75rem !important;
">
          <div class="m-widget24__item">

          <div style="position:absolute;top:14px;left:11px"><i class="fas fa-box text-white" style="    font-size: 70px;
    opacity: 0.1;"></i></div>

          <span class="m-widget24__stats m--font-brand numscroller  text-white d-block text-center mx-auto"  data-min="1" data-max="{{$data['products']}}" data-delay="2" data-increment="2" data-slno="5" style="color: #fff !important;
                font-size: 46px !important;width:100%
">
{{$data['products']}}
            </span>
            <br>
            <h4 class="m-widget24__title d-block text-center mx-auto  text-white"  style="color: #fff   !important;
                font-size: 1.175rem !important;
">
عدد المنتجات</h4>
            

          </div>
        </div>
     </div>
   
   <div class="col-md-3 col-lg-6 col-xl-3" style="background-color: #1f4282cf !important;
          margin-bottom: 30px;
         border-radius: 0.675rem;    margin-left: 25px;position:relative;

">
     <div class="m-widget24" style="padding: 2rem 2.25rem;
          margin-bottom: 0.75rem !important;
          margin-top: 0.75rem !important;
">
       <div class="m-widget24__item">
       
       
       <div style="position:absolute;top:-15px;left:11px"><i class="flaticon-mail-1 text-white" style="    font-size: 70px;
    opacity: 0.1;"></i></div>
         <span class="m-widget24__stats m--font-brand numscroller  d-block text-center text-white mx-auto" data-min="1" data-max="{{$data['messages']}}" data-delay="2" data-increment="2" data-slno="5" style="color: #fff !important;
            font-size: 46px !important;width:100%
">
{{$data['messages']}}
         </span>
         <br>

         <h4 class="m-widget24__title  d-block text-center mx-auto"  style="color: #fff !important;
             font-size: 1.175rem !important;
">
الدعم الفني     </h4>

       </div>
     </div>
  </div>





  



    </div>
  </div>
</div>
		</div>
		
		<br>
		<hr>
		<br>
		
		<br>
		<br>
	

	</div>
</div>
</div>
     </div>
  </div></div>

@stop

@section('js')
<script type="text/javascript">

$('.franchise,.status_id').on('change',function(e){
  var url = $(this).attr('href');
  getData(url);
});

$('#activeValue').bootstrapSwitch('state', false, true);

$('.mobile').on('input',function(e){
    mobile =  $('.mobile').val();
    if(mobile.length >= 3 || mobile == ''){
        var url = $(this).attr('href');
        getData(url);
    }
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
        var franchise = $('.franchise').val();
        var mobile = $('.mobile').val();
        var status_id = $('.status_id').val();
        $("#load").show();
        $.ajax({
            url : url,
            data:{franchise:franchise,mobile:mobile,status_id:status_id},
        }).done(function (data) {
            $("#table-container").empty().html(data);
            $("#load").hide();
        });
    }
</script>
<script>
$(document).on('click','.delete',function(e){
		var id = $(this).data('id');
		Swal.fire({
				title: 'هل تريد حذف هذا العنصر ؟',
				text: "",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'حسنا',
				cancelButtonText: "الغاء",
			}).then((result) => {
				if (result.value) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $("#load").show();
				$.ajax({
                url: "/admin/dashboard/delete",
                type: "post",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
                    $("#load").hide();
					if(data['status'] == true){
						Swal.fire(
						'تم الحذف بنجاح',
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
                                confirmButtonText: "حسنا",
                                cancelButtonText: "الغاء",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
					}
                },
            });
				}
			})
    });
    //////////////////////////////////////////////////////////////
    $('body').on('change','.status',function(){
            $(this).addClass('disabled');
            var status = $(this).val();
            // $('.loadImg').removeClass('hidden');
            // $('.loadMSG').html('جاري تحديث الحالة');
            var thisTag = $(this);
            var id = $(this).data('id');
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#load").show();
            $.ajax({
            	url: "/admin/dashboard/UpdateStats",
                type: "POST",
                dataType: "JSON",
                data:{id:id,status:status},
                success: function(data) {
                    $("#load").hide();
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
    $(document).on('click','.details',function(e){
        var id = $(this).data('id');
        getDetails(id);
    });

    function getDetails(id){
           var id = id;
           $('#loading').show();
            $.ajax({
            	url: "/admin/dashboard/details",
                type: "get",
                dataType: "JSON",
                data:{id:id},
                success: function(data) {
                    $('#loading').hide();
                    if(data["status"] == true){
                        $('#add_page .modal-body').html(data['data']);
                        $('#add_page').modal('show');
                    }
                }
            });
    }
</script>
<script type="text/javascript">
                            (function($){
                                $(window).on("load",function(){
                                    $(document).scrollzipInit();
                                    $(document).rollerInit();
                                });
                                $(window).on("load scroll resize", function(){
                                    $('.numscroller').scrollzip({
                                        showFunction    :   function() {
                                                                numberRoller($(this).attr('data-slno'));
                                                            },
                                        wholeVisible    :     false,
                                    });
                                });
                                $.fn.scrollzipInit=function(){
                                    $('body').prepend("<div style='position:fixed;top:0px;left:0px;width:0;height:0;' id='scrollzipPoint'></div>" );
                                };
                                $.fn.rollerInit=function(){
                                    var i=0;
                                    $('.numscroller').each(function() {
                                        i++;
                                       $(this).attr('data-slno',i);
                                       $(this).addClass("roller-title-number-"+i);
                                    });
                                };
                                $.fn.scrollzip = function(options){
                                    var settings = $.extend({
                                        showFunction    : null,
                                        hideFunction    : null,
                                        showShift       : 0,
                                        wholeVisible    : false,
                                        hideShift       : 0,
                                    }, options);
                                    return this.each(function(i,obj){
                                        $(this).addClass('scrollzip');
                                        if ( $.isFunction( settings.showFunction ) ){
                                            if(
                                                !$(this).hasClass('isShown')&&
                                                ($(window).outerHeight()+$('#scrollzipPoint').offset().top-settings.showShift)>($(this).offset().top+((settings.wholeVisible)?$(this).outerHeight():0))&&
                                                ($('#scrollzipPoint').offset().top+((settings.wholeVisible)?$(this).outerHeight():0))<($(this).outerHeight()+$(this).offset().top-settings.showShift)
                                            ){
                                                $(this).addClass('isShown');
                                                settings.showFunction.call( this );
                                            }
                                        }
                                        if ( $.isFunction( settings.hideFunction ) ){
                                            if(
                                                $(this).hasClass('isShown')&&
                                                (($(window).outerHeight()+$('#scrollzipPoint').offset().top-settings.hideShift)<($(this).offset().top+((settings.wholeVisible)?$(this).outerHeight():0))||
                                                ($('#scrollzipPoint').offset().top+((settings.wholeVisible)?$(this).outerHeight():0))>($(this).outerHeight()+$(this).offset().top-settings.hideShift))
                                            ){
                                                $(this).removeClass('isShown');
                                                settings.hideFunction.call( this );
                                            }
                                        }
                                        return this;
                                    });
                                };
                                function numberRoller(slno){
                                        var min=$('.roller-title-number-'+slno).attr('data-min');
                                        var max=$('.roller-title-number-'+slno).attr('data-max');
                                        var timediff=$('.roller-title-number-'+slno).attr('data-delay');
                                        var increment=$('.roller-title-number-'+slno).attr('data-increment');
                                        var numdiff=max-min;
                                        var timeout=(timediff*1000)/numdiff;
                                        //if(numinc<10){
                                            //increment=Math.floor((timediff*1000)/10);
                                        //}//alert(increment);
                                        numberRoll(slno,min,max,increment,timeout);

                                }
                                function numberRoll(slno,min,max,increment,timeout){//alert(slno+"="+min+"="+max+"="+increment+"="+timeout);
                                    if(min<=max){
                                        $('.roller-title-number-'+slno).html(min);
                                        min=parseInt(min)+parseInt(increment);
                                        setTimeout(function(){numberRoll(eval(slno),eval(min),eval(max),eval(increment),eval(timeout))},timeout);
                                    }else{
                                        $('.roller-title-number-'+slno).html(max);
                                    }
                                }
                            })(jQuery);

                            </script>
@stop
<!DOCTYPE html>
<html lang="{{\Lang::getLocale()}}">

    <!-- begin::Head -->
    <head>
        <meta charset="utf-8" />
      
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <script src="/admin/assets/vendors/base/jquery-1.11.0.min.js"></script>
        <!--begin::Web font -->
        <!--end::Web font -->
        @if ( \App::getLocale() == 'en')
            <title>{{$settings->title_en ?? ''}}</title>
            <link href="/admin/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
            <link href="/admin/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
            <link href="/admin/assets/demo/demo6/base/style.bundle.css" rel="stylesheet" type="text/css" />
            <script>
                window.dir = 'ltr';
                window.locale='en';
            </script>
        @elseif ( \App::getLocale() == 'ar' )
            <title>{{$settings->title_ar ?? ''}}</title>
            <link href="/admin/assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />
            <link href="/admin/assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />
            <link href="/admin/assets/demo/demo6/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
            <script>
                window.dir = 'rtl';
                window.locale='ar';
            </script>
        @endif  
 
        <!--end::Base Styles -->
        <link rel="shortcut icon" href="/admin/assets/demo/demo6/media/img/logo/favicon.png" />
        <link href="/admin/assets/app/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/app/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/app/bootstrap-datepicker.standalone.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/app/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/app/select2-bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/app/bootstrap4-modal-fullscreen.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/demo/demo6/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/app/multi-select.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/app/fancybox.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/app/tagsinput.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/app/colorpicker/dist/spectrum.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="/admin/assets/select_with_ajax/css/ajax-bootstrap-select.css">
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
         <style>
            .custom-file-label{
                overflow: hidden;
            }
           .selected_app .ms-container{
                margin: 0 auto;
                width: 100%;
                background: transparent url(/admin/assets/switch.png) no-repeat 50% 50%;
            }
            .pagination {
                justify-content: center;
                margin-top: 24px;
            }
            .selected_app .ms-container .ms-selectable{
                float:right;
            }

            .selected_app .ms-container .ms-selection {
                float: left;
            }
            .selected_app .ms-optgroup{
                margin-bottom: 12px !important;
            }
            .selected_app .ms-optgroup-label{
                color: #282a3c !important;
                padding: 0px 15px 0px 15px !important;
                font-weight:bold;
            }
            .selected_app .ms-container .ms-elem-selectable,.selected_app .ms-container .ms-elem-selection{
                padding: 2px 33px !important;
                font-size: 13px !important;
            }
            .selected_app .ms-container .ms-list{
                height: 500px;
            }

            #loading{
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                position: fixed;
                display: none;
                opacity: 0.8;
                z-index: 100000;
                background-color: #fff;
                z-index: 199;
                text-align: center;
            }

            #load{
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: block;
            opacity: 0.8;
            z-index: 100000;
            background-color: #fff;
            z-index: 199;
            text-align: center;
        }

        #loading-image {
            position: absolute;
            top: 50%;
            z-index: 200;
            right: 50%;
            z-index: 200;
        }
        body .m-brand {
            background: #1F4282 !important;
        }
        .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title .m-portlet__head-text{
            color : #00041D !important;
        }
        
        body .m-subheader-search{
            background: linear-gradient(45deg,#2B5AB1,#1F4282);
        }
         body .m-subheader-search .page-title{
            color:#fff !important;
        }
        body .m-header__title .m-header__title-text{
            color:#1F4282 !important;
        }
        .m-topbar .m-topbar__nav.m-nav>.m-nav__item>.m-nav__link .m-topbar__usericon .m-nav__link-icon-wrapper {
    background: #1F4282 !important;
    border: 1px solid #1F4282 !important;
}
.btn.m-btn--label-brand{
    color: #1F4282 !important;
}
body .btn-primary{
    border-color:#1F4282 !important;
    background-color: #1F4282 !important;
}
body .btn-danger {
					color: #fff;
					background-color: #e74c3c !important;
					border-color: #e74c3c !important;
				}
				body .btn-success {
					color: #fff;
					background-color: #27ae60 !important;
					border-color: #27ae60 !important;
				}
				body .btn-accent {
					color: #fff;
					background-color: #2B5AB1 !important;
					border-color: #2B5AB1 !important;
                }
                body .m-menu__item.m-menu__item--submenu.tabe_home:hover{
                    color:#1F4282 !important;
                   
                }
                body .m-menu__item.m-menu__item--submenu.tabe_home:hover a{
                    color:#1F4282 !important;
                    background:#1f42821c !important;
                }

                body .m-menu__item.m-menu__item--submenu.tabe_home:hover a span,body .m-menu__item.m-menu__item--submenu.tabe_home:hover a i{
                    color:#1F4282 !important;
                }
                .m-link{
                    color:#1F4282 !important;
                }
                .m-link:hover::after{
                    border-color: #1F4282 !important;
                }
                #m_scroll_top i{
                    color:#1F4282 !important;
                }
                body .m-subheader .m-subheader__breadcrumbs.m-nav>.m-nav__item>.m-nav__link:hover>.m-nav__link-text,.m-subheader .m-subheader__breadcrumbs.m-nav>.m-nav__item>.m-nav__link:hover>.m-nav__link-icon{
                    color:#1F4282 !important;
                }
         </style>
          @yield('css')

    </head>

    <!-- end::Head -->

    <!-- begin::Body -->
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default">

        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">

            @include('admin.layout.header')
            <!-- begin::Body -->
         <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               @include('admin.layout.main_menu')
               @yield('page-title')
               <div class="container-fluid">
               @yield('page-content')
               </div>
               <!-- END: Subheader -->
            </div>
           
         </div>
          
          <!-- end:: Body -->
        <!-- begin::Footer -->
            <footer class="m-grid__item     m-footer ">
                <div class="m-container m-container--fluid m-container--full-height m-page__container">
                    <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                        <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                            <span class="m-footer__copyright">
                                  
                            <a href="https://www.tejaratek.com/" target="_blank" class="m-link">@if(\App::getLocale() == 'ar') تطوير وبرمجة شركة تجارتك @else Development and Programming By Tejaratek @endif</a> &copy; <?=date('Y')?>
                            </span>
                        </div>
                        <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                            <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                         
                            
                            </ul>
                        </div>

                    </div>
         </div>  </footer>

            <!-- end::Footer -->
        </div>

        <!-- end:: Page -->

        <div id="m_scroll_top" class="m-scroll-top">
            <i class="la la-arrow-up"></i>
        </div>

            <div id="load">
                <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
            </div>
    

        <script src="/admin/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="/admin/assets/demo/demo6/base/scripts.bundle.js" type="text/javascript"></script>
        <!--end::Base Scripts -->
        <!--begin::Page Vendors Scripts -->
        <script src="/admin/assets/vendors/custom/jquery-ui/jquery-ui.bundle.js" type="text/javascript"></script>
        <!--end::Page Vendors Scripts -->
        <!--begin::Page Snippets -->
        
        <script src="/admin/assets/demo/demo6/blockui.js" type="text/javascript"></script>
        
        <script src="/admin/assets/app/js/dashboard.js" type="text/javascript"></script>
        <script src="/admin/assets/app/js/bootstrap-datepicker.min.js?v=0.0.1" type="text/javascript"></script>
        <script type="text/javascript" src="/admin/assets/app/ckeditors/ckeditor.js"></script>
        <script src="/admin/assets/demo/demo6/select2.js" type="text/javascript"></script>
        <script src="/admin/assets/app/js/jquery.multi-select.js" type="text/javascript"></script>
        <script src="/admin/assets/app/js/fancybox.min.js" type="text/javascript"></script>
        <script src="/admin/assets/app/js/tagsinput.js" type="text/javascript"></script>
        <script src="/admin/assets/app/colorpicker/dist/spectrum.min.js" type="text/javascript"></script>
        <script src="{{asset('js/rating-star-icons/dist/rating.js')}}"></script>
        
       @yield('js')
        <!--Start of Tawk.to Script-->
<script type="text/javascript">
     function swalError(data){
                    var errorMessage = "";
                        if(typeof data == 'object'){
                          console.log(typeof data);
                          
                            for (const error in data) {
                                            if (data.hasOwnProperty(error)) {
                                                errorMessage += '<p>'+data[error]+'</p>';
                                            }
                                        }
                        }
                        else{
                           errorMessage = data;
                        }
                        
                        swal.fire({
                            title: "",
                            html: errorMessage,
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "{{__('lang.ok')}}",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
      }
      
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('.date-picker').datepicker({
            uiLibrary: 'bootstrap4',
            format: "yyyy-mm-dd",
            language:"ar",
            rtl:true
        });
 $(document).ready(function() {
    $(".select2").select2({
      theme: "bootstrap4",
      placeholder: "اختر",
      autoclose: true
     });
    
 $('#example1').datepicker({
     format: "dd-mm-yyyy",
        autoclose: true,
        language:"ar",
        rtl:true
    });

    //Alternativ way
    $('#example2').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        language:"ar",
        rtl:true
    }).on('change', function(){
        $('.datepicker').hide();
    });


           $('.select2').select2({
                theme: 'bootstrap4',
                //containerCssClass: ':الكل:',
                placeholder: "اختر",
                allowClear: true
            });
        });

        $("#load").hide();
        $('#loading').hide();
</script>
<!--End of Tawk.to Script-->    

        <!--end::Page Snippets -->
    </body>

    <!-- end::Body -->
</html>


<!-- BEGIN: Header -->
    <style type="text/css">
      .required{
        color:red;
      }
    </style> 
      <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
        <div class="m-container m-container--fluid m-container--full-height">
          <div class="m-stack m-stack--ver m-stack--desktop">

            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-light ">
              <div class="m-stack m-stack--ver m-stack--general">
                <div class="m-stack__item m-stack__item--middle m-brand__logo">
                  <a href="/admin/dashboard" class="m-brand__logo-wrapper" style="   padding: 10px !important; ">
                    <img alt="" src="/admin/assets/demo/demo1/media/img/logo/logo.png" />
                  </a>
                  <h3 class="m-header__title">
                  <?php if( \App::getLocale() == 'en'): ?>
                  <?php echo e($settings->title_en ?? ''); ?>

                  <?php elseif( \App::getLocale() == 'ar' ): ?>
                  <?php echo e($settings->title_ar ?? ''); ?>

                  <?php endif; ?>  
                  </h3>
                </div>
                <div class="m-stack__item m-stack__item--middle m-brand__tools">

                  <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                  <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                    <span></span>
                  </a>

                  <!-- END -->

                  <!-- BEGIN: Responsive Header Menu Toggler -->
                  <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                    <span></span>
                  </a>

                  <!-- END -->

                  <!-- BEGIN: Topbar Toggler -->
                  <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                    <i class="flaticon-more"></i>
                  </a>
                
                  <!-- BEGIN: Topbar Toggler -->
                </div>
              </div>
            </div>

            <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
              <div class="m-header__title">
                <h3 class="m-header__title-text">
               
                  <p style="
    font-family:HelveticaBold;">
                  <?php if( \App::getLocale() == 'en'): ?>
                    <?php echo e($settings->title_en ?? ''); ?>

                <?php elseif( \App::getLocale() == 'ar' ): ?>
                    <?php echo e($settings->title_ar ?? ''); ?>

                <?php endif; ?> 
      </p>
    <p style="font-size: 14px;
    margin: 0;
    color: #969696;"></p>
    </h3>
              </div>

              <!-- BEGIN: Horizontal Menu -->
              <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
                <i class="la la-close"></i>
              </button>
              <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                  <li class="m-menu__item  m-menu__item--active  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true">
                    <!--  <a href="/admin/" class="m-menu__link" target="_blank">
                      <span class="m-menu__item-here"></span>
                      <span class="m-menu__link-text">خدمات المستخدمين</span> </a> -->
                    
                  </li>
                
                
                </ul>
              </div>

              <!-- END: Horizontal Menu -->

              <!-- BEGIN: Topbar -->
              <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                
                <div class="m-stack__item m-topbar__nav-wrapper">
                  <ul class="m-topbar__nav m-nav m-nav--inline">
                    <!-- <li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center  m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
                      <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon"> 
                        <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger" >55</span>
                        <span class="m-nav__link-icon">
                          <span class="m-nav__link-icon-wrapper">
                            <i class="flaticon-alarm"></i>
                          </span>
                        </span>
                      </a>
      

          

                      <div class="m-dropdown__wrapper">
                      <style type="text/css">
                        .noty_arr{right: auto!important; left: 12%!important;}
                      </style>
                        <span class="m-dropdown__arrow m-dropdown__arrow--center noty_arr"></span>
                        <div class="m-dropdown__inner">
                          <div class="m-dropdown__header m--align-center">
                            <span class="m-dropdown__header-title"> اشعار جديد</span>
                            
                          </div>
                          <div class="m-dropdown__body">
                            <div class="m-dropdown__content">
                              <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
                                <li class="nav-item m-tabs__item">
                                  <a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
                                    الإشعارات
                                  </a>
                                </li> 
                              </ul>




                              <div class="tab-content">
          <div class="tab-pane active" id="topbar_notifications_notifications " role="tabpanel">
            <div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
              <div class="m-list-timeline m-list-timeline--skin-light">
           <div class="m-list-timeline__items body_nofiction notificationsList"> 
            
                              
                                   
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li> -->
                   
                    <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                      <a href="#" class="m-nav__link m-dropdown__toggle">
                        <span class="m-topbar__userpic m--hide">
                          <!-- <img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt="" /> -->
                        </span>
                        <span class="m-nav__link-icon m-topbar__usericon">
                          <span class="m-nav__link-icon-wrapper">
                            <i class="flaticon-user-ok"></i>
                          </span>
                        </span>
                        <span class="m-topbar__username m--hide"></span>
                      </a>
                      <style type="text/css">
                        .logout_arr{right: auto!important; left: 6px!important;}
                      </style>
                      <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust logout_arr"></span>
                        <div class="m-dropdown__inner">
                          
                          <div class="m-dropdown__body">
                            <div class="m-dropdown__content">
                              <ul class="m-nav m-nav--skin-light">
                                
                                <li class="m-nav__item text-center" style="margin-bottom: 20px;">
                                  <a href="/admin/dashboard/profile" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder"><?php echo e(trans('lang.profile')); ?></a>
                                </li>
                                <li class="m-nav__item text-center">
                                    <a href="<?php echo e(route('admin.dashboard.logout')); ?>" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo e(trans('lang.logout')); ?></a>
                                    <form id="logout-form" action="/admin/logout" method="get" style="display: none;"></form>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
               
                  </ul>
                </div>
              </div>

              <!-- END: Topbar -->
            </div>
          </div>
        </div>
       
          <!-- $months_names = array();
  $GLOBALS['months_names'] = [["يناير",'01'],["فبراير",'02'],["مارس",'03'],
  ["أبريل",'04'],["مايو",'05'],["يونيو",'06'],["يوليو",'07']
  ,["أغسطس",'08'],["سبتمبر",'09'],["أكتوبر",'10']
  ,["نوفمبر",'11'],["ديسمبر",'12']]; -->
      


      </header>
<!-- <input type="hidden" class="no_noti" name="no_noti" value="0"> -->
<script>
  //  var showToastr = function (msg, type) {
  //       return toastr[type](msg);
  //   };


    //    $(document).ready(function(){
    //         getNotificationsAll();



    //        $('.changeNotificationView').click(function(){
    //            $.ajax({
    //                url: "/admin/Notification/setNotificationView",
    //                type: "GET",
    //                dataType: "JSON",
    //                data:{},
    //                success: function(data)
    //                {
    //                    $(".count_notfiction").html(0);
    //                }

    //            });

    //        })
    //       });


    //         function getNotificationsAll(){
    //     var div = $('.messageData').last();
    //     var id = div.attr('id');
    //     checkValue = false;

    //     $.ajax({
    //         url: "/admin/Notification/getNotificationsAll",
    //         type: "GET",
    //         dataType: "JSON",
    //         data:{},
    //         success: function(data)
    //         {
    //             $(".notificationsList").append(data['data']);
    //             if(data['count']==0){
    //             $(".count_notfiction").hide();
    //             }else{
    //                 $(".count_notfiction").show();
    //                 $(".count_notfiction").text(data['count']);
    //             }
                
    //         },
    //         complete: function(){

    //         },
    //         error: function (jqXHR, textStatus, errorThrown)
    //         {
    //            // location.reload();
    //         }
    //     });
    // }


    // function getNotifications(){
    //     var div = $('.messageData').last();
    //     var id = div.attr('id');
    //     checkValue = false;

    //     $.ajax({
    //         url: "/admin/Notification",
    //         type: "GET",
    //         dataType: "JSON",
    //         data:{},
    //         success: function(data)
    //         {
    //             $(".notificationsList").append(data['data']);

    //         $(".notificationsList").append(data['data']);
    //         if(data['count']==0 && ($(".count_notfiction").text()=='' || $(".count_notfiction").text()==0)){
    //             $(".count_notfiction").hide();
    //         }else{
    //             $(".count_notfiction").show();
    //             if(data['count']>0){
    //                 $('.no_noti').val(data['count']);
    //                 $(".count_notfiction").html(data['count']);

    //             }

    //         }

    //             data = data['notification'];

    //             for(i=0;i<data.length;i++){
    //                 if(data[i]['show_push_notification']==0){
    //                     if(data.length > 0){
    //                         $('<audio id="chatAudio"><source src="/admin/assets/notifications.mp3" type="audio/mpeg"></audio>').appendTo('body');
    //                         $('#chatAudio')[0].play();

    //                     }
    //                 var url = data[i]['NotificationUrl'];
    //                     toastr.options = {
    //                         "closeButton": true,
    //                         "debug": false,
    //                         "positionClass": "toast-bottom-left",
    //                         "onclick":  function () { location.href = '/admin/'+url; },
    //                         "showDuration": "1000",
    //                         "hideDuration": "1000",
    //                         "timeOut": "5000",
    //                         "extendedTimeOut": "1000",
    //                         "showEasing": "swing",
    //                         "hideEasing": "linear",
    //                         "showMethod": "fadeIn",
    //                         "hideMethod": "fadeOut"
    //                     };

    //                 showToastr(data[i]['NotificationMessage'], data[i]['push_notification_class']);
    //                 }
    //             }
    //         },
    //         complete: function(){

    //         },
    //         error: function (jqXHR, textStatus, errorThrown)
    //         {
    //             // location.reload();
    //         }
    //     });
    // }

    // window.setInterval(function(){
    //      getNotifications();
    // }, 6000);

</script>
      <!-- END: Header --><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/layout/header.blade.php ENDPATH**/ ?>
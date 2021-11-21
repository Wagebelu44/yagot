<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn">
<i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-light ">

<!-- BEGIN: Aside Menu -->
<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " data-menu-vertical="true" m-menu-scrollable="1" m-menu-dropdown-timeout="500">
<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/dashboard" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-home-2"></i>
    <span class="m-menu__link-text">{{trans('lang.home')}}</span>
</a>
</li>


@can('categorys')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/category" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-interface-8"></i>
    <span class="m-menu__link-text">{{trans('lang.category')}}</span>
</a>
</li>
@endcan

@can('product')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/products" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon fas fa-box"></i>
    <span class="m-menu__link-text">{{trans('lang.products')}}</span>
</a>
</li>
@endcan

@can('stones')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/stones" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon far fa-gem"></i>
    <span class="m-menu__link-text">{{trans('lang.stones')}}</span>
</a>
</li>
@endcan



@can('clients')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/clients" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon fas fa-users"></i>
    <span class="m-menu__link-text">{{trans('lang.clients')}}</span>
</a>
</li>
@endcan

@can('subscriptions')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/subscriptions" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon fas fa-award"></i>
    <span class="m-menu__link-text">{{trans('lang.subscriptions')}}</span>
</a>
</li> 
@endcan 

@can('slider')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/slider" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-interface-6"></i>
    <span class="m-menu__link-text">{{trans('lang.slider')}}</span>
</a>
</li> 
@endcan 

<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="/admin/country" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon fas fa-globe"></i>
        <span class="m-menu__link-text">الدول</span>
    </a>
    </li> 

@can('zones')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="/admin/zone" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon fas fa-map-marker-alt"></i>
        <span class="m-menu__link-text">{{trans('lang.zones')}}</span>
    </a>
    </li> 
    
    @endcan

    @can('banks')
        <li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="/admin/banks" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon far fa-building"></i>
                <span class="m-menu__link-text">{{trans('lang.banks')}}</span>
            </a>
         </li> 
    @endcan
        
    @can('banks_transfer')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="/admin/banks_transfer" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon fas fa-exchange-alt"></i>
        <span class="m-menu__link-text">{{trans('lang.banks_transfer')}}</span>
    </a>
    </li> 
    
    @endcan


@can('users')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/users" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-user"></i>
    <span class="m-menu__link-text">{{trans('lang.users')}}</span>
</a>
</li>
@endcan

@can('static_page')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/static_page" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-interface-9"></i>
    <span class="m-menu__link-text">{{trans('lang.static_page')}}</span>
</a>
</li>
@endcan

<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/contact" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-mail-1"></i>
    <span class="m-menu__link-text">{{trans('lang.contact_us')}}</span>
</a> 
</li>

@can('setting')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/setting" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-settings-1"></i>
    <span class="m-menu__link-text">{{trans('lang.setting')}}</span>
</a>
</li>
@endcan


@can('system_constants')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/system_constants" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-notes"></i>
    <span class="m-menu__link-text">{{trans('lang.system_constants')}}</span>
</a>
</li>
@endcan

@can('social')
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/social" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon fab fa-telegram-plane"></i>
    <span class="m-menu__link-text">{{trans('lang.social_media')}}</span>
</a>
</li>
@endcan

<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="/admin/notification" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon far fa-bell"></i>
        <span class="m-menu__link-text">الإشعارات</span>
    </a>
</li>


<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="/admin/home_order" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon fas fa-layer-group"></i>
        <span class="m-menu__link-text">{{trans('lang.home_order')}}</span>
    </a>
</li>


</ul>
</div>

<!-- END: Aside Menu -->
</div>

<!-- END: Left Aside -->
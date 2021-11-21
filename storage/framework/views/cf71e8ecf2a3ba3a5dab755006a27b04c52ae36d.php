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
    <span class="m-menu__link-text"><?php echo e(trans('lang.home')); ?></span>
</a>
</li>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('categorys')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/category" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-interface-8"></i>
    <span class="m-menu__link-text"><?php echo e(trans('lang.category')); ?></span>
</a>
</li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/products" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon fas fa-box"></i>
    <span class="m-menu__link-text"><?php echo e(trans('lang.products')); ?></span>
</a>
</li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stones')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/stones" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon far fa-gem"></i>
    <span class="m-menu__link-text"><?php echo e(trans('lang.stones')); ?></span>
</a>
</li>
<?php endif; ?>



<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clients')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/clients" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon fas fa-users"></i>
    <span class="m-menu__link-text"><?php echo e(trans('lang.clients')); ?></span>
</a>
</li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subscriptions')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/subscriptions" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon fas fa-award"></i>
    <span class="m-menu__link-text"><?php echo e(trans('lang.subscriptions')); ?></span>
</a>
</li> 
<?php endif; ?> 

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slider')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/slider" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-interface-6"></i>
    <span class="m-menu__link-text"><?php echo e(trans('lang.slider')); ?></span>
</a>
</li> 
<?php endif; ?> 

<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="/admin/country" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon fas fa-globe"></i>
        <span class="m-menu__link-text">الدول</span>
    </a>
    </li> 

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('zones')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="/admin/zone" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon fas fa-map-marker-alt"></i>
        <span class="m-menu__link-text"><?php echo e(trans('lang.zones')); ?></span>
    </a>
    </li> 
    
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('banks')): ?>
        <li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="/admin/banks" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon far fa-building"></i>
                <span class="m-menu__link-text"><?php echo e(trans('lang.banks')); ?></span>
            </a>
         </li> 
    <?php endif; ?>
        
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('banks_transfer')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="/admin/banks_transfer" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon fas fa-exchange-alt"></i>
        <span class="m-menu__link-text"><?php echo e(trans('lang.banks_transfer')); ?></span>
    </a>
    </li> 
    
    <?php endif; ?>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/users" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-user"></i>
    <span class="m-menu__link-text"><?php echo e(trans('lang.users')); ?></span>
</a>
</li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('static_page')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/static_page" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-interface-9"></i>
    <span class="m-menu__link-text"><?php echo e(trans('lang.static_page')); ?></span>
</a>
</li>
<?php endif; ?>

<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/contact" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-mail-1"></i>
    <span class="m-menu__link-text"><?php echo e(trans('lang.contact_us')); ?></span>
</a> 
</li>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/setting" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-settings-1"></i>
    <span class="m-menu__link-text"><?php echo e(trans('lang.setting')); ?></span>
</a>
</li>
<?php endif; ?>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('system_constants')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/system_constants" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon flaticon-notes"></i>
    <span class="m-menu__link-text"><?php echo e(trans('lang.system_constants')); ?></span>
</a>
</li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('social')): ?>
<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
<a href="/admin/social" class="m-menu__link m-menu__toggle">
    <i class="m-menu__link-icon fab fa-telegram-plane"></i>
    <span class="m-menu__link-text"><?php echo e(trans('lang.social_media')); ?></span>
</a>
</li>
<?php endif; ?>

<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="/admin/notification" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon far fa-bell"></i>
        <span class="m-menu__link-text">الإشعارات</span>
    </a>
</li>


<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="/admin/home_order" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon fas fa-layer-group"></i>
        <span class="m-menu__link-text"><?php echo e(trans('lang.home_order')); ?></span>
    </a>
</li>


</ul>
</div>

<!-- END: Aside Menu -->
</div>

<!-- END: Left Aside --><?php /**PATH /Users/fadymondy/Sites/yagot/resources/views/admin/layout/main_menu.blade.php ENDPATH**/ ?>
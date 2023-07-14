<nav class="sidebar__navigation__container">

    <div class="sidebar__header">
        <div class="shrink__btn">
            <i id="shrink" class="fa-solid fa-bars"></i>
        </div>
        <h3 class="header__title sidebar__logo__title">Todua</h3>
    </div>

    <div class="sidebar__main__content">
        <ul>

            <li class="sidebar__menu__item sidebar__menu__link__active">
                <a href="{{ route('dashboard') }}" class="sidebar__menu__link">
                    <i class="sidebar__menu__link__icon fa-solid fa-cubes-stacked"></i>
                    <span class="sidebar__menu__title">{{ __('admin.dashboard') }}</span>
                </a>
            </li>

            <li class="sidebar__menu__item sidebar__menu__item__parent">
                <a href="javascript:void(0)" class="sidebar__menu__link sidebar__menu__link__parent">
                    <i class="sidebar__menu__link__icon fa-solid fa-paste"></i>
                    <span class="sidebar__menu__title">{{ __('admin.room') }}</span>
                    <i class="fa fa-angle-down sidebar__menu__item__parent__arrow"></i>
                </a>
                <ul class="sidebar__submenu">
                    <li class="sidebar__submenu__item">
                        <a href="{{ route('room_create') }}" class="sidebar__submenu__link">
                            <i class="sidebar__submenu__link__icon fa-regular fa-paste"></i>

                            <span class="sidebar__submenu__title">{{ __('admin.room_create') }}</span>
                        </a>
                    </li>
                    <li class="sidebar__submenu__item">
                        <a href="{{ route('room_list') }}" class="sidebar__submenu__link ">
                            <i class="sidebar__submenu__link__icon fa-solid fa-bars-staggered"></i>
                            <span class="sidebar__submenu__title">{{ __('admin.room_list') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="sidebar__menu__item sidebar__menu__item__parent">
                <a href="javascript:void(0)" class="sidebar__menu__link sidebar__menu__link__parent">
                    <i class="sidebar__menu__link__icon fa-solid fa-paste"></i>
                    <span class="sidebar__menu__title">{{ __('admin.booking') }}</span>
                    <i class="fa fa-angle-down sidebar__menu__item__parent__arrow"></i>
                </a>
                <ul class="sidebar__submenu">
                    <li class="sidebar__submenu__item">
                        <a href="{{ route('booking_create') }}" class="sidebar__submenu__link">
                            <i class="sidebar__submenu__link__icon fa-regular fa-paste"></i>

                            <span class="sidebar__submenu__title">{{ __('admin.booking_create') }}</span>
                        </a>
                    </li>
                    <li class="sidebar__submenu__item">
                        <a href="{{ route('booking_list') }}" class="sidebar__submenu__link ">
                            <i class="sidebar__submenu__link__icon fa-solid fa-bars-staggered"></i>
                            <span class="sidebar__submenu__title">{{ __('admin.booking_list') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>


        <div class="logout__container">
            <a href="{{ route('admin_logout') }}">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="sidebar__menu__title__logout">{{ __('admin.logout') }}</span>
            </a>
        </div>

    </div>
</nav>

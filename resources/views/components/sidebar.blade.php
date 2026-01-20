<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('login') }}">
                <img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt="">
                <img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="">
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{ route('login') }}"><img class="img-fluid" src="../assets/images/logo/logo-icon.png" alt=""></a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="{{ route('login') }}"><img class="img-fluid" src="../assets/images/logo/logo-icon.png" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>

                    @can('viewAny', \App\Models\Restaurant::class)
                    @if(auth()->user()->restaurant || auth()->user()->hasRole('superadmin'))
                    @php $dashboardRoute = auth()->user()->hasRole('superadmin') ? 'superadmin.dashboard' : 'admin.dashboard'; @endphp
                    <li class="sidebar-list {{ request()->routeIs($dashboardRoute) ? 'active' : '' }}">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route($dashboardRoute) }}">
                            <i data-feather="monitor"></i><span>Панель управления</span>
                        </a>
                    </li>
                    @endif
                    @endcan

                    @can('viewAny', \App\Models\User::class)
                    <li class="sidebar-list {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('users.index') }}">
                            <i data-feather="users"></i><span>Администраторы</span>
                        </a>
                    </li>
                    @endcan

                    <li class="sidebar-list {{ request()->routeIs('restaurants.*') ? 'active' : '' }}">
                        @php
                        $hasNoRestaurant = auth()->user()->hasRole('admin') && !auth()->user()->restaurant;
                        $targetRoute = $hasNoRestaurant ? route('restaurants.index', ['create' => 1]) : route('restaurants.index');
                        $label = $hasNoRestaurant ? 'Создать ресторан' : 'Рестораны';
                        @endphp

                        @can('viewAny', \App\Models\Restaurant::class)
                        <a class="sidebar-link sidebar-title link-nav" href="{{ $targetRoute }}">
                            <i data-feather="home"></i>
                            <span>{{ $label }}</span>
                        </a>
                        @endcan
                    </li>

                    @can('viewAny', \App\Models\Category::class)
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                            href="{{ route('categories.index') }}">
                            <i data-feather="folder"></i><span>Категории</span>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \App\Models\Brand::class)
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs('brands.*') ? 'active' : '' }}"
                            href="{{ route('brands.index') }}">
                            <i data-feather="tag"></i><span>Бренды</span>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \App\Models\City::class)
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs('cities.*') ? 'active' : '' }}"
                            href="{{ route('cities.index') }}">
                            <i data-feather="map-pin"></i><span>Города</span>
                        </a>
                    </li>
                    @endcan

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
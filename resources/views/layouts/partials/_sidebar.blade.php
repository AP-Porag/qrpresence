<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="fa fa-home"></i><span> Dashboard </span>
                    </a>
                </li>

                <li
                    class="{{ request()->is('admin/users*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);"
                       class="has-arrow waves-effect {{ request()->is('admin/users*') ? 'mm-active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Administration</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                            <li class="{{ request()->is('admin/users*') ? 'mm-active' : '' }}">
                                <a href="{{ route('admin.users.index') }}"
                                   class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                    Admin
                                </a>
                            </li>

{{--                            <li class="{{ request()->is('admin/mentors*') ? 'mm-active' : '' }}">--}}
{{--                                <a href="{{ route('admin.mentors.index') }}"--}}
{{--                                   class="{{ (request()->routeIs('admin.mentors.index') || request()->routeIs('admin.mentors.create') || request()->routeIs('admin.mentors.edit')) ? 'active' : '' }}">--}}
{{--                                    Mentor--}}
{{--                                </a>--}}
{{--                            </li>--}}
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

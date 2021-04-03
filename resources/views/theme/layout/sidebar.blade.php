<div class="menu-sidebar__content js-scrollbar1">
    <nav class="navbar-sidebar">
        <ul class="list-unstyled navbar__list">
        
            <li class="{{ request()->is('/') ? 'active' : '' }} has-sub">
                <a class="js-arrow" href="{{route('dashboard')}}">
                    <i class="fas fa-tv "></i>Dashboard</a>
            </li>
            
            @permission('view_customer')
                <li class="{{ request()->is('show-customer') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="{{route('show_customer')}}">
                        <i class="fas fa-users "></i>Customers</a>
                </li>
            @endpermission

            @permission('view_owner')
                <li class="{{ request()->is('show-owner') ? 'active' :( request()->is('show-owner') ? 'active' : '' )}} has-sub">
                    <a class="js-arrow" href="{{route('show_owner')}}">
                        <i class="fas fa-user-md "></i>Owners</a>
                </li>
            @endpermission

            @permission('view_user')
                <li class="{{ request()->is('show-user') ? 'active' : '' }} has-sub">
                    <a  href="{{route('show_user')}}">
                    <i class="fas fa-users"></i>Users</a>
                </li>
            @endpermission

            @permission('view_quatationadd')
                <li class="{{ request()->is('show-quatation') ? 'active' : (request()->is('add-quatation') ? 'active' : (request()->is('edit-quatation/*') ? 'active' : '')) }} has-sub">
                    <a class="js-arrow" href="{{route('show_quatation')}}">
                    <i class="fas fa-book "></i>Quotations</a>
                </li>
            @endpermission

           
            <li class="has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-shopping-cart"></i>Orders</a>
                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                    <li>
                        <a href="index.html">Orders</a>
                    </li>
                    <li>
                        <a href="index2.html">Partial Orders</a>
                    </li>
                </ul>
            </li>
           

            @permission('view_reason')
                <li class="{{ request()->is('show-reason') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="{{route('show_reason')}}">
                    <i class="fas fa-tags"></i>Reasons</a>
                </li>
            @endpermission

            @permission('view_product')
                <li class="{{ request()->is('show-product') ? 'active' :( request()->is('add-product') ? 'active' : '') }} has-sub">
                    <a class="js-arrow" href="{{ route('show_product')}}">
                    <i class="fas fa-briefcase"></i>Products</a>
                </li>
            @endpermission

            @permission('view_parameter')
                <li class="{{ request()->is('show-parameter') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="{{ route('show_parameter')}}">
                    <i class="fas fa-glass "></i>Parameters</a>
                </li>
            @endpermission


            @permission('view_usp')
                <li class="{{ request()->is('show-usp') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="{{ route('show_usp')}}">
                    <i class="fas fa-tasks "></i>USP</a>
                </li>
            @endpermission

            @permission('view_brand')
                <li class="{{ request()->is('show-brand') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="{{route('show_brand')}}">
                    <i class="fas fa-square "></i>Brands</a>
                </li>
            @endpermission

            @permission('view_category')
                <li class="{{ request()->is('show-category') ? 'active' : '' }} has-sub">
                    <a href="{{route('show_category')}}">
                    <i class="fas  fa-list "></i>Categories</a>
                </li>
            @endpermission

            @permission('view_notify')
                <li class="{{ request()->is('show-notify') ? 'active' : '' }} has-sub">
                    <a  href="{{route('show_notify')}}">
                    <i class="fas fa-tags"></i>Notifications</a>
                </li>
            @endpermission

            @permission('view_principal')
                <li class="{{ request()->is('show-principals') ? 'active' : '' }} has-sub">
                    <a  href="{{route('show_principals')}}">
                    <i class="fas  fa-tablet"></i>Principals</a>
                </li>
            @endpermission

            @permission('view_quatation')
                <li class="{{ request()->is('show-quatation-format') ? 'active' : '' }} has-sub">
                    <a  href="{{route('show_quatation_format')}}">
                    <i class="fas fa-list-alt"></i>Quatations Format</a>
                </li>
            @endpermission
        
            @permission('view_courier')
                <li class="{{ request()->is('show-courier') ? 'active' : '' }} has-sub">
                    <a  href="{{route('show_courier')}}">
                    <i class="fas fa-envelope"></i>Couriers</a>
                </li>
            @endpermission
        </ul>
    </nav>
</div>

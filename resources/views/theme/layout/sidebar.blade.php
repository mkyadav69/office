<div class="menu-sidebar__content js-scrollbar1">
    <nav class="navbar-sidebar">
        <ul class="list-unstyled navbar__list">
                <li class="{{ request()->is('show-customer') ? 'active' :( request()->is('show-owner') ? 'active' : '' )}} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-users "></i>Customer & Owner</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        @permission('view_customer')
                            <li>
                                <a href="{{route('show_customer')}}">Manage Customers</a>
                            </li>
                        @endpermission
                        @permission('view_owner')
                            <li>
                                <a href="{{route('show_owner')}}">Manage Owners</a>
                            </li>
                        @endpermission
                    </ul>
                </li>
                
                <li class="{{ request()->is('show-quatation') ? 'active' : (request()->is('add-quatation') ? 'active' : (request()->is('edit-quatation/*') ? 'active' : '')) }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-book "></i>Quotations</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        @permission('view_quatationadd')
                            <li>
                                <a href="{{route('show_quatation')}}">Manage Quotations</a>
                            </li>
                        @endpermission
                        @permission('add_quatationadd')
                            <li>
                                <a href="{{route('add_quatation')}}">Add Quotation</a>
                            </li>
                        @endpermission
                    </ul>
                </li>
            
                
            @permission('view_reason')
                <li class="{{ request()->is('show-reason') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas  fa-tags "></i>Reasons</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('show_reason')}}">Manage Reason</a>
                        </li>
                    </ul>
                </li>
            @endpermission

            @permission('view_product') 
                <li class="{{ request()->is('show-product') ? 'active' :( request()->is('add-product') ? 'active' : '') }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-briefcase "></i>Products</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ route('show_product')}}">Manage Product</a>
                        </li>
                    </ul>
                </li>
            @endpermission
            
            @permission('view_parameter') 
                <li class="{{ request()->is('show-parameter') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-glass "></i>Parameters</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ route('show_parameter')}}">Manage Parameter</a>
                        </li>
                    </ul>
                </li>
            @endpermission

            @permission('view_usp') 
                <li class="{{ request()->is('show-usp') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tasks "></i>Usp List</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ route('show_usp')}}">Manage Usp List</a>
                        </li>
                    </ul>
                </li>
            @endpermission
            
            @permission('view_brand') 
                <li class="{{ request()->is('show-brand') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-square "></i>Brands</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('show_brand')}}">Manage Brands</a>
                        </li>
                    </ul>
                </li>
            @endpermission
            
            
            @permission('view_category') 
                <li class="{{ request()->is('show-category') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas   fa-shopping-cart "></i>Categories</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('show_category')}}">Manage Category</a>
                        </li>
                    </ul>
                </li>
            @endpermission 

            @permission('view_notify')
                <li class="{{ request()->is('show-notify') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tags "></i>Notifications</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('show_notify')}}">Manage Notification</a>
                        </li>
                    </ul>
                </li>
            @endpermission 

            @permission('view_principal')
                <li class="{{ request()->is('show-principals') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tablet "></i>Principals</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('show_principals')}}">Manage Principals</a>
                        </li>
                    </ul>
                </li>
            @endpermission 

            @permission('view_quatation')
                <li class="{{ request()->is('show-quatation-format') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-list-alt "></i>Quatations Format</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('show_quatation_format')}}">Manage Quatation Format</a>
                        </li>
                    </ul>
                </li>
            @endpermission 

          
            @permission('view_courier')
                <li class="{{ request()->is('show-courier') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas  fa-envelope "></i>Couriers</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('show_courier')}}">Manage Courier</a>
                        </li>
                    </ul>
                </li>
            @endpermission

            @permission('view_user')
                <li class="{{ request()->is('show-user') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas  fa-users"></i>Users</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('show_user')}}">Manage User</a>
                        </li>
                    </ul>
                </li>
            @endpermission

            @permission('view_role')
                <li class="{{ request()->is('show-role') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas  fa-user "></i>Roles & Permissions</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('show_role')}}">Manage Roles</a>
                        </li>
                    </ul>
                </li>
            @endpermission
        </ul>
    </nav>
</div>

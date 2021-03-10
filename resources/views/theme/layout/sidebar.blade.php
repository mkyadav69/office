<div class="menu-sidebar__content js-scrollbar1">
    <nav class="navbar-sidebar">
        <ul class="list-unstyled navbar__list">
            <li class="{{ request()->is('show-customer') ? 'active' :( request()->is('show-owner') ? 'active' : '' )}} has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-users"></i>Customers & Owner</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{route('show_customer')}}">Manage Customers</a>
                    </li>
                    <li>
                        <a href="{{route('show_owner')}}">Manage Owners</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('show-quatation') ? 'active' : (request()->is('add-quatation') ? 'active' : (request()->is('edit-quatation/*') ? 'active' : '')) }} has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-book"></i>Quotations</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{route('show_quatation')}}">Manage Quotations</a>
                    </li>
                    <li>
                        <a href="{{route('add_quatation')}}">Add Quotation</a>
                    </li>
                </ul>

            <!-- <li class="has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-book"></i>Order</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="index.html">View All Orders</a>
                    </li>
                    <li>
                        <a href="index2.html">View All Partial Orders</a>
                    </li>
                </ul>
            </li> -->


            <!-- <li class="has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas   fa-bookmark"></i>View Invoice</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="index.html">View Invoice List</a>
                    </li>
                </ul>
            </li> -->

            <li class="{{ request()->is('show-reason') ? 'active' : '' }} has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas  fa-tags"></i>Reasons</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{route('show_reason')}}">Manage Reason</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('show-product') ? 'active' :( request()->is('add-product') ? 'active' : '') }} has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-briefcase"></i>Products</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{ route('show_product')}}">Manage Product</a>
                    </li>
                </ul>
            </li>
            
            <li class="{{ request()->is('show-parameter') ? 'active' : '' }} has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-glass"></i>Products Parameter</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{ route('show_parameter')}}">Manage Parameter</a>
                    </li>
                </ul>
            </li>
            
            <li class="{{ request()->is('show-usp') ? 'active' : '' }} has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-tasks"></i>Usp List</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{ route('show_usp')}}">Manage Usp List</a>
                    </li>
                </ul>
            </li>
            
            <li class="{{ request()->is('show-brand') ? 'active' : '' }} has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-square"></i>Brand</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{route('show_brand')}}">Manage Brands</a>
                    </li>
                </ul>
            </li>

            <!-- <li class="has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-file"></i>Report</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="index.html">View Quatation Report</a>
                    </li>
                    <li>
                        <a href="index.html">View Order Report</a>
                    </li>
                </ul>
            </li> -->
            
            <li class="{{ request()->is('show-category') ? 'active' : '' }} has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas   fa-shopping-cart"></i>Category</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{route('show_category')}}">Manage Category</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('show-notify') ? 'active' : '' }} has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-tags"></i>Notification</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{route('show_notify')}}">Manage Notification</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('show-principals') ? 'active' : '' }} has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-tablet"></i>Principals</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{route('show_principals')}}">Manage Principals</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('show-quatation-format') ? 'active' : '' }} has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas   fa-list-alt"></i>Quatations Format</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{route('show_quatation_format')}}">Manage Quatation Format</a>
                    </li>
                </ul>
            </li>

          

            <li class="{{ request()->is('show-courier') ? 'active' : '' }} has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas  fa-envelope"></i>Courier</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{route('show_courier')}}">Manage Courier</a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</div>

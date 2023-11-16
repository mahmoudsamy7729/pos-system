            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark is-compact" data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-menu-trigger">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-sidebar-brand">
                        <a href="#" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{asset('images/logo.png')}}"  alt="logo">
                            <img class="logo-dark logo-img" src="{{asset('images/logo-dark.png')}}"  alt="logo-dark">
                        </a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element nk-sidebar-body">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                        <span class="nk-menu-text">{{__('dashboard')}}</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-cart-fill"></em></span>
                                        <span class="nk-menu-text">{{__('sales')}}</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @can('pos')
                                        <li class="nk-menu-item">
                                            <a href="{{route('pos.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-dot-box-fill me-1"></em>{{__('pos')}}</span></a>
                                        </li>
                                        @endcan
                                        <li class="nk-menu-item">
                                            <a href="{{route('sales.add.form.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-plus-round-fill me-1"></em>{{__('new invoice')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('sales.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-list-fill me-1"></em>{{__('invoices list')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('pos.sessions.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-dot-box-fill me-1"></em>{{__('sessions')}}</span></a>
                                        </li>
                                        
                                    </ul>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                        <span class="nk-menu-text">{{__('customers')}}</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{route('customers.add.form.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-user-add-fill me-1"></em>{{__('new customer')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('customers.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-user-list-fill me-1"></em>{{__('customers list')}}</span></a>
                                        </li>
                                    </ul>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-money"></em></span>
                                        <span class="nk-menu-text">{{__('purchase')}}</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{route('purchase.add.form.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-plus-round-fill me-1"></em>{{__('new purchase')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('purchase.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-list-fill me-1"></em>{{__('purchase list')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('payments.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-list-fill me-1"></em>{{__('payments list')}}</span></a>
                                        </li>
                                    </ul>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                        <span class="nk-menu-text">{{__('suppliers')}}</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{route('suppliers.add.form.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-user-add-fill me-1"></em>{{__('new supplier')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('suppliers.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-user-list-fill me-1"></em>{{__('suppliers list')}}</span></a>
                                        </li>
                                    </ul>
                                </li><!-- .nk-menu-item -->
                                @can('items-manage')
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-package-fill"></em></span>
                                        <span class="nk-menu-text">{{__('items')}}</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{route('items.add.form.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-plus-round-fill me-1"></em>{{__('new item')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('items.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-list-fill me-1"></em>{{__('items list')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('items.category.add.form.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-plus-round-fill me-1"></em>{{__('new category')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('items.categories.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-list-fill me-1"></em>{{__('categories list')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('items.stock.count')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="fas fa-cubes me-1"></em>{{__('stock count')}}</span></a>
                                        </li>
                                    </ul>
                                </li><!-- .nk-menu-item -->
                                @endcan
                                @can('expenses-manage')                                
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-minus-circle-fill"></em></span>
                                        <span class="nk-menu-text">{{__('expenses')}}</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{route('expenses.add.form.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-plus-round-fill me-1"></em>{{__('new expense')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('expenses.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-list-fill me-1"></em>{{__('expenses list')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('expenses.category.add.form.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-plus-round-fill me-1"></em>{{__('new category')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('expenses.categories.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-list-fill me-1"></em>{{__('categories list')}}</span></a>
                                        </li>
                                    </ul>
                                </li><!-- .nk-menu-item -->
                                @endcan
                                
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-reports"></em></span>
                                        <span class="nk-menu-text">{{__('reports')}}</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="html/hotel/report-stocks.html" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-report-profit me-1"></em>Sales Report</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="html/hotel/report-expenses.html" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-report-profit me-1"></em>Sales Payments Report</span></a>
                                        </li>
                                    </ul>
                                </li><!-- .nk-menu-item -->

                                @can('users-manage')
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                        <span class="nk-menu-text">{{__('users')}}</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{route('users.add.form.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-user-add-fill me-1"></em>{{__('new user')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('users.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-user-list-fill me-1"></em>{{__('users list')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('roles.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-shield-star-fill me-1"></em>{{__('roles list')}}</span></a>
                                        </li>
                                    </ul>
                                </li><!-- .nk-menu-item -->
                                @endcan

                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-home-fill"></em></span>
                                        <span class="nk-menu-text">{{__('warehouse')}}</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{route('warehouse.add.form.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-plus-round-fill me-1"></em>{{__('new warehouse')}}</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('warehouses.show')}}" class="nk-menu-link"><span class="nk-menu-text"><em class="icon ni ni-list-fill me-1"></em>{{__('warehouses list')}}</span></a>
                                        </li>
                                    </ul>
                                </li><!-- .nk-menu-item -->
                                
                                <li class="nk-menu-item">
                                    <a href="html/hotel/settings.html" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-setting-alt-fill"></em></span>
                                        <span class="nk-menu-text">{{__('settings')}}</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
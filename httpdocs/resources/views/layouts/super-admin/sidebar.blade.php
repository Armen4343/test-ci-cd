<div class="aside-menu flex-column-fluid px-5">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 pe-4 me-n4" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="{lg: '75px'}">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="fas fa-cog text-danger"></i>
                    </span>
                    <span class="menu-title">Settings</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link"  href="{{ route('super.admin.home.page.banner') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Home page banner</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link"  href="{{ route('super.admin.front.page.images') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Front page images</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link"  href="{{ route('super.admin.popup.banner') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Popup banner</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('super.admin.about.us') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">About us</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('super.admin.terms.and.conditions') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Terms &amp; conditions</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('super.admin.login.register.banner') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Login &amp; register banner</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('super.admin.contact.us') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Contact us</span>
                        </a>
                    </div>
                </div>
            </div>


            <!-- account start -->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="fas fa-users text-primary"></i>
                    </span>
                    <span class="menu-title">Manage users</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link"  href="{{ route('super.user.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Super Admins</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('vendor.user.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Vendors</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('customer.user.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Customers</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- account end -->

			<!-- account start -->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                       <i class="fas fa-boxes text-info"></i>
                    </span>
                    <span class="menu-title">Category</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
					<div class="menu-item">
                        <a class="menu-link" href="#" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add Category</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link"  href="{{ route('categories.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List Category</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
						<i class="fas fa-hamburger text-primary"></i>
                    </span>
                    <span class="menu-title">Items</span>
                    <span class="menu-arrow"></span>
                </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="{{route('items.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                                <span class="menu-title">Prodotti Listati</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- account end -->

			<!-- account start -->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                       <i class="fas fa-file-alt text-success"></i>
                    </span>
                    <span class="menu-title">Sales Tax</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
					<div class="menu-item">
                        <a class="menu-link" href="#" data-bs-toggle="modal" data-bs-target="#addTaxModal">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add Sales Tax</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link"  href="{{ route('taxes.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List Sales Tax</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- account end -->
			<!-- account start -->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                       <i class="fas fa-file-alt text-success"></i>
                    </span>
                    <span class="menu-title">Subscription Emails</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
					<div class="menu-item">
                        <a class="menu-link" href="#" data-bs-toggle="modal" data-bs-target="#addSubscriptionModal">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add Subscription Email</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link"  href="{{ route('subscriptions.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List Subscription Emails</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- account end -->
            <!-- account start -->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                       <i class="fas fa-file-alt text-success"></i>
                    </span>
                    <span class="menu-title">Orders</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
					<div class="menu-item">
                        <a class="menu-link"  href="{{ route('orders.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">View Orders</span>
                        </a>
						 <a class="menu-link"  href="{{ route('super.admin.orders.cancelled') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Cancelled Orders</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- account end -->

            <!-- account start -->
            <div class="menu-item">
                <a class="menu-link"  href="{{ route('super.admin.ratings.index') }}">
                    <span class="menu-icon">
                        <i class="fas fa-star text-danger"></i>
                    </span>
                    <span class="menu-title">Ratings</span>
                </a>
            </div>
            <!-- account end -->

            <!-- account start -->
            <div class="menu-item">
                <a class="menu-link" href="{{ route('super.admin.eco-wallet.index') }}">
                    <span class="menu-icon">
                        <img width="16" src="{{asset('images/eco_wallet.png')}}"></img>
                    </span>
                    <span class="menu-title">ZeepUp Eco Wallet</span>
                </a>
            </div>
            <!-- account end -->
        </div>
        <!--end::Menu-->
    </div>
</div>

<div class="aside-menu flex-column-fluid px-5">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 pe-4 me-n4" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="{lg: '75px'}">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">
            
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="fas fa-home text-danger"></i>
                    </span>
                    <span class="menu-title">Home</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('vendor.myorder.reports') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Reports</span>
                        </a>
                    </div>
                </div>
            </div>
          
        </div>
        <!--end::Menu-->
		 <!--begin::Menu-->
        <div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">
            
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="fas fa-star text-success"></i>
                    </span>
                    <span class="menu-title">I tuoi Rating</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('vendor.view.ratings') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Ratings</span>
                        </a>
                    </div>
                </div>
            </div>
          
        </div>
        <!--end::Menu-->
		<div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">
            
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
						<i class="fas fa-hamburger text-primary"></i>
                    </span>
                    <span class="menu-title">I tuoi Prodotti</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="#" data-bs-toggle="modal" data-bs-target="#{{ (\Request::route()->getName() == 'items.edit') ? 'pleaseEditFirst' : 'addItemModal' }}" >
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Crea Prodotto</span>
                        </a>
                    </div>
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
        <!--end::Menu-->
		<div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">
            <!--elisa
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
						<i class="fas fa-utensils text-info"></i>
                    </span> 
                    <span class="menu-title">Basket Offerta Prodotti</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="#" data-bs-toggle="modal" data-bs-target="#addMenuModal">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Crea Basket Offerta</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('menus.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Basket Listati</span> 
                        </a>
                    </div>
                </div>
            </div> elisa-->
          
        </div>
        <!--end::Menu--> 
		<div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">
            <!--elisa
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                       <i class="fa-solid fa-receipt" style="color:#3CB944;"></i>
						
                    </span> 
                    <span class="menu-title">Scegli SottoCategoria Prodotto</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="#" data-bs-toggle="modal" data-bs-target="#addCuisineModal">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Crea SottoCategoria</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('cuisines.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">SottoCategorie Listate</span>
                        </a> 
                    </div>
                </div> 
            </div> elisa-->
          
        </div>
        <!--end::Menu-->
		<?php
        /*<div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="fa-solid fa-coins "  style="color:#042E76;"></i>
                    </span>
                    <span class="menu-title">Special Tax</span> 
                    <span class="menu-arrow"></span>
                </span> 
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="#" data-bs-toggle="modal" data-bs-target="#addSpecialTaxModal">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add Tax</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('special-taxes.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List Tax</span>
                        </a>
                    </div>
                </div> 
            </div>
        </div>*/
        ?>
        <!--end::Menu-->
        <!--end::Menu-->
		<div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">
            
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
						<i class="fa-solid fa-basket-shopping "  style="color:#F5C951;"></i>
                    </span>
                    <span class="menu-title">I tuoi Ordini</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('myorders.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Ordini Ricevuti</span>
                        </a>
                    </div>
                </div>
				 <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link"  href="{{ route('vendor.orders.cancelled') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Ordini Cancellati</span>
                        </a>
                    </div>
                </div>
            </div>
          
        </div>
        <div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">
            
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
						<i class="fa-solid fa-pen-to-square " style="color:#AC7602;"></i>
                    </span>
                    <span class="menu-title">Pagamenti</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="#" data-bs-toggle="modal" data-bs-target="#vendorStripeValidation">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Connetti il tuo C/C</span>
                        </a>
                    </div>
                </div>
            </div>
          
        </div>
        <!--end::Menu-->
        <!--end::Menu-->
		<div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">
            
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
						<i class="fa-regular fa-heart main-pink-color"></i>
                    </span>
                    <span class="menu-title">La tua Insegna</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                          <a href="{{ url('vendor/profile/setting') }}"  class="menu-link" >
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Inserisci Logo & Banner</span>
                        </a>
                    </div>
                </div>
            </div>
          
        </div>
        <!--end::Menu-->
		
    </div>
</div>

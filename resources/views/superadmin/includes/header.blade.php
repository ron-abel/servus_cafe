<div class="aside aside-left d-flex aside-fixed d-flex flex-column flex-row-auto" id="kt_aside" style="overflow-y:auto;">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->
        <a href="/">
            <img alt="Logo" src="{{ asset('img/client/logo1.png') }}" style="max-height: 130px !important;width:auto;" class="max-h-80px max-w-450px" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    <!--begin::Nav Wrapper-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Nav-->
            <ul class="menu-nav" role="tablist">

                <!--begin::Item-->
                <li class="menu-item " data-toggle="tooltip" title="Dashboard">
                    <a href="{{url('/admin')}}" class="menu-link">
                        <span class="svg-icon menu-icon"><i class="icon-xl la la-dashboard"></i></span>
                        <span class="menu-text"> Dashboard </span>
                    </a>
                </li>

                <!--begin::Item-->
                <li class="menu-item {{ request()->route()->getName()=='tenants' ? 'active': '' }}" data-toggle="tooltip" title="Tenants">
                    <a href="{{url('/admin')}}" class="menu-link">
                        <span class="svg-icon menu-icon"><i class="icon-xl la la-user-shield"></i></span>
                        <span class="menu-text"> School </span>
                    </a>
                </li>

                <li class="menu-item {{ request()->route()->getName()=='templates' ? 'active': '' }}" title="Templates">
					<a href="{{url('/admin/order')}}" class="menu-link">
						<span class="svg-icon menu-icon"><i class="icon-xl la la-th-large"></i></span>
						<span class="menu-text"> Orders </span>
					</a>
				</li>

                <li class="menu-item {{ request()->route()->getName()=='templates' ? 'active': '' }}" title="Templates">
					<a href="{{url('/admin/location')}}" class="menu-link">
						<span class="svg-icon menu-icon"><i class="icon-xl la la-th-large"></i></span>
						<span class="menu-text"> Pickup Times </span>
					</a>
				</li>

                <li class="menu-item {{ request()->route()->getName()=='templates' ? 'active': '' }}" title="Templates">
					<a href="{{url('/admin/sandwich')}}" class="menu-link">
						<span class="svg-icon menu-icon"><i class="icon-xl la la-th-large"></i></span>
						<span class="menu-text"> Sandwitches </span>
					</a>
				</li>

                <li class="menu-item {{ request()->route()->getName()=='templates' ? 'active': '' }}" title="Templates">
					<a href="{{url('/admin/topping')}}" class="menu-link">
						<span class="svg-icon menu-icon"><i class="icon-xl la la-th-large"></i></span>
						<span class="menu-text"> Toppings </span>
					</a>
				</li>


            </ul>
            <!--end::Nav-->
        </div>
    </div>
    <!--end::Nav Wrapper-->
    <!--begin::Footer-->
    <div class="aside-footer aside-menu">
        <!--begin::User-->

        <ul class="menu-nav w-100" role="tablist">
            <li class="menu-item w-100" title="Logout" style="list-style: none;">
                <!-- <a href="#" class="menu-link" data-toggle="tooltip" title="Logout">
                    <span class="svg-icon menu-icon"><i class="icon-xl la la-sign-out"></i></span>
                    <span class="menu-text">Logout</span>
                </a> -->
                <a class="log-out-btn menu-item text-dark menu-link d-flex" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <span class="svg-icon menu-icon"><i class="icon-xl la la-sign-out"></i></span>
                    <span class="menu-text">Logout</span> </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
            </li>
        </ul>

        <!--end::User-->
    </div>
    <!--end::Footer-->

    <!--end::Primary-->
</div>

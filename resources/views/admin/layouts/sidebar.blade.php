<div class="slimscroll-menu">
    <!-- User box -->
    <div class="user-box text-center">
        <img src="{{asset('/adminto/dist/assets/images/users/user-1.jpg')}}" alt="user-img" title=""
            class="rounded-circle img-thumbnail avatar-md">
        <div class="dropdown">
            <span class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown"
                aria-expanded="false">{{Auth::user()->name}}</span>
        </div>
        <p class="text-muted">&nbsp;</p>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <ul class="metismenu" id="side-menu">
            <li>
                <a href="{{route('admin.home')}}">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.product.index')}}">
                    <i class="fas fa-boxes"></i>
                    <span> Products </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.invoice.index')}}">
                    <i class="fas fa-money-bill"></i>
                    <span> Invoices </span>
                </a>
            </li>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
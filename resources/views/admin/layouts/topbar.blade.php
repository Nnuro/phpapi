
<!-- Top Bar Start -->
        <div class="topbar">


            <!-- LOGO -->
            <div class="topbar-left">
                <a href="{{route('dashboard.index')}}" class="logo">
                    {{-- <span>
                        <img src="{{url('admin/images/logo-sm.png')}}" alt="logo-small" class="logo-sm">
                    </span>
                    <span>
                        <img src="{{url('admin/images/logo-dark.png')}}" alt="logo-large" class="logo-lg">
                    </span>
                    <span>
                        <img src="{{url('admin/images/logo.png')}}" alt="logo-large" class="logo-light">
                    </span> --}}
                    NNURO
                </a>
            </div>
            <!--end logo-->
            <!-- Navbar -->
            <nav class="navbar-custom">    
                <ul class="list-unstyled topbar-nav float-right mb-0"> 
                    <li class="hidden-sm">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="javascript: void(0);" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            English <img src="../assets/images/flags/us_flag.jpg" class="ml-2" height="16" alt=""/> <i class="mdi mdi-chevron-down"></i> 
                        </a>
                        {{-- <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript: void(0);"><span> German </span><img src="../assets/images/flags/germany_flag.jpg" alt="" class="ml-2 float-right" height="14"/></a>
                            <a class="dropdown-item" href="javascript: void(0);"><span> Italian </span><img src="../assets/images/flags/italy_flag.jpg" alt="" class="ml-2 float-right" height="14"/></a>
                            <a class="dropdown-item" href="javascript: void(0);"><span> French </span><img src="../assets/images/flags/french_flag.jpg" alt="" class="ml-2 float-right" height="14"/></a>
                            <a class="dropdown-item" href="javascript: void(0);"><span> Spanish </span><img src="../assets/images/flags/spain_flag.jpg" alt="" class="ml-2 float-right" height="14"/></a>
                            <a class="dropdown-item" href="javascript: void(0);"><span> Russian </span><img src="../assets/images/flags/russia_flag.jpg" alt="" class="ml-2 float-right" height="14"/></a>
                        </div> --}}
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <i class="dripicons-bell noti-icon"></i>
                            <span class="badge badge-danger badge-pill noti-icon-badge">2</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                            <!-- item-->
                            <h6 class="dropdown-item-text">
                                Notifications (18)


                            </h6>
                            @auth
                            @if (Auth::user()->hasRole('Admin'))
                            <div class="slimscroll notification-list">
                                <!-- item-->
                                @foreach ($wholesalers as $wholesaler)
                                @if (!$wholesaler->hasRole('Wholesaler'))
                                 <a href="{{route('approve.users', $wholesaler->id)}}" class="dropdown-item notify-item active">
                                     <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                     <p class="notify-details">{{$wholesaler->name}}
                                         <small class="text-muted">Pending Approval & Authorization</small></p>
                                 </a>
                                 @endif
                                @endforeach
                                @foreach ($retailers as $retailer)
                                 @if (!$wholesaler->hasRole('Retailer'))
                                 <a href="{{route('approve.users', $retailer->id)}}" class="dropdown-item notify-item active">
                                     <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                     <p class="notify-details">{{$retailer->name}}
                                         <small class="text-muted">Pending Approval & Authorization</small></p>
                                 </a>
                                 @endif
                                @endforeach

                            </div>
                            @endif
                            @endauth
                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                                View all <i class="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            {{--  <img src="{{url('assets/images/users/user-4.jpg')}}" alt="profile-user" class="rounded-circle" />   --}}
                            <span class="ml-1 nav-user-name hidden-sm">
                                @auth
                                {{ Auth::user()->name }} 
                                @endauth
                                <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('profile.index')}}"><i class="dripicons-user text-muted mr-2"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" ><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul><!--end topbar-nav-->
    
                <ul class="list-unstyled topbar-nav mb-0">
                    <li>
                        <button class="button-menu-mobile nav-link waves-effect waves-light">
                            <i class="dripicons-menu nav-icon"></i>
                        </button>
                    </li>
                    <li class="hide-phone app-search">
                        <form role="search" class="">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href=""><i class="fas fa-search"></i></a>
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- end navbar-->
        </div>
        <!-- Top Bar End -->
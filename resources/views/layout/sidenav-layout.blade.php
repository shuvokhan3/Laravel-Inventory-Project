<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>DashBoard</title>

    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}" />
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('css/toastify.min.css')}}" rel="stylesheet" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />


    <link href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <script src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>


    <script src="{{asset('js/toastify-js.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/config.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>


</head>
<body>


<div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
</div>

<!-- Top Navbar -->
<nav class="navbar fixed-top shadow-sm bg-white">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <span class="icon-nav me-3" onclick="MenuBarClickHandler()">
                <img class="nav-logo-sm" src="{{asset('images/menu.svg')}}" alt="menu"/>
            </span>
            <a class="navbar-brand" href="{{url('/dashboard')}}">
                <img class="nav-logo" src="{{asset('images/logo.png')}}" alt="logo"/>
            </a>
        </div>

        <div class="d-flex align-items-center">
            <!-- You could add notifications, messages, etc. here -->
            <div class="user-dropdown ms-3">
                <div class="d-flex align-items-center">
                    <div class="me-2 d-none d-md-block">

                        <div class="fw-bold" id="AdminUser"></div>
                        <div class="small text-muted" id="Administrator">Administrator</div>

                    </div>
                    <img class="icon-nav-img" src="{{asset('images/user.webp')}}" alt="User"/>
                </div>
                <div class="user-dropdown-content">
                    <div class="pt-3 pb-2 text-center">
                        <img class="icon-nav-img mb-2" src="{{asset('images/user.webp')}}" alt="User"/>

                        <h6 class="mb-1" id="userName" ></h6>
                        <p class="text-muted small mb-2" id="userEmail"></p>

                        <hr class="user-dropdown-divider p-0"/>
                    </div>
                    <a href="{{url('/userProfile')}}" class="side-bar-item py-2">
                        <i class="bi bi-person"></i>
                        <span class="side-bar-item-caption">My Profile</span>
                    </a>
                    <a href="{{url('/settings')}}" class="side-bar-item py-2">
                        <i class="bi bi-gear"></i>
                        <span class="side-bar-item-caption">Settings</span>
                    </a>
                    <hr class="user-dropdown-divider my-2">
                    <a href="{{url('/logout')}}" class="side-bar-item py-2">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="side-bar-item-caption">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar Navigation -->
<div id="sideNavRef" class="side-nav-open">
    <div class="pt-2 pb-1 px-3 d-none d-md-block">
        <h6 class="text-muted text-uppercase small font-weight-bold">Core</h6>
    </div>

    <a href="{{url('/dashboard')}}" class="side-bar-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="bi bi-graph-up"></i>
        <span class="side-bar-item-caption">Dashboard</span>
    </a>

    <div class="pt-2 pb-1 px-3 d-none d-md-block">
        <h6 class="text-muted text-uppercase small font-weight-bold">Management</h6>
    </div>

    <a href="{{url('/customerPage')}}" class="side-bar-item {{ request()->is('customerPage') ? 'active' : '' }}">
        <i class="bi bi-people"></i>
        <span class="side-bar-item-caption">Customers</span>
    </a>

    <a href="{{url('/categoryPage')}}" class="side-bar-item {{ request()->is('categoryPage') ? 'active' : '' }}">
        <i class="bi bi-list-nested"></i>
        <span class="side-bar-item-caption">Categories</span>
    </a>

    <a href="{{url('/productPage')}}" class="side-bar-item {{ request()->is('productPage') ? 'active' : '' }}">
        <i class="bi bi-bag"></i>
        <span class="side-bar-item-caption">Products</span>
    </a>

    <div class="pt-2 pb-1 px-3 d-none d-md-block">
        <h6 class="text-muted text-uppercase small font-weight-bold">Sales</h6>
    </div>

    <a href="{{url('/salePage')}}" class="side-bar-item {{ request()->is('salePage') ? 'active' : '' }}">
        <i class="bi bi-currency-dollar"></i>
        <span class="side-bar-item-caption">Create Sale</span>
    </a>

    <a href="{{url('/invoicePage')}}" class="side-bar-item {{ request()->is('invoicePage') ? 'active' : '' }}">
        <i class="bi bi-receipt"></i>
        <span class="side-bar-item-caption">Invoices</span>
    </a>

    <a href="{{url('/reportPage')}}" class="side-bar-item {{ request()->is('reportPage') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-bar-graph"></i>
        <span class="side-bar-item-caption">Reports</span>
    </a>

    <!-- Added space at the bottom of sidebar -->
    <div class="pb-5 mb-4"></div>
</div>

<!-- Main Content Area -->
<div id="contentRef" class="content">
    @yield('content')
</div>

<script>
    // Handle sidebar toggle


    function MenuBarClickHandler() {
        let sideNav = document.getElementById('sideNavRef');
        let content = document.getElementById('contentRef');

        if (sideNav.classList.contains("side-nav-open")) {
            sideNav.classList.add("side-nav-close");
            sideNav.classList.remove("side-nav-open");
            content.classList.add("content-expand");
            content.classList.remove("content");
        } else {
            sideNav.classList.remove("side-nav-close");
            sideNav.classList.add("side-nav-open");
            content.classList.remove("content-expand");
            content.classList.add("content");
        }
    }

    // Highlight current page in sidebar
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const sidebarLinks = document.querySelectorAll('.side-bar-item');

        sidebarLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    });


    getAdminData();

    async function getAdminData(){


        let res = await axios.get('/getAdminDetails');


        if(res.status === 200){
            document.getElementById('AdminUser').innerHTML = res.data['name'][0]['firstName']

            document.getElementById('userName').innerHTML = res.data['name'][0]['firstName'];
            document.getElementById('userEmail').innerHTML = res.data['email'][0]['email'];
        }else{
            errorToast("Admin Information Can't Fetch!!");
        }

    }

</script>

</body>
</html>

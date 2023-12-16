<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    {{-- font awesome --}}

    <!-- Fontfaces CSS-->
    <link href=" {{ asset('admin/css/font-face.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }} " rel="stylesheet"
        media="all">
    <link href=" {{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }} " rel="stylesheet"
        media="all">
    <link href=" {{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }} " rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href=" {{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }} " rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Vendor CSS-->
    <link href=" {{ asset('admin/vendor/animsition/animsition.min.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }} "
        rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/wow/animate.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/slick/slick.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/select2/select2.min.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }} " rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href=" {{ asset('admin/css/theme.css') }} " rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src=" {{ asset('admin/images/icon/logo.png') }} " alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">

                        <li>
                            <a href=" {{ route('category#list') }} "class="text-decoration-none">
                                <i class="fas fa-chart-bar"></i>Categories</a>
                        </li>

                        <li>
                            <a href=" {{ route('product#listPage')}} "class="text-decoration-none">
                                <i class="fa-solid fa-bag-shopping"></i>Products</a>
                        </li>

                        <li>
                            <a href=" {{ route('admin#orderList')}} "class="text-decoration-none">
                                <i class="fa-solid fa-basket-shopping"></i>Orders</a>
                        </li>

                        <li>
                            <a href=" {{ route('admin#userList')}} "class="text-decoration-none">
                                <i class="fa-solid fa-users"></i>User List</a>
                        </li>

                        <li>
                            <a href=" {{ route('admin#userFeedback')}} "class="text-decoration-none">
                                <i class="fa-solid fa-comment"></i>User Feedbacks</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <h4>Admin Dashboard Panel</h4>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">

                                            @if (Auth::user()->image)
                                            <img src="{{asset('storage/'.Auth::user()->image)}}" alt="">
                                        @else
                                            @if (Auth::user()->gender == 'male')
                                                <img src="{{asset('Image/male_profile.png')}}" alt="">
                                            @else
                                                <img src="{{asset('Image/female_profile.jpg')}}" alt="">
                                            @endif
                                        @endif


                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn text-decoration-none" href="">
                                                {{ Auth::user()->name }} </a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">

                                                        @if (Auth::user()->image)
                                                            <img src="{{asset('storage/'.Auth::user()->image)}}" alt="">
                                                        @else
                                                            @if (Auth::user()->gender == 'male')
                                                                <img src="{{asset('Image/male_profile.png')}}" alt="">
                                                            @else
                                                                <img src="{{asset('Image/female_profile.jpg')}}" alt="">
                                                            @endif
                                                        @endif

                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#" class="text-decoration-none">
                                                            {{ Auth::user()->name }} </a>
                                                    </h5>
                                                    <span class="email"> {{ Auth::user()->email }} </span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href=" {{ route('admin#accountDetailsPage') }} "
                                                        class="text-decoration-none">
                                                        <i class="fa-solid fa-user"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href=" {{ route('admin#list')}}"
                                                        class="text-decoration-none">
                                                        <i class="fa-solid fa-users"></i>Admin List</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href=" {{ route('admin#changePassPage') }} "
                                                        class="text-decoration-none">
                                                        <i class="fa-solid fa-key"></i>Change Password
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <a>
                                                        <button class="btn-block" type="submit"><i class="fa-solid fa-right-from-bracket"></i>Logout</button>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            @yield('myContent')

            <!-- END PAGE CONTAINER-->
        </div>

    </div>


    <!-- Jquery JS-->
    <script src=" {{ asset('admin/vendor/jquery-3.2.1.min.js') }} "></script>
    <!-- Bootstrap JS-->
    <script src=" {{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }} "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <!-- Vendor JS       -->
    <script src=" {{ asset('admin/vendor/slick/slick.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/wow/wow.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/animsition/animsition.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/circle-progress/circle-progress.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }} "></script>
    <script src=" {{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/select2/select2.min.js') }} "></script>

    <!-- Main JS-->
    <script src=" {{ asset('admin/js/main.js') }} "></script>

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/183280f8d9.js" crossorigin="anonymous"></script>

</body>

@yield('JSscript')

</html>
<!-- end document-->

<?php if(!isset($_SESSION['login'])){
     echo "
          <script>
               window.location.href='/login.php';
          </script>
     ";
    }
    if ($_SESSION['login']['roleId'] == 2) {
       echo "
       <script>
            window.location.href='../../index.php';
       </script>
  ";
} ?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/">Library Management</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>

    <!--  Search -->
    <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form> -->
    <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

    </div>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li>
                    <hr class="dropdown-divider" />

                </li>
                <li><a class="dropdown-item" href="/functions/_logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="/Admin">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">User Management</div>
                    <a class="nav-link" href="./userProfile.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Profile
                    </a>
                    <a class="nav-link" href="./userList.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Users
                    </a>
                    <a class="nav-link" href="./RolesList.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Roles
                    </a>
                    <div class="sb-sidenav-menu-heading">Manage Library</div>
                    <a class="nav-link" href="./bookReqlist.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Book Requests
                    </a>
                    <a class="nav-link" href="./issueBooklist.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Issue Books
                    </a>
                    <div class="sb-sidenav-menu-heading">Manage Books</div>
                    <a class="nav-link" href="./bookList.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Books
                    </a>
                    <a class="nav-link" href="./seriesList.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Series
                    </a>
                    <a class="nav-link" href="./authorList.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Authors
                    </a>
                    <a class="nav-link" href="./genreList.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Genres
                    </a>
                    <a class="nav-link" href="./publisherList.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Publishers
                    </a>
                    <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                        aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Pages
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a> 
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                aria-controls="pagesCollapseAuth">
                                Authentication
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="login.html">Login</a>
                                    <a class="nav-link" href="register.html">Register</a>
                                    <a class="nav-link" href="password.html">Forgot Password</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#pagesCollapseError" aria-expanded="false"
                                aria-controls="pagesCollapseError">
                                Error
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="401.html">401 Page</a>
                                    <a class="nav-link" href="404.html">404 Page</a>
                                    <a class="nav-link" href="500.html">500 Page</a>
                                </nav>
                            </div>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Charts
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a> -->
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid py-2 px-4">

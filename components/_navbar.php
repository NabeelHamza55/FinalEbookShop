<div class="top-bar bg-dark">
    <div class="container text-light d-flex justify-content-between align-items-center">
        <div class="">
            <h3>Welcome</h3>
        </div>
        <div class="">
            <nav class="navbar">
                <?php
                    if (isset($_SESSION['login'])) {
                         echo '
                         <a class="nav-link px-3" href="./functions/_logout.php">logout</a>
                         ';
                    }else{
                         echo '
                         <a class="nav-link px-3" href="./login.php">Login</a>
                         <a class="nav-link px-3" href="./signup.php">Signup</a>
                         ';
                    }
               ?>
            </nav>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img class="img-thumbnail" width="75px" src="./images/logo.jpg" alt="" srcset=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <li class="">
                <a class="nav-link" href="#carouselExampleIndicators">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#Featured">Featured</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#Books">Series</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="./_Books.php">Books</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    More
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#About">About Us</a>
                    <a class="dropdown-item" href="#Team">Our Team</a>
                    <!-- <div class="dropdown-divider"></div> -->
                    <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

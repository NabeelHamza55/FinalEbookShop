<?php
     $title = 'Login';
     include('./Admin/HTML_Start.php');
     include('./functions/_login.php');
     login();
     if (isset($_SESSION['login'])) {
          // NavBar
          echo "
          <script>
          window.location.href='./index.php';
          </script>
          ";
     }
?>

<div class="bg-primary" id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Login</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center bg-danger rounded">
                                    <p class="lead mt-1 text-light">
                                        <?php echo $errors['msg'] ?>
                                    </p>
                                </div>
                                <form id="login-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="inputEmail" id="inputEmail" type="text"
                                            placeholder="name@example.com" />
                                        <label for="inputEmail">Email address</label>
                                        <div class=" text-center  bg-danger rounded">
                                            <p class="lead mt-1 text-light">
                                                <?php echo $errors['email'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="inputPassword" id="inputPassword"
                                            type="password" placeholder="Password" />
                                        <label for="inputPassword">Password</label>
                                        <div class="text-center bg-danger rounded">
                                            <p class="lead mt-1 text-light">
                                                <?php echo $errors['password'] ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button class="btn btn-primary" type="submit" name="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="./signup.php">Haven't any account? Signup Now</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('./Admin/HTML_End.php') ?>

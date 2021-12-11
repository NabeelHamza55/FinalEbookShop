<?php
     $title = 'Register';
     include('./Admin/HTML_Start.php');
     include('./functions/_signup.php');
     register();
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
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Create Account</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center bg-danger rounded">
                                    <p class="lead mt-1 text-light">
                                        <?php echo $errors['msg'] ?>
                                    </p>
                                </div>
                                <form id="signu-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" name="inputFirstName" id="inputFirstName"
                                                    type="text" placeholder="Enter your first name" />
                                                <label for="inputFirstName">First name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" name="inputLastName" id="inputLastName"
                                                    type="text" placeholder="Enter your last name" />
                                                <label for="inputLastName">Last name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="inputEmail" id="inputEmail" type="email"
                                            placeholder="name@example.com" />
                                        <label for="inputEmail">Email address</label>
                                        <div class=" text-center  bg-danger rounded">
                                            <p class="lead mt-1 text-light">
                                                <?php echo $errors['email'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" name="inputPassword" id="inputPassword"
                                                    type="password" placeholder="Create a password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" name="inputPasswordConfirm"
                                                    id="inputPasswordConfirm" type="password"
                                                    placeholder="Confirm password" />
                                                <label for="inputPasswordConfirm">Confirm Password</label>

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="text-center bg-danger rounded">
                                                <p class="lead mt-1 text-light">
                                                    <?php echo $errors['password'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid"><button class="btn btn-primary btn-block" name="submit"
                                                type="submit">Create Account</button></div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="./login.php">Have an account? Go to login</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('./Admin/HTML_End.php') ?>

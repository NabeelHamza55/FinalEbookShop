<?php
     $errors = ['email'=> '', 'password' => '', 'msg'=> ''];
     function register(){
          global $db;
          global $errors;
          if (isset($_POST['submit'])) {
               $firstName = mysqli_real_escape_string($db, $_POST['inputFirstName']);
               $lastName = mysqli_real_escape_string($db, $_POST['inputLastName']);
               $email = mysqli_real_escape_string($db, $_POST['inputEmail']);
               $password = mysqli_real_escape_string($db, $_POST['inputPassword']);
               $confPass = mysqli_real_escape_string($db, $_POST['inputPasswordConfirm']);


               if (empty($email)) {
                    $errors['email'] = 'Please Enter Your Email';
               }

               if (empty($password)) {
                    $errors['password'] = 'Please Enter Your Password';
               } else {
                    if (strlen($password) < 8) {
                    $errors['password'] = "The Password Must Be Atleast 8 Character";
                    }else{
                         if ($password != $confPass) {
                              $errors['password'] = "Password Confirmation Failed";
                         } else{
                             $query = "SELECT * FROM users WHERE email = '$email'";
                             $checkUser = mysqli_query($db, $query);
                             $row = mysqli_num_rows($checkUser);
                             if ($row > 0) {
                                 $errors['msg'] = "User Already Exist";
                             } else {
                                  $safePassword = sha1($password);
                                  $createUser = "INSERT INTO users (first_name, last_name, email, password, created_at) VALUES ('$firstName', '$lastName', '$email', '$safePassword', now())";
                                  if (mysqli_query($db, $createUser)) {
                                        $errors['msg'] = "User Registration Successfull";
                                        //  echo "
                                        //      <script>
                                        //           window.location.href='../login.php';
                                        //      </script>
                                        //      ";
                                 }else{
                                   $errors['msg'] = "System Error";
                                 }
                             }
                         }
                    }
               }





          }
     }
?>

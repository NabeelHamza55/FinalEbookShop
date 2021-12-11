<?php
     $errors = ['email'=> '', 'password' => '', 'msg'=> ''];
     function login(){
          global $db;
          global $errors;
          if (isset($_POST['submit'])) {
               $email = mysqli_real_escape_string($db, $_POST['inputEmail']);
               $password = mysqli_real_escape_string($db, $_POST['inputPassword']);


               if (empty($password)) {
                    $errors['password'] = 'Please Enter Your Password';
               } else {
                    if (strlen($password) < 8) {
                    $errors['password'] = "The Password Must Be Atleast 8 Character";
                    }
               }


               if (empty($email)) {
                    $errors['email'] = 'Please Enter Your Email';
               }else{
                    $query = "SELECT * FROM users WHERE email = '$email'";
                    $checkUser = mysqli_query($db, $query);
                    $row = mysqli_num_rows($checkUser);
                    if ($row > 0) {
                         $user = mysqli_fetch_assoc($checkUser);

                         if (strlen($password) < 8) {
                              $errors['password'] = "The Password Must Be Atleast 8 Character";
                         }else{
                             if (sha1($password) != $user['password']) {
                                 $errors['password'] = "The Password You Entered Is Incorrect";
                             } else {
                                  $_SESSION['login'] = $user;
                                  if ($_SESSION['login']['user_type_fk'] == 1) {
                                   echo "
                                   <script>
                                        window.location.href='./Admin/index.php';
                                   </script>
                                   ";
                                  }
                  echo "
                                   <script>
                                        window.location.href='./index.php';
                                   </script>
                                   ";
                             }
                         }
                    }else{
                         $errors['msg'] = "User Doesn't Exist";
                    }
               }


          }
     }
?>

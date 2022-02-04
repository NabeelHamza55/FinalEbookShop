<?php

include('db.php');
$msg = ['status' => "", 'error' => ''];
function fetchUsers(){
     global $db;
     $query =  "SELECT * FROM users";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row == 0) {
         return false;
     }else{
          return $result;
     }
}

function userDetail(){
     global $db;     
     global $msg;
     $id = $_GET['id'];
     $query = "SELECT * FROM users WHERE id = $id";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row == 0) {
          return false;
     }else{
          return $result;
     }
}


function addUser(){
    global $db;
    global $msg;

    if (isset($_POST['submit'])) {
        # code...
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['passwordConfirmation'];
        $gender = $_POST['gender'];
        $status = $_POST['status'];
        $role = $_POST['role'];
        $address = $_POST['address'];

        if (empty($email)) {
            $msg['error'] = 'Please Enter Your Email';
        }

        if (empty($password)) {
            $msg['error'] = 'Please Enter Your Password';
        } else {
            if (strlen($password) < 8) {
                $msg['error'] = "The Password Must Be Atleast 8 Character";
            } else {
                if ($password != $passwordConfirmation) {
                    $msg['error'] = "Password Confirmation Failed";
                } else {
                    $query = "SELECT * FROM users WHERE email = '$email'";
                    $checkUser = mysqli_query($db, $query);
                    $row = mysqli_num_rows($checkUser);
                    if ($row > 0) {
                        $msg['error'] = "User Already Exist";
                    } else {
                        $safePassword = sha1($password);
                        $query = "INSERT INTO users (roleId, email, password, firstName, middleName, lastName, isActive, phone, address, gender) VALUES ($role, '$email', '$safePassword', '$firstName', '$middleName', '$lastName', $status, '$phone', '$address', '$gender')";
                        if (mysqli_query($db, $query)) {
                            $msg['status'] = "User Successfully Added";
                            echo "
                                   <script>
                                   window.location.href='./userList.php';
                                   </script>
                                   ";
                        } else {
                            $msg['error'] = "Something Wrong Please Try Again Later";
                        }
                    }
                }
            }
        }
    }
}
function updateUser(){
    global $db;
    global $msg;
    if (isset($_POST['submit'])) {
        $id = $_GET['id'];
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['passwordConfirmation'];
        $gender = $_POST['gender'];
        $status = $_POST['status'];
        $role = $_POST['role'];
        $address = $_POST['address'];

        if (empty($email)) {
            $msg['error'] = 'Please Enter Your Email';
        }

        if (empty($password)) {
            $msg['error'] = 'Please Enter Your Password';
        } else {
            if (strlen($password) < 8) {
                $msg['error'] = "The Password Must Be Atleast 8 Character";
            } else {
                if ($password != $passwordConfirmation) {
                    $msg['error'] = "Password Confirmation Failed";
                } else {
                    $query = "SELECT * FROM users WHERE email = '$email' AND id != $id";
                    $checkUser = mysqli_query($db, $query);
                    $row = mysqli_num_rows($checkUser);
                    if ($row > 0) {
                        $msg['error'] = "User Already Exist";
                    } else {
                        $safePassword = sha1($password);
                        $query = "UPDATE users SET roleId = $role, email = '$email', password = '$safePassword', firstName = '$firstName', middleName = '$middleName', lastName = '$lastName', isActive = $status, phone = '$phone', address = '$address', gender = '$gender' WHERE id = $id";
                        if (mysqli_query($db, $query)) {
                            $msg['status'] = "User Successfully Added";
                            echo "
                                    <script>
                                    window.location.href='./userList.php';
                                    </script>
                                    ";
                        } else {
                            $msg['error'] = "Something Wrong Please Try Again Later";
                        }
                    }
                }
            }
        }
    }
}
function updateProfile($id)
{
    global $db;
    global $msg;
    if (isset($_POST['submit'])) {
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];

      
        $query = "SELECT * FROM users WHERE email = '$email' AND id != $id";
        $checkUser = mysqli_query($db, $query);
        $row = mysqli_num_rows($checkUser);
        if ($row > 0) {
            $msg['error'] = "User Already Exist";
        } else {
            $query = "UPDATE users SET email = '$email', firstName = '$firstName', middleName = '$middleName', lastName = '$lastName', phone = '$phone', address = '$address', gender = '$gender' WHERE id = $id";
      
            if (mysqli_query($db, $query)) {
                // $_SESSION['login'] = mysqli_fetch_assoc($checkUser);
                
                $msg['status'] = "User Successfully Added";
                // echo "
                //                     <script>
                //                     window.location.href='./userProfile.php';
                //                     </script>
                //                     ";
            } else {
                $msg['error'] = "Something Wrong Please Try Again Later";
            }
        }
    }
}
    


function deleteUser(){
     global $db;
     global $msg;

     if (isset($_GET['deleteUser'])) {
          $id = $_GET['deleteUser'];
          $query = "DELETE FROM users WHERE id = $id";

          if (mysqli_query($db, $query)) {
               // $msg['status'] = "User Successfuly Deleted";
               echo "<script>
               alert('Deleted Successfuly');
               window.location.href='../userList.php';
               </script>";
          }else{
               $msg['error'] = "Something Wrong Please Try Again Later";
          }
     }
}
if (isset($_GET['deleteUser'])) {
     deleteUser();
}
function getRole($id){
     global $db;
     global $msg;
     
     $query = "SELECT name FROM roles WHERE id = $id";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row > 0) {
          $role = mysqli_fetch_assoc($result);
          return $role['name'];
     }else{
          return 'NA';
     }
}
function fetchRoles(){
     global $db;
     $query =  "SELECT * FROM roles";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row == 0) {
         return false;
     }else{
          return $result;
     }
}
?>

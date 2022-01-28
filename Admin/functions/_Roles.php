<?php

include('db.php');
$msg = ['status' => "", 'error' => ''];
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

function roleDetail(){
     global $db;     
     global $msg;
     $id = $_GET['id'];
     $query = "SELECT * FROM roles WHERE id = $id";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row == 0) {
          return false;
     }else{
          return $result;
     }
}

function addRole(){
     global $db;
     global $msg;

     if (isset($_POST['submit'])) {
          # code...
          $name = $_POST['name'];
          $issueLimit = $_POST['issueLimit'];
          $bookLimit = $_POST['bookLimit'];
          $fineLimit = $_POST['fineLimit'];
          // $priority = $_POST['priority'];


          $check = "SELECT name FROM role WHERE name = '$name'";
          $result = mysqli_query($db, $check);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
               $msg['error'] = "Role Already Exist";
          }else{
              $query = "INSERT INTO roles (name, issueDayLimit, issueBookLimit, finePerDay) VALUES ('$name', $issueLimit, $bookLimit, $fineLimit)";
              if (mysqli_query($db, $query)) {
                  $msg['status'] = "Role Successfully Added";
                  echo "
               <script>
                window.location.href='./rolesList.php';
               </script>
               ";
              } else {
                  $msg['error'] = "Something Wrong Please Try Again Later";
              }
          }
     }
}
function updateRole(){
     global $db;
     global $msg;

     if (isset($_POST['submit'])) {
          # code...
          $id = $_GET['id'];
          $name = $_POST['name'];
          $issueLimit = $_POST['issueLimit'];
          $bookLimit = $_POST['bookLimit'];
          $fineLimit = $_POST['fineLimit'];

          $check = "SELECT name FROM roles WHERE name = '$name' AND id != $id";
          $result = mysqli_query($db, $check);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
               $msg['error'] = "Role Already Exist";
          }else{
              $query = "UPDATE roles SET name = '$name', issueDayLimit = $issueLimit, issueBookLimit = $bookLimit, finePerDay = $fineLimit  WHERE id = $id";
              if (mysqli_query($db, $query)) {
                  $msg['status'] = "Role Successfully Added";
                  echo "
               <script>
               window.location.href='./rolesList.php';
               </script>
               ";
              } else {
                  $msg['error'] = "Something Wrong Please Try Again Later";
              }
          }
     }
}

function deleteRole(){
     global $db;
     global $msg;

     if (isset($_GET['deleteRole'])) {
          $id = $_GET['deleteRole'];
          $query = "DELETE FROM roles WHERE id = $id";

          if (mysqli_query($db, $query)) {
               // $msg['status'] = "Role Successfuly Deleted";
               echo "<script>
               alert('Deleted Successfuly');
               window.location.href='../rolesList.php';
               </script>";
          }else{
               $msg['error'] = "Something Wrong Please Try Again Later";
          }
     }
}
if (isset($_GET['deleteRole'])) {
     deleteRole();
}

?>

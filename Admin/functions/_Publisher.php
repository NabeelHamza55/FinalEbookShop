<?php

include('db.php');
$msg = ['status' => '', 'error' => ''];
function fetchPublishers(){
     global $db;
     $query =  "SELECT * FROM publishers";
     $result = mysqli_query($db, $query);
     if (!empty($result)) {
          $row = mysqli_num_rows($result);
          if ($row == 0) {
          return false;
          }else{
               return $result;
          }
     }
}

function publisherDetail(){
     global $db;     
     global $msg;
     $id = $_GET['id'];
     $query = "SELECT * FROM publishers WHERE id = $id";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row == 0) {
          return false;
     }else{
          return $result;
     }
}

function addPublisher(){
     global $db;
     global $msg;
     if (isset($_POST['submit'])) {
          # code...
          $name = $_POST['name'];
          $check = "SELECT * FROM publishers WHERE name = '$name'";
          $result = mysqli_query($db, $check);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
               $msg['error'] = "Publisher Already Exist";
          }else{
              $query = "INSERT INTO publishers (name) VALUES ('$name')";
              if (mysqli_query($db, $query)) {
                  $msg['status'] = "Publishers Successfully Added";
                  echo "
               <script>
               window.location.href='./publisherList.php';
               </script>
               ";
              } else {
                  $msg['error'] = "Something Wrong Please Try Again Later";
              }
          }
     }
}

function updatePublisher(){
     global $db;
     global $msg;

     if (isset($_POST['submit'])) {
          # code...
          $id = $_GET['id'];
          $name = $_POST['name'];

          $check = "SELECT * FROM publishers  WHERE name = '$name' AND id != $id";
          $result = mysqli_query($db, $check);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
               $msg['error'] = "Publisher Already Exist";
          }else{
              $query = "UPDATE publishers SET name = '$name' WHERE id = $id";
              if (mysqli_query($db, $query)) {
                  $msg['status'] = "Publisher Successfully Added";
                  echo "
               <script>
               window.location.href='./publisherList.php';
               </script>
               ";
              } else {
                  $msg['error'] = "Something Wrong Please Try Again Later";
              }
          }
     }
}

function deletePublisher(){
     global $db;
     global $msg;

     if (isset($_GET['deletePublisher'])) {
          $id = $_GET['deletePublisher'];
          $query = "DELETE FROM publishers WHERE id = $id";

          if (mysqli_query($db, $query)) {
               $msg['status'] = "Publisher Successfuly Deleted";
               echo "<script>
               alert('Deleted Successfuly');
               window.location.href='../publisherList.php';
               </script>";
          }else{
               $msg['error'] = "Something Wrong Please Try Again Later";
          }
     }
}
if (isset($_GET['deletePublisher'])) {
     deletePublisher();
}

?>

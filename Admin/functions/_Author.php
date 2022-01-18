<?php

include('db.php');
$msg = ['status' => '', 'error' => ''];
function fetchAuthors(){
     global $db;
     $query =  "SELECT * FROM authors";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row == 0) {
         return false;
     }else{
          return $result;
     }
}

function authorDetail(){
     global $db;     
     global $msg;
     $id = $_GET['id'];
     $query = "SELECT * FROM authors WHERE id = $id";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row == 0) {
          return false;
     }else{
          return $result;
     }
}

function addAuthor(){
     global $db;
     global $msg;
     if (isset($_POST['submit'])) {
          # code...
          $firstName = $_POST['firstName'];
          $lastName = $_POST['lastName'];
          $description = $_POST['description'];
          

          $check = "SELECT * FROM authors WHERE firstName = '$firstName' && LastName = '$lastName' ";
          $result = mysqli_query($db, $check);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
               $msg['error'] = "Author Already Exist";
          }else{
              $query = "INSERT INTO authors (firstName, lastName, description) VALUES ('$firstName', '$lastName', '$description')";
              if (mysqli_query($db, $query)) {
                  $msg['status'] = "authors Successfully Added";
                  echo "
               <script>
               window.location.href='./authorList.php';
               </script>
               ";
              } else {
                  $msg['error'] = "Something Wrong Please Try Again Later";
              }
          }
     }
}
function updateAuthor(){
     global $db;
     global $msg;

     if (isset($_POST['submit'])) {
          # code...
          $id = $_GET['id'];
          $firstName = $_POST['firstName'];
          $lastName = $_POST['lastName'];
          $description = $_POST['description'];

          $check = "SELECT * FROM authors  WHERE (firstName = '$firstName' AND lastName = '$lastName') AND id != $id";
          $result = mysqli_query($db, $check);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
               $msg['error'] = "Author Already Exist";
          }else{
              $query = "UPDATE authors SET firstName = '$firstName', lastName = '$lastName', description = '$description' WHERE id = $id";
              if (mysqli_query($db, $query)) {
                  $msg['status'] = "Author Successfully Added";
                  echo "
               <script>
               window.location.href='./AuthorList.php';
               </script>
               ";
              } else {
                  $msg['error'] = "Something Wrong Please Try Again Later";
              }
          }
     }
}

function deleteAuthor(){
     global $db;
     global $msg;

     if (isset($_GET['deleteAuthor'])) {
          $id = $_GET['deleteAuthor'];
          $query = "DELETE FROM authors WHERE id = $id";

          if (mysqli_query($db, $query)) {
               $msg['status'] = "Author Successfuly Deleted";
               echo "<script>
               alert('Deleted Successfuly');
               window.location.href='../AuthorList.php';
               </script>";
          }else{
               $msg['error'] = "Something Wrong Please Try Again Later";
          }
     }
}
if (isset($_GET['deleteAuthor'])) {
     // echo "<script>
     //           confirm('Are You Sure?');
     //           </script>";
     deleteAuthor();
}

?>

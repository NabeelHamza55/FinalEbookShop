<?php

include('db.php');
$msg = ['status' => '', 'error' => ''];
function fetchGenres(){
     global $db;
     $query =  "SELECT * FROM genres";
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

function genreDetail(){
     global $db;     
     global $msg;
     $id = $_GET['id'];
     $query = "SELECT * FROM genres WHERE id = $id";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row == 0) {
          return false;
     }else{
          return $result;
     }
}

function addGenre(){
     global $db;
     global $msg;
     if (isset($_POST['submit'])) {
          # code...
          $name = $_POST['name'];
          $check = "SELECT * FROM genres WHERE name = '$name'";
          $result = mysqli_query($db, $check);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
               $msg['error'] = "Genre Already Exist";
          }else{
              $query = "INSERT INTO genres (name) VALUES ('$name')";
              if (mysqli_query($db, $query)) {
                  $msg['status'] = "Genres Successfully Added";
                  echo "
               <script>
               window.location.href='./genreList.php';
               </script>
               ";
              } else {
                  $msg['error'] = "Something Wrong Please Try Again Later";
              }
          }
     }
}

function updateGenre(){
     global $db;
     global $msg;

     if (isset($_POST['submit'])) {
          # code...
          $id = $_GET['id'];
          $name = $_POST['name'];

          $check = "SELECT * FROM genres  WHERE name = '$name' AND id != $id";
          $result = mysqli_query($db, $check);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
               $msg['error'] = "Genre Already Exist";
          }else{
              $query = "UPDATE genres SET name = '$name' WHERE id = $id";
              if (mysqli_query($db, $query)) {
                  $msg['status'] = "Genre Successfully Added";
                  echo "
               <script>
               window.location.href='./genreList.php';
               </script>
               ";
              } else {
                  $msg['error'] = "Something Wrong Please Try Again Later";
              }
          }
     }
}

function deleteGenre(){
     global $db;
     global $msg;

     if (isset($_GET['deleteGenre'])) {
          $id = $_GET['deleteGenre'];
          $query = "DELETE FROM genres WHERE id = $id";

          if (mysqli_query($db, $query)) {
               $msg['status'] = "Genre Successfuly Deleted";
               echo "<script>
               alert('Deleted Successfuly');
               window.location.href='../genreList.php';
               </script>";
          }else{
               $msg['error'] = "Something Wrong Please Try Again Later";
          }
     }
}
if (isset($_GET['deleteGenre'])) {
     deleteGenre();
}

?>

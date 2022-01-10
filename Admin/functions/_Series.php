<?php

include('db.php');
// session_start();
function fetchSeries(){
     global $db;
     $query =  "SELECT * FROM series";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row == 0) {
         return false;
     }else{
          return $result;
     }
}

function addSeries(){
     global $db;
     if (isset($_POST['submit'])) {
          # code...
          $name = $_POST['name'];
          if (isset($_POST['isCompleted']) && $_POST['isCompleted'] == 1) {
               $completed = intval(1);
          }else{
               $completed = intval(0);
          }

          $check = "SELECT name FROM series WHERE name = '$name'";
          $result = mysqli_query($db, $check);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
               $_SESSION['errors'] = "Series Already Exist";
          }else{
              $query = "INSERT INTO series (name, isComplete) VALUES ('$name', $completed)";
              if (mysqli_query($db, $query)) {
                  $_SESSION['status'] = "Series Successfully Added";
                  echo "
               <script>
               window.location.href='./seriesList.php';
               </script>
               ";
              } else {
                  $_SESSION['errors'] = "Something Wrong Please Try Again Later";
              }
          }
     }
}
function updateSeries(){
     global $db;
     if (isset($_POST['submit'])) {
          # code...
          $id = $_GET['id'];
          $name = $_POST['name'];
          if (isset($_POST['isCompleted']) && $_POST['isCompleted'] == true) {
               $completed = intval(1);
          }else{
               $completed = intval(0);
          }

          $check = "SELECT name FROM series WHERE name = '$name' AND id != $id";
          $result = mysqli_query($db, $check);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
               $_SESSION['errors'] = "Series Already Exist";
          }else{
              $query = "UPDATE series SET name = '$name', isComplete = $completed WHERE id = $id";
              if (mysqli_query($db, $query)) {
                  $_SESSION['status'] = "Series Successfully Added";
                  echo "
               <script>
               window.location.href='./seriesList.php';
               </script>
               ";
              } else {
                  $_SESSION['errors'] = "Something Wrong Please Try Again Later";
              }
          }
     }
}

function deleteSeries(){
     global $db;
     if (isset($_GET['deleteSeries'])) {
          $id = $_GET['deleteSeries'];
          $query = "DELETE FROM series WHERE id = $id";

          if (mysqli_query($db, $query)) {
               $_SESSION['flash_message'] = "Series Successfuly Deleted";
               echo "<script>
               // alert('Deleted Successfuly');
               window.location.href='../seriesList.php';
               </script>";
          }else{
               $_SESSION['errors'] = "Something Wrong Please Try Again Later";
          }
     }
}
if (isset($_GET['deleteSeries'])) {
     deleteSeries();
}

?>

<?php

include('db.php');
$msg = ['status' => '', 'error' => ''];
function fetchIssues(){
     global $db;
     $query =  "SELECT * FROM issues";
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

function issueDetail(){
     global $db;     
     global $msg;
     $id = $_GET['id'];
     $query = "SELECT * FROM issues WHERE id = $id";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row == 0) {
          return false;
     }else{
          return $result;
     }
}

function updateIssue(){
     global $db;
     global $msg;

     if (isset($_POST['submit'])) {
          # code...
          $id = $_GET['id'];
    
          $userId = $_POST['userId'];
          $bookId = $_POST['bookId'];
          $returnDate = $_POST['returnDate'];
          $isLost = $_POST['isLost'];
          $penalty = $_POST['penalty'];
          
          $query = "UPDATE issues SET returnDate = '$returnDate', isLost = $isLost, penalty = $penalty WHERE id = $id";
          if (mysqli_query($db, $query)) {
               $msg['status'] = "Issue Successfully Updated";
               echo "
               <script>
               window.location.href='./issueBookList.php';
               </script>
               ";
          } else {
               $msg['error'] = "Please Fill all fields";
          }
               
                
     }
}

function deleteIssue(){
     global $db;
     global $msg;

     if (isset($_GET['deleteIssue'])) {
          $id = $_GET['deleteIssue'];
          $query = "DELETE FROM issues WHERE id = $id";

          if (mysqli_query($db, $query)) {
               $msg['status'] = "Issue Successfuly Deleted";
               echo "<script>
               alert('Deleted Successfuly');
               window.location.href='../issueList.php';
               </script>";
          }else{
               $msg['error'] = "Something Wrong Please Try Again Later";
          }
     }
}
if (isset($_GET['deleteIssue'])) {
     deleteIssue();
}
// $todayDate = date('d-m-Y');
// $dateQuery = "UPDATE issues SET penalty =+1 WHERE expiryDate < NOW()";
// $result = mysqli_query($db, $dateQuery);

// $expiryDate = mysqli_fetch_assoc($result);

?>

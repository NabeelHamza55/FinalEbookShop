<?php

include('db.php');
$msg = ['status' => '', 'error' => ''];
function fetchRequests(){
     global $db;
     $query =  "SELECT * FROM requests";
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

function requestDetail(){
     global $db;     
     global $msg;
     $id = $_GET['id'];
     $query = "SELECT * FROM requests WHERE id = $id";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row == 0) {
          return false;
     }else{
          return $result;
     }
}

function updateRequest(){
     global $db;
     global $msg;

     if (isset($_POST['submit'])) {
          # code...
          $id = $_GET['id'];
         $status = $_POST['status'];
          if ($status == 'Rejected' || $status == 'Pending') {
               $query = "UPDATE requests SET status = '$status' WHERE id = $id";
               if (mysqli_query($db, $query)) {
                    $msg['status'] = "Request Successfully Updated";
                    echo "
                    <script>
                    window.location.href='./bookReqList.php';
                    </script>
                    ";
               } else {
                    $msg['error'] = "Something Wrong Please Try Again Later";
               }
          }
          if ($status == 'Accepted') {
               $userId = $_POST['userId'];
               $bookId = $_POST['bookId'];
               $expiryDate = $_POST['expiryDate'];
               $issuedQuery = "INSERT INTO issues (userId, bookId, requestId, issueDate, expiryDate) VALUES ($userId, $bookId, $id, NOW(), '$expiryDate')";
               if (mysqli_query($db, $issuedQuery)) {
                    # code...
                    $query = "UPDATE requests SET status = '$status' WHERE id = $id";
                    if (mysqli_query($db, $query)) {
                         $msg['status'] = "Request Successfully Updated";
                         echo "
                         <script>
                         window.location.href='./bookReqList.php';
                         </script>
                         ";
                    } else {
                         $msg['error'] = "Something Wrong Please Try Again Later";
                    }
               }
          }          
     }
}

function deleteRequest(){
     global $db;
     global $msg;

     if (isset($_GET['deleteRequest'])) {
          $id = $_GET['deleteRequest'];
          $query = "DELETE FROM requests WHERE id = $id";

          if (mysqli_query($db, $query)) {
               $msg['status'] = "Request Successfuly Deleted";
               echo "<script>
               alert('Deleted Successfuly');
               window.location.href='../requestList.php';
               </script>";
          }else{
               $msg['error'] = "Please Fill all fields";
          }
     }
}
if (isset($_GET['deleteRequest'])) {
     deleteRequest();
}

?>

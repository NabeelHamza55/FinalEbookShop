<?php

include('db.php');
$msg = ['status' => '', 'error' => ''];
function fetchBooks(){
     global $db;
     $query =  "SELECT * FROM books";
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

function bookDetail(){
     global $db;     
     global $msg;
     $id = $_GET['id'];
     $query = "SELECT * FROM books WHERE id = $id";
     $result = mysqli_query($db, $query);
     $row = mysqli_num_rows($result);
     if ($row == 0) {
          return false;
     }else{
          return $result;
     }
}

function addBooks(){
     global $db;
     global $msg;
     if (isset($_POST['submit'])) {
          $title = $_POST['title'];
          $subTitle = $_POST['subTitle'];
          $isbn = $_POST['isbn'];
          $seriesID = $_POST['series'];
          $publisherID = $_POST['publisher'];
          $authorID = $_POST['author'];
          $genreID = $_POST['genre'];
          $edition = $_POST['edition'];
          $publishYear = $_POST['published_year'];
          $pages = $_POST['pages'];
          $description = $_POST['description'];
          $quantity = $_POST['quantity'];
          $binding = $_POST['binding'];
          $form = $_POST['form'];
          $price = $_POST['price'];
          $lang = $_POST['language'];
          $check = "SELECT * FROM books WHERE title = '$title'";
          $result = mysqli_query($db, $check);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
               $msg['error'] = "Books Already Exist";
          }else{
              $query = "INSERT INTO books (seriesId, publisherId, title, subtitle, ISBN10, publishingYear, pages, description, quantity, edition, binding, physicalForm, price, language) VALUES ($seriesID, $publisherID, '$title', '$subTitle', '$isbn', $publishYear, $pages, '$description', $quantity, '$edition', '$binding', '$form', $price, '$lang')";
              
              if (mysqli_query($db, $query)) {
               $last_id = mysqli_insert_id($db);
                    
                    mysqli_query($db, "INSERT INTO bookauthors (bookId, authorId) VALUES ($last_id, $authorID)");
                    mysqli_query($db, "INSERT INTO bookgenres (bookId, genreId) VALUES ($last_id, $genreID)");
               
                    $msg['status'] = "Bookss Successfully Added";
                    echo "
                    <script>
                    window.location.href='./bookList.php';
                    </script>
                    ";
              } else {
                  $msg['error'] = "Something Wrong Please Try Again Later";
              }
          }
     }
}

function updateBooks(){
     global $db;
     global $msg;

     if (isset($_POST['submit'])) {
          # code...
          $id = $_GET['id'];
          $title = $_POST['title'];
          $subTitle = $_POST['subTitle'];
          $isbn = $_POST['isbn'];
          $seriesID = $_POST['series'];
          $publisherID = $_POST['publisher'];
          $authorID = $_POST['author'];
          $genreID = $_POST['genre'];
          $edition = $_POST['edition'];
          $publishYear = $_POST['published_year'];
          $pages = $_POST['pages'];
          $description = $_POST['description'];
          $quantity = $_POST['quantity'];
          $binding = $_POST['binding'];
          $form = $_POST['form'];
          $price = $_POST['price'];
          $lang = $_POST['language'];;

          $check = "SELECT * FROM books  WHERE title = '$title' AND id != $id";
          $result = mysqli_query($db, $check);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
               $msg['error'] = "Books Already Exist";
          }else{
              $query = "UPDATE books SET `seriesId`='$seriesID',`publisherId`='$publisherID', `title`='$title',`subtitle`='$subTitle',`ISBN10`='$isbn',`publishingYear`='$publishYear',`pages`='$pages',`description`='$description',`quantity`='$quantity',`edition`='$edition',`binding`='$binding',`physicalForm`='$form',`price`='$price',`language`='$lang',`updated_at`= NOW() WHERE id = $id";
              if (mysqli_query($db, $query)) {
                    mysqli_query($db, "UPDATE bookauthors SET authorId =  $authorID WHERE bookId = $id");
                    mysqli_query($db, "UPDATE bookgenres SET genreId = $genreID WHERE bookId = $id");
               

                    $msg['status'] = "Books Successfully Added";
                    echo "
                    <script>
                    window.location.href='./bookList.php';
                    </script>
                    ";
              } else {
                  $msg['error'] = "Something Wrong Please Try Again Later";
              }
          }
     }
}



function getSeries($id){
     global $db;
     $query = "SELECT name FROM series WHERE id = $id";
     $get = mysqli_query($db, $query);
     $row = mysqli_num_rows($get);
     if ($row > 0) {
          $series = mysqli_fetch_assoc($get);
          return $series['name'];
     }else{
          return false;
     }
}
function getPublisher($id){
     global $db;
     $query = "SELECT name FROM publishers WHERE id = $id";
     $get = mysqli_query($db, $query);
     $row = mysqli_num_rows($get);
     if ($row > 0) {
          $publisher = mysqli_fetch_assoc($get);
          return $publisher['name'];
     }else{
          return false;
     }
}
function getAuthor($id){
     global $db;
     $query = "SELECT authorID FROM bookauthors WHERE bookId = $id";
     $getAuthor = mysqli_query($db, $query);
     $row = mysqli_num_rows($getAuthor);
     if ($row > 0) {
          $author = mysqli_fetch_assoc($getAuthor);
          $getauthorID = $author['authorID'];
          $query = "SELECT * from authors WHERE id = $getauthorID";
          $get = mysqli_query($db, $query);
          $row = mysqli_num_rows($get);
          if ($row > 0) {
               $author = mysqli_fetch_assoc($get);
               return $author['firstName'];
          }else{
               return 'NA';
          }
     }else{
          return 'NA';
     }
}
function getGenre($id){
     global $db;
     $query = "SELECT genreID FROM bookgenres WHERE bookId = $id";
     $getGenre = mysqli_query($db, $query);
     $row = mysqli_num_rows($getGenre);
     if ($row > 0) {
          $genre = mysqli_fetch_assoc($getGenre);
          $getgenreID = $genre['genreID'];
          $query = "SELECT * from genres WHERE id = $getgenreID";
          $get = mysqli_query($db, $query);
          $row = mysqli_num_rows($get);
          if ($row > 0) {
               $genre = mysqli_fetch_assoc($get);
               return $genre['name'];
          }else{
               return 'NA';
          }
     }else{
          return 'NA';
     }
}

function deleteBook(){
     global $db;
     global $msg;

     if (isset($_GET['deleteBook'])) {
          $id = $_GET['deleteBook'];
          $query = "DELETE FROM books WHERE id = $id";

          if (mysqli_query($db, $query)) {
               $msg['status'] = "Book Successfuly Deleted";
               echo "<script>
               alert('Deleted Successfuly');
               window.location.href='../bookList.php';
               </script>";
          }else{
               $msg['error'] = "Something Wrong Please Try Again Later";
          }
     }
}
if (isset($_GET['deleteBook'])) {
     deleteBook();
}
?>

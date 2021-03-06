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
          $title = $_POST['title'] ;
          $subTitle = $_POST['subTitle'];
          $isbn = $_POST['isbn'];
          $seriesID = $_POST['series'];
          $publisherID = $_POST['publisher'];
          $authorID = $_POST['author'];
          $genreID = $_POST['genre'];
          $edition = $_POST['edition'];
          $publishYear = !empty($_POST['published_year']) ? $_POST['published_year'] : 0;
          $pages = !empty($_POST['pages']) ? $_POST['pages'] : '0';
          $description = $_POST['description'];
          $quantity = !empty($_POST['quantity']) ? $_POST['quantity'] : '0';
          $binding = $_POST['binding'];
          $form = $_POST['form'];
          $type = $_POST['bookType'];
          $price = !empty($_POST['price']) ? $_POST['price'] : '0';
          $lang = $_POST['language'];
          
       
          if(empty($_FILES['cover']['name']) &&  empty($_FILES['pdf']['name'])){
               $query = "INSERT INTO books (seriesId, publisherId, title, subtitle, ISBN10, publishingYear, pages, description, quantity, edition, binding, physicalForm, type, price, language) VALUES ($seriesID, $publisherID, '$title', '$subTitle', '$isbn', $publishYear, $pages, '$description', $quantity, '$edition', '$binding', '$form', '$type', $price, '$lang')";
          }
          if (!empty($_FILES["cover"]["name"]) && $_FILES["cover"]["error"] == 0) {
               $picture =  $_FILES["cover"]["name"];
               
               if($_FILES["cover"]["error"] == 0){
                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                    $filename = $title. random_int(1, 999999) .$picture;
                    $filetype = $_FILES["cover"]["type"];
                    $filesize = $_FILES["cover"]["size"];
                    $filename = $title. "_Update_" .$picture;
                    $upload_dir = 'assets/uploads/images/';
     
                    // Verify file extension
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if(!array_key_exists($ext, $allowed)){
                         $msg['errors'] = 'Error: Please select a valid file format.';
                    }
     
                    // Verify file size - 5MB maximum
                    // $maxsize = 10 * 1024 * 1024;
                    // if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
     
                    // Verify MYME type of the file
                    if(in_array($filetype, $allowed)){
                    // Check whether file exists before uploading it
                         if(file_exists($upload_dir . $filename)){
                              unlink($upload_dir . $filename);
                              move_uploaded_file($_FILES["cover"]["tmp_name"], './../'.$upload_dir . $filename);
                         } else{
                              move_uploaded_file($_FILES["cover"]["tmp_name"], './../'.$upload_dir . $filename);
                              // echo "Your file was uploaded successfully.";
                         }
                    } else{
                         $msg['errors'] = "Error: There was a problem uploading your file. Please try again.";
                    }
                    $p_picture = $upload_dir . $filename;
     
                    $imgquery = "INSERT INTO images (path, title, uploaded_at) VALUES ('$upload_dir', '$filename', NOW() )";
                    $imgResult = mysqli_query($db, $imgquery);
                    $imgID = mysqli_insert_id($db);
                    
               }
          }
          if (!empty($_FILES['cover']['name']) && empty($_FILES['pdf']['name'])) {
               if (isset($imgID) && $imgID != 0) {
                $query = "INSERT INTO books (seriesId, publisherId, coverId, title, subtitle, ISBN10, publishingYear, pages, description, quantity, edition, binding, physicalForm, type, price, language) VALUES ($seriesID, $publisherID, $imgID, '$title', '$subTitle', '$isbn', $publishYear, $pages, '$description', $quantity, '$edition', '$binding', '$form', '$type', $price, '$lang')";
               }
          }
          if (!empty($_FILES['pdf']['name']) && $_FILES['pdf']['error'] == 0) {
               if ($_FILES['pdf']['error'] == 0) {
                    $pdfName = $_FILES['pdf']['name'];
                    $pdfExt = pathinfo($pdfName, PATHINFO_EXTENSION);
                    $pdfSize = $_FILES["pdf"]["size"]/1024;
                    
                    $upload_dir = 'Admin/assets/uploads/PDF/';
                    if ($pdfExt != 'pdf') {
                         $msg['errors'] = "File format is not pdf";
                    }else{
                         if(file_exists($upload_dir . $pdfName)){
                              unlink($upload_dir . $pdfName);
                              move_uploaded_file($_FILES["pdf"]["tmp_name"], './../'.$upload_dir . $pdfName);
                         } else{
                              move_uploaded_file($_FILES["pdf"]["tmp_name"], './../'.$upload_dir . $pdfName);
                              // echo "Your file was uploaded successfully.";
                         }
                         $pdfData = $upload_dir . $pdfName;
                         $pdfSQL = "INSERT INTO book_pdf (pdf, pdfSize) VALUES ('$pdfData', '$pdfSize')";
                         $pdfResult = mysqli_query($db, $pdfSQL);
                         $pdfID = mysqli_insert_id($db);
                    }
               }
          }
          
          if(!empty($_FILES['pdf']['name']) && empty($_FILES['cover']['name'])){
               if (isset($pdfID) && $pdfID != 0) {
                    $query = "INSERT INTO books (seriesId, publisherId, title, subtitle, ISBN10, publishingYear, pages, description, quantity, edition, binding, physicalForm, type, pdf_id, price, language) VALUES ($seriesID, $publisherID, '$title', '$subTitle', '$isbn', $publishYear, $pages, '$description', $quantity, '$edition', '$binding', '$form', '$type', $pdfID, $price, '$lang')";
               }
          }
          
          if (!empty($_FILES['pdf']['name']) && !empty($_FILES['cover']['name'])) {
              if ($imgID != 0 && $pdfID != 0) {
               $query = "INSERT INTO books (seriesId, publisherId, coverId, title, subtitle, ISBN10, publishingYear, pages, description, quantity, edition, binding, physicalForm, type, pdf_id, price, language) VALUES ($seriesID, $publisherID, $imgID, '$title', '$subTitle', '$isbn', $publishYear, $pages, '$description', $quantity, '$edition', '$binding', '$form', '$type', $pdfID, $price, '$lang')";
              }
          }

          if (!isset($msg['errors']) && empty($msg['errors'])) {
               // echo $query;
               // die();
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
                    $msg['errors'] = "Something Wrong Please Try Again Later";
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
          $title = $_POST['title'] ;
          $subTitle = $_POST['subTitle'];
          $isbn = $_POST['isbn'];
          $seriesID = $_POST['series'];
          $publisherID = $_POST['publisher'];
          $authorID = $_POST['author'];
          $genreID = $_POST['genre'];
          $edition = $_POST['edition'];
          $publishYear = !empty($_POST['published_year']) ? $_POST['published_year'] : 0;
          $pages = !empty($_POST['pages']) ? $_POST['pages'] : '0';
          $description = $_POST['description'];
          $quantity = !empty($_POST['quantity']) ? $_POST['quantity'] : '0';
          $binding = $_POST['binding'];
          $form = $_POST['form'];
          $type = $_POST['bookType'];
          $price = !empty($_POST['price']) ? $_POST['price'] : '0';
          $lang = $_POST['language'];
          $coverId = $_POST['coverId'];
          $pdfUpdateID = $_POST['pdfId'];
          
          if(empty($_FILES['cover']['name']) &&  empty($_FILES['pdf']['name'])){
               # code...
               $query = "UPDATE books SET `seriesId`=$seriesID,`publisherId`=$publisherID, `title`='$title',`subtitle`='$subTitle',`ISBN10`='$isbn',`publishingYear`=$publishYear,`pages`=$pages,`description`='$description',`quantity`=$quantity,`edition`='$edition',`binding`='$binding',`physicalForm`='$form',`type`='$type',`price`=$price,`language`='$lang',`updated_at`= NOW() WHERE id = $id";
          }
          if (!empty($_FILES["cover"]["name"]) && $_FILES["cover"]["error"] == 0) {
               $picture =  $_FILES["cover"]["name"];
               
               if($_FILES["cover"]["error"] == 0){
                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                    $filetype = $_FILES["cover"]["type"];
                    $filesize = $_FILES["cover"]["size"];
                    $filename = $title. random_int(1, 9999) .$picture;
                    $upload_dir = 'assets/uploads/images/';
     
                    // Verify file extension
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if(!array_key_exists($ext, $allowed)){
                         
                         $msg['errors'] = 'Error: Please select a valid file format.';
                    }else{

                    // Verify file size - 5MB maximum
                    // $maxsize = 10 * 1024 * 1024;
                    // if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
     
                    // Verify MYME type of the file
                    if(in_array($filetype, $allowed)){
                         // Check whether file exists before uploading it
                         if(file_exists($upload_dir . $filename)){
                              unlink($upload_dir . $filename);
                              move_uploaded_file($_FILES["cover"]["tmp_name"], './../'.$upload_dir . $filename);
                         } else{
                              move_uploaded_file($_FILES["cover"]["tmp_name"], './../'.$upload_dir . $filename);
                              // echo "Your file was uploaded successfully.";
                         }
                    } else{
                         $msg['errors'] = "Error: There was a problem uploading your file. Please try again.";
                    }
                    $p_picture = $upload_dir . $filename;
                    }
                    if (empty($coverId)) {     
                         $imgquery = "INSERT INTO images (path, title, uploaded_at) VALUES ('$upload_dir', '$filename', NOW() )"; 
                         $imgResult = mysqli_query($db, $imgquery);
                         $imgID = mysqli_insert_id($db);
                    }
                    if(!empty($coverId)){
                         $imgquery = "UPDATE images SET path = '$upload_dir', title ='$filename', uploaded_at = NOW() WHERE id = $coverId";
                         $imgResult = mysqli_query($db, $imgquery);
                         $imgID = $coverId;
                    }
                   
                    
               }
          }
          if (!empty($_FILES['cover']['name']) && empty($_FILES['pdf']['name'])) {
               if (isset($imgID) && $imgID != 0) {
                    $query = "UPDATE books SET `seriesId`=$seriesID,`publisherId`=$publisherID, coverId = $imgID, `title`='$title',`subtitle`='$subTitle',`ISBN10`='$isbn',`publishingYear`=$publishYear,`pages`=$pages,`description`='$description',`quantity`=$quantity,`edition`='$edition',`binding`='$binding',`physicalForm`='$form',`type`='$type',`price`=$price,`language`='$lang',`updated_at`= NOW() WHERE id = $id";
               }
          }
          if (!empty($_FILES['pdf']['name']) && $_FILES['pdf']['error'] == 0) {
               if ($_FILES['pdf']['error'] == 0) {
                    $pdfName = $_FILES['pdf']['name'];
                    $pdfExt = pathinfo($pdfName, PATHINFO_EXTENSION);
                    $pdfSize = $_FILES["pdf"]["size"]/1024;
                    $upload_dir = 'Admin/assets/uploads/PDF/';
                    if ($pdfExt != 'pdf') {
                         $msg['errors'] = "File format is not pdf";
                    }else{
                         if(file_exists($upload_dir . $pdfName)){
                              unlink($upload_dir . $pdfName);
                              move_uploaded_file($_FILES["pdf"]["tmp_name"], './../'.$upload_dir . $pdfName);
                         } else{
                              move_uploaded_file($_FILES["pdf"]["tmp_name"], './../'.$upload_dir . $pdfName);
                              // echo "Your file was uploaded successfully.";
                         }
                         $pdfData = $upload_dir . $pdfName;
                         if (empty($pdfUpdateID)) {
                              $pdfSQL = "INSERT INTO book_pdf (pdf, pdfSize) VALUES ('$pdfData', '$pdfSize')";
                              $pdfResult = mysqli_query($db, $pdfSQL);
                              $pdfID = mysqli_insert_id($db);
                         }
                         if (!empty($pdfUpdateID)) {
                              die('updatePDF');
                              $pdfSQL = "UPDATE book_pdf SET pdf='$pdfData', pdfSize='$pdfSize' WHERE id = $pdfUpdateID";
                              $pdfResult = mysqli_query($db, $pdfSQL);
                              $pdfID = $pdfUpdateID;
                         }
                    }
               }
          }
          if (!empty($_FILES['pdf']['name']) && empty($_FILES['cover']['name'])) {
              if (isset($pdfID) && $pdfID != 0) {
               $query = "UPDATE books SET `seriesId`=$seriesID,`publisherId`=$publisherID, `title`='$title',`subtitle`='$subTitle',`ISBN10`='$isbn',`publishingYear`=$publishYear,`pages`=$pages,`description`='$description',`quantity`=$quantity,`edition`='$edition',`binding`='$binding',`physicalForm`='$form',`type`='$type',`pdf_id`=$pdfID,`price`=$price,`language`='$lang',`updated_at`= NOW() WHERE id = $id";
              }
          }
          if (!empty($_FILES['pdf']['name']) && !empty($_FILES['cover']['name'])) {
              if ($imgID != 0 && $pdfID != 0) {
               $query = "UPDATE books SET `seriesId`=$seriesID,`coverId`=$imgID,`publisherId`=$publisherID, `title`='$title',`subtitle`='$subTitle',`ISBN10`='$isbn',`publishingYear`=$publishYear,`pages`=$pages,`description`='$description',`quantity`=$quantity,`edition`='$edition',`binding`='$binding',`physicalForm`='$form',`type`='$type',`pdf_id`=$pdfID,`price`=$price,`language`='$lang',`updated_at`= NOW() WHERE id = $id";
              }
          }
          if (!isset($msg['errors']) && empty($msg['errors'])) {
               if (mysqli_query($db, $query)) {
            
                    mysqli_query($db, "UPDATE bookauthors SET authorId = $authorID WHERE bookId = $id");
                    mysqli_query($db, "UPDATE bookgenres SET genreId = $genreID WHERE bookId = $id");
                    
                    $msg['status'] = "Books Successfully Added";
                    echo "
                    <script>
                    window.location.href='./bookList.php';
                    </script>
                    ";
               } else {
                    $msg['errors'] = "Something Wrong Please Try Again Later";
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
               $msg['errors'] = "Something Wrong Please Try Again Later";
          }
     }
}
if (isset($_GET['deleteBook'])) {
     deleteBook();
}
?>

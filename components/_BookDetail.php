<?php 
  include_once('./Admin/functions/_Books.php');
  $id = $_GET['id'];
  $query = "SELECT * FROM books WHERE id = $id";
  $result = mysqli_query($db, $query);
  $row = mysqli_num_rows($result);
  if ($row == 0) {
       return false;
  }else{
       $book = mysqli_fetch_assoc($result);
  }
  if (isset($_POST['bookReq'])) {
      
        if (!isset($_SESSION['login'])) {
            header('location: ./login.php');
        }else{
            $userId = $_SESSION['login']['id'];
            $bookId = $_POST['bookId'];
            $status = 'Pending';
            $note = $_POST['note'];
            $query = "INSERT INTO requests (userId, bookId, status, notes, creationDate) VALUES ($userId, $bookId, '$status', '$note', NOW())";
            if (mysqli_query($db, $query)) {
                echo "<script>
                    alert('Book request succesfully sent');
                </script>";
            }
        }
  }
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-12 p-5">
            <div class="container">
                <?php 
                    $imgID = $book['coverId'];
                    $getImg = "SELECT * FROM images WHERE id = $imgID";
                    $result = mysqli_query($db, $getImg);
                    $row = mysqli_num_rows($result);
                    if($row > 0){
                        $bookCover = mysqli_fetch_assoc($result);
                    }
                ?>
                <img class="img-fluid" src="./<?= $bookCover['path'].$bookCover['title'] ?>" alt="">
            </div>
        </div>
        <div class="col-lg-6 col-md-12 p-5">
            <h2 class="display-3"><?= $book['title']; ?></h2>
            <div class="container px-5 py-1">
                <p class="lead"><?= $book['subtitle'] ?></p>
                <p>Author: <?= getAuthor($book['id']); ?></p>
                <p>Publisher: <?= getPublisher($book['publisherId']); ?></p>
                <p>Series name: <?= getSeries($book['seriesId']); ?></p>
                <p>Quantity: <?= $book['quantity'] ?> </p>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <input type="hidden" name="userId" value="<?= $_SESSION['login']['id'] ?>" class="form-control">
                    <input type="hidden" name="bookId" value="<?= $_GET['id'] ?>" class="form-control">
                    <label for="note">Note:</label>
                    <input type="text" name="note" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" name="bookReq" value="submit" class="btn btn-primary">Request for
                        Book</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3>Description:</h3>
            <p><?= $book['description'] ?></p>
        </div>
    </div>
</div>

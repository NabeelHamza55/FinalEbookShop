<?php 
  include_once('./Admin/functions/_Books.php');
  // $query = 'SELECT * FROM Books';
  // $result = mysqli_query($db, $query);
  $data = fetchBooks();
  

?>
<div id="shop" class=" bg-success  p-5">
    <h1>Book Shop</h1>
    <div class="row p-5">
        <?php 
      
      while ($book = mysqli_fetch_assoc($data)) {
          ?>
        <div class="col-sm-2 col-md-3 col-lg-4 border py-5 px-3">
            <?php 
              $coverId = $book['coverId'];
              $query = "SELECT * FROM images WHERE id = $coverId";
              $result = mysqli_query($db, $query);
              if (!empty($result)) {
                  # code...
                  $row = mysqli_num_rows($result);
                  if ($row > 0) {
                      $image = mysqli_fetch_assoc($result); ?>
            <img src="<?= './'.$image['path'].'/'.$image['title'] ?>" style="width: 100%;" alt="">
            <?php
                    } 
                }else {
                    echo 'NA';
                }
            ?>
            <h3 class="p-3"><?= $book['title'] ?></h3>
            <p class="p-3">Author: <?php 
                echo getAuthor($book['id']);
            ?></p>
            <a href="./bookDetail.php?id=<?= $book['id'] ?>" class="btn btn-primary">See Detail</a>
        </div>
        <?php
      } ?>
    </div>

</div>

<?php
$title = 'Books List';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Books.php');
$list = fetchBooks();
?>

<h1 class="mt-4">Books</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Books</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Book List</h4>
        <a href="./bookAdd.php" class="btn btn-primary">Add Book</a>
    </div>
    <div class="card-body">
        <div class="text-center bg-success rounded">
            <?php if(isset($msg['status'])) { ?>
            <p class="lead mt-1 text-light">
                <?php
                if (isset($msg['status'])) {
                    echo  $msg['status'];
                }
               ?>
            </p>
            <?php }
               ?>
        </div>
        <table class="table table-responsive table-hover" id="datatablesSimple">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Title</th>
                    <th>Sub Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Series</th>
                    <th>Publisher</th>
                    <th>ISBN</th>
                    <th>Publishing Year</th>
                    <th>Quantity</th>
                    <th>Edition</th>
                    <th>Physical Form</th>
                    <th>Language</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list == false){ ?>

                <tr class="text-center">
                    <td colspan="14">No Genre Found</td>
                </tr>

                <?php }else {
                    $sr = 1;
                    while ($book = mysqli_fetch_assoc($list)) { ?>
                <tr>
                    <td><?= $sr++ ?></td>
                    <td><?= $book['title'] ?></td>
                    <td><?= $book['subtitle'] ?></td>
                    <td><?= getAuthor($book['id']) ?> </td>
                    <td><?= getGenre($book['id']) ?> </td>
                    <td><?= getSeries($book['seriesId']) ?></td>
                    <td><?= getPublisher($book['publisherId']) ?></td>
                    <td><?= $book['ISBN10'] ?></td>
                    <td><?= $book['publishingYear'] ?></td>
                    <td><?= $book['quantity'] ?></td>
                    <td><?= $book['edition'] ?></td>
                    <td><?= $book['physicalForm'] ?></td>
                    <td><?= $book['language'] ?></td>
                    <td>
                        <div class="container d-flex">
                            <button onclick="window.location.href='./bookUpdate.php?id=<?= $book['id']; ?>'"
                                class="btn btn-primary mx-1">Edit</button>

                            <button
                                onclick="window.location.href='./functions/_Books.php?deleteBook=<?= $book['id'];  ?>';"
                                class="btn btn-danger mx-1">Delete</button>
                        </div>
                    </td>
                </tr>
                <?php }
                }?>
            </tbody>
        </table>
    </div>
    <div class="card-footer"></div>
</div>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
  ?>

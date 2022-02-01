<?php
$title = 'Add Book';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Books.php');
addBooks();
?>

<h1 class="mt-4">Books</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">books</li>
    <li class="breadcrumb-item active">Add books</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Add Book</h4>
        <a href="./bookList.php" class="btn btn-primary">Book List</a>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="text-center bg-danger rounded">
                <?php if(isset($msg['error'])) { ?>
                <p class="lead mt-1 text-light">
                    <?php echo $msg['error'] ?>
                </p>
                <?php }
                ?>
            </div>
            <section class="container">
                <div class="row ">
                    <div class="col">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="subTitle">Sub Title</label>
                            <input type="text" name="subTitle" class="form-control" id="subTitle" >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input type="text" name="isbn" class="form-control" id="isbn" >
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="picture">Cover Picture</label>
                            <input type="file" name="cover" id="cover" class="form-control">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row ">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="series">Series</label>
                            <!-- <input type="text" name="series" class="form-control" id="series" > -->
                            <select name="series" class="form-control" id="series">
                                <option selected disabled value="">Select Series</option>
                                <?php  
                            $getSeries = 'SELECT id, name FROM series';
                            $result = mysqli_query($db, $getSeries);
                            $row = mysqli_num_rows($result);
                            if ($row > 0) {
                                while($series = mysqli_fetch_assoc($result)){
                                    ?>
                                <option value="<?= $series['id'] ?>"><?= $series['name']; ?></option>
                                <?php
                                }

                            }
                        ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="publisher">Publisher</label>
                            <!-- <input type="text" name="publisher" class="form-control" id="publisher" > -->
                            <select name="publisher" class="form-control" id="publisher">
                                <option selected disabled value="">Select Publisher</option>
                                <?php  
                            $getPublisher = 'SELECT id, name FROM publishers';
                            $result = mysqli_query($db, $getPublisher);
                            $row = mysqli_num_rows($result);
                            if ($row > 0) {
                                while($publishers = mysqli_fetch_assoc($result)){
                                    ?>
                                <option value="<?= $publishers['id'] ?>"><?= $publishers['name']; ?></option>
                                <?php
                                }

                            }
                        ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <select name="author" class="form-control" id="author">
                                <option selected disabled value="">Select Author</option>
                                <?php  
                            $getAuthor = 'SELECT id, firstName, lastName FROM authors';
                            $result = mysqli_query($db, $getAuthor);
                            $row = mysqli_num_rows($result);
                            if ($row > 0) {
                                while($authors = mysqli_fetch_assoc($result)){
                                    ?>
                                <option value="<?= $authors['id'] ?>">
                                    <?= $authors['firstName'] .' ' . $authors['lastName']; ?>
                                </option>
                                <?php
                                }
                            }
                        ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="genres">Genres</label>
                            <select name="genre" class="form-control" id="genre">
                                <option selected disabled value="">Select Genres</option>
                                <?php  
                            $getGenre = 'SELECT id, name FROM genres';
                            $result = mysqli_query($db, $getGenre);
                            $row = mysqli_num_rows($result);
                            if ($row > 0) {
                                while($genres = mysqli_fetch_assoc($result)){
                                     ?>
                                <option value="<?= $genres['id'] ?>"><?= $genres['name']; ?></option>
                                <?php
                                }
                            }
                        ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="edition">Edition</label>
                            <input type="text" name="edition" class="form-control" id="edition" >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="published_year">Published Year</label>
                            <input type="number" name="published_year" class="form-control" id="published_year"
                                >
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row ">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="pages">Pages</label>
                            <input type="number" name="pages" class="form-control" id="pages" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="form">Physical Form</label>
                            <select name="form" id="form" class="form-control">
                                <option value="" selected disabled>Select Form</option>
                                <option value="Book">Book</option>
                                <option value="Manuscript">ManuScript</option>
                                <option value="Journal">Journal</option>
                                <option value="CD/DVD">CD/DVD</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="binding">Binding</label>
                            <select name="binding" class="form-control" id="binding">
                                <option value="" disabled selected>Select Binding</option>
                                <option value="Hardcover">Hardcover</option>
                                <option value="Softcover">Softcover</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" id="quantity" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control" id="price" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="language">Language</label>
                            <input type="text" name="language" class="form-control" id="language" >
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="discription">Discription</label>
                            <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="submit">Add Book</button>
        </div>
    </form>
</div>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
  ?>

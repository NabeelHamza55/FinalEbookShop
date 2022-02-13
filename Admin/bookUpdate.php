<?php
$title = 'Update Book';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Books.php');
$data = bookDetail();
$book = mysqli_fetch_assoc($data);
updateBooks();
?>

<h1 class="mt-4">Books</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">books</li>
    <li class="breadcrumb-item active">Update books</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Update Book</h4>
        <a href="./bookList.php" class="btn btn-primary">Book List</a>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="text-center bg-danger rounded">
                <?php if(isset($msg['errors'])) { ?>
                <p class="lead mt-1 text-light">
                    <?php echo $msg['errors'] ?>
                </p>
                <?php }
                ?>
            </div>
            <section class="container">
                <div class="row ">
                    <div class="col">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="<?= $book['title'] ?>" class="form-control"
                                id="title" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="subTitle">Sub Title</label>
                            <input type="text" name="subTitle" value="<?= $book['subtitle'] ?>" class="form-control"
                                id="subTitle">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input type="text" name="isbn" value="<?= $book['ISBN10'] ?>" class="form-control"
                                id="isbn">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="picture">Cover Picture</label>
                            <input type="hidden" name="coverId" value="<?= $book['coverId'] ?>" class="form-control">
                            <input type="file" name="cover" id="cover" class="form-control">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row ">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="series">Series</label>
                            <!-- <input type="text" name="series" class="form-control" id="series" required> -->
                            <select name="series" class="form-control" id="series" required>
                                <option selected disabled value="">Select Series</option>
                                <?php  
                                $getSeries = 'SELECT id, name FROM series';
                                $result = mysqli_query($db, $getSeries);
                                $row = mysqli_num_rows($result);
                                if ($row > 0) {
                                    while($series = mysqli_fetch_assoc($result)){
                                        ?>
                                <option <?= $book['seriesId'] == $series['id'] ? 'selected' : '' ?>
                                    value="<?= $series['id'] ?>"><?= $series['name']; ?></option>
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
                            <!-- <input type="text" name="publisher" class="form-control" id="publisher" required> -->
                            <select name="publisher" class="form-control" id="publisher" required>
                                <option selected disabled value="">Select Publisher</option>
                                <?php  
                            $getPublisher = 'SELECT id, name FROM publishers';
                            $result = mysqli_query($db, $getPublisher);
                            $row = mysqli_num_rows($result);
                            if ($row > 0) {
                                while($publishers = mysqli_fetch_assoc($result)){
                                    ?>
                                <option <?= $book['publisherId'] == $publishers['id'] ? 'selected' : '' ?>
                                    value="<?= $publishers['id'] ?>"><?= $publishers['name']; ?></option>
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
                            <select name="author" class="form-control" id="author" required>
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
                            <select name="genre" class="form-control" id="genre" required>
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
                            <input type="text" name="edition" value="<?= $book['edition'] ?>" class="form-control"
                                id="edition">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="published_year">Published Year</label>
                            <input type="number" name="published_year" value="<?= $book['publishingYear'] ?>"
                                class="form-control" id="published_year" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row ">

                    <div class="col-4">
                        <div class="form-group">
                            <label for="bookType">Book Type</label>
                            <select name="bookType" id="bookType" class="form-control">
                                <option <?= $book['type'] == 'Standard' ? 'selected' : '' ?> value="Standard">Standard
                                </option>
                                <option <?= $book['type'] == 'Digital' ? 'selected' : '' ?> value="Digital">Digital
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-8 d-none pdf-form">
                        <div class="form-group">
                            <label for="pdf">Upload PDF</label>
                            <input type="hidden" name="pdfId" value="<?= $book['pdf_id'] ?>" class="form-control">
                            <input type="file" name="pdf" id="pdf" class="form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="form">Physical Form</label>
                            <select name="form" id="form" class="form-control">
                                <option value="" selected disabled>
                                    Select Form</option>
                                <option <?= $book['physicalForm'] == 'Book' ? 'selected' : '' ?> value="Book">Book
                                </option>
                                <option <?= $book['physicalForm'] == 'Manuscript' ? 'selected' : '' ?>
                                    value="Manuscript">ManuScript</option>
                                <option <?= $book['physicalForm'] == 'Journal' ? 'selected' : '' ?> value="Journal">
                                    Journal</option>
                                <option <?= $book['physicalForm'] == 'CD/DVD' ? 'selected' : '' ?> value="CD/DVD">CD/DVD
                                </option>
                                <option <?= $book['physicalForm'] == 'PDF' ? 'selected' : '' ?> value="PDF">PDF
                                </option>
                                <option <?= $book['physicalForm'] == 'Other' ? 'selected' : '' ?> value="Other">Other
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="binding">Binding</label>
                            <select name="binding" class="form-control" id="binding">
                                <option value="" disabled selected>Select Binding</option>
                                <option <?= $book['binding'] == 'Hardcover' ? 'selected' : '' ?> value="Hardcover">
                                    Hardcover
                                </option>
                                <option <?= $book['binding'] == 'Softcover' ? 'selected' : '' ?> value="Softcover">
                                    Softcover</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="pages">Pages</label>
                            <input type="number" name="pages" value="<?= $book['pages'] ?>" class="form-control"
                                id="pages">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" value="<?= $book['quantity'] ?>" name="quantity" class="form-control"
                                id="quantity">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="price">Price($)</label>
                            <input type="number" value="<?= $book['price'] ?>" name="price" class="form-control"
                                id="price">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label for="language">Language</label>
                            <input type="text" value="<?= $book['language'] ?>" name="language" class="form-control"
                                id="language">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="discription">Discription</label>
                            <textarea name="description" id="description" class="form-control"
                                rows="5"><?= $book['description'] ?></textarea>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="submit">Update Book</button>
        </div>
    </form>
</div>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
?>
<script>
$(document).ready(function() {
    let val = $('#bookType').val();
    $('.pdf-form').addClass('d-none');
    if (val == 'Digital') {
        $('.pdf-form').removeClass('d-none');
    }
    if (val != 'Digital') {
        $('.pdf-form').addClass('d-none');
    }
    $('#bookType').change(function(e) {
        e.preventDefault();
        let val = $('#bookType').val();
        if (val == 'Digital') {
            $('.pdf-form').removeClass('d-none');
        }
        if (val != 'Digital') {
            $('.pdf-form').addClass('d-none');
        }
    });
});
</script>

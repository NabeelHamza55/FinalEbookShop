<?php
$title = 'Dashboard';
include('./components/HTML_Start.php');
include('./components/header.php');
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
    <div class="card-body">
        <section class="container">
            <div class="row ">
                <div class="col">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="subTitle">Sub Title</label>
                        <input type="text" name="subTitle" class="form-control" id="subTitle" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" class="form-control" id="isbn" required>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group">
                        <label for="series">Series</label>
                        <input type="text" name="series" class="form-control" id="series" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" name="publisher" class="form-control" id="publisher" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="author" class="form-control" id="author" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="genres">Genres</label>
                        <input type="text" name="genres" class="form-control" id="genres" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="edition">Edition</label>
                        <input type="text" name="edition" class="form-control" id="edition" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="published_year">Published Year</label>
                        <input type="text" name="published_year" class="form-control" id="published_year" required>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row ">
                <div class="col-4">
                    <div class="form-group">
                        <label for="pages">Pages</label>
                        <input type="text" name="pages" class="form-control" id="pages" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="form">Physical Form</label>
                        <input type="text" name="form" class="form-control" id="form" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="binding">Binding</label>
                        <input type="text" name="binding" class="form-control" id="binding" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" name="quantity" class="form-control" id="quantity" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control" id="price" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="language">Language</label>
                        <input type="text" name="language" class="form-control" id="language" required>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary float-end" type="submit" name="submit">Add Book</button>
    </div>
</div>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
  ?>

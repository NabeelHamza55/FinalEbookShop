<?php
$title = 'Update Author';
include('./components/HTML_Start.php');
include('./components/header.php');
?>

<h1 class="mt-4">Authors</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Authors</li>
    <li class="breadcrumb-item active">Update Author</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Update Author</h4>
        <a href="./authorList.php" class="btn btn-primary">Author List</a>
    </div>
    <div class="card-body">
        <section class="container">
            <div class="row ">
                <div class="col-6">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" value="" class="form-control" id="firstName" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" value="" class="form-control" id="lastName" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" value="" class="form-control"
                            id="description"></textarea>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary float-end" type="submit" name="submit">Update Author</button>
    </div>
</div>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
  ?>

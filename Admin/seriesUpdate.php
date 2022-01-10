<?php
$title = 'Update Series';
include('./components/HTML_Start.php');
include('./components/header.php');
?>

<h1 class="mt-4">seriess</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Series</li>
    <li class="breadcrumb-item active">Update Series</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Update Series</h4>
        <a href="./seriesList.php" class="btn btn-primary">series List</a>
    </div>
    <div class="card-body">
        <section class="container">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="name">Series Name</label>
                        <input type="text" name="name" value="" class="form-control" id="name" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="isCompleted">Is Completed?</label>
                        <input type="checkbox" name="isCompleted" value="1" class="" id="isCompleted" required>
                    </div>
                </div>
        </section>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary float-end" type="submit" name="submit">Update Series</button>
    </div>
</div>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
  ?>

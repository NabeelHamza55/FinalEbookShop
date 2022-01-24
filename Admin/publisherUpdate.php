<?php
$title = 'Update Publishers';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Publisher.php');

$data = publisherDetail();
$publisher =  mysqli_fetch_assoc($data);
updatePublisher();

?>

<h1 class="mt-4">Publishers</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Publishers</li>
    <li class="breadcrumb-item active">Update Publisher</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Update Publisher</h4>
        <a href="./publisherList.php" class="btn btn-primary">Publisher List</a>
    </div>
    <form action="" method="post">
        <div class="card-body">
            <section class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Publisher Name</label>
                            <input type="text" name="name" value="<?=$publisher['name'] ?>" class="form-control"
                                id="name" required>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="submit">Update Publisher</button>
        </div>
    </form>
</div>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
  ?>

<?php
$title = 'Add Publishers';
include('./components/HTML_Start.php');
include('./components/header.php');

include('./functions/_Publisher.php');

$list = addPublisher();
?>

<h1 class="mt-4">Publishers</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Publishers</li>
    <li class="breadcrumb-item active">Add Publisher</li>
</ol>

<form action="" method="POST">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Add Publisher</h4>
            <a href="./publisherList.php" class="btn btn-primary">Publisher List</a>
        </div>
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
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Publisher Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="submit">Add Publisher</button>
        </div>
    </div>
</form>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
  ?>

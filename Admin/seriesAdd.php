<?php
$title = 'Add seriess';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Series.php');
addSeries();
?>

<h1 class="mt-4">Series</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Series</li>
    <li class="breadcrumb-item active">Add series</li>
</ol>
<div class="card">
    <div class="card-header text-light bg-primary d-flex justify-content-between align-items-center">
        <h4 class="card-title">Add Series</h4>
        <a href="./seriesList.php" class="btn btn-light">Series List</a>
    </div>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="series">
        <div class="card-body">

            <section class="container">
                <div class="text-center bg-danger rounded">
                    <?php if(isset($_SESSION['errors'])) { ?>
                    <p class="lead mt-1 text-light">
                        <?php echo $_SESSION['errors'] ?>
                    </p>
                    <?php }
                         unset($_SESSION['errors']);
                    ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Series Name</label>
                            <input type="text" name="name" value="" class="form-control" id="name" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="isCompleted">Is Completed?</label>
                            <input type="checkbox" name="isCompleted" value="1" class="" id="isCompleted">
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary d-flex" type="submit" name="submit">Add Series</button>
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
    $("#series").submit(function(e) {
        e.preventDefault();
    });
});
</script>

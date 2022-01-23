<?php
$title = 'Update Genres';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Genre.php');

$data = genreDetail();
$genre =  mysqli_fetch_assoc($data);
updateGenre();

?>

<h1 class="mt-4">Genres</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Genres</li>
    <li class="breadcrumb-item active">Update Genre</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Update Genre</h4>
        <a href="./genreList.php" class="btn btn-primary">Genre List</a>
    </div>
    <form action="" method="post">
        <div class="card-body">
            <section class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Genre Name</label>
                            <input type="text" name="name" value="<?=$genre['name'] ?>" class="form-control" id="name"
                                required>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="submit">Update Genre</button>
        </div>
    </form>
</div>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
  ?>

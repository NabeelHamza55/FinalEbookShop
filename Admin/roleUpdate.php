<?php
$title = 'Update Roles';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Roles.php');
$data = seriesDetail();
updateRole();
if (!empty($data)) {
    $roles = mysqli_fetch_assoc($data);
}
?>

<h1 class="mt-4">seriess</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Roles</li>
    <li class="breadcrumb-item active">Update Role</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Update Role</h4>
        <a href="./seriesList.php" class="btn btn-primary">Roles List</a>
    </div>
    <form action="" method="post">
        <div class="card-body">
            <div class="text-center bg-danger rounded">
                <?php if(isset($msg['error'])) { ?>
                <p class="lead mt-1 text-light">
                    <?php echo $msg['error'] ?>
                </p>
                <?php } ?>
            </div>
            <section class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" name="name" value="<?= $roles['name']?>" class="form-control" id="name"
                                required>
                        </div>
                        <br>
                    </div>
            </section>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="submit">Update Role</button>
        </div>
    </form>
</div>
<br>
<?php
    include('./components/footer.php');
    include('./components/HTML_End.php');
?>

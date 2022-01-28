<?php
$title = 'Add Role';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Roles.php');
addRole();
?>

<h1 class="mt-4">Role</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Roles</li>
    <li class="breadcrumb-item active">Add Role</li>
</ol>
<div class="card">
    <div class="card-header text-light bg-primary d-flex justify-content-between align-items-center">
        <h4 class="card-title">Add Role</h4>
        <a href="./roleList.php" class="btn btn-light">Roles List</a>
    </div>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="role">
        <div class="card-body">

            <section class="container">
                <div class="text-center bg-danger rounded">
                    <?php if(isset($msg['error'])) { ?>
                    <p class="lead mt-1 text-light">
                        <?php echo $msg['error'] ?>
                    </p>
                    <?php }
                    ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" name="name" value="" class="form-control" id="name" required>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="issueLimit">Set Issue Limit Per Day</label>
                                    <input type="number" class="form-control" name="issueLimit" id="issueLimit">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="bookLimit">Set Book Limit Per Day</label>
                                    <input type="number" class="form-control" name="bookLimit" id="bookLimit">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="fineLimit">Set Fine Per Day</label>
                                    <input type="number" class="form-control" name="fineLimit" id="fineLimit">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="priority">Set Priority</label>
                                    <input type="number" value="" min="1" max="3" maxlength="1" class="form-control"
                                        name="priority" id="priority">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary d-flex" type="submit" name="submit">Add Role</button>
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
    $("#role").submit(function(e) {
        e.preventDefault();
    });
});
</script>

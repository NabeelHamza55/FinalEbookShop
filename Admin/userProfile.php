<?php
$title = 'User List';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Users.php');

$list = updateProfile($_SESSION['login']['id']);
?>

<h1 class="mt-4">User</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">ُProfile</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">User Profile</h4>
    </div>
    <div class="card-body">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="user">
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
                    <div class="text-center bg-success rounded">
                        <?php if(!empty($msg['status'])) { ?>
                        <p class="lead mt-1 text-light">
                            <?= $msg['status'] ?>
                        </p>
                        <?php }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" name="firstName" value="<?= $_SESSION['login']['firstName'] ?>"
                                    class="form-control" id="firstName" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="middleName">Middle Name</label>
                                <input type="text" name="middleName" value="<?= $_SESSION['login']['middleName'] ?>"
                                    class="form-control" id="middleName">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" name="lastName" value="<?= $_SESSION['login']['lastName'] ?>"
                                    class="form-control" id="lastName">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" placeholder="@mail.com"
                                    value="<?= $_SESSION['login']['email'] ?>" class="form-control" id="email" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="Phone">Phone</label>
                                <input type="tel" name="phone" placeholder="e.g: 03001112233"
                                    value="<?= $_SESSION['login']['phone'] ?>" pattern="[0-9]{4}[0-9]{3}[0-9]{4}"
                                    class="form-control" id="Phone" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="" selected disabled>Select Gender</option>
                                    <option <?= $_SESSION['login']['gender'] == "Male" ? 'selected' : '' ?>
                                        value="Male">Male
                                    </option>
                                    <option <?= $_SESSION['login']['gender'] == "Female" ? 'selected' : '' ?>
                                        value="Female">Female
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="address">Address</label>
                            <div class="form-group">
                                <textarea name="address" class="form-control" id="address"
                                    rows="2"><?= $_SESSION['login']['address'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary d-flex" type="submit" name="submit">Update User</button>
            </div>
        </form>
    </div>
</div>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
 ?>
<script>
$(document).ready(function() {
    $("#user").submit(function(e) {
        e.preventDefault();
    });
});
</script>

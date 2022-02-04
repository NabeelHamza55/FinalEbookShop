<?php
$title = 'Update User';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Users.php');
$userdata = userDetail();
$data = fetchRoles();
$user =  mysqli_fetch_assoc($userdata);
updateUser($_GET['id']);
?>

<h1 class="mt-4">User</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Users</li>
    <li class="breadcrumb-item active">Update User</li>
</ol>
<div class="card">
    <div class="card-header text-light bg-primary d-flex justify-content-between align-items-center">
        <h4 class="card-title">Update User</h4>
        <a href="./userList.php" class="btn btn-light">Users List</a>
    </div>
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
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" name="firstName" value="<?= $user['firstName'] ?>" class="form-control"
                                id="firstName" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="middleName">Middle Name</label>
                            <input type="text" name="middleName" value="<?= $user['middleName'] ?>" class="form-control"
                                id="middleName">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" value="<?= $user['lastName'] ?>" class="form-control"
                                id="lastName" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="@mail.com" value="<?= $user['email'] ?>"
                                class="form-control" id="email" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="Phone">Phone</label>
                            <input type="tel" name="phone" placeholder="e.g: 03001112233" value="<?= $user['phone'] ?>"
                                pattern="[0-9]{4}[0-9]{3}[0-9]{4}" class="form-control" id="Phone" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" value="" class="form-control" id="password" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="passwordConfirmation">Password Confirmation</label>
                            <input type="password" name="passwordConfirmation" value="" class="form-control"
                                id="passwordConfirmation" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" class="form-control" id="gender">
                                <option value="" selected disabled>Select Gender</option>
                                <option <?= $user['gender'] == "Male" ? 'selected' : '' ?> value="Male">Male</option>
                                <option <?= $user['gender'] == "Female" ? 'selected' : '' ?> value="Female">Female
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="" selected disabled>Select Status</option>
                                <option <?= $user['isActive'] == "1" ? 'selected' : '' ?> value="1">Active</option>
                                <option <?= $user['isActive'] == "0" ? 'selected' : '' ?> value="0">Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="role">
                                <option value="" selected disabled>Selecet Role</option>
                                <?php if (!empty($data)) {
                                    while($role = mysqli_fetch_assoc($data)){
                                        ?>
                                <option <?= $user['roleId'] == $role['id'] ? 'selected' : '' ?>
                                    value="<?= $role['id'] ?>"> <?= $role['name'] ?> </option>
                                <?php
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="address">Address</label>
                        <div class="form-group">
                            <textarea name="address" class="form-control" id="address"
                                rows="2"><?= $user['address'] ?></textarea>
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

<?php
$title = 'User List';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Users.php');

$list = fetchUsers();

?>

<h1 class="mt-4">User</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Users</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">User List</h4>
        <a href="./userAdd.php" class="btn btn-primary">Add User</a>
    </div>
    <div class="card-body">
        <div class="text-center bg-success rounded">
            <?php if(!empty($msg['status'])) { ?>
            <p class="lead mt-1 text-light">
                <?= $msg['status'] ?>
            </p>
            <?php }
               ?>
        </div>
        <table class="table table-responsive table-hover" id="datatablesSimple">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Picture</th>
                    <th>First Name</th>
                    <th>last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($list)){ ?>
                <tr class="text-center">
                    <td colspan="4">No User Found</td>
                </tr>
                <?php  }else{
                $sr = 1;
                while($user = mysqli_fetch_assoc($list)) {
                ?>
                <tr>
                    <td><?= $sr++ ?></td>
                    <td><?= $user['photoId'] ?></td>
                    <td><?= $user['firstName'] ?></td>
                    <td><?= $user['lastName'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= getRole($user['roleId']); ?></td>
                    <td><?= $user['phone'] ?></td>
                    <td><?= $user['address'] ?></td>
                    <td><?= $user['isActive'] ?></td>
                    <td>
                        <div class="container">
                            <button onclick="window.location.href='./userUpdate.php?id=<?= $user['id']; ?>'"
                                class="btn btn-primary">Edit</button>

                            <button
                                onclick="confirm('Are You Sure'); window.location.href='./functions/_Users.php?deleteUser=<?= $user['id'];  ?>';"
                                class="btn btn-danger">Delete</button>
                        </div>
                    </td>
                </tr>
                <?php
                    }
               } ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer"></div>
</div>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
  ?>

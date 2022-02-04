<?php
$title = 'Role List';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Roles.php');

$list = fetchRoles();

?>

<h1 class="mt-4">Role</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Roles</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Role List</h4>
        <a href="./roleAdd.php" class="btn btn-primary">Add Role</a>
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
                    <th>Name</th>
                    <!-- <th>Issue Limit</th>
                    <th>Book Limit</th>
                    <th>Fine Per Day Limit</th>
                    <th>Priority</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($list)){ ?>
                <tr class="text-center">
                    <td colspan="4">No Role Found</td>
                </tr>
                <?php  }else{
                $sr = 1;
                while($role = mysqli_fetch_assoc($list)) {
                ?>
                <tr>
                    <td><?php echo $sr++ ?></td>
                    <td><?php echo $role['name'] ?></td>
                    <!-- <td><?php // echo $role['issueDayLimit'] ?></td>
                    <td><?php // echo $role['issueBookLimit'] ?></td>
                    <td><?php // echo $role['finePerDay'] ?></td> -->
                    <td>
                        <div class="container">
                            <button onclick="window.location.href='./roleUpdate.php?id=<?= $role['id']; ?>'"
                                class="btn btn-primary">Edit</button>
                            <button
                                onclick="confirm('Are You Sure'); window.location.href='./functions/_Roles.php?deleteRole=<?= $role['id'];  ?>';"
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

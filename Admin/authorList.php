<?php
$title = 'Authors List';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Author.php');

$list = fetchAuthors();

?>

<h1 class="mt-4">Authors</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Authors</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Author List</h4>
        <a href="./authorAdd.php" class="btn btn-primary">Add Author</a>
    </div>
    <div class="card-body">
        <div class="text-center bg-success rounded">
            <?php if(isset($msg['status'])) { ?>
            <p class="lead mt-1 text-light">
                <?php
                if (isset($msg['status'])) {
                    echo  $msg['status'];
                }
               ?>
            </p>
            <?php }
               ?>
        </div>
        <table class="table table-responsive table-hover" id="datatablesSimple">
            <thead>
                <tr>
                    <th>Sr.No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list == false){ ?>

                <tr class="text-center">
                    <td colspan="5">No Author Found</td>
                </tr>

                <?php }else { 
                    $sr = 1;
                    while($author = mysqli_fetch_assoc($list)) { ?>
                <tr>
                    <td><?= $sr++; ?></td>
                    <td><?= $author['firstName'] ?></td>
                    <td><?= $author['lastName'] ?></td>
                    <td><?= $author['description'] ?></td>
                    <td>
                        <div class="container">
                            <button onclick="window.location.href='./authorUpdate.php?id=<?= $author['id']; ?>'"
                                class="btn btn-primary">Edit</button>

                            <button
                                onclick=" window.location.href='./functions/_author.php?deleteAuthor=<?= $author['id'];  ?>';"
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

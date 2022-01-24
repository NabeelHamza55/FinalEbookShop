<?php
$title = 'Publishers List';
include('./components/HTML_Start.php');
include('./components/header.php');

include('./functions/_Publisher.php');

$list = fetchPublishers();
?>

<h1 class="mt-4">Publishers</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Publishers</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Publisher List</h4>
        <a href="./publisherAdd.php" class="btn btn-primary">Add Publisher</a>
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
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list == false){ ?>

                <tr class="text-center">
                    <td colspan="5">No Publisher Found</td>
                </tr>

                <?php }else { 
                    $sr = 1;
                    while($publisher = mysqli_fetch_assoc($list)) { ?>
                <tr>
                    <td><?= $sr++; ?></td>
                    <td><?= $publisher['name'] ?></td>
                    <td>
                        <div class="container">
                            <button onclick="window.location.href='./publisherUpdate.php?id=<?= $publisher['id']; ?>'"
                                class="btn btn-primary">Edit</button>

                            <button
                                onclick=" window.location.href='./functions/_Publisher.php?deletePublisher=<?= $publisher['id'];  ?>';"
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

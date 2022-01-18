<?php
$title = 'Series List';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_Series.php');

$list = fetchSeries();

?>

<h1 class="mt-4">Series</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Series</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Series List</h4>
        <a href="./seriesAdd.php" class="btn btn-primary">Add Series</a>
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
                    <th>Sr</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($list)){ ?>
                <tr class="text-center">
                    <td colspan="4">No Series Found</td>
                </tr>
                <?php  }else{
                $sr = 1;
                while($series = mysqli_fetch_assoc($list)) {
                ?>
                <tr>
                    <td><?php echo $sr++ ?></td>
                    <td><?php echo $series['name'] ?></td>
                    <td><?php if ($series['isComplete'] == 1) {
                         echo "Completed";
                    }else{
                         echo "InComplete";
                    } ?></td>
                    <td>
                        <div class="container">
                            <button onclick="window.location.href='./seriesUpdate.php?id=<?= $series['id']; ?>'"
                                class="btn btn-primary">Edit</button>

                            <button
                                onclick="confirm('Are You Sure'); window.location.href='./functions/_Series.php?deleteSeries=<?= $series['id'];  ?>';"
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

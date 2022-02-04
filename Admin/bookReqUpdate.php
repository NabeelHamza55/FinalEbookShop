<?php
$title = 'Update Request';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_bookReq.php');
$data = requestDetail();
$request = mysqli_fetch_assoc($data);
updateRequest();
?>

<h1 class="mt-4">Requests</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Requests</li>
    <li class="breadcrumb-item active">Update requests</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Update Request</h4>
        <a href="./requestList.php" class="btn btn-primary">Request List</a>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="text-center bg-danger rounded">
                <?php if(isset($msg['error'])) { ?>
                <p class="lead mt-1 text-light">
                    <?php echo $msg['error'] ?>
                </p>
                <?php }
                ?>
            </div>
            <section class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <?php 
                            $userId =  $request['userId'];
                                $userQuery = "SELECT * FROM users WHERE id = $userId";
                                $resultUser = mysqli_query($db, $userQuery);
                                $user = mysqli_fetch_assoc($resultUser);
                            ?>
                            <label for="user">User:</label>
                            <input type="hidden" name="userId" class="form-control" value="<?= $user['id']?>">
                            <input type="text" value="<?= $user['firstName']; ?>" class="form-control" id="user"
                                disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="book">Book:</label>
                            <?php 
                            $bookId =  $request['bookId'];
                                $bookQuery = "SELECT * FROM books WHERE id = $bookId";
                                $resultUser = mysqli_query($db, $bookQuery);
                                $book = mysqli_fetch_assoc($resultUser);
                            ?>
                            <input type="hidden" name="bookId" class="form-control" value="<?= $book['id']?>">
                            <input type="text" value="<?= $book['title'] ?>" class="form-control" id="book" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">Req Status:</label>
                            <select name="status" class="form-control" id="status">
                                <option <?= $request['status'] == 'Pending' ? 'selected' : '' ?> value="Pending">Pending
                                </option>
                                <option <?= $request['status'] == 'Accepted' ? 'selected' : '' ?> value="Accepted">
                                    Accepted</option>
                                <option <?= $request['status'] == 'Rejected' ? 'selected' : '' ?> class="bg-danger"
                                    value="Rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="expiryDate">Set Expiry Date:</label>
                            <input type="date" class="form-control" name="expiryDate" id="expiryDate">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="notes">Req Note:</label>
                            <textarea name="" disabled class="form-control" id="notes"
                                rows="3"><?= $request['notes'] ?></textarea>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="submit">Update Request</button>
        </div>
    </form>
</div>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
  ?>

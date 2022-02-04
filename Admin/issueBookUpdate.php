<?php
$title = 'Update Issue';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_IssueBooks.php');
$data = issueDetail();
$issue = mysqli_fetch_assoc($data);
updateIssue();
?>

<h1 class="mt-4">Issues</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Issues</li>
    <li class="breadcrumb-item active">Update issues</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Update Issue</h4>
        <a href="./issueList.php" class="btn btn-primary">Issue List</a>
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
                            $userId =  $issue['userId'];
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
                            $bookId =  $issue['bookId'];
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
                            <label for="returnDate">Set Return Date:</label>
                            <input type="date" class="form-control" name="returnDate" id="returnDate">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="penalty">Set Panelty:</label>
                            <input type="number" class="form-control" name="penalty" id="penalty">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="isLost">Is Book Lost?</label>
                            <select name="isLost" class="form-control" id="isLost">
                                <option <?= $issue['isLost'] == '1' ? 'selected' : '' ?> value="1">Yes
                                </option>
                                <option <?= $issue['isLost'] == '0' ? 'selected' : '' ?> class="bg-danger" value="0">No
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="submit">Update Issue</button>
        </div>
    </form>
</div>
<br>
<?php
include('./components/footer.php');
include('./components/HTML_End.php');
  ?>

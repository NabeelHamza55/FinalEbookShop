<?php
$title = 'Issues List';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_IssueBooks.php');
$list = fetchIssues();
?>

<h1 class="mt-4">Issues</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Issues</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Issue List</h4>
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
                    <th>Sr.No</th>
                    <th>User</th>
                    <th>Book</th>
                    <th>Issue Date</th>
                    <th>Expiry Date</th>
                    <th>Return Date</th>
                    <th>Panelty</th>
                    <th>Book is Lost?</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list == false){ ?>
                <tr class="text-center">
                    <td colspan="14">No Issue Book Found</td>
                </tr>
                <?php }else {
                    $sr = 1;
                    while ($issue = mysqli_fetch_assoc($list)) { ?>
                <tr>
                    <td><?= $sr++ ?></td>
                    <td>
                        <?php 
                            $userId = $issue['userId'];
                            $query = "SELECT * FROM users WHERE id = $userId";
                            $result = mysqli_query($db, $query);
                            if (!empty($result)) {
                                $row = mysqli_num_rows($result);
                                if ($row > 0) {
                                    $user = mysqli_fetch_assoc($result); 
                                    echo $user['firstName'];
                                } 
                            }else {
                                echo 'NA';
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                        $bookId = $issue['bookId'];
                        $query = "SELECT * FROM books WHERE id = $bookId";
                        $result = mysqli_query($db, $query);
                        if (!empty($result)) {
                            $row = mysqli_num_rows($result);
                            if ($row > 0) {
                                $book = mysqli_fetch_assoc($result); 
                                echo $book['title'];
                            } 
                        }else {
                            echo 'NA';
                        }
                        ?>
                    </td>
                    <td><?= $issue['issueDate'] ?></td>
                    <td><?= $issue['expiryDate'] ?></td>
                    <td><?php if($issue['returnDate'] == NULL){
                        echo "NA";
                    }else{
                        echo $issue['returnDate'];
                    } ?></td>
                    <td><?php if ($issue['penalty'] == 0) {
                        echo 'NA';
                    }else{
                        echo $issue['penalty'];
                    } ?></td>
                    <td><?= $issue['isLost'] == 0 ? 'NO' : 'YES' ?></td>
                    <td>
                        <div class="container d-flex">
                            <button onclick="window.location.href='./issueBookUpdate.php?id=<?= $issue['id']; ?>'"
                                class="btn btn-primary mx-1">Edit</button>

                            <button
                                onclick="window.location.href='./functions/_IssueBooks.php?deleteIssue=<?= $issue['id'];  ?>';"
                                class="btn btn-danger mx-1">Delete</button>
                        </div>
                    </td>
                </tr>
                <?php }
                }?>
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

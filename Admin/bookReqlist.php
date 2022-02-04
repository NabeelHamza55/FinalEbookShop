<?php
$title = 'Requests List';
include('./components/HTML_Start.php');
include('./components/header.php');
include('./functions/_BookReq.php');
$list = fetchRequests();
?>

<h1 class="mt-4">Requests</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Requests</li>
</ol>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Request List</h4>
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
                    <th>Status</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list == false){ ?>

                <tr class="text-center">
                    <td colspan="14">No Request Found</td>
                </tr>

                <?php }else {
                    $sr = 1;
                    while ($request = mysqli_fetch_assoc($list)) { ?>
                <tr>
                    <td><?= $sr++ ?></td>
                    <td>
                        <?php 
                            $userId = $request['userId'];
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
                    <td><?php 
                    $bookId = $request['bookId'];
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
                    ?></td>
                    <td><?= $request['status'] ?></td>
                    <td><?= !empty($request['notes']) ? $request['notes'] : 'NA'  ?></td>
                    <td>
                        <div class="container d-flex">
                            <button onclick="window.location.href='./bookReqUpdate.php?id=<?= $request['id']; ?>'"
                                class="btn btn-primary mx-1">Edit</button>

                            <button
                                onclick="window.location.href='./functions/_Requests.php?deleteRequest=<?= $request['id'];  ?>';"
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

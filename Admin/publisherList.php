<?php
$title = 'Publishers List';
include('./components/HTML_Start.php');
include('./components/header.php');
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
        <table class="table table-responsive table-hover" id="datatablesSimple">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>

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

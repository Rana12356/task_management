<?php

use Controller\CRUDController;

include "Controller/CRUDController.php";
include "FrontendHandler/auth.php";
if (!auth()){
    header('location: login.php');
}

if (!isset($_GET['id'])){
    header('location: index.php');
}
$id = $_GET['id'];

$query = "SELECT t.id, t.title, t.description, t.status, t.deadline, t.created_at, t.updated_at, u.id as userId, u.first_name, u.last_name, u.email, u.phone, u.address, u.created_at as user_created_at, u.updated_at as user_updated_at FROM tasks as t LEFT JOIN users as u ON t.user_id = u.id WHERE t.id = $id";

$crud = new CRUDController();
$result = $crud->show($query);

//echo "<pre>";
//print_r($result);
//die('done');

?>
<!doctype html>
<html lang="en">
<?php include "includes/header.php";?>
<body>
<div class="container my-5">
    <div class="row justify-content-center">
        <!--  sidebar start-->
        <?php include "includes/sidebar.php"; ?>
        <!-- sidebar end-->
        <div class="col-md-9">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">Task Details</h4>
                        <a href="index.php"><button class="btn btn-sm btn-success"><i class="fa-solid fa-backward"></i></button></a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-<?php echo $_SESSION['class'] ?>">
                            <p class="mb-0">
                                <?php
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                                ?>
                            </p>
                        </div>
                    <?php } ?>
                    <table class="table table-sm table-bordered table-hover table-stripped">
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <td><?php echo $result->title ?></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td><?php echo $result->description ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><?php echo $result->status == 1 ? 'Active' : 'Inactive' ?></td>
                            </tr>
                            <tr>
                                <th>Deadline</th>
                                <td><?php echo date('d M, Y', strtotime($result->deadline)) ?></td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td><?php echo date('d M, Y - h:i:sA', strtotime($result->created_at)) ?></td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td><?php echo date('d M, Y - h:i:sA', strtotime($result->updated_at)) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h5>User Details</h5>
                    <table class="table table-sm table-bordered table-hover table-stripped">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td><?php echo $result->first_name .' '. $result->last_name ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $result->email ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?php echo $result->phone ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td><?php echo $result->address ?></td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td><?php echo date('d M, Y - h:i:sA', strtotime($result->user_created_at)) ?></td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td><?php echo date('d M, Y - h:i:sA', strtotime($result->user_updated_at)) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
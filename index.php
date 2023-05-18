<?php

use Controller\CRUDController;

include "Controller/CRUDController.php";
include "FrontendHandler/auth.php";
if (!auth()){
    header('location: login.php');
}

$query = "SELECT t.id, t.title, t.description, t.status, t.deadline, t.created_at, t.updated_at, u.id as userId, u.first_name, u.last_name FROM tasks as t LEFT JOIN users as u ON t.user_id = u.id";

$crud = new CRUDController();
$results = $crud->index($query);

//echo "<pre>";
//print_r($results);
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
                        <h4 class="mb-0">Task List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-hover table-stripped">
                            <thead>
                                <tr>
                                    <th class="align-middle">SL</th>
                                    <th class="align-middle">Title</th>
                                    <th class="align-middle">Description</th>
                                    <th class="align-middle">Status</th>
                                    <th class="align-middle">Assigned User</th>
                                    <th class="align-middle">Deadline</th>
                                    <th class="align-middle">Created At</th>
                                    <th class="align-middle">Updated At</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sl = 1;
                                foreach ($results as $result) {
                            ?>
                                <tr>
                                    <td class="align-middle"><?php echo $sl++ ?></td>
                                    <td class="align-middle"><?php echo $result->title ?></td>
                                    <td class="align-middle">
                                        <?php echo substr($result->description, 0, 30) ?>...
                                        <a href="">Read More</a>
                                    </td>
                                    <td class="align-middle"><?php echo $result->status == 1 ? 'Active' : 'Inactive' ?></td>
                                    <td class="align-middle">
                                        <?php echo $result->first_name.' '.$result->last_name ?>
                                    </td>
                                    <td class="align-middle">
                                        <?php echo date('d M, Y', strtotime($result->deadline))  ?>
                                    </td>
                                    <td class="align-middle">
                                        <?php echo date('d M, Y h:i:sA', strtotime($result->created_at)) ?>
                                    </td>
                                    <td class="align-middle"><?php echo date('d M, Y h:i:sA', strtotime($result->updated_at)) ?></td>
                                    <td class="align-middle">
                                        <a href=""><button class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button></a>
                                        <a href=""><button class="btn btn-warning btn-sm"><i class="fa-solid fa-edit"></i></button></a>
                                        <a href=""><button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></a>
                                    </td>
                                </tr>
                            <?php } ?>
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
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

if (isset($_POST['delete'])){
    $id = $_POST['id'];

    $delete_query = "DELETE FROM tasks WHERE id = $id";

    $crud->destroy($delete_query);
    $_SESSION['msg'] = "Task Deleted successfully";
    $_SESSION['class'] = 'danger';
    header('location: index.php');
}

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
                        <div class="d-flex justify-content-between">
                            <h4 class="mb-0">Task List</h4>
                            <a href="task_create.php"><button class="btn btn-sm btn-success"><i class="fa-solid fa-plus"></i></button></a>
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
                                        <button style="border: none; background: transparent; color: darkcyan" data-bs-toggle="modal" data-bs-target="#details_<?php echo $result->id ?>">Read More</button>
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
                                        <a href="task_show.php?id=<?php echo $result->id ?>"><button class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button></a>
                                        <a href="task_edit.php?id=<?php echo $result->id ?>"><button class="btn btn-warning btn-sm"><i class="fa-solid fa-edit"></i></button></a>
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?php echo $result->id ?>">
                                            <button onclick="return confirm('Are You Sure?')" type="submit" name="delete" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="details_<?php echo $result->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Task Description</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo $result->description ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
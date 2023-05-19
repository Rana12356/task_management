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

$user_query = "SELECT id, first_name, last_name FROM users";
$task_query = "SELECT * FROM tasks WHERE id = $id";

$crud = new CRUDController();
$users = $crud->index($user_query);
$result = $crud->show($task_query);

if (isset($_POST['task_update'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $deadline = $_POST['deadline'];
    $user_id = $_POST['user_id'];

    $query = "UPDATE tasks SET title = '$title', description = '$description', status = '$status', deadline = '$deadline', user_id = '$user_id' WHERE id = $id";

    $crud->update($query);
    $_SESSION['msg'] = "Task Updated successfully";
    $_SESSION['class'] = 'success';
    header('location: index.php');
}
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
                    <h4 class="mb-0">Edit Task</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <label class="w-100">
                            Title
                            <input type="text" value="<?php echo $result->title ?>" name="title" class="form-control" placeholder="Enter Title">
                        </label>
                        <label class="w-100 mt-2">
                            Description
                            <textarea name="description" class="form-control" placeholder="Enter Description"><?php echo $result->description ?></textarea>
                        </label>
                        <label class="w-100 mt-2">
                            Select Status
                            <select name="status" class="form-select" id="">
                                <option <?php echo $result->status == 1 ? 'selected' : null ?> value="1">Active</option>
                                <option <?php echo $result->status == 0 ? 'selected' : null ?> value="0">Inactive</option>
                            </select>
                        </label>
                        <label class="w-100 mt-2">
                            Select Deadline
                            <input value="<?php echo date('Y-m-d', strtotime($result->deadline)) ?>" type="date" name="deadline" class="form-control" placeholder="Enter Deadline">
                        </label>
                        <label class="w-100 mt-2">
                            Select User
                            <select name="user_id" class="form-select" id="">
                                <?php foreach ($users as $user) { ?>
                                    <option <?php echo $user->id == $result->user_id ? 'selected' : null ?> value="<?php echo $user->id ?>"><?php echo $user->first_name.' '.$user->last_name ?></option>
                                <?php } ?>
                            </select>
                        </label>
                        <button type="submit" class="btn btn-success mt-3" name="task_update">Update Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
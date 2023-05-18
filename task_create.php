<?php

use Controller\CRUDController;

include "Controller/CRUDController.php";
include "FrontendHandler/auth.php";
if (!auth()){
    header('location: login.php');
}

$user_query = "SELECT id, first_name, last_name FROM users";

$crud = new CRUDController();
$users = $crud->index($user_query);

if (isset($_POST['task_create'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $deadline = $_POST['deadline'];
    $user_id = $_POST['user_id'];

    $query = "INSERT INTO tasks (title, description, status, deadline, user_id) VALUES ('$title', '$description', '$status', '$deadline', '$user_id')";

    $crud->store($query);
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
                    <h4 class="mb-0">Task List</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <label class="w-100">
                            Title
                            <input type="text" name="title" class="form-control" placeholder="Enter Title">
                        </label>
                        <label class="w-100 mt-2">
                            Description
                            <textarea name="description" class="form-control" placeholder="Enter Description"></textarea>
                        </label>
                        <label class="w-100 mt-2">
                            Select Status
                            <select name="status" class="form-select" id="">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </label>
                        <label class="w-100 mt-2">
                            Select Deadline
                            <input type="date" name="deadline" class="form-control" placeholder="Enter Deadline">
                        </label>
                        <label class="w-100 mt-2">
                            User ID
                            <select name="user_id" class="form-select" id="">
                                <?php foreach ($users as $user) { ?>
                                <option value="<?php echo $user->id ?>"><?php echo $user->first_name.' '.$user->last_name ?></option>
                                <?php } ?>
                            </select>
                        </label>
                        <button type="submit" class="btn btn-success mt-3" name="task_create">Create New Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
<?php
include "FrontendHandler/auth.php";

if (auth()){
    header('location: index.php');
}
?>
<!doctype html>
<html lang="en">
<?php include "includes/header.php";?>
<body>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">User Registration</h4>
                </div>
                <div class="card-body">
                    <form action="FrontendHandler/registration.php" method="post">
                        <label class="w-100 mt-2">
                            First Name
                            <input type="text" name="first_name" class="form-control form-control-sm" placeholder="Enter Your First Name">
                        </label>
                        <label class="w-100 mt-2">
                            Last Name
                            <input type="text" name="last_name" class="form-control form-control-sm" placeholder="Enter Your Last Name">
                        </label>
                        <label class="w-100 mt-2">
                            Email
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="Enter Your Email Address">
                        </label>
                        <label class="w-100 mt-2">
                            Phone
                            <input type="text" name="phone" class="form-control form-control-sm" placeholder="Enter Your Phone Number">
                        </label>
                        <label class="w-100 mt-2">
                            Address
                            <textarea name="address" class="form-control form-control-sm" placeholder="Enter Your Address"></textarea>
                        </label>
                        <label class="w-100 mt-2">
                            Password
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Enter Your Password">
                                <div style="cursor: pointer;" class="input-group-text" id="password-button">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                            </div>
                        </label>
                        <button type="submit" class="btn btn-sm mt-3 btn-info">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
<script>
    $('#password-button').on('click', function () {
        let element = $('#password')
        if (element.attr('type') == 'password'){
            element.attr('type', 'text')
            $(this).children('i').removeClass('fa-eye').addClass('fa-eye-slash')
        }else {
            element.attr('type', 'password')
            $(this).children('i').removeClass('fa-eye-slash').addClass('fa-eye');
        }
    })
</script>
</body>
</html>

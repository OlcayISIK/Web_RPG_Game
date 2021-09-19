<?php
include("function.php");
session_start();
if(isset($_POST['SaveChanges']))
{
    $userdata=new DB_con();
    $oldPassword = $_POST['oldpassword'];
    $newPassword = $_POST['newpassword'];
    $conPassword = $_POST['conpassword'];
    $message= $userdata->updatePassword($oldPassword,$newPassword,$conPassword);
    echo $message;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/userinfo.css">
</head>
<body>
<div class="container">
<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8 mx-auto">
        <h2 class="h3 mb-4 page-title">Settings</h2>
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Profile</a>
                </li>
            </ul>
            <form method="POST" action="userinformation.php">
                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="..." class="avatar-img rounded-circle" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h4 class="mb-1"><?php echo $_SESSION['name']; ?></h4>
                                <p class="small mb-3"><span class="badge badge-dark">Istanbul, Turkey</span></p>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-7">
                                <p class="text-muted">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit nisl ullamcorper, rutrum metus in, congue lectus. In hac habitasse platea dictumst. Cras urna quam, malesuada vitae risus at,
                                    pretium blandit sapien.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4" />
                <div class="form-group">
                    <label for="inputAddress5">UserName</label>
                    <input type="text" class="form-control" id="inputAddress5" value="<?php echo $_SESSION['name']; ?>" required readonly/>
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" value="<?php echo $_SESSION['email']; ?>" required readonly/>
                </div>
                <hr class="my-4" />
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputPassword4">Old Password</label>
                            <input type="password" name="oldpassword" class="form-control" id="inputPassword5" />
                        </div>
                        <div class="form-group">
                            <label for="inputPassword5">New Password</label>
                            <input type="password" name="newpassword" class="form-control" id="inputPassword5" />
                        </div>
                        <div class="form-group">
                            <label for="inputPassword6">Confirm Password</label>
                            <input type="password" name="conpassword" class="form-control" id="inputPassword6" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2">Password requirements</p>
                        <p class="small text-muted mb-2">To create a new password, you have to meet all of the following requirements:</p>
                        <ul class="small text-muted pl-4 mb-0">
                            <li>Minimum 8 character</li>
                            <li>At least one special character</li>
                            <li>At least one number</li>
                            <li>Can’t be the same as a previous password</li>
                        </ul>
                    </div>
                </div>
                <button type="submit" name="SaveChanges" class="btn btn-primary">Save Change</button>
            </form>
        </div>
    </div>
</div>

</div>
    </body>
    </html>
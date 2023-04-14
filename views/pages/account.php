<?php

require_once 'config/config.php';

$userId = $_SESSION["user"]->id;
$statment = $db->prepare("SELECT * FROM users where id= '$userId' LIMIT 1");

$statment->execute();
$products = $statment->fetch(PDO::FETCH_ASSOC);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/account.css">
</head>

<body>

    <?php require_once "./views/layout/navbar.php"; ?>


    <div class="container mt-5 ">
        <h1 class="mb-5">Account Setting</h1>
        <div class="row mt-5">
            <div class="col-md-3" style="margin-right: 50px;">
                <div class="text-center">
                    <img src="controllers/uploads/<?php echo $products['image'] ?>" class="img-fluid mb-3" alt="Account Image">
                    <form action="controllers/auth-contoller.php" id="image-form" method="post" enctype="multipart/form-data" class="mt-3">
                    <input type="hidden" name="status" value="img">
                    <input type="hidden" name="userId" value="<?php echo $userId ?> ;">
                        <div class="form-group">
                            <input type="file" name="image"  class="form-control-file" id="accountImage">
                        </div>
                        <p class="alert-img mt-3" style="display: none;" role="alert"></p>
                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>

                    </form>

                </div>
            </div>

            <div class="col-md-8">
                <form action="controllers/auth-contoller.php" id="update-form" method="post">
                    <input type="hidden" name="status" value="update">
                    <input type="hidden" name="userId" value="<?php echo $userId ?> ;">
                    <h2>Basic Information</h2>
                    <div class="form-group mt-3">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="name" placeholder="Enter  full name" value="<?php echo $products['name'] ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone">Phone No.</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter  phone number" value="<?php echo $products['phone'] ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo $products['email'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                </form>
                <p class="alert mt-3" style="display: none;" role="alert"></p>



                <form action="controllers/auth-contoller.php" method="post" id="change-password" class="mt-5 mb-5">
                    <h2 class="mb-4">Security</h2>
                    <input type="hidden" name="status" value="change-password">
                    <input type="hidden" name="userId" value="<?php echo $userId ?> ;">


                    <div class="form-group mb-4">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" class="form-control" name="currentPassword" id="currentPassword" placeholder="Current password">
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="New password">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                    <p id="change-passwordMsg" class="alert mt-3" style="display: none;" role="alert"></p>
                </form>

            </div>
        </div>
    </div>
    <script src="assets/js/accountImage.js"></script>
    <script src="assets/js/update.js"></script>
    <script src="assets/js/changePassword.js"></script>

</body>

</html>
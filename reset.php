<?php

require 'config/config.php';
if(!isset($_GET["code"])){
    echo "Can't' find page ";
    exit();
}

$code = $_GET["code"];

$query = "SELECT email FROM `reset-password` WHERE code = :code";
$statement = $db->prepare($query);
$statement->bindValue(':code', $code);
$statement->execute();
$result = $statement->fetch();
$email = $result["email"];

if ($statement->rowCount() == 0) {
    echo "can't find the page";
    exit();
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body>

  <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">

  <form id="reset-password-form" action="controllers/auth-contoller.php"  method="post" class="col-md-6">
  <h1 class="text-center mb-4">Reset Password</h1>
  <input type="hidden" name="status" value="reset">
  <input type="hidden" name="code" value="<?php echo $code?>">
  <input type="hidden" name="email" value="<?php echo $email?>">

  <div class="form-group  mt-3">
    <label>New Password</label>
    <div class="input-group">
      <input type="password" class="form-control " name="new_password" required>
      <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('new_password')">
        Show
      </button>
    </div>
  </div>

  <div class="form-group  mt-3">
    <label>Confirm Password</label>
    <div class="input-group">
      <input type="password" class="form-control  " name="confirm_password"  required>
      <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('confirm_password')">
        Show
      </button>
    </div>
  </div>

  <button type="submit" style="width:100%" class="btn btn-danger mt-4">Reset Password</button>
  <a href="login.php">Login</a>
  <p id="msg" class="alert mt-3" style="display: none;" role="alert"></p>

</form>



  </div>


  <script>
function togglePasswordVisibility(inputName) {
  const input = document.querySelector(`input[name="${inputName}"]`);
  const button = input.nextElementSibling;
  if (input.type === "password") {
    input.type = "text";
    button.innerHTML = 'Hide';
  } else {
    input.type = "password";
    button.innerHTML = 'Show';
  }
}
</script>

<script src="assets/js/resetPassword.js"></script>
</body>

</html>

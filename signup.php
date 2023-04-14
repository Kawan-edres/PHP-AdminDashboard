<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

  <?php require "views/layout/navbar.php" ?>
  <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
  <form id="signup-form" class="col-md-6" method="post" action="controllers/auth-contoller.php">
    <input type="hidden" name="status" value="signup">
    <h1 class="text-center mb-4">Sign Up</h1>
    <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter full name">
    </div>
    <div class="form-group mt-4">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
    </div>
    <div class="form-group mt-4">
        <label for="password">Password</label>
        <div class="input-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('password')">
                Show
            </button>
        </div>
    </div>
   
    <p class="mt-3">already have an account? <a href="login.php">Sign In</a> </p>
    <div class="mt-3 text-primary"></div>
    <button type="submit" name="signup-submit" style="width:100%" class="btn btn-primary mt-4">Sign Up</button>
    <p class="alert mt-3" style="display: none;" role="alert"></p>
</form>




  </div>


  <script>
function togglePasswordVisibility(passwordId) {
    var passwordInput = document.getElementById(passwordId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}
</script>
<script src="assets/js/signup.js"></script>
</body>

</html>
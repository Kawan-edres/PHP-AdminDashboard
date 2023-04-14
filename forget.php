<?php
require "views/layout/header.php";
require 'views/layout/navbar.php';

?>

<body>


<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <form action="controllers/email.php" id="forget-password-form" method="post" class="col-md-6">
    <input type="hidden" name="status" value="forget">
        <h2 class="text-center">Forget Password </h2>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" required>
      </div>
      
      <button style="width:100%" type="submit" class="btn btn-primary mt-4">Search</button>
      <p id="msg" class="alert mt-3" style="display: none;" role="alert"></p>

    </form>
  </div>
  
  <script src="assets/js/forgotPassword.js"></script>
</body>
</html>
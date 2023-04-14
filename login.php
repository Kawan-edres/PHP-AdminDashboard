<?php
require "views/layout/header.php";
require 'views/layout/navbar.php';

?>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form id="login-form" action="controllers/auth-contoller.php" method="post" class="col-md-4">
            <input type="hidden" name="status" value="signin">

            <h1 class="text-center mb-4">Login Form</h1>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
            </div>
            <div class="form-group mt-4">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <input type="checkbox" style="display: none;" id="show-password-toggle">
                            <label for="show-password-toggle" class="m-0">Show</label>
                        </div>
                    </div>
                </div>
            </div>
            <p class="mt-3"><a href="forget.php">Forget Password?</a></p>
            <button type="submit" style="width:100%" class="btn btn-primary btn-block mt-4">Login</button>
            <p class="alert mt-3" style="display: none;" role="alert"></p>
        </form>
        
        
        
    </div>
    <script src="assets/js/login.js"></script>
        <script>
            var showPasswordToggle = document.getElementById('show-password-toggle');
            var passwordInput = document.getElementById('password');

            showPasswordToggle.addEventListener('change', function() {
                passwordInput.type = this.checked ? 'text' : 'password';
            });
        </script>
</body>

</html>
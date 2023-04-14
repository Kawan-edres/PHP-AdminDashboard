<?php

$request_uri = $_SERVER['REQUEST_URI'];


?>

<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <div class="container">
    <a class="navbar-brand text-white" href="#">
      <img src="https://raw.githubusercontent.com/Kawan-edres/My-Website/main/public/favicon-32x32.png" width="30" height="30" alt="Logo">
      A-Kawan-Idrees-Mawlood
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <?php if ($request_uri !== '/A-Kawan-Idrees-Mawlood3/dashboard' && $request_uri !== '/A-Kawan-Idrees-Mawlood3/account') { ?>
          <li class="nav-item">
            <a class="nav-link badge" href="/A-Kawan-Idrees-Mawlood3/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link badge" href="/A-Kawan-Idrees-Mawlood3/signup.php">Sign Up</a>
          </li>
        <?php } ?>

        <?php if ($request_uri !== '/A-Kawan-Idrees-Mawlood3/login.php' && $request_uri !== '/A-Kawan-Idrees-Mawlood3/signup.php' && $request_uri !== '/A-Kawan-Idrees-Mawlood3/forget.php' && $request_uri !== '/A-Kawan-Idrees-Mawlood3/reset.php' ) { ?>

          <li class="nav-item dropdown">
            <a class="nav-link badge dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_SESSION["user"]->name ; ?>
        </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/A-Kawan-Idrees-Mawlood3/account">Account</a></li>
              <li><a class="dropdown-item" href="/A-Kawan-Idrees-Mawlood3/logout.php">Logout</a></li>
            </ul>
          </li>


        <?php } ?>



      </ul>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</nav>
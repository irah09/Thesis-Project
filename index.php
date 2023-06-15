<?php 

include 'action.php';
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row px-3">
      <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex"></div>
       
        <div class="card-body">
          <h4 class="title text-center mt-4">
            Wordlab <span>School Inc.</span> 

          </h4>
          <form action="action.php" method="post" class="form-box px-3">
            <div class="form-input">
              <span><i class="fa fa-user"></i></span>
              <input type="text"  name="username" placeholder="Username"  value="<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username']; ?>" tabindex="10" required>
            </div>
            <div class="form-input">
              <span><i class="fa fa-key"></i></span>
              <input type="password"  name="password" placeholder="Password" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>" required>
            </div>

            <div class="mb-3">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="cb1" name="">
                <label class="custom-control-label" for="cb1">Remember me</label>
              </div>
            </div>
            <p class="text-center" style="color:red;">
            </p>
            <div class="mb-3">
              <button type="submit" name="btnLogin" class="btn btn-block text-uppercase">
                Login
              </button>
            </div>

            <div class="text-right">
              <a href="#" class="forget-link">
                Forget Password?
              </a>
            </div>

         

            
           

            <hr class="my-4">
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
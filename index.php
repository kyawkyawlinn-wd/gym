<?php require_once("./stroage/db.php") ?>
<?php require_once("./stroage/admin_crud.php") ?>
<?php 
$result = get_admin($mysqli);
if(!$result){
    add_admin($mysqli,"super trainer",10,33,'super','super@gmail.com');
}
?>
<?php 
$email = $password = $emailErr = $pwdErr ="";
if(isset($_POST['email'])){
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);
    if($email == ""){
        $emailErr = "Please fill your email";
    } else {
        if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
            $emailErr = "Wrong Email Format!";
        }
    }
    if($password == ""){
        $pwdErr = "Please fill your password";
    }
    if($emailErr == "" && $pwdErr == ""){
        $user = get_admin_email($mysqli , $email );
        
        if(!$user) {
            $emailErr = "User does't exists";
        }else {

            if (password_verify($password, $user['password'])) {
                setcookie("user", json_encode($user), time() + 1000 * 60 * 60 * 24 * 14, "/");
                header("Location:./admin/index.php");
            } else {
                $pwdErr = "Password does not match!";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="./dist_dash/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./dist_dash/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="./dist_dash/assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="./dist_dash/assets/css/style.css">
  <link rel="stylesheet" href="./dist_dash/assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="./dist_dash/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="#" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>

                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="form-check-input" tabindex="3" id="check">
                      <label class="form-check-label show" for="check">Show Password</label>
                    </div>
                  </div>

                  <!-- <div class="form-group">
                    <input type="checkbox" id="check" class="form-check-input">
                    <label class="form-check-label show" for="check">Show Password</label>
                </div> -->

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
               

              </div>
            </div>
           
            <div class="simple-footer">
              Copyright &copy; Kaung 2025
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="./dist_dash/assets/modules/jquery.min.js"></script>
  <script src="./dist_dash/assets/modules/popper.js"></script>
  <script src="./dist_dash/assets/modules/tooltip.js"></script>
  <script src="./dist_dash/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="./dist_dash/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="./dist_dash/assets/modules/moment.min.js"></script>
  <script src="./dist_dash/assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="./dist_dash/assets/js/scripts.js"></script>
  <script src="./dist_dash/assets/js/custom.js"></script>
  <script src="./assets/js/app.js"></script>
</body>
</html>
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GYM</title>
  <link rel="stylesheet" href="././dist_dash/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="././dist_dash/assets/css/style.css">
</head>
<body>
  
  <div class="container">
      <div class="card mx-auto login-card" style="width: 500px;">
          <div class="card-body">
            <h2 class="text-center">Wellness Warriors</h2>
            <form method="post">
                <div class="form-floating form-group mt-4">
                    <input type="text" name="email" class="form-control" id="email" value="<?= $email ?>" placeholder="">
                    <label for="email" class="form-label">Email</label>
                    <div class="text-danger"><?= $emailErr ?></div>
                </div>

                <div class="form-floating form-group mt-4">
                    <input type="password" name="password" class="form-control" id="password" value="<?= $password ?>" placeholder="">
                    <label for="password" class="form-label">Password</label>
                    <div class="text-danger fs-6"><?= $pwdErr ?></div>
                </div>

                <div class="form-group mt-3">
                    <input type="checkbox" id="check" class="form-check-input">
                    <label class="form-check-label show" for="check">Show Password</label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-warning btn-lg mt-3">Login</button>
                </div>
            </form>
          </div>
      </div>
  </div>
  <script src="././dist_dash/assets/js/bootstrap.min.js"></script>
  <script src="././dist_dash/assets//js/jquery.min.js"></script>
  <script src="././dist_dash/assets/js/app.js"></script>
</body>
</html> -->
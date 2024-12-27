<?php require_once("./stroage/db.php") ?>
<?php require_once("./stroage/admin_crud.php") ?>
<?php 
$result = get_admin($mysqli);
if(!$result){
    add_admin($mysqli,"super trainer",10,33,'super','super@gmail.com');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GYM</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
  
  <div class="container">
      <div class="card mx-auto login-card" style="width: 500px;">
          <div class="card-body">
            <h2 class="text-center">Wellness Warriors</h2>
            <form method="post">
                <div class="form-floating form-group mt-4">
                    <input type="text" name="email" class="form-control" id="email" placeholder="">
                    <label for="email" class="form-label">Email</label>
                    <div class="text-danger"><?= $emailErr ?></div>
                </div>

                <div class="form-floating form-group mt-4">
                    <input type="password" name="password" class="form-control" id="password" placeholder="">
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
  <script src="./assets/js/bootstrap.min.js"></script>
  <script src="./assets//js/jquery.min.js"></script>
  <script src="./assets/js/app.js"></script>
</body>
</html>
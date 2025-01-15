<?php require_once("../layout_dash/header.php") ?>
  <div id="app">
    <!-- <div class="main-wrapper main-wrapper-1"> -->
<?php require_once("../layout_dash/navbar.php") ?>
<?php require_once("../layout_dash/sidebar.php") ?>
<?php $name = $nameErr = $max = $maxErr = "";
      $error = "";
?>
<?php 
    if(isset($_POST['name'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $age = $_POST['age'];
      $experience = $_POST['experience'];
      $password = $_POST['password'];

      if($name === "") {
        $nameErr = "Please fill name!";
        $error = "err";
      } else {
        if(!preg_match("/^[a-zA-Z\s]+$/" , $name)) {
          $nameErr = "Wrong Name!";
        }
      } 
    
      if($age === "") {
        $ageErr = "Please fill Age!";
        $error = "err";
      } else {
        if(!preg_match("/^\d+$/", $age)) {
          $ageErr = "Please fill number only!";
        }
      }  
      
      if(!$error) {
        $trainer_password = password_hash($password, PASSWORD_BCRYPT);
        $success = add_admin($mysqli, $name, $experience, $age, $trainer_password, $email, $about);
        var_dump($success);
      }
    }
?>

      <!-- Main Content -->
      <div class="main-content">
          <div class="card">
                  <div class="card-header">
                    <h4>Class Form</h4>
                  </div>
                  <form method="post">
                    <div class="card-body">
                      
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"     value="<?= $name ?>">
                        <div class="text-danger"><?= $nameErr ?></div>
                      </div>
                      <div class="form-group">
                        <label for="max">Max people</label>
                        <input type="text" class="form-control" id="max" name="max" placeholder="Max people" value="<?= $max ?>">
                        <div class="text-danger"><?= $maxErr ?></div>
                      </div>                   
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
          </div>
      </div>

<?php require_once("../layout_dash/footer.php") ?>
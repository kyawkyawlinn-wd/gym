<?php require_once("../layout_dash/header.php") ?>
  <div id="app">
    <!-- <div class="main-wrapper main-wrapper-1"> -->
<?php require_once("../layout_dash/navbar.php") ?>
<?php require_once("../layout_dash/sidebar.php") ?>
<?php $name = $nameErr = $email = $emailErr = $age = $ageErr = "";
      $password = $passwordErr =  $experience = $experienceErr = "";
      $error = "";
      $successmsg = "";
?>
<?php 
    if(isset($_GET['trainer_id'])) {
      $trainer_id = $_GET['trainer_id'];
      $trainer = get_admin_with_id($mysqli,$trainer_id);
      $name = $trainer['trainer_name'];
      $email = $trainer['email'];
      $age = $trainer['age'];
      $experience = $trainer['exp'];
      $about = $trainer['about'];
      $oldPassword = $trainer['password'];
    }
?>
<?php 
    if(isset($_POST['name'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $age = $_POST['age'];
      $experience = $_POST['experience'];
      $password = $_POST['password'];
      $about = $_POST['about'];
      $trainer_password = password_hash($password, PASSWORD_BCRYPT);

      if($name == "") {
        $nameErr = "Please fill name!";
        $error = "err";
      } else {
        if(!preg_match("/^[a-zA-Z\s]+$/" , $name)) {
          $nameErr = "Wrong Name!";
        $error = "err";
        }
      } 
      
      if($email == "" ) {
        $emailErr = "Please fill email!";
        $error = "err";
      } else {
        if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
          $emailErr = "Wrong Email!";
        $error = "err";

        }
      }

      if($password == "") {
        $passwordErr = "Please fill password!";
        $error = "err";
      } 

      if($experience == "") {
        $experienceErr = "Please fill experience!";
        $error = "err";
      } else {
        if(!preg_match("/^\d+$/", $experience)) {
          $experienceErr = "Please fill number only!";
        $error = "err";
        }
      }

      if($age == "") {
        $ageErr = "Please fill Age!";
        $error = "err";
      } else {
        if(!preg_match("/^\d+$/", $age)) {
          $ageErr = "Please fill number only!";
        $error = "err";
        }
      }  
      
      if($error == "") {
        if(isset($_GET['trainer_id'])) {
          $trainer_id = $_GET['trainer_id'];
          $status = update_admin($mysqli, $trainer_id, $name, $experience, $age, $trainer_password, $email, $about);
          if($status == true) {
          echo "<script>location.replace('./trainer_list.php')</script>";
          } else {
            echo "Something wrong!";
          }
        } else {
        
        $success = add_admin($mysqli, $name, $experience, $age, $trainer_password, $email, $about);
        if($success){
          echo "<script>location.replace('./trainer_list.php')</script>";
        }
      }
      }
    }
?>

      <!-- Main Content -->
      <div class="main-content">
          <div class="card">
                  <div class="card-header">
                    <?php if (isset($_GET['trainer_id'])) { ?>
                      <h4>Update Trainer</h4>
                    <?php } else { ?>
                        <h4>Trainer Form</h4>
                    <?php } ?>
                  </div>
                  <form  method="post">
                    <div class="card-body">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $email ?>">
                          <div class="text-danger"><?= $emailErr ?></div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= $password ?>">
                          <div class="text-danger"><?= $passwordErr ?></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"     value="<?= $name ?>">
                        <div class="text-danger"><?= $nameErr ?></div>
                      </div>
                      <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" class="form-control" id="age" name="age" placeholder="Age" value="<?= $age ?>">
                        <div class="text-danger"><?= $ageErr ?></div>
                      </div>
                      <div class="form-group">
                        <label for="experience">Experience</label>
                        <input type="text" class="form-control" id="experience" name="experience" placeholder="Experience" value="<?= $experience ?>">
                        <div class="text-danger"><?= $experienceErr ?></div>
                      </div> 
                    </div>    
                    <div class="card-footer">
                      <?php if (isset($_GET['trainer_id'])) { ?>
                         <button type="submit" class="btn btn-info">Update</button>
                      <?php } else { ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      <?php } ?>
                    </div>
                  </form>
          </div>
      </div>
      

<?php require_once("../layout_dash/footer.php") ?>
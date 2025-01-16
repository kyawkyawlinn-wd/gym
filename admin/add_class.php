<?php require_once("../layout_dash/header.php") ?>
  <div id="app">
    <!-- <div class="main-wrapper main-wrapper-1"> -->
<?php require_once("../layout_dash/navbar.php") ?>
<?php require_once("../layout_dash/sidebar.php") ?>
<?php $name = $nameErr = $max = $maxErr = "";
      $description = $descriptionErr = "";
      $error = "";
?>
<?php 
    if(isset($_POST['name'])) {
      $name = $_POST['name'];
      $max = $_POST['max'];


      if($name == "") {
        $nameErr = "Please fill name!";
        $error = "err";
      } else {
        if(!preg_match("/^[a-zA-Z\s]+$/" , $name)) {
          $nameErr = "Wrong Name!";
        }
      } 
    
      if($max == "") {
        $maxErr = "Please fill maximum people!";
        $error = "err";
      } else {
        if(!preg_match("/^\d+$/", $max)) {
          $maxErr = "Please fill number only!";
        }
      }  
      
      if($error == "") {
        if(isset($_GET['id'])) {
          $trainer_id = $_GET['id'];
          $status = update_admin($mysqli, $trainer_id, $name, $experience, $age, $trainer_password, $email, $about);
          if($status == true) {
          echo "<script>location.replace('./trainer_list.php')</script>";
          } else {
            echo "Something wrong!";
          }
        } else {      
        $success = add_class($mysqli, $name, $max, $description);
        if($success){
          echo "<script>location.replace('./member_list.php')</script>";
        }
      }
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
                      <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" name="descrtption" placeholder="Description"></textarea>
                    </div>                 
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
          </div>
      </div>

<?php require_once("../layout_dash/footer.php") ?>
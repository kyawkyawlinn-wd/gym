<?php require_once("../layout_dash/header.php") ?>
  <div id="app">
    <!-- <div class="main-wrapper main-wrapper-1"> -->
<?php require_once("../layout_dash/navbar.php") ?>
<?php require_once("../layout_dash/sidebar.php") ?>
<?php $name = $nameErr = $place = $placeErr = "";
      $error = "";
      $successmsg = "";
?>
<?php 
    if(isset($_GET['id'])) {
      $certification_id = $_GET['id'];
      $certification = get_certification_with_id($mysqli,$certification_id);
      $name = $certification['certification_name'];
      $place = $certification['place'];  
    }
?>
<?php 
    if(isset($_POST['name'])) {
      $name = $_POST['name'];
      $place = $_POST['place'];
      

      if($name == "") {
        $nameErr = "Please fill name!";
        $error = "err";
      } else {
        if(!preg_match("/^[a-zA-Z\s]+$/" , $name)) {
          $nameErr = "Wrong Name!";
        $error = "err";
        }
      } 

      if($place == "") {
        $placeErr = "Please fill place!";
        $error = "err";
      } else {
        if(!preg_match("/^[a-zA-Z\s]+$/" , $place)) {
          $placeErr = "Wrong Place!";
        $error = "err";
        }
      } 
 
      
      if($error == "") {
        if(isset($_GET['id'])) {
          $certification_id = $_GET['id'];
          $status = update_certification($mysqli, $certification_id, $name, $place);
          if($status == true) {
          echo "<script>location.replace('./certification_list.php')</script>";
          } else {
            echo "Something wrong!";
          }
        } else {      
        $success = add_certification($mysqli, $name, $place);
        if($success){
          echo "<script>location.replace('./certification_list.php')</script>";
        }
      }
      }
    }
?>

      <!-- Main Content -->
      <div class="main-content">
          <div class="card">
                  <div class="card-header">
                    <?php if (isset($_GET['id'])) { ?>
                      <h4>Update Certification</h4>
                    <?php } else { ?>
                        <h4>Certification Form</h4>
                    <?php } ?>
                  </div>
                  <form  method="post">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"     value="<?= $name ?>">
                        <div class="text-danger"><?= $nameErr ?></div>
                      </div>

                      <div class="form-group">
                        <label for="place">Place</label>
                        <input type="text" class="form-control" id="place" name="place" placeholder="Place"   value="<?= $place ?>">
                        <div class="text-danger"><?= $placeErr ?></div>
                      </div>
                      
                     
                    </div>    
                    <div class="card-footer">
                      <?php if (isset($_GET['id'])) { ?>
                         <button type="submit" class="btn btn-info">Update</button>
                      <?php } else { ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      <?php } ?>
                    </div>
                  </form>
          </div>
      </div>
      

<?php require_once("../layout_dash/footer.php") ?>
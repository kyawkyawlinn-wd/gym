<?php require_once("../layout_dash/header.php") ?>
  <div id="app">
    <!-- <div class="main-wrapper main-wrapper-1"> -->
<?php require_once("../layout_dash/navbar.php") ?>
<?php require_once("../layout_dash/sidebar.php") ?>
<?php $name = $nameErr = $email = $emailErr = $age = $ageErr = "";
      $phone = $phoneErr = "";
      $error = "";
?>
<?php 
  if(isset($_GET['id'])) {
    $member_id = $_GET['id'];
    $member = get_member_with_id($mysqli, $member_id);
    $name = $member['name'];
    $email = $member['email'];
    $age = $member['age'];
    $phone = $member['phone'];
  }
?>
<?php 
    if(isset($_POST['name'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $age = $_POST['age'];
      $phone = $_POST['phone'];
    

      if($name == "") {
        $nameErr = "Please fill name!";
        $error = "err";
      } else {
        if(!preg_match("/^[a-zA-Z\s]+$/" , $name)) {
          $nameErr = "Wrong Name!";
        }
      } 

      if($email == "" ) {
        $emailErr = "Please fill email!";
        $error = "err";
      } else {
        if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
          $emailErr = "Wrong Email!";
        }
      }

      if($phone == "") {
        $phoneErr = "Please fill phone!";
        $error = "err";
      } else {
        if(!preg_match("/^\d+$/", $phone)) {
          $phoneErr = "Please fill number only!";
        }
      }

      if($age == "") {
        $ageErr = "Please fill Age!";
        $error = "err";
      } else {
        if(!preg_match("/^\d+$/", $age)) {
          $ageErr = "Please fill number only!";
        }
      }  

      if($error == "") {
        if(isset($_GET['id'])) {
          $member_id = $_GET['id'];
          $status = update_member($mysqli, $member_id, $member_name, $age, $email, $phone);    
          if($status == true) {
          echo "<script>location.replace('./member_list.php')</script>";
          } else {
            echo "Something wrong!";
          }
        } else {      
        $success = add_member($mysqli, $name, $age, $email,  $phone);
        if($success == true){
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
                  <?php if (isset($_GET['id'])) { ?>
                      <h4>Update Member</h4>
                    <?php } else { ?>
                        <h4>Member Form</h4>
                    <?php } ?>
                  </div>
                  <form method="post">
                    <div class="card-body">                    
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $name ?>">
                        <div class="text-danger"><?= $nameErr ?></div>
                      </div>
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $email ?>">
                          <div class="text-danger"><?= $emailErr ?></div>
                      </div>
                      <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" class="form-control" id="age" name="age" placeholder="Age" value="<?= $age ?>">
                        <div class="text-danger"><?= $ageErr ?></div>
                      </div>
                      <div class="form-group">
                        <label for="experience">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?= $phone ?>">
                        <div class="text-danger"><?= $phoneErr ?></div>
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
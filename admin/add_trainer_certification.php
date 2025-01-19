<?php require_once("../layout_dash/header.php") ?>
<div id="app">
  <!-- <div class="main-wrapper main-wrapper-1"> -->
  <?php require_once("../layout_dash/navbar.php") ?>
  <?php require_once("../layout_dash/sidebar.php") ?>
  <?php 
  $error = "";
  $successmsg = "";
  ?>
  <?php
  if (isset($_GET['id'])) {
    $certification_id = $_GET['id'];
    $certification = get_certification_with_id($mysqli, $certification_id);
    $name = $certification['certification_name'];
  }
  ?>
  <?php
  if (isset($_POST['trainer_id'])) {
    $trainer_id = $_POST['trainer_id'];

    if(count($_POST)>1){
      foreach ($_POST as $key => $value) {
        if($key != 'trainer_id'){
          add_trainer_certification($mysqli,$value,$trainer_id);
        }
      }
    }else{
      $error = "Select at lease one certification!";
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
          <h4>Trainer Certification</h4>
        <?php } ?>
      </div>
      <form method="post">
        <div class="card-body">
          <div class="form-group">
            <label>Trainers</label>
            <select class="form-control" name="trainer_id">
              <?php $trainers = get_admin($mysqli);
              while ($trainer = $trainers->fetch_assoc()) {
              ?>
                <option value="<?= $trainer['id']?>"><?= $trainer['trainer_name'] ?></option>
              <?php } ?>
            </select>
          </div>

          <label>Certifications</label>
          <div class="d-flex">

            <?php $certifications = get_certification($mysqli);
            while ($certification = $certifications->fetch_assoc()) {
            ?>
              <div class="custom-control custom-radio">
                <input type="radio" name="certification<?= $certification['id'] ?>"  value="<?= $certification['id'] ?>" class="custom-control-input" id="customCheck<?= $certification['id'] ?>">
                <label class="custom-control-label mr-2" for="customCheck<?= $certification['id'] ?>"><?= $certification['certification_name'] ?></label>
              </div>
            <?php } ?>
            <div class="text-danger"><?= $error ?></div>
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
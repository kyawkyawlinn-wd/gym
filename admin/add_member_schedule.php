<?php require_once("../layout_dash/header.php") ?>
<div id="app">
  <!-- <div class="main-wrapper main-wrapper-1"> -->
  <?php  require_once("../layout_dash/navbar.php") ?>
  <?php  require_once("../layout_dash/sidebar.php") ?>
  <?php 
        $end = $endErr = "";
        $error = $errmsg = "";
        $successmsg = "";
  ?>

  <?php
  if (isset($_GET['trainer_id'])) {
    $trainer_id = $_GET['trainer_id'];
    $trainer = get_training_schedule_with_id($mysqli, $trainer_id);
    $name = $trainer['trainer_id'];
    $class = $trainer['class_id'];
    $fees = $trainer['fees'];
    $start = $trainer['start'];
    $end = $trainer['end'];  
  }
  ?>
  <?php
  if (isset($_POST['trainer_id'])) {

    $trainer = $_POST['trainer_id'];
    $member = $_POST['member_id'];
  
    if ($error == "") {
      if (isset($_GET['trainer_id'])) {
        $trainer_id = $_GET['trainer_id'];
        $status = update_training_schedule($mysqli, $trainer_id, $start, $end, $trainer, $class, $fees);
        if ($status == true) {
          echo "<script>location.replace('./member_schedule_list.php')</script>";
        } else {
          echo "Something wrong!";
        }
      } else {
        $success = add_member_schedule($mysqli, $trainer, $member);
        if ($success) {
          echo "<script>location.replace('./member_schedule_list.php')</script>";
        } else {
          echo "Failed to add training schedule.";
        }
      }
    } else {
      echo "Invalid form submission.";
    }
  }
  ?>
  <!-- Main Content -->
  <div class="main-content">
    <div class="card">
      <div class="card-header">
        <?php if (isset($_GET['trainer_id'])) { ?>
          <h4>Update schedule class</h4>
        <?php } else { ?>
          <h4>Member schedule Form</h4>
        <?php } ?>
      </div>
      <form method="post">
        <div class="card-body">
          <div class="form-group">
            <label>Trainer & Classes</label>
            <select class="form-control" name="trainer_id">
              <?php $schedules = get_training_schedule($mysqli);
              while ($schedule = $schedules->fetch_assoc()) {
                if(isset($class) && $class == $schedule['id']) {
                  $select = "selected";
                } else {
                  $select = "";
                }
              ?>
                <option value="<?= $schedule['id'] ?>" <?= $select ?> ><?= $schedule['trainer_name'] ?>:<?= $schedule['class_name'] ?>(<?= date("g:i A", strtotime($schedule['start'])) ?>-<?= date("g:i A", strtotime($schedule['end'])) ?>)</option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Members</label>
            <select class="form-control" name="member_id">
              <?php $members = get_member($mysqli);
              while ($member = $members->fetch_assoc()) {

                if(isset($name) && $name == $member['id']){
                  $select = "selected";
                } else {
                  $select = "";
                }
              ?>
                <option value="<?= $member['id'] ?>" <?= $select ?> ><?= $member['name'] ?></option>
              <?php } ?>
            </select>
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
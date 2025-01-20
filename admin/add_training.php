<?php require_once("../layout_dash/header.php") ?>
<div id="app">
  <!-- <div class="main-wrapper main-wrapper-1"> -->
  <?php  require_once("../layout_dash/navbar.php") ?>
  <?php  require_once("../layout_dash/sidebar.php") ?>
  <?php $fees = $feesErr = $start = $startErr = "";
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
    $fees = trim($trainer['fees']);
    $start = $trainer['start'];
    $end = $trainer['end'];  
  }
  ?>
  <?php
  if (isset($_POST['trainer_id'])) {

    $trainer = $_POST['trainer_id'];
    $class = $_POST['class_id'];
    $fees = trim($_POST['fees']);
    $start = $_POST['start'];
    $end = $_POST['end'];
  
    if ($fees == "") {
      $feesErr = "Please fill Fees!";
      $error = "err";
    } else {
      if (!preg_match("/^\d+$/", $fees)) {
        $feesErr = "Please fill number only!";
        $error = "err";
      }
    }

    if ($start == "") {
      $startErr = "Please select time!";
      $error = "err";
    }
    if ($end == "") {
      $endErr = "Please select time!";
      $error = "err";
    }

    if($start >= $end ) {
       $error = "err";
       $errmsg = "Can't not add wrong time!";
    }
    
    if ($error == "") {
      if (isset($_GET['trainer_id'])) {
        $trainer_id = $_GET['trainer_id'];
        $status = update_training_schedule($mysqli, $trainer_id, $start, $end, $trainer, $class, $fees);
        if ($status == true) {
          echo "<script>location.replace('./training_schedule_list.php')</script>";
        } else {
          echo "Something wrong!";
        }
      } else {
        $success = add_training_schedule($mysqli, $start, $end, $trainer, $class, $fees);
        if ($success) {
          echo "<script>location.replace('./training_schedule_list.php')</script>";
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
          <h4>Update trainig class</h4>
        <?php } else { ?>
          <h4>Training Class Form</h4>
        <?php } ?>
      </div>
      <form method="post">
        <div class="card-body">
          <div class="form-group">
            <label>Trainers</label>
            <select class="form-control" name="trainer_id">
              <?php $trainers = get_admin($mysqli);
              while ($trainer = $trainers->fetch_assoc()) {

                if(isset($name) && $name == $trainer['id']){
                  $select = "selected";
                } else {
                  $select = "";
                }
              ?>
                <option value="<?= $trainer['id'] ?>" <?= $select ?> ><?= $trainer['trainer_name'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label>Classes</label>
            <select class="form-control" name="class_id">
              <?php $schedules = get_training_class($mysqli);
              while ($schedule = $schedules->fetch_assoc()) {
                if(isset($class) && $class == $schedule['id']) {
                  $select = "selected";
                } else {
                  $select = "";
                }
              ?>
                <option value="<?= $schedule['id'] ?>" <?= $select ?> ><?= $schedule['class_name'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="fees">Fees</label>
            <input type="text" class="form-control" id="fees" name="fees" placeholder="fees" value="<?= $fees ?>">
            <div class="text-danger"><?= $feesErr ?></div>
          </div>

          <div class="form-group">
            <label>Start time</label>
            <input type="time" class="form-control" id="start" name="start" value="<?= $start ?>">
            <div class="text-danger"><?= $startErr ?></div>
            <div class="text-danger"><?= $errmsg ?></div>
          </div>

          <div class="form-group">
            <label>End time</label>
            <input type="time" class="form-control" id="end" name="end" value="<?= $end ?>">
            <div class="text-danger"><?= $endErr ?></div>
            <div class="text-danger"><?= $errmsg ?></div>
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
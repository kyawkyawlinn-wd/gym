<?php require_once("../layout_dash/header.php") ?>

<div id="app">
  <!-- <div class="main-wrapper main-wrapper-1"> -->
  <?php require_once("../layout_dash/navbar.php") ?>
  <?php require_once("../layout_dash/sidebar.php") ?>
  <?php 
      if (isset($_GET['deleteId'])) {
        $deleteId = $_GET['deleteId'];
        $status = delete_training_schedule( $mysqli, $deleteId);
        if($status == true) {
            $message = "Schedule successfully deleted.";
        } else {
            $message = $status;
        }
    }
  ?>
  <!-- Main Content -->
  <div class="main-content">
    
    <!-- fist -->
     <div class="card">
      <div class="card-header">`
        <h4>Training Schedule Form</h4>
      </div>
      <div class="card-body">
        <?php if (isset($message)) { ?>
                  <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                          </button>
                            <?= $message ?>
                        </div>
                      </div>
              <?php } ?>
        <div class="list-group">
        <?php $trainers = get_training_schedule($mysqli);
        while($trainer = $trainers->fetch_assoc()) {
        ?>
          <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <label for="">Trainer</label>
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1"><?= $trainer['trainer_name'] ?></h5>
            </div>
            
            <label for="">Class</label>
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1"><?= $trainer['class_name'] ?></h5>
            </div>
            <p class="mb-1"><?= date("g:i A", strtotime($trainer['start'])) ?></p>
            <p class="mb-1"><?= date("g:i A", strtotime($trainer['end'])) ?></p>

            <small><?= $trainer['fees']?> MMK</small>
            <p class="buttons d-flex justify-content-end">
              <a href="add_training.php?trainer_id=<?= $trainer['id'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
              <a href="?deleteId=<?= $trainer['id'] ?>" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
            </p>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <?php require_once("../layout_dash/footer.php") ?>
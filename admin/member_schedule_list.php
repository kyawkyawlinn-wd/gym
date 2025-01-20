<?php require_once("../layout_dash/header.php") ?>

<div id="app">
  <!-- <div class="main-wrapper main-wrapper-1"> -->
  <?php require_once("../layout_dash/navbar.php") ?>
  <?php require_once("../layout_dash/sidebar.php") ?>
  <!-- Main Content -->
  <div class="main-content">
  <?php 
      if (isset($_GET['deleteId'])) {
        $deleteId = $_GET['deleteId'];
        $status = delete_member_schedule( $mysqli, $deleteId);
        if($status == true) {
            $message = "Member schedule successfully deleted";
        } else {
            $message = $status;
        }
    }
  ?>
    <!-- fist -->
     <div class="card">
      <div class="card-header">`
        <h4>Member Schedule List</h4>
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
        <?php $members = get_member_schedule_trainer($mysqli);
         while($member = $members->fetch_assoc()){
        ?>
          <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1"><?= $member['name'] ?></h5>
            </div>
            <label for=""></label>
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Trainer name - <?= $member['trainer_name'] ?></h5>
            </div>
            <label for="class_name"></label>
            <div class="mb-1" style="font-size: 20px">Class name - <?= $member['class_name']?></div>
            <small>
              <?= date("g:i A", strtotime($member['start_time'])) ?> to 
              <?= date("g:i A", strtotime($member['end_time'])) ?>

            </small>
            <p class="buttons d-flex justify-content-end">
              <!-- <a href="add_member_schedule.php?id=<?= $member['id'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a> -->
              <a href="?deleteId=<?= $member['id'] ?>" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
            </p>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <?php require_once("../layout_dash/footer.php") ?>
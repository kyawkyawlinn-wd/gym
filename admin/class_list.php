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
        $status = delete_class( $mysqli, $deleteId);
        if($status == true) {
            $message = "Training class successfully deleted";
        } else {
            $message = $status;
        }
    }
  ?>
    
    <!-- fist -->
     <div class="card">
      <div class="card-header">`
        <h4>Class</h4>
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
        <?php $training_classes = get_training_class($mysqli);
         while($training_class = $training_classes->fetch_assoc()){
        ?>
          <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-2"><?= $training_class['class_name'] ?></h5>
            </div>
            <div class="mb-1" style="font-size: 17px; margin-left: 8px;"><?= $training_class['description']?></div>
            
            <div class="mb-1" style="font-size: 15px">Maximum people - <?= $training_class['max_people']?></div>

            <p class="buttons d-flex justify-content-end">
              <a href="add_class.php?id=<?= $training_class['id'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
              <a href="?deleteId=<?= $training_class['id']?>" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
            </p>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <?php require_once("../layout_dash/footer.php") ?>
<?php require_once("../layout_dash/header.php") ?>

<div id="app">
  <!-- <div class="main-wrapper main-wrapper-1"> -->
  <?php require_once("../layout_dash/navbar.php") ?>
  <?php require_once("../layout_dash/sidebar.php") ?>
  <!-- Main Content -->
  <div class="main-content">
    
    <!-- fist -->
     <div class="card">
      <div class="card-header">
        <h4>Trainer List</h4>
      </div>
      <div class="card-body">
        <div class="list-group">
        <?php $trainers = get_admin($mysqli);
        while($trainer = $trainers->fetch_assoc()){
        ?>
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1"><?= $trainer['trainer_name'] ?></h5>
              <small><?= $trainer['exp']?> years</small>
            </div>
            <p class="mb-1"><?= $trainer['about']?></p>
            <small><?= $trainer['age']?> years old.</small> 
            <small> </small>
            <div class="buttons d-flex justify-content-end">
              <a href="add_trainer.php?trainer_id=<?= $trainer['id'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
              <a href="#" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
            </div>
          </a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <?php require_once("../layout_dash/footer.php") ?>
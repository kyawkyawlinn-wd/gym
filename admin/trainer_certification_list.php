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
        <h4>Trainer Certification List</h4>
      </div>
      <div class="card-body">
        <div class="list-group">
        <?php $certifications = get_trainer_certification_with_trainer_id($mysqli);
         while($certification = $certifications->fetch_assoc()) {
        ?>
          <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">

              <h5 class="mb-1"><?= $certification['trainer_name'] ?></h5>
            </div>
            <small class="m-2">Certifications</small>
            <p class="mb-1 m-2"><?= $certification['certification_name'] ?></p>

            <p class="buttons d-flex justify-content-end">
              <a href="add_certification.php?id=<?= $certification['id'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
              <a href="#" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
            </p>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <?php require_once("../layout_dash/footer.php") ?>
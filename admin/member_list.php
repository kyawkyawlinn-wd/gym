<?php require_once("../layout_dash/header.php") ?>

<div id="app">
  <!-- <div class="main-wrapper main-wrapper-1"> -->
  <?php require_once("../layout_dash/navbar.php") ?>
  <?php require_once("../layout_dash/sidebar.php") ?>
  <!-- Main Content -->
  <div class="main-content">
    
    <!-- fist -->
     <div class="card">
      <div class="card-header">`
        <h4>Trainer List</h4>
      </div>
      <div class="card-body">
        <div class="list-group">
        <?php $members = get_member($mysqli);
        while($member = $members->fetch_assoc()){

        ?>
          <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1"><?= $member['name'] ?></h5>
              <small><?= $member['age']?> years.</small>
            </div>
            <div class="mb-1" style="font-size: 20px"><?= $member['email']?></div>
            <div><?= $member['phone']?></div> 
            <p class="buttons d-flex justify-content-end">
              <a href="add_member.php?id=<?= $member['id'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
              <a href="#" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
            </p>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <?php require_once("../layout_dash/footer.php") ?>
<?php require_once("./layout/header.php")?>

<?php $name = $nameErr = $email = $emailErr = $age = $ageErr = "";
      $phone = $phoneErr = "";
      $error = "";
?>
<?php 
    if(isset($_POST['name'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $age = $_POST['age'];
      $phone = $_POST['phone'];
      $trainer = $_POST['trainer_id'];
      
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
        $sql = "SELECT * FROM `members` WHERE `email`='$eamil'";
        $search = $mysqli->query($sql);
        if(count($search->fetch_all()) == 0 ){
          $success = add_member($mysqli, $name, $age, $email,  $phone);
          if($success){
            $sql = "SELECT `id` FROM `members` order by id desc limit 1";
            $result = $mysqli->query($sql);
            $res = $result->fetch_assoc();
  
            add_member_schedule($mysqli, $trainer, $res['id']);
          }
        }else{
          $emailErr = "This email has been used!";
        }
      }
    }
?>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div class="info d-flex align-items-center">
        <div class="container">
          <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-6 text-center">
              <h2>Welcome to <br>Wellness Warriors</h2>
              <p>Push yourself because no one else will. Strength doesn’t come from what you can do—it comes from overcoming limits. Every rep, every drop of sweat, brings you closer to the best version of yourself. Keep going!</p>
              <a href="#get-started" class="btn-get-started">Get Started</a>
            </div>
          </div>
        </div>
      </div>

      <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-item">
          <img src="assets/img/hero-carousel/gymOne.jpg" alt="">
        </div>

        <div class="carousel-item active">
          <img src="assets/img/hero-carousel/gymTwo.jpg" alt="">
        </div>

        <div class="carousel-item">
          <img src="assets/img/hero-carousel/gymThree.jpg" alt="">
        </div>

        <div class="carousel-item">
          <img src="assets/img/hero-carousel/gymFour.jpg" alt="">
        </div>

        <div class="carousel-item">
          <img src="assets/img/hero-carousel/gymFive.jpg" alt="">
        </div>

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>

    </section><!-- /Hero Section -->

    <!-- Get Started Section -->
    <section id="get-started" class="get-started section">

      <div class="container">

        <div class="row justify-content-between gy-4">

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
            <div class="content">
              <h3>Wellness Warriors.</h3>
              <p>Wellness Warriors is a place to build strength, improve fitness, and achieve health goals. It offers equipment, classes, and guidance, fostering discipline and motivation for a healthier, more confident lifestyle through consistent effort and dedication..
              </p>
              <p>where fitness goals come alive. It provides tools, guidance, and motivation, helping individuals build strength, confidence, and a healthier, balanced lifestyle.</p>
            </div>
          </div>

          <div class="col-lg-5" data-aos="zoom-out" data-aos-delay="200">
            <form method="post" action="home.php">
              <h3>Register</h3>
              <p>Push past limits, embrace the grind, and transform challenges into strength. Your effort defines your success.</p>
              <div class="row gy-3">

                <div class="col-12 form-group">
                   <input type="text" class="form-control" id="name" name="name"  placeholder="Name"  value="<?= $name ?>">
                <div class="text-danger"><?= $nameErr ?></div>
                </div>

                <div class="col-12 form-group">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $email ?>">
                <div class="text-danger"><?= $emailErr ?></div>
                </div>

                <div class="col-12 form-group">
                 <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?= $phone ?>">
                <div class="text-danger"><?= $phoneErr ?></div>
                </div>
                
                <div class="col-12 form-group">
                  <input type="text" class="form-control" id="age" name="age" placeholder="Age" value="<?= $age ?>">
                  <div class="text-danger"><?= $ageErr ?></div>
                </div>

                <div class=" col-12form-group">
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

                <!-- <div class="col-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div> -->

                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-warning">Register</button>
                </div>

              </div>
            </form>
          </div><!-- End Quote Form -->

        </div>

      </div>

    </section><!-- /Recent Blog Posts Section -->

  </main>


<?php require_once("./layout/footer.php")?>
 
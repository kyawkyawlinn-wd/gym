<?php require_once("./layout/header.php") ?>
<?php 
    if(isset($_GET['id'])){
        $project_id = $_GET['id'];
        $project = get_admin_with_id($mysqli, $project_id);
        // $type = get_training_schedule_with_id($mysqli, $project_id);
        $type = get_trainer_details_with_id($mysqli, $project_id);
        $certification = $type['certification_names'];
        $class = $type['class_name'];
        $name = $project['trainer_name'];
        $about = $project['about'];
        $exp = $project['exp'];
        $age = $project['age'];
        $email = $project['email'];
    }
?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url(assets/img/title.jpg);">
      <div class="container position-relative">
        <h1>Trainer Details</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Trainer</a></li>
            <li class="current">Trainer Details</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Project Details Section -->
    <section id="project-details" class="project-details section">

      <div class="container" data-aos="fade-up">

        <div class="portfolio-details-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              },
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">

            <div class="swiper-slide">
              <img src="assets/img/projects/remodeling-1.jpg" alt="">
            </div>

            <div class="swiper-slide">
              <img src="assets/img/projects/remodeling-2.jpg" alt="">
            </div>

            <div class="swiper-slide">
              <img src="assets/img/projects/remodeling-3.jpg" alt="">
            </div>

          </div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
          <div class="swiper-pagination"></div>
        </div>

        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-8" data-aos="fade-up">
            <div class="portfolio-description">
              <h2><?= $name ?>'s personal details</h2>
              <p><?= $about ?></p>

              <!-- <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <div>
                  <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                  <h3>Sara Wilsson</h3>
                  <h4>Designer</h4>
                </div>
              </div> -->

              <!-- <p>
                Impedit ipsum quae et aliquid doloribus et voluptatem quasi. Perspiciatis occaecati earum et magnam animi. Quibusdam non qui ea vitae suscipit vitae sunt. Repudiandae incidunt cumque minus deserunt assumenda tempore. Delectus voluptas necessitatibus est.
              </p>

              <p>
                Sunt voluptatum sapiente facilis quo odio aut ipsum repellat debitis. Molestiae et autem libero. Explicabo et quod necessitatibus similique quis dolor eum. Numquam eaque praesentium rem et qui nesciunt.
              </p> -->

            </div>
          </div>

          <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <div class="portfolio-info">
              <h3>Personal information</h3>
              <ul>
                <li><strong>Position</strong><?= $class ?></li>
                <li><strong>Certification</strong><?= $certification ?></li>
                <li><strong>Age</strong> <?= $age ?> years</li>
                <li><strong>Experience</strong> <?= $exp ?> years</li>
                <li><strong>Email</strong> <a href="#"><?= $email ?></a></li>
                <!-- <li><a href="#" class="btn-visit align-self-start">Visit Website</a></li> -->
              </ul>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Project Details Section -->

  </main>

  <?php require_once("./layout/footer.php") ?>
<?php require_once("./layout/header.php") ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url(assets/img/title.jpg);">
      <div class="container position-relative">
        <h1>Services</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Services</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <div class="container">

        <div class="row gy-4">
          <?php $training_classes = get_training_class($mysqli);
             while($training_class = $training_classes->fetch_assoc()){
          ?>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item  position-relative">
              <div class="icon">
                <i class="fa-solid fa-mountain-city"></i>
              </div>
              <h3><?= $training_class['class_name'] ?></h3>
              <p><?= $training_class['description']?></p>
              <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <?php } ?>
          
        </div>

      </div>

    </section><!-- /Services Section -->

    

  </main>

<?php require_once("./layout/footer.php") ?>
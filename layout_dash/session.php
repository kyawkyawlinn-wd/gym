<section class="section">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart">
                  <canvas id="balance-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Members</h4>
                  </div>
                  <div class="card-body">
                    <?php $result =  get_member($mysqli) ?>
                    <?php $members =  count($result->fetch_all())?>
                    <?= $members  ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart">
                  <canvas id="sales-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Trainers</h4>
                  </div>
                  <div class="card-body">
                  <?php $result =  get_admin($mysqli) ?>
                    <?php $admin =  count($result->fetch_all())?>
                    <?= $admin  ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </section>
<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="content-body">
  <div class="container-fluid">
    <!-- Add Project -->
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <h4>Hi, welcome back!</h4>
          <span><?= $_SESSION['nama'] ?></span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Laporan</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $data['title'] ?></a></li>
        </ol>
      </div>
    </div>
    <!-- row -->
    <?php flash() ?>
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title text-uppercase text-black"><?= $data['title'] ?></h4>
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Daftar Cuti Tahunan</h4>
          </div>
          <div class="card-body">
            <form method="post" action="<?= URLROOT ?>/laporan/cutitahunan" target="_blank">
              <div class="form-group row">
                <div class="col-sm-12">
                  <select class="form-control default-select" name="tahun" id="tahun" tabindex="-98" onchange="getPegawai()">
                    <?php
                    $now = date('Y');
                    $next5 = $now + 5;
                    for ($a = 2023; $a <= $next5; $a++) {
                      echo "<option value='" . $a . "'>" . $a . "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="clearfix">
                <button type="submit" class="btn btn-primary float-right">Cetak <span class="btn-icon-right"><i class="fa fa-print"></i></span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Daftar Kenaikan Pangkat</h4>
          </div>
          <div class="card-body">
            <form method="post" action="<?= URLROOT ?>/laporan/daftarpangkat" target="_blank">
              <div class="form-group row">
                <div class="col-sm-12">
                  <select class="form-control default-select" name="tahun" id="tahun" tabindex="-98" onchange="getPegawai()">
                    <?php
                    $now = date('Y');
                    $next5 = $now + 10;
                    for ($a = 2023; $a <= $next5; $a++) {
                      echo "<option value='" . $a . "'>" . $a . "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="clearfix">
                <button type="submit" class="btn btn-primary float-right">Cetak <span class="btn-icon-right"><i class="fa fa-print"></i></span>
                </button>
              </div>
          </div>
          </form>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Jadwal Kenaikan Pangkat</h4>
          </div>
          <div class="card-body">
            <form method="post" action="<?= URLROOT ?>/laporan/jadwalpangkat" target="_blank">
              <div class="form-group row">
                <div class="col-sm-12">
                  <select class="form-control default-select" name="tahun" id="tahun" tabindex="-98">
                    <?php
                    $now = date('Y');
                    $next5 = $now + 5;
                    for ($a = 2023; $a <= $next5; $a++) {
                      echo "<option value='" . $a . "'>" . $a . "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="clearfix">
                <button type="submit" class="btn btn-primary float-right">Cetak <span class="btn-icon-right"><i class="fa fa-print"></i></span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
<?php require APPROOT . '/views/layouts/header.php'; ?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
  <div class="container-fluid">
    <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
      <h2 class="font-w600 title mb-2 mr-auto "><?= $data['title'] ?></h2>
    </div>
    <div class="row">
      <div class="col-xl-3 col-sm-6 m-t35">
        <div class="card card-coin">
          <div class="card-body text-center">
            <span class=""><i class="fa fa-users mb-3 currency-icon text-primary" style="font-size: 5rem;box-shadow:none;"></i></span>
            <h4 class="text-black mb-2 font-w400"><b style="font-size:1.5rem;"><?= count($data['pegawai']) ?></b> <br> Pegawai</h4>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 m-t35">
        <div class="card card-coin">
          <div class="card-body text-center">
            <span class=""><i class="fa fa-bookmark mb-3 currency-icon text-red" style="font-size: 5rem;box-shadow:none;"></i></span>
            <h4 class="text-black mb-2 font-w400"><b style="font-size:1.5rem;"><?= count($data['cuti']) ?></b> <br>Pengajuan Cuti</h4>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 m-t35">
        <div class="card card-coin">
          <div class="card-body text-center">
            <span class=""><i class="fa fa-certificate mb-3 currency-icon text-warning" style="font-size: 5rem;box-shadow:none;"></i></span>
            <h4 class="text-black mb-2 font-w400"><b style="font-size:1.5rem;"><?= count($data['usulpangkat']) ?></b> <br>Usul Pangkat</h4>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 m-t35">
        <div class="card card-coin">
          <div class="card-body text-center">
            <span class=""><i class="fa fa-file-text mb-3 currency-icon text-blue" style="font-size: 5rem;box-shadow:none;"></i></span>
            <h4 class="text-black mb-2 font-w400"><b style="font-size:1.5rem;"><?= count($data['skpangkat']) ?></b> <br>SK Pangkat</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-xxl-12">
        <div class="card">
          <div class="jumbotron jumbotron-fluid" style="background: #ffffff;">
            <div class="container">
              <h1>Sistem Informasi Pelayanan Kepegawaian (SIPEKA)</h1>
              <hr>
              <p class="lead" style="font-size:2rem;">Pengadilan Negeri Martapura</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--**********************************
            Content body end
        ***********************************-->



<?php require APPROOT . '/views/layouts/footer.php'; ?>
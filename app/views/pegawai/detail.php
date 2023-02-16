<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="content-body">
  <div class="container-fluid">
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <h4>Hi, welcome back!</h4>
          <span><?= $_SESSION['nama'] ?></span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= URLROOT ?>/pegawai">Pegawai</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $data['title'] ?></a></li>
        </ol>
      </div>
    </div>
    <!-- row -->

    <div class="row">
      <div class="col-xl-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"><?= $data['title'] ?></h4>
            <a href="<?= URLROOT ?>/pegawai" class="btn btn-danger">Kembali</a>
          </div>
          <div class="card-body col-xl-10 col-lg-12 col-md-12">
            <div class="profile-personal-info row" style="font-size:1.2rem;">
              <div class="col-lg-3 col-md-12 mb-3">
                <div class="row mb-2">
                  <div class="col-sm-9 col-7">
                    <img src="<?= URLROOT ?>/assets/images/pegawai/<?= $data['pegawai']->foto ?>" width="250" style="object-fit:cover;" alt="" srcset="">
                  </div>
                </div>
              </div>
              <div class="col-lg-9 col-md-12">
                <div class="row mb-2">
                  <div class="col-sm-3 col-5">
                    <h5 class="f-w-500">NIP <span class="pull-right">:</span>
                    </h5>
                  </div>
                  <div class="col-sm-9 col-7"><span><?= $data['pegawai']->nip ?></span>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-sm-3 col-5">
                    <h5 class="f-w-500">Nama <span class="pull-right">:</span>
                    </h5>
                  </div>
                  <div class="col-sm-9 col-7"><span><?= $data['pegawai']->nama ?></span>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-sm-3 col-5">
                    <h5 class="f-w-500">Pangkat <span class="pull-right">:</span>
                    </h5>
                  </div>
                  <div class="col-sm-9 col-7"><span><?= $data['pegawai']->pangkat ?></span>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-sm-3 col-5">
                    <h5 class="f-w-500">Jabatan <span class="pull-right">:</span></h5>
                  </div>
                  <div class="col-sm-9 col-7"><span><?= $data['pegawai']->jabatan ?></span>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-sm-3 col-5">
                    <h5 class="f-w-500">Ruangan <span class="pull-right">:</span>
                    </h5>
                  </div>
                  <div class="col-sm-9 col-7"><span><?= $data['pegawai']->ruangan ?></span>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-sm-3 col-5">
                    <h5 class="f-w-500">Masa Kerja <span class="pull-right">:</span></h5>
                  </div>
                  <div class="col-sm-9 col-7"><span><?= $data['pegawai']->masa_kerja ?> Tahun</span>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-sm-3 col-5">
                    <h5 class="f-w-500">Tanggal Pengangkatan <span class="pull-right">:</span></h5>
                  </div>
                  <div class="col-sm-9 col-7"><span><?= dateID($data['pegawai']->tgl_pengangkatan) ?></span>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-sm-3 col-5">
                    <h5 class="f-w-500">TMT Pangkat Terakhir <span class="pull-right">:</span></h5>
                  </div>
                  <div class="col-sm-9 col-7"><span><?= dateID($data['pegawai']->tmt_pkt_terakhir) ?></span>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-sm-3 col-5">
                    <h5 class="f-w-500">TMT Gaji Terakhir <span class="pull-right">:</span></h5>
                  </div>
                  <div class="col-sm-9 col-7"><span><?= dateID($data['pegawai']->tmt_gajiterakhir) ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
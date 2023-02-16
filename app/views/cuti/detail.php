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
            <a href="<?= URLROOT ?>/cuti" class="btn btn-danger">Kembali</a>
          </div>
          <div class="card-body col-xl-10 col-lg-12 col-md-12" style="font-size:1rem;">
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Tanggal Pengajuan<span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= dateiD($data['cuti']->tanggal) ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Kode Cuti<span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['cuti']->kodecuti ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Nama <span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['cuti']->nama ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">NIP <span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['cuti']->nip ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Masa Kerja<span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['cuti']->masakerja ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Jabatan <span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['cuti']->jabatan ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Lama Cuti<span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['cuti']->lamacuti ?> Hari</span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Dari Tanggal <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= dateID($data['cuti']->daritgl) ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Sampai Tanggal <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= dateID($data['cuti']->sampaitgl) ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Alasan Cuti <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['cuti']->alasan ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Alamat Selama Cuti <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['cuti']->alamat ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">No Telp <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['cuti']->no_telp ?></span>
              </div>
            </div>
            <?php
            if ($data['cuti']->status == 'DITERIMA') {
              $badge = 'success';
            } elseif ($data['cuti']->status == 'DITOLAK') {
              $badge = 'danger';
            } else {
              $badge = 'warning';
            }
            ?>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><span class="badge light badge-<?= $badge ?>"><?= $data['cuti']->status ?></span>
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
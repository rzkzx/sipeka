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
          <li class="breadcrumb-item"><a href="<?= URLROOT ?>/skpangkat">SK Kenaikan Pangkat</a></li>
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
            <a href="<?= URLROOT ?>/skpangkat" class="btn btn-danger">Kembali</a>
          </div>
          <div class="card-body col-xl-10 col-lg-12 col-md-12" style="font-size:1rem;">
            <div class=" row mb-2">
              <div class="col-sm-5 col-5">
                <h5 class="f-w-500">No SK <span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-7 col-7"><span><?= $data['skpangkat']->no_sk ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-5 col-5">
                <h5 class="f-w-500">Tanggal SK <span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-7 col-7"><span><?= dateID($data['skpangkat']->tgl_sk) ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-5 col-5">
                <h5 class="f-w-500">NIP <span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-7 col-7"><span><?= $data['skpangkat']->nip ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-5 col-5">
                <h5 class="f-w-500">Pangkat Lama <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-7 col-7"><span><?= $data['skpangkat']->pangkat_lama ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-5 col-5">
                <h5 class="f-w-500">TMT Pangkat Lama <span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-7 col-7"><span><?= dateID($data['skpangkat']->tmt_pangkat_lama) ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-5 col-5">
                <h5 class="f-w-500">Pangkat Baru <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-7 col-7"><span><?= $data['skpangkat']->pangkat_baru ?> Tahun</span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-5 col-5">
                <h5 class="f-w-500">TMT Pangkat Baru <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-7 col-7"><span><?= dateID($data['skpangkat']->tmt_pangkat_baru) ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-5 col-5">
                <h5 class="f-w-500">Periode Kenaikan Pangkat Berikutnya <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-7 col-7"><span><?= dateID($data['skpangkat']->periode_berikutnya) ?></span>
              </div>
            </div>
            <?php
            if ($data['skpangkat']->status == 'Selesai') {
              $badge = 'success';
            } else {
              $badge = 'warning';
            }
            ?>
            <div class="row mb-2">
              <div class="col-sm-5 col-5">
                <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-7 col-7"><span class="badge light badge-<?= $badge ?>"><?= $data['skpangkat']->status ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-5 col-5">
                <h5 class="f-w-500">File Usul PDF <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-7 col-7"><a href="<?= URLROOT ?>/assets/files/sk_pangkat/<?= $data['skpangkat']->file_sk_pdf ?>"><span class="badge badge-pill badge-info"><?= $data['skpangkat']->file_sk_pdf ?></span></a>
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
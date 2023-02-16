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
            <a href="<?= URLROOT ?>/usulpangkat" class="btn btn-danger">Kembali</a>
          </div>
          <div class="card-body col-xl-10 col-lg-12 col-md-12" style="font-size:1rem;">
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">No Surat <span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['usulpangkat']->no_surat ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Tanggal Surat <span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['usulpangkat']->tgl_surat ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">NIP <span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['usulpangkat']->nip ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Pangkat Terakhir <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['usulpangkat']->pangkat_terakhir ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">TMT Pangkat Terakhir <span class="pull-right">:</span>
                </h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['usulpangkat']->tmt_pangkat_terakhir ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Pangkat Usulan <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= $data['usulpangkat']->pangkat_usulan ?> Tahun</span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Periode Usulan <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><span><?= dateID($data['usulpangkat']->periode_usulan) ?></span>
              </div>
            </div>
            <?php
            if ($data['usulpangkat']->status == 'Selesai') {
              $badge = 'success';
            } else {
              $badge = 'warning';
            }
            ?>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><span class="badge light badge-<?= $badge ?>"><?= $data['usulpangkat']->status ?></span>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3 col-5">
                <h5 class="f-w-500">File Usul PDF <span class="pull-right">:</span></h5>
              </div>
              <div class="col-sm-9 col-7"><a href="<?= URLROOT ?>/assets/files/usul_pangkat/<?= $data['usulpangkat']->file_usul_pdf ?>"><span class="badge badge-pill badge-info"><?= $data['usulpangkat']->file_usul_pdf ?></span></a>
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
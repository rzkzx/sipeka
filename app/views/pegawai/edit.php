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
            <div class="basic-form">
              <form method="post" id="form-valide" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['pegawai']->id ?>">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>NIP</label>
                    <input type="text" name="nip" class="form-control" id="nip" value="<?= $data['pegawai']->nip ?>" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['pegawai']->nama ?>" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Pangkat</label>
                    <div class="dropdown bootstrap-select form-control default-select dropup">
                      <select id="inputState" class="form-control default-select" name="pangkat" tabindex="-98">
                        <option><?= $data['pegawai']->pangkat ?></option>
                        <option>Pengatur Muda / (II/a)</option>
                        <option>Pengatur Muda TK I / (II/b)</option>
                        <option>Pengatur / (II/c)</option>
                        <option>Pengatur TK I / (II/d)</option>
                        <option>Penata Muda / (III/a)</option>
                        <option>Penata Muda TK I / (III/b)</option>
                        <option>Penata / (III/c)</option>
                        <option>Penata TK I / (III/d)</option>
                        <option>Pembina / (IV/a)</option>
                        <option>Pembina TK I / (IV/b)</option>
                        <option>Pembina Utama Muda / (IV/c)</option>
                        <option>Pembina Utama Madya / (IV/d)</option>
                        <option>Pembina Utama / (IV/e)</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Ruangan</label>
                    <input type="text" name="ruangan" id="ruangan" class="form-control" value="<?= $data['pegawai']->ruangan ?>" required>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary px-5 mt-3"><i class="fa fa-refresh"></i> Perbarui</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

<script>
</script>
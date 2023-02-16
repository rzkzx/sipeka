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
          <li class="breadcrumb-item"><a href="<?= URLROOT ?>/jatahcuti">Jatah Cuti</a></li>
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
            <a href="<?= URLROOT ?>/jatahcuti" class="btn btn-danger">Kembali</a>
          </div>
          <div class="card-body col-xl-10 col-lg-12 col-md-12">
            <div class="basic-form">
              <form method="post" id="form-valide" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['jatahbuti']->id ?>">
                <div class="">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NIP</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nama" id="nama" value="<?= $data['jatahcuti']->nama ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NIP</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nip" id="nip" value="<?= $data['jatahcuti']->nip ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">SISA TAHUN 1 (2021)</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="sisa1" value="<?= $data['jatahcuti']->sisa1 ?>" id="sisa1">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">SISA TAHUN 2 (2022)</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="sisa2" value="<?= $data['jatahcuti']->sisa2 ?>" id="sisa2">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">JATAH TAHUN 3 (2023)</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="sisa3" value="<?= $data['jatahcuti']->sisa3 ?>" id="sisa3">
                    </div>
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
  function getPegawai() {
    var idPegawai = $('#pegawai').find(':selected').val();
    $.ajax({
      type: 'POST',
      url: '<?= URLROOT ?>/pegawai/getPegawaiAjax',
      data: {
        id: idPegawai
      },
      success: function(data) {
        var json = data,
          obj = JSON.parse(json);
        $('#nama').val(obj.nama);
        $('#nip').val(obj.nip);
        $('#jabatan').val(obj.jabatan);
      }
    });
  }
</script>
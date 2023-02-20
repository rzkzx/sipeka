<?php require APPROOT . '/views/layouts/header.php'; ?>

<?php
$tahun = date('Y');
$tahun2 = date('Y', strtotime('-1 year'));
$tahun3 = date('Y', strtotime('-2 year'));
?>

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
                <div class="">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                      <select class="form-control default-select" name="pegawai" id="pegawai" tabindex="-98" onchange="getPegawai()">
                        <option value="" disabled selected>- Pilih Pegawai -</option>
                        <?php
                        foreach ($data['pegawai'] as $pegawai) {
                          echo '<option value="' . $pegawai->id . '">' . $pegawai->nama . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <input type="hidden" name="nama" value="" id="nama">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jabatan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="jabatan" id="jabatan" value="" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NIP</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nip" id="nip" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">SISA TAHUN 1 (<?= $tahun3 ?>)</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="sisa1" id="sisa1">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">SISA TAHUN 2 (<?= $tahun2 ?>)</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="sisa2" id="sisa2">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">JATAH TAHUN 3 (<?= $tahun ?>)</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="sisa3" id="sisa3">
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary px-5 mt-3"><i class="fa fa-plus-circle"></i> Tambahkan</button>
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
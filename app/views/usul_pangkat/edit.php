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
          <li class="breadcrumb-item"><a href="<?= URLROOT ?>/usulpangkat">Usul Kenaikan Pangkat</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $data['title'] ?></a></li>
        </ol>
      </div>
    </div>
    <!-- row -->

    <?php flash() ?>
    <div class="row">
      <div class="col-xl-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"><?= $data['title'] ?></h4>
            <a href="<?= URLROOT ?>/usulpangkat" class="btn btn-danger">Kembali</a>
          </div>
          <div class="card-body col-xl-10 col-lg-12 col-md-12">
            <div class="basic-form">
              <form method="post" id="form-valide" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Nomor Surat Usulan</label>
                    <input type="text" name="no_surat" class="form-control" id="no_surat" value="<?= $data['usulpangkat']->no_surat ?>" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Tanggal Surat Usulan</label>
                    <input name="tgl_surat" id="tgl_surat" class="datepicker-default form-control" value="<?= dateEN($data['usulpangkat']->tgl_surat) ?>" id="datepicker" required>
                  </div>
                  <input type="hidden" name="nama" value="" id="nama">
                  <div class="form-group col-md-6">
                    <label>NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control" value="<?= $data['usulpangkat']->nip ?>" required readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Pangkat / Golongan</label>
                    <input type="text" name="pangkat_terakhir" id="pangkat_terakhir" value="<?= $data['usulpangkat']->pangkat_terakhir ?>" class="form-control disabled" required readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>TMT Pangkat Terakhir</label>
                    <input type="text" name="tmt_pangkat_terakhir" id="tmt_pangkat_terakhir" value="<?= dateEN($data['usulpangkat']->tmt_pangkat_terakhir) ?>" class="form-control" required readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Usulan Pangkat / Golongan</label>
                    <div class="dropdown bootstrap-select form-control default-select dropup">
                      <select id="inputState" class="form-control default-select" name="pangkat_usulan" tabindex="-98">
                        <option><?= $data['usulpangkat']->pangkat_usulan ?>"</option>
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
                    <label>Periode Usulan</label>
                    <input name="periode_usulan" id="periode_usulan" value="<?= dateEN($data['usulpangkat']->periode_usulan) ?>" class="datepicker-default form-control" id="datepicker" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Status</label>
                    <input name="status" id="status" class="form-control" value="<?= $data['usulpangkat']->status ?>" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>File PDF</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="file_usulpangkat" id="file_usulpangkat" class="custom-file-input">
                        <label class="custom-file-label" style="height:50px;line-height: 2.3;">Pilih file</label>
                      </div>
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
        $('#pangkat_terakhir').val(obj.pangkat);
        $('#tmt_pangkat_terakhir').val(obj.tmt_pkt_terakhir);
      }
    });
  }
</script>
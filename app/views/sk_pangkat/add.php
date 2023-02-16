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
                    <label>Nomor SK</label>
                    <input type="text" name="no_sk" class="form-control" id="tgl_sk" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Tanggal SK</label>
                    <input name="tgl_sk" id="tgl_sk" class="datepicker-default form-control" id="datepicker" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Usulan Pangkat</label>
                    <div class="dropdown bootstrap-select form-control default-select dropup">
                      <select class="form-control default-select" name="usul_pangkat" id="usul_pangkat" tabindex="-98" onchange="getUsulPangkat()">
                        <option value="" disabled selected>- Pilih Pengusulan -</option>
                        <?php
                        foreach ($data['usulpangkat'] as $usulpkt) {
                          echo '<option value="' . $usulpkt->id_usul_pangkat . '">' . $usulpkt->no_surat . ' - ' . $usulpkt->nip . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control" required readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Pangkat / Golongan Lama</label>
                    <input type="text" name="pangkat_lama" id="pangkat_lama" class="form-control" required readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>TMT Pangkat Lama</label>
                    <input type="text" name="tmt_pangkat_lama" id="tmt_pangkat_lama" class="form-control" required readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Pangkat / Golongan Baru</label>
                    <div class="dropdown bootstrap-select form-control default-select dropup">
                      <select id="inputState" class="form-control default-select" name="pangkat_baru" tabindex="-98">
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
                    <label>TMT Pangkat Baru</label>
                    <input name="tmt_pangkat_baru" id="tmt_pangkat_baru" class="datepicker-default form-control" id="datepicker" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Periode Kenaikan Pangkat Berikutnya</label>
                    <input name="periode_berikutnya" id="periode_berikutnya" class="datepicker-default form-control" id="datepicker" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Status</label>
                    <input name="status" id="status" class="form-control" value="Selesai" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>File PDF</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="file_pdf" id="file_usulpangkat" class="custom-file-input" required>
                        <label class="custom-file-label" style="height:50px;line-height: 2.3;">Pilih file</label>
                      </div>
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
  function getUsulPangkat() {
    var idUsulan = $('#usul_pangkat').find(':selected').val();
    $.ajax({
      type: 'POST',
      url: '<?= URLROOT ?>/usulpangkat/getUsulanAjax',
      data: {
        id: idUsulan
      },
      success: function(data) {
        var json = data,
          obj = JSON.parse(json);
        $('#nip').val(obj.nip);
        $('#pangkat_lama').val(obj.pangkat_terakhir);
        $('#tmt_pangkat_lama').val(obj.tmt_pangkat_terakhir);
      }
    });
  }
</script>
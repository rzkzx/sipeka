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
          <li class="breadcrumb-item"><a href="<?= URLROOT ?>/cuti">Cuti</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $data['title'] ?></a></li>
        </ol>
      </div>
    </div>
    <!-- row -->
    <?php
    $tahun3sisa = date('Y');
    $tahun2sisa = $tahun3sisa - 1;
    $tahun1sisa = $tahun3sisa - 2;
    ?>

    <div class="row">
      <div class="col-xl-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"><?= $data['title'] ?></h4>
          </div>
          <div class="card-body col-xl-10 col-lg-12 col-md-12">
            <div class="basic-form">
              <form method="post" id="form-valide" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Tanggal Pengajuan Cuti</label>
                    <input name="tanggal" id="tanggal" class="datepicker-default form-control" id="datepicker" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Nama</label>
                    <select class="form-control default-select" name="pegawai" id="pegawai" tabindex="-98" onchange="getPegawai()" required>
                      <option value="" disabled selected>- Pilih -</option>
                      <?php
                      foreach ($data['pegawai'] as $pegawai) {
                        echo '<option value="' . $pegawai->id . '">' . $pegawai->nama . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <input type="hidden" name="nama" id="nama">
                  <div class="form-group col-md-6">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" class="form-control" readonly required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control" readonly required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Masa Kerja</label>
                    <input type="text" name="masa_kerja" id="masa_kerja" class="form-control" readonly required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Alasan</label>
                    <textarea class="form-control" rows="2" id="comment" name="alasan"></textarea>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Mulai Cuti</label>
                    <input name="mulai_cuti" id="mulai_cuti" class="datepicker-default form-control" id="datepicker" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Sampai Cuti</label>
                    <input name="sampai_cuti" id="sampai_cuti" class="datepicker-default form-control" id="datepicker" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Sisa Tahun 1 (<?= $tahun1sisa ?>)</label>
                    <input type="number" name="sisa1" id="sisa1" value="0" class="form-control" readonly required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Pakai Tahun 1 (<?= $tahun1sisa ?>)</label>
                    <input type="number" name="pakai1" id="pakai1" value="0" onkeyup="lamacuti()" class="form-control" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Sisa Tahun 2 (<?= $tahun2sisa ?>)</label>
                    <input type="number" name="sisa2" id="sisa2" value="0" class="form-control" readonly required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Pakai Tahun 2 (<?= $tahun2sisa ?>)</label>
                    <input type="number" name="pakai2" id="pakai2" value="0" onkeyup="lamacuti()" class="form-control" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Sisa Tahun 3 (<?= $tahun3sisa ?>)</label>
                    <input type="number" name="sisa3" id="sisa3" value="0" class="form-control" readonly required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Pakai Tahun 3 (<?= $tahun3sisa ?>)</label>
                    <input type="number" name="pakai3" id="pakai3" value="0" onkeyup="lamacuti()" class="form-control" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Lama Cuti</label>
                    <input type="number" name="lama_cuti" id="lama_cuti" value="0" class="form-control" readonly required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Alamat Selama Menjalankan Cuti</label>
                    <textarea class="form-control" rows="2" name="alamat" id="comment"></textarea>
                  </div>
                  <div class="form-group col-md-6">
                    <label>No.Telp/HP</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control" required>
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
        $('#masa_kerja').val(obj.masa_kerja);
        getJatahCuti(obj.nip)
      }
    });
  }

  function getJatahCuti(nip) {
    $.ajax({
      type: 'POST',
      url: '<?= URLROOT ?>/jatahcuti/getJatahCutiAjax',
      data: {
        nip: nip
      },
      success: function(data) {
        var json = data,
          obj = JSON.parse(json);
        if (!obj) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Jatah cuti Pegawai ini belum ada',
          })
          $('#sisa1').val(0);
          $('#sisa2').val(0);
          $('#sisa3').val(0);
          $('#nama').val('');
          $('#nip').val('');
          $('#jabatan').val('');
          $('#masa_kerja').val('');
          $('#pegawai').val('').change();
        } else {
          $('#sisa1').val(obj.sisa1);
          $('#sisa2').val(obj.sisa2);
          $('#sisa3').val(obj.sisa3);
        }
      }
    });
  }

  function lamacuti() {
    var pakai1 = parseInt($('#pakai1').val());
    var sisa1 = parseInt($('#sisa1').val());
    if (sisa1 < pakai1) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Jatah cuti tidak mencukupi',
      })
      $('#pakai1').val(0);
      pakai1 = parseInt($('#pakai1').val());
    }


    var pakai2 = parseInt($('#pakai2').val());
    var sisa2 = parseInt($('#sisa2').val());
    if (sisa2 < pakai2) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Jatah cuti tidak mencukupi',
      })
      $('#pakai2').val(0);
      pakai2 = parseInt($('#pakai2').val());
    }

    var pakai3 = parseInt($('#pakai3').val());
    var sisa3 = parseInt($('#sisa3').val());
    if (sisa3 < pakai3) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Jatah cuti tidak mencukupi',
      })
      $('#pakai3').val(0);
      pakai3 = parseInt($('#pakai3').val());
    }


    var lamacuti = pakai1 + pakai2 + pakai3;
    $('#lama_cuti').val(lamacuti);

  }
</script>
<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="content-body">
  <div class="container-fluid">
    <!-- Add Project -->
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <h4>Hi, welcome back!</h4>
          <span><?= $_SESSION['nama'] ?></span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Laporan</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $data['title'] ?></a></li>
        </ol>
      </div>
    </div>
    <!-- row -->
    <?php flash() ?>
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title text-uppercase text-black"><?= $data['title'] ?></h4>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Upload Tanda Tangan Ketua</h4>
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group row">
                <div class="col-sm-12">
                  <div class="form-group col-md-12">
                    <label>Foto Tanda Tangan</label>
                    <input type="hidden" name="bagian" value="ketua">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="foto_ttd_ketua" id="foto_ttd_ketua" onchange="return previewImageKetua()" class="custom-file-input" required>
                        <label class="custom-file-label" style="height:50px;line-height: 2.3;">Pilih foto</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix">
                <button type="submit" class="btn btn-primary float-right">Upload TTD </span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Preview Tanda Tangan Ketua</h4>
          </div>
          <div class="card-body">
            <?php
            if ($data['ketua']->ttd == NULL) {
              echo '<h5 class="text-danger">Tanda tangan belum ada, silahkan diupload.</h5>';
            }
            ?>
            <div class="imagePrevKetua" id="imagePrevKetua" style="height: 200px; margin-top: 20px; <?php echo ($data['ketua']->ttd == NULL) ? 'display:none;' : ''; ?>">
              <img id="imagePreviewKetua" style="height:100%;object-fit:cover;" src="<?php echo ($data['ketua']->ttd != NULL) ? URLROOT . '/assets/images/ttd/' . $data['ketua']->ttd : ''; ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Upload Tanda Tangan Kasubbag</h4>
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group row">
                <div class="col-sm-12">
                  <div class="form-group col-md-12">
                    <label>Foto Tanda Tangan</label>
                    <input type="hidden" name="bagian" value="kasubbag">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="foto_ttd_kasubbag" id="foto_ttd_kasubbag" onchange="return previewImageKasubbag()" class="custom-file-input" required>
                        <label class="custom-file-label" style="height:50px;line-height: 2.3;">Pilih foto</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix">
                <button type="submit" class="btn btn-primary float-right">Upload TTD </span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Preview Tanda Tangan Kasubbag</h4>
          </div>
          <div class="card-body">
            <?php
            if ($data['kasubbag']->ttd == NULL) {
              echo '<h5 class="text-danger">Tanda tangan belum ada, silahkan diupload.</h5>';
            }
            ?>
            <div class="imagePrevKasubbag" id="imagePrevKasubbag" style="height: 200px; margin-top: 20px; <?php echo ($data['kasubbag']->ttd == NULL) ? 'display:none;' : ''; ?>">
              <img id="imagePreviewKasubbag" style="height:100%;object-fit:cover;" src="<?php echo ($data['kasubbag']->ttd != NULL) ? URLROOT . '/assets/images/ttd/' . $data['kasubbag']->ttd : ''; ?>">
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

<script>
  function previewImageKetua() {
    var inputFile = document.getElementById('foto_ttd_ketua');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.png|\.jpg|\.jpeg)$/i;
    if (inputFile.files[0].size > 2000 * 1000) { // ini untuk ukuran1000000 untuk 1 MB.
      alert("Maaf. Foto Terlalu Besar ! Maksimal Upload 2mb");
      inputFile.value = '';
      return false;
    };
    if (!ekstensiOk.exec(pathFile)) {
      alert('Silakan upload file yang memiliki ekstensi .png/.jpg/.jpeg');
      inputFile.value = '';
      return false;
    } else {
      //Pratinjau gambar
      if (inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#imagePrevKetua').show();
          $('#imagePreviewKetua').attr('src', e.target.result);
          $('#imagePreviewKetua').hide();
          $('#imagePreviewKetua').fadeIn(650);
        };
        reader.readAsDataURL(inputFile.files[0]);
      }
    }
  }

  function previewImageKasubbag() {
    var inputFile = document.getElementById('foto_ttd_kasubbag');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.png|\.jpg|\.jpeg)$/i;
    if (inputFile.files[0].size > 2000 * 1000) { // ini untuk ukuran1000000 untuk 1 MB.
      alert("Maaf. Foto Terlalu Besar ! Maksimal Upload 2mb");
      inputFile.value = '';
      return false;
    };
    if (!ekstensiOk.exec(pathFile)) {
      alert('Silakan upload file yang memiliki ekstensi .png/.jpg/.jpeg');
      inputFile.value = '';
      return false;
    } else {
      //Pratinjau gambar
      if (inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#imagePrevKasubbag').show();
          $('#imagePreviewKasubbag').attr('src', e.target.result);
          $('#imagePreviewKasubbag').hide();
          $('#imagePreviewKasubbag').fadeIn(650);
        };
        reader.readAsDataURL(inputFile.files[0]);
      }
    }
  }
</script>
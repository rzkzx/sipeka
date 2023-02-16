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
    <div class="row">
      <div class="col-lg-12">
        <div class="profile card card-body px-3 pt-3 pb-0">
          <div class="profile-head">
            <div class="photo-content">
              <div class="cover-photo" style="width:100%;background: url('<?= URLROOT ?>/assets/images/cover.jpg');background-position: center;background-size:cover;"></div>
            </div>
            <div class="profile-info">
              <div class="profile-photo">
                <img src="<?= URLROOT ?>/assets/images/pegawai/<?php echo ($_SESSION['avatar'] != NULL) ? $_SESSION['avatar'] : 'dummy.png' ?>" class="img-fluid rounded-circle" alt="<?= $_SESSION['nama'] ?>">
              </div>
              <div class="profile-details">
                <div class="profile-name px-3 pt-2">
                  <h4 class="text-primary mb-0"><?= $_SESSION['nama'] ?></h4>
                  <p><?= $_SESSION['nip'] ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php flash() ?>
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <div class="profile-tab">
              <div class="custom-tab-1">
                <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">About Me</a>
                  </li>
                  <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link">Setting</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div id="about-me" class="tab-pane fade active show">
                    <div class="profile-personal-info">
                      <h4 class="text-primary mb-4 pt-4">Informasi Pribadi</h4>
                      <div class="row mb-2">
                        <div class="col-sm-3 col-5">
                          <h5 class="f-w-500">Nama <span class="pull-right">:</span>
                          </h5>
                        </div>
                        <div class="col-sm-9 col-7"><span><?= $_SESSION['nama'] ?></span>
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col-sm-3 col-5">
                          <h5 class="f-w-500">Username <span class="pull-right">:</span>
                          </h5>
                        </div>
                        <div class="col-sm-9 col-7"><span><?= $_SESSION['username'] ?></span>
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col-sm-3 col-5">
                          <h5 class="f-w-500">NIP Pegawai <span class="pull-right">:</span></h5>
                        </div>
                        <div class="col-sm-9 col-7"><span><?= $_SESSION['nip'] ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="profile-settings" class="tab-pane fade">
                    <div class="pt-3">
                      <div class="settings-form">
                        <div class="row">
                          <div class="col-xl-8">
                            <h4 class="text-primary">Setting Akun</h4>
                            <br>
                            <form method="post" action="<?= URLROOT ?>/profile/changeProfileAdmin" enctype="multipart/form-data">
                              <div class="form-row">
                                <div class="form-group row col-md-12">
                                  <div class="col-sm-12">
                                    <div class="avatar-upload" style="margin: 0 auto;">
                                      <div class="avatar-edit">
                                        <input type="file" id="imageUpload" name="avatar" onchange="return avatarUpload()" accept=".png, .jpg, .jpeg" />
                                        <label for="imageUpload"><i class="fa fa-pencil"></i></label>
                                      </div>
                                      <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url(<?= URLROOT; ?>/assets/images/pegawai/<?php echo ($_SESSION['avatar']) ? $_SESSION['avatar'] : 'dummy.png'; ?>);">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-md-6">
                                  <label>Nama</label>
                                  <input type="text" name="nama" id="nama" class="form-control" value="<?= $_SESSION['nama'] ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label>Username</label>
                                  <input type="text" name="username" id="username" class="form-control" value="<?= $_SESSION['username'] ?>" required>
                                </div>
                              </div>
                              <button class="btn btn-primary" type="submit">Perbarui Akun</button>
                            </form>
                          </div>
                          <div class="col-xl-4">
                            <h4 class="text-primary">Ganti Password</h4>
                            <form method="post" action="<?= URLROOT ?>/profile/changePassword">
                              <div class="form-group">
                                <label>Password Lama</label>
                                <input type="password" name="password" class="form-control">
                              </div>
                              <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="newPassword" class="form-control">
                              </div>
                              <div class="form-group">
                                <label>Konfirmasi Password Baru</label>
                                <input type="password" name="confirmNewPassword" class="form-control">
                              </div>
                              <button class="btn btn-primary" type="submit">Perbarui Password</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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

<script>
  function avatarUpload() {
    var inputFile = document.getElementById('imageUpload');
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
          $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
          $('#imagePreview').hide();
          $('#imagePreview').fadeIn(650);
        };
        reader.readAsDataURL(inputFile.files[0]);
      }
    }
  }
</script>
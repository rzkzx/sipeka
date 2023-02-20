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
          <li class="breadcrumb-item"><a href="javascript:void(0)">Pegawai</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $data['title'] ?></a></li>
        </ol>
      </div>
    </div>
    <!-- row -->
    <?php flash() ?>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Data Ketua</h4>
            <?php
            if (Middleware::admin()) {
              echo '<button class="btn btn-info" data-toggle="modal" data-target="#modalKetuaUpdate">Ganti Ketua<span class="btn-icon-right"><i class="fa fa-user"></i></span></button>';
            }
            ?>
          </div>
          <div class="card-body pb-2">
            <?php
            if ($data['ketua']) {
            ?>
              <div class="profile-personal-info row" style="font-size:1rem;">
                <div class="col-lg-1 mb-3">
                  <div class="row mb-2">
                    <div class="col-sm-9 col-7">
                      <img src="<?= URLROOT ?>/assets/images/pegawai/<?= $data['ketua']->foto ?>" width="100" style="object-fit:cover;border-radius:5px;" alt="" srcset="">
                    </div>
                  </div>
                </div>
                <div class="row col-lg-11 col-md-12">
                  <div class="col-5">
                    <div class="row mb-2">
                      <div class="col-sm-3 col-5">
                        <h5 class="f-w-500">NIP <span class="pull-right">:</span>
                        </h5>
                      </div>
                      <div class="col-sm-9 col-7"><span><?= $data['ketua']->nip ?></span>
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-sm-3 col-5">
                        <h5 class="f-w-500">Nama <span class="pull-right">:</span>
                        </h5>
                      </div>
                      <div class="col-sm-9 col-7"><span><?= $data['ketua']->nama ?></span>
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-sm-3 col-5">
                        <h5 class="f-w-500">Pangkat <span class="pull-right">:</span>
                        </h5>
                      </div>
                      <div class="col-sm-9 col-7"><span><?= $data['ketua']->pangkat ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-7">
                    <div class="row mb-2">
                      <div class="col-sm-3 col-5">
                        <h5 class="f-w-500">Jabatan <span class="pull-right">:</span></h5>
                      </div>
                      <div class="col-sm-9 col-7"><span><?= $data['ketua']->jabatan ?></span>
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-sm-3 col-5">
                        <h5 class="f-w-500">Ruangan <span class="pull-right">:</span>
                        </h5>
                      </div>
                      <div class="col-sm-9 col-7"><span><?= $data['ketua']->ruangan ?></span>
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-sm-3 col-5">
                        <h5 class="f-w-500">Masa Kerja <span class="pull-right">:</span></h5>
                      </div>
                      <div class="col-sm-9 col-7"><span><?= $data['ketua']->masa_kerja ?> Tahun</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            } else {
            ?>
              <div class="row justify-content-between align-items-center m-0">
                <h4 class="text-danger">Data Ketua belum ditentukan</h4>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"><?= $data['title'] ?></h4>
            <a href="<?= URLROOT ?>/pegawai/add" type="button" class="btn btn-primary">Tambah Pegawai <span class="btn-icon-right"><i class="fa fa-plus"></i></span></a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example3" class="display" style="min-width: 845px">
                <thead>
                  <tr>
                    <th></th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Pangkat</th>
                    <th>Jabatan</th>
                    <th>Ruangan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data['pegawai'] as $pegawai) {
                  ?>
                    <tr>
                      <td><img class="rounded-circle" width="35" height="35" src="<?= URLROOT ?>/assets/images/pegawai/<?= $pegawai->foto ?>" alt="<?= $pegawai->nip ?>"></td>
                      <td><?= $pegawai->nip ?></td>
                      <td><?= $pegawai->nama ?></td>
                      <td><?= $pegawai->pangkat ?></td>
                      <td><?= $pegawai->jabatan ?></td>
                      <td><?= $pegawai->ruangan ?></td>
                      <td>
                        <div class="d-flex">
                          <a href="<?= URLROOT ?>/pegawai/detail/<?= $pegawai->id ?>" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a>
                          <a href="<?= URLROOT ?>/pegawai/edit/<?= $pegawai->id ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                          <button class="btn btn-danger shadow btn-xs sharp" id="btnDelete" data-id="<?= $pegawai->id ?>"><i class="fa fa-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                  <?php
                    # code...
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php
if (Middleware::admin()) {
?>
  <!-- Modal Validasi -->
  <div class="modal fade" id="modalKetuaUpdate">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ganti Ketua</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
          </button>
        </div>
        <form action="<?= URLROOT ?>/pegawai/updateKetua/" method="post">
          <div class="modal-body">
            <input type="hidden" name="id" id="id_validasi">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label>Pilih Ketua</label>
                <select class="form-control default-select" name="nip_ketua" id="nip_ketua" tabindex="-98" required>
                  <option value="" disabled selected>- Pilih -</option>
                  <?php
                  foreach ($data['pegawai'] as $pegawai) {
                    echo '<option value="' . $pegawai->nip . '">' . $pegawai->nama . ' / ' . $pegawai->nip . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Terapkan Ketua</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
}
?>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

<script>
  $(document).ready(function() {
    $(document).delegate("#btnDelete", "click", function() {
      Swal.fire({
        icon: 'warning',
        title: 'Hapus Pegawai',
        text: 'Anda yakin menghapus pegawai ini?',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

          var id = $(this).attr('data-id');

          // Ajax config
          $.ajax({
            type: "POST", //we are using GET method to get data from server side
            url: '<?= URLROOT ?>/pegawai/delete/' + id, // get the route value
            beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click

            },
            success: function(response) { //once the request successfully process to the server side it will return result here
              // Reload lists of employees
              Swal.fire('Berhasil Hapus Pengguna.', response, 'success').then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              });
            }
          });

        } else if (result.isDenied) {
          Swal.fire('Perubahan tidak disimpan', '', 'info')
        }
      });
    });
  });
</script>
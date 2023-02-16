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
          <li class="breadcrumb-item"><a href="javascript:void(0)">Kenaikan Pangkat</a></li>
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
            <h4 class="card-title"><?= $data['title'] ?></h4>
            <a href="<?= URLROOT ?>/usulpangkat/add" type="button" class="btn btn-primary">Tambah Usul Kenaikan Pangkat <span class="btn-icon-right"><i class="fa fa-plus"></i></span></a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example3" class="display" style="min-width: 845px">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Surat</th>
                    <th>Tgl Surat</th>
                    <th>NIP</th>
                    <th>Pangkat Usulan</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($data['usulpangkat'] as $usulpkt) {
                    if ($usulpkt->status == 'Selesai') {
                      $badge = 'success';
                    } else {
                      $badge = 'warning';
                    }
                  ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $usulpkt->no_surat ?></td>
                      <td><?= dateID($usulpkt->tgl_surat) ?></td>
                      <td><?= $usulpkt->nip ?></td>
                      <td><?= $usulpkt->pangkat_usulan ?></td>
                      <td><span class="badge light badge-<?= $badge ?>"><?= $usulpkt->status ?></span></td>
                      <td>
                        <div class="d-flex">
                          <a href="<?= URLROOT ?>/usulpangkat/detail/<?= $usulpkt->id_usul_pangkat ?>" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a>
                          <a href="<?= URLROOT ?>/usulpangkat/edit/<?= $usulpkt->id_usul_pangkat ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                          <button class="btn btn-danger shadow btn-xs sharp" id="btnDelete" data-id="<?= $usulpkt->id_usul_pangkat ?>"><i class="fa fa-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                  <?php
                    $no++;
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

<?php require APPROOT . '/views/layouts/footer.php'; ?>

<script>
  $(document).ready(function() {
    $(document).delegate("#btnDelete", "click", function() {
      Swal.fire({
        icon: 'warning',
        title: 'Hapus',
        text: 'Anda yakin menghapus usulan ini?',
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
            url: '<?= URLROOT ?>/usulpangkat/delete/' + id, // get the route value
            beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click

            },
            success: function(response) { //once the request successfully process to the server side it will return result here
              // Reload lists of employees
              Swal.fire('Berhasil Hapus Usulan.', response, 'success').then((result) => {
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
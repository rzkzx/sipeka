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
            <a href="<?= URLROOT ?>/skpangkat/add" type="button" class="btn btn-primary">Tambah SK Kenaikan Pangkat <span class="btn-icon-right"><i class="fa fa-plus"></i></span></a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example3" class="display" style="min-width: 845px">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No SK</th>
                    <th>Tgl SK</th>
                    <th>NIP</th>
                    <th>Pangkat Lama</th>
                    <th>Pangkat Baru</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($data['skpangkat'] as $skpangkat) {
                    if ($skpangkat->status == 'Selesai') {
                      $badge = 'success';
                    } else {
                      $badge = 'warning';
                    }
                  ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $skpangkat->no_sk ?></td>
                      <td><?= dateID($skpangkat->tgl_sk) ?></td>
                      <td><?= $skpangkat->nip ?></td>
                      <td><?= $skpangkat->pangkat_lama ?></td>
                      <td><?= $skpangkat->pangkat_baru ?></td>
                      <td><span class="badge light badge-<?= $badge ?>"><?= $skpangkat->status ?></span></td>
                      <td>
                        <div class="d-flex">
                          <a href="<?= URLROOT ?>/skpangkat/detail/<?= $skpangkat->id_pangkat ?>" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a>
                          <a href="<?= URLROOT ?>/skpangkat/edit/<?= $skpangkat->id_pangkat ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                          <button class="btn btn-danger shadow btn-xs sharp" id="btnDelete" data-id="<?= $skpangkat->id_pangkat ?>"><i class="fa fa-trash"></i></button>
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
        text: 'Anda yakin menghapus sk ini?',
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
            url: '<?= URLROOT ?>/skpangkat/delete/' + id, // get the route value
            beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click

            },
            success: function(response) { //once the request successfully process to the server side it will return result here
              // Reload lists of employees
              Swal.fire('Berhasil Hapus SK.', response, 'success').then((result) => {
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
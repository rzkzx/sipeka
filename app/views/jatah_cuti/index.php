<?php require APPROOT . '/views/layouts/header.php'; ?>

<?php
$tahun = date('Y');
$tahun2 = date('Y', strtotime('-1 year'));
$tahun3 = date('Y', strtotime('-2 year'));
?>

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
          <li class="breadcrumb-item"><a href="javascript:void(0)">Jatah Cuti</a></li>
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
            <a href="<?= URLROOT ?>/jatahcuti/add" type="button" class="btn btn-primary">Tambah Data <span class="btn-icon-right"><i class="fa fa-plus"></i></span></a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example3" class="display" style="min-width: 845px">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Sisa Tahun <?= $tahun3 ?></th>
                    <th>Sisa Tahun <?= $tahun2 ?></th>
                    <th>Jatah Tahun <?= $tahun ?></th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($data['jatahcuti'] as $jatahcuti) {
                  ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $jatahcuti->nip ?></td>
                      <td><?= $jatahcuti->nama ?></td>
                      <td><?= $jatahcuti->sisa1 ?></td>
                      <td><?= $jatahcuti->sisa2 ?></td>
                      <td><?= $jatahcuti->sisa3 ?></td>
                      <td>
                        <div class="d-flex">
                          <a href="<?= URLROOT ?>/jatahcuti/edit/<?= $jatahcuti->id ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                          <button class="btn btn-danger shadow btn-xs sharp" id="btnDelete" data-id="<?= $jatahcuti->id ?>"><i class="fa fa-trash"></i></button>
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
        text: 'Anda yakin hapus jatah cuti ini?',
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
            url: '<?= URLROOT ?>/jatahcuti/delete/' + id, // get the route value
            beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click

            },
            success: function(response) { //once the request successfully process to the server side it will return result here
              // Reload lists of employees
              Swal.fire('Berhasil', 'Berhasil Hapus Jatah Cuti.', 'success').then((result) => {
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
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
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example3" class="display" style="min-width: 845px">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Kode Cuti</th>
                    <th>Lama Cuti</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($data['cuti'] as $cuti) {
                    if ($cuti->status == 'DITERIMA') {
                      $badge = 'success';
                    } elseif ($cuti->status == 'DITOLAK') {
                      $badge = 'danger';
                    } else {
                      $badge = 'warning';
                    }
                  ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= dateID($cuti->tanggal) ?></td>
                      <td><?= $cuti->nama ?></td>
                      <td><?= $cuti->nip ?></td>
                      <td><?= $cuti->kodecuti ?></td>
                      <td><?= $cuti->lamacuti ?> Hari</td>
                      <td>
                        <?php
                        if ($cuti->status == 'USULAN') {
                        ?>
                          <button class="btn btn-warning shadow btn-xs text-uppercase" id="btnValidasi" data-toggle="modal" data-id="<?= $cuti->id ?>" data-target="#validasiModal"><i class="fa fa-check-square"></i> Validasi</button>
                        <?php
                        } else {
                          echo '<span class="badge light badge-' . $badge . '">' . $cuti->status . '</span>';
                        }
                        ?>

                      </td>
                      <td>
                        <div class="d-flex">
                          <a href="<?= URLROOT ?>/cuti/detail/<?= $cuti->id ?>" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a>
                          <?php
                          if ($cuti->status == 'USULAN') {
                          ?>
                            <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1" id="btnUpdate" data-toggle="modal" data-id="<?= $cuti->id ?>" data-target="#exampleModalpopover"><i class="fa fa-pencil"></i></button>
                          <?php
                          } elseif ($cuti->status == 'DITERIMA') {
                          ?>
                            <a href="<?= URLROOT ?>/cuti/surat/<?= $cuti->id ?>" target="_blank" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-envelope-o"></i></a>
                          <?php
                          }
                          ?>
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
<!-- Modal -->
<div class="modal fade" id="exampleModalpopover">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Pengajuan Cuti</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
        </button>
      </div>
      <form action="<?= URLROOT ?>/cuti/edit/" id="update_form" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" id="id_update">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Kode Cuti</label>
              <input type="text" name="kodecuti" id="kodecuti" class="form-control" readonly required>
            </div>
            <div class="form-group col-md-6">
              <label>Mulai Cuti</label>
              <input type="date" name="mulai_cuti" id="mulai_cuti" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
              <label>Sampai Cuti</label>
              <input type="date" name="sampai_cuti" id="sampai_cuti" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Perbarui</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Validasi -->
<div class="modal fade" id="validasiModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Validasi Pengajuan Cuti</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
        </button>
      </div>
      <form action="<?= URLROOT ?>/cuti/validasi/" id="validasi_form" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" id="id_validasi">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Kode Cuti</label>
              <input type="text" name="kodecuti" id="kodecuti" class="form-control" readonly required>
            </div>
            <div class="form-group col-md-6">
              <label>Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" readonly required>
            </div>
            <div class="form-group col-md-6">
              <label>NIP</label>
              <input type="text" name="nip" id="nip" class="form-control" readonly required>
            </div>
            <input type="hidden" name="pakai1" id="pakai1">
            <input type="hidden" name="pakai2" id="pakai2">
            <input type="hidden" name="pakai3" id="pakai3">
            <input type="hidden" name="lama_cuti" id="lama_cuti">
            <div class="form-group col-md-6">
              <label>Mulai Cuti</label>
              <input type="text" name="mulai_cuti" id="mulai_cuti" class="form-control" readonly required>
            </div>
            <div class="form-group col-md-6">
              <label>Sampai Cuti</label>
              <input type="date" name="sampai_cuti" id="sampai_cuti" class="form-control" readonly required>
            </div>
            <div class="form-group col-md-12">
              <label>Validasi Pengajuan Cuti</label>
              <select class="form-control default-select" name="status" id="status" tabindex="-98" required>
                <option value="" disabled selected>- Pilih -</option>
                <option>DITERIMA</option>
                <option>DITOLAK</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Validasi</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

<script>
  $(document).ready(function() {
    $(document).delegate("#btnUpdate", "click", function() {
      var id = $(this).attr('data-id');

      // Ajax config
      $.ajax({
        type: "POST", //we are using GET method to get data from server side
        url: '<?= URLROOT ?>/cuti/getCutiAjax/' + id, // get the route value
        data: {
          id: id
        }, //set data
        beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click

        },
        success: function(data) { //once the request successfully process to the server side it will return result here
          data = JSON.parse(data);
          $('#update_form').attr('action', '<?= URLROOT ?>/cuti/edit/' + data.id);
          $("#update_form").find('#kodecuti').val(data.kodecuti);
          $("#update_form").find('#id_update').val(data.id);
          $("#update_form").find('#mulai_cuti').val(data.daritgl);
          $("#update_form").find('#sampai_cuti').val(data.sampaitgl);
        }
      });
    });

    $(document).delegate("#btnValidasi", "click", function() {
      var id = $(this).attr('data-id');

      // Ajax config
      $.ajax({
        type: "POST", //we are using GET method to get data from server side
        url: '<?= URLROOT ?>/cuti/getCutiAjax/' + id, // get the route value
        data: {
          id: id
        }, //set data
        beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click

        },
        success: function(data) { //once the request successfully process to the server side it will return result here
          data = JSON.parse(data);
          $('#validasi_form').attr('action', '<?= URLROOT ?>/cuti/validasi/' + data.id);
          $("#validasi_form").find('#kodecuti').val(data.kodecuti);
          $("#validasi_form").find('#id_validasi').val(data.id);
          $("#validasi_form").find('#nip').val(data.nip);
          $("#validasi_form").find('#nama').val(data.nama);
          $("#validasi_form").find('#mulai_cuti').val(data.daritgl);
          $("#validasi_form").find('#sampai_cuti').val(data.sampaitgl);
          $("#validasi_form").find('#pakai1').val(data.pakai1);
          $("#validasi_form").find('#pakai2').val(data.pakai2);
          $("#validasi_form").find('#pakai3').val(data.pakai3);
          $("#validasi_form").find('#lama_cuti').val(data.lamacuti);
        }
      });
    });
  });
</script>
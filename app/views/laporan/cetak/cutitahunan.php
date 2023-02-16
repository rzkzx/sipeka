<!DOCTYPE html>
<html>

<head>
  <title>Cetak Laporan Daftar Cuti Tahunan</title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?= URLROOT ?>/assets/images/logo/logo-pn.png">
  <link href="<?= URLROOT ?>/assets/css/style.css" rel="stylesheet">
  <style>
    th,
    td {
      padding: 10px;

    }
  </style>
</head>

<body>
  <center>
    <img src="<?= URLROOT ?>/assets/images/logo/logo-pn.png" width='70' height='80'>
    <h3 style="padding: 0; margin-top:10px;">LAPORAN DAFTAR CUTI TAHUNAN DITERIMA</h3>
    <h4>TAHUN <?= $data['tahun'] ?>
  </center>
  <table border="1" style="width: 100%">
    <tr>
      <th>No</th>
      <th>NIP</th>
      <th>Nama</th>
      <th>Lama Cuti</th>
      <th>Dari Tanggal</th>
      <th>Sampai Tanggal</th>
      <th>Status</th>
    </tr>
    <?php
    $no = 1;
    foreach ($data['cuti'] as $cuti) {
    ?>
      <tr>
        <td><?= $no; ?></td>
        <td><?= $cuti->nip ?></td>
        <td><?= $cuti->nama ?></td>
        <td><?= $cuti->lamacuti ?></td>
        <td><?= dateID($cuti->daritgl) ?></td>
        <td><?= dateID($cuti->sampaitgl) ?></td>
        <td><?= $cuti->status ?></td>
      </tr>
    <?php
      $no++;
    }
    ?>
  </table>

  </div>
  </div>

  <br>
  <table border="0">
    <td style="width: 5%"></td>
    <td style="width: 70%">
      <br>
      <br>
      <br>Sekretaris
      <br>
      <br>
      <br>
      <br>H. AKHMAD SYIRAJUDDIN, S.E.
      <br>NIP. 197010251991031001
    </td>
    <td style="width: 100%">
      Martapura, <?= dateID(date('Y-m-d')); ?>
      <br>
      <br>Kepala Subbagian Kepegawaian, Organisasi dan Tata Laksana
      <br>
      <br>
      <br>
      <br>SRI MULYANI, S.E.
      <br>NIP. 197009101990032001
    </td>
  </table>

  <script>
    window.print();
  </script>

  </div>

</body>

</html>
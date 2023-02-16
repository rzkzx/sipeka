<!DOCTYPE html>
<html>

<head>
  <title>Cetak Laporan Daftar Kenaikan Pangkat</title>
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
    <h3 style="padding: 0; margin-top:10px;">LAPORAN DAFTAR KENAIKAN PANGKAT</h3>
    <h4>TAHUN <?= $data['tahun'] ?>
  </center>
  <table border="1" style="width: 100%">
    <tr>
      <th>No</th>
      <th>NIP</th>
      <th>No SK</th>
      <th>Tanggal SK</th>
      <th>Pangkat Lama</th>
      <th>TMT Pangkat Lama</th>
      <th>Pangkat Baru</th>
      <th>TMT Pangkat Baru</th>
    </tr>
    <?php
    $no = 1;
    foreach ($data['daftar'] as $daftar) {
    ?>
      <tr>
        <td><?= $no; ?></td>
        <td><?= $daftar->nip ?></td>
        <td><?= $daftar->no_sk ?></td>
        <td><?= dateID($daftar->tgl_sk) ?></td>
        <td><?= $daftar->pangkat_lama ?></td>
        <td><?= dateID($daftar->tmt_pangkat_lama) ?></td>
        <td><?= $daftar->pangkat_baru ?></td>
        <td><?= dateID($daftar->tmt_pangkat_baru) ?></td>
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
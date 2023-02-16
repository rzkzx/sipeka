<!--**********************************
            Sidebar start
        ***********************************-->
<div class="deznav">
  <div class="deznav-scroll">
    <div class="main-profile">
      <div class="image-bx">
        <img src="<?= URLROOT ?>/assets/images/pegawai/<?php echo ($_SESSION['avatar'] != NULL) ? $_SESSION['avatar'] : 'dummy.png' ?>" alt="">
      </div>
      <h5 class="name"><?= $_SESSION['nama'] ?></h5>
      <p class="email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="95f8f4e7e4e0f0efefefefd5f8f4fcf9bbf6faf8">[<?= $_SESSION['username'] ?>]</a></p>
    </div>
    <ul class="metismenu" id="menu">
      <li class="nav-label first">Main Menu</li>
      <li class="<?php echo ($data['menu'] == 'Dashboard') ? 'mm-active' : ''; ?>">
        <a href="<?= URLROOT ?>/dashboard" class="ai-icon" aria-expanded="false">
          <i class="flaticon-144-layout"></i>
          <span class="nav-text">Dashboard</span>
        </a>
      </li>

      <li class="nav-label">Master Menu</li>
      <li class="<?php echo ($data['menu'] == 'Data Pegawai') ? 'mm-active' : ''; ?>">
        <a href="<?= URLROOT ?>/pegawai" class="ai-icon" aria-expanded="false">
          <i class="flaticon-028-user-1"></i>
          <span class="nav-text">Data Pegawai</span>
        </a>
      </li>
      <li class="<?php echo ($data['menu'] == 'Jatah Cuti') ? 'mm-active' : ''; ?>">
        <a href="<?= URLROOT ?>/jatahcuti" class="ai-icon" aria-expanded="false">
          <i class="flaticon-163-calendar"></i>
          <span class="nav-text">Jatah Cuti</span>
        </a>
      </li>
      <?php
      if (!Middleware::admin()) {
      ?>
        <li class="<?php echo ($data['menu'] == 'Tanda Tangan') ? 'mm-active' : ''; ?>">
          <a href="<?= URLROOT ?>/profile/ttd" class="ai-icon" aria-expanded="false">
            <i class="flaticon-068-pencil"></i>
            <span class="nav-text">Tanda Tangan</span>
          </a>
        </li>
      <?php
      } else {
      ?>
        <li class="<?php echo ($data['menu'] == 'Tanda Tangan') ? 'mm-active' : ''; ?>">
          <a href="<?= URLROOT ?>/ttd" class="ai-icon" aria-expanded="false">
            <i class="flaticon-068-pencil"></i>
            <span class="nav-text">Tanda Tangan</span>
          </a>
        </li>
      <?php
      }
      ?>
      <li class="nav-label">Transaksi</li>
      <li>
        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
          <i class="flaticon-154-bookmark"></i>
          <span class="nav-text">Pengajuan Cuti</span>
        </a>
        <ul aria-expanded="false">
          <li><a href="<?= URLROOT ?>/cuti/add">Input Pengajuan Cuti</a></li>
          <li><a href="<?= URLROOT ?>/cuti">Daftar Pengajuan Cuti</a></li>
        </ul>
      </li>
      <li class="<?php echo ($data['menu'] == 'Kenaikan Pangkat') ? 'mm-active' : ''; ?>">
        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
          <i class="flaticon-147-medal"></i>
          <span class="nav-text">Kenaikan Pangkat</span>
        </a>
        <ul aria-expanded="false">
          <li><a href="<?= URLROOT ?>/usulpangkat">Usul Kenaikan Pangkat</a></li>
          <li><a href="<?= URLROOT ?>/skpangkat">SK Kenaikan Pangkat</a></li>
        </ul>
      </li>

      <li class="nav-label">Menu</li>
      <li class="<?php echo ($data['menu'] == 'Laporan') ? 'mm-active' : ''; ?>">
        <a href="<?= URLROOT ?>/laporan" class="ai-icon" aria-expanded="false">
          <i class="fa fa-print"></i>
          <span class="nav-text">Laporan</span>
        </a>
      </li>

    </ul>
  </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->
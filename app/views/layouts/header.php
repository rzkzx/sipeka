<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="robots" content="">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="Zenix - Crypto Admin Dashboard">
  <meta property="og:title" content="Zenix - Crypto Admin Dashboard">
  <meta property="og:description" content="Zenix - Crypto Admin Dashboard">
  <meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png">
  <meta name="format-detection" content="telephone=no">
  <title><?= $data['title'] ?> - SIPEKA </title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= URLROOT ?>/assets/images/logo/logo-pn.png">
  <link href="<?= URLROOT ?>/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
  <!-- Datatable -->
  <link href="<?= URLROOT ?>/assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

  <link href="<?= URLROOT ?>/assets/css/style.css" rel="stylesheet">
  <!-- Pick date -->
  <link rel="stylesheet" href="<?= URLROOT ?>/assets/vendor/pickadate/themes/default.css">
  <link rel="stylesheet" href="<?= URLROOT ?>/assets/vendor/pickadate/themes/default.date.css">
  <!-- SweetAlert -->
  <link rel="stylesheet" type="text/css" href="<?= URLROOT; ?>/assets/vendor/sweetalert2/sweetalert2.min.css" />

  <style>
    .custom-file-label::after {
      height: calc(2.5em + 0.75rem);
      line-height: 2.5;
    }

    label.error {
      color: red;
      margin-top: 5px;
      font-size: 0.8rem;
    }

    input.error,
    textarea.error {
      border: 1px solid red;
      color: red;
    }

    .bootstrap-select .btn {
      border: 1px solid #b0b0b0 !important;
      color: #181818 !important;
    }

    .form-control {
      border: 1px solid #b0b0b0;
      color: #181818;
    }

    .form-control:disabled,
    .form-control[readonly] {
      background: #d6d6d6;
      opacity: 1;
    }

    .custom-file-label {
      border-color: #b0b0b0;
    }


    .avatar-upload {
      position: relative;
      max-width: 205px;
    }

    .avatar-upload .avatar-edit {
      position: absolute;
      right: 12px;
      z-index: 1;
      top: 10px;
    }

    .avatar-upload .avatar-edit input {
      display: none;
    }

    .avatar-upload .avatar-edit label {
      display: inline-block;
      width: 34px;
      height: 34px;
      margin-bottom: 0;
      border-radius: 100%;
      background: #FFFFFF;
      border: 1px solid #d4d4d4;
      box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
      cursor: pointer;
      font-weight: normal;
      transition: all .2s ease-in-out;
    }

    .avatar-upload .avatar-edit label:hover {
      background: #f1f1f1;
      border-color: #d6d6d6;
    }

    .avatar-upload .avatar-edit label i {
      color: #404258;
      position: absolute;
      top: 10px;
      left: 0;
      right: 0;
      text-align: center;
      margin: auto;
    }

    .avatar-preview {
      width: 180px;
      height: 180px;
      position: relative;
      border-radius: 100%;
      box-shadow: 0px 3px 10px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-preview div {
      width: 100%;
      height: 100%;
      border-radius: 100%;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
  </style>
  </style>
</head>

<body>

  <!--*******************
        Preloader start
    ********************-->
  <div id="preloader">
    <div class="sk-three-bounce">
      <div class="sk-child sk-bounce1"></div>
      <div class="sk-child sk-bounce2"></div>
      <div class="sk-child sk-bounce3"></div>
    </div>
  </div>
  <!--*******************
        Preloader end
    ********************-->

  <!--**********************************
        Main wrapper start
    ***********************************-->
  <div id="main-wrapper">

    <!--**********************************
            Nav header start
        ***********************************-->
    <div class="nav-header">
      <a href="index.html" class="brand-logo">
        <img src="<?= URLROOT ?>/assets/images/logo/logo-pn.png" alt="Logo" style="height:50px;object-fit:cover;">
        <svg class="brand-title" width="340" height="71" viewBox="0 0 340 71" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M52.872 50.416C52.872 54.192 51.912 57.616 49.992 60.688C48.072 63.76 45.256 66.192 41.544 67.984C37.832 69.776 33.384 70.672 28.2 70.672C20.328 70.672 13.832 68.784 8.712 65.008C3.656 61.232 0.904 55.856 0.456 48.88H20.52C20.712 51.248 21.448 53.008 22.728 54.16C24.008 55.312 25.576 55.888 27.432 55.888C29.096 55.888 30.376 55.472 31.272 54.64C32.232 53.808 32.712 52.624 32.712 51.088C32.712 49.04 31.784 47.472 29.928 46.384C28.072 45.232 25.128 43.984 21.096 42.64C16.808 41.168 13.256 39.728 10.44 38.32C7.688 36.912 5.288 34.8 3.24 31.984C1.256 29.168 0.264 25.552 0.264 21.136C0.264 16.912 1.352 13.296 3.528 10.288C5.704 7.216 8.68 4.912 12.456 3.376C16.232 1.776 20.52 0.975996 25.32 0.975996C33.128 0.975996 39.336 2.832 43.944 6.544C48.616 10.192 51.176 15.344 51.624 22H31.368C31.112 19.888 30.44 18.32 29.352 17.296C28.328 16.272 26.952 15.76 25.224 15.76C23.752 15.76 22.6 16.144 21.768 16.912C20.936 17.68 20.52 18.832 20.52 20.368C20.52 22.288 21.416 23.792 23.208 24.88C25.064 25.968 27.944 27.184 31.848 28.528C36.136 30.064 39.688 31.568 42.504 33.04C45.32 34.512 47.752 36.656 49.8 39.472C51.848 42.288 52.872 45.936 52.872 50.416ZM80.0648 2.032V70H61.1528V2.032H80.0648ZM109.409 47.248V70H90.4965V2.032H118.721C126.913 2.032 133.153 4.112 137.441 8.272C141.793 12.368 143.969 17.872 143.969 24.784C143.969 29.072 143.009 32.912 141.089 36.304C139.169 39.696 136.289 42.384 132.449 44.368C128.673 46.288 124.097 47.248 118.721 47.248H109.409ZM116.609 32.368C122.113 32.368 124.865 29.84 124.865 24.784C124.865 19.792 122.113 17.296 116.609 17.296H109.409V32.368H116.609ZM170.252 17.104V28.336H192.236V42.64H170.252V54.928H195.116V70H151.34V2.032H195.116V17.104H170.252ZM240.515 35.248L266.819 70H244.067L222.659 39.952V70H203.747V2.032H222.659V31.408L244.259 2.032H266.819L240.515 35.248ZM315.94 58.672H291.844L288.1 70H268.228L293.092 2.32H314.884L339.652 70H319.684L315.94 58.672ZM311.236 44.464L303.94 22.384L296.548 44.464H311.236Z" fill="#065F27" />
        </svg>
      </a>

      <div class="nav-control">
        <div class="hamburger">
          <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
      </div>
    </div>
    <!--**********************************
            Nav header end
        ***********************************-->

    <!--**********************************
            Header start
        ***********************************-->
    <div class="header">
      <div class="header-content">
        <nav class="navbar navbar-expand">
          <div class="collapse navbar-collapse justify-content-between">
            <div class="header-left">
              <h5 class="text-uppercase text-primary">Pengadilan Negeri Martapura</h5>
            </div>
            <ul class="navbar-nav header-right main-notification">
              <li class="nav-item dropdown notification_dropdown">
                <a class="nav-link bell dz-fullscreen" href="#">
                  <svg id="icon-full" viewbox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3" style="stroke-dasharray: 37, 57; stroke-dashoffset: 0;"></path>
                  </svg>
                  <svg id="icon-minimize" width="20" height="20" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minimize">
                    <path d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3" style="stroke-dasharray: 37, 57; stroke-dashoffset: 0;"></path>
                  </svg>
                </a>
              </li>
              <li class="nav-item dropdown header-profile">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                  <img src="<?= URLROOT ?>/assets/images/pegawai/<?php echo ($_SESSION['avatar'] != NULL) ? $_SESSION['avatar'] : 'dummy.png' ?>" width="20" alt="">
                  <div class="header-info">
                    <span><?= $_SESSION['nama'] ?></span>
                    <small><?= $_SESSION['username'] ?></small>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a href="<?= URLROOT ?>/profile" class="dropdown-item ai-icon">
                    <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="ml-2">Profile</span>
                  </a>
                  <a href="<?= URLROOT ?>/login/logout" class="dropdown-item ai-icon">
                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                      <polyline points="16 17 21 12 16 7"></polyline>
                      <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span class="ml-2">Logout</span>
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        <div class="sub-header">
          <div class="d-flex align-items-center flex-wrap mr-auto">
            <h5 class="dashboard_bar"><?= $data['title'] ?></h5>
          </div>
        </div>
      </div>
    </div>
    <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

    <?php require APPROOT . '/views/layouts/sidebar.php'; ?>
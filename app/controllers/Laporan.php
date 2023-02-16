<?php
class Laporan extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    //new model instance
    $this->cutiModel = $this->model('CutiModel');
    $this->pegawaiModel = $this->model('PegawaiModel');
    $this->skPangkatModel = $this->model('SkPangkatModel');
  }

  public function index()
  {

    $data = [
      'title' => 'Laporan',
      'menu' => 'Laporan',
    ];

    $this->view('laporan/index', $data);
  }

  public function cutitahunan($tahun = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $tahun = $_POST['tahun'];
      $cuti = $this->cutiModel->getLaporanCutiTahunan($tahun);

      $data = [
        'title' => 'Laporan',
        'menu' => 'Laporan',
        'tahun' => $tahun,
        'cuti' => $cuti
      ];

      $this->view('laporan/cetak/cutitahunan', $data);
    } else {
      return redirect('laporan');
    }
  }

  public function jadwalpangkat($tahun = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $tahun = $_POST['tahun'];
      $jadwal = $this->pegawaiModel->getJadwalPangkat($tahun);

      $data = [
        'title' => 'Laporan',
        'menu' => 'Laporan',
        'tahun' => $tahun,
        'jadwal' => $jadwal
      ];

      $this->view('laporan/cetak/jadwalpangkat', $data);
    } else {
      return redirect('laporan');
    }
  }

  public function daftarpangkat($tahun = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $tahun = $_POST['tahun'];
      $daftar = $this->skPangkatModel->getDaftarPangkat($tahun);

      $data = [
        'title' => 'Laporan',
        'menu' => 'Laporan',
        'tahun' => $tahun,
        'daftar' => $daftar
      ];

      $this->view('laporan/cetak/daftarpangkat', $data);
    } else {
      return redirect('laporan');
    }
  }
}

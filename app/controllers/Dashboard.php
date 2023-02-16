<?php
class Dashboard extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    //new model instance
    $this->pegawaiModel = $this->model('PegawaiModel');
    $this->cutiModel = $this->model('CutiModel');
    $this->usulPangkatModel = $this->model('UsulPangkatModel');
    $this->skPangkatModel = $this->model('SkPangkatModel');
  }

  public function index()
  {
    $pegawai = $this->pegawaiModel->get();
    $cuti = $this->cutiModel->get();
    $usulpangkat = $this->usulPangkatModel->get();
    $skpangkat = $this->skPangkatModel->get();

    $data = [
      'title' => 'Dashboard',
      'menu' => 'Dashboard',
      'pegawai' => $pegawai,
      'cuti' => $cuti,
      'usulpangkat' => $usulpangkat,
      'skpangkat' => $skpangkat
    ];

    $this->view('dashboard/index', $data);
  }
}

<?php
class Cuti extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    //new model instance
    $this->cutiModel = $this->model('CutiModel');
    $this->jatahCutiModel = $this->model('JatahCutiModel');
    $this->pegawaiModel = $this->model('PegawaiModel');
    $this->ttdModel = $this->model('TtdModel');
  }

  public function index()
  {
    $cuti = $this->cutiModel->get();

    $data = [
      'title' => 'Daftar Pengajuan Cjuti',
      'menu' => 'Pengajuan Cuti',
      'cuti' => $cuti
    ];

    $this->view('cuti/index', $data);
  }

  public function detail($id = '')
  {
    $cuti = $this->cutiModel->getById($id);

    if ($cuti) {
      $data = [
        'title' => 'Detail Pengajuan Cuti',
        'menu' => 'Pengajuan Cuti',
        'cuti' => $cuti
      ];

      $this->view('cuti/detail', $data);
    } else {
      return redirect('cuti');
    }
  }

  public function surat($id = '')
  {
    $cuti = $this->cutiModel->getById($id);
    $pegawai = $this->pegawaiModel->getByNIP($cuti->nip);
    $jatahcuti = $this->jatahCutiModel->getByNIP($cuti->nip);

    //get ttd
    $ketua = $this->ttdModel->getKetua();
    $kasubbag = $this->ttdModel->getKasubbag();

    if ($cuti) {
      $data = [
        'title' => 'Surat Pengajuan Cuti',
        'menu' => 'Pengajuan Cuti',
        'cuti' => $cuti,
        'pegawai' => $pegawai,
        'jatahcuti' => $jatahcuti,
        'ttd_ketua' => $ketua,
        'ttd_kasubbag' => $kasubbag
      ];

      $this->view('cuti/surat', $data);
    } else {
      return redirect('cuti');
    }
  }

  public function add()
  {
    $data = [
      'title' => 'Input Pengajuan Cuti',
      'menu' => 'Pengajuan Cuti'
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['nip']) || empty($_POST['nama']) || empty($_POST['jabatan'])) {
        //load view with error
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('cuti/add');
      } else {
        if ($this->cutiModel->add($_POST)) {
          setFlash('Pengajuan Cuti berhasil ditambahkan.', 'success');
          return redirect('cuti');
        } else {
          die('something went wrong');
        }
      }
    } else {
      $pegawai = $this->pegawaiModel->get();
      $data['pegawai'] = $pegawai;

      $this->view('cuti/add', $data);
    }
  }

  public function edit($id = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['mulai_cuti']) || empty($_POST['sampai_cuti'])) {
        //load view with error msg
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('cuti');
      } else {
        //send data update to model
        if ($this->cutiModel->update($_POST, $id)) {
          setFlash('Pengajuan Cuti berhasil diperbarui.', 'success');
          return redirect('cuti');
        } else {
          die('something went wrong');
        }
      }
    } else {
      return redirect('cuti');
    }
  }

  public function validasiadmin($id = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['status']) || empty($_POST['nip'])) {
        //load view with error msg
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('cuti');
      } else {
        //send data update to model
        if ($this->cutiModel->validasiadmin($_POST, $id)) {
          setFlash('Pengajuan Cuti berhasil divalidasi.', 'success');
          return redirect('cuti');
        } else {
          die('something went wrong');
        }
      }
    } else {
      return redirect('cuti');
    }
  }

  public function validasiketua($id = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['status']) || empty($_POST['nip'])) {
        //load view with error msg
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('cuti');
      } else {
        //send data update to model
        if ($this->cutiModel->validasiketua($_POST, $id)) {
          setFlash('Pengajuan Cuti berhasil divalidasi.', 'success');
          return redirect('cuti');
        } else {
          die('something went wrong');
        }
      }
    } else {
      return redirect('cuti');
    }
  }

  public function delete($id = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->jatahCutiModel->delete($id)) {
        setFlash('Berhasil menghapus jatah cuti', 'success');
      } else {
        setFlash('Gagal menghapus jatah cuti', 'danger');
      }
    } else {
      return redirect('pegawai');
    }
  }

  public function getCutiAjax()
  {
    //if event get posted by submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $data =  $this->cutiModel->getById($_POST['id']);
      echo json_encode($data);
    }
  }
}

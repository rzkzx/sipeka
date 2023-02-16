<?php
class Usulpangkat extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    //new model instance
    $this->pegawaiModel = $this->model('PegawaiModel');
    $this->usulPangkatModel = $this->model('UsulPangkatModel');
  }

  public function index()
  {
    $usulpangkat = $this->usulPangkatModel->get();

    $data = [
      'title' => 'Usul Kenaikan Pangkat',
      'menu' => 'Kenaikan Pangkat',
      'usulpangkat' => $usulpangkat
    ];

    $this->view('usul_pangkat/index', $data);
  }

  public function add()
  {
    $data = [
      'title' => 'Tambah Usulan Kenaikan Pangkat',
      'menu' => 'Kenaikan Pangkat'
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['no_surat']) || empty($_POST['tgl_surat']) || empty($_POST['nip']) || empty($_POST['pangkat_usulan']) || empty($_POST['periode_usulan'])) {
        //load view with error
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('usulpangkat/add');
      } else {
        if ($this->usulPangkatModel->add($_FILES['file_usulpangkat'], $_POST)) {
          setFlash('Pengusulan pangkat berhasil ditambahkan.', 'success');
          return redirect('usulpangkat');
        } else {
          die('something went wrong');
        }
      }
    } else {
      $pegawai = $this->pegawaiModel->get();
      $data['pegawai'] = $pegawai;

      $this->view('usul_pangkat/add', $data);
    }
  }

  public function edit($id = '')
  {
    $data = [
      'title' => 'Edit Usul Kenaikan Pangkat',
      'menu' => 'Kenaikan Pangkat'
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['no_surat']) || empty($_POST['tgl_surat']) || empty($_POST['nip']) || empty($_POST['pangkat_usulan']) || empty($_POST['periode_usulan'])) {
        //load view with error msg
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('usulpangkat/edit/' . $id);
      } else {
        //send data update to model
        if ($this->usulPangkatModel->update($_FILES['file_usulpangkat'], $_POST, $id)) {
          setFlash('Pengusulan Kenaikan Pangkat berhasil diperbarui.', 'success');
          return redirect('usulpangkat');
        } else {
          die('something went wrong');
        }
      }
    } else {
      $usulpangkat = $this->usulPangkatModel->getById($id);

      // check event available
      if ($usulpangkat) {

        $data['id'] = $id;
        $data['usulpangkat'] = $usulpangkat;

        $this->view('usul_pangkat/edit', $data);
      } else {
        return redirect('usulpangkat');
      }
    }
  }

  public function detail($id = '')
  {
    $usulpangkat = $this->usulPangkatModel->getById($id);

    if ($usulpangkat) {
      $data = [
        'title' => 'Detail Usulan Pangkat',
        'menu' => 'Kenaikan Pangkat',
        'usulpangkat' => $usulpangkat
      ];

      $this->view('usul_pangkat/detail', $data);
    } else {
      return redirect('usulpangkat');
    }
  }

  public function delete($id = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->usulPangkatModel->delete($id)) {
        setFlash('Berhasil menghapus data usulan', 'success');
      } else {
        setFlash('Gagal menghapus data usulan', 'danger');
      }
    } else {
      return redirect('usulpangkat');
    }
  }

  public function getUsulanAjax()
  {
    //if event get posted by submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $data =  $this->usulPangkatModel->getById($_POST['id']);
      echo json_encode($data);
    }
  }
}

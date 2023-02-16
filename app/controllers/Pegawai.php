<?php
class Pegawai extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    //new model instance
    $this->pegawaiModel = $this->model('PegawaiModel');
  }

  public function index()
  {
    $pegawai = $this->pegawaiModel->get();

    $data = [
      'title' => 'Data Pegawai',
      'menu' => 'Data Pegawai',
      'pegawai' => $pegawai
    ];

    $this->view('pegawai/index', $data);
  }

  public function add()
  {
    $data = [
      'title' => 'Tambah Pegawai',
      'menu' => 'Data Pegawai'
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['nip']) || empty($_POST['nama']) || empty($_POST['pangkat']) || empty($_POST['jabatan']) || empty($_POST['ruangan']) || empty($_POST['masa_kerja'])) {
        //load view with error
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('pegawai/add');
      } else {
        if ($this->pegawaiModel->add($_FILES['foto'], $_POST)) {
          setFlash('Pegawai baru berhasil ditambahkan.', 'success');
          return redirect('pegawai');
        } else {
          die('something went wrong');
        }
      }
    } else {
      $this->view('pegawai/add', $data);
    }
  }

  public function edit($id = '')
  {
    $data = [
      'title' => 'Edit Pegawai',
      'menu' => 'Data Pegawai'
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['nip']) || empty($_POST['nama']) || empty($_POST['pangkat']) || empty($_POST['ruangan'])) {
        //load view with error msg
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('pegawai/edit/' . $id);
      } else {
        //send data update to model
        if ($this->pegawaiModel->update($_POST, $id)) {
          setFlash('Data Pegawai berhasil diperbarui.', 'success');
          return redirect('pegawai');
        } else {
          die('something went wrong');
        }
      }
    } else {
      $pegawai = $this->pegawaiModel->getById($id);

      // check event available
      if ($pegawai) {

        $data['id'] = $id;
        $data['pegawai'] = $pegawai;

        $this->view('pegawai/edit', $data);
      } else {
        return redirect('pegawai');
      }
    }
  }

  public function detail($id = '')
  {
    $pegawai = $this->pegawaiModel->getById($id);

    if ($pegawai) {
      $data = [
        'title' => 'Detail Data Pegawai',
        'menu' => 'Data Pegawai',
        'pegawai' => $pegawai
      ];

      $this->view('pegawai/detail', $data);
    } else {
      return redirect('pegawai');
    }
  }

  public function delete($id = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->pegawaiModel->delete($id)) {
        setFlash('Berhasil menghapus data pegawai', 'success');
      } else {
        setFlash('Gagal menghapus data pegawai', 'danger');
      }
    } else {
      return redirect('pegawai');
    }
  }

  public function getPegawaiAjax()
  {
    //if event get posted by submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $data =  $this->pegawaiModel->getById($_POST['id']);
      echo json_encode($data);
    }
  }
}

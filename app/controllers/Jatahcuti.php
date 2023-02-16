<?php
class Jatahcuti extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    //new model instance
    $this->jatahCutiModel = $this->model('JatahCutiModel');
    $this->pegawaiModel = $this->model('PegawaiModel');
  }

  public function index()
  {
    $jatahcuti = $this->jatahCutiModel->get();

    $data = [
      'title' => 'Jatah Cuti',
      'menu' => 'Jatah Cuti',
      'jatahcuti' => $jatahcuti
    ];

    $this->view('jatah_cuti/index', $data);
  }

  public function add()
  {
    $data = [
      'title' => 'Tambah Jatah Cuti',
      'menu' => 'Jatah Cuti'
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['nip']) || empty($_POST['nama']) || empty($_POST['jabatan'])) {
        //load view with error
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('jatahcuti/add');
      } else {
        if ($this->jatahCutiModel->add($_POST)) {
          setFlash('Jatah Cuti berhasil ditambahkan.', 'success');
          return redirect('jatahcuti');
        } else {
          die('something went wrong');
        }
      }
    } else {
      $pegawai = $this->pegawaiModel->get();
      $data['pegawai'] = $pegawai;

      $this->view('jatah_cuti/add', $data);
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
      if (empty($_POST['nip']) || empty($_POST['nama'])) {
        //load view with error msg
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('jatahcuti/edit/' . $id);
      } else {
        //send data update to model
        if ($this->jatahCutiModel->update($_POST, $id)) {
          setFlash('Jatah Cuti berhasil diperbarui.', 'success');
          return redirect('jatahcuti');
        } else {
          die('something went wrong');
        }
      }
    } else {
      $jatahcuti = $this->jatahCutiModel->getById($id);

      // check event available
      if ($jatahcuti) {

        $data['id'] = $id;
        $data['jatahcuti'] = $jatahcuti;

        $this->view('jatah_cuti/edit', $data);
      } else {
        return redirect('jatahcuti');
      }
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

  public function getJatahCutiAjax()
  {
    //if event get posted by submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $data =  $this->jatahCutiModel->getByNIP($_POST['nip']);
      echo json_encode($data);
    }
  }
}

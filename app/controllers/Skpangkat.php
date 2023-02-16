<?php
class Skpangkat extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    //new model instance
    $this->usulPangkatModel = $this->model('UsulPangkatModel');
    $this->skPangkatModel = $this->model('SkPangkatModel');
  }

  public function index()
  {
    $skpangkat = $this->skPangkatModel->get();

    $data = [
      'title' => 'SK Kenaikan Pangkat',
      'menu' => 'Kenaikan Pangkat',
      'skpangkat' => $skpangkat
    ];

    $this->view('sk_pangkat/index', $data);
  }

  public function add()
  {
    $data = [
      'title' => 'Tambah SK Kenaikan Pangkat',
      'menu' => 'Kenaikan Pangkat'
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['no_sk']) || empty($_POST['tgl_sk']) || empty($_POST['usul_pangkat']) || empty($_POST['nip']) || empty($_POST['pangkat_baru']) || empty($_POST['tmt_pangkat_baru']) || empty($_POST['periode_berikutnya'])) {
        //load view with error
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('skpangkat/add');
      } else {
        if ($this->skPangkatModel->add($_FILES['file_pdf'], $_POST)) {
          setFlash('SK Kenaikan Pangkat berhasil ditambahkan.', 'success');
          return redirect('skpangkat');
        } else {
          die('something went wrong');
        }
      }
    } else {
      $usulpangkat = $this->usulPangkatModel->get();
      $data['usulpangkat'] = $usulpangkat;

      $this->view('sk_pangkat/add', $data);
    }
  }

  public function edit($id = '')
  {
    $data = [
      'title' => 'Edit SK Kenaikan Pangkat',
      'menu' => 'Kenaikan Pangkat'
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['no_sk']) || empty($_POST['tgl_sk']) || empty($_POST['nip']) || empty($_POST['pangkat_baru']) || empty($_POST['tmt_pangkat_baru']) || empty($_POST['periode_berikutnya'])) {
        //load view with error msg
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('skpangkat/edit/' . $id);
      } else {
        //send data update to model
        if ($this->skPangkatModel->update($_FILES['file_pdf'], $_POST, $id)) {
          setFlash('SK Kenaikan Pangkat berhasil diperbarui.', 'success');
          return redirect('skpangkat');
        } else {
          die('something went wrong');
        }
      }
    } else {
      $skpangkat = $this->skPangkatModel->getById($id);

      // check if available
      if ($skpangkat) {

        $data['id'] = $id;
        $data['skpangkat'] = $skpangkat;

        $this->view('sk_pangkat/edit', $data);
      } else {
        return redirect('skpangkat');
      }
    }
  }

  public function detail($id = '')
  {
    $skpangkat = $this->skPangkatModel->getById($id);

    if ($skpangkat) {
      $data = [
        'title' => 'Detail SK Kenaikan Pangkat',
        'menu' => 'Kenaikan Pangkat',
        'skpangkat' => $skpangkat
      ];

      $this->view('sk_pangkat/detail', $data);
    } else {
      return redirect('skpangkat');
    }
  }

  public function delete($id = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->skPangkatModel->delete($id)) {
        setFlash('Berhasil menghapus data sk', 'success');
      } else {
        setFlash('Gagal menghapus data sk', 'danger');
      }
    } else {
      return redirect('skpangkat');
    }
  }
}

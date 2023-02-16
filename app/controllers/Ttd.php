<?php
class Ttd extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    //new model instance
    $this->ttdModel = $this->model('TtdModel');
  }

  public function index()
  {
    $data = [
      'title' => 'Tanda Tangan Setting',
      'menu' => 'Tanda Tangan'
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if ($_POST['bagian'] == 'ketua') {
        //validate error free
        if ($_FILES['foto_ttd_ketua']['size'] == 0) {
          //load view with error
          setFlash('Form input tidak boleh kosong', 'danger');
          return redirect('ttd');
        } else {
          if ($this->ttdModel->uploadTTD($_FILES['foto_ttd_ketua'], $_POST)) {
            setFlash('Upload Tanda Tangan berhasil.', 'success');
            return redirect('ttd');
          } else {
            die('something went wrong');
          }
        }
      } else {
        //validate error free
        if ($_FILES['foto_ttd_kasubbag']['size'] == 0) {
          //load view with error
          setFlash('Form input tidak boleh kosong', 'danger');
          return redirect('ttd');
        } else {
          if ($this->ttdModel->uploadTTD($_FILES['foto_ttd_kasubbag'], $_POST)) {
            setFlash('Upload Tanda Tangan berhasil.', 'success');
            return redirect('ttd');
          } else {
            die('something went wrong');
          }
        }
      }
    } else {
      $ketua = $this->ttdModel->getKetua();
      $kasubbag = $this->ttdModel->getKasubbag();
      $data['ketua'] = $ketua;
      $data['kasubbag'] = $kasubbag;

      $this->view('ttd/index', $data);
    }
  }
}

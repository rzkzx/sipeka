<?php
class Profile extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    //new model instance
    $this->userModel = $this->model('UserModel');
    $this->pegawaiModel = $this->model('PegawaiModel');
  }

  public function index()
  {
    $data = [
      'title' => 'Profile',
      'menu' => 'Profile',
      // 'user' => $user
    ];

    if (Middleware::admin()) {
      $this->view('profile/admin', $data);
    } else {
      $pegawai = $this->pegawaiModel->getByNIP($_SESSION['nip']);
      $data['pegawai'] = $pegawai;

      $this->view('profile/user', $data);
    }
  }

  public function changePassword()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (empty($_POST['password']) || empty($_POST['newPassword']) || empty($_POST['confirmNewPassword'])) {
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('profile');
      }
      if ($_POST['newPassword'] !== $_POST['confirmNewPassword']) {
        setFlash('Konfrimasi Password Baru tidak sama', 'danger');
        return redirect('profile');
      }
      if ($this->userModel->changePassword($_POST)) {
        setFlash('Berhasil memperbarui password anda', 'success');
        return redirect('profile');
      } else {
        setFlash('Gagal memperbarui password anda', 'danger');
        return redirect('profile');
      }
    } else {
      return redirect('profile');
    }
  }

  public function changeProfileAdmin()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (empty($_POST['nama']) || empty($_POST['username'])) {
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('profile');
      }
      if ($this->userModel->changeProfileAdmin($_POST, $_FILES)) {
        setFlash('Berhasil memperbarui data anda', 'success');
        return redirect('profile');
      } else {
        setFlash('Gagal memperbarui data anda', 'danger');
        return redirect('profile');
      }
    } else {
      return redirect('profile');
    }
  }

  public function changeProfileUser()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (empty($_POST['nama']) || empty($_POST['username']) || empty($_POST['jabatan']) || empty($_POST['ruangan'])) {
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('profile');
      }
      if ($this->userModel->changeProfileUser($_POST, $_FILES)) {
        setFlash('Berhasil memperbarui data anda', 'success');
        return redirect('profile');
      } else {
        setFlash('Gagal memperbarui data anda', 'danger');
        return redirect('profile');
      }
    } else {
      return redirect('profile');
    }
  }

  public function ttd()
  {
    if (Middleware::admin()) {
      return redirect('ttd');
    } else {
      $data = [
        'title' => 'Tanda Tangan Pegawai',
        'menu' => 'Tanda Tangan'
      ];
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //validate error free
        if ($_FILES['foto_ttd']['size'] == 0) {
          //load view with error
          setFlash('Form input tidak boleh kosong', 'danger');
          return redirect('profile/ttd');
        } else {
          if ($this->pegawaiModel->uploadTTD($_FILES['foto_ttd'])) {
            setFlash('Upload Tanda Tangan berhasil.', 'success');
            return redirect('profile/ttd');
          } else {
            die('something went wrong');
          }
        }
      } else {
        $pegawai = $this->pegawaiModel->getByNIP($_SESSION['nip']);
        $data['pegawai'] = $pegawai;

        $this->view('profile/ttd', $data);
      }
    }
  }
}

<?php
class Login extends Controller
{
  public function __construct()
  {
    $this->userModel = $this->model('UserModel');
  }

  public function index()
  {
    if (Middleware::isLoggedIn()) {
      return redirect('dashboard');
    } else {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // process form
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'username' => trim($_POST['username']),
          'password' => trim($_POST['password']),
        ];

        //make sure error are empty
        if (empty($data['username']) && empty($data['password'])) {
          setFlash('Username atau Password Salah', 'danger');
          return redirect('login');
        } else {
          $loggedInUser = $this->userModel->login($data['username'], $data['password']);
          if ($loggedInUser) {
            //create session
            $this->createUserSession($loggedInUser);
          } else {
            setFlash('Username atau Password Salah', 'danger');
            return redirect('login');
          }
        }
      } else {
        //init data f f
        $data = [
          'username' => '',
          'password' => '',
        ];
        //load view
        $this->view('login/index', $data);
      }
    }
    $this->view('login/index', $data);
  }

  //setting user section variable
  public function createUserSession($user)
  {
    $_SESSION['user_id'] = $user->id;
    $_SESSION['nip'] = $user->nip_pegawai;
    $_SESSION['nama'] = $user->nama;
    $_SESSION['username'] = $user->username;
    $_SESSION['avatar'] = $user->avatar;
    $_SESSION['role'] = $user->role;
    $_SESSION['waktu_login'] = date('Y-m-d H:i:s');
    return redirect('dashboard');
  }

  //logout and destroy user session
  public function logout()
  {
    // add log user
    unset($_SESSION['user_id']);
    unset($_SESSION['nip']);
    unset($_SESSION['nama']);
    unset($_SESSION['username']);
    unset($_SESSION['avatar']);
    unset($_SESSION['role']);
    unset($_SESSION['waktu_login']);
    session_destroy();
    return redirect('login');
  }
}

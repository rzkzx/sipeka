
<?php
class UserModel
{
  private $db;
  public function __construct()
  {
    $this->db = new Database;
  }

  public function login($username, $password)
  {
    $this->db->query('SELECT * FROM users WHERE username = :username');
    $this->db->bind(':username', $username);

    $row = $this->db->single();

    $hash_password = $row->password;

    if (password_verify($password, $hash_password)) {
      return $row;
    } else {
      return false;
    }
  }

  public function getAll()
  {
    $role = 'user';

    $this->db->query('SELECT * FROM users WHERE role = :role');
    $this->db->bind(':role', $role);

    $row = $this->db->resultSet();

    return $row;
  }

  public function getAdmin()
  {
    $role = 'admin';

    $this->db->query('SELECT * FROM users WHERE role = :role');
    $this->db->bind(':role', $role);

    $row = $this->db->resultSet();

    return $row;
  }

  public function getUserById($id)
  {
    $this->db->query('SELECT * FROM users WHERE id = :id');
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }

  public function getUserByNIP($nip)
  {
    $this->db->query('SELECT * FROM users WHERE nip = :nip');
    $this->db->bind(':nip', $nip);

    $row = $this->db->single();

    return $row;
  }

  public function getByLogin()
  {
    $query = "SELECT * FROM users WHERE nip = :nip";
    $this->db->query($query);
    $this->db->bind(':nip', $_SESSION['nip']);

    $row = $this->db->single();

    return $row;
  }

  public function delete($id)
  {
    $this->db->query('DELETE FROM users WHERE id = :id');
    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function changePassword($data)
  {
    $query = "SELECT * FROM users WHERE username = :username";
    $this->db->query($query);
    $this->db->bind(':username', $_SESSION['username']);

    $user = $this->db->single();
    if ($user) {
      if (password_verify($data['password'], $user->password)) {
        $query = "UPDATE users SET password=:password WHERE username=:username";
        $this->db->query($query);
        $this->db->bind(':username', $_SESSION['username']);
        $this->db->bind(':password', password_hash($data['newPassword'], PASSWORD_DEFAULT));

        $this->db->execute();
        return $this->db->rowCount();
      } else {
        return 0;
      }
    } else {
      return 0;
    }
  }

  public function changeProfileAdmin($data, $files)
  {
    $newAvatarName = $_SESSION['avatar'];
    if ($files['avatar']['size'] > 0) {
      $file_extension = pathinfo($files['avatar']['name'], PATHINFO_EXTENSION);
      $allowed_extension = array(
        "png",
        "jpg",
        "jpeg"
      );

      if (!in_array($file_extension, $allowed_extension)) {
        return false;
      }

      $newAvatarName = rand(100, 100000) . '-' . $_SESSION['username'] . '.' . $file_extension;

      if ($files['avatar']['size'] < 5000 * 1000) {
        if ($_SESSION['avatar'] == NULL) {
          move_uploaded_file($files['avatar']['tmp_name'], "../public/assets/images/pegawai/" . $newAvatarName);
        } else {
          if (unlink("../public/assets/images/pegawai/" . $_SESSION['avatar'])) {
            move_uploaded_file($files['avatar']['tmp_name'], "../public/assets/images/pegawai/" . $newAvatarName);
          }
        }
      } else {
        return false;
      }
    }

    $query = "UPDATE users SET username=:username,nama=:nama,avatar=:avatar WHERE nip_pegawai=:nip";
    $this->db->query($query);
    $this->db->bind(':nip', $_SESSION['nip']);
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':nama', $data['nama']);
    $this->db->bind(':avatar', $newAvatarName);

    if ($this->db->execute()) {
      $_SESSION['nama'] = $data['nama'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['avatar'] = $newAvatarName;

      return true;
    } else {
      return false;
    }
  }

  public function changeProfileUser($data, $files)
  {
    $newAvatarName = $_SESSION['avatar'];
    if ($files['avatar']['size'] > 0) {
      $file_extension = pathinfo($files['avatar']['name'], PATHINFO_EXTENSION);
      $allowed_extension = array(
        "png",
        "jpg",
        "jpeg"
      );

      if (!in_array($file_extension, $allowed_extension)) {
        return false;
      }

      $newAvatarName = rand(100, 100000) . '-' . $_SESSION['username'] . '.' . $file_extension;

      if ($files['avatar']['size'] < 5000 * 1000) {
        if ($_SESSION['avatar'] == NULL) {
          move_uploaded_file($files['avatar']['tmp_name'], "../public/assets/images/pegawai/" . $newAvatarName);
        } else {
          if (unlink("../public/assets/images/pegawai/" . $_SESSION['avatar'])) {
            move_uploaded_file($files['avatar']['tmp_name'], "../public/assets/images/pegawai/" . $newAvatarName);
          }
        }
      } else {
        return false;
      }
    }

    $query = "UPDATE users SET username=:username,nama=:nama,avatar=:avatar WHERE nip_pegawai=:nip";
    $this->db->query($query);
    $this->db->bind(':nip', $_SESSION['nip']);
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':nama', $data['nama']);
    $this->db->bind(':avatar', $newAvatarName);
    $this->db->execute();

    $query = "UPDATE pegawai SET nama=:nama,jabatan=:jabatan,ruangan=:ruangan,foto=:foto WHERE nip=:nip";
    $this->db->query($query);
    $this->db->bind(':nip', $_SESSION['nip']);
    $this->db->bind(':nama', $data['nama']);
    $this->db->bind(':jabatan', $data['jabatan']);
    $this->db->bind(':ruangan', $data['ruangan']);
    $this->db->bind(':foto', $newAvatarName);

    if ($this->db->execute()) {
      $_SESSION['nama'] = $data['nama'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['avatar'] = $newAvatarName;

      return true;
    } else {
      return false;
    }
  }
}

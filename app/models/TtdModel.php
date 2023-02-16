
<?php
class TtdModel
{
  private $db;
  private $table = 'ttd';


  public function __construct()
  {
    $this->db = new Database;
  }

  // Pegawai Model
  public function get($limit = '')
  {
    if ($limit > 0) {
      $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY id DESC LIMIT ' . $limit);
    } else {
      $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY id DESC');
    }

    $result = $this->db->resultSet();

    return $result;
  }

  public function getKetua()
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE bagian = :bagian');
    $this->db->bind('bagian', 'ketua');
    $row = $this->db->single();

    return $row;
  }

  public function getKasubbag()
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE bagian = :bagian');
    $this->db->bind('bagian', 'kasubbag');
    $row = $this->db->single();

    return $row;
  }

  public function uploadTTD($file, $data)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE bagian=:bagian";
    $this->db->query($query);
    $this->db->bind('bagian', $data['bagian']);
    $ttd = $this->db->single();

    $nama_file = $ttd->ttd;
    //cek foto
    $temp = $file['tmp_name'];
    $size = $file['size'];
    if ($size > 0) {
      $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
      $allowed_extension = array(
        "png",
        "jpg",
        "jpeg"
      );

      if (!in_array($file_extension, $allowed_extension)) {
        return false;
      }

      $nama_file = $data['bagian'] . '-ttd.' . $file_extension;
      if ($size < 50000 * 1000) {
        if ($ttd->ttd == NULL) {
          move_uploaded_file($temp, "../public/assets/images/ttd/" . $nama_file);
        } else {
          if (unlink("../public/assets/images/ttd/" . $ttd->ttd)) {
            move_uploaded_file($temp, "../public/assets/images/ttd/" . $nama_file);
          }
        }
      } else {
        return 0;
      }
    } else {
      return false;
    }

    $query = "UPDATE " . $this->table . " SET ttd=:ttd WHERE bagian=:bagian";
    $this->db->query($query);
    $this->db->bind('ttd', $nama_file);
    $this->db->bind('bagian', $data['bagian']);
    $this->db->execute();

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}

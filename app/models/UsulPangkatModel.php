
<?php
class UsulPangkatModel
{
  private $db;
  private $table = 'usul_pangkat';


  public function __construct()
  {
    $this->db = new Database;
  }

  // Pegawai Model
  public function get($limit = '')
  {
    if ($limit > 0) {
      $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY id_usul_pangkat DESC LIMIT ' . $limit);
    } else {
      $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY id_usul_pangkat DESC');
    }

    $result = $this->db->resultSet();

    return $result;
  }

  public function getById($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_usul_pangkat = :id');
    $this->db->bind('id', $id);
    $row = $this->db->single();

    return $row;
  }

  public function add($file, $data)
  {
    //cek file
    $temp = $file['tmp_name'];
    $size = $file['size'];
    if ($size > 0) {
      $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
      $nama_file = rand(100, 100000) . '-' . $data['no_surat'] . '.' . $file_extension;

      if ($size < 50000 * 1000) {
        move_uploaded_file($temp, "../public/assets/files/usul_pangkat/" . $nama_file);
      } else {
        return 0;
      }
    } else {
      $nama_file = NULL;
    }

    //set datepicker to date
    $tgl_surat = date("Y-m-d", strtotime($data['tgl_surat']));
    $periode_usulan = date("Y-m-d", strtotime($data['periode_usulan']));

    //set query to database
    $query = "INSERT INTO " . $this->table . " (no_surat, tgl_surat, nip, pangkat_terakhir,tmt_pangkat_terakhir, pangkat_usulan, periode_usulan, status, file_usul_pdf) 
    VALUES (:no_surat, :tgl_surat, :nip, :pangkat_terakhir, :tmt_pangkat_terakhir, :pangkat_usulan, :periode_usulan, :status, :file_usul_pdf)";

    $this->db->query($query);
    $this->db->bind('no_surat', $data['no_surat']);
    $this->db->bind('tgl_surat', $tgl_surat);
    $this->db->bind('nip', $data['nip']);
    $this->db->bind('pangkat_terakhir', $data['pangkat_terakhir']);
    $this->db->bind('tmt_pangkat_terakhir', $data['tmt_pangkat_terakhir']);
    $this->db->bind('pangkat_usulan', $data['pangkat_usulan']);
    $this->db->bind('periode_usulan', $periode_usulan);
    $this->db->bind('status', $data['status']);
    $this->db->bind('file_usul_pdf', $nama_file);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function delete($id)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE id_usul_pangkat=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $usulpkt = $this->db->single();

    if ($usulpkt->file_usul_pdf) {
      if (unlink("../public/assets/files/usul_pangkat/" . $usulpkt->file_usul_pdf)) {
        $query = "DELETE FROM " . $this->table . " WHERE id_usul_pangkat=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
      } else {
        return false;
      }
    } else {
      $query = "DELETE FROM " . $this->table . " WHERE id_usul_pangkat=:id";
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();

      return $this->db->rowCount();
    }
  }

  public function update($file, $data, $id)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE id_usul_pangkat=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $usulpkt = $this->db->single();

    $file_name = $usulpkt->file_usul_pdf;
    if ($file['size'] > 0) {
      $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
      $file_name = rand(100, 100000) . '-' . $usulpkt->no_surat . '.' . $file_extension;

      if ($file['size'] < 10000 * 1000) {
        if ($usulpkt->file_usul_pdf == NULL) {
          move_uploaded_file($file['tmp_name'], "../public/assets/files/usul_pangkat/" . $file_name);
        } else {
          if (unlink("../public/assets/files/usul_pangkat/" . $usulpkt->file_usul_pdf)) {
            move_uploaded_file($file['tmp_name'], "../public/assets/files/usul_pangkat/" . $file_name);
          }
        }
      } else {
        return false;
      }
    }

    //set datepicker to date
    $tgl_surat = date("Y-m-d", strtotime($data['tgl_surat']));
    $periode_usulan = date("Y-m-d", strtotime($data['periode_usulan']));

    $query = "UPDATE " . $this->table . " SET no_surat=:no_surat, tgl_surat=:tgl_surat, pangkat_usulan=:pangkat_usulan, periode_usulan=:periode_usulan, file_usul_pdf=:file_usul_pdf WHERE id_usul_pangkat=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('no_surat', $data['no_surat']);
    $this->db->bind('tgl_surat', $tgl_surat);
    $this->db->bind('pangkat_usulan', $data['pangkat_usulan']);
    $this->db->bind('periode_usulan', $periode_usulan);
    $this->db->bind('file_usul_pdf', $file_name);
    $this->db->execute();

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}

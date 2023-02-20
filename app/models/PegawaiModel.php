
<?php
class PegawaiModel
{
  private $db;
  private $table = 'pegawai';
  private $table_users = 'users';


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
    $this->db->query('SELECT * FROM ' . $this->table_users . ' WHERE role = :role');
    $this->db->bind('role', 'ketua');
    $row = $this->db->single();

    if ($row) {
      $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip = :nip');
      $this->db->bind('nip', $row->nip_pegawai);
      $row = $this->db->single();

      return $row;
    } else {
      return 0;
    }
  }

  public function getById($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
    $this->db->bind('id', $id);
    $row = $this->db->single();

    return $row;
  }

  public function getByNIP($nip)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip = :nip');
    $this->db->bind('nip', $nip);
    $row = $this->db->single();

    return $row;
  }

  public function add($file, $data)
  {

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

      $nama_file = rand(100, 100000) . '-' . $data['nip'] . '.' . $file_extension;
      if ($size < 50000 * 1000) {
        move_uploaded_file($temp, "../public/assets/images/pegawai/" . $nama_file);
      } else {
        return 0;
      }
    } else {
      $nama_file = NULL;
    }

    //fungsi if else menentukan pangkat berikutnya
    $pangkat = $data['pangkat'];
    if ($pangkat == "Pengatur Muda / (II/a)") {
      $pangkat_berikutnya = 'Pengatur Muda TK I / (II/b)';
    } elseif ($pangkat == "Pengatur Muda TK I / (II/b)") {
      $pangkat_berikutnya = 'Pengatur / (II/c)';
    } elseif ($pangkat == "Pengatur / (II/c)") {
      $pangkat_berikutnya = 'March';
    } elseif ($pangkat == "Pengatur TK I / (II/d)") {
      $pangkat_berikutnya = 'Penata Muda / (III/a)';
    } elseif ($pangkat == "Penata Muda / (III/a)") {
      $pangkat_berikutnya = 'Penata Muda TK I / (III/b)';
    } elseif ($pangkat == "Penata Muda TK I / (III/b)") {
      $pangkat_berikutnya = 'Penata / (III/c)';
    } elseif ($pangkat == "Penata / (III/c)") {
      $pangkat_berikutnya = 'Penata TK I / (III/d)';
    } elseif ($pangkat == "Penata TK I / (III/d)") {
      $pangkat_berikutnya = 'Pembina / (IV/a)';
    } elseif ($pangkat == "Pembina / (IV/a)") {
      $pangkat_berikutnya = 'Pembina TK I / (IV/b)';
    } elseif ($pangkat == "Pembina TK I / (IV/b)") {
      $pangkat_berikutnya = 'Pembina Utama Muda / (IV/c)';
    } elseif ($pangkat == "Pembina Utama Muda / (IV/c)") {
      $pangkat_berikutnya = 'Pembina Utama Madya / (IV/d)';
    } elseif ($pangkat == "Pembina Utama Madya / (IV/d)") {
      $pangkat_berikutnya = 'Pembina Utama / (IV/e)';
    } elseif ($pangkat == "Pembina Utama / (IV/e)") {
      $pangkat_berikutnya = '-';
    } else {
      $pangkat_berikutnya = 'Pangkat Verikutnya tidak valid';
    }

    // set date from datepicker
    $tgl_pngktan = strtotime($data['tgl_pengangkatan']);
    $tgl_pengangkatan = date("Y-m-d", $tgl_pngktan);

    $tmt_gaji_terakhir = strtotime($data['tmt_gaji_terakhir']);
    $tmt_gajiterakhir = date("Y-m-d", $tmt_gaji_terakhir);

    $tmt_pktterakhir = strtotime($data['tmt_pangkat_terakhir']);
    $tmt_pkt_terakhir = date("Y-m-d", $tmt_pktterakhir);
    // hitung tgl naik pangkat berikutnya
    $periode_pkt_berikutnya = date('Y-m-d', strtotime($tmt_pkt_terakhir . ' + 4 years'));


    //set query to database
    $query = "INSERT INTO " . $this->table . " (nip, nama, pangkat, jabatan, ruangan, masa_kerja, tgl_pengangkatan, tmt_pkt_terakhir, pangkat_berikutnya, periode_pkt_berikutnya, tmt_gajiterakhir, foto) 
    VALUES (:nip, :nama, :pangkat, :jabatan, :ruangan, :masa_kerja, :tgl_pengangkatan, :tmt_pkt_terakhir, :pangkat_berikutnya, :periode_pkt_berikutnya, :tmt_gajiterakhir, :foto)";


    $this->db->query($query);
    $this->db->bind('nip', $data['nip']);
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('pangkat', $data['pangkat']);
    $this->db->bind('jabatan', $data['jabatan']);
    $this->db->bind('ruangan', $data['ruangan']);
    $this->db->bind('masa_kerja', $data['masa_kerja']);
    $this->db->bind('tgl_pengangkatan', $tgl_pengangkatan);
    $this->db->bind('tmt_pkt_terakhir', $tmt_pkt_terakhir);
    $this->db->bind('pangkat_berikutnya', $pangkat_berikutnya);
    $this->db->bind('periode_pkt_berikutnya', $periode_pkt_berikutnya);
    $this->db->bind('tmt_gajiterakhir', $tmt_gajiterakhir);
    $this->db->bind('foto', $nama_file);
    $this->db->execute();

    //register new user
    $role = 'user';

    $this->db->query('INSERT INTO ' . $this->table_users . ' (nip_pegawai, nama, username, password, avatar, role) VALUES (:nip_pegawai, :nama, :username, :password, :avatar, :role)');
    $this->db->bind(':nip_pegawai', $data['nip']);
    $this->db->bind(':nama', $data['nama']);
    $this->db->bind(':username', $data['nip']);
    $this->db->bind(':password', password_hash($data['nip'], PASSWORD_DEFAULT));
    $this->db->bind(':avatar', $nama_file);
    $this->db->bind(':role', $role);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function delete($id)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $pegawai = $this->db->single();

    if ($pegawai->ttd) {
      unlink("../public/assets/images/ttd/" . $pegawai->ttd);
    }
    if ($pegawai->foto) {
      if (unlink("../public/assets/images/pegawai/" . $pegawai->foto)) {
        //delete user on tabel users
        $query = "DELETE FROM " . $this->table_users . " WHERE nip_pegawai=:nip_pegawai";
        $this->db->query($query);
        $this->db->bind('nip_pegawai', $pegawai->nip);
        $this->db->execute();

        //delete pegawai on tabel pegawai
        $query = "DELETE FROM " . $this->table . " WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
      } else {
        return false;
      }
    } else {
      $query = "DELETE FROM " . $this->table . " WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();

      return $this->db->rowCount();
    }
  }

  public function update($data, $id)
  {
    //fungsi if else menentukan pangkat berikutnya
    $pangkat = $data['pangkat'];
    if ($pangkat == "Pengatur Muda / (II/a)") {
      $pangkat_berikutnya = 'Pengatur Muda TK I / (II/b)';
    } elseif ($pangkat == "Pengatur Muda TK I / (II/b)") {
      $pangkat_berikutnya = 'Pengatur / (II/c)';
    } elseif ($pangkat == "Pengatur / (II/c)") {
      $pangkat_berikutnya = 'March';
    } elseif ($pangkat == "Pengatur TK I / (II/d)") {
      $pangkat_berikutnya = 'Penata Muda / (III/a)';
    } elseif ($pangkat == "Penata Muda / (III/a)") {
      $pangkat_berikutnya = 'Penata Muda TK I / (III/b)';
    } elseif ($pangkat == "Penata Muda TK I / (III/b)") {
      $pangkat_berikutnya = 'Penata / (III/c)';
    } elseif ($pangkat == "Penata / (III/c)") {
      $pangkat_berikutnya = 'Penata TK I / (III/d)';
    } elseif ($pangkat == "Penata TK I / (III/d)") {
      $pangkat_berikutnya = 'Pembina / (IV/a)';
    } elseif ($pangkat == "Pembina / (IV/a)") {
      $pangkat_berikutnya = 'Pembina TK I / (IV/b)';
    } elseif ($pangkat == "Pembina TK I / (IV/b)") {
      $pangkat_berikutnya = 'Pembina Utama Muda / (IV/c)';
    } elseif ($pangkat == "Pembina Utama Muda / (IV/c)") {
      $pangkat_berikutnya = 'Pembina Utama Madya / (IV/d)';
    } elseif ($pangkat == "Pembina Utama Madya / (IV/d)") {
      $pangkat_berikutnya = 'Pembina Utama / (IV/e)';
    } elseif ($pangkat == "Pembina Utama / (IV/e)") {
      $pangkat_berikutnya = '-';
    } else {
      $pangkat_berikutnya = 'Pangkat Verikutnya tidak valid';
    }

    $query = "UPDATE " . $this->table . " SET nip=:nip,nama=:nama,pangkat=:pangkat,ruangan=:ruangan,pangkat_berikutnya=:pangkat_berikutnya WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('nip', $data['nip']);
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('pangkat', $data['pangkat']);
    $this->db->bind('ruangan', $data['ruangan']);
    $this->db->bind('pangkat_berikutnya', $pangkat_berikutnya);
    $this->db->execute();

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function uploadTTD($file)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE nip=:nip";
    $this->db->query($query);
    $this->db->bind('nip', $_SESSION['nip']);
    $pegawai = $this->db->single();

    $nama_file = $pegawai->ttd;
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

      $nama_file = rand(100, 100000) . '-' . $_SESSION['nip'] . '.' . $file_extension;
      if ($size < 50000 * 1000) {
        if ($pegawai->ttd == NULL) {
          move_uploaded_file($temp, "../public/assets/images/ttd/" . $nama_file);
        } else {
          if (unlink("../public/assets/images/ttd/" . $pegawai->ttd)) {
            move_uploaded_file($temp, "../public/assets/images/ttd/" . $nama_file);
          }
        }
      } else {
        return 0;
      }
    } else {
      return false;
    }

    $query = "UPDATE " . $this->table . " SET ttd=:ttd WHERE nip=:nip";
    $this->db->query($query);
    $this->db->bind('ttd', $nama_file);
    $this->db->bind('nip', $_SESSION['nip']);
    $this->db->execute();

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Laporan
  public function getJadwalPangkat($tahun)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE YEAR(periode_pkt_berikutnya)=:tahun ORDER BY periode_pkt_berikutnya ASC');
    $this->db->bind('tahun', $tahun);

    $result = $this->db->resultSet();

    return $result;
  }

  public function updateKetua($data)
  {
    $ketua = $this->getKetua();
    if ($ketua) {
      $query = "UPDATE " . $this->table_users . " SET role=:role WHERE nip_pegawai=:nip";
      $this->db->query($query);
      $this->db->bind('nip', $ketua->nip);
      $this->db->bind('role', 'user');
      $this->db->execute();
    }


    $query = "UPDATE " . $this->table_users . " SET role=:role WHERE nip_pegawai=:nip";
    $this->db->query($query);
    $this->db->bind('nip', $data['nip_ketua']);
    $this->db->bind('role', 'ketua');

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}

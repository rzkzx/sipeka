
<?php
class SkPangkatModel
{
  private $db;
  private $table = 'sk_pangkat';
  private $table_usul = 'usul_pangkat';
  private $table_pegawai = 'pegawai';


  public function __construct()
  {
    $this->db = new Database;
  }

  // Pegawai Model
  public function get($limit = '')
  {
    if ($limit > 0) {
      $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY id_pangkat DESC LIMIT ' . $limit);
    } else {
      $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY id_pangkat DESC');
    }

    $result = $this->db->resultSet();

    return $result;
  }

  public function getById($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_pangkat = :id');
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
      $nama_file = rand(100, 100000) . '-' . $data['no_sk'] . '.' . $file_extension;

      if ($size < 50000 * 1000) {
        move_uploaded_file($temp, "../public/assets/files/sk_pangkat/" . $nama_file);
      } else {
        return 0;
      }
    } else {
      $nama_file = NULL;
    }

    //set datepicker to date
    $tgl_sk = date("Y-m-d", strtotime($data['tgl_sk']));
    $tmt_pangkat_baru = date("Y-m-d", strtotime($data['tmt_pangkat_baru']));
    $periode_berikutnya = date("Y-m-d", strtotime($data['periode_berikutnya']));

    //set query to database
    $query = "INSERT INTO " . $this->table . " (id_usul_pangkat, no_sk, tgl_sk, nip, pangkat_lama, tmt_pangkat_lama, pangkat_baru, tmt_pangkat_baru, periode_berikutnya, status, file_sk_pdf) 
    VALUES (:id_usul_pangkat, :no_sk, :tgl_sk, :nip, :pangkat_lama, :tmt_pangkat_lama, :pangkat_baru, :tmt_pangkat_baru, :periode_berikutnya, :status, :file_sk_pdf)";

    $this->db->query($query);
    $this->db->bind('id_usul_pangkat', $data['usul_pangkat']);
    $this->db->bind('no_sk', $data['no_sk']);
    $this->db->bind('tgl_sk', $tgl_sk);
    $this->db->bind('nip', $data['nip']);
    $this->db->bind('pangkat_lama', $data['pangkat_lama']);
    $this->db->bind('tmt_pangkat_lama', $data['tmt_pangkat_lama']);
    $this->db->bind('pangkat_baru', $data['pangkat_baru']);
    $this->db->bind('tmt_pangkat_baru', $tmt_pangkat_baru);
    $this->db->bind('periode_berikutnya', $periode_berikutnya);
    $this->db->bind('status', $data['status']);
    $this->db->bind('file_sk_pdf', $nama_file);
    $this->db->execute();

    //update status usulan
    $query = "UPDATE " . $this->table_usul . " SET status=:status WHERE id_usul_pangkat=:id";
    $this->db->query($query);
    $this->db->bind('id', $data['usul_pangkat']);
    $this->db->bind('status', $data['status']);
    $this->db->execute();

    ////fungsi if else menentukan pangkat berikutnya
    $pangkat = $data['pangkat_baru'];
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

    //update pangkat pegawai
    $query = "UPDATE " . $this->table_pegawai . " SET pangkat=:pangkat,tgl_pengangkatan=:tgl_pengangkatan,tmt_pkt_terakhir=:tmt_pkt_terakhir,pangkat_berikutnya=:pangkat_berikutnya,periode_pkt_berikutnya=:periode_pkt_berikutnya WHERE nip=:nip";
    $this->db->query($query);
    $this->db->bind('nip', $data['nip']);
    $this->db->bind('pangkat', $data['pangkat_baru']);
    $this->db->bind('tgl_pengangkatan', $tgl_sk);
    $this->db->bind('tmt_pkt_terakhir', $tmt_pangkat_baru);
    $this->db->bind('pangkat_berikutnya', $pangkat_berikutnya);
    $this->db->bind('periode_pkt_berikutnya', $periode_berikutnya);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function delete($id)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE id_pangkat=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $skpkt = $this->db->single();

    if ($skpkt->file_sk_pdf) {
      if (unlink("../public/assets/files/sk_pangkat/" . $skpkt->file_sk_pdf)) {
        $query = "DELETE FROM " . $this->table . " WHERE id_pangkat=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
      } else {
        return false;
      }
    } else {
      $query = "DELETE FROM " . $this->table . " WHERE id_pangkat=:id";
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();

      return $this->db->rowCount();
    }
  }

  public function update($file, $data, $id)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE id_pangkat=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $skpkt = $this->db->single();

    $file_name = $skpkt->file_sk_pdf;
    if ($file['size'] > 0) {
      $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
      $file_name = rand(100, 100000) . '-' . $skpkt->no_sk . '.' . $file_extension;

      if ($file['size'] < 10000 * 1000) {
        if ($skpkt->file_sk_pdf == NULL) {
          move_uploaded_file($file['tmp_name'], "../public/assets/files/sk_pangkat/" . $file_name);
        } else {
          if (unlink("../public/assets/files/sk_pangkat/" . $skpkt->file_sk_pdf)) {
            move_uploaded_file($file['tmp_name'], "../public/assets/files/sk_pangkat/" . $file_name);
          }
        }
      } else {
        return false;
      }
    }

    //set datepicker to date
    $tgl_sk = date("Y-m-d", strtotime($data['tgl_sk']));
    $tmt_pangkat_baru = date("Y-m-d", strtotime($data['tmt_pangkat_baru']));
    $periode_berikutnya = date("Y-m-d", strtotime($data['periode_berikutnya']));

    $query = "UPDATE " . $this->table . " SET no_sk=:no_sk, tgl_sk=:tgl_sk, pangkat_baru=:pangkat_baru, tmt_pangkat_baru=:tmt_pangkat_baru, file_sk_pdf=:file_sk_pdf WHERE id_usul_pangkat=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('no_sk', $data['no_sk']);
    $this->db->bind('tgl_sk', $tgl_sk);
    $this->db->bind('pangkat_baru', $data['pangkat_baru']);
    $this->db->bind('tmt_pangkat_baru', $tmt_pangkat_baru);
    $this->db->bind('file_sk_pdf', $file_name);
    $this->db->execute();

    ////fungsi if else menentukan pangkat berikutnya
    $pangkat = $data['pangkat_baru'];
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

    //update pangkat pegawai
    $query = "UPDATE " . $this->table_pegawai . " SET pangkat=:pangkat,tgl_pengangkatan=:tgl_pengangkatan,tmt_pkt_terakhir=:tmt_pkt_terakhir,pangkat_berikutnya=:pangkat_berikutnya,periode_pkt_berikutnya=:periode_pkt_berikutnya WHERE nip=:nip";
    $this->db->query($query);
    $this->db->bind('nip', $data['nip']);
    $this->db->bind('pangkat', $data['pangkat_baru']);
    $this->db->bind('tgl_pengangkatan', $tgl_sk);
    $this->db->bind('tmt_pkt_terakhir', $tmt_pangkat_baru);
    $this->db->bind('pangkat_berikutnya', $pangkat_berikutnya);
    $this->db->bind('periode_pkt_berikutnya', $periode_berikutnya);
    $this->db->execute();

    return $this->db->rowCount();
  }

  // Laporan
  public function getDaftarPangkat($tahun)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE YEAR(tgl_sk)=:tahun ORDER BY tgl_sk ASC');
    $this->db->bind('tahun', $tahun);

    $result = $this->db->resultSet();

    return $result;
  }
}

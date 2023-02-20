
<?php
class CutiModel
{
  private $db;
  private $table = 'cuti';
  private $jatah_cuti_table = 'jatah_cuti';


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

  public function getById($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
    $this->db->bind('id', $id);
    $row = $this->db->single();

    return $row;
  }

  // Laporan
  public function getLaporanCutiTahunan($tahun)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE status=:status AND YEAR(tanggal)=:tahun ORDER BY tanggal ASC');
    $this->db->bind('status', 'DITERIMA');
    $this->db->bind('tahun', $tahun);

    $result = $this->db->resultSet();

    return $result;
  }

  public function add($data)
  {
    $tanggal = date('Y-m-d');
    $kodecuti = $tanggal . '-' . $data['nip'];

    //set datepicker to date
    $tanggal_pengajuan = date("Y-m-d", strtotime($data['tanggal']));
    $daritgl = date("Y-m-d", strtotime($data['mulai_cuti']));
    $sampaitgl = date("Y-m-d", strtotime($data['sampai_cuti']));

    //default data
    $nama_penyetuju = '';
    $nip_penyetuju =  '';
    $nama_ketua = 'ITA WIDYANINGSIH, S.H., M.H.';
    $nip_ketua = '197606172000032002';
    $status = 'USULAN';

    //set query to database
    $query = "INSERT INTO " . $this->table . " (nip, nama, masakerja, alasan, tanggal, kodecuti, jabatan, lamacuti, pakai1, pakai2, pakai3, daritgl, sampaitgl, alamat, no_telp, nama_penyetuju, nip_penyetuju, nama_ketua, nip_ketua, surat, status) 
    VALUES (:nip, :nama, :masakerja, :alasan, :tanggal, :kodecuti, :jabatan, :lamacuti, :pakai1, :pakai2, :pakai3, :daritgl, :sampaitgl, :alamat, :no_telp, :nama_penyetuju, :nip_penyetuju, :nama_ketua, :nip_ketua, :surat, :status)";

    $this->db->query($query);
    $this->db->bind('nip', $data['nip']);
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('masakerja', $data['masa_kerja']);
    $this->db->bind('alasan', $data['alasan']);
    $this->db->bind('tanggal', $tanggal_pengajuan);
    $this->db->bind('kodecuti', $kodecuti);
    $this->db->bind('jabatan', $data['jabatan']);
    $this->db->bind('lamacuti', $data['lama_cuti']);
    $this->db->bind('pakai1', $data['pakai1']);
    $this->db->bind('pakai2', $data['pakai2']);
    $this->db->bind('pakai3', $data['pakai3']);
    $this->db->bind('daritgl', $daritgl);
    $this->db->bind('sampaitgl', $sampaitgl);
    $this->db->bind('alamat', $data['alamat']);
    $this->db->bind('no_telp', $data['no_telp']);
    $this->db->bind('nama_penyetuju', $nama_penyetuju);
    $this->db->bind('nip_penyetuju', $nip_penyetuju);
    $this->db->bind('nama_ketua', $nama_ketua);
    $this->db->bind('nip_ketua', $nip_ketua);
    $this->db->bind('surat', NULL);
    $this->db->bind('status', $status);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function delete($id)
  {
    $query = "DELETE FROM " . $this->table . " WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function update($data, $id)
  {
    $query = "UPDATE " . $this->table . " SET daritgl=:daritgl, sampaitgl=:sampaitgl WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('daritgl', $data['mulai_cuti']);
    $this->db->bind('sampaitgl', $data['sampai_cuti']);
    $this->db->execute();

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function validasiketua($data, $id)
  {
    $query = "UPDATE " . $this->table . " SET validasi_ketua=:validasi_ketua WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('validasi_ketua', $data['status']);
    $this->db->execute();

    //update jatah cuti
    //get jatahcuti
    $this->db->query('SELECT * FROM ' . $this->jatah_cuti_table . ' WHERE nip = :nip');
    $this->db->bind('nip', $data['nip']);
    $jatah = $this->db->single();

    //set var date
    $sisa1 = $jatah->sisa1 - $data['pakai1'];
    $sisa2 = $jatah->sisa2 - $data['pakai2'];
    $sisa3 = $jatah->sisa3 - $data['pakai3'];
    $totalcuti = $jatah->totalcuti + $data['lama_cuti'];

    //set query
    $query = "UPDATE " . $this->jatah_cuti_table . " SET sisa1=:sisa1, sisa2=:sisa2, sisa3=:sisa3, totalcuti=:totalcuti WHERE nip=:nip";
    $this->db->query($query);
    $this->db->bind('nip', $data['nip']);
    $this->db->bind('sisa1', $sisa1);
    $this->db->bind('sisa2', $sisa2);
    $this->db->bind('sisa3', $sisa3);
    $this->db->bind('totalcuti', $totalcuti);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function validasiadmin($data, $id)
  {
    $query = "UPDATE " . $this->table . " SET validasi_admin=:validasi_admin WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('validasi_admin', $data['status']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}

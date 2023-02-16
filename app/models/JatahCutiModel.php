
<?php
class JatahCutiModel
{
  private $db;
  private $table = 'jatah_cuti';


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

  public function getByNIP($nip)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip = :nip');
    $this->db->bind('nip', $nip);
    $row = $this->db->single();

    return $row;
  }

  public function add($data)
  {
    //set query to database
    $query = "INSERT INTO " . $this->table . " (nip, nama, sisa1, sisa2, sisa3) 
    VALUES (:nip, :nama, :sisa1, :sisa2, :sisa3)";

    $this->db->query($query);
    $this->db->bind('nip', $data['nip']);
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('sisa1', $data['sisa1']);
    $this->db->bind('sisa2', $data['sisa2']);
    $this->db->bind('sisa3', $data['sisa3']);
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
    $query = "UPDATE " . $this->table . " SET sisa1=:sisa1,sisa2=:sisa2,sisa3=:sisa3 WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('sisa1', $data['sisa1']);
    $this->db->bind('sisa2', $data['sisa2']);
    $this->db->bind('sisa3', $data['sisa3']);
    $this->db->execute();

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}

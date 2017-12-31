<?PHP
class Fenomenos extends model {

  public function getLista() {

    $array = array();

    $sql = $this->db->query("SELECT * FROM sistemas");
    if($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }

    return $array;
  }
}
?>

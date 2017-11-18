<?PHP
class Meteoros extends model {

  public function getLista() {

    $array = array();

    $sql = $this->db->query("SELECT * FROM usuarios WHERE funcao = 'Meteorologista'");
    if($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }

    return $array;
  }
}
?>

<?PHP
class Tecnicos extends model {

  public function getLista() {

    $array = array();

    $sql = $this->db->query("SELECT * FROM usuarios WHERE funcao = 'Tecnico'");
    if($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }

    return $array;
  }
}
?>

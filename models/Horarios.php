<?PHP
class Horarios extends model {

  public function getHorarios() {

    $array = array();

    $sql = $this->db->query("SELECT * FROM horarios");
    if($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }

    return $array;
  }
}
?>

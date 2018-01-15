<?PHP
class Sistemas extends model {

  public function getLista() {

    $array = array();

    $sql = $this->db->query("SELECT * FROM sistemas_list");
    if($sql->rowCount() > 0) {
      $array['sistemas_list'] = $sql->fetchAll();
    }

    $array['sistemas_class'] = array("Sinótico", "Mesoescala", "Fenômenos");

    return $array;
  }
}
?>

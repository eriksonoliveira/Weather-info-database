<?PHP 
class Categorias extends model {
  
  public function getLista() {

    $array = array();

    $sql = $this->db->query("SELECT * FROM categorias");
    if($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }

    return $array;
  }

    public function getListaDesc() {

    $array = array();

    $sql = $this->db->query("SELECT * FROM cat_descricao");
    if($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }

    return $array;
  }
}
?>

<?PHP 
class Categorias extends model {
  
  public function getLista() {

    $array = array(
      "met" => array(
        "superficie", "medios_altos", "condicao_tempo"
      ),
      "tec" => array(
        "metar", "ocorrencias"
      ),
      "info" => array(
        "general_info"
      ),
      "img" => array(
        "im_sinotica", "im_satelite", "sondagem", "altos_niveis", "medios_niveis"
      ),
      "phenom" => array(
        "sinótico", "mesoescala", "fenômenos"
      )
    );

    /*$sql = $this->db->query("SELECT * FROM categorias");
    if($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }*/

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

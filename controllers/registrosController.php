<?PHP
class registrosController extends controller{
  
  public function ver($dateParams) {
    $data = array(
      'success' => '',
      'title' => 'Ver registro'
    );
    
    if($dateParams) {
      $dateSplit = explode('-', $dateParams);
      $dateFormated = $dateSplit[2].'-'.$dateSplit[1].'-'.$dateSplit[0];

      $data['day'] = addslashes($dateParams);
      $data['dateFormated'] = $dateFormated;

      if(empty($_SESSION['cLogin'])) {
        header('Location: '.BASE_URL.'login');
        exit;
      }

      $horarios = array('00','06','12','18');

      $imagens = array();
      $descricao = array();

      //Pegar categorias
      $c = new Categorias();
      $categs = $c->getLista();
      $categs_desc = $c->getListaDesc();

      $data['cats'] = $categs;

      //Pegar nomes sistemas
      $s = new Sistemas();
      $sist = $s->getLista();

      $data['sistemas'] = $sist['sistemas_list'];
      $data['sistemas_classes'] = $sist['sistemas_class'];

      //Nomes Meteorologistas
      $m = new Meteoros();
      $mets = $m->getLista();

      $data['mets'] = $mets;

      //Nomes Tecnicos
      $t = new Tecnicos();
      $tecs = $t->getLista();

      $data['tecs'] = $tecs;

      //Pegar horarios
      $h = new Horarios();
      $hs = $h->getHorarios();

      $data['horario'] = $hs;


      //Load view
//      $this->loadTemplate('read-registro', $data);
      $this->loadTemplate('add-registro', $data);
    }

  }
}
?>

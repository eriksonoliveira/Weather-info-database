<?PHP
class adicionarController extends controller{
  
  public function index() {

  }
  
  public function registro() {
    if(empty($_SESSION['cLogin'])) {
      header("Location: ".BASE_URL."login");
      exit;
    }

    $data = array(
      "success" => '',
      'title' => 'Ver registro'
    );
    
    $horarios = array("00","06","12","18");

    $imagens = array();
    $descricao = array();

    //Pegar Data do dia
    $date = time();
    $d_form_BR = date("d/m/Y", $date);
    $d_form_Int = date("Y/m/d", $date);
    $data['dia'] = $d_form_BR;

    //Pegar categorias
    $c = new Categorias();
    $categs = $c->getLista();

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
    
    //LOADS TEMPLATE
    $this->loadTemplate('add-registro', $data);
    
  }
  
}
?>

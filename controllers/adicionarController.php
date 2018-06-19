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

    //Get date and converto to Brazilian format
    $date = time();
    $d_form_BR = date("d-m-Y", $date);
    $d_form_Int = date("Y-m-d", $date);
    $data['dateFormated'] = $d_form_BR;

    $data['day'] = $d_form_Int;

    //Get names categories
    $c = new Categorias();
    $categs = $c->getLista();

    $data['cats'] = $categs;

    //Get names systems
    $s = new Sistemas();
    $sist = $s->getLista();

    $data['sistemas'] = $sist['sistemas_list'];
    $data['sistemas_classes'] = $sist['sistemas_class'];

    //Get names Met
    $m = new Meteoros();
    $mets = $m->getLista();

    $data['mets'] = $mets;

    //Get names Tec
    $t = new Tecnicos();
    $tecs = $t->getLista();

    $data['tecs'] = $tecs;

    //Get hours
    $h = new Horarios();
    $hs = $h->getHorarios();

    $data['horario'] = $hs;
    
    //LOADS TEMPLATE
    $this->loadTemplate('add-registro', $data);
    
  }
  
}
?>

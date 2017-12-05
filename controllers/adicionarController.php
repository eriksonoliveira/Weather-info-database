<?PHP
class adicionarController extends controller{
  
  public function index() {

  }
  
  public function registro() {
    $data = array(
      "success" => ''
    );
    
    $horarios = array("00","06","12","18");

    $imagens = array();
    $descricao = array();

    if(empty($_SESSION['cLogin'])) {
      header("Location: ".BASE_URL."login");
      exit;
    }

    //Pegar Data do dia
    $date = time();
    $d_form_BR = date("d/m/Y", $date);
    $d_form_Int = date("Y/m/d", $date);
    $data['dia'] = $d_form_BR;

    //Pegar categorias
    $c = new Categorias();
    $categs = $c->getLista();
    $categs_desc = $c->getListaDesc();

    $data['cats'] = $categs;

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
    
    //Pegar registros do dia atual que já foram feitos
/*    $r = new Registros;
    $data['currDayReg'] = $r->getRegistro($d_form_Int, $hs);

    print_r($data['currDayReg']);*/

    $this->loadTemplate('add-registro', $data);
    
  }
  
}
?>

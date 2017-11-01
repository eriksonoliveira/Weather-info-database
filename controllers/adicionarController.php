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
/*
    $a = new Registros();
    if(isset($_POST['titulo']) && !empty($_POST['titulo'])) {
      $titulo = addslashes($_POST['titulo']);
      $categoria = addslashes($_POST['categoria']);
      $valor = addslashes($_POST['valor']);
      $descricao = addslashes($_POST['descricao']);
      $estado = addslashes($_POST['estado']);
      if(isset($_FILES['fotos'])) {
        $fotos = $_FILES['fotos'];
      } else {
        $fotos = array();
      }*/
    //Pegar categorias
    $c = new Categorias();
    $cats = $c->getLista();
    $cats_desc = $c->getListaDesc();

    $data['cats'] = $cats;

    //Nomes Meteorologistas
    $m = new Meteoros();
    $mets = $m->getLista();

    $data['mets'] = $mets;

    //Nomes Tecnicos
    $t = new Tecnicos();
    $tecs = $t->getLista();

    $data['tecs'] = $tecs;


    $r = new Registros();

    if(isset($_POST['adicionar'])) {

      //Get images uploaded and save them in $imagens array
      foreach($cats as $key) {
        $cat_name = $key['nome'];
        foreach($horarios as $h) {
          if(isset($_FILES["{$cat_name}{$h}"]) &&
             !empty($_FILES["{$cat_name}{$h}"])) {
            $imagens[$cat_name][$h.'Z'] =  $_FILES["{$cat_name}{$h}"];
          }
          foreach($cats_desc as $cn) {
            if(isset($_POST["{$cat_name}_meteoro_{$cn['nome']}{$h}"]) &&
               !empty($_POST["{$cat_name}_meteoro_{$cn['nome']}{$h}"])) {

              $descricao[$cat_name]['meteoro'][$h.'Z'][$cn['nome']] =  $_POST["{$cat_name}_meteoro_{$cn['nome']}{$h}"];

              $descricao[$cat_name]['meteoro'][$h.'Z']['nome'] = $_POST["{$cat_name}_meteoro_nome{$h}"];
            }
          }
          foreach($cats_desc as $cn) {
            if(isset($_POST["{$cat_name}_tec_{$cn['nome']}{$h}"]) &&
               !empty($_POST["{$cat_name}_tec_{$cn['nome']}{$h}"])) {
              $descricao[$cat_name]['tec'][$h.'Z'][$cn['nome']] =  $_POST["{$cat_name}_tec_{$cn['nome']}{$h}"];

              $descricao[$cat_name]['tec'][$h.'Z']['nome'] = $_POST["{$cat_name}_tec_nome{$h}"];
            }
          }
        }
      }

      print_r($descricao);
/*
      if(isset($_FILES['fotos'])) {
        $fotos = $_FILES['fotos'];
        print_r($fotos['name']);
      } else {
        $fotos = array();
      }

      /*$r->addAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos);

      $data['success'] = "<div class='alert alert-success'>Produto adicionado com sucesso!</div>";*/
    }
    


    $this->loadTemplate('add-registro', $data);
    
  }
  
}
?>

<?PHP 
class editarController extends controller {
  
  public function index() {
    
  }
  
  public function anuncio($id) {
    $data = array(
      "success" => ""
    );
    
    if(empty($_SESSION['cLogin'])) {
      header("Location: ".BASE_URL."login");
      exit;
    }

    $a = new Anuncios();
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
      }

      $a->editAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $id);


    $data['success'] = "<div class='alert alert-success'>Produto editado com sucesso!</div>";

    }

    if(isset($id) && !empty($id)) {
      $id = addslashes($id);
      $info = $a->getAnuncio($id);
    } else {
      header("Location: ".BASE_URL."login");
      exit;
    }
    
    $c = new Categorias();
    $cats = $c->getLista();
    
    $data['info'] = $info;
    $data['cats'] = $cats;
    
    $this->loadTemplate('editar-anuncio', $data);
  }
  
}


?>
<?PHP
class adicionarController extends controller{
  
  public function index() {

  }
  
  public function registro() {
    $data = array(
      "success" => ''
    );
    
    if(empty($_SESSION['cLogin'])) {
      header("Location: ".BASE_URL."login");
      exit;
    }

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
      }

      $a->addAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos);

      $data['success'] = "<div class='alert alert-success'>Produto adicionado com sucesso!</div>";
    }
    
    $c = new Categorias();
    $cats = $c->getLista();
    
    $data['cats'] = $cats;

    $this->loadTemplate('add-registro', $data);
    
  }
  
}
?>
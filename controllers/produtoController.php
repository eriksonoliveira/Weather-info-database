<?PHP
class produtoController extends controller{
  
  public function index() {
        
  }
  
  public function abrir($id) {
    $data = array();
    
    $a = new Anuncios();
    $u = new Usuarios();

    if(empty($id)) {
      header('Location: '.BASE_URL);
      exit;
    }

    $info = $a->getAnuncio($id);
    
    $data['info'] = $info;

    $this->loadTemplate('produto', $data);
  }
  
}
?>
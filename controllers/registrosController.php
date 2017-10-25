<?PHP
class anunciosController extends controller{
  
  public function index() {
    $data = array();

    $a = new Anuncios();
    
    $anuncios = $a->getMeusAnuncios();
    
    $data['anuncios'] = $anuncios;
    
    $this->loadTemplate('anuncios', $data);
  
  }
}
?>
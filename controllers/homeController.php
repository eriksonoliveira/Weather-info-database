<?PHP 

class homeController extends controller {
  
  public function index() {
    if(empty($_SESSION['cLogin'])) {
      header("Location: ".BASE_URL."login");
      exit;
    }

    $data = array();
    
    $a = new Registros();
    $u = new Usuarios();
    $c = new Categorias();

    $filtros = array(
      'categoria' => '',
      'valor' => '',
      'estado' => ''
    );
    if(isset($_GET['filtros'])) {
      $filtros = $_GET['filtros'];
    }

    $total_anuncios = $a->getTotalAnuncios($filtros);
    $total_usuarios = $u->getTotalUsuarios();
    $categorias = $c->getLista();

    $p = 1;
    if(isset($_GET['p']) && !empty($_GET['p'])) {
      $p = addslashes($_GET['p']);
    }

    $por_pagina = 2;
    $total_paginas = ceil($total_anuncios/$por_pagina);

    $anuncios = $a->getUltimosAnuncios($p, $por_pagina, $filtros);
    
    $data['filtros'] = $filtros;
    $data['total_anuncios'] = $total_anuncios;
    $data['total_usuarios'] = $total_usuarios;
    $data['anuncios'] = $anuncios;
    $data['categorias'] = $categorias;
    $data['total_paginas'] = $total_paginas;
    $data['p'] = $p;
    
    $this->loadTemplate('home', $data);
  }
  
}

?>

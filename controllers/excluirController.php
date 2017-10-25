<?PHP 
class excluirController extends controller {
  
  public function anuncio($id) {
    if(empty($_SESSION['cLogin'])) {
      header("Location: ".BASE_URL."login");
      exit;
    }

    $a = new Anuncios();

    if(isset($id) && !empty($id)) {
      $id = addslashes($id);
      $a->excluirAnuncio($id);
    }

    header("Location: ".BASE_URL."anuncios");
  }
  
  public function foto($id) {
     
    if(empty($_SESSION['cLogin'])) {
      header("Location: login.php");
      exit;
    }

    $a = new Anuncios();

    if(isset($id) && !empty($id)) {
      $id = addslashes($id);
      $id_anuncio = $a->excluirFoto($id);
    }

    if(isset($id_anuncio)) {
      header("Location: ".BASE_URL."editar/anuncio/".$id_anuncio);
    } else {
      header("Location: ".BASE_URL."anuncios");
    }
  }
  
}


?>
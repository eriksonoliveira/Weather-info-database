<?PHP

class ajaxController extends controller {

  public function index() {
    $data = array();

    if (isset($_POST['horario']) && !empty($_POST['horario'])) {
      $data['horario'] = $_POST['horario'];
      $data['categoria'] = $_POST['categoria'];
    }

    if(isset($_FILES['imagem'])) {
      $imagem = $_FILES['imagem'];

      move_uploaded_file($imagem['tmp_name'], 'assets/images/'.$imagem['name']);

      $data['url_img'] = 'http://localhost/projetoy/Monitoramento/assets/images/'.$imagem['name'];
    }

    echo json_encode($data);
    exit;
  }

}

?>

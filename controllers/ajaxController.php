<?PHP

class ajaxController extends controller {

  public function index() {
    $data = array(
      "success" => ""
    );

    //HORARIO E CATEGORIA
    if (isset($_POST['horario']) && !empty($_POST['horario'])) {
      $data['horario'] = $_POST['horario'];
      $data['categoria'] = $_POST['categoria'];
    }

    //IMAGEM
    if(isset($_FILES['imagem'])) {
      $imagem = $_FILES['imagem'];

      /*move_uploaded_file($imagem['tmp_name'], 'assets/images/'.$imagem['name']);

      $data['url_img'] = 'http://localhost/projetoy/Monitoramento/assets/images/'.$imagem['name'];
*/    }

    //DATA
    $date = time();
    $d_form_Int = date("Y/m/d", $date);
    $data['date'] = $d_form_Int;

    //Envia para o bando de dados
    $r = new Registros();
    $r->addImagem($imagem, $data['horario'], $data['categoria'], $data['date']);

    //SUCCESS
    $data['success'] = "yes";

    echo json_encode($data);
    exit;
  }

}

?>

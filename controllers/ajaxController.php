<?PHP

class ajaxController extends controller {

  public function index() {
    $data = array(
      "success" => ""
    );

    //DATA
    $date = time();
    $d_form_Int = date("Y/m/d", $date);
    $data['date'] = $d_form_Int;

    //IMAGEM
    if(isset($_FILES['imagem'])) {
      $imagem = $_FILES['imagem'];

      $data['horario'] = $_POST['horario'];
      $data['categoria'] = $_POST['categoria'];

      //Envia para o bando de dados
      $r = new Registros();
      $r->addImagem($imagem, $data['horario'], $data['categoria'], $data['date']);

      //SUCCESS
      $data['success'] = "yes";

    }

    //TEXTO
    if(isset($_POST['texto']) && !empty($_POST['texto'])) {
      $data['texto'] = addslashes($_POST['texto']);

      $data['horario'] = $_POST['horario'];
      $data['categoria'] = $_POST['categoria'];
      $data['id_nome'] = $_POST['id_nome'];
      $data['cargo'] = $_POST['cargo'];

      //Envia para o bando de dados
      $r = new Registros();
      $r->addTexto($data['texto'], $data['horario'], $data['categoria'], $data['date'], $data['id_nome'], $data['cargo']);

      //SUCCESS
      $data['success'] = "yes";

    }


    echo json_encode($data);
    exit;
  }

}

?>

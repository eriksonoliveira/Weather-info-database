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

    //HORARIOS
    $h = new Horarios();
    $hs = $h->getHorarios();

    //RECEBE DADOS DO DIA ATUAL
    if(isset($_POST['date']) && !empty($_POST['date'])) {

      $r = new Registros;
      $data['currDayReg'] = $r->getRegistro($d_form_Int, $hs);

      $data['success'] = "yes";
    }

    //ADICIONA IMAGEM
    if(isset($_FILES['imagem'])) {
      $imagem = $_FILES['imagem'];

      $data['horario'] = $_POST['horario'];
      $data['categoria'] = $_POST['categoria'];

      //Envia para o bando de dados
      $r = new Registros();
      $imgID = $r->addImagem($imagem, $data['horario'], $data['categoria'], $data['date']);

      //SUCCESS
      $data['success'] = "yes";
      $data['imgId'] = $imgID;

    }

    //DELETA IMAGEM
    if(isset($_POST['imgID']) && !empty($_POST['imgID'])) {

      $id = substr($_POST['imgID'], 4);

      $r = new Registros();
      $r->delImagem($id);

      $data['success'] = "yes";
    }

    //ADICIONA TEXTO
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

    //ATUALIZA TEXTO
    if(isset($_POST['update-texto']) && !empty($_POST['update-texto'])) {
      $data['texto'] = addslashes($_POST['update-texto']);

      $data['horario'] = $_POST['update-horario'];
      $data['categoria'] = $_POST['update-categoria'];
      $data['id_nome'] = $_POST['update-id_nome'];
      $data['cargo'] = $_POST['update-cargo'];

      //Envia para o bando de dados
      $r = new Registros();
      $r->updateTexto($data['texto'], $data['horario'], $data['categoria'], $data['date'], $data['id_nome'], $data['cargo']);

      //SUCCESS
      $data['success'] = "yes";

    }


    echo json_encode($data);
    exit;
  }

}

?>

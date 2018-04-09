<?PHP

class ajaxController extends controller {
  public function __construct() {
    $this->data = array(
      "date" => "",
      "success" => ""
    );
  }

  public function index() {

    /*****DATA*****/
    /*$date = time();
    $d_form_Int = date("Y/m/d", $date);
    $this->data['date'] = $d_form_Int;*/

    //RECEBE DADOS DO DIA ATUAL
    if(isset($_POST['date']) && !empty($_POST['date'])) {
      $this->data['date'] = addslashes($_POST['date']);

      $r = new Registros;
      $this->data['currDayReg'] = $r->getRegistro($this->data['date']);

      $this->data['success'] = "yes";
    }

    //ADICIONA IMAGEM
    if(isset($_FILES['imagem'])) {
      $imagem = $_FILES['imagem'];
      $this->data['date'] = $_POST['date'];

      $this->data['horario'] = $_POST['horario'];
      $this->data['categoria'] = $_POST['categoria'];

      //Envia para o bando de dados
      $r = new Registros();
      $imgID = $r->addImagem($imagem, $this->data['horario'], $this->data['categoria'], $this->data['date']);

      //Success
      $this->data['success'] = "yes";
      $this->data['imgId'] = $imgID;

    }

    //DELETA IMAGEM
    if(isset($_POST['imgID']) && !empty($_POST['imgID'])) {

      $id = substr($_POST['imgID'], 4);

      $r = new Registros();
      $r->delImagem($id);

      $this->data['success'] = "yes";
    }

    //ADICIONA TEXTO
    if(isset($_POST['texto']) && !empty($_POST['texto'])) {
      $this->data['texto'] = addslashes($_POST['texto']);
      $this->data['horario'] = $_POST['horario'];
      $this->data['categoria'] = $_POST['categoria'];
      $this->data['id_nome'] = $_POST['id_nome'];
      $this->data['cargo'] = $_POST['cargo'];
      $this->data['date'] = $_POST['date'];

      //Envia para o bando de dados
      $r = new Registros();
      $r->addTexto($this->data['texto'], $this->data['horario'], $this->data['categoria'], $this->data['date'], $this->data['id_nome'], $this->data['cargo']);

      //Success
      $this->data['success'] = "yes";

    }

    //ATUALIZA TEXTO
    if(isset($_POST['update-texto']) && !empty($_POST['update-texto'])) {
      $this->data['texto'] = addslashes($_POST['update-texto']);

      $this->data['horario'] = $_POST['update-horario'];
      $this->data['categoria'] = $_POST['update-categoria'];
      $this->data['id_nome'] = $_POST['update-id_nome'];
      $this->data['cargo'] = $_POST['update-cargo'];
      $this->data['date'] = $_POST['update-date'];

      //Envia para o bando de dados
      $r = new Registros();
      $r->updateTexto($this->data['texto'], $this->data['horario'], $this->data['categoria'], $this->data['date'], $this->data['id_nome'], $this->data['cargo']);

      //Success
      $this->data['success'] = "yes";

    }


    //SENDS DATA IN JSON FORMAT
    echo json_encode($this->data);
    exit;
  }

  public function sendTags() {
    //ENVIA TAGS DOS SISTEMAS DO DIA
    if(isset($_POST['systemId']) && !empty($_POST['systemId'])) {
      $id = $_POST['systemId'];
      $this->data['date'] = $_POST['date'];

      //Envia para o bando de dados
      $r = new Registros();
      $r->addSystem($id, $this->data['date']);
    }

    //SEND DATA IN JSON FORMAT
    echo json_encode($this->data);
    exit;
  }

  //UPDATE FORGOT PASSWORD
  public function pass_forgot() {
    $this->data = array(
      'confirmation' => ''
    );

    $u = new Usuarios();

    if(isset($_POST['email']) && !empty($_POST['email'])) {
      $email = addslashes($_POST['email']);

      //If the email existis in the database, send the recovery message
      $user_id = $u->hasUser($email);
      if($user_id) {

        //Generate the code
        $code = md5(time().rand(0, 9999).rand(0, 9999));

        //Insert into the database
        $u->insertRecovCode($code, $user_id['id']);

        //SEND MAIL
        $m = new Mail();

        $msg = "Email de recuperação de senha do sistema de Monitoramento Meteorológico.\r\n
        Utilize este link para redefinir a sua senha: <a href='".BASE_URL."password/recover/?code=".$code."'>".BASE_URL."password/recover/?code=".$code."</a>.";

        $m->sendMail($email, $msg);

//        $this->data['confirmation'] = "Utilize <a href='".BASE_URL."password/recover/?code=".$code."'>este link</a> para redefinir a sua senha.";
        $this->data['confirmation'] = "Um email com um link para recuperação de senha foi enviado para o seu e-mail ".$email.".";
      } else {
        $this->data['confirmation'] = "<div class='alert alert-danger'>Usuario não cadastrado!</div>";
      }

      //SENDS DATA IN JSON FORMAT
      echo json_encode($this->data);
      exit;
    }
  }

  public function pass_recovery() {
    $this->data = array(
      'confirmation' => ''
    );

    if(isset($_POST['newPass']) && !empty($_POST['newPass'])) {
      $newPass = md5($_POST['newPass']);
      $id = addslashes($_POST['userID']);

      $u = new Usuarios();

      $updated = $u->updatePass($newPass, $id);

      if($updated) {
        $this->data['confirmation'] = "Senha atualizada com sucesso!</br>
        Faça o <a href='".BASE_URL."/login'>login</a>";
      }

      echo json_encode($this->data);
      exit;
    }
  }

}

?>























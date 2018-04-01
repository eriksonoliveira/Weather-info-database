<?PHP

class ajaxController extends controller {

  public function index() {
    $data = array(
      "date" => "",
      "success" => ""
    );

    /*****DATA*****/
    /*$date = time();
    $d_form_Int = date("Y/m/d", $date);
    $data['date'] = $d_form_Int;*/

    //RECEBE DADOS DO DIA ATUAL
    if(isset($_POST['date']) && !empty($_POST['date'])) {
      $data['date'] = addslashes($_POST['date']);

      $r = new Registros;
      $data['currDayReg'] = $r->getRegistro($data['date']);

      $data['success'] = "yes";
    }

    //ADICIONA IMAGEM
    if(isset($_FILES['imagem'])) {
      $imagem = $_FILES['imagem'];
      $data['date'] = $_POST['date'];

      $data['horario'] = $_POST['horario'];
      $data['categoria'] = $_POST['categoria'];

      //Envia para o bando de dados
      $r = new Registros();
      $imgID = $r->addImagem($imagem, $data['horario'], $data['categoria'], $data['date']);

      //Success
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
      $data['date'] = $_POST['date'];

      //Envia para o bando de dados
      $r = new Registros();
      $r->addTexto($data['texto'], $data['horario'], $data['categoria'], $data['date'], $data['id_nome'], $data['cargo']);

      //Success
      $data['success'] = "yes";

    }

    //ATUALIZA TEXTO
    if(isset($_POST['update-texto']) && !empty($_POST['update-texto'])) {
      $data['texto'] = addslashes($_POST['update-texto']);

      $data['horario'] = $_POST['update-horario'];
      $data['categoria'] = $_POST['update-categoria'];
      $data['id_nome'] = $_POST['update-id_nome'];
      $data['cargo'] = $_POST['update-cargo'];
      $data['date'] = $_POST['update-date'];

      //Envia para o bando de dados
      $r = new Registros();
      $r->updateTexto($data['texto'], $data['horario'], $data['categoria'], $data['date'], $data['id_nome'], $data['cargo']);

      //Success
      $data['success'] = "yes";

    }

    //ENVIA TAGS DOS SISTEMAS DO DIA
    if(isset($_POST['systemId']) && !empty($_POST['systemId'])) {
      $id = $_POST['systemId'];
      $data['date'] = $_POST['date'];

      //Envia para o bando de dados
      $r = new Registros();
      $r->addSystem($id, $data['date']);
    }

    //SENDS DATA IN JSON FORMAT
    echo json_encode($data);
    exit;
  }

  //UPDATE FORGOT PASSWORD
  public function pass_forgot() {
    $data = array(
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

//        $data['confirmation'] = "Utilize <a href='".BASE_URL."password/recover/?code=".$code."'>este link</a> para redefinir a sua senha.";
        $data['confirmation'] = "Um email com um link para recuperação de senha foi enviado para o seu e-mail ".$email.".";
      } else {
        $data['confirmation'] = "<div class='alert alert-danger'>Usuario não cadastrado!</div>";
      }

      //SENDS DATA IN JSON FORMAT
      echo json_encode($data);
      exit;
    }
  }

  public function pass_recovery() {
    $data = array(
      'confirmation' => ''
    );

    if(isset($_POST['newPass']) && !empty($_POST['newPass'])) {
      $newPass = md5($_POST['newPass']);
      $id = addslashes($_POST['userID']);

      $u = new Usuarios();

      $updated = $u->updatePass($newPass, $id);

      if($updated) {
        $data['confirmation'] = "Senha atualizada com sucesso!</br>
        Faça o <a href='".BASE_URL."/login'>login</a>";
      }

      echo json_encode($data);
      exit;
    }
  }

}

?>























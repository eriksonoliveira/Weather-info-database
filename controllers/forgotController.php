<?PHP
class forgotController extends controller{

  public function index() {
    $data = array(
      'alert' => '',
      'title' => 'Esqueci a senha'
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

        //FALTA CONFIGURAR O ENVIO DE EMAIL COM O LINK E A PÁGINA PARA ATUALIZAÇÃO DA SENHA


        echo "Utilize este link para redefinir a sua senha:</br><a>".$code."</a>";
      } else {
        $data['alert'] = "<div class='alert alert-danger'>Usuario não cadastrado!</div>";
      }
    }

    $this->loadTemplate('forgot', $data);
  }
}
?>

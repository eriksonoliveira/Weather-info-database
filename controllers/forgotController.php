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
      $senha = $_POST['senha'];

      if($u->login($email, $senha)) {
        header('Location: '.BASE_URL);
      } else {
        $data['alert'] = "<div class='alert alert-danger'>Usuario e/ou senha errados</div>";
      }
    }

    $this->loadTemplate('forgot', $data);
  }
}
?>

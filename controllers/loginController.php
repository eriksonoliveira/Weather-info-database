<?PHP
class loginController extends controller{
  
  public function index() {
    ob_start();
    if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) {
      header('Location: '.BASE_URL);
    }

    $data = array(
      'alert' => '',
      'title' => 'Login'
    );

    $u = new Usuarios();

    if(isset($_POST['email']) && !empty($_POST['email'])) {
      $email = addslashes($_POST['email']);
      $senha = md5($_POST['senha']);

      if($u->login($email, $senha)) {
        header('Location: '.BASE_URL);
        exit;
      } else {
        $data['alert'] = '<div class="alert alert-danger">Usuario e/ou senha errados</div>';
      }
    }
    
    $this->loadTemplate('login', $data);
    ob_end_flush();
  }
  
  public function sair() {

    unset($_SESSION['cLogin']);
    header('Location: '.BASE_URL);
  
  }
}
?>

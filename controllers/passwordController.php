<?PHP
class passwordController extends controller{
  public function __construct() {
    $this->data = array(
      'title' => ''
    );
  }

  //LOAD FORGOT PASSWORD VIEW
  public function forgot() {
    $this->data['title'] = 'Esqueci a senha';

    $this->loadTemplate('forgot', $this->data);
  }

  //RECOVER PASSWORD
  public function recover() {
    $this->data['title'] = 'Recuperar a senha';

    if(isset($_GET['code'])) {
      $code = addslashes($_GET['code']);

      //Check if recovery code is valid
      $u = new Usuarios();
      $check = $u->checkRecovCode($code);

      if($check) {
        $this->data['id'] = $check['id_usuario'];
        $this->data['checked'] = true;

      } else {
        $this->data['checked'] = false;
      }
    }

    $this->loadTemplate('recover', $data);
  }
}
?>

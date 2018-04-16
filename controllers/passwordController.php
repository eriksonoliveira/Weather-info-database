<?PHP
class passwordController extends controller{

  public function forgot() {
    $data = array(
      'title' => 'Esqueci a senha'
    );

    $this->loadTemplate('forgot', $data);
  }

  //RECOVER PASSWORD
  public function recover() {
    $data = array(
      'title' => 'Recuperar a senha'
    );

    if(isset($_GET['code'])) {
      $code = addslashes($_GET['code']);

      $u = new Usuarios();

      $check = $u->checkRecovCode($code);
      if($check) {
        $id = $check['id_usuario'];

        $data['html'] = "
          <div class='card-title'>
            <h2>Digite a sua nova senha</h2>
          </div>
          <form method='POST' class='pass-recov-form'>
            <div class='form-group'>
              <label>Nova senha:</label>
              <input type='password'  class='form-control' name='password1' data-id='".$id."'/>
              </br>
              <label>Repita a senha:</label>
              <input type='password'  class='form-control' name='password2'/>
              </br>
              <button type='submit' class='btn blue'>Atualizar senha</button>
            </div>
          </form>
        ";
      } else {
        $data['html'] = "<h1>O link é inválido ou a solicitação expirou.</h2>";
      }
    }

    $this->loadTemplate('recover', $data);
  }
}
?>

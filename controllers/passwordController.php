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

        <h2>Digite a sua nova senha</h2>
        <form method='POST' class='pass-recov-form'>
          <label>Nova senha:</label>
          <input type='password' name='password1' data-id='".$id."'/>
          </br>
          <label>Repita a senha:</label>
          <input type='password' name='password2'/>
          </br>
          <button type='submit'>Atualizar senha</button>
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

<?PHP
class cadastrarController extends controller{
  
  public function index() {
    $data = array(
      'success' => '',
      'failure' => '',
      'warning' => ''
    );

    $u = new Usuarios();
    
    if(isset($_POST['nome']) && !empty($_POST['nome'])) {
      $nome = addslashes($_POST['nome']);
      $email = addslashes($_POST['email']);
      $senha = $_POST['senha'];
      $funcao = addslashes($_POST['funcao']);

      if(!empty($nome) && !empty($email) && !empty($senha)) {

        if($u->cadastrar($nome, $email, $senha, $funcao)) { 

          $data['success'] = "<div class='alert alert-success'>
            <strong>Parabéns!</strong> Cadastrado com sucesso. <a href='".BASE_URL."login' class='alert-link'>Faça o login agora</a>
          </div>";
             
        } else {
          
          $data['failure'] = "<div class='alert alert-warning'>
            Este usuário já existe. <a href='".BASE_URL."login' class='alert-link'>Faça o login agora</a>
          </div>";
             
        }

      } else {
      
        $data['warning'] = "<div class='alert alert-warning'>
          Preencha todos os campos
        </div>";
         
      }

    }

    
    $this->loadTemplate('cadastrar', $data);
  
  }
}
?>
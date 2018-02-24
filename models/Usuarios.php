<?PHP 
class Usuarios extends model {
  
  public function getTotalUsuarios() {
    
    $sql = $this->db->query("SELECT COUNT(*) as conta FROM usuarios");
    $row = $sql->fetch();
    
    return $row['conta'];
  }
  
  public function cadastrar($nome, $email, $senha, $funcao) {
    
    
    //verifica se este email já foi cadastrado
/*    $sql = $this->db->prepare("SELECT id FROM usuarios WHERE email = :email");
    $sql->bindValue(":email", $email);
    $sql->execute();
    
    if($sql->rowCount() == 0) {*/
    if($this->hasUser($email) == false) {
      
      $sql = $this->db->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, senha = :senha, funcao = :funcao");
      $sql->bindValue(":nome", $nome);
      $sql->bindValue(":email", $email);
      $sql->bindValue(":senha", md5($senha));
      $sql->bindValue(":funcao", $funcao);
      $sql->execute();
      
      return true;
      
    } else {
      return false;
    }
  }
  
  public function login($email, $senha) {
    
    $sql = $this->db->prepare("SELECT id, nome FROM usuarios WHERE email = :email AND senha = :senha");
    $sql->bindValue(':email', $email);
    $sql->bindValue(':senha', md5($senha));
    $sql->execute();
    
    if($sql->rowCount() > 0) {
      $dado = $sql->fetch();
      $_SESSION['cLogin'] = $dado['id'];
      $_SESSION['nome-usuario'] = $dado['nome'];
      
      return true;
    } else {
      return false;
    }
  }

  //verifica se este email já foi cadastrado
  public function hasUser($email) {
    $sql = $this->db->prepare("SELECT id FROM usuarios WHERE email = :email");
    $sql->bindValue(":email", $email);
    $sql->execute();

    if($sql->rowCount() == 0) {
      return false;
    } else {
      $sql = $sql->fetch(PDO::FETCH_ASSOC);
      $array = array(
        "id" => $sql["id"]
      );

      return $array;
    }
  }

  public function insertRecovCode($code, $id) {
    $sql = $this->db->prepare("INSERT INTO password_codes (id_usuario, code, expire_on) VALUES (:id_usuario, :code, :expire_on)");
    $sql->bindValue(":id_usuario", $id);
    $sql->bindValue(":code", $code);
    $sql->bindValue(":expire_on", date("Y-m-d H:i", strtotime("+2 hours")));
    $sql->execute();
  }
}
?>

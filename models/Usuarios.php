<?PHP 
class Usuarios extends model {
  
  public function getTotalUsuarios() {
    
    $sql = $this->db->query("SELECT COUNT(*) as conta FROM usuarios");
    $row = $sql->fetch();
    
    return $row['conta'];
  }
  
  public function cadastrar($nome, $email, $senha, $funcao) {
    
    
    //verifica se este email já foi cadastrado
    $sql = $this->db->prepare("SELECT id FROM usuarios WHERE email = :email");
    $sql->bindValue(":email", $email);
    $sql->execute();
    
    if($sql->rowCount() == 0) {
      
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
}
?>
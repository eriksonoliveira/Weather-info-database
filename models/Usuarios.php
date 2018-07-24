<?PHP 
class Usuarios extends model {
  
  public function getTotalUsuarios() {
    
    $sql = $this->db->query("SELECT COUNT(*) as conta FROM usuarios");
    $row = $sql->fetch();
    
    return $row['conta'];
  }
  
  public function getLista() {

    $array = array();

    $sql = $this->db->query("SELECT * FROM usuarios ORDER BY nome");
    if($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    return $array;
  }

  public function getListaTable($page, $users_per_page) {

    $array = array();
    $p = new Pagination();

    $sql1 = $this->db->query("SELECT * FROM usuarios ORDER BY nome");

    $total_pages = $p->getTotalPages($sql1, $users_per_page);
    $start_item = $p->getStart($page, $users_per_page);

    $sql2 = $this->db->query("SELECT * FROM usuarios ORDER BY nome LIMIT ".$start_item.", ".$users_per_page);
    if($sql2->rowCount() > 0) {
      $array['data'] = $sql2->fetchAll(PDO::FETCH_ASSOC);
      $array['num_pages'] = $total_pages;
    }

    return $array;
  }

  public function cadastrar($nome, $email, $senha, $funcao, $permissoes) {

    if($this->hasUser($email) == false) {
      
      $sql = $this->db->prepare("INSERT INTO usuarios (nome, email, senha, funcao, permissoes) VALUES (:nome, :email, :senha, :funcao, :permissoes)");
      $sql->bindValue(":nome", $nome);
      $sql->bindValue(":email", $email);
      $sql->bindValue(":senha", md5($senha));
      $sql->bindValue(":funcao", $funcao);
      $sql->bindValue(":permissoes", $permissoes);
      $sql->execute();
      
      return true;
      
    } else {
      return false;
    }
  }
  
  public function login($email, $senha) {
    
    $sql = $this->db->prepare("SELECT id, nome, permissoes FROM usuarios WHERE email = :email AND senha = :senha");
    $sql->bindValue(':email', $email);
    $sql->bindValue(':senha', $senha);
    $sql->execute();
    
    if($sql->rowCount() > 0) {
      $dado = $sql->fetch();
      $_SESSION['cLogin'] = $dado['id'];
      $_SESSION['nome-usuario'] = $dado['nome'];
      $_SESSION['permission'] = $dado['permissoes'];
      
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

  //INSERT PASSWORD RECOVER CODE, USER ID AND EXPIRE TIME INTO DB
  public function insertRecovCode($code, $id) {
    $sql = $this->db->prepare("INSERT INTO password_codes (id_usuario, code, expire_on) VALUES (:id_usuario, :code, :expire_on)");
    $sql->bindValue(":id_usuario", $id);
    $sql->bindValue(":code", $code);
    $sql->bindValue(":expire_on", date("Y-m-d H:i", strtotime("+2 hours")));
    $sql->execute();
  }

  //CHECK IF THE CODE EXISTS AND IF IT IS STILL VALID
  public function checkRecovCode($code) {
    $sql = $this->db->prepare("SELECT * FROM password_codes WHERE code = :code AND used = 0 AND expire_on > NOW()");
    $sql->bindValue(":code", $code);
    $sql->execute();

    if($sql->rowCount() > 0) {
      $sql = $sql->fetch(PDO::FETCH_ASSOC);

      $qry = $this->db->prepare("UPDATE password_codes SET used = 1 WHERE code = :code");
      $qry->bindValue(":code", $code);
      $qry->execute();

      return $sql;
    } else {
      return false;
    }
  }

  public function updatePass($newPass, $id) {
    $sql = $this->db->prepare("UPDATE usuarios SET senha = :senha WHERE id = :id");
    $sql->bindValue(":senha", $newPass);
    $sql->bindValue(":id", $id);
    $sql->execute();

    return true;
  }

  public function getInfo($id) {
    $array = array();

    $sql = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id ORDER BY nome");
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0) {
      $array = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $array;
  }

  public function updateInfo($name, $id, $email, $permission) {
    $sql = $this->db->prepare("UPDATE usuarios SET nome = :nome, email = :email, permissoes = :permissoes WHERE id = :id");
    $sql->bindValue(":nome", $name);
    $sql->bindValue(":email", $email);
    $sql->bindValue(":permissoes", $permission);
    $sql->bindValue(":id", $id);
    $sql->execute();

    return true;
  }
}

?>

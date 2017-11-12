<?PHP 
class Registros extends model {
  
  public function getTotalAnuncios($filtros) {
    
    
    $filtrostring = array('1=1');
    if(!empty($filtros['categoria'])) {
      $filtrostring[] = 'anuncios.id_categoria = :id_categoria';
    }
    if(!empty($filtros['valor'])) {
      $filtrostring[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
    }    
    if(!empty($filtros['estado'])) {
      $filtrostring[] = 'anuncios.estado = :estado';
    }
    
    $sql = $this->db->prepare("SELECT COUNT(*) as conta FROM anuncios WHERE ".implode(" AND ", $filtrostring));
    
    if(!empty($filtros['categoria'])) {
      $sql->bindValue(":id_categoria", $filtros['categoria']);
    }
    if(!empty($filtros['valor'])) {
      $preco = explode('-', $filtros['valor']);
      $sql->bindValue(":preco1", $preco[0]);
      $sql->bindValue(":preco2", $preco[1]);
    }    
    if(!empty($filtros['estado'])) {
      $sql->bindValue(":estado", $filtros['estado']);
    }
    $sql->execute();
    
    $row = $sql->fetch();
    
    return $row['conta'];
  }
  
  public function getUltimosAnuncios($page, $items_per_page, $filtros) {
    
    
    $offset = ($page - 1) * $items_per_page;
    
    $array = array();
    
    $filtrostring = array('1=1');
    if(!empty($filtros['categoria'])) {
      $filtrostring[] = 'anuncios.id_categoria = :id_categoria';
    }
    if(!empty($filtros['valor'])) {
      $filtrostring[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
    }    
    if(!empty($filtros['estado'])) {
      $filtrostring[] = 'anuncios.estado = :estado';
    }
    
    $sql = $this->db->prepare("SELECT *,
      (select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url,
      (select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria
      FROM anuncios WHERE ".implode(' AND ', $filtrostring)." ORDER BY id DESC LIMIT $offset, $items_per_page");
    
    if(!empty($filtros['categoria'])) {
      $sql->bindValue(":id_categoria", $filtros['categoria']);
    }
    if(!empty($filtros['valor'])) {
      $preco = explode('-', $filtros['valor']);
      $sql->bindValue(":preco1", $preco[0]);
      $sql->bindValue(":preco2", $preco[1]);
    }    
    if(!empty($filtros['estado'])) {
      $sql->bindValue(":estado", $filtros['estado']);
    }
    
    $sql->execute();
    
    if($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }
    
    return $array;
  }
  
  public function getMeusAnuncios() {
    
    
    $array = array();
    $sql = $this->db->prepare("SELECT *,
      (select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url
      FROM anuncios WHERE id_usuario = :id_usuario");
    $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
    $sql->execute();
    
    if($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }
    
    return $array;
  }
  
  public function getAnuncio($id) {
    
    $array = array();
    
    $sql = $this->db->prepare("SELECT 
    *,
    (select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria,
    (select usuarios.telefone from usuarios where usuarios.id = anuncios.id_usuario) as telefone
    FROM anuncios WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();
    
    if($sql->rowCount() > 0) {
      $array = $sql->fetch();
      $array['fotos'] = array();
      
      $sql= $this->db->prepare('SELECT id,url FROM anuncios_imagens WHERE id_anuncio = :id_anuncio');
      $sql->bindValue(":id_anuncio", $id);
      $sql->execute();
      
      if($sql->rowCount() > 0) {
        $array['fotos'] = $sql->fetchAll();
      }
    }
    
    return $array;
  }
  
  private function addImagem($imagem, $id) {
    
    
    if(count($imagem) > 0) {
      for($q=0;$q<count($imagem['tmp_name']);$q++) {
        $tipo = $imagem['type'][$q];
        if(in_array($tipo, array('image/jpeg', 'image/png'))) {
          $tmpname = md5(time().rand(0, 9999)).'jpg';
          move_uploaded_file($imagem['tmp_name'][$q], 'assets/images/anuncios/'.$tmpname);
          
          list($width_orig, $height_orig) = getimagesize('assets/images/anuncios/'.$tmpname);
          $ratio = $width_orig/$height_orig;
          
          $width = 500;
          $height = 500;
          
          if($width/$height > $ratio) {
            $width = $height * $ratio;
          } else {
            $height = $width / $ratio;
          }
          
          $img = imagecreatetruecolor($width, $height);
          if($tipo == 'image/jpeg') {
            $origi = imagecreatefromjpeg('assets/images/anuncios/'.$tmpname);
          } elseif($tipo == 'image/png') {
            $origi = imagecreatefrompng('assets/images/anuncios/'.$tmpname);
          }
          
          imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
          
          imagejpeg($img, 'assets/images/anuncios/'.$tmpname, 80);
          
          $sql = $this->db->prepare("INSERT INTO anuncios_imagens SET id_anuncio = :id_anuncio, url = :url");
          $sql->bindValue(":id_anuncio", $id);
          $sql->bindValue(":url", $tmpname);
          $sql->execute();
        }
      }
    }
  }
  
  public function addRegistro($descricao, $imagens, $day) {
    
    //Verifica se a mesma data já não foi inserida
    $sql = $this->db->prepare("SELECT id FROM diario WHERE data = :data");
    $sql->bindValue(":data", $day);
    $sql->execute();
    
    if($sql->rowCount() == 0) {
    
      $sql = $this->db->prepare("INSERT INTO diario SET data = :data");
      $sql->bindValue(":data", $day);
      $sql->execute();

      /*$lastId = $this->db->lastInsertId();

      $this->addFotos($imagens, $lastId);*/
    }
    
  }
  public function editAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $id) {
    
    
    $sql = $this->db->prepare("UPDATE anuncios SET titulo = :titulo, id_categoria = :id_categoria, id_usuario = :id_usuario, descricao = :descricao, valor = :valor, estado = :estado WHERE id = :id");
    
    $sql->bindValue(":titulo", $titulo);
    $sql->bindValue(":id_categoria", $categoria);
    $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
    $sql->bindValue(":descricao", $descricao);
    $sql->bindValue(":valor", $valor);
    $sql->bindValue(":estado", $estado);
    $sql->bindValue(":id", $id);
    $sql->execute();   
    
    $this->addFotos($fotos, $id);
    
  }
  
  
  public function excluirAnuncio($id) {
    
    
    $sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
    $sql->bindValue(":id_anuncio", $id);
    $sql->execute();
        
    $sql = $this->db->prepare("DELETE FROM anuncios WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();
    
    
  }

  public function excluirFoto($id) {
    

    $id_anuncio = 0;

    $sql = $this->db->prepare("SELECT id_anuncio FROM anuncios_imagens WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0) {
      $row = $sql->fetch();
      $id_anuncio = $row['id_anuncio'];
    }

    $sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

    return $id_anuncio;
  }
}
?>

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


  //Retorna registros de texto e imagem para o dia solicitado
  public function getRegistro($date, $horarios) {
    
    $array = array(
      "met" => array(),
      "tec" => array(),
      "img" => array()
    );
    
    foreach($horarios as $key => $value) {
      
      //Descrição sinótica - Meteorologista
      $sql = $this->db->prepare("SELECT texto, id_meteoro, cat_descricao FROM descricao_meteoro WHERE date = :date AND horario = :horario");
      $sql->bindValue(":date", $date);
      $sql->bindValue(":horario", $value['hora']);
      $sql->execute();

      if($sql->rowCount() > 0) {
        $resp = $sql->fetchAll();

        foreach($resp as $respKey => $respVal) {
        $descrCat = $respVal['cat_descricao'];

        $array["met"][$value["hora"]][$descrCat]['text'] = $respVal['texto'];
        $array["met"][$value["hora"]][$descrCat]['id_met'] = $respVal['id_meteoro'];

        }

      }

      //Registros Significativos - Tecnico
      $sql = $this->db->prepare("SELECT texto, id_tec, cat_descricao FROM descricao_tec WHERE date = :date AND horario = :horario");
      $sql->bindValue(":date", $date);
      $sql->bindValue(":horario", $value['hora']);
      $sql->execute();

      if($sql->rowCount() > 0) {
        $resp = $sql->fetchAll();

        foreach($resp as $respKey => $respVal) {
        $descrCat = $respVal['cat_descricao'];

        $array["tec"][$value["hora"]][$descrCat]['text'] = $respVal['texto'];
        $array["tec"][$value["hora"]][$descrCat]['id_tec'] = $respVal['id_tec'];

        }

      }

      //Imagens
      $sql = $this->db->prepare("SELECT id, url, categoria FROM imagens WHERE date = :date AND horario = :horario ");
      $sql->bindValue(":date", $date);
      $sql->bindValue(":horario", $value['hora']);
      $sql->execute();

      if($sql->rowCount() > 0) {

        $resp = $sql->fetchAll();

        foreach($resp as $respKey => $respVal) {
          $imgCat = $respVal['categoria'];

          $array['img'][$value['hora']][$imgCat]['fileName'] = $respVal['url'];
          $array['img'][$value['hora']][$imgCat]['id'] = $respVal['id'];
        }
      }
    }
    return $array;
  }
  
  //Inserir nova imagem de registro
  public function addImagem($imagem, $horario, $categoria, $date) {
    
    $imgID = '';
    
    if(count($imagem) > 0) {

      /*não usa FOR pois o upload é limitado a apenas uma imagem*/
      /*for($q=0;$q<count($imagem['tmp_name']);$q++) { */
        $tipo = $imagem['type'];

        if(in_array($tipo, array('image/jpeg', 'image/png'))) {
          $tmpname = md5(time().rand(0, 9999)).'.jpg';
          move_uploaded_file($imagem['tmp_name'], 'assets/images/'.$categoria.'/'.$tmpname);
          
          list($width_orig, $height_orig) = getimagesize('assets/images/'.$categoria.'/'.$tmpname);
          $ratio = $width_orig/$height_orig;
          
          $width = 600;
          $height = 600;
          
          if($width/$height > $ratio) {
            $width = $height * $ratio;
          } else {
            $height = $width / $ratio;
          }
          
          $img = imagecreatetruecolor($width, $height);
          if($tipo == 'image/jpeg') {
            $origi = imagecreatefromjpeg('assets/images/'.$categoria.'/'.$tmpname);
          } elseif($tipo == 'image/png') {
            $origi = imagecreatefrompng('assets/images/'.$categoria.'/'.$tmpname);
          }
          
          imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
          
          imagejpeg($img, 'assets/images/'.$categoria.'/'.$tmpname, 80);
          
          $sql = $this->db->prepare("INSERT INTO imagens SET url = :url, categoria = :categoria, horario = :horario, date = :date");
          $sql->bindValue(":url", $tmpname);
          $sql->bindValue(":categoria", $categoria);
          $sql->bindValue(":horario", $horario);
          $sql->bindValue(":date", $date);
          $sql->execute();

          $imgID = $this->db->lastInsertId();

        }
      //}
    }
    return $imgID;
  }

  //Deletar imagem de registro
  public function delImagem($id) {

    $sql = $this->db->prepare("DELETE FROM imagens WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

  }
  
  //Inserir novo texto de registro
  public function addTexto($texto, $horario, $categoria, $date, $id_nome, $cargo) {
    
    $sql = '';
    
    if($cargo == "meteoro") {
      $sql = $this->db->prepare("INSERT INTO descricao_meteoro SET texto = :texto, horario = :horario, cat_descricao = :categoria, date = :date, id_meteoro = :id_nome");
    } else if($cargo == "tec") {
      $sql = $this->db->prepare("INSERT INTO descricao_tec SET texto = :texto, horario = :horario, cat_descricao = :categoria, date = :date, id_tec = :id_nome");

    }

    $sql->bindValue(":texto", $texto);
    $sql->bindValue(":horario", $horario);
    $sql->bindValue(":categoria", $categoria);
    $sql->bindValue(":date", $date);
    $sql->bindValue(":id_nome", $id_nome);
    $sql->execute();

  }

  //Atualizar texto de registro
  public function updateTexto($texto, $horario, $categoria, $date, $id_nome, $cargo) {

    $sql = '';

    if($cargo == "meteoro") {
      $sql = $this->db->prepare("UPDATE descricao_meteoro SET texto = :texto, id_meteoro = :id_nome WHERE horario = :horario AND date = :date AND cat_descricao = :categoria");
    } else if($cargo == "tec") {
      $sql = $this->db->prepare("UPDATE descricao_tec SET texto = :texto, id_tec = :id_nome WHERE horario = :horario AND date = :date AND cat_descricao = :categoria");

    }

    $sql->bindValue(":texto", $texto);
    $sql->bindValue(":horario", $horario);
    $sql->bindValue(":categoria", $categoria);
    $sql->bindValue(":date", $date);
    $sql->bindValue(":id_nome", $id_nome);
    $sql->execute();
    
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

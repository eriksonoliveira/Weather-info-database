<?PHP 
class Registros extends model {

  //Pesquisa registros dentro das datas especificadas e que contém os fenômenos especificados
  public function searchRegistry($start, $end, $systems, $page, $items_per_page) {
    $array = array(
      "data" => array(),
      "chart" => array()
    );

    $p = new Pagination();

    //If the search includes weather phenomena
    if(!empty($systems)) {
      $len = count($systems);

      //If the user selected more than one phenomena
      if($len > 1) {
        $filter = array();

        foreach($systems as $k => $v) {
          $filter[] = "id_sistema = :sistema_".$v['key'];
        }

        //Get total pages
        $sql1 = $this->db->prepare("
        SELECT DISTINCT date
        FROM sistemas
        WHERE date BETWEEN :date1 AND :date2 AND date IN (
          SELECT date
          FROM sistemas
          WHERE ".implode(" OR ", $filter)."
          GROUP BY date
          HAVING COUNT(*) >= $len )
        ");
        $sql1->bindValue(":date1", $start);
        $sql1->bindValue(":date2", $end);
        foreach($systems as $k => $v) {
          $sql1->bindValue(":sistema_".$v['key'], $v['key']);
        }

        //Get number of pages necessary for pagination
        $total_pages = $p->getTotalPages($sql1, $items_per_page);
        //Get first item of page
        $start_item = $p->getStart($page, $items_per_page);

        //Get the data limited by $items_per_page
        $sql2 = $this->db->prepare("
        SELECT DISTINCT date
        FROM sistemas
        WHERE date BETWEEN :date1 AND :date2 AND date IN (
          SELECT date
          FROM sistemas
          WHERE ".implode(" OR ", $filter)."
          GROUP BY date
          HAVING COUNT(*) >= $len )
          ORDER BY sistemas.date LIMIT ".$start_item.", ".$items_per_page
        );
        $sql2->bindValue(":date1", $start);
        $sql2->bindValue(":date2", $end);
        foreach($systems as $k => $v) {
          $sql2->bindValue(":sistema_".$v['key'], $v['key']);
        }
        $sql2->execute();

        //Insert results into $array
        if($sql2->rowCount() > 0) {
          $array["data"] = $sql2->fetchAll(PDO::FETCH_ASSOC);
          $array['num_pages'] = $total_pages;
        }

        //Get total of dates
        $sql3 = $this->db->prepare("
        SELECT DATE_FORMAT(sistemas.date, '%Y-%m') as month, COUNT(DISTINCT sistemas.date) AS count
        FROM sistemas
        WHERE sistemas.date BETWEEN :date1 AND :date2
        AND sistemas.date IN (
          SELECT date
          FROM sistemas
          WHERE ".implode(" OR ", $filter)."
          GROUP BY date
          HAVING COUNT(*) >= $len )
        GROUP BY DATE_FORMAT(sistemas.date, '%Y-%m')
        ");
        $sql3->bindValue(":date1", $start);
        $sql3->bindValue(":date2", $end);
        foreach($systems as $k => $v) {
          $sql3->bindValue(":sistema_".$v['key'], $v['key']);
        }
        $sql3->execute();

        //Insert results into $array
        if($sql3->rowCount() > 0) {
           $array["chart"] = $sql3->fetchAll(PDO::FETCH_ASSOC);
        }

      } else {
      //IF THE USER SELECTED ONLY ONE PHENOMENON

        //Get number of pages
        $sql1 = $this->db->prepare("
        SELECT DISTINCT date
        FROM sistemas
        WHERE sistemas.date BETWEEN :date1 AND :date2 AND id_sistema = :sistema");
        $sql1->bindValue(":date1", $start);
        $sql1->bindValue(":date2", $end);
        $sql1->bindValue(":sistema", $systems[0]['key']);

        $total_pages = $p->getTotalPages($sql1, $items_per_page); //Number of pages
        $start_item = $p->getStart($page, $items_per_page); //Item the DB query starts from

        //Get dates
        $sql2 = $this->db->prepare("
        SELECT DISTINCT date
        FROM sistemas
        WHERE sistemas.date BETWEEN :date1 AND :date2 AND id_sistema = :sistema
        ORDER BY sistemas.date LIMIT ".$start_item.", ".$items_per_page);
        $sql2->bindValue(":date1", $start);
        $sql2->bindValue(":date2", $end);
        $sql2->bindValue(":sistema", $systems[0]['key']);
        $sql2->execute();

        //Insert results into $array
        if($sql2->rowCount() > 0) {
          $array["data"] = $sql2->fetchAll(PDO::FETCH_ASSOC);
          $array['num_pages'] = $total_pages;
        }

        //Get total of dates
        $sql2 = $this->db->prepare("
        SELECT DATE_FORMAT(sistemas.date, '%Y-%m') as month, COUNT(*) AS count
        FROM sistemas
        WHERE sistemas.date BETWEEN :date1 AND :date2
        AND sistemas.id_sistema = :sistema
        GROUP BY DATE_FORMAT(sistemas.date, '%Y-%m')
        ");
        $sql2->bindValue(":date1", $start);
        $sql2->bindValue(":date2", $end);
        $sql2->bindValue(":sistema", $systems[0]['key']);
        $sql2->execute();

        //Insert results into $array
        if($sql2->rowCount() > 0) {
           $array["chart"] = $sql2->fetchAll(PDO::FETCH_ASSOC);
        }

      }
    } else {
      //If no phenomena was selected

      //Get total of pages
      $sql1 = $this->db->prepare("
      SELECT DISTINCT date
      FROM descricao_meteoro
      WHERE descricao_meteoro.date BETWEEN :date1 AND :date2
      UNION
      SELECT DISTINCT date
      FROM descricao_tec
      WHERE descricao_tec.date BETWEEN :date1 AND :date2
      UNION
      SELECT DISTINCT date
      FROM imagens
      WHERE imagens.date BETWEEN :date1 AND :date2
      UNION
      SELECT DISTINCT date
      FROM sistemas
      WHERE sistemas.date BETWEEN :date1 AND :date2");
      $sql1->bindValue(":date1", $start);
      $sql1->bindValue(":date2", $end);

      $total_pages = $p->getTotalPages($sql1, $items_per_page);
      $start_item = $p->getStart($page, $items_per_page);

      //Get Results limited by $items_per_page
      $sql2 = $this->db->prepare(
      "SELECT DISTINCT date
      FROM descricao_meteoro
      WHERE descricao_meteoro.date BETWEEN :date1 AND :date2
      UNION
      SELECT DISTINCT date
      FROM descricao_tec
      WHERE descricao_tec.date BETWEEN :date1 AND :date2
      UNION
      SELECT DISTINCT date
      FROM imagens
      WHERE imagens.date BETWEEN :date1 AND :date2
      UNION
      SELECT DISTINCT date
      FROM sistemas
      WHERE sistemas.date BETWEEN :date1 AND :date2
      ORDER BY date ASC LIMIT ".$start_item.", ".$items_per_page);
      $sql2->bindValue(":date1", $start);
      $sql2->bindValue(":date2", $end);
      $sql2->execute();

      if($sql2->rowCount() > 0) {
        $array["data"] = $sql2->fetchAll(PDO::FETCH_ASSOC);
        $array['num_pages'] = $total_pages;
      }
    }

    //Get meteorological data for the returned dates
    if(!empty($array["data"])) {
      for($i = 0; $i < count($array["data"]); $i++) {
        $array["data"][$i]["info"] = $this->getRegistro($array["data"][$i]["date"]);
      }
    }

    return $array;
  }

  //Retorna registros de texto e imagem para o dia solicitado
  public function getRegistro($date) {
    $array = array(
      "met" => array(),
      "tec" => array(),
      "img" => array(),
      "phenom" => array()
    );
    
    //HORARIOS
    $h = new Horarios();
    $horarios = $h->getHourOnly();

    //CATEGORIES
    $c = new Categorias();
    $categories = $c->getLista();

    /*CREATE STRUCTURE FOR THE RESPONSE ARRAY*/
    foreach($horarios as $hour) {
      extract($hour);

      //Description from meteorologist
      foreach($categories['met'] as $category) {
        $array['met'][$hora][$category] = array("id" => '', "text" => '');
      }
      //Description from technician
      foreach($categories['tec'] as $category) {
        $array['tec'][$hora][$category] = array("id" => '', "text" => '');
      }
      //General info
      foreach($categories['info'] as $category) {
        $array['info'] = array("text" => '');
      }
      //Images
      foreach($categories['img'] as $category) {
        $array['img'][$hora][$category] = array("id" => '', "fileName" => '');
      }
      //Phenomena
      foreach($categories['phenom'] as $category) {
        $array['phenom'][$category] = array();
      }
      
      //Descrição sinótica - Meteorologista
      $sql = $this->db->prepare("SELECT texto, id_meteoro, cat_descricao FROM descricao_meteoro WHERE date = :date AND horario = :horario");
      $sql->bindValue(":date", $date);
      $sql->bindValue(":horario", $hora);
      $sql->execute();

      if($sql->rowCount() > 0) {
        $resp = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($resp as $respKey => $respVal) {
          extract($respVal);

          $array["met"][$hora][$cat_descricao]['text'] = $texto;
          $array["met"][$hora][$cat_descricao]['id'] = $id_meteoro;

        }

      }

      //Registros Significativos - Tecnico
      $sql = $this->db->prepare("SELECT texto, id_tec, cat_descricao FROM descricao_tec WHERE date = :date AND horario = :horario");
      $sql->bindValue(":date", $date);
      $sql->bindValue(":horario", $hora);
      $sql->execute();

      if($sql->rowCount() > 0) {
        $resp = $sql->fetchAll();

        foreach($resp as $respKey => $respVal) {
          extract($respVal);

          $array["tec"][$hora][$cat_descricao]['text'] = $texto;
          $array["tec"][$hora][$cat_descricao]['id'] = $id_tec;

        }

      }

      //Informações gerais
      $sql = $this->db->prepare("SELECT texto FROM info_geral WHERE date = :date");
      $sql->bindValue(":date", $date);
      $sql->execute();

      if($sql->rowCount() > 0) {
        $resp = $sql->fetchAll();

        foreach($resp as $respKey => $respVal) {
          extract($respVal);

          $array["info"]['text'] = $texto;
        }

      }

      //Imagens
      $sql = $this->db->prepare("SELECT id, url, categoria FROM imagens WHERE date = :date AND horario = :horario ");
      $sql->bindValue(":date", $date);
      $sql->bindValue(":horario", $hora);
      $sql->execute();

      if($sql->rowCount() > 0) {

        $resp = $sql->fetchAll();

        foreach($resp as $respKey => $respVal) {
          $imgCat = $respVal['categoria'];

          $array['img'][$hora][$imgCat]['fileName'] = $respVal['url'];
          $array['img'][$hora][$imgCat]['id'] = $respVal['id'];
        }
      }
    }

    //Tags de fenômenos
    $sql = $this->db->prepare("SELECT id_sistema, (select sistemas_list.nome from sistemas_list where sistemas_list.id = sistemas.id_sistema) as syst, (select sistemas_list.class from sistemas_list where sistemas_list.id = sistemas.id_sistema) as class FROM sistemas WHERE date = :date ORDER BY CLASS");
    $sql->bindValue(":date", $date);
    $sql->execute();

    if($sql->rowCount() > 0) {
      $resp = $sql->fetchAll();

      for($i=0; $i < count($resp); $i++) {

        $array['phenom'][$resp[$i]['class']][$i.'-s']['syst'] = $resp[$i]['syst'];
        $array['phenom'][$resp[$i]['class']][$i.'-s']['id_sistema'] = $resp[$i]['id_sistema'];

      }
    }

    //print_r($array['phenom']);
    return $array;
  }
  
  //Inserir nova imagem de registro
  public function addImagem($imagem, $horario, $categoria, $date) {
    
    $imgID = '';
    
    if(count($imagem) > 0) {

      /*não usa FOR pois o upload é limitado a apenas uma imagem*/
      /*for($q=0;$q<count($imagem['tmp_name']);$q++) { */
        $tipo = $imagem['type'];

        if(in_array($tipo, array('image/jpeg', 'image/png', 'image/gif'))) {
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
          } elseif($tipo == 'image/gif') {
            $origi = imagecreatefromgif('assets/images/'.$categoria.'/'.$tmpname);
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

    } else {
      $sql = $this->db->prepare("INSERT INTO info_geral SET texto = :texto, date = :date");
      $sql->bindValue(":texto", $texto);
      $sql->bindValue(":date", $date);

      $sql->execute();

      return true;
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

    if($cargo !== "undefined") {
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
    } else {
      $sql = $this->db->prepare("UPDATE info_geral SET texto = :texto WHERE date = :date");

      $sql->bindValue(":texto", $texto);
      $sql->bindValue(":date", $date);
      $sql->execute();
    }
    
  }

  //Adicionar tag de sistema
  public function addSystem($id, $date) {

    $sql = $this->db->prepare("INSERT INTO sistemas SET id_sistema = :id, date = :date");
    $sql->bindValue(":id", $id);
    $sql->bindValue(":date", $date);
    $sql->execute();
    
    echo $date." ".$id;
  }
  
  //Adicionar tag de sistema
  public function deleteSystem($id, $date) {

    $sql = $this->db->prepare("DELETE FROM sistemas WHERE id_sistema = :id AND date = :date");
    $sql->bindValue(":id", $id);
    $sql->bindValue(":date", $date);
    $sql->execute();
  }
}

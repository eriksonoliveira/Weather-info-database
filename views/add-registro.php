<?PHP echo $success; ?>

<div class="container">
  <h1>Adicionar Monitoramento do dia</h1>
  <h3><?PHP echo $dia;?></h3>

    <div>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th colspan="2">Imagem Sinótica</th>
          </tr>
          <tr>
            <?PHP for($i = 0; $i <= 1; $i++):?>
            <td>
              <h5><?PHP echo $horario[$i]['hora'];?></h5>
              <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="add_imagem">Inserir Imagem</label>
                  <label for="<?PHP echo $cats[0]['nome'].''.$horario[$i]['hora'];?>" class="btn btn-info">Adicionar Imagem</label>
                  <p id="num-fotos"></p>
                  <input id="<?PHP echo $cats[0]['nome'].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats[0]['nome'];?>" data-categoria="<?PHP echo $cats[0]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success">Enviar</button>
                </div>
              </form>
              <div class="img-wrap" data-categoria="<?PHP echo $cats[0]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
              <!--  <span class="img-del" title="Deletar imagem" data-id="<?PHP

                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[0]['nome']]['id'])) {

                    $imgId = $currDayReg['img'][$horario[$i]['hora']][$cats[0]['nome']]['id'];
                    echo $imgId;
                  }*/

                ?>">&times;</span>
                <img class="img-preview img-width" src="<?PHP


                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[0]['nome']]['fileName'])) {

                    $imgName = $currDayReg['img'][$horario[$i]['hora']][$cats[0]['nome']]['fileName'];
                    $imgPath = BASE_URL.'assets/images/'.$cats[0]['nome'].'/'.$imgName;
                    echo $imgPath;
                  }*/

                ?>"/>-->
              </div>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
          <tr>
            <?PHP for($i = 2; $i <= 3; $i++):?>
            <td>
              <h5><?PHP echo $horario[$i]['hora'];?></h5>
              <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="add_imagem">Inserir Imagem</label>
                  <label for="<?PHP echo $cats[0]['nome'].''.$horario[$i]['hora'];?>" class="btn btn-info">Adicionar Imagem</label>
                  <p id="num-fotos"></p>
                  <input id="<?PHP echo $cats[0]['nome'].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats[0]['nome'];?>" data-categoria="<?PHP echo $cats[0]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success">Enviar</button>
                </div>
              </form>
              <div class="img-wrap" data-categoria="<?PHP echo $cats[0]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
              <!--  <span class="img-del" title="Deletar imagem" data-id="<?PHP

                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[0]['nome']]['id'])) {

                    $imgId = $currDayReg['img'][$horario[$i]['hora']][$cats[0]['nome']]['id'];
                    echo $imgId;
                  }*/

                ?>">&times;</span>
                <img class="img-preview img-width" src="<?PHP


                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[0]['nome']]['fileName'])) {

                    $imgName = $currDayReg['img'][$horario[$i]['hora']][$cats[0]['nome']]['fileName'];
                    $imgPath = BASE_URL.'assets/images/'.$cats[0]['nome'].'/'.$imgName;
                    echo $imgPath;
                  }*/

                ?>"/>-->
              </div>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>


    <div>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th colspan="2">Imagem de Satélite</th>
          </tr>
          <tr>
            <?PHP for($i = 0; $i <= 1; $i++):?>
            <td>
              <h5><?PHP echo $horario[$i]['hora'];?></h5>
              <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="add_imagem">Inserir Imagem</label>
                  <label for="<?PHP echo $cats[6]['nome'].''.$horario[$i]['hora'];?>" class="btn btn-info">Adicionar Imagem</label>
                  <p id="num-fotos"></p>
                  <input id="<?PHP echo $cats[6]['nome'].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats[6]['nome'];?>" data-categoria="<?PHP echo $cats[6]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success">Enviar</button>
                </div>
              </form>
              <div class="img-wrap" data-categoria="<?PHP echo $cats[6]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
              <!--  <span class="img-del" title="Deletar imagem" data-id="<?PHP

                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[6]['nome']]['id'])) {

                    $imgId = $currDayReg['img'][$horario[$i]['hora']][$cats[6]['nome']]['id'];
                    echo $imgId;
                  }*/

                ?>">&times;</span>
                <img class="img-preview img-width" src="<?PHP


                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[6]['nome']]['fileName'])) {

                    $imgName = $currDayReg['img'][$horario[$i]['hora']][$cats[6]['nome']]['fileName'];
                    $imgPath = BASE_URL.'assets/images/'.$cats[6]['nome'].'/'.$imgName;
                    echo $imgPath;
                  }*/

                ?>"/>-->
              </div>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
          <tr>
            <?PHP for($i = 2; $i <= 3; $i++):?>
            <td>
              <h5><?PHP echo $horario[$i]['hora'];?></h5>
              <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="add_imagem">Inserir Imagem</label>
                  <label for="<?PHP echo $cats[6]['nome'].''.$horario[$i]['hora'];?>" class="btn btn-info">Adicionar Imagem</label>
                  <p id="num-fotos"></p>
                  <input id="<?PHP echo $cats[6]['nome'].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats[6]['nome'];?>" data-categoria="<?PHP echo $cats[6]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success">Enviar</button>
                </div>
              </form>
              <div class="img-wrap" data-categoria="<?PHP echo $cats[6]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
              <!--  <span class="img-del" title="Deletar imagem" data-id="<?PHP

                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[6]['nome']]['id'])) {

                    $imgId = $currDayReg['img'][$horario[$i]['hora']][$cats[6]['nome']]['id'];
                    echo $imgId;
                  }*/

                ?>">&times;</span>
                <img class="img-preview img-width" src="<?PHP


                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[6]['nome']]['fileName'])) {

                    $imgName = $currDayReg['img'][$horario[$i]['hora']][$cats[6]['nome']]['fileName'];
                    $imgPath = BASE_URL.'assets/images/'.$cats[6]['nome'].'/'.$imgName;
                    echo $imgPath;
                  }*/

                ?>"/>-->
              </div>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th colspan="2">Radiossondagem de Florianópolis</th>
          </tr>
          <tr>
            <?PHP for($i = 0; $i <= 1; $i++):?>
            <td>
              <h5><?PHP echo $horario[$i]['hora'];?></h5>
              <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="add_imagem">Inserir Imagem</label>
                  <label for="<?PHP echo $cats[5]['nome'].''.$horario[$i]['hora'];?>" class="btn btn-info">Adicionar Imagem</label>
                  <p id="num-fotos"></p>
                  <input id="<?PHP echo $cats[5]['nome'].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats[5]['nome'];?>" data-categoria="<?PHP echo $cats[5]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success">Enviar</button>
                </div>
              </form>
              <div class="img-wrap" data-categoria="<?PHP echo $cats[5]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
              <!--  <span class="img-del" title="Deletar imagem" data-id="<?PHP

                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[5]['nome']]['id'])) {

                    $imgId = $currDayReg['img'][$horario[$i]['hora']][$cats[5]['nome']]['id'];
                    echo $imgId;
                  }*/

                ?>">&times;</span>
                <img class="img-preview img-width" src="<?PHP


                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[5]['nome']]['fileName'])) {

                    $imgName = $currDayReg['img'][$horario[$i]['hora']][$cats[5]['nome']]['fileName'];
                    $imgPath = BASE_URL.'assets/images/'.$cats[5]['nome'].'/'.$imgName;
                    echo $imgPath;
                  }*/

                ?>"/>-->
              </div>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th colspan="2">Jato em altos níveis</th>
          </tr>
          <tr>
            <?PHP for($i = 0; $i <= 1; $i++):?>
            <td>
              <h5><?PHP echo $horario[$i]['hora'];?></h5>
              <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="add_imagem">Inserir Imagem</label>
                  <label for="<?PHP echo $cats[1]['nome'].''.$horario[$i]['hora'];?>" class="btn btn-info">Adicionar Imagem</label>
                  <p id="num-fotos"></p>
                  <input id="<?PHP echo $cats[1]['nome'].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats[1]['nome'];?>" data-categoria="<?PHP echo $cats[1]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success">Enviar</button>
                </div>
              </form>
              <div class="img-wrap" data-categoria="<?PHP echo $cats[1]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
              <!--  <span class="img-del" title="Deletar imagem" data-id="<?PHP

                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[1]['nome']]['id'])) {

                    $imgId = $currDayReg['img'][$horario[$i]['hora']][$cats[1]['nome']]['id'];
                    echo $imgId;
                  }*/

                ?>">&times;</span>
                <img class="img-preview img-width" src="<?PHP


                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[1]['nome']]['fileName'])) {

                    $imgName = $currDayReg['img'][$horario[$i]['hora']][$cats[1]['nome']]['fileName'];
                    $imgPath = BASE_URL.'assets/images/'.$cats[1]['nome'].'/'.$imgName;
                    echo $imgPath;
                  }*/

                ?>"/>-->
              </div>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th colspan="2">Geopotencial em médios níveis</th>
          </tr>
          <tr>
            <?PHP for($i = 0; $i <= 1; $i++):?>
            <td>
              <h5><?PHP echo $horario[$i]['hora'];?></h5>
              <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="add_imagem">Inserir Imagem</label>
                  <label for="<?PHP echo $cats[2]['nome'].''.$horario[$i]['hora'];?>" class="btn btn-info">Adicionar Imagem</label>
                  <p id="num-fotos"></p>
                  <input id="<?PHP echo $cats[2]['nome'].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats[2]['nome'];?>" data-categoria="<?PHP echo $cats[2]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success">Enviar</button>
                </div>
              </form>
              <div class="img-wrap" data-categoria="<?PHP echo $cats[2]['nome'];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
              <!--  <span class="img-del" title="Deletar imagem" data-id="<?PHP

                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[2]['nome']]['id'])) {

                    $imgId = $currDayReg['img'][$horario[$i]['hora']][$cats[2]['nome']]['id'];
                    echo $imgId;
                  }*/

                ?>">&times;</span>
                <img class="img-preview img-width" src="<?PHP


                 /* if(isset($currDayReg['img'][$horario[$i]['hora']][$cats[2]['nome']]['fileName'])) {

                    $imgName = $currDayReg['img'][$horario[$i]['hora']][$cats[2]['nome']]['fileName'];
                    $imgPath = BASE_URL.'assets/images/'.$cats[2]['nome'].'/'.$imgName;
                    echo $imgPath;
                  }*/

                ?>"/>-->
              </div>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th colspan="2">Descrição sinótica</th>
          </tr>
          <tr>
            <?PHP for($i = 0; $i <=1; $i++):?>
            <td>
              <h5><?PHP echo $horario[$i]['hora'];?></h5>
              <form class="reg-form form-txt" type="POST" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <div class="form-group">
                  <label for="categoria">Meteorologista:</label>
                  <select name="meteoro_nome_<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-cargo="meteoro" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                    <?PHP
                      foreach($mets as $met):
                    ?>
                    <option value="<?PHP echo $met['id'];?>"><?PHP echo $met['nome'];?>
                    </option>

                    <?PHP
                      endforeach;
                    ?>
                  </select>
                  <label>Superfície:</label>
                  <textarea class="form-control" data-categoria="superficie" data-hora="<?PHP echo $horario[$i]['hora'];?>"><?PHP

                    /*echo (isset($currDayReg['met'][$horario[$i]['hora']]))? trim($currDayReg['met'][$horario[$i]['hora']][0]['texto']) : '';*/

                    ?></textarea><br>
                  <label>Níveis médios e altos:</label>
                  <textarea class="form-control" data-categoria="medios_altos" data-hora="<?PHP echo $horario[$i]['hora'];?>"><?PHP

                    /*echo (isset($currDayReg['met'][$horario[$i]['hora']]))? trim($currDayReg['met'][$horario[$i]['hora']][1]['texto']) : '';*/

                    ?></textarea><br>
                  <label>Condição de tempo:</label>
                  <textarea class="form-control" data-categoria="condicao_tempo" data-hora="<?PHP echo $horario[$i]['hora'];?>"><?PHP

                    /*echo (isset($currDayReg['met'][$horario[$i]['hora']]))? trim($currDayReg['met'][$horario[$i]['hora']][2]['texto']) : '';*/

                    ?></textarea>

                  <?PHP
                    if(isset($currDayReg['met'][$horario[$i]['hora']])){
                  ?>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                  <?PHP
                    } else {
                  ?>
                    <button type="submit" class="btn btn-success">Enviar</button>
                  <?PHP
                    }
                  ?>

                </div>
              </form>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
          <tr>
            <?PHP for($i = 2; $i <=3; $i++):?>
            <td>
              <h5><?PHP echo $horario[$i]['hora'];?></h5>
              <form class="reg-form form-txt" type="POST" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <div class="form-group">
                  <label for="categoria">Meteorologista:</label>
                  <select name="meteoro_nome_<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-cargo="meteoro" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                    <?PHP
                      foreach($mets as $met):
                    ?>
                    <option value="<?PHP echo $met['id'];?>"><?PHP echo $met['nome'];?>
                    </option>

                    <?PHP
                      endforeach;
                    ?>
                  </select>
                  <label>Superfície:</label>
                  <textarea class="form-control" data-categoria="superficie" data-hora="<?PHP echo $horario[$i]['hora'];?>"><?PHP

                    /*echo (isset($currDayReg['met'][$horario[$i]['hora']]))? trim($currDayReg['met'][$horario[$i]['hora']][0]['texto']) : '';*/

                  ?></textarea><br>

                  <label>Níveis médios e altos:</label>
                  <textarea class="form-control" data-categoria="medios_altos" data-hora="<?PHP echo $horario[$i]['hora'];?>"><?PHP

                    /*echo (isset($currDayReg['met'][$horario[$i]['hora']]))? trim($currDayReg['met'][$horario[$i]['hora']][1]['texto']) : '';*/

                  ?></textarea><br>

                  <label>Condição de tempo:</label>
                  <textarea class="form-control" data-categoria="condicao_tempo" data-hora="<?PHP echo $horario[$i]['hora'];?>"><?PHP

                    /*echo (isset($currDayReg['met'][$horario[$i]['hora']]))? trim($currDayReg['met'][$horario[$i]['hora']][2]['texto']) : '';*/

                  ?></textarea>

                  <?PHP
                    if(isset($currDayReg['met'][$horario[$i]['hora']])){
                  ?>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                  <?PHP
                    } else {
                  ?>
                    <button type="submit" class="btn btn-success">Enviar</button>
                  <?PHP
                    }
                  ?>

                </div>
              </form>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th colspan="2">Registros Significativos</th>
          </tr>
            <?PHP for($i = 0; $i <=3; $i++):?>
          <tr>
            <td>
              <h5><?PHP echo $horario[$i]['hora'];?></h5>
              <form class="reg-form form-txt" type="POST" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <div class="form-group">
                  <label>Tecnico:</label>
                  <select name="tec_nome_<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-cargo="tec" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                    <?PHP
                      foreach($tecs as $tec):
                    ?>
                    <option value="<?PHP echo $tec['id'];?>"><?PHP echo $tec['nome'];?>
                    </option>

                    <?PHP
                      endforeach;
                    ?>
                  </select>

                  <label>METAR:</label>
                  <textarea class="form-control" data-categoria="metar" data-hora="<?PHP echo $horario[$i]['hora'];?>"><?PHP

                    /*echo (isset($currDayReg['tec'][$horario[$i]['hora']]))? trim($currDayReg['tec'][$horario[$i]['hora']][0]['texto']) : '';*/

                  ?></textarea><br>

                  <label>Ocorrências:</label>
                  <textarea class="form-control" data-categoria="ocorrencias" data-hora="<?PHP echo $horario[$i]['hora'];?>"><?PHP

                    /*echo (isset($currDayReg['tec'][$horario[$i]['hora']]))? trim($currDayReg['tec'][$horario[$i]['hora']][1]['texto']) : '';*/

                  ?></textarea><br>

                  <button type="submit" class="btn btn-success">Enviar</button>
                </div>
              </form>
              <p class="sucesso-msg"></p>
            </td>
          </tr>
            <?PHP endfor;?>

        </tbody>
      </table>
    </div>

</div>

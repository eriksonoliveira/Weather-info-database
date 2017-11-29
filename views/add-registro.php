<?PHP echo $success; ?>

<div class="container">
  <h1>Adicionar Monitoramento do dia</h1>
  <h3><?PHP echo $dia;?></h3>

    <div>
      <h4 style="color: #005588; text-align: center"><?PHP echo $cats[0]['nome'];?></h4>
      <table class="table table-bordered">
        <tbody>
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
              <img class="img-preview" src=""/>
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
              <img class="img-preview" src=""/>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>


    <div>
      <h4 style="color: #005588; text-align: center"><?PHP echo $cats[6]['nome'];?></h4>
      <table class="table table-bordered">
        <tbody>
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
              <img class="img-preview" src=""/>
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
              <img class="img-preview" src=""/>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <h4 style="color: #005588; text-align: center"><?PHP echo $cats[5]['nome'];?> Florianópolis</h4>
      <table class="table table-bordered">
        <tbody>
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
              <img class="img-preview" src=""/>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <h4 style="color: #005588; text-align: center">Altos Níveis</h4>
      <table class="table table-bordered">
        <tbody>
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
              <img class="img-preview" src=""/>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <h4 style="color: #005588; text-align: center">Medios Níveis</h4>
      <table class="table table-bordered">
        <tbody>
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
              <img class="img-preview" src=""/>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <h4 style="color: #005588; text-align: center">Descrição</h4>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <?PHP for($i = 0; $i <=1; $i++):?>
            <td>
              <h5><?PHP echo $horario[$i]['hora'];?></h5>
              <form class="reg-form form-txt" type="POST" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <div class="form-group">
                  <label for="categoria">Meteorologista:</label>
                  <select name="meteoro_nome_<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-cargo="meteoro">
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
                  <textarea name="descricao_superficie<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-categoria="superficie"><?PHP

                    echo (isset($currDayReg['met'][$horario[$i]['hora']]))? trim($currDayReg['met'][$horario[$i]['hora']][0]['texto']) : '';

                    ?></textarea><br>
                  <label>Níveis médios e altos:</label>
                  <textarea name="descricao_medios_altos<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-categoria="medios_altos"><?PHP

                    echo (isset($currDayReg['met'][$horario[$i]['hora']]))? trim($currDayReg['met'][$horario[$i]['hora']][1]['texto']) : '';

                    ?></textarea><br>
                  <label>Condição de tempo:</label>
                  <textarea name="descricao_condicao_tempo<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-categoria="condicao_tempo"><?PHP

                    echo (isset($currDayReg['met'][$horario[$i]['hora']]))? trim($currDayReg['met'][$horario[$i]['hora']][2]['texto']) : '';

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
                  <select name="meteoro_nome_<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-cargo="meteoro">
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
                  <textarea name="descricao_superficie<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-categoria="superficie"></textarea><br>
                  <label>Níveis médios e altos:</label>
                  <textarea name="descricao_medios_altos<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-categoria="medios_altos"></textarea><br>
                  <label>Condição de tempo:</label>
                  <textarea name="descricao_condicao_tempo<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-categoria="condicao_tempo"></textarea>
                  <button type="submit" class="btn btn-success">Enviar</button>
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
      <h4 style="color: #005588; text-align: center">Registros Significativos</h4>
      <table class="table table-bordered">
        <tbody>
            <?PHP for($i = 0; $i <=3; $i++):?>
          <tr>
            <td>
              <h5><?PHP echo $horario[$i]['hora'];?></h5>
              <form class="reg-form form-txt" type="POST" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <div class="form-group">
                  <label>Tecnico:</label>
                  <select name="tec_nome_<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-cargo="tec">
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
                  <textarea name="metar<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-categoria="metar"></textarea><br>
                  <label>Ocorrências:</label>
                  <textarea name="ocorrencias<?PHP echo $horario[$i]['hora'];?>" class="form-control" data-categoria="ocorrencias"></textarea><br>
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

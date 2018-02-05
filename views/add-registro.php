<div class="add-content-container">
  <div class="add-content-wrap container">
    <h1>Adicionar Monitoramento do dia</h1>
    <h3><?PHP echo $dia;?></h3>

    <div>
      <table class="table">
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
                  <div class="input-btn-wrap">
                    <label>Inserir Imagem</label>
                    <label for="<?PHP echo $cats['img'][0].''.$horario[$i]['hora'];?>" class="btn btn-info inputBtn">Adicionar Imagem</label>
                    <input id="<?PHP echo $cats['img'][0].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][0];?>" data-categoria="<?PHP echo $cats['img'][0];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  </div>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success send-img">Enviar</button>
                  <button class="btn btn-danger img-cancel" type="button">Cancelar</button>
                </div>
              </form>

              <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][0];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <span class="img-del"><webicon icon="fa:trash-o"/></span>
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
                  <div class="input-btn-wrap">
                    <label>Inserir Imagem</label>
                    <label for="<?PHP echo $cats['img'][0].''.$horario[$i]['hora'];?>" class="btn btn-info inputBtn">Adicionar Imagem</label>
                    <input id="<?PHP echo $cats['img'][0].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][0];?>" data-categoria="<?PHP echo $cats['img'][0];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  </div>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success send-img">Enviar</button>
                  <button class="btn btn-danger img-cancel" type="reset">Cancelar</button>
                </div>
              </form>

              <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][0];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <span class="img-del"><webicon icon="fa:trash-o"/></span>
              </div>

              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>


    <div>
      <table class="table">
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
                  <div class="input-btn-wrap">
                    <label>Inserir Imagem</label>
                    <label for="<?PHP echo $cats['img'][1].''.$horario[$i]['hora'];?>" class="btn btn-info inputBtn">Adicionar Imagem</label>
                    <input id="<?PHP echo $cats['img'][1].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][1];?>" data-categoria="<?PHP echo $cats['img'][1];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  </div>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success send-img">Enviar</button>
                  <button class="btn btn-danger img-cancel" type="button">Cancelar</button>
                </div>
              </form>

              <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][1];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <span class="img-del"><webicon icon="fa:trash-o"/></span>
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
                  <div class="input-btn-wrap">
                    <label>Inserir Imagem</label>
                    <label for="<?PHP echo $cats['img'][1].''.$horario[$i]['hora'];?>" class="btn btn-info inputBtn">Adicionar Imagem</label>
                    <input id="<?PHP echo $cats['img'][1].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][1];?>" data-categoria="<?PHP echo $cats['img'][1];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  </div>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success send-img">Enviar</button>
                  <button class="btn btn-danger img-cancel" type="reset">Cancelar</button>
                </div>
              </form>

              <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][1];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <span class="img-del"><webicon icon="fa:trash-o"/></span>
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
                  <div class="input-btn-wrap">
                    <label>Inserir Imagem</label>
                    <label for="<?PHP echo $cats['img'][2].''.$horario[$i]['hora'];?>" class="btn btn-info inputBtn">Adicionar Imagem</label>
                    <input id="<?PHP echo $cats['img'][2].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][2];?>" data-categoria="<?PHP echo $cats['img'][2];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  </div>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success send-img">Enviar</button>
                  <button class="btn btn-danger img-cancel" type="button">Cancelar</button>
                </div>
              </form>

              <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][2];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <span class="img-del"><webicon icon="fa:trash-o"/></span>
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
                  <div class="input-btn-wrap">
                    <label>Inserir Imagem</label>
                    <label for="<?PHP echo $cats['img'][3].''.$horario[$i]['hora'];?>" class="btn btn-info inputBtn">Adicionar Imagem</label>
                    <input id="<?PHP echo $cats['img'][3].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][3];?>" data-categoria="<?PHP echo $cats['img'][3];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  </div>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success send-img">Enviar</button>
                  <button class="btn btn-danger img-cancel" type="button">Cancelar</button>
                </div>
              </form>

              <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][3];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <span class="img-del"><webicon icon="fa:trash-o"/></span>
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
                  <div class="input-btn-wrap">
                    <label>Inserir Imagem</label>
                    <label for="<?PHP echo $cats['img'][4].''.$horario[$i]['hora'];?>" class="btn btn-info inputBtn">Adicionar Imagem</label>
                    <input id="<?PHP echo $cats['img'][4].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][4];?>" data-categoria="<?PHP echo $cats['img'][4];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                  </div>
                  <p class="num-fotos"></p>
                  <button type="submit" class="btn btn-success send-img">Enviar</button>
                  <button class="btn btn-danger img-cancel" type="button">Cancelar</button>
                </div>
              </form>

              <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][4];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <span class="img-del"><webicon icon="fa:trash-o"/></span>
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
                  <textarea class="form-control" data-categoria="superficie" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea><br>

                  <label>Níveis médios e altos:</label>
                  <textarea class="form-control" data-categoria="medios_altos" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea><br>

                  <label>Condição de tempo:</label>
                  <textarea class="form-control" data-categoria="condicao_tempo" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea>

                  <button type="submit" class="btn btn-success send-text">Enviar</button>
                  <button class="btn btn-primary edit-text">Editar</button>
                  <button type="submit" class="btn btn-primary update-text">Atualizar</button>
                  <button class="btn btn-danger update-cancel">Cancelar</button>

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
                  <textarea class="form-control" data-categoria="superficie" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea><br>

                  <label>Níveis médios e altos:</label>
                  <textarea class="form-control" data-categoria="medios_altos" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea><br>

                  <label>Condição de tempo:</label>
                  <textarea class="form-control" data-categoria="condicao_tempo" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea>

                  <button type="submit" class="btn btn-success send-text">Enviar</button>
                  <button class="btn btn-primary edit-text">Editar</button>
                  <button type="submit" class="btn btn-primary update-text">Atualizar</button>
                  <button class="btn btn-danger update-cancel">Cancelar</button>


                </div>
              </form>
              <p class="sucesso-msg"></p>
            </td>
            <?PHP endfor;?>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="system-tags">
      <h2 class="header">Sistemas e Fenômenos</h2>
      <div class="system-tags-container">

      <?PHP foreach($sistemas_classes as $k => $class):;?>

        <div class="fenom-box">
          <h3 class="fenom-heading"><?PHP echo $class;?></h3>
          <?PHP
            foreach($sistemas as $sist):
              if(ucfirst($sist['class']) == $class):
          ?>

          <label class="fenom">
            <input type="checkbox" data-id="<?PHP echo $sist['id'];?>"/>
            <span class="checkmark"><?PHP echo $sist['nome'];?></span>
          </label>

          <?PHP
            endif;
          endforeach;
          ?>

        </div>

        <?PHP
        endforeach;
        ?>

      </div>
      <div class="btn-wrap">
        <button class="btn send-fenomenos">Salvar</button>
      </div>
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
                  <textarea class="form-control" data-categoria="metar" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea><br>

                  <label>Ocorrências:</label>
                  <textarea class="form-control" data-categoria="ocorrencias" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea><br>

                  <button type="submit" class="btn btn-success send-text">Enviar</button>
                  <button class="btn btn-primary edit-text">Editar</button>
                  <button type="submit" class="btn btn-primary update-text">Atualizar</button>
                  <button class="btn btn-danger update-cancel">Cancelar</button>


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

</div>

<div class="bg-box"></div>
<div class="img-modal-box">
  <img src="" width="100%"/>
</div>

<!-- load read-one-registry js -->
<script src="<?PHP echo BASE_URL;?>assets/js/registries/read-one-registry.js"></script>

<div class="add-reg-container grey-bg">
  <div class="container inner-container">
    <div class="back">
      <span> <i class="material-icons">arrow_back</i></span>
    </div>
    <div class="add-reg-heading mui--text-center">
      <div class="mui--text-display1">Adicionar Monitoramento do dia</div>
      <div class="mui--text-headline"><input type="text" class="form-control mr-2" name="calendar-3" value="<?PHP echo $dateFormated;?>"/></div>

    </div>
    <div class="menu">
      <div class="menu-box">
        <div class="menu-box-inner">
          <div class="menu-box-buttons row">
            <a href="im_satelite" class="mui-btn mui-btn--primary menu-btn col-sm">Imagem de Satélite</a>
            <a href="im_sinotica" class="mui-btn mui-btn--primary menu-btn col-sm">Imagem Sinótica</a>
            <a href="medios_niveis" class="mui-btn mui-btn--primary menu-btn col-sm">Níveis Médios</a>
          </div>
          <div class="menu-box-buttons row">
            <a href="altos_niveis" class="mui-btn mui-btn--primary menu-btn col-sm">Altos níveis</a>
            <a href="descricao" class="mui-btn mui-btn--primary menu-btn col-sm">Descrição Sinótica</a>
            <a href="fenomenos" class="mui-btn mui-btn--primary menu-btn col-sm">Fenômenos</a>
          </div>
          <div class="menu-box-buttons row">
            <a href="dados_observados" class="mui-btn mui-btn--primary menu-btn col-sm">Ocorrências</a>
            <a href="sondagem" class="mui-btn mui-btn--primary menu-btn col-sm">Radiossondagem</a>
            <a href="info-gerais" class="mui-btn mui-btn--primary menu-btn col-sm">Informações gerais</a>
          </div>
        </div>
      </div>

      <div id="im_satelite" class="menu-input-form">
        <div class="center">
          <table class="table menu-input-table">
          <tbody>
            <tr>
              <th colspan="2">Imagem de Satélite</th>
            </tr>
            <tr>
              <?PHP for($i = 0; $i <= 1; $i++):?>
              <td>
                <p class="input-table-time"><?PHP echo $horario[$i]['hora'];?></p>
                <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="input-btn-wrap">
                      <label for="<?PHP echo $cats['img'][1].''.$horario[$i]['hora'];?>" class="mui-btn mui-btn--fab mui-btn--primary inputBtn">+</label>
                      <input id="<?PHP echo $cats['img'][1].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][1];?>" data-categoria="<?PHP echo $cats['img'][1];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                    </div>
                    <button type="submit" class="mui-btn mui-btn--primary send-img">Enviar</button>
                    <button class="mui-btn mui-btn--danger img-cancel" type="button">Cancelar</button>
                  </div>
                </form>

                <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][1];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                  <div class="img-overlay">
                    <span class="img-del" title="Excluir imagem"><webicon icon="fa:trash-o"/></span>
                  </div>
                </div>

                <p class="sucesso-msg"></p>
              </td>
              <?PHP endfor;?>
            </tr>
            <tr>
              <?PHP for($i = 2; $i <= 3; $i++):?>
              <td>
                <p class="input-table-time"><?PHP echo $horario[$i]['hora'];?></p>
                <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="input-btn-wrap">
                      <label for="<?PHP echo $cats['img'][1].''.$horario[$i]['hora'];?>" class="mui-btn mui-btn--fab mui-btn--primary inputBtn">+</label>
                      <input id="<?PHP echo $cats['img'][1].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][1];?>" data-categoria="<?PHP echo $cats['img'][1];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                    </div>
                    <button type="submit" class="mui-btn mui-btn--primary send-img">Enviar</button>
                    <button class="mui-btn mui-btn--danger img-cancel" type="reset">Cancelar</button>
                  </div>
                </form>

                <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][1];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                  <div class="img-overlay">
                    <span class="img-del" title="Excluir imagem"><webicon icon="fa:trash-o"/></span>
                  </div>
                </div>

                <p class="sucesso-msg"></p>
              </td>
              <?PHP endfor;?>
            </tr>
          </tbody>
        </table>
        </div>
      </div>

      <div id="im_sinotica" class="menu-input-form">
        <div class="center">
          <table class="table menu-input-table">
          <tbody>
            <tr>
              <th colspan="2">Imagem Sinótica</th>
            </tr>
            <tr>
              <?PHP for($i = 0; $i <= 1; $i++):?>
              <td>
                <p class="input-table-time"><?PHP echo $horario[$i]['hora'];?></p>
                <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="input-btn-wrap">
                      <label for="<?PHP echo $cats['img'][0].''.$horario[$i]['hora'];?>" class="mui-btn mui-btn--fab mui-btn--primary inputBtn">+</label>
                      <input id="<?PHP echo $cats['img'][0].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][0];?>" data-categoria="<?PHP echo $cats['img'][0];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                    </div>
                    <button type="submit" class="mui-btn mui-btn--primary send-img">Enviar</button>
                    <button class="mui-btn mui-btn--danger img-cancel" type="button">Cancelar</button>
                  </div>
                </form>

                <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][0];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                  <div class="img-overlay">
                    <span class="img-del" title="Excluir imagem"><webicon icon="fa:trash-o"/></span>
                  </div>
                </div>

                <p class="sucesso-msg"></p>
              </td>
              <?PHP endfor;?>
            </tr>
            <tr>
              <?PHP for($i = 2; $i <= 3; $i++):?>
              <td>
                <p class="input-table-time"><?PHP echo $horario[$i]['hora'];?></p>
                <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="input-btn-wrap">
                      <label for="<?PHP echo $cats['img'][0].''.$horario[$i]['hora'];?>" class="mui-btn mui-btn--fab mui-btn--primary inputBtn">+</label>
                      <input id="<?PHP echo $cats['img'][0].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][0];?>" data-categoria="<?PHP echo $cats['img'][0];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                    </div>
                    <button type="submit" class="mui-btn mui-btn--primary send-img">Enviar</button>
                    <button class="mui-btn mui-btn--danger img-cancel" type="reset">Cancelar</button>
                  </div>
                </form>

                <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][0];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                  <div class="img-overlay">
                    <span class="img-del" title="Excluir imagem"><webicon icon="fa:trash-o"/></span>
                  </div>
                </div>

                <p class="sucesso-msg"></p>
              </td>
              <?PHP endfor;?>
            </tr>
          </tbody>
        </table>
        </div>
      </div>

      <div id="altos_niveis" class="menu-input-form">
        <div class="center">
          <table class="table menu-input-table table-bordered">
          <tbody>
            <tr>
              <th colspan="2">Jato em altos níveis</th>
            </tr>
            <tr>
              <?PHP for($i = 0; $i <= 1; $i++):?>
              <td>
                <p class="input-table-time"><?PHP echo $horario[$i]['hora'];?></p>
                <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="input-btn-wrap">
                      <label for="<?PHP echo $cats['img'][3].''.$horario[$i]['hora'];?>" class="mui-btn mui-btn--fab mui-btn--primary inputBtn">+</label>
                      <input id="<?PHP echo $cats['img'][3].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][3];?>" data-categoria="<?PHP echo $cats['img'][3];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                    </div>
                    <button type="submit" class="mui-btn mui-btn--primary send-img">Enviar</button>
                    <button class="mui-btn mui-btn--danger img-cancel" type="button">Cancelar</button>
                  </div>
                </form>

                <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][3];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                  <div class="img-overlay">
                    <span class="img-del" title="Excluir imagem"><webicon icon="fa:trash-o"/></span>
                  </div>
                </div>

                <p class="sucesso-msg"></p>
              </td>
              <?PHP endfor;?>
            </tr>
          </tbody>
        </table>
        </div>
      </div>

      <div id="medios_niveis" class="menu-input-form">
        <div class="center">
          <table class="table menu-input-table table-bordered">
          <tbody>
            <tr>
              <th colspan="2">Geopotencial em médios níveis</th>
            </tr>
            <tr>
              <?PHP for($i = 0; $i <= 1; $i++):?>
              <td>
                <p class="input-table-time"><?PHP echo $horario[$i]['hora'];?></p>
                <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="input-btn-wrap">
                      <label for="<?PHP echo $cats['img'][4].''.$horario[$i]['hora'];?>" class="mui-btn mui-btn--fab mui-btn--primary inputBtn">+</label>
                      <input id="<?PHP echo $cats['img'][4].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][4];?>" data-categoria="<?PHP echo $cats['img'][4];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                    </div>
                    <button type="submit" class="mui-btn mui-btn--primary send-img">Enviar</button>
                    <button class="mui-btn mui-btn--danger img-cancel" type="button">Cancelar</button>
                  </div>
                </form>

                <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][4];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                  <div class="img-overlay">
                    <span class="img-del" title="Excluir imagem"><webicon icon="fa:trash-o"/></span>
                  </div>
                </div>

                <p class="sucesso-msg"></p>
              </td>
              <?PHP endfor;?>
            </tr>
          </tbody>
        </table>
        </div>
      </div>

      <div id="descricao" class="menu-input-form mb-5">
        <div class="card mb-3">
          <div class="menu-input-title pl-3">
            <h3 colspan="2">Descrição sinótica</h3>
          </div>
          <div class="row px-3">
            <?PHP for($i = 0; $i <=3; $i++):?>
            <div class="col-md-6 pb-2 pt-2 menu-input-border">
              <p class="input-table-time"><?PHP echo $horario[$i]['hora'];?></p>

              <form class="reg-form form-txt" type="POST" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                <div class="form-group bmd-form-group">
                  <label for="categoria" class="text-center">Meteorologista:</label>
                  <select name="meteoro_nome_<?PHP echo $horario[$i]['hora'];?>" class="custom-select" data-cargo="meteoro" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                    <?PHP
                      foreach($mets as $met):
                    ?>
                    <option value="<?PHP echo $met['id'];?>"><?PHP echo $met['nome'];?>
                    </option>

                    <?PHP
                      endforeach;
                    ?>
                  </select>
                </div>

                <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Superfície:</label>
                <textarea class="form-control input-blue" data-categoria="superficie" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea><br>
                </div>

                <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Níveis médios e altos:</label>
                <textarea class="form-control input-blue" data-categoria="medios_altos" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea><br>
                </div>

                <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Condição de tempo:</label>
                <textarea class="form-control input-blue" data-categoria="condicao_tempo" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea>
                </div>

                <div class="buttons">
                <button type="submit" class="btn btn-raised btn-success send-text">Enviar</button>
                </div>

              </form>
              <p class="sucesso-msg"></p>
            </div>
            <?PHP endfor;?>
          </div>
        </div>
      </div>

      <div id="dados_observados" class="menu-input-form">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th colspan="2">Registros Significativos</th>
            </tr>

              <?PHP for($i = 0; $i <=3; $i++):?>

            <tr>
              <td>
                <p class="input-table-time"><?PHP echo $horario[$i]['hora'];?></p>
                <form class="reg-form form-txt" type="POST" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                  <div class="form-group">
                    <label>Tecnico:</label>
                    <select name="tec_nome_<?PHP echo $horario[$i]['hora'];?>" class="custom-select" data-cargo="tec" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                      <?PHP
                        foreach($tecs as $tec):
                      ?>
                      <option value="<?PHP echo $tec['id'];?>"><?PHP echo $tec['nome'];?>
                      </option>

                      <?PHP
                        endforeach;
                      ?>
                    </select>
                  </div>

                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">METAR:</label>
                    <textarea class="form-control input-blue" data-categoria="metar" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea><br>
                  </div>

                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Ocorrências:</label>
                    <textarea class="form-control input-blue" data-categoria="ocorrencias" data-hora="<?PHP echo $horario[$i]['hora'];?>"></textarea><br>
                  </div>

                  <div class="buttons">
                  <button type="submit" class="btn btn-raised btn-success send-text">Enviar</button>
                  </div>


                </form>
                <p class="sucesso-msg"></p>
              </td>
            </tr>
              <?PHP endfor;?>

          </tbody>
        </table>
      </div>

      <div id="info-gerais" class="menu-input-form">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th colspan="2">Informações Gerais</th>
            </tr>
            <tr>
              <td>
                <form class="reg-form form-txt" type="POST">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Informações:</label>
                    <textarea class="form-control" data-categoria="info-gerais"></textarea><br>
                  </div>

                  <div class="buttons">
                  <button type="submit" class="btn btn-raised btn-success send-text">Enviar</button>
                  </div>

                </form>
                <p class="sucesso-msg"></p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div id="sondagem" class="menu-input-form">
        <div class="center">
          <table class="table menu-input-table table-bordered">
          <tbody>
            <tr>
              <th colspan="2">Radiossondagem de Florianópolis</th>
            </tr>
            <tr>
              <?PHP for($i = 0; $i <= 1; $i++):?>
              <td>
                <p class="input-table-time"><?PHP echo $horario[$i]['hora'];?></p>
                <form class="reg-form form-img" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="input-btn-wrap">
                      <label for="<?PHP echo $cats['img'][2].''.$horario[$i]['hora'];?>" class="mui-btn mui-btn--fab mui-btn--primary inputBtn">+</label>
                      <input id="<?PHP echo $cats['img'][2].''.$horario[$i]['hora'];?>" type="file" name="<?PHP echo $cats['img'][2];?>" data-categoria="<?PHP echo $cats['img'][2];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>"/>
                    </div>
                    <button type="submit" class="mui-btn mui-btn--primary send-img">Enviar</button>
                    <button class="mui-btn mui-btn--danger img-cancel" type="button">Cancelar</button>
                  </div>
                </form>

                <div class="img-wrap" data-categoria="<?PHP echo $cats['img'][2];?>" data-hora="<?PHP echo $horario[$i]['hora'];?>">
                  <div class="img-overlay">
                    <span class="img-del" title="Excluir imagem"><webicon icon="fa:trash-o"/></span>
                  </div>
                </div>

                <p class="sucesso-msg"></p>
              </td>
              <?PHP endfor;?>
            </tr>
          </tbody>
        </table>
        </div>
      </div>

      <div id="fenomenos" class="menu-input-form">
        <div class="center">
          <div class="system-tags">
            <h2 class="header">Sistemas e Fenômenos</h2>
            <div class="system-tags-container">

            <?PHP foreach($sistemas_classes as $k => $class):;?>

              <div class="fenom-box">
                <h3 class="fenom-heading" data-class="<?PHP echo $class;?>"><?PHP echo $class;?></h3>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





<div class="bg-box"></div>
<div class="modal-box"></div>

<button class="scroll-top btn btn-primary" title="Ir para o topo" onclick="scrollToTop()"><i class="fa fa-long-arrow-up" aria-hidden="true"></i>
</button>

<!-- registries scripts -->
<script type="text/javascript">
  var date = "<?PHP echo $day;?>";
</script>
<script src="<?PHP echo BASE_URL;?>assets/js/registries/create-registry.js"></script>
<script src="<?PHP echo BASE_URL;?>assets/js/registries/delete-registry.js"></script>
<script src="<?PHP echo BASE_URL;?>assets/js/registries/read-one-registry.js"></script>
<script src="<?PHP echo BASE_URL;?>assets/js/registries/update-registry.js"></script>

<!-- load add-menu js -->
<script src="<?PHP echo BASE_URL;?>assets/js/add-menu.js"></script>

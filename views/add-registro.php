<?PHP echo $success; ?>

<div class="container">
  <h1>Adicionar Monitoramento do dia</h1>

  <form method="POST" enctype="multipart/form-data">

    <div>
      <h4 style="color: #005588; text-align: center">Imagem Sinótica</h4>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>
              <h5>00Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Imagem</label>
                <input class="send-imagem" type="file" name="im_sinotica00[]"/>
              </div>
            </td>
            <td>
              <h5>06Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="im_sinotica06[]"/>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <h5>12Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="im_sinotica12[]"/>
              </div>
            </td>
            <td>
              <h5>18Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="im_sinotica18[]"/>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>


    <div>
      <h4 style="color: #005588; text-align: center">Imagem Satélite</h4>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>
              <h5>00Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="im_satelite00[]"/>
              </div>
            </td>
            <td>
              <h5>06Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="im_satelite06[]"/>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <h5>12Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="im_satelite12[]"/>
              </div>
            </td>
            <td>
              <h5>18Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="im_satelite18[]"/>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <h4 style="color: #005588; text-align: center">Sondagem Florianópolis</h4>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>
              <h5>00Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="sondagem00[]"/>
              </div>
            </td>
            <td>
              <h5>12Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="sondagem12[]"/>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <h4 style="color: #005588; text-align: center">Altos Níveis</h4>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>
              <h5>00Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="altos_niveis00[]"/>
              </div>
            </td>
            <td>
              <h5>12Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="altos_niveis12[]"/>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <h4 style="color: #005588; text-align: center">Medios Níveis</h4>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>
              <h5>00Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="medios_niveis00[]"/>
              </div>
            </td>
            <td>
              <h5>12Z</h5>
              <div class="form-group">
                <label for="add_imagem">Inserir Imagem</label>
                <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
                <input class="send-imagem" type="file" name="medios_niveis12[]" style="display: none"/>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <h4 style="color: #005588; text-align: center">Descrição</h4>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>
              <h5>00Z</h5>
              <div class="form-group">
                <label for="categoria">Meteorologista:</label>
                <select name="descricao_meteoro_nome00[]" class="form-control">
                  <?PHP
                    foreach($mets as $met):
                  ?>
                  <option value="<?PHP echo $met['id'];?>"><?PHP echo $met['nome'];?>
                  </option>

                  <?PHP
                    endforeach;
                  ?>
                </select>
                <label for="descricao">Superfície:</label>
                <textarea name="descricao_meteoro_superficie00[]" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Níveis médios e altos:</label>
                <textarea name="descricao_meteoro_medios_altos00[]" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Condição de tempo:</label>
                <textarea name="descricao_meteoro_condicao_tempo00[]" id="descricao" class="form-control"></textarea>
              </div>
            </td>
            <td>
              <h5>06Z</h5>
              <div class="form-group">
                <label for="categoria">Meteorologista:</label>
                <select name="descricao_meteoro_nome06[]" class="form-control">
                  <?PHP
                    foreach($mets as $met):
                  ?>
                  <option value="<?PHP echo $met['id'];?>"><?PHP echo $met['nome'];?>
                  </option>

                  <?PHP
                    endforeach;
                  ?>
                </select>
                <label for="descricao">Superfície:</label>
                <textarea name="descricao_meteoro_superfice06[]" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Níveis médios e altos:</label>
                <textarea name="descricao_meteoro_medios_altos06[]" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Condição de tempo:</label>
                <textarea name="descricao_meteoro_condicao_tempo06[]" id="descricao" class="form-control"></textarea>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <h5>12Z</h5>
              <div class="form-group">
                <label for="categoria">Meteorologista:</label>
                <select name="descricao_meteoro_nome12[]" class="form-control">
                  <?PHP
                    foreach($mets as $met):
                  ?>
                  <option value="<?PHP echo $met['id'];?>"><?PHP echo $met['nome'];?>
                  </option>

                  <?PHP
                    endforeach;
                  ?>
                </select>
                <label for="descricao">Superfície:</label>
                <textarea name="descricao_meteoro_superfice12[]" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Níveis médios e altos:</label>
                <textarea name="descricao_meteoro_medios_altos12[]" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Condição de tempo:</label>
                <textarea name="descricao_meteoro_condicao_tempo12[]" id="descricao" class="form-control"></textarea>
              </div>
            </td>
            <td>
              <h5>18Z</h5>
              <div class="form-group">
                <label for="categoria">Meteorologista:</label>
                <select name="descricao_meteoro_nome18[]" class="form-control">
                  <?PHP
                    foreach($mets as $met):
                  ?>
                  <option value="<?PHP echo $met['id'];?>"><?PHP echo $met['nome'];?>
                  </option>

                  <?PHP
                    endforeach;
                  ?>
                </select>
                <label for="descricao">Superfície:</label>
                <textarea name="descricao_meteoro_superfice18[]" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Níveis médios e altos:</label>
                <textarea name="descricao_meteoro_medios_altos18[]" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Condição de tempo:</label>
                <textarea name="descricao_meteoro_condicao_tempo18[]" id="descricao" class="form-control"></textarea>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <h4 style="color: #005588; text-align: center">Registros Significativos</h4>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <h5>00Z</h5>
            <div class="form-group">
              <label for="categoria">Técnico:</label>
              <select name="categoria" class="form-control">
                <?PHP
                  foreach($tecs as $tec):
                ?>
                <option value="<?PHP echo $tec['id'];?>"><?PHP echo $tec['nome'];?>
                </option>

                <?PHP
                  endforeach;
                ?>
              </select>
              <label for="descricao">METAR:</label>
              <textarea name="descricao_tec_metar00[]" id="descricao" class="form-control"></textarea><br>
              <label for="descricao">Ocorrências</label>
              <textarea name="descricao_tec_ocorrencias00[]" id="descricao" class="form-control"></textarea><br>
            </div>
          </tr>
          <tr>
              <h5>06Z</h5>
              <div class="form-group">
                <label for="categoria">Técnico:</label>
                <select name="categoria" class="form-control">
                  <?PHP
                    foreach($tecs as $tec):
                  ?>
                  <option value="<?PHP echo $tec['id'];?>"><?PHP echo $tec['nome'];?>
                  </option>

                  <?PHP
                    endforeach;
                  ?>
                </select>
                <label for="descricao">METAR:</label>
                <textarea name="descricao_tec_metar06[]" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Ocorrências</label>
                <textarea name="descricao_tec_ocorrencias06[]" id="descricao" class="form-control"></textarea><br>
              </div>
          </tr>
          <tr>
            <h5>12Z</h5>
            <div class="form-group">
              <label for="categoria">Técnico:</label>
              <select name="categoria" class="form-control">
                <?PHP
                  foreach($tecs as $tec):
                ?>
                <option value="<?PHP echo $tec['id'];?>"><?PHP echo $tec['nome'];?>
                </option>

                <?PHP
                  endforeach;
                ?>
              </select>
              <label for="descricao">METAR:</label>
              <textarea name="descricao_tec_metar12[]" id="descricao" class="form-control"></textarea><br>
              <label for="descricao">Ocorrências</label>
              <textarea name="descricao_tec_ocorrencias12[]" id="descricao" class="form-control"></textarea><br>
            </div>
          </tr>
          <tr>
            <h5>18Z</h5>
            <div class="form-group">
              <label for="categoria">Técnico:</label>
              <select name="categoria" class="form-control">
                <?PHP
                  foreach($tecs as $tec):
                ?>
                <option value="<?PHP echo $tec['id'];?>"><?PHP echo $tec['nome'];?>
                </option>

                <?PHP
                  endforeach;
                ?>
              </select>
              <label for="descricao">METAR:</label>
              <textarea name="descricao_tec_metar18[]" id="descricao" class="form-control"></textarea><br>
              <label for="descricao">Ocorrências</label>
              <textarea name="descricao_tec_ocorrencias18[]" id="descricao" class="form-control"></textarea><br>
            </div>
          </tr>
        </tbody>
      </table>
    </div>



    <div class="form-group">
      <label for="titulo">Título:</label>
      <input type="text" name="titulo" id="titulo" class="form-control"/>
    </div>    
    <div class="form-group">
      <label for="valor">Valor:</label>
      <input type="text" name="valor" id="valor" class="form-control"/>
    </div>
    <div class="form-group">
      <label for="descricao">Descrição:</label>
      <textarea name="descricao" id="descricao" class="form-control"></textarea>
    </div>
    <div class="form-group">
      <label for="estado">Estado:</label>
      <select name="estado" id="estado" class="form-control">
        <option value="1">Muito Bom</option>
        <option value="2">Bom</option>
        <option value="3">Aceitável</option>
      </select>
    </div>
    <div class="form-group">
      <label for="add_imagem">Fotos do Anúncio:</label>
      <label for="send-imagem" class="btn btn-success">Adicionar Fotos</label>
      <input class="send-imagem" type="file" name="fotos[]" multiple/>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">Fotos do Anúncio</div>
      <div class="panel-body">
        
      </div>
    </div>
    <input type="submit" value="Adicionar" name="adicionar" class="btn btn-default"/>
    
  </form>
</div>

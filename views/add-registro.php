<?PHP echo $success; ?>

<div class="container">
  <h1>Adicionar Monitoramento do dia</h1>

  <form method="POST" enctype="multipart/form-data">
  
    <div class="form-group">
      <label for="categoria">Categoria:</label>
      <select name="categoria" id="categoria" class="form-control">
        <?PHP
          foreach($cats as $cat):
        ?>
        <option value="<?PHP echo $cat['id'];?>"><?PHP echo $cat['nome'];?>
        </option>
          
        <?PHP
          endforeach;
        ?>
      </select>
    </div>

    <div>
      <h4 style="color: #005588; text-align: center">Imagem Sinótica</h4>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>
              <h5>00Z</h5>
              <div class="form-group">
                <label for="add_foto">Inserir Imagem</label>
                <label for="send-fotos" class="btn btn-success">Adicionar Fotos</label>
                <input id="send-fotos" type="file" name="fotos[]" multiple/>
              </div>
            </td>
            <td>
              <h5>06Z</h5>
              <div class="form-group">
                <label for="add_foto">Inserir Imagem</label>
                <label for="send-fotos" class="btn btn-success">Adicionar Fotos</label>
                <input id="send-fotos" type="file" name="fotos[]" multiple/>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <h5>12Z</h5>
              <div class="form-group">
                <label for="add_foto">Inserir Imagem</label>
                <label for="send-fotos" class="btn btn-success">Adicionar Fotos</label>
                <input id="send-fotos" type="file" name="fotos[]" multiple/>
              </div>
            </td>
            <td>
              <h5>18Z</h5>
              <div class="form-group">
                <label for="add_foto">Inserir Imagem</label>
                <label for="send-fotos" class="btn btn-success">Adicionar Fotos</label>
                <input id="send-fotos" type="file" name="fotos[]" multiple/>
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
                <label for="add_foto">Inserir Imagem</label>
                <label for="send-fotos" class="btn btn-success">Adicionar Fotos</label>
                <input id="send-fotos" type="file" name="fotos[]" multiple/>
              </div>
            </td>
            <td>
              <h5>06Z</h5>
              <div class="form-group">
                <label for="add_foto">Inserir Imagem</label>
                <label for="send-fotos" class="btn btn-success">Adicionar Fotos</label>
                <input id="send-fotos" type="file" name="fotos[]" multiple/>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <h5>12Z</h5>
              <div class="form-group">
                <label for="add_foto">Inserir Imagem</label>
                <label for="send-fotos" class="btn btn-success">Adicionar Fotos</label>
                <input id="send-fotos" type="file" name="fotos[]" multiple/>
              </div>
            </td>
            <td>
              <h5>18Z</h5>
              <div class="form-group">
                <label for="add_foto">Inserir Imagem</label>
                <label for="send-fotos" class="btn btn-success">Adicionar Fotos</label>
                <input id="send-fotos" type="file" name="fotos[]" multiple/>
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
                <label for="descricao">Meteorologista:</label>
                <input type="text" name="meteoro" id="meteoro-nome" class="form-control"/><br>
                <label for="descricao">Superfície:</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Níveis médios e altos:</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Condição de tempo:</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea>
              </div>
            </td>
            <td>
              <h5>06Z</h5>
              <div class="form-group">
                <label for="descricao">Meteorologista:</label>
                <input type="text" name="meteoro" id="meteoro-nome" class="form-control"/><br>
                <label for="descricao">Superfície:</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Níveis médios e altos:</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Condição de tempo:</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <h5>12Z</h5>
              <div class="form-group">
                <label for="descricao">Meteorologista:</label>
                <input type="text" name="meteoro" id="meteoro-nome" class="form-control"/><br>
                <label for="descricao">Superfície:</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Níveis médios e altos:</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Condição de tempo:</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea>
              </div>
            </td>
            <td>
              <h5>18Z</h5>
              <div class="form-group">
                <label for="descricao">Meteorologista:</label>
                <input type="text" name="meteoro" id="meteoro-nome" class="form-control"/><br>
                <label for="descricao">Superfície:</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Níveis médios e altos:</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea><br>
                <label for="descricao">Condição de tempo:</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!--  Falta Inserir sondagem, médios e altos níveis e eventos significativos -->


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
      <label for="add_foto">Fotos do Anúncio:</label>
      <label for="send-fotos" class="btn btn-success">Adicionar Fotos</label>
      <input id="send-fotos" type="file" name="fotos[]" multiple/>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">Fotos do Anúncio</div>
      <div class="panel-body">
        
      </div>
    </div>
    <input type="submit" value="Adicionar" class="btn btn-default"/>
    
  </form>
</div>

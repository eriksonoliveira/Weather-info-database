<div class="home-container">
  <div class="search-wrap">
    <a href="<?PHP echo BASE_URL;?>pesquisar" class="btn btn-default home-search-btn"><i class="fa fa-search"></i>&nbsp; Fazer Pesquisa</a>
    <a href="<?PHP echo BASE_URL; ?>adicionar/registro" class="btn btn-default home-add-btn"><i class="fa fa-plus"></i>&nbsp; Adicionar Registro</a>
  </div>
</div>

<!--<div class="row container-fluid">
  <div class="col-sm-3">
    <h4>Pesquisa avançada</h4>
    <form method="GET">
      <div class="form-group">
        <label for="categoria">Categoria</label>
        <select id="categoria" name="filtros[categoria]" class="form-control">
          <option></option>
          <?PHP foreach($categorias as $cat):?> 
          <option value="<?PHP echo $cat['id']; ?>" <?PHP echo ($cat['id']==$filtros['categoria'])? 'selected="selected"' : ''; ?>><?PHP echo $cat['nome']; ?></option>
          <?PHP endforeach;?>
        </select>
      </div>
      <div class="form-group">
        <label for="valor">Preço</label>
        <select id="valor" name="filtros[valor]" class="form-control">
          <option></option>
          <option value="0-50" <?PHP echo ($filtros['valor']=='0-50')? 'selected="selected"' : ''; ?>>R$ 0 - 50</option>
          <option value="51-100" <?PHP echo ($filtros['valor']=='51-100')? 'selected="selected"' : ''; ?>>R$ 51 - 100</option>
          <option value="101-200" <?PHP echo ($filtros['valor']=='101-200')? 'selected="selected"' : ''; ?>>R$ 101 - 200</option>
          <option value="200-500" <?PHP echo ($filtros['valor']=='200-500')? 'selected="selected"' : ''; ?>>R$ 201 - 500</option>
        </select>
      </div>          
      <div class="form-group">
        <label for="estado">Estado</label>
        <select id="estado" name="filtros[estado]" class="form-control">
          <option></option>
          <option value="1" <?PHP echo ($filtros['estado']=='1')? 'selected="selected"': ''; ?>>Muito Bom</option>
          <option value="2" <?PHP echo ($filtros['estado']=='2')? 'selected="selected"': ''; ?>>Bom</option>
          <option value="3" <?PHP echo ($filtros['estado']=='3')? 'selected="selected"': ''; ?>>Aceitável</option>
        </select>
      </div>
      <div class="form-group">
        <button class="btn btn-info" type="submit">Filtrar</button>
      </div>
    </form>
  </div>
  <div class="col-sm-9">
    <h4>Últimos anúncios</h4>
    <table class="table table-striped">
      <tbody>
        <?PHP foreach($anuncios as $anuncio):?>
        <tr>
          <td>
           <?PHP if(!empty($anuncio['url'])): ?>
           <img src="<?PHP echo BASE_URL;?>assets/images/anuncios/<?PHP echo $anuncio['url']; ?>" height="40" border="0"/>
           <?PHP else:?>
           <img src="<?PHP echo BASE_URL;?>assets/images/anuncios/default.png" height="40" border="0"/>
           <?PHP endif;?>
          </td>
          <td>
            <a href="<?PHP echo BASE_URL;?>produto/abrir/<?PHP echo $anuncio['id'];?>"><?PHP echo $anuncio['titulo']; ?></a><br>
            <?PHP echo $anuncio['categoria']; ?>
          </td>
          <td>R$ <?PHP echo number_format($anuncio['valor'], 2); ?></td>
        </tr>
        <?PHP endforeach;?>
      </tbody>
    </table>

    <ul class="pagination">
      <?PHP for($q=1;$q <= $total_paginas;$q++):?>
      <li class="<?PHP echo ($p == $q)?'active':'' ?>">
        <a href="<?PHP echo BASE_URL;?>?<?PHP
        $w = $_GET;
        $w['p'] = $q;
        echo http_build_query($w);
        ?>"><?PHP echo $q;?></a></li>
      <?PHP endfor;?>
    </ul>
  </div>
</div>-->

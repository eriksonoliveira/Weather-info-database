<div class="container">
  <h1>Meus Anúncios - Editar Anúncio</h1>

  <form method="POST" enctype="multipart/form-data">
  
    <div class="form-group">
      <label for="categoria">Categoria:</label>
      <select name="categoria" id="categoria" class="form-control">
        <?PHP
          foreach($cats as $cat):
        ?>
        <option value="<?PHP echo $cat['id'];?>" <?PHP echo ($info['id_categoria'] == $cat['id'])? 'selected=selected':''; ?>><?PHP echo $cat['nome'];?>
        </option>
          
        <?PHP
          endforeach;
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="titulo">Título:</label>
      <input type="text" name="titulo" id="titulo" class="form-control" value="<?PHP echo $info['titulo'];?>"/>
    </div>    
    <div class="form-group">
      <label for="valor">Valor:</label>
      <input type="text" name="valor" id="valor" class="form-control" value="<?PHP echo $info['valor'];?>"/>
    </div>
    <div class="form-group">
      <label for="descricao">Descrição:</label>
      <textarea name="descricao" id="descricao" class="form-control"><?PHP echo $info['descricao'];?></textarea>
    </div>
    <div class="form-group">
      <label for="estado">Estado:</label>
      <select name="estado" id="estado" class="form-control">
        <option value="1" <?PHP echo ($info['estado'] == '1')? 'selected=selected':''; ?>>Muito Bom</option>
        <option value="2" <?PHP echo ($info['estado'] == '2')? 'selected=selected':''; ?>>Bom</option>
        <option value="3" <?PHP echo ($info['estado'] == '3')? 'selected=selected':''; ?>>Aceitável</option>
      </select>
    </div>
    <div class="form-group">
<!--      <label for="add_foto">Fotos do Anúncio:</label>-->
      <label for="send-fotos" class="btn btn-success">Adicionar Fotos</label>
      <input id="send-fotos" type="file" name="fotos[]" multiple/>
      <p id="num-fotos"></p>
    </div>
      
      <div class="panel panel-default">
        <div class="panel-heading">Fotos Anúncio</div>
        <div class="panel-body">
        <?PHP foreach($info['fotos'] as $foto): ?>
          <div class="foto_item">
            <img src="<?PHP echo BASE_URL; ?>assets/images/anuncios/<?PHP echo $foto['url'];?>" class="img-thumbnail" border="0"/>
            <a href="<?PHP echo BASE_URL; ?>excluir/foto/<?PHP echo $foto['id']; ?>" class="btn btn-sm btn-default">Excluir imagem</a>
          </div>
        <?PHP endforeach;?>
        </div>
      </div>
    <input type="submit" value="Salvar" class="btn btn-primary"/>
    
  </form>
</div>

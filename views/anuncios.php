<div class="container">
  <h1>Meus Anúncios</h1>
  
  <a href="<?PHP echo BASE_URL; ?>adicionar/anuncio" class="btn btn-default">Adicionar Anúncio</a>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Foto</th>
        <th>titulo</th>
        <th>Valor</th>
        <th>Ações</th>
      </tr>
    </thead>
    <?PHP
    foreach($anuncios as $anuncio) {
    ?>
       <tr>
         <td>
           <?PHP if(!empty($anuncio['url'])): ?>
           <img src="<?PHP echo BASE_URL; ?>assets/images/anuncios/<?PHP echo $anuncio['url']; ?>" height="40" border="0"/>
           <?PHP else:?>
             <img src="<?PHP echo BASE_URL; ?>assets/images/anuncios/default.png" height="40" border="0"/>
           <?PHP endif;?>
         </td>
         <td><?PHP echo $anuncio['titulo']; ?></td>
         <td>R$ <?PHP echo number_format($anuncio['valor'], 2); ?></td>
         <td>
          <a href="<?PHP echo BASE_URL; ?>editar/anuncio/<?PHP echo $anuncio['id']; ?>" class="btn btn-primary">Editar <span class="glyphicon glyphicon-edit"></span></a>
          <a href="<?PHP echo BASE_URL; ?>excluir/anuncio/<?PHP echo $anuncio['id']; ?>" class="btn btn-danger">Excluir <span class="glyphicon glyphicon-trash"></span></a>
         </td>
      </tr> 
    <?PHP
    }
    ?>
  </table>
</div>
<div class="container-fluid">
  <div class="col-sm-5">
    <div class="carousel slide" data-ride="carousel" id="meuCarousel">
      <div class="carousel-inner" role="listbox">
        <?PHP if(count($info['fotos']) > 0) { 
          foreach($info['fotos'] as $chave => $foto):?>
            <div class="item <?PHP echo ($chave == '0')? 'active':'';?>">
              <img src="<?PHP echo BASE_URL;?>assets/images/anuncios/<?PHP echo $foto['url'];?>" style="width:100%;"/>
            </div>
          <?PHP endforeach;
        } else {?>
          <div class="item active">
            <img src="<?PHP echo BASE_URL;?>assets/images/anuncios/default.png" style="width:100%;"/>
          </div>
        <?PHP
        }
        ?>
      </div>
      <a href="#meuCarousel" class="left carousel-control" role="button" data-slide="prev">
        <span class="icon-prev"></span>
      </a>
      <a href="#meuCarousel" class="right carousel-control" role="button" data-slide="next">
        <span class="icon-next"></span>
      </a>
    </div>
  </div>
  <div class="col-sm-7">
    <h1><?PHP echo $info['titulo'];?></h1>
    <h4><?PHP echo $info['categoria']?></h4>
    <p><?PHP echo $info['descricao']?></p>
    <br>
    <br>
    <h3>R$ <?PHP echo number_format($info['valor'], 2); ?></h3>
    <h4>Telefone: <?PHP echo $info['telefone']?></h4>
  </div>
</div>
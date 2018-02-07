<div class="search-page-container">
  <div class="search-sidebar">
    <form class="datepick">
      <label for="start">De:</label>
      <input type="text" id="start" name="calendar-1" autocomplete="off"/>

      <label for="end">Até:</label>
      <input type="text" id="end" name="calendar-2" autocomplete="off"/>

      <?PHP foreach($sistemas_class as $k => $class):?>
      <div class="systempick">
        <h4 class="systempick_header"><?PHP echo $class;?></h4>
        <div class="systempick-box">
        <?PHP
            foreach($sistemas as $sist):
              if(ucfirst($sist['class']) == $class):
          ?>
          <span>
            <input type="checkbox" data-id="<?PHP echo $sist['id'];?>"/><?PHP echo $sist['nome']."<br/>";?>
          </span>

          <?PHP
              endif;
            endforeach;
          ?>
        </div>
      </div>
      <?PHP endforeach;?>

      <button class="search-btn btn btn-default">Pesquisar</button>
    </form>
  </div>

  <div class="search-result-container">
    <div class="panel-group">
      <ul class="search-result-list panel"></ul>
    </div>
    <div class="chart">
      <canvas id="myChart" width="740" height="200"></canvas>
    </div>
  </div>


</div>


<div class="bg-box"></div>
<div class="img-modal-box">
  <img src="" width="100%"/>
</div>

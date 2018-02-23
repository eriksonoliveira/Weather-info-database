<div class="search-page-container">
  <div class="search-sidebar">
    <form class="datepick">
      <label for="start">De:</label>
      <input type="text" id="start" name="calendar-1" autocomplete="off"/>

      <label for="end">Até:</label>
      <input type="text" id="end" name="calendar-2" autocomplete="off"/>

      <div class="systempick">
      <?PHP foreach($sistemas_class as $k => $class):?>
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
      <?PHP endforeach;?>
      </div>

      <button class="search-btn btn"><i class="fa fa-search"></i>&nbsp; Pesquisar</button>
    </form>
  </div>

  <div class="result-wrap">
    <div class="result-table"></div>
    <div class="result-stats-wrap">
      <div class="result-stats-heading"></div>
      <div class="result-stats">
        <div class="chart"></div>
        <div class="result-sum">
          <div></div>
        </div>
      </div>
    </div>
  </div>


</div>


<div class="bg-box"></div>
<div class="modal-box"></div>

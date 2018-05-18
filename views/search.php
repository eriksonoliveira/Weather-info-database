<div class="search-page-container">
<!--   <button class="btn bmd-btn-fab show-sidebar">
    <i class="material-icons">search</i>
  </button> -->
  <div class="search-sidebar">
    <button type="button" class="close close-sidebar" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <form class="datepick">
      <div class="form-group bmd-form-group mb-0">
        <label for="start" class="bmd-label-floating">De:</label>
        <input type="text" id="start" name="calendar-1" autocomplete="off" class="form-control input-green"/>
      </div>
      <div class="form-group bmd-form-group">
        <label for="end" class="bmd-label-floating">Até:</label>
        <input type="text" id="end" name="calendar-2" autocomplete="off" class="form-control input-green"/>
      </div>

      <div class="systempick">
      <?PHP foreach($sistemas_class as $k => $class):?>
        <h4 class="systempick_header"><?PHP echo $class;?></h4>
        <div class="systempick-box">
        <?PHP
            foreach($sistemas as $sist):
              if(ucfirst($sist['class']) == $class):
          ?>
          <span>
            <input class="css-checkbox" type="checkbox" id="check-<?PHP echo $sist['id'];?>" data-id="<?PHP echo $sist['id'];?>"/>
            <label class="css-label" for="check-<?PHP echo $sist['id'];?>"><?PHP echo $sist['nome'];?></label>
            <?PHP //echo $sist['nome']."<br/>";?>
          </span>

          <?PHP
              endif;
            endforeach;
          ?>
        </div>
      <?PHP endforeach;?>
      </div>

      <button class="search-btn mui-btn"><i class="fa fa-search"></i>&nbsp; Pesquisar</button>
    </form>
  </div>

  <div class="result-wrap">
    <nav class="result-table-pagination" aria-label="Page navigation">
      <ul class="pagination"></ul>
    </nav>
    <div class="result-table"></div>
    <div class="result-stats-wrap">
      <div class="result-stats">
        <div class="chart"></div>
        <div class="result-sum">
          <div></div>
        </div>
      </div>
    </div>
    <div class="loader-wrap">
      <div class="loader"></div>
    </div>
  </div>


</div>


<div class="bg-box"></div>
<div class="modal-box"></div>

<script src="<?PHP echo BASE_URL;?>assets/js/jquery.twbsPagination.min.js"></script>
<script src="<?PHP echo BASE_URL;?>assets/js/registries/search-registry.js"></script>

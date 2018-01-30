$(document).ready(function() {

  //PESQUISA REGISTROS
  $(".search-btn").on("click", function(e) {
    let btn = $(this);
    searchRegistry(e, btn);
  });

});

//SEARCH REGISTRIES WITHIN THE SPECIFIED DATA RANGE
function searchRegistry(e, btn) {
  e.preventDefault();

  var data = new FormData();

  var start = $(btn).siblings("#start").val(),
      end = $(btn).siblings("#end").val(),
      systems = [];

  var resultList = $(btn).parents(".search-page-container").find(".search-result-list"),
      resultTotal = $(resultList).siblings(".search-result-total"),
      checked = $(btn).siblings("div").find(".systempick").find("input:checked");

  $(checked).each(function() {
    var id = $(this).attr("data-id");
    systems.push({key: id});
  });

  //Se a data final não foi especificada
  if(!end) {
    var separator = "slash";
    end = dateFormated(separator);
  }

  data.append("dateStart", start);
  data.append("dateEnd", end);
  data.append("systems", JSON.stringify(systems));

  $.ajax({
    type: 'POST',
    url: 'http://localhost/projetoy/Monitoramento/pesquisar/data',
    data: data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function(json) {

      console.log(json);

      if(json.length == 0){
        $(resultList).empty();
      } else {
        $(resultList).empty();

        var d;
        var result_items_html = "";

//        for(d in json[0]) {
        $.each(json[0], function(key, value) {

          //Lists the result dates

          //Creates a collapsible list
          result_items_html+="<li class='result-item panel-heading'>";
            result_items_html+="<a class='collapsed panel-title' data-toggle='collapse' href='#collapse-"+value.date+"'>"+value.date;
            result_items_html+="<span class='collapse-icon'></span>";
          result_items_html+="</a>";
          result_items_html+="</li>";

          result_items_html+="<div class='collapse panel-collapse' id='collapse-"+value.date+"'>";
            result_items_html+="<div class='panel-body'>";
              result_items_html+="<div class='flex-container'>";
                result_items_html+="<div class='flex-container-text'>";

                // weather description text
                if(value.info.met["06Z"].superficie.text){
                  result_items_html+="<ul>";
                    result_items_html+="<li>";
                      result_items_html+="<strong>Superfície:</strong> "+value.info.met["06Z"].superficie.text;
                    result_items_html+="</li>";
                    result_items_html+="<li>";
                      result_items_html+="<strong>Condição:</strong> "+value.info.met["06Z"].condicao_tempo.text;
                    result_items_html+="</li>";
                  result_items_html+="</ul>";

                } else {
                  result_items_html+="<p>Sem informações para este dia</p>";
                }

                  result_items_html+="<a href='http://localhost/projetoy/Monitoramento/registros/?date="+value.date+"' target='_blank'>Registro Completo";

          /******CONTINUE FROM HERE*******/

                  result_items_html+="</a>";
                result_items_html+="</div>";

                // satellite image
                result_items_html+="<div class='flex-container-img'>";
                  result_items_html+="<img src='"+appendImg(value)+"'/>";
                result_items_html+="</div>";
              result_items_html+="</div>";
            result_items_html+="</div>";
          result_items_html+="</div>";

          // inject to 'resultList'
          $(resultList).html(result_items_html);
        });

        // set img 'src' attribute
        function appendImg(value) {
          if(value.info.img["06Z"].im_satelite.fileName) {
            return "http://localhost/projetoy/Monitoramento/assets/images/im_satelite/"+value.info.img["06Z"].im_satelite.fileName;
          } else {
            return "http://localhost/projetoy/Monitoramento/assets/images/default.png";
          }
        }
      }
    }
  });
}

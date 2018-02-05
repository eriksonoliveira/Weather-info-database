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

      if(json[0].data.length == 0){
        $(resultList, "#myChart").empty();
      } else {
        $(resultList).empty();

        var d;
        var result_items_html = "";

        //Draw chart
        drawLineChart(json[0]['chart']);

        //Create table
        $.each(json[0].data, function(key, value) {

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

                  result_items_html+="<a href='http://localhost/projetoy/Monitoramento/registros/?date="+value.date+"' target='_blank'>";

                    result_items_html+="<button class='btn view-registry'>Ver/Editar</button>";

                  result_items_html+="</a>";
                result_items_html+="</div>";

                // satellite image
                result_items_html+="<div class='flex-container-img'>";
                  result_items_html+=appendImg(value);
                result_items_html+="</div>";
              result_items_html+="</div>";
            result_items_html+="</div>";
          result_items_html+="</div>";

          // inject to 'resultList'
          $(resultList).html(result_items_html);
        });

      }
    }
  });
}

// set img 'src' attribute
function appendImg(value) {
  var result_img = '';
  if(value.info.img["06Z"].im_satelite.fileName) {

    result_img += "<a href='javascript:;' class='img-clickable'>";
      result_img += "<img src='http://localhost/projetoy/Monitoramento/assets/images/im_satelite/"+value.info.img["06Z"].im_satelite.fileName+"'/>";
    result_img += "</a>";

    return result_img;
  } else {

    result_img += "<img src='http://localhost/projetoy/Monitoramento/assets/images/default.png'/>";

    return result_img;
  }
}


//CHART
function drawLineChart(results) {

    // Split timestamp and data into separate arrays
    var labels = [], data=[];
    results.forEach(function(key, packet) {
      console.log(packet);
      labels.push(key.month);
      data.push(key.count);
    });

    // Create the chart.js data structure using 'labels' and 'data'
    var tempData = {
      labels : labels,
      datasets : [{
        label: "Dias",
        backgroundColor      : "rgba(20,50,80,0.7)",
        pointColor            : "rgba(151,187,205,1)",
        pointStrokeColor      : "#fff",
        pointHighlightFill    : "#fff",
        pointHighlightStroke  : "rgba(151,187,205,1)",
        data                  : data
      }]
    };

    // Get the context of the canvas element we want to select
    var ctx = document.getElementById("myChart").getContext("2d");
/*ctx.canvas.width = 300;
ctx.canvas.height = 200;*/
    // Instantiate a new chart
    var myLineChart = new Chart(ctx, {

       type: 'bar',
       data: tempData,
       options: {
         responsive: false,
         maintainAspectRatio: true,
         scales: {
           yAxes: [{
             ticks: {
               beginAtZero: true
             }
           }],
           xAxes: [{
             barPercentage: 0.4
           }]
         }
       }
    });
//  });
}

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
      checked = $(btn).siblings(".systempick").find(".systempick-box").find("input:checked");

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
        result_items_html+="<table class='table table-hover'>";
          result_items_html+="<tr>";
            result_items_html+="<th>Data</th>";
            result_items_html+="<th>Im. Satélite</th>";
            result_items_html+="<th>Descrição</th>";
            result_items_html+="<th></th>";
          result_items_html+="</tr>";

        //Create table
        $.each(json[0].data, function(key, value) {

          result_items_html+="<tr>";
            result_items_html+="<td>"+value.date+"</td>";
            result_items_html+="<td>";
              result_items_html+=appendImg(value);
            result_items_html+="</td>";
            result_items_html+="<td>";
                // weather description text
                if(value.info.met["06Z"].superficie.text){

                  result_items_html+="<p><strong>Superfície:</strong> "+value.info.met["06Z"].superficie.text+"</p>";
                  result_items_html+="<p><strong>Condição:</strong> "+value.info.met["06Z"].condicao_tempo.text+"</p>";

                } else {
                  result_items_html+="<p>Sem informações para este dia</p>";
                }
            result_items_html+="</td>";
            result_items_html+="<td>";
              //action button
              result_items_html+="<a href='http://localhost/projetoy/Monitoramento/registros/?date="+value.date+"' target='_blank'>";

                //edit button
                result_items_html+="<button class='btn view-registry'>Ver/Editar</button>";

              result_items_html+="</a>"
            result_items_html+="</td>";
          result_items_html+="</tr>";




        });
        result_items_html+="</table>";

        // inject to 'resultList'
        $(resultList).html(result_items_html);

      }
    }
  });
}

// set img 'src' attribute
function appendImg(value) {
  var result_img = '';
  if(value.info.img["06Z"].im_satelite.fileName) {

    result_img += "<a href='javascript:;' class='img-clickable'>";
      result_img += "<img src='http://localhost/projetoy/Monitoramento/assets/images/im_satelite/"+value.info.img["06Z"].im_satelite.fileName+"' class='result-table-img'/>";
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
      label                : "Número de dias",
      backgroundColor      : "rgba(38, 57, 73, 0.7)",
      data                 : data
    }]
  };

  // Get the context of the canvas element we want to select
  var ctx = document.getElementById("myChart").getContext("2d");
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
           offset: true,
           gridLines: {
             offsetGridLines: true
           },
           barPercentage: 0.3,
           type: 'time',
           time: {
             unit: 'month',
             round: 'month',
             displayFormats: {
               month: 'MMM YYYY'
             }
           }
         }]
       }
     }
  });
}

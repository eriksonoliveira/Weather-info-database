$(document).ready(function() {

  //PESQUISA REGISTROS
  $(".search-btn").on("click", function(e) {
    let btn = $(this);
    searchRegistry(e, btn);
  });

});

var start, end, systems, draw, resultList;

//SEARCH REGISTRIES WITHIN THE SPECIFIED DATA RANGE
function searchRegistry(e, btn) {
  e.preventDefault();

  let data = new FormData();

  start = $(btn).siblings("#start").val();
  end = $(btn).siblings("#end").val();
  systems = [];
  draw = true;

  resultList = $(btn).parents(".search-page-container").find(".result-table");
  var checked = $(btn).siblings(".systempick").find(".systempick-box").find("input:checked");

  //Get checked checkboxes
  $(checked).each(function() {
    var id = $(this).attr("data-id");
    systems.push({key: id});
  });

  if(systems.length == 0) {
    draw = false;
  }

  //Se a data final não foi especificada
  if(!end) {
    var separator = "slash";
    end = dateFormated(separator);
  }

  data.append("dateStart", start);
  data.append("dateEnd", end);
  data.append("systems", JSON.stringify(systems));
  data.append("page", 1);

  $.ajax({
    type: 'POST',
    url: 'http://localhost/projetoy/Monitoramento/pesquisar/data',
    data: data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function(json){
      showResults(json);

      pageNumbers(json);
    }
  });
}

function showResults(json) {
  console.log(json);

  //Clear table and chart
  $("#myChart").remove();
  $(".result-stats-wrap").hide();
  $(resultList).empty();

  //End if return is empty
  if(json[0].data.length == 0){
    return;
  } else {

    var result_items_html = "";

    //Apend canvas element and draw chart
    if(draw) {
      $(".chart").append("<canvas id='myChart'></canvas>").addClass("chart-dimensions");
      $(".result-stats-wrap").show();
      drawLineChart(json[0]['chart']);
    }

    //Create table head
    result_items_html+="<table class='table table-hover'>";
      result_items_html+="<tr>";
        result_items_html+="<th colspan='4'>Registros</th>";
      result_items_html+="</tr>";
      result_items_html+="<tr class='result-table-categories'>";
        result_items_html+="<td class='th-date'>Data</th>";
        result_items_html+="<td class='th-img'>Im. Satélite</th>";
        result_items_html+="<td class='th-info'>Descrição</th>";
        result_items_html+="<td class='th-action'></th>";
      result_items_html+="</tr>";

    //Create table body
    $.each(json[0].data, function(key, value) {

      result_items_html+="<tr>";
      //Date
        result_items_html+="<td class='cell-center'>"+value.date+"</td>";
      //Image
        result_items_html+="<td>";
          result_items_html+=appendImg(value);
        result_items_html+="</td>";
      // weather description text
        result_items_html+="<td>";
          if(value.info.met["06Z"].condicao_tempo.text){

            /*result_items_html+="<p><strong>Superfície:</strong> "+value.info.met["06Z"].superficie.text+"</p>";*/
            result_items_html+="<p><strong>Condição:</strong> "+value.info.met["06Z"].condicao_tempo.text+"</p>";

          } else {
            result_items_html+="<p>Sem informações para este dia</p>";
          }

          result_items_html+="<p class='ocorrencias'><strong>Ocorrências:</strong></p>";
          result_items_html+="<p>"+appendPhenom(value.info.phenom)+"</p>";
        result_items_html+="</td>";
        result_items_html+="<td class='cell-center'>";
          //action button
          result_items_html+="<a href='http://localhost/projetoy/Monitoramento/registros/?date="+value.date+"' target='_blank'>";

            //edit button
            result_items_html+="<button class='btn view-registry'>Visualizar</button>";

          result_items_html+="</a>"
        result_items_html+="</td>";
      result_items_html+="</tr>";

    });
    result_items_html+="</table>";

    //inject to 'resultList'
    $(resultList).html(result_items_html);

  }
}

//Pagination
function pageNumbers(json) {
  var num_pages = json[0].num_pages,
      pages_links = '';
  for(let count = 0; count < num_pages; count++) {
    pages_links+="<li class='page-filter'>";
      pages_links+="<a href='#"+(count+1)+"' onclick='getPage("+(count+1)+", this)'>"+(count+1)+"</a>";
    pages_links+="</li>";
  }

  $(".result-table-pagination ul").html(pages_links);
  $(".result-table-pagination ul").children().first().addClass("active");
}

// set img 'src' attribute
function appendImg(value) {
  var result_img = '';
  if(value.info.img["06Z"].im_satelite.fileName) {

    //Create html structure
    result_img +=
      "<a href='javascript:;' class='img-clickable'>" +
        "<img src='http://localhost/projetoy/Monitoramento/assets/images/im_satelite/"+value.info.img["06Z"].im_satelite.fileName+"' class='result-table-img'/>" +
      "</a>";

    return result_img;
  } else {

    //Show default image
    result_img += "<img src='http://localhost/projetoy/Monitoramento/assets/images/default.png' class='result-table-img'/>";

    return result_img;
  }
}

function appendPhenom(data) {
  let result_phenom = '',
      array = [],
      category, phenom;

  for(var p in data ) {
    category = data[p];
    for(var i in category) {
      phenom = data[p][i];
      if(phenom) {
        //Push phenom names into 'array'
        array.push(phenom.syst);

      } else {
        return "Sem registro";
      }
    }
  }
  //Create string containing the phenomena names
  result_phenom = array.join(", ");
  return result_phenom;
}


//CHART
function drawLineChart(results) {
  // Split timestamp and data into separate arrays
  var labels = [], data=[], sum=0;
  results.forEach(function(key, packet) {
    sum+=Number(key.count);
    labels.push(key.month);
    data.push(key.count);
  });

  // Create the chart.js data structure using 'labels' and 'data'
  var tempData = {
    labels : labels,
    datasets : [{
      label                : "Ocorrências",
      backgroundColor      : "rgba(93, 208, 184, 0.7)",
      borderColor          : "rgb(32, 190, 158, 1)",
      borderWidth          : 2,
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
       legend: {display: false},
       title: {
         display: true,
         text: "Número de dias (por mês)"
       },
       layout: {
         padding: {
           top: 10,
           bottom: 10
         }
       },
       responsive: true,
       maintainAspectRatio: true,
       scales: {
         yAxes: [{
           ticks: {
             beginAtZero: true,
             stepSize: 1
           }
         }],
         xAxes: [{
           offset: true,
           gridLines: {
             offsetGridLines: false
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

  showSum(sum);

}

function showSum(sum) {
  if(sum > 0) {
    let result_total = '';


    result_total+="<div>";
      result_total+="<i class='fa fa-bar-chart'></i>";
    result_total+="</div>";
    result_total+="<div>";
      result_total+="<div><small><strong>Total</strong></small></div>";
      result_total+="<strong>"+sum+"</strong>";
      if(sum > 1) {
        result_total+="<small>Dias</small>";
      } else {
        result_total+="<small>Dia</small>";
      }
    result_total+="</div>";

    $(".result-sum div").html(result_total);
  }
}

function getPage(page, elem) {
  let data = new FormData();

  data.append("dateStart", start);
  data.append("dateEnd", end);
  data.append("systems", JSON.stringify(systems));
  data.append("page", page);

  var parent  = $(elem).parent();

  console.log(parent);

    $.ajax({
    type: 'POST',
    url: 'http://localhost/projetoy/Monitoramento/pesquisar/data',
    data: data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function(json){
      showResults(json);
    }
  });

  $(".page-filter").removeClass("active");
  $(parent).addClass("active");
}

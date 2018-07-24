"use strict";

$(document).ready(function () {

  //PESQUISA REGISTROS
  $(".search-btn").on("click", function (e) {
    var btn = $(this);
    searchRegistry(e, btn);
  });

  //SHOW SIDEBAR ON SMALL SCREENS
  $(".show-sidebar").on("click", function () {
    $(".search-sidebar").addClass("active");
  });

  //CLOSE SIDEBAR
  $(".close-sidebar").on("click", function () {
    $(".search-sidebar").removeClass("active");
  });
});

var start, end, systems, draw, resultList;

//SEARCH REGISTRIES WITHIN THE SPECIFIED DATA RANGE
function searchRegistry(e, btn) {
  e.preventDefault();

  var data = new FormData();

  start = $(btn).siblings(".form-group").find("#start").val();
  end = $(btn).siblings(".form-group").find("#end").val();
  systems = [];
  draw = true;

  resultList = $(btn).parents(".search-page-container").find(".result-table");
  var checked = $(btn).siblings(".systempick").find(".systempick-box").find("input:checked");

  //Get checked checkboxes
  $(checked).each(function () {
    var id = $(this).attr("data-id");
    systems.push({ key: id });
  });

  if (systems.length == 0) {
    draw = false;
  }

  //Se a data final não foi especificada
  if (!end) {
    var separator = "dash",
        date = '',
        format = "BRZ";
    end = dateFormated(separator, date, format);
  }

  data.append("dateStart", start);
  data.append("dateEnd", end);
  data.append("systems", JSON.stringify(systems));
  data.append("page", 1);

  $.ajax({
    type: 'POST',
    url: baseUrl + 'pesquisar/data',
    data: data,
    dataType: 'json',
    beforeSend: function beforeSend() {
      $(".loader-wrap").addClass("show");
    },
    contentType: false,
    processData: false,
    success: function success(json) {
      $(".loader-wrap").removeClass("show");

      showResults(json);
      pageNumbers(json);
    }
  });
}

function showResults(json) {
  //Clear table and chart
  $("#myChart").remove();
  $(".result-stats-wrap").hide();
  $(resultList).empty();

  //End if return is empty
  if (json[0].data.length == 0) {
    var emptyResult = "<div class='result-empty'>Nenhum registro encontrado</div>";
    $(resultList).html(emptyResult);
    return;
  } else {

    var result_items_html = "";

    //Apend canvas element and draw chart
    if (draw) {
      $(".chart").append("<canvas id='myChart' style='background-color: #20BE9E;'></canvas>").addClass("chart-dimensions");
      $(".result-stats-wrap").show();
      drawLineChart(json[0]['chart']);
    }

    var results_table = renderTable(json);

    //inject to 'resultList'
    $(resultList).html(results_table);
  }
}

//Pagination
function pageNumbers(json) {
  var $pagination = $(".result-table-pagination ul");

  var totalPages = Math.ceil(json[0].num_pages),
      defaultOpts = {
    totalPages: totalPages,
    visiblePages: 5,
    first: 'Primeira',
    prev: 'Anterior',
    next: 'Próxima',
    last: 'Última',
    onPageClick: function onPageClick(event, page) {
      getPage(page);
    }
  };

  $pagination.twbsPagination('destroy');
  $pagination.twbsPagination($.extend({}, defaultOpts));
}

function renderTable(json) {
  var result_items_html = '';

  //Create table head
  result_items_html += "<div class='table-responsive-md'>";
  result_items_html += "<table class='table table-hover'>";
  result_items_html += "<tr>";
  result_items_html += "<th colspan='4'>Registros</th>";
  result_items_html += "</tr>";
  result_items_html += "<tr class='result-table-categories'>";
  result_items_html += "<td class='th-date'>Data</th>";
  result_items_html += "<td class='th-img'>Im. Satélite</th>";
  result_items_html += "<td class='th-info'>Descrição</th>";
  result_items_html += "<td class='th-action'></th>";
  result_items_html += "</tr>";

  //Create table body
  $.each(json[0].data, function (key, value) {
    var formatDate = value.date.split("-");
    var dateFormatBr = formatDate[2] + "-" + formatDate[1] + "-" + formatDate[0];

    result_items_html += "<tr>";
    //Date
    result_items_html += "<td class='cell-center result-table-date'>" + dateFormatBr + "</td>";
    //Image
    result_items_html += "<td>";
    result_items_html += appendImg(value);
    result_items_html += "</td>";
    // weather description text
    result_items_html += "<td>";
    if (value.info.met["06Z"].condicao_tempo.text) {

      result_items_html += "<p class='mb-3'><strong>Condição:</strong> " + value.info.met["06Z"].condicao_tempo.text + "</p>";
    } else {
      result_items_html += "<p class='mb-3'>Sem informações para este dia</p>";
    }

    result_items_html += "<p class='ocorrencias'><strong>Ocorrências:</strong></p>";
    result_items_html += "<p>" + appendPhenom(value.info.phenom) + "</p>";
    result_items_html += "</td>";
    result_items_html += "<td class='cell-center'>";
    //action link
    result_items_html += "<a href='" + baseUrl + "registros/ver/" + value.date + "' target='_blank'>";

    //view button
    result_items_html += "<button class='mui-btn view-registry'>Visualizar</button>";

    result_items_html += "</a>";
    result_items_html += "</td>";
    result_items_html += "</tr>";
  });
  result_items_html += "</table>";
  result_items_html += "</div>";

  return result_items_html;
}

// set img 'src' attribute
function appendImg(value) {
  var result_img = '';
  if (value.info.img["06Z"].im_satelite.fileName) {

    //Create html structure
    result_img += "<a href='javascript:;' class='img-clickable'>" + "<img src='" + baseUrl + "assets/images/im_satelite/" + value.info.img["06Z"].im_satelite.fileName + "' class='result-table-img'/>" + "</a>";

    return result_img;
  } else {

    //Show default image
    result_img += "<img src='" + baseUrl + "assets/images/default-thumbnail.jpg' class='result-table-img'/>";

    return result_img;
  }
}

function appendPhenom(data) {
  var result_phenom = '',
      array = [],
      category = void 0,
      phenom = void 0;

  for (var p in data) {
    category = data[p];
    for (var i in category) {
      phenom = data[p][i];
      if (phenom) {
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
  var labels = [],
      data = [],
      sum = 0;
  results.forEach(function (key, packet) {
    sum += Number(key.count);
    labels.push(key.month);
    data.push(key.count);
  });

  // Create the chart.js data structure using 'labels' and 'data'
  var tempData = {
    labels: labels,
    datasets: [{
      label: "Ocorrências",
      backgroundColor: "rgba(146,224,208, 0.7)",
      data: data
    }]
  };

  // Get the context of the canvas element we want to select
  var ctx = document.getElementById("myChart").getContext("2d");
  // Instantiate a new chart
  var myLineChart = new Chart(ctx, {

    type: 'bar',
    data: tempData,
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: "NÚMERO DE DIAS (por mês)",
        fontColor: "#EEE"
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
            stepSize: 1,
            fontColor: "#EEE"
          },
          gridLines: {
            color: "#BBB",
            zeroLineColor: "#BBB"
          }
        }],
        xAxes: [{
          offset: true,
          gridLines: {
            offsetGridLines: false,
            color: "#BBB"
          },
          type: 'time',
          time: {
            unit: 'month',
            round: 'month',
            displayFormats: {
              month: 'MMM YYYY'
            }
          },
          ticks: {
            fontColor: "#EEE",
            autoSkip: false
          }
        }]
      }
    }
  });

  showSum(sum);
}

function showSum(sum) {
  if (sum > 0) {
    var result_total = '';

    result_total += "<div>";
    result_total += "</div>";
    result_total += "<div>";
    result_total += "<div><small><strong>TOTAL</strong></small></div>";
    result_total += "<strong>" + sum + "</strong>";
    if (sum > 1) {
      result_total += "<small>DIAS</small>";
    } else {
      result_total += "<small>DIA</small>";
    }
    result_total += "</div>";

    $(".result-sum div").html(result_total);
  }
}

//Get new data
function getPage(page) {
  var data = new FormData();

  data.append("dateStart", start);
  data.append("dateEnd", end);
  data.append("systems", JSON.stringify(systems));
  data.append("page", page);

  $.ajax({
    type: 'POST',
    url: baseUrl + 'pesquisar/data',
    data: data,
    dataType: 'json',
    beforeSend: function beforeSend() {
      //Show loader animation
      $(".loader-wrap").addClass("show");
    },
    contentType: false,
    processData: false,
    success: function success(json) {
      //Hide animation
      $(".loader-wrap").removeClass("show");

      var results_table = renderTable(json);
      //insert table into 'resultList'
      $(resultList).html(results_table);
    }
  });
}

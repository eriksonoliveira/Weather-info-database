$(document).ready(function() {

  //If no date was passed, use the date of the current day
  if(date === false) {
    var separator = "dash";
    date = dateFormated(separator);
  }

    //PREVIEW IMAGE BEFORE UPLOAD
  $("input[type=file]").change(function(e) {
    let inputFile = $(this);
    previewImages(e, inputFile);
  });

  //UPLOAD IMAGES
  $(".send-img").on("click", function(e) {
    let btn = $(this);
    sendImage(e, btn, date);
  console.log(date);
  });

  //SEND TEXT
  $(document).on("click", ".send-text", function(e) {
    let btn = $(this);
    sendText(e, btn, date);
  });

  //SEND TAG
  $(".fenom input[type=checkbox]").change(function() {
    if(this.checked) {
     let checkbox = $(this);
     sendTag(checkbox, date);
    }
  });

});

//CRIA PREVIEW DA IMAGEM SELECIONADA PARA UPLOAD
function previewImages (e, input) {

  var imPreview = $(input).parents(".form-img").next(".img-wrap"),
      imOverlay = $(imPreview).find(".img-overlay"),
      inputWrap = $(input).parent(),
      inputForm = $(input).parents(".form-img"),
      img_html = '';

  var cancelBtn = $(imPreview).prev("form").find(".img-cancel"),
      sendBtn = $(imPreview).prev("form").find(".send-img");

  //Create image preview and delete button overlay
  img_html+="<a href='javascript:;'>";
    img_html+="<img src='"+URL.createObjectURL(e.target.files[0])+"' class='img-width img-fluid'/>";
  img_html+="</a>";

  $(imPreview).append(img_html);
  $(imOverlay).css("display", "none");
  $(inputForm).css("z-index", "2");

  //Toggle form buttons
  $([cancelBtn, sendBtn]).each(function() {
    $(this).show();
  });
    $(inputWrap).hide();

  //Remove image preview and restore form to default when click "Cancel"
  $(cancelBtn).on("click", function() {
    $(imPreview).find("img").remove();

    $([cancelBtn, sendBtn]).each(function() {
      $(this).hide();
    });
    $(inputWrap).show();

  });
}

//Add new Image to the record
function sendImage(e, btn, regDate) {
  e.preventDefault();

  let form = $(btn).parents(".form-img"),
      imagem = $(form).find("input[type=file]")[0].files;

  if(imagem.length > 0) {
    //DOM elements
    let sendBtn = $(btn),
        cancelBtn = $(btn).siblings(".img-cancel"),
        imgWrap = $(btn).parents(".form-img").siblings(".img-wrap"),
        inputForm = $(btn).parents(".form-img"),
        imOverlay = $(imgWrap).find(".img-overlay"),
        imgTag = $(imgWrap).find("img"),
        imgLink = $(imgWrap).find("a"),
        horario = $(form).find("input[type=file]").attr("data-hora"),
        categoria = $(form).find("input[type=file]").attr("data-categoria"),
        successMsg = $(form).nextAll(".sucesso-msg").first();

    let path = "ajax";

    let data = new FormData();
    data.append("date", regDate);
    data.append("horario", horario);
    data.append("categoria", categoria);
    data.append("imagem", imagem[0]);

    //Run this function after success of AJAX request
    function callback(json) {
      if(json.success = "yes") {

        //Show message and hide it after 3 seconds
        $(successMsg).html("Imagem enviada com sucesso!");
        setTimeout(function() {
          $(successMsg).fadeOut();
        }, 3000);

        //Display image thumbnail
        $(imgTag).attr("id", "img-"+json.imgId).attr("class", "img-width img-fluid");
        $(imgLink).attr("class", "img-clickable");
        $(imOverlay).css("display", "flex");

        $([sendBtn, cancelBtn]).each(function() {
          $(this).hide();
        });

        $(inputForm).css("z-index", "auto");
      }
    }

    //Send image to the Database and run callback function
    let Image = new AjaxRequest(data);
    Image.call(path, callback);
  }
}

function sendText(e, btn, regDate) {
  e.preventDefault();

  var data = new FormData();
  var elements = new KeyElements(btn);

  $(elements.textArea).each(function() {

    var categoria = $(this).attr("data-categoria"),
        texto = $(this).val(),
        successMsg = $(this).parents(".reg-form").siblings(".sucesso-msg");

    if($.trim(texto).length > 0) {

      data.append("date", regDate);
      data.append("horario", elements.horario);
      data.append("categoria", categoria);
      data.append("texto", texto);
      data.append("id_nome", elements.nome);
      data.append("cargo", elements.cargo);

      $.ajax({
        type: 'POST',
        url: baseUrl+'ajax',
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(json) {

          elements.success = "yes";

          $(elements.buttons).html("<button class='btn btn-info edit-text'>Editar</button>");

          $(elements.textArea).each(function() {
            $(this).prop("disabled", true);
          });
        }
      });
    }
  });

  if(elements.success == "yes") {
    $(successMsg).html("Texto enviado com sucesso!");
  }
}

//SEND PHENOMENA TAG
function sendTag(checkbox, regDate) {

  var data = new FormData();
  var id = $(checkbox).attr("data-id");

  data.append("systemId", id);
  data.append("date", regDate);

  $.ajax({
    type: 'POST',
    url: baseUrl+'ajax/sendTags',
    data: data,
    contentType: false,
    processData: false,
    success: function() {

    }
  });
}

$(document).ready(function() {
  //date is passed as a global variable
  //If no date was passed, use the date of the current day
  if(date === false) {
    let separator = "dash";
    date = dateFormated(separator);
  }

  //DELETE IMAGE
  $(".img-del").on("click", function() {
    var imgDel = $(this);

    //Show confirmation alert
    modal(imgDel, 2);

    //Delete Image
    $(document).on("click", ".modal-del-confirm", function() {
        deleteImg(imgDel);
    });
  });

  //DELETE WEATHER SYSTEM
  $(".fenom input[type=checkbox]").change(function() {
    if(this.checked == false) {
      let checkbox = $(this);
      deleteSystem(checkbox, date);
    }
  });
});

//Select image ID and send AJAX request
function deleteImg(del) {
  var data = new FormData();

  var im = $(del).parent().siblings("a").find("img"),
      imgID = $(im).attr("id"),
      successMsg = $(del).parents(".img-wrap").next(".sucesso-msg"),
      inputWrap = $(del).parents(".img-wrap").prev(".reg-form").find(".input-btn-wrap");

  data.append("imgID", imgID);

  $.ajax({
    type: 'POST',
    url: baseUrl+'ajax',
    data: data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function(json) {

      if(json.success = "yes") {

        //Show message and hide it after 3 seconds
        $(successMsg).html("Imagem removida com sucesso!");
        setTimeout(function() {
            $(successMsg).fadeOut();
        }, 3000);

        //remove image thumbnail
        $(im).remove();
        $(inputWrap).show();
        $(".bg-box, .modal-box").fadeOut("fast");

      }
    }
  });
}

//Delete Weather phenomena
function deleteSystem(checkbox, regDate) {
  let id = $(checkbox).attr("data-id");

  let path = "ajax/deleteSystem";
  let data = new FormData();
  let dataObj = {
    systemId: id,
    date: regDate
  };

  data.append("systemData", JSON.stringify(dataObj));

  //Make ajax request to delete system
  let Delete = new AjaxRequest(data);
  Delete.call(path);
}

$(document).ready(function() {
  //date is passed as a global variable
  //If no date was passed, use the date of the current day
  if(date === false) {
    let separator = "dash";
    date = dateFormated(separator);
  }

  //GET DATA FOR THE DAY
  getData(date);

  //GET NEW DATE FROM DATEPICKER CHANGE
  $("input[name=calendar-3]").on("change", function() {
    let newDate = $(this).val();

    let dateSplit = newDate.split("-");

    let newDateFormated = dateFormated("dash", dateSplit),
        newUrl = baseUrl+"registros/ver/"+newDateFormated;

    //RELOAD PAGE WITH NEW DATE IN THE URL
    window.location.assign(newUrl);
  });

});
//GET CURRENT DAY DATA ON PAGE LOAD
function getData(regDate) {
  let data = new FormData();

  data.append("date", regDate);

  $.ajax({
    type: "POST",
    url: baseUrl+'ajax',
    data: data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function(json) {

      let jsonImg = json.currDayReg.img,
          jsonMet = json.currDayReg.met,
          jsonTec = json.currDayReg.tec,
          jsonInfo = json.currDayReg.info,
          jsonPhen = json.currDayReg.phenom;

      //console.log(json);

      receiveDayImages(jsonImg);
      receiveDayText(jsonMet, "meteoro");
      receiveDayText(jsonTec, "tec");
      receiveDayInfo(jsonInfo);
      receiveDayPhenomena(jsonPhen);

    }
  });
}

/*Gets the data from the current day and populates the fields,
if no data has been added to that time and category yet, the
field will remain blank */
function receiveDayImages(json) {
  for (let h in json) {
    var hora = h;
    for (let c in json[h]) {
      var categoria = c;

      if(json[h][c].fileName) {

        var imgURL = baseUrl+"assets/images/" + categoria + "/" + json[h][c].fileName,
            imgID = json[h][c].id,
            imgWrap = ".img-wrap[data-categoria="+categoria+"][data-hora="+hora+"]",
            imgDelBtn = $(imgWrap).find(".img-del"),
            inputForm = $(imgWrap).prev(".form-img"),
            inputWrap = $(inputForm).find(".input-btn-wrap"),
            img_html = '';

        img_html+=
          "<a href='javascript:;' class='img-clickable'>" +
            "<img src='"+imgURL+"' id='img-"+imgID+"' class='img-width img-fluid'/>" +
          "</a>";

        $(imgWrap).append(img_html);
        $(inputForm).css("z-index", "auto");

        $(inputWrap).hide();
      }
    }
  }
}

function receiveDayText (json, cargo) {

  var sendBtn = '',
      editBtn = '';

  for (let h in json) {
    var hora = h;
    for (let c in json[h]) {
      var categoria = c;

      var text =  json[h][c].text,
          id = json[h][c].id;

      if(text) {

        var textArea = "textarea[data-categoria="+categoria+"][data-hora="+hora+"]",
            select = "select[data-cargo="+cargo+"][data-hora="+hora+"] option[value=" + id + "]",
            buttons = $(textArea).parent(".bmd-form-group").siblings(".buttons");

        //Populate textarea
        $(textArea).html(text)
          .prop("disabled", true);

        //Populate select
        $("select[data-cargo="+cargo+"][data-hora="+hora+"] option[value=" + id + "]")
          .prop('selected', true);

        //Update buttons
        $(buttons).html("<button class='btn btn-info edit-text'>Editar</button>");

      }
    }
  }
}

function receiveDayInfo(json) {
  let textArea = $("#info-gerais").find("textArea[data-categoria=info-gerais]"),
      text = json.text,
      buttons = $(textArea).parent(".bmd-form-group").siblings(".buttons");

  if(text) {
    textArea.html(text)
      .prop("disabled", true);

    //Update buttons
    $(buttons).html("<button class='btn btn-info edit-text'>Editar</button>");
  }
}

function receiveDayPhenomena(json) {
  for(let p in json) {
    for(let i in json[p]) {
      let phenomId = json[p][i].id_sistema,
          phenomName = json[p][i].syst;

      let checkbox = $(".fenom").find("input[data-id="+phenomId+"]"),
          checkmark = $(checkbox).siblings(".checkmark");

      $(checkbox).prop("checked", true);

    }

  }
}

$(document).ready(function() {

  var date = '';

  date = getQueryVariable();

  //GET DATA
  if(date) {
    getData(date);
  }

});


//GET CURRENT DAY DATA ON PAGE LOAD
function getData(date) {
  var data = new FormData();

  data.append("date", date);

  $.ajax({
    type: "POST",
    url: baseUrl+'ajax',
    data: data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function(json) {

      let jsonImg = json.currDayReg.img,
          jsonMet = json.currDayReg.met,
          jsonTec = json.currDayReg.tec,
          jsonPhen = json.currDayReg.phenom;

      console.log(json);

      receiveDayImages(jsonImg);
      receiveDayText(jsonMet, "meteoro");
      receiveDayText(jsonTec, "tec");
      receiveDayPhenomena(jsonPhen);

    }
  });
}

/*Gets the data from the current day and populates the fields,
if no data has been added to that time and category yet, the
field will remain blank */
function receiveDayImages(json) {
  var h;

  for (h in json) {
    var hora = h;
    for (c in json[h]) {
      var categoria = c;

      if(json[h][c].fileName) {

        var imgURL = "http://localhost/projetoy/Monitoramento/assets/images/" + categoria + "/" + json[h][c].fileName,
            imgID = json[h][c].id,
            imgWrap = ".img-wrap[data-categoria="+categoria+"][data-hora="+hora+"]",
            imgDelBtn = $(imgWrap).find(".img-del"),
            inputWrap = $(imgWrap).prev(".reg-form").find(".input-btn-wrap");


        $(imgWrap)
          .append(
            $('<img/>')
              .attr("src", imgURL)
              .attr("id", "img-"+imgID)
              /*.attr("class", "img-width")*/
              .addClass("img-registry")
            );

        $([imgDelBtn, inputWrap]).each(function() {
          $(this).toggle();
        });

      }
    }
  }
}

function receiveDayText (json, cargo) {

  var sendBtn = '',
      editBtn = '';

  for (var h in json) {
    var hora = h;
    for (var c in json[h]) {
      var categoria = c;

      var text =  json[h][c].text,
          id = json[h][c].id;

      if(text) {

        var textArea = "textarea[data-categoria="+categoria+"][data-hora="+hora+"]",
            select = "select[data-cargo="+cargo+"][data-hora="+hora+"] option[value=" + id + "]",
            buttons = $(textArea).siblings(".buttons");
//            sendBtn = $(textArea).siblings(".send-text"),
//            editBtn = $(textArea).siblings(".edit-text");

        //POPULATE TEXTAREA
        $(textArea).html(text)
          .prop("disabled", true);

        //POPULATE SELECT
        $("select[data-cargo="+cargo+"][data-hora="+hora+"] option[value=" + id + "]")
          .prop('selected', true);

        //Update buttons
        $(buttons).html("<button class='btn btn-primary edit-text'>Editar</button>");
      }
    }
  }
}

function receiveDayPhenomena(json) {
  var p;
  for(p in json) {
    for(i in json[p]) {
      var phenomId = json[p][i].id_sistema,
          phenomName = json[p][i].syst;

      var checkbox = $(".fenom").find("input[data-id="+phenomId+"]"),
          checkmark = $(checkbox).siblings(".checkmark");

      $(checkbox).prop("checked", true);
    }

  }
}

"use strict";var start,end,systems,draw,resultList;function searchRegistry(t,e){t.preventDefault();var a=new FormData;start=$(e).siblings(".form-group").find("#start").val(),end=$(e).siblings(".form-group").find("#end").val(),systems=[],draw=!0,resultList=$(e).parents(".search-page-container").find(".result-table");var s=$(e).siblings(".systempick").find(".systempick-box").find("input:checked");if($(s).each(function(){var t=$(this).attr("data-id");systems.push({key:t})}),0==systems.length&&(draw=!1),!end){end=dateFormated("dash","","BRZ")}a.append("dateStart",start),a.append("dateEnd",end),a.append("systems",JSON.stringify(systems)),a.append("page",1),$.ajax({type:"POST",url:baseUrl+"pesquisar/data",data:a,dataType:"json",beforeSend:function(){$(".loader-wrap").addClass("show")},contentType:!1,processData:!1,success:function(t){$(".loader-wrap").removeClass("show"),showResults(t),pageNumbers(t)}})}function showResults(t){if($("#myChart").remove(),$(".result-stats-wrap").hide(),$(resultList).empty(),0!=t[0].data.length){draw&&($(".chart").append("<canvas id='myChart' style='background-color: #20BE9E;'></canvas>").addClass("chart-dimensions"),$(".result-stats-wrap").show(),drawLineChart(t[0].chart));var e=renderTable(t);$(resultList).html(e)}else{$(resultList).html("<div class='result-empty'>Nenhum registro encontrado</div>")}}function pageNumbers(t){var e=$(".result-table-pagination ul"),a={totalPages:Math.ceil(t[0].num_pages),visiblePages:5,first:"Primeira",prev:"Anterior",next:"Próxima",last:"Última",onPageClick:function(t,e){getPage(e)}};e.twbsPagination("destroy"),e.twbsPagination($.extend({},a))}function renderTable(t){var r="";return r+="<div class='table-responsive-md'>",r+="<table class='table table-hover'>",r+="<tr>",r+="<th colspan='4'>Registros</th>",r+="</tr>",r+="<tr class='result-table-categories'>",r+="<td class='th-date'>Data</th>",r+="<td class='th-img'>Im. Satélite</th>",r+="<td class='th-info'>Descrição</th>",r+="<td class='th-action'></th>",r+="</tr>",$.each(t[0].data,function(t,e){var a=e.date.split("-"),s=a[2]+"-"+a[1]+"-"+a[0];r+="<tr>",r+="<td class='cell-center result-table-date'>"+s+"</td>",r+="<td>",r+=appendImg(e),r+="</td>",r+="<td>",e.info.met["06Z"].condicao_tempo.text?r+="<p class='mb-3'><strong>Condição:</strong> "+e.info.met["06Z"].condicao_tempo.text+"</p>":r+="<p class='mb-3'>Sem informações para este dia</p>",r+="<p class='ocorrencias'><strong>Ocorrências:</strong></p>",r+="<p>"+appendPhenom(e.info.phenom)+"</p>",r+="</td>",r+="<td class='cell-center'>",r+="<a href='"+baseUrl+"registros/ver/"+e.date+"' target='_blank'>",r+="<button class='mui-btn view-registry'>Visualizar</button>",r+="</a>",r+="</td>",r+="</tr>"}),r+="</table>",r+="</div>"}function appendImg(t){var e="";return t.info.img["06Z"].im_satelite.fileName?e+="<a href='javascript:;' class='img-clickable'><img src='"+baseUrl+"assets/images/im_satelite/"+t.info.img["06Z"].im_satelite.fileName+"' class='result-table-img'/></a>":e+="<img src='"+baseUrl+"assets/images/default-thumbnail.jpg' class='result-table-img'/>"}function appendPhenom(t){var e=[],a=void 0;for(var s in t)for(var r in t[s]){if(!(a=t[s][r]))return"Sem registro";e.push(a.syst)}return e.join(", ")}function drawLineChart(t){var a=[],s=[],r=0;t.forEach(function(t,e){r+=Number(t.count),a.push(t.month),s.push(t.count)});var e={labels:a,datasets:[{label:"Ocorrências",backgroundColor:"rgba(146,224,208, 0.7)",data:s}]},n=document.getElementById("myChart").getContext("2d");new Chart(n,{type:"bar",data:e,options:{legend:{display:!1},title:{display:!0,text:"NÚMERO DE DIAS (por mês)",fontColor:"#EEE"},layout:{padding:{top:10,bottom:10}},responsive:!0,maintainAspectRatio:!0,scales:{yAxes:[{ticks:{beginAtZero:!0,stepSize:1,fontColor:"#EEE"},gridLines:{color:"#BBB",zeroLineColor:"#BBB"}}],xAxes:[{offset:!0,gridLines:{offsetGridLines:!1,color:"#BBB"},type:"time",time:{unit:"month",round:"month",displayFormats:{month:"MMM YYYY"}},ticks:{fontColor:"#EEE",autoSkip:!1}}]}}});showSum(r)}function showSum(t){if(0<t){var e="";e+="<div>",e+="</div>",e+="<div>",e+="<div><small><strong>TOTAL</strong></small></div>",e+="<strong>"+t+"</strong>",e+=1<t?"<small>DIAS</small>":"<small>DIA</small>",e+="</div>",$(".result-sum div").html(e)}}function getPage(t){var e=new FormData;e.append("dateStart",start),e.append("dateEnd",end),e.append("systems",JSON.stringify(systems)),e.append("page",t),$.ajax({type:"POST",url:baseUrl+"pesquisar/data",data:e,dataType:"json",beforeSend:function(){$(".loader-wrap").addClass("show")},contentType:!1,processData:!1,success:function(t){$(".loader-wrap").removeClass("show");var e=renderTable(t);$(resultList).html(e)}})}$(document).ready(function(){$(".search-btn").on("click",function(t){searchRegistry(t,$(this))}),$(".show-sidebar").on("click",function(){$(".search-sidebar").addClass("active")}),$(".close-sidebar").on("click",function(){$(".search-sidebar").removeClass("active")})});

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

$(document).ready(function() {
  //date is passed as a global variable
  //If no date was passed, use the date of the current day
  if(date === false) {
    let separator = "dash";
    date = dateFormated(separator);
  }

  //ENABLE TEXT EDITING
  $(document).on("click", ".edit-text", function(e) {
   let edit = $(this);
   editText(e, edit);
  });

  //UPDATE TEXT
  $(document).on("click", ".update-text", function(e) {
    let btn = $(this);
    updateText(e, btn, date);
  });

  //CANCEL UPDATE
  $(document).on("click", ".update-cancel", function(e) {
    let btn = $(this);
    cancelUpdate(e, btn);
  });

});

//ENABLE TEXT EDITING
function editText(e, edit) {
  e.preventDefault();

  var buttons = $(edit).parent();
  $(buttons).html("<button type='submit' class='btn btn-raised btn-primary update-text'>Atualizar</button><button class='btn update-cancel'>Cancelar</button>");

  $(buttons).siblings(".bmd-form-group").find("textarea").prop("disabled", false);
}

//Update text entry
function updateText(e, btn, regDate) {
  e.preventDefault();

  var data = new FormData();

  var elements = new KeyElements(btn);

  $(elements.textArea).each(function() {

    var categoria = $(this).attr("data-categoria"),
        texto = $(this).val(),
        successMsg = $(this).prevAll(".reg-form").nextAll(".sucesso-msg").first();

    if($.trim(texto).length > 0) {

      data.append("update-date", regDate);
      data.append("update-horario", elements.horario);
      data.append("update-categoria", categoria);
      data.append("update-texto", texto);
      data.append("update-id_nome", elements.nome);
      data.append("update-cargo", elements.cargo);

      $.ajax({
        type: 'POST',
        url: baseUrl+'ajax',
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(json) {

          var buttons = $(btn).parent();

          $(buttons).html("<button class='btn btn-primary edit-text'>Editar</button>");

          $(elements.textArea).each(function() {
            $(this).prop("disabled", true);
          });
        }
      });

    }
  });
}

function cancelUpdate(e, btn) {
  e.preventDefault();

  var buttons = $(btn).parent();

  $(buttons).html("<button class='btn btn-primary edit-text'>Editar</button>");

  $(buttons).siblings(".bmd-form-group").find("textarea").prop("disabled", true);
}

$(document).ready(function() {

  var date = '';

  date = getQueryVariable();

  //GET DATA
  if(date) {
    getData(date);
  }

});

//Get query variable from url
function getQueryVariable() {
  var d = window.location.search.substring(1);
  var pair = d.split("=");
  if (pair[0] == "date") {
   return pair[1];
  }
  return false;
}

//GET CURRENT DAY DATA ON PAGE LOAD
function getData(date) {
  var data = new FormData();

  data.append("date", date);

  $.ajax({
    type: "POST",
    url: "http://localhost/projetoy/Monitoramento/ajax",
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
              .attr("class", "img-width"));

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
            sendBtn = $(textArea).siblings(".send-text"),
            editBtn = $(textArea).siblings(".edit-text");

        //POPULATE TEXTAREA
        $(textArea).html(text)
          .prop("disabled", true);

        //POPULATE SELECT
        $("select[data-cargo="+cargo+"][data-hora="+hora+"] option[value=" + id + "]")
          .prop('selected', true);
      } else {
        //EXIT FUNCTION IF TEXT IS EMPTY
        //return false;
      }
    }

    $([sendBtn, editBtn]).each(function() {
      $(this).toggle();
    });

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

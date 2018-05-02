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

        var imgURL = "http://localhost/projetoy/Monitoramento/assets/images/" + categoria + "/" + json[h][c].fileName,
            imgID = json[h][c].id,
            imgWrap = ".img-wrap[data-categoria="+categoria+"][data-hora="+hora+"]",
            imgDelBtn = $(imgWrap).find(".img-del"),
            inputForm = $(imgWrap).prev(".form-img"),
            inputWrap = $(inputForm).find(".input-btn-wrap"),
            img_html = '';

        img_html+=
          "<a href='javascript:;' class='img-clickable'>" +
            "<img src='"+imgURL+"' id='img-"+imgID+"' class='img-width'/>" +
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

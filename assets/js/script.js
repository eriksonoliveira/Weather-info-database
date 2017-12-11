$(document).ready(function() {
  
//GET CURRENT DAY DATA ON PAGE LOAD
  var data = new FormData();

  var d = new Date();
  var date = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();

  data.append("date", date);

  $.ajax({
    type: "POST",
    url: "http://localhost/projetoy/Monitoramento/ajax",
    data: data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function(json) {

      var jsonImg = json.currDayReg.img;
      var jsonMet = json.currDayReg.met;
      var jsonTec = json.currDayReg.tec;

      console.log(json);

      receiveDayImages(jsonImg);
      receiveDayText(jsonMet, "meteoro");
      receiveDayText(jsonTec, "tec");

    }
  })


  
  //ENVIAR IMAGENS VIA AJAX
  $(".form-img").on("submit", function(e) {
    e.preventDefault();

    var data = new FormData();

    var horario = $(this).find("input[type=file]").attr("data-hora"),
        categoria = $(this).find("input[type=file]").attr("data-categoria"),
        imagem = $(this).find("input[type=file]")[0].files,
        successMsg = $(this).nextAll(".sucesso-msg").first();

    var sendBtn = $(this).find("button[type=submit]"),
        cancelBtn = $(this).find(".img-cancel"),
        inputBtn = $(this).find("label"),
        numImg = $(this).find(".num-fotos"),
        imgWrap = $(this).next(".img-wrap"),
        imgTag = $(imgWrap).find("img");
        imgDelBtn = $(imgWrap).find(".img-del");

    if(imagem.length > 0) {

      data.append("horario", horario);
      data.append("categoria", categoria);
      data.append("imagem", imagem[0]);

      $.ajax({
        type: 'POST',
        url: 'http://localhost/projetoy/Monitoramento/ajax',
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(json) {

          if(json.success = "yes") {
            $(successMsg).html("Imagem enviada com sucesso!");

            $(imgTag).attr("id", "img-"+json.imgId);

            $([sendBtn, cancelBtn, numImg, imgDelBtn]).each(function() {
              $(this).toggle();
            });
          }
        }
      });
    }
  });


  //ENVIAR TEXTO AJAX
  $(".form-txt").on("submit", function(e) {
    e.preventDefault();

    var data = new FormData();

    var horario = $(this).attr("data-hora"),
        nome = $(this).find("select").val(),
        cargo = $(this).find("select").attr("data-cargo");

    $(this).find("textarea").each(function() {

      var categoria = $(this).attr("data-categoria"),
          texto = $(this).val(),
          successMsg = $(this).nextAll(".sucesso-msg").first();

      if($.trim(texto).length > 0) {

        data.append("horario", horario);
        data.append("categoria", categoria);
        data.append("texto", texto);
        data.append("id_nome", nome);
        data.append("cargo", cargo);

        $.ajax({
          type: 'POST',
          url: 'http://localhost/projetoy/Monitoramento/ajax',
          data: data,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(json) {

            if(json.success = "yes") {
              $(successMsg).html("Imagem enviada com sucesso!");
            }
          }
        });
      }
    });
  });

  previewPhotos();

  deleteImg();
  
});


/*Gets the data from the current day and populates the fields,
if no data has been added to that time and category yet, the
field will remais blank */
function receiveDayImages (json) {
  var h;

  for (h in json) {
    var hora = h;
    for (c in json[h]) {
      var categoria = c;

      var imgURL = "http://localhost/projetoy/Monitoramento/assets/images/" + categoria + "/" + json[h][c].fileName,
          imgID = json[h][c].id,
          imgWrap = ".img-wrap[data-categoria="+categoria+"][data-hora="+hora+"]";


      $(imgWrap)
        .append(
          $('<img/>')
          .attr("src", imgURL)
          .attr("id", "img-"+imgID)
          .attr("class", "img-width"))
        .find('.img-del')
          .toggle();
    }
  }
}

function receiveDayText (json, cargo) {
  var h;

  for (h in json) {
    var hora = h;
    for (c in json[h]) {
      var categoria = c;

      var text =  json[h][c].text,
          id = json[h][c].id_met;

      //POPULATE TEXTAREA
      $("textarea[data-categoria="+categoria+"][data-hora="+hora+"]").html(text);
      //console.log(text);

      //POPULATE SELECT
      $("select[data-cargo="+cargo+"][data-hora="+hora+"] option[value=" + id + "]")
        .prop('selected', true);

    }
  }
}

//CRIA PREVIEW DA IMAGEM SELECIONADA PARA UPLOAD
function previewPhotos () {
  $("input[type=file]").change(function(e) {
    var files = e.target.files.length,
        selectConfirm = $(this).next(".num-fotos");

    if (files > 1){
      $(selectConfirm).html(files+" arquivos selecionados")
    } else {
      $(selectConfirm).html(files+" arquivo selecionado")
    }

    var imPreview = $(this).parents(".reg-form").next(".img-wrap"),
        inputWrap = $(this).parent();

    $(imPreview)
      .append(
        $("<img/>")
        .attr("src", URL.createObjectURL(e.target.files[0]))
        .attr("class", "img-width")
        .attr("class", "img-thumbnail")
      )
      /*.find(".img-del")
        .toggle()*/;

    var cancelBtn = $(imPreview).prev("form").find(".img-cancel"),
        sendBtn = $(imPreview).prev("form").find("button[type=submit]");

    $([cancelBtn, sendBtn, inputWrap]).each(function() {
      $(this).toggle();
    });

    //Remove image preview when click "Cancel"
    $(cancelBtn).on("click", function() {
      $(imPreview).find("img").remove();
      /*$(imPreview).find(".img-del").toggle();*/
      $(selectConfirm).empty();

      $([cancelBtn, sendBtn, inputWrap]).each(function() {
        $(this).toggle();
      });

    });
  })
}

//DELETAR IMAGEM
function deleteImg () {

  $(".img-del").on("click", function() {

    var data = new FormData();

    var im = $(this).next("img"),
        imgID = $(this).next("img").attr("id"),
        successMsg = $(this).parent().next(".sucesso-msg"),
        inputWrap = $(this).parent().prev(".reg-form").find(".input-btn-wrap"),
        delBtn = $(this);

    data.append("imgID", imgID);

    $.ajax({
      type: 'POST',
      url: 'http://localhost/projetoy/Monitoramento/ajax',
      data: data,
      dataType: 'json',
      contentType: false,
      processData: false,
      success: function(json) {

        if(json.success = "yes") {

          $(successMsg).html("Imagem removida com sucesso!");
          $(im).remove();
          $(delBtn).toggle();

        }
      }
    });
  });
}

















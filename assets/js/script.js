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
    var form = $(this);
    sendImage(e, form);
  });


  //ENVIAR TEXTO AJAX
  $(".form-txt").on("submit", function(e) {
    var form = $(this);
    sendText(e, form);
  });

  $("input[type=file]").change(function(e) {
    var inputFile = $(this);
    previewPhotos(e, inputFile);
  });

  $(".img-del").on("click", function() {
    var del = $(this);
    deleteImg(del);
  });

  $(".edit-text").on("click", function(e) {
   var edit = $(this);
   editText(e, edit);
  });

});


//Add new Image to the record
function sendImage(e, form) {
  e.preventDefault();

  var data = new FormData();

  var horario = $(form).find("input[type=file]").attr("data-hora"),
      categoria = $(form).find("input[type=file]").attr("data-categoria"),
      imagem = $(form).find("input[type=file]")[0].files,
      successMsg = $(form).nextAll(".sucesso-msg").first();

  var sendBtn = $(form).find(".send-img"),
      cancelBtn = $(form).find(".img-cancel"),
      inputBtn = $(form).find("label"),
      numImg = $(form).find(".num-fotos"),
      imgWrap = $(form).next(".img-wrap"),
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
}

//Add new weather description to the record
function sendText(e, form) {
  e.preventDefault();


  var data = new FormData();

  var horario = $(form).attr("data-hora"),
      nome = $(form).find("select").val(),
      cargo = $(form).find("select").attr("data-cargo"),
      sendBtn = $(form).find(".send-text"),
      editBtn = $(form).find(".edit-text"),
      updateBtn = $(form).find(".update-text"),
      cancelBtn = $(form).find(".update-cancel"),
      textArea = $(form).find("textarea");
      success = '';

  $(form).find("textarea").each(function() {

    var categoria = $(this).attr("data-categoria"),
        texto = $(this).val(),
        successMsg = $(this).prevAll(".reg-form").nextAll(".sucesso-msg").first();

    if($.trim(texto).length > 0) {

      var isVisible = updateBtn.is(":visible");

      //UPDATE ENTRY
      if(isVisible == true) {

        data.append("update-horario", horario);
        data.append("update-categoria", categoria);
        data.append("update-texto", texto);
        data.append("update-id_nome", nome);
        data.append("update-cargo", cargo);

        $.ajax({
          type: 'POST',
          url: 'http://localhost/projetoy/Monitoramento/ajax',
          data: data,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(json) {

            $(updateBtn).hide();
            $(cancelBtn).hide();

            $(editBtn).fadeIn();

            $(textArea).each(function() {
              $(this).prop("disabled", true);
            });
          }
        });


      //ADD NEW ENTRY
      } else {

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

            success = "yes";

            isVisible = sendBtn.is(":visible");

            if(isVisible == true) {
              $([sendBtn, editBtn]).each(function() {
                $(this).toggle();
              });
            }

            $(textArea).each(function() {
              $(this).prop("disabled", true);
            });
          }
        });
      }

    }
  });

  if(success) {
    $(successMsg).html("Texto enviado com sucesso!");

  }
}

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

function receiveDayText (json, cargo) {
  var h;

  var sendBtn = '',
      editBtn = '';

  for (h in json) {
    var hora = h;
    for (c in json[h]) {
      var categoria = c;

      var text =  json[h][c].text,
          id = json[h][c].id_met;

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


    }

    $([sendBtn, editBtn]).each(function() {
      $(this).toggle();
    });

  }
}

//CRIA PREVIEW DA IMAGEM SELECIONADA PARA UPLOAD
function previewPhotos (e, input) {

  var files = e.target.files.length,
      selectConfirm = $(input).next(".num-fotos");

  if (files > 1){
    $(selectConfirm).html(files+" arquivos selecionados")
  } else {
    $(selectConfirm).html(files+" arquivo selecionado")
  }

  var imPreview = $(input).parents(".reg-form").next(".img-wrap"),
      inputWrap = $(input).parent();

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
      sendBtn = $(imPreview).prev("form").find(".send-img");

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
}

//DELETAR IMAGEM
function deleteImg (del) {
  var data = new FormData();

  var im = $(del).next("img"),
      imgID = $(del).next("img").attr("id"),
      successMsg = $(del).parent().next(".sucesso-msg"),
      inputWrap = $(del).parent().prev(".reg-form").find(".input-btn-wrap"),
      delBtn = $(del);

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
}

//EDIT TEXT
function editText(e, edit) {
  e.preventDefault();

  $(edit).toggle();
  $(edit).siblings(".update-cancel, .update-text").each(function() {
    $(this).fadeToggle();
  });
  $(edit).siblings("textarea").prop("disabled", false);
}

















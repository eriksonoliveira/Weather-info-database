$(document).ready(function() {

  //GET AND FORMAT DATE
  var separator = "dash";
   var date;

  //Check if GET date variable was passed
  date = getQueryVariable();

  if(date === false) {
    //If not, use the date of the current day
    date = dateFormated(separator);
  }

    //PREVIEW IMAGE BEFORE UPLOAD
  $("input[type=file]").change(function(e) {
    var inputFile = $(this);
    previewImages(e, inputFile);
  });

  //UPLOAD IMAGES
  $(".send-img").on("click", function(e) {
    let btn = $(this);
    sendImage(e, btn, date);
  });

  //SEND TEXT
  $(document).on("click", ".send-text", function(e) {
    let btn = $(this);
    sendText(e, btn, date);
  });

  //SEND TAG
  $(".send-fenomenos").on("click", function(e) {
   let btn = $(this);
   sendTag(e, btn, date);
  });

});

//CRIA PREVIEW DA IMAGEM SELECIONADA PARA UPLOAD
function previewImages (e, input) {

  var imPreview = $(input).parents(".reg-form").next(".img-wrap"),
      inputWrap = $(input).parent(),
      img_html = '';

  var cancelBtn = $(imPreview).prev("form").find(".img-cancel"),
      sendBtn = $(imPreview).prev("form").find(".send-img");

  //Create image thumbnail
  img_html+=
    "<a href='javascript:;'>" +
        "<img src='"+URL.createObjectURL(e.target.files[0])+"' class='img-width'/>" +
    "</a>";

  $(imPreview).append(img_html);

  //Toggle form buttons
  $([cancelBtn, sendBtn, inputWrap]).each(function() {
    $(this).toggle();
  });

  //Remove image preview when click "Cancel"
  $(cancelBtn).on("click", function() {
    $(imPreview).find("img").remove();

    $([cancelBtn, sendBtn, inputWrap]).each(function() {
      $(this).toggle();
    });

  });
}

//Add new Image to the record
function sendImage(e, btn, date) {
  e.preventDefault();

  var data = new FormData();

  var sendBtn = $(btn),
      cancelBtn = $(btn).siblings(".img-cancel"),
      imgWrap = $(btn).parents(".form-img").siblings(".img-wrap"),
      inputBtn = $(imgWrap).find("label"),
      imgTag = $(imgWrap).find("img"),
      imgLink = $(imgWrap).find("a");
      form = $(btn).parents(".form-img");

  var horario = $(form).find("input[type=file]").attr("data-hora"),
      categoria = $(form).find("input[type=file]").attr("data-categoria"),
      imagem = $(form).find("input[type=file]")[0].files,
      successMsg = $(form).nextAll(".sucesso-msg").first();


  if(imagem.length > 0) {

    data.append("date", date);
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

          $(imgTag).attr("id", "img-"+json.imgId).attr("class", "img-width");
          $(imgLink).attr("class", "img-clickable");

          $([sendBtn, cancelBtn]).each(function() {
            $(this).toggle();
          });
        }
      }
    });
  }
}

function sendText(e, btn, date) {
  e.preventDefault();

  var data = new FormData();
  var elements = new KeyElements(btn);

  $(elements.textArea).each(function() {

    var categoria = $(this).attr("data-categoria"),
        texto = $(this).val(),
        successMsg = $(this).parents(".reg-form").siblings(".sucesso-msg");

    if($.trim(texto).length > 0) {

      data.append("date", date);
      data.append("horario", elements.horario);
      data.append("categoria", categoria);
      data.append("texto", texto);
      data.append("id_nome", elements.nome);
      data.append("cargo", elements.cargo);

      $.ajax({
        type: 'POST',
        url: 'http://localhost/projetoy/Monitoramento/ajax',
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(json) {

          elements.success = "yes";

          $(elements.buttons).html("<button class='btn btn-primary edit-text'>Editar</button>");
          /*$(elements.sendBtn).hide();
          $(elements.editBtn).show();*/

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
function sendTag(e, btn, date) {
  e.preventDefault();

  var data = new FormData();

  var c = $(btn).parent().siblings(".system-tags-container").find(".fenom-box").find("input:checked");

  $(c).each(function() {
    var id = $(this).attr("data-id");

    data.append("systemId", id);
    data.append("date", date);

    $.ajax({
      type: 'POST',
      url: 'http://localhost/projetoy/Monitoramento/ajax/sendTags',
      data: data,
      contentType: false,
      processData: false,
      success: function() {

      }
    });
  });
}

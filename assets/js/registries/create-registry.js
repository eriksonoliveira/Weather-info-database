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

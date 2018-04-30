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
function updateText(e, btn, date) {
  e.preventDefault();

  var data = new FormData();

  var elements = new KeyElements(btn);

  $(elements.textArea).each(function() {

    var categoria = $(this).attr("data-categoria"),
        texto = $(this).val(),
        successMsg = $(this).prevAll(".reg-form").nextAll(".sucesso-msg").first();

    if($.trim(texto).length > 0) {

      data.append("update-date", date);
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

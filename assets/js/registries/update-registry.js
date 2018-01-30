$(document).ready(function() {

  //GET AND FORMAT DATE
  var separator = "dash";
  var date = dateFormated(separator);

  //ENABLE TEXT EDITING
  $(".edit-text").on("click", function(e) {
   var edit = $(this);
   editText(e, edit);
  });

  //UPDATE TEXT
  $(".update-text").on("click", function(e) {
    let btn = $(this);
    updateText(e, btn, date);
  });

});

//ENABLE TEXT EDITING
function editText(e, edit) {
  e.preventDefault();

  $(edit).toggle();
  $(edit).siblings(".update-cancel, .update-text").each(function() {
    $(this).fadeToggle();
  });
  $(edit).siblings("textarea").prop("disabled", false);
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
        url: 'http://localhost/projetoy/Monitoramento/ajax',
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(json) {

          $(elements.updateBtn).hide();
          $(elements.cancelBtn).hide();

          $(elements.editBtn).fadeIn();

          $(elements.textArea).each(function() {
            $(this).prop("disabled", true);
          });
        }
      });

    }
  });
}

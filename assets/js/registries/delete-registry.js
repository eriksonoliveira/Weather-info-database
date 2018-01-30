$(document).ready(function() {

  //DELETE IMAGE
  $(".img-del").on("click", function() {
    var del = $(this);
    deleteImg(del);
  });

});

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

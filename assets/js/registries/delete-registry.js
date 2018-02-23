$(document).ready(function() {

  //DELETE IMAGE

  //Delete confirmation alert
  $(".img-del").on("click", function() {
    var del = $(this);

    //Show confirmation alert
    modal(del, 2);

    //Delete Image
    $(document).on("click", ".modal-del-confirm", function() {
        deleteImg(del);
    });
  });
});

//Select image ID and send AJAX request
function deleteImg (del) {
  var data = new FormData();

  var im = $(del).parent().siblings("a").find("img"),
      imgID = $(im).attr("id"),
      successMsg = $(del).parents(".img-wrap").next(".sucesso-msg"),
      inputWrap = $(del).parents(".img-wrap").prev(".reg-form").find(".input-btn-wrap");

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
        $(inputWrap).toggle();
        $(".bg-box, .modal-box").fadeOut("fast");

      }
    }
  });
}

$(document).ready(function() {
  
  var previewPhotos = function () {
    $("#send-fotos").change(function(e) {
      //Identifica o número de imagens carregadas
    var files = e.target.files.length;
      if (files > 1){
        $("#num-fotos").html(files+" arquivos selecionados")
      } else {
        $("#num-fotos").html(files+" arquivo selecionado")
      }

      for(var i=0;i < files; i++) {
        $(".panel-body").append(
          $("<div/>")
            .attr("class", "foto_item")
            .append(
              $('<img/>')
              .attr("src", URL.createObjectURL(e.target.files[i]))
              .attr("id", "img-"+i)
              .attr("class", "img-thumbnail")
            )
        );
      }

    })
  }
  
  
  previewPhotos();
  
})

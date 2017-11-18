$(document).ready(function() {
  
/*      for(var i=0;i < files; i++) {*/
  var previewPhotos = function () {
    $("input[type=file]").change(function(e) {
      //Identifica o número de imagens carregadas
    var files = e.target.files.length;
      if (files > 1){
        $(this).next(".num-fotos").html(files+" arquivos selecionados")
      } else {
        $(this).next(".num-fotos").html(files+" arquivo selecionado")
      }

      var imPreview = $(this).parent().parent().next(".img-preview").first();

      $(imPreview)
        .attr('src', URL.createObjectURL(e.target.files[0]))
        .attr('width', '200px')
        .attr('class', 'img-thumbnail');

        /*$(".panel-body").append(
          $("<div/>")
            .attr("class", "foto_item")
            .append(
              $('<img/>')
              .attr("src", URL.createObjectURL(e.target.files[i]))
              .attr("id", "img-"+i)
              .attr("class", "img-thumbnail")
            )
        );*/

    })
  }
      //}

  previewPhotos();
  
  //ENVIAR IMAGENS
  $(".reg-form").on('submit', function(e) {
    e.preventDefault();

    var data = new FormData();

    var /*horario = $(this).find(".hora").find('option:selected'),
        categoria = $(this).find(".categoria").find('option:selected'),*/
        horario = $(this).find("input[type=file]").attr("data-hora"),
        categoria = $(this).find("input[type=file]").attr("data-categoria"),
        imagem = $(this).find("input[type=file]")[0].files,
        successMsg = $(this).nextAll(".sucesso-msg").first();

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
            console.log(json.success);
            $(successMsg).html("Imagem enviada com sucesso!");
          }
        }
      });
    }
  });

  
})


















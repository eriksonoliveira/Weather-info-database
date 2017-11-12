$(document).ready(function() {
  
/*      for(var i=0;i < files; i++) {
  var previewPhotos = function () {
    $("input[type=file]").change(function(e) {
      //Identifica o número de imagens carregadas
    var files = e.target.files.length;
      if (files > 1){
        $(this + "#num-fotos").html(files+" arquivos selecionados")
      } else {
        $(this + "#num-fotos").html(files+" arquivo selecionado")
      }

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

    })
  }
      }*/
  
  //ENVIAR IMAGENS
  $(".reg-form").on('submit', function(e) {
    e.preventDefault();

    var data = new FormData();

    var horario = $(this).find(".hora").find('option:selected'),
        categoria = $(this).find(".categoria").find('option:selected'),
        imagem = $(this).find("input[type=file]")[0].files,
        imPreview = $(this).next(".img-preview");

    if(imagem.length > 0) {

      data.append("horario", horario.val());
      data.append("categoria", categoria.val());
      data.append("imagem", imagem[0]);

      $.ajax({
        type: 'POST',
        url: 'http://localhost/projetoy/Monitoramento/ajax',
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(json) {
          $(imPreview)
            .attr('src', json.url_img)
            .attr('width', '200px')
            .attr('class', 'img-thumbnail');
          console.log(json);
        }
      });
    }
  });

//  previewPhotos();
  
})


















$(document).ready(function() {
  
  //GET CURRENT DAY DATA ON PAGE LOAD
  var getData = function () {
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
        console.log(json.currDayReg);

        var i;
        for (i in json.currDayReg.img) {
          var hora = i;
          for (j in json.currDayReg.img[i]) {
            var categoria = j;

            var imgURL = json.currDayReg.img[i][j].fileName,
                imgID = json.currDayReg.img[i][j].id;

            $(".img-wrap[data-categoria="+categoria+"][data-hora="+hora+"]").html("TESTE");

          }
        }

      }
    })
  }

  getData();

  //CRIA PREVIEW DA IMAGEM SELECIONADA PARA UPLOAD
  var previewPhotos = function () {
    $("input[type=file]").change(function(e) {
    var files = e.target.files.length;
      if (files > 1){
        $(this).next(".num-fotos").html(files+" arquivos selecionados")
      } else {
        $(this).next(".num-fotos").html(files+" arquivo selecionado")
      }

      var imPreview = $(this).parent().parent().next(".img-wrap").children(".img-preview");

      //console.log(imPreview);

      $(imPreview)
        .attr('src', URL.createObjectURL(e.target.files[0]))
        .attr('class', 'img-width')
        .attr('class', 'img-thumbnail');
    })
  }

  previewPhotos();
  
  //ENVIAR IMAGENS VIA AJAX
  $(".form-img").on('submit', function(e) {
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

  //DELETAR IMAGEM
  $(".img-del").on("click", function() {

  });

  //ENVIAR TEXTO AJAX
  $(".form-txt").on('submit', function(e) {
    e.preventDefault();

    var data = new FormData();

    var horario = $(this).attr("data-hora"),
        nome = $(this).find("select").val(),
        cargo = $(this).find("select").attr("data-cargo");

    console.log(cargo);

    $(this).find("textarea").each(function() {

      var categoria = $(this).attr("data-categoria"),
          texto = $(this).val(),
          successMsg = $(this).nextAll(".sucesso-msg").first();

      if($.trim(texto).length > 0) {

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

            if(json.success = "yes") {
              console.log(json.success);
              $(successMsg).html("Imagem enviada com sucesso!");
            }
          }
        });
      }
    });
  });

  
})


















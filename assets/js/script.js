$(document).ready(function() {
  
  //CREATE DATEPICKER FOR START DATE
  $("input[name=calendar-1]").datepicker({
    prevText: "Anterior",
    nextText: "Próximo",
    changeMonth: true,
    changeYear: true,
    maxDate: new Date()
  });


  //CREATE DATEPICKER FOR END DATE
  $("input[name=calendar-2]").datepicker({
    prevText: "Anterior",
    nextText: "Próximo",
    changeMonth: true,
    changeYear: true,
    maxDate: new Date()
  });

  //SET MIN DATE FOR CALENDAR-A2
  $("input[name=calendar-1]").on("change", function() {
    var minDate = $(this).val();
    $("input[name=calendar-2]").datepicker("option", "minDate", minDate);
  });

  //TOGGLE MODAL WHEN USER CLICKS IMAGES
  $(document).on("click", ".img-clickable", function() {
    modal(this, 1);
  });

});

//Handle Ajax Requests
class AjaxRequest {
  constructor(data) {
    this.data = data;
  }

  call(path, callback = 0) {
    $.ajax({
      type: 'POST',
      url: 'http://localhost/projetoy/Monitoramento/'+path+'',
      data: this.data,
      dataType: 'json',
      contentType: false,
      processData: false,
      success: function(json) {
        if(callback) {
          callback(json);
        }
      }
    });
  }
}

class KeyElements {
  constructor(btn) {
    this.btn = btn;

    this.form = $(btn).parents(".buttons").parents(".form-txt");
    this.horario = $(this.form).attr("data-hora");
    this.nome = $(this.form).find("select").val();
    this.cargo = $(this.form).find("select").attr("data-cargo");
    this.buttons = $(this.form).find(".buttons");
    this.sendBtn = $(this.form).find(".send-text");
    this.editBtn = $(this.form).find(".edit-text");
    this.updateBtn = $(this.form).find(".update-text");
    this.cancelBtn = $(this.form).find(".update-cancel");
    this.textArea = $(this.form).find("textarea");
    this.success = '';
  }
}

//Get query variable from url
function getQueryVariable() {
  var d = window.location.search.substring(1);
  var pair = d.split("=");
  if (pair[0] == "date") {
   return pair[1];
  }
  return false;
}

//Format date
function dateFormated(separator) {
  var d = new Date();

  var dd = d.getDate(),
      mm = d.getMonth()+1,
      yyyy = d.getFullYear();

  if(dd < 10) {
    dd = '0'+dd;
  }
  if(mm < 10) {
    mm = '0'+mm;
  }

  if(separator == "slash") {
    var date = mm+"/"+dd+"/"+yyyy;
  } else {
    var date = yyyy+"-"+mm+"-"+dd;
  }

  return date;
}

//Create modal boxes for images and delete confirmation
function modal(el, type) {
  var path,
      modal_html = '';

  //Type == 1 display images, type == 2 display delete confirmation
  if(type == 1) {
    //Get img src attribute
    path = $(el).find("img").attr("src");

    //Create modal image sctructure
    modal_html+="<img src='"+path+"' width='100%'/>";

    //Insert the content
  } else if(type == 2) {
    modal_html+=
      "<p>Excluir a imagem?</p>" +
      "<button class='modal-del-confirm mui-btn mui-btn--primary'>Excluir</button>" +
      "<button class='modal-del-cancel mui-btn mui-btn--danger'>Cancelar</button>";
  }

  //Insert the content and show modal
  $(".modal-box").html(modal_html);
  $(".bg-box, .modal-box").fadeIn("fast");

  //Hide modal
  $(".bg-box, .modal-del-cancel").on("click", function() {
    $(".bg-box, .modal-box").fadeOut("fast");
  });
}

function scrollBtn() {
  let documentTop = $(document).scrollTop();

  if(documentTop > 50) {
    $(".scroll-top").css("display", "block");
  } else {
    $(".scroll-top").css("display", "none");
  }
}

//Scroll to top animation
function scrollToTop() {
  $("html, body").animate({
    scrollTop: 0
  }, 500);
}


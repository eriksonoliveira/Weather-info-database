$(document).ready(function() {
  
  //CREATE DATEPICKER FOR START DATE
  $("input[name=calendar-1]").datepicker({
    prevText: "Anterior",
    nextText: "Próximo",
    maxDate: new Date()
  });


  //CREATE DATEPICKER FOR END DATE
  $("input[name=calendar-2]").datepicker({
    prevText: "Anterior",
    nextText: "Próximo",
    maxDate: new Date()
  });

  //SET MIN DATE FOR CALENDAR-A2
  $("input[name=calendar-1]").on("change", function() {
    var minDate = $(this).val();
    $("input[name=calendar-2]").datepicker("option", "minDate", minDate);
  });

  //TOGGLE MODAL WHEN USER CLICKS IMAGES
  modal();

});

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

function modal() {
  $(document).on("click", "a.img-clickable", function() {
    var path = $(this).find("img").attr("src");

    $(".img-modal-box img").attr("src", path);

    //Show modal
    $(".bg-box, .img-modal-box").fadeIn("fast");
    //Hide modal
    $(".bg-box").on("click", function() {
      $(".bg-box, .img-modal-box").fadeOut("fast");
    });
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

function scrollToTop() {
  $("html, body").animate({
    scrollTop: 0
  }, 500);
}


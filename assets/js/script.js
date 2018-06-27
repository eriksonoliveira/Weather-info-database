"use strict";

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

$(document).ready(function () {

  //CREATE DATEPICKER FOR START DATE
  $("input[name=calendar-1]").datepicker({
    prevText: "Anterior",
    nextText: "Próximo",
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd-mm-yy",
    maxDate: new Date()
  });

  //CREATE DATEPICKER FOR END DATE
  $("input[name=calendar-2]").datepicker({
    prevText: "Anterior",
    nextText: "Próximo",
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd-mm-yy",
    maxDate: new Date()
  });

  //CREATE DATEPICKER ADD REGISTRY PAGE
  $("input[name=calendar-3]").datepicker({
    showOn: "button",
    buttonImage: baseUrl + "assets/images/calendar.png",
    buttonImageOnly: true,
    prevText: "Anterior",
    nextText: "Próximo",
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd-mm-yy",
    maxDate: new Date()
  });

  $(".ui-datepicker-trigger").attr("title", "Escolher dia");

  //SET MIN DATE FOR CALENDAR-A2
  $("input[name=calendar-1]").on("change", function () {
    var minDate = $(this).val();
    $("input[name=calendar-2]").datepicker("option", "minDate", minDate);
  });

  //TOGGLE MODAL WHEN USER CLICKS IMAGES
  $(document).on("click", ".img-clickable", function () {
    modal(this, 1);
  });

  //MATERIAL FLOATING EFFECT ON INPUT LABELS
  $("input.form-control, textarea.form-control").focus(function () {
    $(this).parent(".bmd-form-group").addClass("is-focused");
  });

  $("input.form-control, textarea.form-control").blur(function () {
    $(this).parent(".bmd-form-group").removeClass("is-focused");
  });

  $("input.form-control, textarea.form-control").on("change", function () {
    if ($(this).val().length > 0) {
      $(this).parent(".bmd-form-group").addClass("is-filled");
    } else {
      $(this).parent(".bmd-form-group").removeClass("is-filled");
    }
  });
});

//Handle Ajax Requests

var AjaxRequest = function () {
  function AjaxRequest(data) {
    _classCallCheck(this, AjaxRequest);

    this.data = data;
  }

  _createClass(AjaxRequest, [{
    key: "call",
    value: function call(path) {
      var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;

      $.ajax({
        type: 'POST',
        url: baseUrl + '' + path,
        data: this.data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function success(json) {
          if (callback) {
            callback(json);
          }
        }
      });
    }
  }]);

  return AjaxRequest;
}();

var KeyElements = function KeyElements(btn) {
  _classCallCheck(this, KeyElements);

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
};

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
function dateFormated(separator, date, format) {
  var d, dd, mm, yyyy;

  if (date) {
    dd = date[0];
    mm = date[1];
    yyyy = date[2];
  } else {
    d = new Date();
    dd = d.getDate();
    mm = d.getMonth() + 1;
    yyyy = d.getFullYear();

    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
  }

  if (format) {
    if (separator == "slash") {
      var date = mm + "/" + dd + "/" + yyyy;
    } else {
      var date = dd + "-" + mm + "-" + yyyy;
    }
  } else {
    if (separator == "slash") {
      var date = mm + "/" + dd + "/" + yyyy;
    } else {
      var date = yyyy + "-" + mm + "-" + dd;
    }
  }

  return date;
}

//Create modal boxes for images and delete confirmation
function modal(el, type) {
  var path,
      modal_html = '';

  //Type == 1 display images, type == 2 display delete confirmation
  if (type == 1) {
    //Get img src attribute
    path = $(el).find("img").attr("src");

    //Create modal image sctructure
    modal_html += "<img src='" + path + "' width='100%'/>";

    //Insert the content
  } else if (type == 2) {
    modal_html += "<p>Excluir a imagem?</p>" + "<button class='modal-del-confirm mui-btn mui-btn--primary'>Excluir</button>" + "<button class='modal-del-cancel mui-btn mui-btn--danger'>Cancelar</button>";
  }

  //Insert the content and show modal
  $(".modal-box").html(modal_html);
  $(".bg-box, .modal-box").fadeIn("fast");

  //Hide modal
  $(".bg-box, .modal-del-cancel").on("click", function () {
    $(".bg-box, .modal-box").fadeOut("fast");
  });
}

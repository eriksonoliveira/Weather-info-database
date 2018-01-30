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

});

class KeyElements {
  constructor(btn) {
    this.btn = btn;

    this.form = $(btn).parents(".form-txt");
    this.horario = $(this.form).attr("data-hora");
    this.nome = $(this.form).find("select").val();
    this.cargo = $(this.form).find("select").attr("data-cargo");
    this.sendBtn = $(this.form).find(".send-text");
    this.editBtn = $(this.form).find(".edit-text");
    this.updateBtn = $(this.form).find(".update-text");
    this.cancelBtn = $(this.form).find(".update-cancel");
    this.textArea = $(this.form).find("textarea");
    this.success = '';
  }
}

//FORMATS TODAY DATA
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


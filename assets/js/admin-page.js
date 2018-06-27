"use strict";

$(document).ready(function () {

  //Get users' names and render table
  getUsers();
});

function getUsers() {
  //DOM elements
  var tableWraper = $(".users-table");

  var path = "admin/users";
  var data = new FormData();
  var page = 1;

  data.append("page", page);

  function getData(json) {
    var table = renderTable(json);
    $(tableWraper).append(table);

    //Create paginantion
    pageNumbers(json);
  }

  //Get users' names
  var users = new AjaxRequest(data);
  users.call(path, getData);
}

//Pagination
function pageNumbers(json) {
  var $pagination = $(".users-table-pagination ul");

  var totalPages = Math.ceil(json.users.num_pages),
      defaultOpts = {
    totalPages: totalPages,
    visiblePages: 5,
    first: 'Primeira',
    prev: 'Anterior',
    next: 'Próxima',
    last: 'Última',
    onPageClick: function onPageClick(event, page) {
      getNewData(page);
    }
  };

  $pagination.twbsPagination('destroy');
  $pagination.twbsPagination($.extend({}, defaultOpts));
}

//Get New Data
function getNewData(page) {
  //DOM elements
  var tableWraper = $(".users-table");

  var data = new FormData();
  var path = 'admin/users';

  data.append('page', page);

  function newData(json) {
    var table = renderTable(json);
    $(tableWraper).html(table);
  }

  var users = new AjaxRequest(data);
  users.call(path, newData);
}

function renderTable(json) {
  var tableHtml = "";

  tableHtml += "<table class='table table-hover'>";
  tableHtml += "<thead class=''>";
  tableHtml += "<tr>";
  tableHtml += "<th scope='col-5' width='40%'>Nome</th>";
  tableHtml += "<th scope='col-4' width='40%'>Função</th>";
  tableHtml += "<th scope='col-3' width='20%'>Permissões</th>";
  tableHtml += "</tr>";
  tableHtml += "</thead>";
  tableHtml += "<tbody>";
  //Create rows for each user
  for (var i in json.users.data) {
    tableHtml += "<tr>";
    tableHtml += "<td><a href='" + baseUrl + "user/?usr=" + json.users.data[i].id + "'>" + json.users.data[i].nome + "</a></td>";
    tableHtml += "<td>" + json.users.data[i].funcao + "</td>";
    tableHtml += "<td>" + json.users.data[i].permissoes + "</td>";
    tableHtml += "</tr>";
  }
  tableHtml += "</tbody>";
  tableHtml += "</table>";

  return tableHtml;
}

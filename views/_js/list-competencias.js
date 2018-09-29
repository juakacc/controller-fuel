$(document).ready(function() {
  esconderTudo();
  alterarFiltro();
});

function alterarFiltro() {
  var tipo = $("#tipo-filtro").val();
  $('#q').unmask();
  $('#q').attr('placeholder', '');
  $("#q").val('');

  if (tipo == 1) {
    $('#q').attr('placeholder', 'Nome/parte do nome do veículo...');
  } else if (tipo == 2) {
    $('#q').mask('00/0000', {clearIfNotMatch: true});
    $('#q').attr('placeholder', 'mm/aaaa');
  } else {
    $('#q').attr('placeholder', 'km ou hr');
  }
}

function esconderTudo() {
  $(".sub").hide();
  $(".fa-minus").addClass('fa-plus').removeClass('fa-minus');
}

function mostrar(id) {
  $("#div"+id).show();
  // altera ícone do botão
  $("#ic"+id).removeClass('fa-plus');
  $("#ic"+id).addClass('fa-minus');
  // altera ação do botão
  $("#bt"+id).attr('onclick', 'esconder('+id+')');
  $("#bt"+id).attr('title', 'Esconder');
}

function esconder(id) {
  $("#div"+id).hide();
  // altera ícone do botão
  $("#ic"+id).removeClass('fa-minus');
  $("#ic"+id).addClass('fa-plus');
  // altera ação do botão
  $("#bt"+id).attr('onclick', 'mostrar('+id+')');
  $("#bt"+id).attr('title', 'Expandir');
}

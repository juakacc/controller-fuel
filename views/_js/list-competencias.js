$(document).ready(function() {
  esconderTudo();
});

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
}

function esconder(id) {
  $("#div"+id).hide();
  // altera ícone do botão
  $("#ic"+id).removeClass('fa-minus');
  $("#ic"+id).addClass('fa-plus');
  // altera ação do botão
  $("#bt"+id).attr('onclick', 'mostrar('+id+')');
}

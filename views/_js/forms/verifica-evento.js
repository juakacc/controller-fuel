$(document).ready(function() {
  carregarEventos();
});


$("#veiculo").change(function() {
  carregarEventos();
});

function carregarEventos() {
  var veiculo = $('#veiculo');
  var select = $('#select-event');
  var options = '';

  var home = get_home_uri();
  $.post(home+'ajax/recuperar-eventos',
      {'id_veiculo': veiculo.val()}, function(result) {

    $.each(result, function(i, obj) {
      options += '<option value="'+ obj.id+'">'+obj.nome+'</option>';
    });
    select.html(options);
  });
}

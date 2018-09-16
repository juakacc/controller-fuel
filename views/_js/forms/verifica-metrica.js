$(document).ready(function() {
  setarMetrica();
});

$('#veiculo').change(function() {
  setarMetrica();
});

function setarMetrica() {
  var veiculo = $('#veiculo');
  var metrica = $('#metrica_inicial');

  var home = get_home_uri();
  $.post(home+'ajax/verificar-metrica',
      {'id_veiculo': veiculo.val()}, function(result) {
    metrica.attr('placeholder', result);
  });
}

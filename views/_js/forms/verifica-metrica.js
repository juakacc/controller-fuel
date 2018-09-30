$(document).ready(function() {
  setarMetrica();
});

$('#veiculo').change(function() {
  setarMetrica();
});

function setarMetrica() {
  var veiculo = $('#veiculo');
  var metrica = $('#metrica_inicial');
  var last_metrica = $('#last_metrica');

  var home = get_home_uri();
  $.post(home+'ajax/verificar-metrica',
      {'id_veiculo': veiculo.val()},
    function(result) {
      // alert(result.last_metrica);
    metrica.attr('placeholder', result.tipo_metrica);
    // last_metrica.removeClass('text-danger').addClass('text-info');
    last_metrica.html('Última métrica registrada: ' + result.last_metrica);
  });
}

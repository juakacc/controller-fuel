$(document).ready(function() {
  setarCombustivel();
});

$('#veiculo').change(function() {
  setarCombustivel();
});

function setarCombustivel() {
  var veiculo = $('#veiculo');
  var combustivel = $('#combustivel');

  var home = get_home_uri();
  $.post(home+'ajax/verificar-combustivel',
      {'id_veiculo': veiculo.val()}, function(result) {
    combustivel.val(result);
  });
}

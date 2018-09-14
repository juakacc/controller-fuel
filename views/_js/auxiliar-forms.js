$('#veiculo').change(function() {
  var veiculo = $('#veiculo');
  var combustivel = $('#combustivel');

  $.post('http://127.0.0.1/controle-veiculos/ajax/verificar-combustivel',
      {'id_veiculo': veiculo.val()}, function(result) {
    // alert(result);
    combustivel.val(result);
  });
});

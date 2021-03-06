$(document).ready(function() {
  carregarEventos();
});

$("#veiculo").change(function() {
  carregarEventos();
});

function carregarEventos() {
  var veiculo = $('#veiculo');
  var select = $('#select-event');
  var type = $("#type");
  var options = '';

  var home = get_home_uri();
  $.post(home+'ajax/recuperar-eventos',
    {
      'id_veiculo': veiculo.val(),
      'type': type.val()
    }, function(result) {
      $.each(result, function(i, obj) {
        options += '<option value="'+ obj.id+'">'
          +obj.nome+ ' :: ' + obj.data + ' :: ' + obj.metrica + ' ' + obj.tipo_metrica +
          '</option>';
      });
      select.html(options);

      var id_event = location.href.substring(location.href.lastIndexOf('/') + 1);
      if ($.isNumeric(id_event)) {
        select.val(id_event);
      }
  });
}

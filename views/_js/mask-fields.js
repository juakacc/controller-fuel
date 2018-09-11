$(document).ready(function () {
  $('input[name=placa]').mask('AAA-0000');
  // $('input[name=km_inicial]').mask('000.000.000.000.000,000', {reverse: true});
  $('input[name=km_inicial]').mask("##.000", {reverse: true, maxlength: false});
  $('input[name=data]').mask('00/00/0000');
  $('input[name=qtd]').mask("#,00", {reverse: true, maxlength: false});
});

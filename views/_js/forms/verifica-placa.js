$(document).ready(function() {
  setarPlaca();
});

$('#sem_placa').change(function() {
  setarPlaca();
})

function setarPlaca() {
  if ($('#sem_placa').is(':checked')) {
    // $('#placa').val('');
    $('#placa').attr('readonly', true);
    $('#uf-placa').attr('disabled', true);
  } else {
    $('#placa').attr('readonly', false);
    $('#uf-placa').attr('disabled', false);
  }
}

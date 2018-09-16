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
  } else {
    $('#placa').attr('readonly', false);
  }
}

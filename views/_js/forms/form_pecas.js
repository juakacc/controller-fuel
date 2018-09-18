$(document).ready(function() {
  var local = $(".div-pecas");
  var add_btn = $("#btn-add");

  var x = 1;
  $(add_btn).click(function(e) {
    e.preventDefault();
    x++;
    var linha = '<div class="form-group row">\
    <div class="col-2"></div>\
      <div class="col-5">\
        <input type="text" name="peca[]" value="" class="form-control">\
      </div>\
      <div class="col-1"></div>\
      <div class="col-2">\
        <input type="number" name="qtd[]" class="form-control" value="" min="1">\
      </div>\
      <div class="col"><a href="#" class="btn btn-danger remove_field"><i class="fas fa-minus-circle"></i></a></div>\
    </div>'
    $(local).append(linha);
  });

  $(local).on("click", ".remove_field", function(e) {
    e.preventDefault();
    $(this).parent('div').parent('div').remove();
  });
});

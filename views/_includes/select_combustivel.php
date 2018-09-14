<select class="custom-select" name="combustivel" id="combustivel">
  <option value="Gasolina" <?php if (check_array($model->form_data, 'combustivel') == 'Gasolina'):?>selected<?php endif; ?>>
    Gasolina
  </option>
  <option value="Diesel" <?php if (check_array($model->form_data, 'combustivel') == 'Diesel'):?>selected<?php endif; ?>>
    Diesel
  </option>
  <option value="Álcool" <?php if (check_array($model->form_data, 'combustivel') == 'Álcool'):?>selected<?php endif; ?>>
    Álcool
  </option>
</select>

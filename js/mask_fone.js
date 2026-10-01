const inputTelefone = document.getElementById('telefone');

  inputTelefone.addEventListener('input', function() {
    let valor = this.value.replace(/\D/g, '');
    let formattedValue = '';

    if (valor.length > 0) {
      if (valor.length > 2) {
        formattedValue = valor.substring(0, 2) + '-' + valor.substring(2);
      } else {
        formattedValue = valor;
      }
    }

    this.value = formattedValue;
  });
function fazerLogin() {
  var email = document.getElementById('email').value;
  var senha = document.getElementById('senha').value;

  // Validar se os campos estão preenchidos
  if (email === '' || senha === '') {
      alert('Preencha todos os campos');
      return;
  }

  // Enviar os dados para o servidor via AJAX
  $.ajax({
      type: 'POST',
      url: 'verificar_login.php',
      data: {
          email: email,
          senha: senha
      },
      success: function(response) {
          if (response === 'success') {
              // Redirecionar para a página de sucesso
              window.location.href = 'index.html';
          } else {
              alert('Credenciais inválidas. Tente novamente.');
          }
      }
  });
}

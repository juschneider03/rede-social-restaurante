class Login {
    
    validarFormulario() {
        var email = document.getElementById("email").value;
        var senha = document.getElementById("senha").value;

        if (email.trim() === "" || senha.trim() === "") {
            alert("Preencha todos os campos.");
        } 
    }
}
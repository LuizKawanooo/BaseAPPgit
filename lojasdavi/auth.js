const apiUrl = "https://endologic.com.br/tcc/php";

// === CADASTRO ===
const btnCadastrar = document.getElementById('btnCadastrar');
if (btnCadastrar) {
  btnCadastrar.addEventListener('click', async () => {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
      const userCredential = await firebase.auth().createUserWithEmailAndPassword(email, password);
      const token = await userCredential.user.getIdToken();

      // Envia para o servidor MySQL
      await fetch(`${apiUrl}/register.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, token })
      });

      alert("Usuário cadastrado com sucesso!");
      window.location.href = "index.html";
    } catch (error) {
      alert("Erro ao cadastrar: " + error.message);
    }
  });
}

// === LOGIN ===
const btnLogin = document.getElementById('btnLogin');
if (btnLogin) {
  btnLogin.addEventListener('click', async () => {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
      const userCredential = await firebase.auth().signInWithEmailAndPassword(email, password);
      const token = await userCredential.user.getIdToken();

      const response = await fetch(`${apiUrl}/login.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, token })
      });
      const data = await response.json();

      alert("Login bem-sucedido!");
      console.log(data);
    } catch (error) {
      alert("Erro ao fazer login: " + error.message);
    }
  });
}

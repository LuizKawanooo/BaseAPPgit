<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela de Login</title>
  <style>
    /* ======== ESTILO ======== */
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #00bfa6, #00796b);
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .form-container {
      width: 350px;
      background-color: #fff;
      box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
      border-radius: 10px;
      box-sizing: border-box;
      padding: 30px;
    }

    .title {
      text-align: center;
      font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
            "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
      margin: 10px 0 30px 0;
      font-size: 26px;
      font-weight: 800;
      color: #00796b;
    }

    .form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .input {
      border-radius: 20px;
      border: 1px solid #c0c0c0;
      padding: 12px 15px;
      outline: none;
      font-size: 14px;
    }

    .page-link {
      text-decoration: underline;
      text-align: right;
      color: #747474;
      font-size: 12px;
      margin-top: -8px;
      cursor: pointer;
    }

    .form-btn {
      padding: 10px 15px;
      border-radius: 20px;
      border: none;
      background: teal;
      color: white;
      font-weight: bold;
      cursor: pointer;
      box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .form-btn:hover {
      background: #00695c;
    }

    .sign-up-label {
      text-align: center;
      font-size: 12px;
      color: #747474;
      margin-top: 15px;
    }

    .sign-up-link {
      color: teal;
      text-decoration: underline;
      font-weight: bold;
      cursor: pointer;
    }

    .buttons-container {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 20px;
    }

    .google-login-button {
      border-radius: 20px;
      padding: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      border: 2px solid #747474;
      font-size: 13px;
      font-weight: 600;
    }

    .google-login-button:hover {
      background: #f5f5f5;
    }

    .google-icon {
      width: 18px;
      height: 18px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <p class="title">Bem-vindo de volta</p>

    <form id="loginForm" class="form">
      <input type="email" id="email" class="input" placeholder="E-mail" required>
      <input type="password" id="senha" class="input" placeholder="Senha" required>
      <p class="page-link" id="recuperarSenha">Esqueceu a senha?</p>
      <button type="submit" class="form-btn">Entrar</button>
    </form>

    <p class="sign-up-label">
      Ainda não tem conta?
      <a href="cadastro.html" class="sign-up-link">Cadastre-se</a>
    </p>

    <div class="buttons-container">
      <div id="googleLogin" class="google-login-button">
        <svg class="google-icon" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8
          c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
          C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,
          20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
          <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,
          18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
          C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
          <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,
          13.409-5.192l-6.19-5.238C29.211,35.091,
          26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025
          C9.505,39.556,16.227,44,24,44z"></path>
          <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303
          c-0.792,2.237-2.231,4.166-4.087,5.571
          c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238
          C36.971,39.205,44,34,44,24C44,22.659,
          43.862,21.35,43.611,20.083z"></path>
        </svg>
        <span>Entrar com Google</span>
      </div>
    </div>
  </div>

  <!-- Firebase SDK -->
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>

  <script>
    // 🔥 Configuração do Firebase
    const firebaseConfig = {
      apiKey: "AIzaSyB9QqVbGYaLLqUD5LIXAwLXiTWtIrF-16k",
      authDomain: "lojasdavi-78bb2.firebaseapp.com",
      projectId: "lojasdavi-78bb2",
      storageBucket: "lojasdavi-78bb2.firebasestorage.app",
      messagingSenderId: "671422096205",
      appId: "1:671422096205:web:ee41eb8af7856fd17a4d04"
    };
    firebase.initializeApp(firebaseConfig);

    const apiUrl = "https://endologic.com.br/lojasdavi/php/";

    // 🔹 Login com e-mail e senha
    async function fazerLogin(email, senha) {
      try {
        const cred = await firebase.auth().signInWithEmailAndPassword(email, senha);
        const user = cred.user;

        const response = await fetch(`${apiUrl}login.php`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ email })
        });
        const data = await response.json();

        if (data.success) {
          alert(`Bem-vindo, ${data.user.nome}!`);
          localStorage.setItem("user", JSON.stringify(data.user));
          window.location.href = "index.html";
        } else {
          alert("Usuário não encontrado no banco de dados.");
        }
      } catch (error) {
        alert("Erro ao fazer login: " + error.message);
      }
    }

async function loginComGoogle() {
  const provider = new firebase.auth.GoogleAuthProvider();
  try {
    const result = await firebase.auth().signInWithPopup(provider);
    const user = result.user;

    const response = await fetch(`${apiUrl}login.php`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email: user.email })
    });

    const text = await response.text();
    console.log("🔍 Resposta do servidor:", text);

    let data;
    try {
      data = JSON.parse(text);
    } catch {
      throw new Error("A resposta não é JSON. Caminho incorreto ou erro no PHP.");
    }

    if (data.success) {
      alert(`Bem-vindo, ${data.user.nome}!`);
      localStorage.setItem("user", JSON.stringify(data.user));
      window.location.href = "index.html";
    } else {
      alert("Conta Google conectada, mas usuário não encontrado no banco.");
    }
  } catch (error) {
    alert("Erro ao fazer login com Google: " + error.message);
  }
}

    document.getElementById("googleLogin").addEventListener("click", loginComGoogle);
  </script>
</body>
</html>




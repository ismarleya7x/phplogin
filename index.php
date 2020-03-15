<?php
session_start();
require_once("Controller/UsuarioController.php");
require_once("Model/Usuario.php");
$usuarioController = new UsuarioController(); //Instância de Controller

$msg = "";

if (isset($_GET["msg"]) && $_GET["msg"] = 1) {
  $msg = "<div class='alert alert-warning'>Você precisa estar logado para acessar essa página!</div>";
}

if (isset($_SESSION["nome"])) {
  header("Location: painel.php");
}

if (filter_input(INPUT_POST, "txtUsuarioRegistro", FILTER_SANITIZE_STRING)) {
  $usuario = new Usuario(); //Instância de usuário

  $usuario->setNome(filter_input(INPUT_POST, "txtUsuarioRegistro", FILTER_SANITIZE_STRING));
  $usuario->setSenha(md5(filter_input(INPUT_POST, "txtSenhaRegistro", FILTER_SANITIZE_STRING)));
  $usuario->setEmail(filter_input(INPUT_POST, "txtEmailRegistro", FILTER_SANITIZE_STRING));
  $usuario->setData(date("Y-m-d H:i:ss"));

  $result = $usuarioController->Cadastrar($usuario);

  switch ($result) {
    case 1:
      $msg = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
      break;
    case -1:
      $msg = "<div class='alert alert-warning'>Usuário já cadastrado!</div>";
      break;
    case -2:
      $msg = "<div class='alert alert-danger'>Dados inválidos!</div>";
      break;
    case -10:
      $msg = "<div class='alert alert-danger'>Falha ao tentar efetuar o cadastro!</div>";
      break;
  }
}
if (filter_input(INPUT_POST, "txtUsuario", FILTER_SANITIZE_STRING)) {
  $usuario = $usuarioController->Autenticar(filter_input(INPUT_POST, "txtUsuario", FILTER_SANITIZE_STRING), filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING));
  if ($usuario != null) {
    $_SESSION["nome"] = $usuario->getNome();
    header("Location: painel.php");
  } else {
    $msg = "<div class='alert alert-danger'>Usuário ou senha inválido!</div>";
  }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>LoginTXT</title>

  <style>
    .form div img {
      display: block;
      border-radius: 50%;
      margin: 0 auto 10px;
      width: 115px;
      height: 115px;
      margin-top: 45px;
    }
  </style>
</head>

<body>
  <div class="login-page">
    <div class="form">
      <div>
        <img src="Assets/logo_form.png" alt="Preto Design Estúdio" title="Preto Design Estúdio" class="formLogin">
      </div>
      <form class="register-form" method="POST">
        <input type="text" placeholder="name" name="txtUsuarioRegistro" required />
        <input type="password" placeholder="password" name="txtSenhaRegistro" required />
        <input type="text" placeholder="email address" name="txtEmailRegistro" required />
        <input type="submit" value="Cadastrar" name="subCadastrar" class="btn">
        <p class="message">Já possui cadastro? <a href="#" id="btnEntrar">Entrar</a></p>
      </form>
      <form class="login-form" method="POST">
        <input type="text" placeholder="username" name="txtUsuario" required />
        <input type="password" placeholder="password" name="txtSenha" required />
        <input type="submit" value="Entrar" name="subEntrar" class="btn">
        <p class="message">Não possui cadastro? <a href="#" id="btnCadastrar">Criar uma conta</a></p>
      </form>
      <div>
        <?php echo $msg; ?>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
</body>

</html>
<?php

require_once("DAL/UsuarioDAO.php");

class UsuarioController
{

  private $usuarioDAO;

  public function __construct()
  {
    $this->usuarioDAO = new UsuarioDAO();
  }

  public function Cadastrar(Usuario $usuario)
  {
    if (strlen($usuario->getNome()) > 3 && strlen($usuario->getSenha()) >= 7 && strpos($usuario->getEmail(), "@") > 0) {
      return $this->usuarioDAO->Cadastrar($usuario);
    } else {
      return -2;
      //Dados inválidos
    }
  }

  public function RetornaUsuario(string $email)
  {
    if (strpos($email, "@") > 0 && strpos($email, ".") > 0) {
      return $this->usuarioDAO->RetornaUsuario($email);
    } else {
      return null;
    }
  }
  public function Autenticar(string $email, string $senha)
  {
    if (strpos($email, "@") > 0 && strpos($email, ".") > 0 && strlen($senha) >= 7) {
      echo "controler";
      return $this->usuarioDAO->Autenticar($email, $senha);
    } else {
      return null;
    }
  }
}

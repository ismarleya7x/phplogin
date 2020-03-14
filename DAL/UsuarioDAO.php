<?php

require_once("Model/Usuario.php");

class UsuarioDAO{

  private $debug = true;
  private $dir = "Arquivos";

  public function Cadastrar(Usuario $usuario)
  {
    try {
      $nomeArq = $usuario->getEmail() . ".txt";

      if (!$this->VerificaArquivo($nomeArq)) {
        //Realiza cadastro
        $diretorioCompleto = $this->dir . "/" . $nomeArq;
        $fopen = fopen($diretorioCompleto, "w");

        $str = "{$usuario->getNome()};{$usuario->getSenha()};{$usuario->getEmail()};{$usuario->getData()}";
        if(fwrite($fopen, $str)){
          return 1;
          //Usuário cadastrado com sucesso
          fclose($fopen);
        }else{
          fclose($fopen);
          return -10;
          //Erro ao tentar cadastrar
        }
      } else {
        return -1;
        //Usuário já cadastrado
      }
    } catch (Exception $ex) {
      if ($this->debug) {
        echo $ex->getMessage();
      }
    }
  }

  public function RetornaUsuario(string $email){
    if($this->VerificaArquivo($email)){
      $diretorioCompleto = $this->dir . "/" . $email;
      $fopen = fopen($diretorioCompleto,'r');

      $file = fread($fopen, filesize($diretorioCompleto));
      $arr = explode(";", $file);

      $usuario = new Usuario();

      $usuario->setNome($arr[0]);
      $usuario->setSenha($arr[1]);
      $usuario->setEmail($arr[2]);
      $usuario->setData($arr[3]);

      fclose($fopen);
      return $usuario;
    }else{
      return null;
    }
  }

  private function VerificaArquivo(string $nomeArq)
  {
    $diretorioCompleto = $this->dir . "/" . $nomeArq;
    if (file_exists($diretorioCompleto)) {
      return true;
    } else {
      return false;
    }
  }

  public function Autenticar(string $email, string $senha){
    $filename = "{$email}.txt";
    if($this->VerificaArquivo($filename)){
      $usuario = $this->RetornaUsuario($filename);
      if($usuario->getSenha() == md5($senha)){
        return $usuario;
      }else{
        return null;
      }
    }else{
      return null;
    }
  }
  
}

<?php

class Usuario{
  private $nome;
  private $senha;
  private $email;
  private $data;


  public function setNome($nome){
    $this->nome = $nome;
  }
  public function getNome(){
    return $this->nome;
  }

  public function setSenha($senha){
    $this->senha = $senha;
  }
  public function getSenha(){
    return $this->senha;
  }

  public function setEmail($email){
    $this->email = $email;
  }
  public function getEmail(){
    return $this->email;
  }

  public function setData($data){
    $this->data = $data;
  }

  public function getData(){
    return $this->data;
  }
}
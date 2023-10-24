<?php
class Criptografia {
  
    // função para criptografar texto usando MD5 e SHA-256 em conjunto
    public static function cripto($texto) {
      $md5 = md5($texto);
      $sha256 = hash('sha256', $md5);
      return $sha256;
    }
  
  }
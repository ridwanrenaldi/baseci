<?php

  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  if (!function_exists("encrypt_decrypt")) {
    function encrypt_decrypt($action, $string, $secret_key, $secret_iv){
      $output = false;
      $encrypt_method = "AES-256-CBC";
      $secret_key = $secret_key;
      $secret_iv = $secret_iv;
      // hash
      $key = hash('sha256', $secret_key);    
      // iv - encrypt method AES-256-CBC expects 16 bytes
      $iv = substr(hash('sha256', $secret_iv), 0, 16);
      if ( $action == 'encrypt' ) {
          $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
          $output = base64_encode($output);
      } else if( $action == 'decrypt' ) {
          $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
      }
      return $output;
    }
  }

?>
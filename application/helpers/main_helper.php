<?php

  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  if (!function_exists("upload_file")) {
    function upload_file($path, $type='gif|jpg|png|jpeg|doc|docx|pdf|xls|xlsx', $name='_file_'){
      $CI = &get_instance();
      
      if (!file_exists($path)) {
        mkdir($path, 0777, true);
      }
  
      if(isset($_FILES[$name]) && file_exists($_FILES[$name]['tmp_name']) ){
        $config['upload_path']          = $path;
        $config['allowed_types']        = $type;
        $config['max_size']             = 0; // 1MB
        $config['max_width']            = 0; // pixel
        $config['max_height']           = 0; // pixel
        $config['overwrite']            = TRUE;
        $config['encrypt_name']         = TRUE;
        $config['remove_spaces']		    = TRUE;
    
        $CI->load->library('upload', $config);
        if ($CI->upload->do_upload($name)){  
          $response = array(
            'status' => 'success',
            'message' => 'Image uploaded successfully',
            'data' => $CI->upload->data()
          );
          
        }else{
          $response = array(
            'status' => 'error',
            'message' => $CI->upload->display_errors()
          );
        }
  
      } else {
        $response = array(
          'status' => 'empty',
          'message' => 'Choose file to upload'
        );
      }
  
      return $response;
    }  
  }

  if (!function_exists("delete_file")) {
    function delete_file($path){
      if (file_exists($path)) {
        unlink($path);
        $response = array(
          'status' => 'success',
          'message' => 'File deleted successfully',
        );
      } else {
        $response = array(
          'status' => 'error',
          'message' => 'File doesn\'t exist'
        );
      }
      return $response;
    }  
  }

?>
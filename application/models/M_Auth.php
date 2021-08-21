<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model {
  private $table = 'account';
  
  public function __construct(){
      parent::__construct();
  }

  public function rules_login($mode){
    $rules = array();

    if ($mode == 'username') {
      $rules[] = array(  'field' => '_username_',
              'label' => 'Username',
              'rules' => 'required|trim|alpha_numeric|min_length[4]|max_length[12]');
    }

    if ($mode == 'email') {
      $rules[] = array( 'field' => '_email_',
              'label' => 'Email',
              'rules' => 'required|trim|valid_email');
    }


    $rules[] = array(  'field' => '_password_',
            'label' => 'Password',
            'rules' => 'required|trim|alpha_numeric|min_length[4]|max_length[20]');

    return $rules;
  }

  public function rules_register(){
    $post = $this->input->post();
    $rules = array();
    if (isset($post['_name_'])) {
      $rules[] = array( 'field' => '_name_',
                        'label' => 'Name',
                        'rules' => 'required|trim|alpha_numeric_spaces|min_length[4]|max_length[20]');
    }
    
    if (isset($post['_username_'])) {
      $rules[] = array( 'field' => '_username_',
                        'label' => 'Username',
                        'rules' => 'required|trim|alpha_numeric|min_length[4]|max_length[12]|is_unique[account.account_username]',
                        'errors' => array('is_unique' => 'This %s already exists.'));
    }

    if (isset($post['_email_'])) {
      $rules[] = array( 'field' => '_email_',
                        'label' => 'Email',
                        'rules' => 'required|trim|valid_email|is_unique[account.account_email]');
    }

    if (isset($post['_password_'])) {
      $rules[] = array( 'field' => '_password_',
                        'label' => 'Password',
                        'rules' => 'required|trim|alpha_numeric|min_length[4]|max_length[20]');
    }

    if (isset($post['_passconf_'])) {
      $rules[] = array( 'field' => '_passconf_',
                        'label' => 'Confirm Password',
                        'rules' => 'required|trim|matches[_password_]');
    }

    if (isset($post['_level_'])) {
      $rules[] =  array( 'field' => '_level_',
                        'label' => 'Level',
                        'rules' => 'required|trim|alpha|in_list[root,admin,user]');
    }

    if (isset($post['_address_'])) {
      $rules[] =  array(  'field' => '_address_',
                          'label' => 'Address',
                          'rules' => 'required|trim|min_length[2]|max_length[250]');
    }

    if (isset($post['_phone_'])) {
      $rules[] =  array(  'field' => '_phone_',
                          'label' => 'Phone',
                          'rules' => 'required|trim|min_length[2]|max_length[30]');
    }

    if (isset($post['_checkfile_'])) {
      $rules[] = array( 'field' => '_checkfile_',
                        'label' => 'Image',
                        'rules' => 'callback_checkFileImg');
    }
    return $rules;
  }

  // $mode = 'username' or 'email'
  public function login($mode) {
    $post = $this->input->post();
    if (($mode == 'username' && !empty($post['_username_']) && !empty($post['_password_'])) || ($mode == 'email' && !empty($post['_email_']) && !empty($post['_password_']))) {
      
      if ($mode == 'username') {
        $where = array('account_username' => strtolower($post['_username_']));
      }
  
      if ($mode == 'email') {
        $where = array('account_email' => strtolower($post['_email_']));
      }
  
      $getuser = $this->db->get_where($this->table, $where);
  
      if ($getuser->num_rows() > 0) {
        $user = $getuser->row_array();

        if ($user['account_isactive']) {

          if (password_verify(strtolower($post['_password_']), $user['account_password'])) {
            $data = [
              'id'        => $this->encryption->encrypt($user['account_id']),
              'name'      => $this->encryption->encrypt($user['account_name']),
              'username'  => $this->encryption->encrypt($user['account_username']),
              'email'     => $this->encryption->encrypt($user['account_email']),
              'level'     => $this->encryption->encrypt($user['account_level']),
              'image'     => $this->encryption->encrypt('default.png'),
              'created'   => $this->encryption->encrypt($user['account_created']),
            ];

            if (isset($user['account_image']) && !empty($user['account_image'])) {
              $data['image'] = $this->encryption->encrypt($user['account_image']);
            }
            
            $this->session->set_userdata($data);
            $response = array(
              'status' => 'success',
              'message' => 'Login successful!',
            );

          } else {
            $response = array(
              'status' => 'error',
              'message' => 'Wrong password!',
            );
          }
        } else {
          $response = array(
            'status' => 'error',
            'message' => 'This '.$mode.' has not been activated!',
          );
        }
      } else {
        $response = array(
          'status' => 'error',
          'message' => $mode.' not found!',
        );
      }

    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Enter data correctly!',
      );
    }
    

    return $response;
  }

  public function session($levels=array()){
    $session = $this->session->userdata();
    if (!empty($session)) {
      if (!empty($session['id']) && !empty($session['name']) && !empty($session['username']) && !empty($session['email']) && !empty($session['level']) && !empty($session['image']) && !empty($session['created'])) {
        $id       = $this->encryption->decrypt($session['id']);
        $name     = $this->encryption->decrypt($session['name']);
        $username = $this->encryption->decrypt($session['username']);
        $email    = $this->encryption->decrypt($session['email']);
        $level    = $this->encryption->decrypt($session['level']);
        $image    = $this->encryption->decrypt($session['image']);
        $created  = $this->encryption->decrypt($session['created']);
        if (in_array($level, $levels, TRUE)) {
          $data = [
            'id'        => $id,
            'name'      => $name,
            'username'  => $username,
            'email'     => $email,
            'level'     => $level,
            'image'     => $image,
            'created'   => $created,
          ];
          return $data;
        } else {
          return FALSE;
        }
      } else {
        return FALSE;
      }
    } else {
      return FALSE;
    }
  }

  public function refreshSession($id){
    $user = $this->db->get_where($this->table, array('account_id'=>$id))->row_array();
    $data = [
      'id'        => $this->encryption->encrypt($user['account_id']),
      'name'      => $this->encryption->encrypt($user['account_name']),
      'username'  => $this->encryption->encrypt($user['account_username']),
      'email'     => $this->encryption->encrypt($user['account_email']),
      'level'     => $this->encryption->encrypt($user['account_level']),
      'image'     => $this->encryption->encrypt('default.png'),
      'created'   => $this->encryption->encrypt($user['account_created']),
    ];
    if (isset($user['account_image']) && !empty($user['account_image'])) {
      $data['image'] = $this->encryption->encrypt($user['account_image']);
    }
    $this->session->set_userdata($data);
  }

  public function logout() {
    $arr = array('id','name','username','email','level','image');
    $this->session->unset_userdata($arr);
    $this->session->sess_destroy();
  }

  public function notification(){
    $notif = array('status' => '', 'message' => '');
    if (!empty(validation_errors())) {
      $notif = array('status' => 'error', 'message' => str_replace("\n", '', validation_errors('<li>','</li>')));
    }

    if ($this->session->flashdata('notif')) {
      $notif = $this->session->flashdata('notif');
    }
    return $notif;
  }

}
?>
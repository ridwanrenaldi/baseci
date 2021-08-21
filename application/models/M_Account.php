<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Account extends CI_Model {
  private $table = 'account';
  private $primary = 'account_id';
  
  public function __construct(){
      parent::__construct();
  }

  public function rules() {
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

    if (isset($post['_checkfile_'])) {
      $rules[] = array( 'field' => '_checkfile_',
                        'label' => 'Image',
                        'rules' => 'callback_checkFileImg');
    }

    return $rules;
  
  }

  public function getById($id){
    return $this->db->get_where($this->table, array($this->primary => $id) )->row_array();
  }

  public function getAll() {
    return $this->db->get($this->table)->result_array();
  }


  public function insert($mode){
    $post = $this->input->post();
    if (!empty($post)){

      if ($mode == 'username') {
        $where = array('account_username' => strtolower(htmlspecialchars($post['_username_'])));
      }
  
      if ($mode == 'email') {
        $where = array('account_email' => strtolower(htmlspecialchars($post['_email_'])));
      }

      $check = $this->db->get_where($this->table, $where)->num_rows();
      
      if ($check > 0) {
        $response = array(
          'status' => 'error',
          'message' => 'This '.$mode.' already exists',
        );

      } else {

        if ($post['_password_'] === $post['_passconf_']) {

          $uploadimg = upload_file('./uploads/account/','jpg|png|jpeg|');

          if ($uploadimg['status'] == 'error') {
            $response = array(
              'status' => 'error',
              'message' => $uploadimg['message'],
            );

          } else {
            $data = array(
              'account_id'           => NULL,
              'account_name'         => htmlspecialchars($post['_name_']),
              'account_password'     => password_hash(strtolower($post['_password_']), PASSWORD_BCRYPT, array('cost'=>8)),
              'account_isactive'     => 0,
              'account_created'      => date('Y-m-d H:i:s'),
              'account_modified'     => date('Y-m-d H:i:s'),
              'account_level'        => 'admin',
              'account_image'        => NULL,
            );

            if ($uploadimg['status'] == 'success') {
              $data['account_image'] = $uploadimg['data']['file_name'];
            }

            if (isset($post['_username_'])) {
              $data['account_username'] = strtolower(htmlspecialchars($post['_username_']));
            }

            if (isset($post['_email_'])) {
              $data['account_email'] = strtolower(htmlspecialchars($post['_email_']));
            }

            if (isset($post['_level_'])) {
              $data['account_level'] = strtolower(htmlspecialchars($post['_level_']));
            }

            $data = $this->security->xss_clean($data);
            if($this->db->insert($this->table, $data)){
              $response = array(
                'status' => 'success',
                'message' => 'Success insert data',
              );
            } else {
              $response = array(
                'status' => 'error',
                'message' => 'Failed insert data',
              );
            }
          } 
        } else {
          $response = array(
            'status' => 'error',
            'message' => 'Confirm password must be correct!',
          );
        }
      }
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Data not found!',
      );
    }

    return $response;
  }

  public function update($id, $mode){
    $post = $this->input->post();
    if (!empty($post)){

      if (!empty($post['_username_'])) {

        if ($mode == 'username') {
          $where = array('account_username' => strtolower(htmlspecialchars($post['_username_'])));
        }
    
        if ($mode == 'email') {
          $where = array('account_email' => strtolower(htmlspecialchars($post['_email_'])));
        }

        $check = $this->db->get_where($this->table, $where)->num_rows();
        if ($check > 0) {
          $username = array(
            'status' => 'error',
            'message' => 'This username already exists',
          );
        } else {
          $username = TRUE;
        }
      } else {
        $username = TRUE;
      }

      if (!empty($post['_password_']) && !empty($post['_passconf_'])) {
        if ($post['_password_'] === $post['_passconf_']) {
          $password = TRUE;

        } else {
          $password = array(
            'status' => 'error',
            'message' => 'Confirm password must be correct!',
          );
        }
      } else {
        $password = TRUE;
      }

      
      if ($username == TRUE && $password == TRUE) {

        
        $uploadimg = upload_file('./uploads/account/','jpg|png|jpeg|');
        
        if ($uploadimg['status'] == 'error') {
          $response = $uploadimg;
          
        } else {
          
          $account = $this->getById($id);
          if (!empty($data['account_image']) && $account['account_image'] != 'default.png') {
            $oldpath = './uploads/account/'.$account['account_image'];
            delete_file($oldpath);
          }
          
          $data = array(
            'account_name'         => htmlspecialchars($post['_name_']),
            'account_modified'     => date('Y-m-d H:i:s'),
          );

          if ($uploadimg['status'] == 'success') {
            $data['account_image'] = $uploadimg['data']['file_name'];
          }

          if (isset($post['_username_'])) {
            $data['account_username'] = strtolower(htmlspecialchars($post['_username_']));
          }

          if (isset($post['_email_'])) {
            $data['account_email'] = strtolower(htmlspecialchars($post['_email_']));
          }

          if (isset($post['_password_']) && isset($post['_passconf_'])) {
            $data['account_password'] = password_hash(strtolower($post['_password_']), PASSWORD_BCRYPT, array('cost'=>8));
          }

          if (isset($post['_level_'])) {
            $data['account_level'] = strtolower(htmlspecialchars($post['_level_']));
          }

          $data = $this->security->xss_clean($data);
          $this->db->where($this->primary, $id);
          if($this->db->update($this->table, $data)){
            $response = array(
              'status' => 'success',
              'message' => 'Success update data',
            );
          } else {
            $response = array(
              'status' => 'error',
              'message' => 'Failed update data',
            );
          }
        }
      } else {
        if ($username != TRUE) {
          $response = $username;
        } else {
          $response = $password;
        }
      }
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Data not found!',
      );
    }
    return $response;
  }

  public function delete($id){
    $data = $this->getById($id);
    if ($data) {
      $path = './uploads/account/'.$data['account_image'];
      if (!empty($data['account_image']) && $data['account_image'] != 'default.png') {
        delete_file($path);
      }
      if($this->db->delete($this->table, array($this->primary => $id))){
        $response = array(
          'status' => 'success',
          'message' => 'Success delete data',
        );
      } else {
        $response = array(
          'status' => 'error',
          'message' => 'Failed delete data',
        );
      }
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Data not found',
      );
    }
    return $response;
  }

}
?>
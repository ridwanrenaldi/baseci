<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('M_Account');
	}

  
  // ==============================================
  //               LOAD VIEW
  // ==============================================

  public function login(){
    $sess = $this->M_Auth->session(array('root','admin'));
    if ($sess === FALSE) {
      $data['datatables'] = false;
      $data['icheck']     = true;
      $data['switch']     = false;
      $data['select2']    = false;
      $data['daterange']  = false;
      $data['colorpicker']= false;
      $data['inputmask']  = false;
      $data['dropzonejs'] = false;
      $data['summernote'] = false;
      $data['mode']       = $this->config->item('mode'); // 'username' or 'email'
      $data['swal']       = array(
        'type' => 'default',
        'button'  => NULL,
        'url' => NULL,
      );

      $this->form_validation->set_rules($this->M_Auth->rules_login($this->config->item('mode')));
      if ($this->form_validation->run() === TRUE) {

        $login = $this->M_Auth->login($this->config->item('mode'));
        if ($login['status'] == 'success') {
          redirect(site_url('admin/dashboard/index'),'refresh');

        } else {
          $this->session->set_flashdata('notif', $login);
          redirect(site_url('admin/auth/login'),'refresh');
        }

      } else {

        $data['notif'] = $this->M_Auth->notification();
        $this->load->view('admin/auth/login.php', $data);
      }
    } else {
      redirect(site_url('admin/dashboard/index'),'refresh');
    }
  }

  public function register(){
    $sess = $this->M_Auth->session(array('root','admin'));
    if ($sess === FALSE) {
      $data['datatables'] = false;
      $data['icheck']     = true;
      $data['switch']     = false;
      $data['select2']    = false;
      $data['daterange']  = false;
      $data['colorpicker']= false;
      $data['inputmask']  = false;
      $data['dropzonejs'] = false;
      $data['summernote'] = false;
      $data['mode']       = $this->config->item('mode'); // 'username' or 'email'
      $data['swal']       = array(
        'type' => 'button',
        'button'  => 'Login',
        'url' => site_url('admin/auth/login'),
      );
  
      $this->form_validation->set_rules($this->M_Account->rules());
      if ($this->form_validation->run() === TRUE) {
  
        $register = $this->M_Account->insert($this->config->item('mode'));
        if ($register['status'] == 'success') {
          $this->session->set_flashdata('notif', $register);
          redirect(site_url('admin/auth/register'),'refresh');
  
        } else {
          $this->session->set_flashdata('notif', $register);
          redirect(site_url('admin/auth/register'),'refresh');
        }
      } else {
  
        $data['notif'] = $this->M_Auth->notification();
        $this->load->view('admin/auth/register.php', $data);
  
      }
    } else {
      redirect(site_url('admin/dashboard/index'),'refresh');
    }
  }

  public function logout(){
    $this->M_Auth->logout();
    redirect(site_url('admin/auth/login'),'refresh');
  }
}

?>
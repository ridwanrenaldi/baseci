<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  private $sess;

  public function __construct(){
    parent::__construct();
    $this->sess = $this->M_Auth->session(array('root','admin'));
    if ($this->sess === FALSE) {
      redirect(site_url('admin/auth/logout'),'refresh');
    }
	}

  
  // ==============================================
  //               LOAD VIEW
  // ==============================================

  public function index(){
    $data['datatables'] = false;
    $data['icheck']     = true;
    $data['switch']     = false;
    $data['select2']    = false;
    $data['daterange']  = false;
    $data['colorpicker']= false;
    $data['inputmask']  = false;
    $data['dropzonejs'] = false;
    $data['summernote'] = false;
    $data['session']    = $this->sess;
    $data['sidebar']    = 'dashboard';
    $data['layout']     = 'layout-navbar-fixed pace-warning';
    $data['title']      = 'Dashboard';
    $data['swal'] = array(
      'type' => 'default',
      'button'  => NULL,
      'url' => NULL,
    );
    $data['breadcrumb'] = array(
      'Home'  => site_url('admin/dashboard/index'),
      'Dashboard' => site_url('admin/dashboard/index'),
    );

    $this->load->view('admin/dashboard/index.php', $data);
  }

}

?>
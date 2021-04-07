<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
  private $sess;

  public function __construct(){
    parent::__construct();
    $this->sess = $this->M_Auth->session(array('root','admin'));
    if ($this->sess === FALSE) {
      redirect(site_url('admin/auth/logout'),'refresh');
    }
    $this->load->model('M_Account');
	}


  // ==============================================
  //           CALLBACK FORM VALIDATION
  // ==============================================

  public function checkFileImg($value){
    if (!empty($_FILES)) {
			$phpFileUploadErrors = array(
				0 => 'There is no error, the file uploaded with success',
				1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
				2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
				3 => 'The uploaded file was only partially uploaded',
				4 => 'No file was uploaded',
				6 => 'Missing a temporary folder',
				7 => 'Failed to write file to disk.',
				8 => 'A PHP extension stopped the file upload.',
			);
			$typeFileImg = array('image/jpeg','image/png','image/jpeg','image/x-icon');
      $sizeAllowed = 1024000; // 1MB

      if ($_FILES[$value]['error'] == 4) {
        return TRUE;
      } elseif ($_FILES[$value]['error'] == 0) {
        if (in_array($_FILES[$value]['type'], $typeFileImg) == FALSE) {
          $this->form_validation->set_message('checkFileImg', 'The filetype you are attempting to upload is not allowed.');
          return FALSE;
        } elseif($_FILES[$value]['size'] > $sizeAllowed){
          $this->form_validation->set_message('checkFileImg', 'The file you are attempting to upload is larger than the permitted size.');
          return FALSE;
        } else {
          return TRUE;
        }
      } else {
        $this->form_validation->set_message('checkFileImg', $phpFileUploadErrors[$_FILES[$value]['error']]);
        return FALSE;
      }  
		} else {
      return TRUE;
    }
  }

  // ==============================================
  //               LOAD VIEW
  // ==============================================

  public function index(){
    $data['datatables'] = false;
    $data['icheck']     = false;
    $data['switch']     = false;
    $data['delete']     = false;
    $data['select2']    = false;
    $data['daterange']  = false;
    $data['colorpicker']= false;
    $data['inputmask']  = false;
    $data['dropzonejs'] = false;
    $data['summernote'] = false;
    $data['session']    = $this->sess;
    $data['sidebar']    = 'profile';
    $data['layout']     = 'layout-navbar-fixed pace-warning';
    $data['title']      = 'Profile';
    $data['swal'] = array(
      'type' => 'default',
      'button'  => NULL,
      'url' => NULL,
    );
    $data['breadcrumb'] = array(
      'Home'  => site_url('admin/dashboard/index'),
      'Profile' => site_url('admin/profile/index'),
    );

    $data['data'] = $this->M_Account->getById($this->sess['id']);
    $this->load->view('admin/profile/index.php', $data);
  }

  public function edit(){
    $data['data'] = $this->M_Account->getById($this->sess['id']);
    if ($data['data']) {
      $data['datatables'] = false;
      $data['icheck']     = true;
      $data['switch']     = false;
      $data['delete']     = false;
      $data['select2']    = false;
      $data['daterange']  = false;
      $data['colorpicker']= false;
      $data['inputmask']  = false;
      $data['dropzonejs'] = false;
      $data['summernote'] = false;
      $data['session']    = $this->sess;
      $data['sidebar']    = 'account-edit';
      $data['layout']     = 'layout-navbar-fixed  pace-warning';
      $data['title']      = 'Edit Profile';
      $data['card_title'] = 'Form Input';
      $data['mode']       = $this->config->item('mode');
  
  
      $data['swal'] = array(
        'type' => 'default',
        'button'  => NULL,
        'url' => NULL,
      );
      $data['breadcrumb'] = array(
        'Profile' => site_url('admin/profile/index'),
        'Edit'     => site_url('admin/profile/index'),
      );

      $data['id'] = $data['data']['account_id'];
      if (empty($data['data']['account_image'])) {
        $data['data']['account_image'] = 'default.png';
      }
      $this->form_validation->set_rules($this->M_Account->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata('notif', $this->M_Account->update($data['id'], $this->config->item('mode')));
        $this->M_Auth->refreshSession($data['id']);
        redirect(site_url('admin/profile/edit'),'refresh');
  
      } else {
        $data['notif'] = $this->M_Auth->notification();
        $this->load->view('admin/profile/edit.php', $data);
      }
    } else {
      redirect(site_url('admin/profile/index'),'refresh');
    }
  }

}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
  private $sess;

  public function __construct(){
    parent::__construct();
    $this->sess = $this->M_Auth->session(array('root'));
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
    $data['datatables'] = true;
    $data['icheck']     = false;
    $data['switch']     = true;
    $data['select2']    = false;
    $data['daterange']  = false;
    $data['colorpicker']= false;
    $data['inputmask']  = false;
    $data['dropzonejs'] = false;
    $data['summernote'] = false;
    $data['session']    = $this->sess;
    $data['sidebar']    = 'account-index';
    $data['layout']     = 'layout-navbar-fixed  pace-warning';
    $data['title']      = 'Table Account';
    $data['card_title'] = 'Data Account';
    $data['mode'] = $this->config->item('mode');

    $data['swal'] = array(
      'type' => 'delete',
      'button'  => 'Yes, delete it!',
      'url' => NULL,
    );
    $data['breadcrumb'] = array(
      'Account' => site_url('admin/account/index'),
      'Table'   => site_url('admin/account/index'),
    );
    $data['btn_add']    = array(
      'url' => site_url('admin/account/add'),
      'name' => 'Add Account',
    );


    $this->load->view('admin/account/index.php', $data);
  }

  public function add(){
    $data['datatables'] = false;
    $data['icheck']     = false;
    $data['switch']     = false;
    $data['select2']    = false;
    $data['daterange']  = false;
    $data['colorpicker']= false;
    $data['inputmask']  = false;
    $data['dropzonejs'] = false;
    $data['summernote'] = false;
    $data['session']    = $this->sess;
    $data['sidebar']    = 'account-add';
    $data['layout']     = 'layout-navbar-fixed  pace-warning';
    $data['title']      = 'Add Account';
    $data['card_title'] = 'Form Input';
    $data['mode']       = $this->config->item('mode');


    $data['swal'] = array(
      'type' => 'button',
      'button'  => 'Check Data',
      'url' => site_url('admin/account/index'),
    );
    $data['breadcrumb'] = array(
      'Account' => site_url('admin/account/index'),
      'Add'     => site_url('admin/account/index'),
    );

    $this->form_validation->set_rules($this->M_Account->rules());
    if ($this->form_validation->run() === TRUE) {
      $this->session->set_flashdata('notif', $this->M_Account->insert($this->config->item('mode')));
      redirect(site_url('admin/account/add'),'refresh');

    } else {
      $data['notif'] = $this->M_Auth->notification();
      $this->load->view('admin/account/add.php', $data);
    }
  }

  public function edit($id=null){
    if ($id != null) {
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
      $data['sidebar']    = 'account-edit';
      $data['layout']     = 'layout-navbar-fixed  pace-warning';
      $data['title']      = 'Edit Account';
      $data['card_title'] = 'Form Input';
      $data['mode']       = $this->config->item('mode');
  
  
      $data['swal'] = array(
        'type' => 'button',
        'button'  => 'Check Data',
        'url' => site_url('admin/account/index'),
      );
      $data['breadcrumb'] = array(
        'Account' => site_url('admin/account/index'),
        'Add'     => site_url('admin/account/index'),
      );

      
      $data['id']   = $id;
      $data['data'] = $this->M_Account->getById($id);
      if (empty($data['data']['account_image'])) {
        $data['data']['account_image'] = 'default.png';
      }
  
      $this->form_validation->set_rules($this->M_Account->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata('notif', $this->M_Account->update($id, $this->config->item('mode')));
        redirect(site_url('admin/account/edit/'.$id),'refresh');
  
      } else {
        $data['notif'] = $this->M_Auth->notification();
        $this->load->view('admin/account/edit.php', $data);
      }
    } else {
      redirect(site_url('admin/account/index'),'refresh');
    }
  }


  // ==============================================
  //               RETURN JSON ENCODE
  // ==============================================

  public function data(){
    $data = $this->M_Account->getAll();
    echo json_encode($data);
  }

  public function delete($id=null){
    if ($id != null) {
      $response = $this->M_Account->delete($id);
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Data not found!',
      );
    }
    echo json_encode($response);
  }

  public function deleteimg($id=null){
    if ($id != null) {
      $data = $this->M_Account->getById($id);
      $response = delete_file('./uploads/account/'.$data['account_image']);

      if ($this->db->update('account', array('account_image' => 'default.png'))){
        $this->M_Auth->refreshSession($id);
        $response = array(
          'status' => 'success',
          'message' => 'Success delete image',
        );
      } else {
        $response = array(
          'status' => 'error',
          'message' => 'Failed delete image',
        );
      }

    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Data not found!',
      );
    }
    echo json_encode($response);
  }
  
  public function switch(){
    $post = $this->input->post();
    if (isset($post['id']) && isset($post['isactive'])) {
      $isactive = '1';
      if ($post['isactive'] == '1') {
        $isactive = '0';
      }
      
      $account = $this->db->get_where('account', array('account_id' => $post['id']) )->row_array();
      if ($account['account_level'] != 'root') {
        
        $this->db->where('account_id', $post['id']);
        if($this->db->update('account', array('account_isactive'=>$isactive)) ){
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
      } else {
        $response = array(
          'status' => 'error',
          'message' => 'Root user cannot be disabled',
        );
      }
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Data not found!',
      );
    }
    echo json_encode($response);
  }




}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phone extends CI_Controller {
  private $sess;

  public function __construct(){
    parent::__construct();
    $this->sess = $this->M_Auth->session(array('root','admin'));
    if ($this->sess === FALSE) {
      redirect(site_url('admin/auth/logout'),'refresh');
    }
    $this->load->model('M_Phone');
    $this->load->model('M_Category');
	}


  // ==============================================
  //               LOAD VIEW
  // ==============================================

  public function index(){
    $data['datatables'] = true;
    $data['icheck']     = false;
    $data['switch']     = false;
    $data['select2']    = false;
    $data['daterange']  = true;
    $data['colorpicker']= false;
    $data['inputmask']  = false;
    $data['dropzonejs'] = false;
    $data['summernote'] = false;
    $data['session']    = $this->sess;
    $data['sidebar']    = 'phone-index';
    $data['layout']     = 'layout-navbar-fixed  pace-warning';
    $data['title']      = 'Table Phone';
    $data['card_title'] = 'Data Phone';

    $data['swal'] = array(
      'type' => 'delete',
      'button'  => 'Yes, delete it!',
      'url' => NULL,
    );
    $data['breadcrumb'] = array(
      'Phone' => site_url('admin/phone/index'),
      'Table'   => site_url('admin/phone/index'),
    );
    $data['btn_add']    = array(
      'url' => site_url('admin/phone/add'),
      'name' => 'Add Phone',
    );


    $this->load->view('admin/phone/index.php', $data);
  }

  public function add(){
    $data['datatables'] = false;
    $data['icheck']     = false;
    $data['switch']     = false;
    $data['select2']    = true;
    $data['daterange']  = false;
    $data['colorpicker']= false;
    $data['inputmask']  = false;
    $data['dropzonejs'] = false;
    $data['summernote'] = false;
    $data['session']    = $this->sess;
    $data['sidebar']    = 'phone-add';
    $data['layout']     = 'layout-navbar-fixed  pace-warning';
    $data['title']      = 'Add Phone';
    $data['card_title'] = 'Form Input';


    $data['swal'] = array(
      'type' => 'button',
      'button'  => 'Check Data',
      'url' => site_url('admin/phone/index'),
    );
    $data['breadcrumb'] = array(
      'Phone' => site_url('admin/phone/index'),
      'Add'     => site_url('admin/phone/index'),
    );

    $data['category'] = $this->M_Category->getAll();
    $this->form_validation->set_rules($this->M_Phone->rules());
    if ($this->form_validation->run() === TRUE) {
      $this->session->set_flashdata('notif', $this->M_Phone->insert());
      redirect(site_url('admin/phone/add'),'refresh');

    } else {
      $data['notif'] = $this->M_Auth->notification();
      $this->load->view('admin/phone/add.php', $data);
    }
  }

  public function edit($id=null){
    if ($id != null) {
      $data['datatables'] = false;
      $data['icheck']     = false;
      $data['switch']     = false;
      $data['select2']    = true;
      $data['daterange']  = false;
      $data['colorpicker']= false;
      $data['inputmask']  = false;
      $data['dropzonejs'] = false;
      $data['summernote'] = false;
      $data['session']    = $this->sess;
      $data['sidebar']    = 'phone-edit';
      $data['layout']     = 'layout-navbar-fixed  pace-warning';
      $data['title']      = 'Edit Phone';
      $data['card_title'] = 'Form Input';
  
  
      $data['swal'] = array(
        'type' => 'button',
        'button'  => 'Check Data',
        'url' => site_url('admin/phone/index'),
      );
      $data['breadcrumb'] = array(
        'Phone' => site_url('admin/phone/index'),
        'Add'     => site_url('admin/phone/index'),
      );

      
      $data['id']   = $id;
      $data['data'] = $this->M_Phone->getById($id);
      $data['category'] = $this->M_Category->getAll();
      $this->form_validation->set_rules($this->M_Phone->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata('notif', $this->M_Phone->update($id));
        redirect(site_url('admin/phone/edit/'.$id),'refresh');
  
      } else {
        $data['notif'] = $this->M_Auth->notification();
        $this->load->view('admin/phone/edit.php', $data);
      }
    } else {
      redirect(site_url('admin/phone/index'),'refresh');
    }
  }


  // ==============================================
  //               RETURN JSON ENCODE
  // ==============================================

  public function data(){
    $post = $this->input->post();
    if (isset($post['date']) && !empty($post['date'])) {
      $date = explode(' - ', $post['date']);
      $where = 'phone_created >= "'.$date[0].' 00:00:00" and phone_created <= "'.$date[1].' 23:59:59"';
      $response = $this->M_Phone->getAll($where);
    } else {
      $response = $this->M_Phone->getAll();
    }
    echo json_encode($response);
  }

  public function delete($id=null){
    if ($id != null) {
      $response = $this->M_Phone->delete($id);
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
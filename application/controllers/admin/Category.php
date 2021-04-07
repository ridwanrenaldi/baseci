<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
  private $sess;

  public function __construct(){
    parent::__construct();
    $this->sess = $this->M_Auth->session(array('root','admin'));
    if ($this->sess === FALSE) {
      redirect(site_url('admin/auth/logout'),'refresh');
    }
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
    $data['daterange']  = false;
    $data['colorpicker']= false;
    $data['inputmask']  = false;
    $data['dropzonejs'] = false;
    $data['summernote'] = false;
    $data['session']    = $this->sess;
    $data['sidebar']    = 'category-index';
    $data['layout']     = 'layout-navbar-fixed  pace-warning';
    $data['title']      = 'Table Category';
    $data['card_title'] = 'Data Category';

    $data['swal'] = array(
      'type' => 'delete',
      'button'  => 'Yes, delete it!',
      'url' => NULL,
    );
    $data['breadcrumb'] = array(
      'Category' => site_url('admin/category/index'),
      'Table'   => site_url('admin/category/index'),
    );
    $data['btn_add']    = array(
      'url' => site_url('admin/category/add'),
      'name' => 'Add Category',
    );


    $this->load->view('admin/category/index.php', $data);
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
    $data['sidebar']    = 'category-add';
    $data['layout']     = 'layout-navbar-fixed  pace-warning';
    $data['title']      = 'Add Category';
    $data['card_title'] = 'Form Input';


    $data['swal'] = array(
      'type' => 'button',
      'button'  => 'Check Data',
      'url' => site_url('admin/category/index'),
    );
    $data['breadcrumb'] = array(
      'Category' => site_url('admin/category/index'),
      'Add'     => site_url('admin/category/index'),
    );

    $this->form_validation->set_rules($this->M_Category->rules());
    if ($this->form_validation->run() === TRUE) {
      $this->session->set_flashdata('notif', $this->M_Category->insert());
      redirect(site_url('admin/category/add'),'refresh');

    } else {
      $data['notif'] = $this->M_Auth->notification();
      $this->load->view('admin/category/add.php', $data);
    }
  }

  public function edit($id=null){
    if ($id != null) {
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
      $data['sidebar']    = 'category-edit';
      $data['layout']     = 'layout-navbar-fixed  pace-warning';
      $data['title']      = 'Edit Category';
      $data['card_title'] = 'Form Input';
  
  
      $data['swal'] = array(
        'type' => 'button',
        'button'  => 'Check Data',
        'url' => site_url('admin/category/index'),
      );
      $data['breadcrumb'] = array(
        'Category' => site_url('admin/category/index'),
        'Add'     => site_url('admin/category/index'),
      );

      
      $data['id']   = $id;
      $data['data'] = $this->M_Category->getById($id);
  
      $this->form_validation->set_rules($this->M_Category->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata('notif', $this->M_Category->update($id));
        redirect(site_url('admin/category/edit/'.$id),'refresh');
  
      } else {
        $data['notif'] = $this->M_Auth->notification();
        $this->load->view('admin/category/edit.php', $data);
      }
    } else {
      redirect(site_url('admin/category/index'),'refresh');
    }
  }


  // ==============================================
  //               RETURN JSON ENCODE
  // ==============================================

  public function data(){
    $data = $this->M_Category->getAll();
    echo json_encode($data);
  }

  public function delete($id=null){
    if ($id != null) {
      $response = $this->M_Category->delete($id);
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
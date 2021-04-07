<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Category extends CI_Model {
  private $table = 'category';
  private $primary = 'category_id';
  
  public function __construct(){
      parent::__construct();
  }

  public function rules() {
    return array(
      array(  'field' => '_name_',
              'label' => 'Name',
              'rules' => 'required|trim|alpha_numeric_spaces|max_length[250]'),

      array(  'field' => '_description_',
              'label' => 'Description',
              'rules' => 'required|trim|alpha_numeric_spaces|max_length[250]'),
    );
  
  }

  public function getById($id){
    return $this->db->get_where($this->table, array($this->primary => $id) )->row_array();
  }

  public function getAll() {
    return $this->db->get($this->table)->result_array();
  }

  public function insert(){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        'category_id'           => NULL,
        'category_name'         => htmlspecialchars($post['_name_']),
        'category_description'  => htmlspecialchars($post['_description_']),
      );

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
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Data not found!',
      );
    }
    return $response;
  }

  public function update($id){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        'category_name'         => htmlspecialchars($post['_name_']),
        'category_description'  => htmlspecialchars($post['_description_']),
      );

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
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Data not found!',
      );
    }
    return $response;
  }

  public function delete($id){
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

    return $response;
  }

}
?>
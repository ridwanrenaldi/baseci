<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Phone extends CI_Model {
  private $table = 'phone';
  private $primary = 'phone_id';
  
  public function __construct(){
      parent::__construct();
  }

  public function rules() {
    return array(
      array(  'field' => '_category_',
              'label' => 'Category',
              'rules' => 'required|trim|numeric|max_length[11]'),

      array(  'field' => '_number_',
              'label' => 'Number',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[10]|max_length[15]'),
      );
  
  }

  public function getById($id){
    return $this->db->get_where($this->table, array($this->primary => $id) )->row_array();
  }

  public function getAll($where = null) {
    $this->db->from('phone, category');
    $this->db->where('phone.category_id = category.category_id');
    if ($where != null) {
      $this->db->where($where);
    }
    $this->db->order_by('phone_created', 'DESC');
    return $this->db->get()->result_array();
  }

  public function insert(){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        'phone_id'        => NULL,
        'category_id'     => htmlspecialchars($post['_category_']),
        'phone_number'    => htmlspecialchars($post['_number_']),
        'phone_created'   => date('Y-m-d H:i:s'),
        'phone_modified'  => date('Y-m-d H:i:s'),
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
        'category_id'     => htmlspecialchars($post['_category_']),
        'phone_number'    => htmlspecialchars($post['_number_']),
        'phone_created'   => date('Y-m-d H:i:s'),
        'phone_modified'  => date('Y-m-d H:i:s'),
      );

      $data = $this->security->xss_clean($data);
      $this->db->where($this->primary, $id);
      if($this->db->update($this->table, $data)){
        $response = array(
          "status" => "success",
          "message" => "Success update data",
        );
      } else {
        $response = array(
          "status" => "error",
          "message" => "Failed update data",
        );
      }
    } else {
      $response = array(
        "status" => "error",
        "message" => "Data not found!",
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
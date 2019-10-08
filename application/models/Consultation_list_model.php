<?php
class Consultation_list_model extends CI_Model {
  public function __construct(){
  }

  public function get_item_from_id($id){
    $this->db->select('*');
    $this->db->from('consultation_main');
    $this->db->join('topics', 'consultation_main.topic_id=topics.topic_id');
    $this->db->where('consultation_id', $id);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_num(){
    $this->db->select('*');
    $this->db->from('consultation_main');
    $result = $this->db->get();
    return count($result->result());
  }
}

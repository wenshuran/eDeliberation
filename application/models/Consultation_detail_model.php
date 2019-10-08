<?php
class Consultation_detail_model extends CI_Model {
  public function __construct(){
  }

  public function get_item_from_id($id){
    $this->db->select('*');
    $this->db->from('consultation_main');
    $this->db->join('topics', 'consultation_main.topic_id=topics.topic_id');
    $this->db->join('consultation_detail', 'consultation_main.consultation_id=consultation_detail.consultation_id');
    $this->db->where('consultation_main.consultation_id', $id);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_links($nums){
    $num = preg_split('/[;]+/s', $nums);
    $cnt = count($num);
    if($cnt > 0){
      $this->db->select('*');
      $this->db->from('links');
      $this->db->where('link_id', $num[0]);
      for($i = 1; $i < $cnt; $i++){
        $this->db->or_where('link_id', $num[$i]);
      }
      $query = $this->db->get();
      $row = $query->result_array();
      $query->free_result();
      return $row;
    }
  }

  public function get_summary($c_id){
    $this->db->select('summary');
    $this->db->from('summary');
    $this->db->where('consultation_id', $c_id);
    $this->db->where('thread_id', 0);
    $result = $this->db->get();
    return $result->result_array();
  }

}

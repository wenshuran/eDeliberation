<?php

class Public_consultation_model extends CI_Model
{
  public function __construct()
  {
  }

  public function get_title($c_id)
  {
    $this->db->select('title');
    $this->db->from('consultation_main');
    $this->db->where('consultation_id', $c_id);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_sentiment($c_id)
  {
    $this->db->select('sum(sentiment) as num');
    $this->db->from('sentiment');
    $this->db->where('consultation_id', $c_id);
    $this->db->where('thread_id', 0);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_summary($c_id){
    $this->db->select('summary');
    $this->db->from('summary');
    $this->db->where('consultation_id', $c_id);
    $this->db->where('thread_id', 0);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_threads($id)
  {
    $this->db->distinct();
    $this->db->select('threads_id');
    $this->db->from('consultation_detail');
    $this->db->where('consultation_id', $id);
    $query = $this->db->get();
    $row = $query->result_array();
    $query->free_result();
    return $row;
  }

  public function get_thread($nums){
    $num = preg_split('/[;]+/s', $nums[0]["threads_id"]);
    $cnt = count($num);
    if($cnt > 0){
      $this->db->select('*');
      $this->db->from('threads');
      $this->db->where('thread_id', $num[0]);
      for($i = 1; $i < $cnt; $i++){
        $this->db->or_where('thread_id', $num[$i]);
      }
      $query = $this->db->get();
      $row = $query->result_array();
      $query->free_result();
      return $row;
    }
  }

  public function get_recent_comments(){
    $this->db->select('comments.*,threads.thread');
    $this->db->from('comments');
    $this->db->join('threads', 'comments.thread_id=threads.thread_id');
    $this->db->where('comments.parent_id', 0);
    $this->db->order_by('date_time', 'desc');
    $this->db->limit(5);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_comments($thread){
    $this->db->select('comments.*,threads.thread');
    $this->db->from('comments');
    $this->db->join('threads', 'comments.thread_id=threads.thread_id');
    $this->db->where('comments.parent_id', 0);
    $this->db->where('threads.thread', $thread);
    $this->db->order_by('date_time', 'desc');
    $this->db->limit(5);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_num($thread){
    $this->db->select('count(*) as num');
    $this->db->from('comments');
    $this->db->join('threads', 'comments.thread_id=threads.thread_id');
    $this->db->where('comments.parent_id', 0);
    $this->db->where('threads.thread', $thread);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_reply_num($comment_id){
    $this->db->select('count(*) as num');
    $this->db->from('comments');
    $this->db->where('parent_id', $comment_id);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_reply($comment_id){
    $this->db->select('comment_id, user, comments.date_time, comments.text');
    $this->db->from('comments');
    $this->db->where('parent_id', $comment_id);
    $result = $this->db->get();
    return $result->result_array();
  }

//  public function get_user_id($user){
//    $this->db->select('user_id');
//    $this->db->from('users');
//    $this->db->where('user', $user);
//    $result = $this->db->get();
//    $row = $result->result_array();
//    return $row[0]['user_id'];
//  }

  public function add_sentiment($c_id, $thread_id, $user, $comment_id){
    $this->db->select('*');
    $this->db->from('sentiment');
    $this->db->where('consultation_id', $c_id);
    $this->db->where('thread_id', $thread_id);
    $this->db->where('user', $user);
    $this->db->where('comment_id', $comment_id);
    $result = $this->db->get();
    if (count($result->result_array())==0){
      $data=array(
        'consultation_id'=>$c_id,
        'thread_id'=>$thread_id,
        'user'=>$user,
        'comment_id'=>$comment_id,
        'sentiment'=>1
      );
      $this->db->insert('sentiment', $data);
      echo 'insert';
    }
    else{
      $this->db->where('consultation_id', $c_id);
      $this->db->where('thread_id', $thread_id);
      $this->db->where('user', $user);
      $this->db->where('comment_id', $comment_id);
      $this->db->delete('sentiment');
      echo 'delete';
    }
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
}

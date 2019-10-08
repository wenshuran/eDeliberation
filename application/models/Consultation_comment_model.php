<?php

class Consultation_comment_model extends CI_Model
{
  public function __construct()
  {
  }

  public function get_sentiment($c_id, $thread)
  {
    $this->db->select('sum(sentiment) as num');
    $this->db->from('sentiment');
    $this->db->where('consultation_id', $c_id);
    $this->db->where('thread_id', $thread);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_summary($c_id, $thread){
    $this->db->select('summary');
    $this->db->from('summary');
    $this->db->where('consultation_id', $c_id);
    $this->db->where('thread_id', $thread);
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

  public function get_descendant($consultation_id, $thread, $ancestor_id){
    $this->db->select('comments.*,threads.thread');
    $this->db->from('comments');
    $this->db->join('threads', 'comments.thread_id=threads.thread_id');
    $this->db->where('comments.consultation_id', $consultation_id);
    $this->db->where('threads.thread', $thread);
    $this->db->where('ancestor_id', $ancestor_id);
    $this->db->order_by('date_time', 'desc');
    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_parents($comment_id){
    $this->db->select('b.user, b.comment_id');
    $this->db->from('comments as a');
    $this->db->join('comments as b', 'a.parent_id=b.comment_id');
    $this->db->where('a.comment_id', $comment_id);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function judge_ancestor($comment_id){
    $this->db->select('parent_id');
    $this->db->from('comments');
    $this->db->where('comment_id', $comment_id);
    $result = $this->db->get();
    $array = $result->result_array();
    if($array[0]['parent_id']==0)
      return true;
    else
      return false;
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
    $this->db->order_by('date_time', 'desc');
    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_thread_id($thread){
    $this->db->select('thread_id');
    $this->db->from('threads');
    $this->db->where('thread', $thread);
    $result = $this->db->get();
    $row = $result->result_array();
    return $row[0]['thread_id'];
  }
//
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

  public function add_comment($c_id, $thread_id, $user, $date_time, $comment){
      $comment_id = $this->db->count_all('comments')+1;
      $data=array(
        'consultation_id'=>$c_id,
        'thread_id'=>$thread_id,
        'comment_id'=>$comment_id,
        'parent_id'=>'0',
        'ancestor_id'=>'0',
        'user'=>$user,
        'date_time'=>$date_time,
        'text'=>$comment
      );
    $this->db->insert('comments', $data);
    if ($comment_id == $this->db->count_all('comments'))	{
      return true;
    } else {
      return false;
    }
  }

  public function add_reply($c_id, $thread_id, $parent_id, $user, $date_time, $comment){
    $comment_id = $this->db->count_all('comments')+1;
    $ancestor_id=$this->get_ancestor($parent_id);
    $data=array(
      'consultation_id'=>$c_id,
      'thread_id'=>$thread_id,
      'comment_id'=>$comment_id,
      'parent_id'=>$parent_id,
      'ancestor_id'=>$ancestor_id,
      'user'=>$user,
      'date_time'=>$date_time,
      'text'=>$comment
    );
    $this->db->insert('comments', $data);
    if ($comment_id == $this->db->count_all('comments'))	{
      return true;
    } else {
      return false;
    }
  }

  public function get_ancestor($comment_id){
    $this->db->select('parent_id');
    $this->db->from('comments');
    $this->db->where('comment_id', $comment_id);
    $result = $this->db->get();
    $row = $result->result_array();
    $ancestor = $row[0]['parent_id'];
    while ($ancestor!=0){
      $comment_id = $ancestor;
      $this->db->select('parent_id');
      $this->db->from('comments');
      $this->db->where('comment_id', $comment_id);
      $result = $this->db->get();
      $row = $result->result_array();
      $ancestor = $row[0]['parent_id'];
    }
    return $comment_id;
  }

}

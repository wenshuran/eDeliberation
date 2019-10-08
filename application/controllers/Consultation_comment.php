<?php
class Consultation_comment extends CI_Controller
{
  public $header;
  public $data;
  public $footer;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('consultation_comment_model');
    $this->load->model('consultation_detail_model');
    $this->load->helper('url_helper');
    $this->load->library('session');
  }

  public function index($page = 'forth')
  {
    $this->header['controller'] = 'consultation_comment';
    $this->header['thread'] = $this->input->get('thread');
    $this->header['c_id'] = $this->input->get('c_id');
    $this->data['thread'] = $this->input->get('thread');
    //unset($_SESSION['username']);  //before debug
    $this->data['isLogin'] = (isset($_SESSION['username'])) ? true :false;
    $this->footer['isLogin'] = (isset($_SESSION['username'])) ? true :false;
    $this->footer['thread_id'] = $this->consultation_comment_model->get_thread_id($this->header['thread']);
    $this->footer['c_id'] = $this->header['c_id'];
    $this->get_content();
    $this->load->view('header', $this->header);
    $this->load->view('forth_page/content', $this->data);
    $this->load->view('forth_page/footer', $this->footer);
  }

  private function get_summary($str){
    $rule = "/\"summary\"\: \"[ -~]+\", \"status/";
    preg_match($rule, $str, $data);
    $qian=array("\\t","\\n","\\r");
    return str_replace($qian, ' ', substr($data[0], 12, strlen($data[0])-22));
  }

  private function get_content()
  {
    $row = $this->consultation_detail_model->get_item_from_id($this->header['c_id']);
    $links = $this->consultation_detail_model->get_links($row[0]['link_id']);
    $url = "http://edeliberation-api.adaptcentre.ie/summarise/url/".$links[0]['link'];
    $content = file_get_contents($url);
    $this->data['summary'] = $this->get_summary($content);
    $this->get_comments();
  }

  private function get_comments(){
    $this->data['comments'] = $this->consultation_comment_model->get_descendant($this->header['c_id'], $this->data['thread'], 0);
    $this->data['num'] = $this->consultation_comment_model->get_num($this->data['thread']);
    foreach ($this->data['comments'] as $list){
      $this->data['replies'][$list['comment_id']]['num'] = $this->consultation_comment_model->get_reply_num($list['comment_id']);
      $this->data['replies'][$list['comment_id']]['replies']= $this->consultation_comment_model->get_descendant($this->header['c_id'], $this->data['thread'], $list['comment_id']);
      $this->data['isAncestor'][$list['comment_id']] = $this->consultation_comment_model->judge_ancestor($list['comment_id']);
    }

    foreach ($this->data['replies'] as $reply){
      foreach ($reply['replies'] as $reply1){
        $this->data['reply_parents'][$reply1['comment_id']] = $this->consultation_comment_model->get_parents($reply1['comment_id']);
        $this->data['isAncestor'][$reply1['comment_id']] = $this->consultation_comment_model->judge_ancestor($reply1['comment_id']);
      }
    }
  }

  public function add_comment(){
    $comment = $this->input->get_post('comment');
    $datestring = 'Y-m-d h:m:s';
    $date_time =  date($datestring, time());
    if (!isset($_SESSION['username'])){
      $user = $this->input->get_post('name');
      $this->session->set_userdata('username', $user);
      $this->data['isLogin'] = true;
      $this->footer['isLogin'] = true;
    }
    else{
      $user = $_SESSION['username'];
    }

    $c_id = $this->input->get_post('c_id');
    $thread_id = $this->input->get_post('thread_id');
    $msg = $this->consultation_comment_model->add_comment($c_id, $thread_id, $user, $date_time, $comment);
  }

  public function add_reply(){
    $comment = $this->input->get_post('comment');
    $datestring = 'Y-m-d h:m:s';
    $date_time =  date($datestring, time());
    if (!isset($_SESSION['username'])){
      $user = $this->input->get_post('name');
      $this->session->set_userdata('username', $user);
      $this->data['isLogin'] = true;
      $this->footer['isLogin'] = true;
    }
    else{
      $user = $_SESSION['username'];
    }
    $c_id = $this->input->get_post('c_id');
    $thread_id = $this->input->get_post('thread_id');
    $parent_id = $this->input->get_post('parent_id');
    $msd = $this->consultation_comment_model->add_reply($c_id, $thread_id, $parent_id, $user, $date_time, $comment);
  }
}

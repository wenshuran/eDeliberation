<?php
class Public_consultation extends CI_Controller
{
  public $data;
  public $header;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('public_consultation_model');
    $this->load->model('consultation_detail_model');
    $this->load->helper('url_helper');
    $this->load->library('session');
  }

  public function index($page = 'third')
  {
    $this->header['controller'] = 'public_consultation';
    $this->header['c_id'] = $this->input->get('c_id');;
    $this->data['consultation_id'] = $this->input->get('c_id');
    $this->get_content();
    $this->load->view('header', $this->header);
    $this->load->view('third_page/content', $this->data);
    $this->load->view('third_page/footer', $this->header);
  }

  private function get_summary($str){
    $rule = "/\"summary\"\: \"[ -~]+\", \"status/";
    preg_match($rule, $str, $data);
    $qian=array("\\t","\\n","\\r");
    return str_replace($qian, ' ', substr($data[0], 12, strlen($data[0])-22));
  }

  private function get_support_rate($str){
    $rule = "/\"sentiment\"\: \"[0-9|.]+\", \"confidence/";
    preg_match($rule, $str, $data);
    return strval(100*floatval(substr($data[0], 14, strlen($data[0])-41)));
  }

  private function get_sentiment($str){
    $rule = "/\"sentiment-simp\"\: \"[a-z]+\"/";
    preg_match($rule, $str, $data);
    return strval(substr($data[0], 19, strlen($data[0])-20));
  }

  private function get_content()
  {
    $title = $this->public_consultation_model->get_title($this->header['c_id']);
    $title = rawurlencode($title[0]['title']);
    $sentiment = file_get_contents("http://edeliberation-api.adaptcentre.ie/sentiment/txt/".$title);
//    var_dump($this->get_sentiment($sentiment));
    $this->data['sentiment']['sentiment'] = $this->get_sentiment($sentiment);
    $this->data['sentiment']['support_rate'] = $this->get_support_rate($sentiment)."%";
    $row = $this->consultation_detail_model->get_item_from_id($this->header['c_id']);
    $links = $this->consultation_detail_model->get_links($row[0]['link_id']);
    $url = "http://edeliberation-api.adaptcentre.ie/summarise/url/".$links[0]['link'];
    $content = file_get_contents($url);
    $this->data['summary'] = $this->get_summary($content);
    $threads = $this->public_consultation_model->get_threads($this->data['consultation_id']);
    $this->data['threads'] = $this->public_consultation_model->get_thread($threads);
    $this->get_recent();
    $this->get_comments();
  }

  private function get_recent(){
    $this->data['recent_comments'] = $this->public_consultation_model->get_recent_comments();
    foreach ($this->data['recent_comments'] as $recent){
      $this->data['replies']['recent'][$recent['comment_id']]['num'] = $this->public_consultation_model->get_reply_num($recent['comment_id']);
      $this->data['replies']['recent'][$recent['comment_id']]['replies'] = $this->public_consultation_model->get_reply($recent['comment_id']);
    }
  }

  private function get_comments(){
    foreach ($this->data['threads'] as $thread){
      $this->data['comments'][$thread['thread']] = $this->public_consultation_model->get_comments($thread['thread']);
      $this->data['num'][$thread['thread']] = $this->public_consultation_model->get_num($thread['thread']);
      foreach ($this->data['comments'][$thread['thread']] as $list){
        $this->data['replies'][$thread['thread']][$list['comment_id']]['num'] = $this->public_consultation_model->get_reply_num($list['comment_id']);
        $this->data['replies'][$thread['thread']][$list['comment_id']]['replies']= $this->public_consultation_model->get_reply($list['comment_id']);
      }
    }
  }
}

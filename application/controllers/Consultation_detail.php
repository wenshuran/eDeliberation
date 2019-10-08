<?php
class Consultation_detail extends CI_Controller
{
  public $data;
  public $footer;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('consultation_detail_model');
    $this->load->helper('url_helper');
    $this->load->library('session');
  }

  public function index($page = 'second')
  {
    $this->data['consultation_id'] = $this->input->get('c_id');
    $header['c_id'] = $this->data['consultation_id'];
    $header['controller'] = 'consultation_detail';
    $this->footer['c_id'] = $this->data['consultation_id'];
    $this->footer['isLogin'] = isset($_SESSION['username']);
    $this->get_detail();
    $this->load->view('header', $header);
    $this->load->view('second_page/content', $this->data);
    $this->load->view('second_page/footer', $this->footer);
  }

  private function get_summary($str){
    $rule = "/\"summary\"\: \"[ -~]+\", \"status/";
    preg_match($rule, $str, $data);
    $qian=array("\\t","\\n","\\r");
    return str_replace($qian, ' ', substr($data[0], 12, strlen($data[0])-22));
  }

  private function get_detail()
  {
    $row = $this->consultation_detail_model->get_item_from_id($this->data['consultation_id']);
    $this->data['open_date'] = $row[0]['open_date'];
    $this->data['close_date'] = $row[0]['close_date'];
    $this->data['topic'] = $row[0]['topic'];
//    $summary = $this->consultation_detail_model->get_summary($this->data['consultation_id']);
    $this->data['links'] = $this->consultation_detail_model->get_links($row[0]['link_id']);
    $url = "http://edeliberation-api.adaptcentre.ie/summarise/url/".$this->data['links'][0]['link'];
    $content = file_get_contents($url);
    $this->data['summary'] = $this->get_summary($content);
    $this->data['target'] = $row[0]['target_audience'];
    $this->data['reason'] = $row[0]['reasons'];
    $this->data['address'] = $row[0]['address'];
    $this->data['email'] = $row[0]['email'];
  }

  public function login() {
    $username = $this->input->get_post('username');
    $this->session->set_userdata('username', $username);
  }
}

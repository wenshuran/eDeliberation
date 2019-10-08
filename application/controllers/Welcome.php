<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
  private $list_max_num = 2;
  private $page = 1;
  public $data;
  public function __construct(){
    parent::__construct();
    $this->load->model('consultation_list_model');
    $this->load->helper('url_helper');
    $this->load->helper('url');
  }

  public function index($page = 'home'){
    $this->get_lists();
    $header['controller'] = 'welcome';
    $this->load->view('header', $header);
    $this->load->view('main_page/content', $this->data);
    $this->load->view('main_page/footer');
  }

  private function judge_status($num){
    if($num == 1)
      return "OPENED";
    elseif ($num == 0)
      return "CLOSED";
    else
      die("status error");
  }

  private function get_page_num($result_num, $list_max_num){
    if ($result_num%$list_max_num == 0)
      return $result_num/$list_max_num;
    else
      return floor($result_num/$list_max_num)+1;
  }

  private function get_page_nav(){
    $this->load->library('pagination');

    $config['base_url'] = '/edeliberation/index.php';
    $config['total_rows'] = $this->data['result_num'];
    $config['per_page'] = $this->list_max_num;
    $config['page_query_string'] = TRUE;
    $config['page_query_string'] = TRUE;
    $config['query_string_segment'] = 'page';

    $this->pagination->initialize($config);
    return $this->pagination->create_links();
  }

  public function test(){
    var_dump($this->consultation_list_model->get_item_from_id(1));

  }
  private function get_page(){
    $r = substr($_SERVER['QUERY_STRING'],5);
    if ($r!=null) return $r;else return'';
  }

  private function get_lists(){
    $page = $this->get_page();
    $this->page = ($page == '') ? 1 : $page;
    $page_id_min = $this->list_max_num*($this->page-1)+1;
    $page_id_max = $this->page*$this->list_max_num;
    $result_num = $this->consultation_list_model->get_num() ;
    $page_num = $this->get_page_num($result_num, $this->list_max_num);
    $this->data['list_max_num'] = $this->list_max_num;
    $this->data['page_id_min'] = $page_id_min;
    $this->data['page_id_max'] = $page_id_max;
    $this->data['result_num'] = $result_num;
    $this->data['page_num'] = $page_num;
    $this->data['page'] = $this->page;
    $this->data['page_nav'] = $this->get_page_nav();
    if ($result_num > 0) {
      // 输出数据
      for($id=$page_id_min; $id<=$page_id_max; $id++){
        $row = $this->consultation_list_model->get_item_from_id($id);
        $this->data[$id]['id'] = $id;
        $this->data[$id]['status'] = $this->judge_status($row[0]['status']);
        $this->data[$id]['title'] = $row[0]['title'];
        $this->data[$id]['topic'] = $row[0]['topic'];
        $this->data[$id]['open_date'] = $row[0]['open_date'];
        $this->data[$id]['close_date'] = $row[0]['close_date'];
      }
    } else {
      echo "No database";
    }
  }
}

<?php 
/**
* 前台
*/
class Maystudio extends CI_Controller
{
        function __construct()
        {
                parent::__construct();
                $this->load->helper('url');
                //$this->load->model('studio_model');
        }
        //首页
        public function index()
        {
                $data['css']=array('index','style');
                $this->load->view('header',$data);
                $this->load->view('index');
                $this->load->view('footer');
        }
        //关于我们
        public function about()
        {
                $this->load->view('header');
                $this->load->view('about');
                $this->load->view('footer');
        }
        //联系我们
        public function contact_info()
        {
                $this->load->view('header');
                $this->load->view('contact_info');
                $this->load->view('footer');
        }
}
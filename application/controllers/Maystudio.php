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
        //关于我们／联系方式
        public function about()
        {
				$data['css']=array('stories','style');
                $this->load->view('header',$data);
                $this->load->view('about');
                $this->load->view('footer');
        }
		//漫画
		public function stories()
        {
				$data['css']=array('stories','style');
                $this->load->view('header',$data);
                $this->load->view('stories');
                $this->load->view('footer');
        }
		//留言版
		public function msgboard()
        {
				$data['css']=array('msgboard','style');
                $this->load->view('header',$data);
                $this->load->view('msgboard');
                $this->load->view('footer');
        }
		//注册
		public function signup()
        {
				$data['css']=array('signup','style');
                $this->load->view('header',$data);
                $this->load->view('signup');
                $this->load->view('footer');
        }
		//
		public function episode()
        {
				$data['css']=array('episode','style');
                $this->load->view('header',$data);
                $this->load->view('episode');
                $this->load->view('footer');
        }
}
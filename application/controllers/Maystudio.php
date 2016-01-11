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

        public function index()
        {
                $this->load->view('header');
                $this->load->view('index');
                $this->load->view('footer');
        }

        public function about()
        {
                $this->load->view('header');
                $this->load->view('about');
                $this->load->view('footer');
        }

        public function contact_info()
        {
                $this->load->view('header');
                $this->load->view('contact_info');
                $this->load->view('footer');
        }
}
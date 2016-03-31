<?php  
class Msgboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$helper=array('form','url');
		$this->load->helper($helper);
		$library=array('session');
		$this->load->library($library);
	}

	//留言版
            	public function index()
            	{
            		$data['css']=array('msgboard','style');
	              $data['js']=array('msg-reply','msgtext');
	              $this->load->view('header',$data);
	              $this->load->view('msgboard');
	              $this->load->view('footer');
            	}

            	public function getSession()
            	{
            		if($this->session->id)
            		{
            			echo 1;
            		}
            		else
            		{
            			echo 0;
            		}
            	}

            	public function insert()
            	{

            	}
}
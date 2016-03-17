<?php  
/**
 * 后台控制器
 */
class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
	}

	function index()
	{
		$this->load->view('admin');
	}

	public function upload()
	{
		$config['upload_path']='../images/';
		$config['allowed_types']='jpg';

		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('cartoon_pic'))
		{
			$error=array('error'=>$this->upload->display_errors());

			$this->load->view('admin',$error);
		}
		else
		{
			$this->load->view('admin');
		}
	}
}
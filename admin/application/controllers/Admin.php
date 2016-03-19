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
		$this->load->model('story_model');
	}

	function index()
	{
		$data['stories']=$this->story_model->get_AllStories();
		$this->load->view('admin',$data);
	}

	/**
	 * upload picture
	 */
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

	public function delete($story_id)
	{
		$result=$this->story_model->delete_storyByID($story_id);
	}
}
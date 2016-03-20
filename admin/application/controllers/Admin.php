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

	function index($error="")
	{
		$data['error']=$error;
		$data['stories']=$this->story_model->get_AllStories();
		$this->load->view('admin',$data);
	}

	/**
	 * upload picture
	 */
	public function upload()
	{
		$data['title']=$_POST['sto_title'];
		$data['author']=1;
		$picture=$_FILES['cartoon_pic']['name'];
		$data['picture']=preg_replace("/.jpg$/", "",$picture);
		$config['upload_path']='../images/stories/';
		$config['allowed_types']='jpg';

		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('cartoon_pic'))
		{
			$error=$this->upload->display_errors();
		}
		else
		{
			$result=$this->story_model->insert_story($data);
			if(!$result)
			{
				$error="insert abortively";
			}
			else
			{
				$error="success";
			}
			
		}
		redirect("admin/index/$error");
	}

	/**
	 * delete story
	 */
	public function delete($story_id)
	{
		$result=$this->story_model->delete_storyByID($story_id);
		if(!$result)
		{
			$error="delete false";
		}
		else
		{
			$error="delete success";
		}
		redirect("admin/index/$error");
	}
}
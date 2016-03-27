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
		$this->load->model(array('story_model','user'));
		$this->load->library('pagination');
	}

	function index($error="")
	{
		$data['error']=$error;
		$data['stories']=$this->stories();
		$data['users']=$this->users();
		$this->load->view('admin',$data);
	}

	/**
	 * get story data
	 * @return array([0]=>{},[1]=>{},...)
	 */
	public function stories()
	{
		//configurate pagination class
		$config['base_url']=base_url()."index.php/admin/index";
		$config['total_rows']=$this->story_model->count_rows('stories');
		$config['per_page']=5;
		$this->pagination->initialize($config);
		//get offset
		$offset=$this->uri->segment(3);
		//get data
		$result=$this->story_model->get_num_rows('stories',$config['per_page'],$offset);
		return $result;
	}

	/**
	 * get users 
	 */
	public function users()
	{
		$result=$this->user->get_AllUsers();
		return $result;
	}

	public function delete_user($id)
	{
		$result=$this->user->delete_userById($id);
		if($result)
		{
			$error="delete successfully";
		}
		else
		{
			$error="delete abortively";
		}
		redirect("admin/index");
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
		redirect("admin/index");
	}

	/**
	 * delete story through story id
	 */
	public function delete($story_id)
	{
		$is_delete=$this->delete_picture($story_id);
		if($is_delete)
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
		}
		else
		{
			$error="delete picture false";
		}
		redirect("admin/index");
	}

	/**
	 * delete picture 
	 */
	public function delete_picture($story_id)
	{
		$story=$this->story_model->get_storyById($story_id);
		$picture=$story['picture'].".jpg";

		$result=unlink("../images/stories/$picture");
		return $picture;
	}
}
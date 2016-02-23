<?php  
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->model('login_model');
	}

	 //注册
        	public function signup()
        	{
              	$data['css']=array('signup','style');
              	$data['js']=array('jquery','jquery.validate','signup-validate');
              	$this->load->view('header',$data);
              	$this->load->view('signup');
              	$this->load->view('footer');
        	}

	/**
	 * 注册数据检查
	 * 
	 */
	public function signup_check()
	{
		$data=$_POST;
		$result=$this->login_model->get_user($data['signup_username']);
		//验证用户名是否存在
		if(!empty($result))
		{
			$message['error']="用户名已存在";
			$data['css']=array('signup','style');
			$this->load->view('header',$data);
			$this->load->view('signup',$message);
			$this->load->view('footer');
		}
		else
		{
			$data['signup_password']=md5($data['signup_password']);
			$insert_data=array(
				'username'=>$data['signup_username'],
				'password' =>$data['signup_password'],
				'email'        =>$data['signup_email']);
			$result=$this->login_model->insert_user($insert_data);
			if($result)
			{
				$message['error']="注册成功";
				$data['css']=array('signup','style');
				$this->load->view('header',$data);
				$this->load->view('signup',$message);
				$this->load->view('footer');
			}
			else
			{
				$message['error']='注册失败，数据库操作失败';
				$data['css']=array('signup','style');
				$this->load->view('header',$data);
				$this->load->view('signup',$message);
				$this->load->view('footer');
			}
		}		
	}
}
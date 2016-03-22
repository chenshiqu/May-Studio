<?php  
/**
 * 登入注册类
 */
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

	/** 
	 * 用户名异步验证
	 * @return 0表示用户不存在 1表示存在
	 */
	public function check_username()
	{
		$message=1;
		$username=$_POST['username'];
		$user=$this->login_model->get_user($username);
		if(empty($user))
		{
			$message=0;
		}
		else
		{
			$message=1;
		}
		echo $message;
	}

	/**
	 * 异步登陆检查 
	 * @return 0 用户名不存在 1 密码错误 2 登陆成功
	 */
	public function signin()
	{
		$data=$_POST;
		$username=$data['username'];
		$user=$this->login_model->get_user($username);

		if(!empty($user))
		{
			if(md5($data['password'])==$user['password'])
			{
				$session_data=array(
						'id'=>$user['id'],
						'username'=>$user['username'],
						'email'=>$user['email']);
				$this->session->set_userdata($session_data);
				echo 2;
			}
			else
			{
				echo 1;
			}
		}
		else
		{
			echo 0;
		}
	}

	public function signout()
	{
		unset($_SESSION['id']);
		unset($_SESSION['username']);
		unset($_SESSION['email']);
		session_destroy();
		$data['css']=array('index','style');
                	$this->load->view('header',$data);
                	$this->load->view('index');
                	$this->load->view('footer');
	}

	 //注册
        	public function signup()
        	{
              	$data['css']=array('signup','style');
              	$data['js']=array('signup-validate');
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
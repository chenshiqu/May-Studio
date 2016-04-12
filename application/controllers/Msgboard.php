<?php  
/**
 * @author chenshiqu
 * msg page
 */
class Msgboard extends CI_Controller
{
            function __construct()
            {
	parent::__construct();
	$helper=array('form','url');
	$this->load->helper($helper);
	$library=array('session');
	$this->load->library($library);
	$this->load->model('msg_model');
            }

	//留言版
            public function index()
            {
                        $data['js']=array('msg-reply','msgtext');
	              $this->load->view('header',$data);
	              $this->load->view('msgboard');
	              $this->load->view('footer');
            }

            /**
            * verify if the user has logined 
            * @return 0 represent the user do not login
            * 	      1 represent the user has logined 
            */
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


            /**
             * update msg
             */
            public function insert()
            {
                        $data['user_id']=$this->session->id;
                        $data['content']=$_POST['msg_comment'];
                        $query=$this->msg_model->insert($data);
                        if($query)
                        {
                                    redirect("msgboard/index");
                        }      
                        else
                        {
                                    $this->load->view("test",$data);
                        }    
            }
}
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
                     $model=array('msg_model','login_model');
	              $this->load->model($model);
              }

	//留言版


            	public function index()
            	{
                            $data['js']=array('msg-reply','msgtext');
                            $data['current']="msgboard";
                            $data['mood']=$this->show_mood();
                            $data['descendant']=$this->get_descendant($data['mood']);
                            // $this->load->view('test',$data);
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

                /**
                 * 
                 */
              public function reply()
              {
                            $data['user_id']=$this->session->id;
                            $content=$_POST['text'];

                            //delete the string front the colon
                            $position=stripos($content,":");
                            if($position)
                            {
                                        $content=substr($content, $position+1);
                            }

                            $data['content']=$content;
                            $data['parent_id']=$_POST['parent_id'];
                            $this->msg_model->insert($data);
                            $this->msg_model->updateChild($data['parent_id']);
                            redirect("msgboard/index");
              }

              /**
               * get the last mood 
               * @return array(mood(),'username'=>'')
               */
            	public function show_mood()
            	{
            		$result=$this->msg_model->get_last();
                            $user=$this->login_model->get_userById($result['user_id']);
                            $data=$result;
                            $data['username']=$user['username'];
                            $data['type']="mood";
                            return $data;
            	}

              /**
               * get mood by parent_id
               * @param $parent_id int
               * @return $data array(''=>{array(),'username'=>''},''=>{})
               */
              public function childMood($parent_id)
              {
                            $data=array();
                            $result=$this->msg_model->get_moodByParentId($parent_id);
                            foreach ($result as $key => $value) {
                                          $user=$this->login_model->get_userById($value['user_id']);
                                          $data[$key]=$value;
                                          $data[$key]['username']=$user['username'];
                            }
                            return $data;
              }

              /**
               * 递归函数获取子孙回复数组
               * 
               */
              public function childReply(&$descendant,$parent)
              {
                            if($parent['child'])
                            {
                                          $children=$this->childMood($parent['id']);
                                          foreach ($children as $key => $value) {
                                                        $child=$value;
                                                        $child['parent_name']=$parent['username'];
                                                        array_push($descendant,$child);
                                                        $this->childReply($descendant,$child);
                                          }
                            }
              }

              /**
               * get all the reply of $parent mood
               * @param $parent &array
               * @return array(''=>array(),) 
               */
              public function get_descendant(&$parent)
              {
                            $descendant=array();
                            $this->childReply($descendant,$parent);
                            return $descendant;
              }

              /**
               * update favour
               */
              public function increase_favour()
              {
                            $mood_id=$_POST['mood_id'];
                            $result=$this->msg_model->update_favour($mood_id);
                            $query=$this->msg_model->get_moodById($mood_id);
                            echo $query['favour'];
              }

              public function down_favour()
              {
                            $mood_id=$_POST['mood_id'];
                            $result=$this->msg_model->downFavour($mood_id);
                            $query=$this->msg_model->get_moodById($mood_id);
                            echo $query['favour'];
              }
}
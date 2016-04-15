<?php 
class Episode extends CI_Controller
{
        function __construct()
        {
                parent::__construct();
                $model=array('story','comment_model','login_model');
                $this->load->model($model);
                $helper=array('url','form');
                $this->load->helper($helper);
                $library=array('pagination','session');
                $this->load->library($library);
        }

        /**
        * show the picture 
        * @param $id int       the id of the story in the table
        */
        public function index($id)
        {
                $data['js']=array('msg-reply','episode-comment','msgtext');
                $data['story']=$this->story->get_dataById('stories',$id);
                $data['comment']=$this->show($id);
                $data['current']="story";
                $this->load->view('header',$data);
                $this->load->view('episode');
                $this->load->view('footer');
        }

        public function comment()
        {
                $data['user_id']=$this->session->id;
                $data['story_id']=$_POST['story_id'];
                $data['content']=$_POST['msg_comment'];
                $this->comment_model->insert($data);
                $url="episode/index/".$data['story_id'];
                redirect($url);
        }

        public function show($story_id)
        {
                $data=array();
                $comment=$this->comment_model->get_last($story_id);
                if($comment)
                {
                        $user=$this->login_model->get_userById($comment['user_id']);
                        $data=$comment;
                        $data['username']=$user['username'];
                        $data['type']="comment";
                }
                return $data;
        }

        /**
         * update favour
         */
        public function up_favour()
        {
                $comment_id=$_POST['comment_id'];
                $result=$this->comment_model->up_favour($comment_id);
                $query=$this->comment_model->get_commentById($comment_id);
                echo $query['favour'];
        }
        public function down_favour()
        {
                $comment_id=$_POST['comment_id'];
                $result=$this->comment_model->down_favour($comment_id);
                $query=$this->comment_model->get_commentById($comment_id);
                echo $query['favour'];
        }

}

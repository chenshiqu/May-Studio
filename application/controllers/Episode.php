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
                // $this->load->view('header',$data);
                // $this->load->view('episode');
                // $this->load->view('footer');
                $this->load->view('test',$data);
        }

        /**
         * deal commnet request
         */
        public function comment()
        {
                $data['user_id']=$this->session->id;
                $data['story_id']=$_POST['story_id'];
                $data['content']=$_POST['msg_comment'];
                $this->comment_model->insert($data);
                $url="episode/index/".$data['story_id'];
                redirect($url);
        }

        /**
         * 
         */
        public function reply()
        {
                $data['user_id']=$this->session->id;
                $data['story_id']=$_POST['story_id'];
                $content=$_POST['text'];
                //delete the string front the colon
                $position=stripos($content,":");
                if($position)
                {
                            $content=substr($content, $position+1);
                }
                $data['content']=$content;
                $data['parent_id']=$_POST['parent_id'];

                //$test['data']=$data;
                //$this->load->view('test',$test);

                $this->comment_model->insert($data);
                $this->comment_model->updateChild($data['parent_id']);

                $url="episode/index/".$data['story_id'];
                redirect($url);
        }

        public function childReply($parent_id)
        {
                $data=array();
                $result=$this->comment_model->get_commentByParentId($parent_id);
                foreach ($result as $key => $value) {
                        $user=$this->login_model->get_userById($value['user_id']);
                        $data[$key]=$value;
                        $data[$key]['username']=$user['username'];
                }
                return $data;
        }

        public function descendantReply(&$descendant,$parent)
        {
                if($parent['child'])
                {
                        $children=$this->childReply($parent['id']);
                        foreach ($children as $key => $value) {
                                $child=$value;
                                //$user=$this->login_model->get_userById($parent['user_id']);
                                $child['parent_name']=$parent['username'];
                                array_push($descendant,$child);
                                $this->descendantReply($descendant,$child);
                        }
                }
        }

        function get_descendant($parent)
        {
                $descendant=array();
                $this->descendantReply($descendant,$parent);
                return $descendant;
        }

        /**
         * get comments that will be show 
         */
        public function show($story_id)
        {
                $data=array();
                $comment=$this->comment_model->get_commentByStoryId($story_id);
                if($comment)
                {
                        foreach ($comment as $key => $value) {
                                $user=$this->login_model->get_userById($value['user_id']);
                                $data[$key]=$value;
                                $data[$key]['username']=$user['username'];
                                //js 中分辨是mood还是comment
                                $data[$key]['type']="comment";
                                //$data[$key]['descentant']=$this->get_descendant($value);                                
                        }
                        foreach ($data as $key => $value) 
                        {
                                $data[$key]['descendant']=$this->get_descendant($value);
                        }
                        
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

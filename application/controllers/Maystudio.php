<?php 
/**
* 前台
*/
class Maystudio extends CI_Controller
{
                function __construct()
                {
                            parent::__construct();
                            $model=array('story','game_model','login_model');
                            $this->load->model($model);
                            $helper=array('url','form');
                            $this->load->helper($helper);
                            $library=array('pagination','session');
                            $this->load->library($library);
                }
                    //首页
                public function index()
                {
                            $data["current"]="index";
							$this->load->view('header',$data);
                            $this->load->view('index');
                            $this->load->view('footer');
                }
                    //关于我们／联系方式
                public function about()
                {
                             $data["current"]=" ";
							 $this->load->view('header',$data);
                             $this->load->view('about');
                             $this->load->view('footer');
                }
        		//漫画
                public function stories()
                {
                            //配置分页设置
                            $config['base_url']=base_url()."index.php/maystudio/stories";
                            $config['total_rows']=$this->story->count_rows('stories');
                            $config['per_page']=30;
                            $this->pagination->initialize($config);

                            //获取偏移量
                            $offset=$this->uri->segment(3);
                            //查询数据库
                            $result=$this->story->get_num_rows('stories',$config['per_page'],$offset);

                            $data['result']=$result;
							$data["current"]="stories";
                            $this->load->view('header',$data);
                            $this->load->view('stories');
                            $this->load->view('footer');
                }

                /**
                 * show the picture 
                 * @param $id int       the id of the story in the table
                 */
                public function episode($id)
                {
                            $data['js']=array('msg-reply','episode-comment','msgtext');
                            $data['story']=$this->story->get_dataById('stories',$id);
                            $this->load->view('header',$data);
                            $this->load->view('episode');
                            $this->load->view('footer');
                }
	 //   //游戏界面
                public function game()
                {

                            //获取数据
                            $result=$this->game_model->getTop('game');
                            $game=array();
                            foreach ($result as $key => $value) 
                            {
                                    $game[$key]=$value;
                                    $user=$this->login_model->get_userById($value['user_id']);
                                    $game[$key]['username']=$user['username'];
                                    $game[$key]['rank']=$key+1;
                            }
                            //var_dump($game);
                            $data['game']=$game;
		
                            $data['js']=array('jgestures.min','game');
		$data["current"]="game";
                            $this->load->view('header',$data);
                            $this->load->view('game');
                            $this->load->view('footer');
                }
                
}
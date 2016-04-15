<?php 
/**
* 前台
*/
class Maystudio extends CI_Controller
{
                function __construct()
                {
                            parent::__construct();
                            $this->load->model('story');
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
                             $this->load->view('header');
                             $this->load->view('about');
                             $this->load->view('footer');
                }
        		//漫画
                public function stories()
                {
                            //配置分页设置
                            $config['base_url']=base_url()."index.php/maystudio/stories";
                            $config['total_rows']=$this->story->count_rows('stories');
                            $config['per_page']=10;
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
	   //游戏界面
                public function game()
                {
							$data['js']=array('game');
							$data["current"]="game";
                            $this->load->view('header',$data);
                            $this->load->view('game');
                            $this->load->view('footer');
                }
                
}
<?php 

/**
 * @author chenshiqu
 * game controller
 */
class Game extends CI_Controller
{
        function __construct()
        {
                parent::__construct();
                $model=array('game_model','login_model');
                $this->load->model($model);
                $helper=array('url','form');
                $this->load->helper($helper);
                $library=array('session','pagination');
                $this->load->library($library);
        }

        //insert score
        public function insert()
        {
                if($this->session->id)
                {
                        $data['score']=$_POST['score'];
                        $data['user_id']=$this->session->id;
                        $this->game_model->insert('game',$data);
                        echo '1';
                }
                else
                {
                        echo "0";
                }
        }
}
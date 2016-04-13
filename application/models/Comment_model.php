<?php 
class Comment_model extends CI_Model
{
        function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

        public function insert($data)
        {
                $query=$this->db->insert('comment',$data);
                return $query;
        }

        /**
         * get the newest comment
         * @return array()
         */
        public function get_last()
        {
                $sql="select * from comment where post_time=(select max(post_time) from comment where parent_id=0) ";
                $query=$this->db->query($sql);
                return $query->row_array();
        }

        public function get_commentById($id)
        {
                $query=$this->db->get_where('comment',array('id'=>$id));
                return $query->row_array();
        }

        /**
         * update favour
         * @param $id int 
         * @return true or false
         */
        public function up_favour($id)
        {
                $sql="update comment set favour=favour+1 where id=$id";
                $query=$this->db->query($sql);
                return $query;
        }
        public function down_favour($id)
        {
                $sql="update comment set favour=favour-1 where id=$id";
                $query=$this->db->query($sql);
                return $query;
        }

}
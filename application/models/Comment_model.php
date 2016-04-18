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
        public function get_last($story_id)
        {
                $sql="select * from comment where post_time=(select max(post_time) from comment where parent_id=0 and story_id=$story_id) ";
                $query=$this->db->query($sql);
                return $query->row_array();
        }

        public function get_commentById($id)
        {
                $query=$this->db->get_where('comment',array('id'=>$id));
                return $query->row_array();
        }

        public function get_commentByParentId($parent_id)
        {
                $query=$this->db->get_where('comment',array('parent_id'=>$parent_id));
                return $query->result_array();
        }

        /**
         * get all the comment belong to story whose id is $story_id
         *@return array(array(),array())
         */
        public function get_commentByStoryId($story_id)
        {
                $sql="select * from (select * from comment order by post_time desc)a where story_id=$story_id and parent_id=0";
                $query=$this->db->query($sql);
                return $query->result_array();
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

        /**
         * update the child state
         */
        public function updateChild($id)
        {
                $sql="update comment set child=1 where id=$id";
                $query=$this->db->query($sql);
                return $query;
        }

}
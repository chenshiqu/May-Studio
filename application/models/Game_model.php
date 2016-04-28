<?php 
/**
 * @author chenshiqu
 * game model
 */
class Game_model extends CI_Model
{
        function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

        /**
         * insert record
         * @param $table string table name
        *                       $data array('score'=score,'user_id'=>user_id)
         */
        function insert($table,$data)
        {
                $this->db->insert($table,$data);
        }

        /**
         * count the number of the record of the table
         * @param $table_name String 
         * @return $row_num number
         */
        public function count_rows($table_name)
        {
                $row_num=$this->db->count_all($table_name);
                return $row_num;
        }

        /**
         * 根据偏移量offset返回limit数量的记录
         * @param $table_name string 
         *            $limit  number返回数据行数
         *            $offset number偏移量
         * @return array 数组形式返回记录
         *   注意数组形式   array([0]=>{'id'=>,'title'=>},[1]=>{})
         */
        public function get_num_rows($table_name,$limit,$offset)
        {
                if($offset=="")
                        $offset=0;
                $sql="select * from (select * from $table_name order by score desc)a limit {$offset},{$limit}";
                // $query=$this->db->get($table_name,$limit,$offset);
                $query=$this->db->query($sql);
                return $query->result_array();
        }

        /**
         * get the top 10 record order by score
         * @param $table_name
         * @return array
         */
        public function getTop($table_name)
        {
                $sql="select * from $table_name order by score desc limit 10";
                $query=$this->db->query($sql);
                return $query->result_array();
        }

}
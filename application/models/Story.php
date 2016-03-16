<?php 
/**
* @author chenshiqu
 * data operation of story table 
 */
class Story extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * get a record through id
	 * @param $table string 
	 * 	$id int
	 * @return array('id'=>,'title'=>,'picture'=>)
	 */
	public function get_dataById($table,$id)
	{
		$query=$this->db->get_where($table, array('id'=>$id));
		return $query->row_array();
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
	 * 	      $limit  number返回数据行数
	 * 	      $offset number偏移量
	 * @return array 数组形式返回记录
	 *   注意数组形式   array([0]=>{'id'=>,'title'=>},[1]=>{})
	 */
	public function get_num_rows($table_name,$limit,$offset)
	{
		$query=$this->db->get($table_name,$limit,$offset);
		return $query->result_array();
	}
}

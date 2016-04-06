<?php 
class Base_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * get all records in the table
	 * @param $table string 
	 * @return array([0]=>{},[1]=>{})
	 */
	public function getAll($table)
	{
		$query=$this->db->get($table);
		return $query->result_array();
	}

	/**
	 * get one record by id
	 * @param $table string 
	 *	      $id int
	 *@return array('id'=>,''=>,)
	 */
	public function getOneById($table,$id)
	{
		$query=$this->db->get_where($table,array('id'=>$id));
		return $query->row_array();
	}

	/**
	 * count the number of the record of the table
	 * @param $table_name String 
	 * @return $row_num number
	 */
	public function count_rows($table)
	{
		$row_num=$this->db->count_all($table);
		return $row_num;
	}

	/**
	 * delete a recode from table by id 
	 * @param $table string 
	 * 	$id int
	 * @return bool 
	 */
	public function deleteOneById($table,$story_id)
	{
		$sql="delete from $table where id=$story_id";
		$result=$this->db->query($sql);
		return $result;
	}

	/**
	 * get story data by setting offset and limit
	 * @param $table string 
	 * 	      $limit  number     the number of record will return 
	 * 	      $offset number    
	 * @return array 
	 *      		array([0]=>{'id'=>,'title'=>},[1]=>{})
	 */
	public function get_num_rows($table,$limit,$offset)
	{
		if($offset=="")
			$offset=0;
		$sql="select * from (select * from $table order by public_time desc)a limit {$offset},{$limit}";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
}
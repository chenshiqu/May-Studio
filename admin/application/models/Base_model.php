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
}
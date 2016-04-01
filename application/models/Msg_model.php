<?php 
/**
 * @author chenshiqu
 * brief deal the mood table
 */
class Msg_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * insert
	 * @param $data array(
	 *			'key'=>"value",)
	 */
	public function insert($data)
	{
		$query=$this->db->insert('mood',$data);
		return $query;
	}
}
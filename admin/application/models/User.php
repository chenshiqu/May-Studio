<?php 
/**
 * @author chenshiqu
 * deal the user table 
 */
class User extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * get all the users
	 * @return array([]=>{},[]=>{},...)
	 */
	public function get_AllUsers()
	{
		$query=$this->db->get('user');
		return $query->result_array();
	}

	/**
	 * delete user by id 
	 * @param id int 
	 * @return boolean
	 */
	public function delete_userById($id)
	{
		$sql="delete from user where id=$id";
		$result=$this->db->query($sql);
		return $result;
	}
}
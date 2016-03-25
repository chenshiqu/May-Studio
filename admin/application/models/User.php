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
}
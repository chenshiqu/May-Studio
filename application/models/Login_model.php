<?php 
//用户表操作类
class Login_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * 插入用户数据
	 * @param $data 数组，包括username和password
	 * @return boolean
	 */
	public function insert_user($data)
	{
		return $this->db->insert('user',$data);
	}

	/**
	 * 根据用户名查询
	 * @param $username  string
	 * 	       
	 * @return array 一条数组形式的查询结果或返回空数组
	 */
	public function get_user( $username)
	{
		$query=$this->db->get_where('user',array('username'=>$username));
		return $query->row_array();
	}

}
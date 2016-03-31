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

	public function insert($data)
}
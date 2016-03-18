<?php 
/**
 * @author chenshiqu
 * deal the operate of table stories
 */
class Story_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * insert record to the stories table
	 * @param  $data array(
	 * 			'title'=>,
	 *			'author_id'=>,
	 *			'picture'=>)
	 * @return bool 
	 */
	public function insert_story($data)
	{
		$result=$this->db->insert('stories',$data);
		return $result;
	}

	/**
	 * get the info of author by author's name
	 * @param $author_name string
	 * @return array('id'=>,'username'=>,'password'=>)
	 *		or a vacant array when search abortively
	 */
	public function get_authorByName($author_name)
	{
		$query=$this->db->get_where('admin',array('username'=>$author_name));
		return $quey->row_array();
	}
}

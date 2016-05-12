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
	 * @return true or false
	 */
	public function insert($data)
	{
		$query=$this->db->insert('mood',$data);
		return $query;
	}

	/**
	 * get the last mood 
	 * @return array()
	 */
	public function get_last()
	{
		$sql="select * from mood where post_time=(select max(post_time) from mood where parent_id=0) ";
		$query=$this->db->query($sql);
		return $query->row_array();
	}

	/**
	 * get moods which have not parent
	 */
	public function get_mood()
	{
		$sql="select * from mood where parent_id=0";
		$query=$this->db->query($sql);
		return $query->result_array();
	}

	/**
	 * get limited number of mood with offset
	 * @param int $limit the number of record will return
	 * 	int  $offset
	 * @return 
	 */
	public function get_limit_rows($limit,$offset)
	{
		if($offset=="")
		{
			$offset=0;
		}
		$sql="select * from (select * from mood where parent_id=0 order by post_time desc)a limit {$offset},{$limit}";
		$query=$this->db->query($sql);
		return $query->result_array();
	}

	/**
	 * @param $id int
	 * @return array()
	 */
	public function get_moodById($id)
	{
		$query=$this->db->get_where('mood',array('id'=>$id));
		return $query->row_array();
	}

	public function get_moodByParentID($id)
	{
		$query=$this->db->get_where('mood',array('parent_id'=>$id));
		return $query->result_array();
	}

	/**
	 * @param $id int 
	 * @return true or false
	 */
	public function update_favour($id)
	{
		$sql="update mood set favour=favour+1 where id=$id";
		$query=$this->db->query($sql);
		return $query;
	}

	public function downFavour($id)
	{
		$sql="update mood set favour=favour-1 where id=$id";
		$query=$this->db->query($sql);
		return $query;
	}

	public function updateChild($id)
	{
		$sql="update mood set child=1 where id=$id";
		$query=$this->db->query($sql);
		return $query;
	}

	/**
	 * 查找没有父评论的记录
	 * @return array([0]=>array{[a]=>string })
	 */
	public function count_rows($table)
	{
		$sql="select count(id) as a from mood where parent_id=0";
		$row_num=$this->db->query($sql);
		return $row_num->result_array();
	}
}
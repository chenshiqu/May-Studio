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

	/**
	 * get a record from stories by id 
	 * @param $story_id int 
	 * @return array('id'=>,'title'=>,'picture'=>,'public_time'=>,)
	 */
	public function get_storyById($story_id)
	{
		$query=$this->db->get_where('stories',array('id'=>$story_id));
		return $query->row_array();
	}

	/**
	 * search the records of the story table
	 * @return array(0=>{'id'=>,},1=>{'id'=>,})
	 */
	public function get_AllStories()
	{
		$query=$this->db->get('stories');
		return $query->result_array();
	}

	/**
	 * delete a recode from stories table by id 
	 * @return bool 
	 */
	public function delete_storyById($story_id)
	{
		// $result=$this->db->delete('stories',array('id'=>$stories_id));
		$sql="delete from stories where id=$story_id";
		$result=$this->db->query($sql);
		return $result;
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
	 * get story data by setting offset and limit
	 * @param $table_name string 
	 * 	      $limit  number     the number of record will return 
	 * 	      $offset number    
	 * @return array 
	 *      		abs(number)rray([0]=>{'id'=>,'title'=>},[1]=>{})
	 */
	public function get_num_rows($table_name,$limit,$offset)
	{
		if($offset=="")
			$offset=0;
		$sql="select * from (select * from $table_name order by public_time desc)a limit {$offset},{$limit}";
		// $query=$this->db->get($table_name,$limit,$offset);
		$query=$this->db->query($sql);
		return $query->result_array();
	}

}

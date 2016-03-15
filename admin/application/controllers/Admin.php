<?php  
/**
 * 后台控制器
 */
class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	function index()
	{
		$this->load->view('admin');
	}
}
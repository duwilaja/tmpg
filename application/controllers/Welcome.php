<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	 
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$usr=$this->session->userdata('user_data');
		if ( !isset($usr))
		{ 
			// Allow some methods?
			$allowed = array(
				'index',
				'in',
				'out',
				'pwd'
			);
			//if ( ! in_array($this->router->fetch_method(), $allowed) && $usr["useraccess"]!='ADM' && $usr["usergrp"]!='')
			//{
				//echo "Direct access not allowed";
			//}
			redirect(base_url()."sign/out/1");
		}
	}
	public function index()
	{
		//$this->load->view('welcome_message');
		echo "";
	}
	public function home()
	{
		$usr=$this->session->userdata('user_data');
		$data['session']=$usr;
		$this->load->view('home',$data);
	}
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_mod');
	}

	public function index()
	{
		$data = $this->user_mod->get('tb_users', array());
		for( $i=0; $i<count($data); $i++ ){
			$data[$i]['experiences'] = $this->user_mod->get('tb_experiences', array('user_id' => $data[$i]['id']));
			$data[$i]['portfolios'] = $this->user_mod->get('tb_portfolios', array('user_id' => $data[$i]['id']));
		}

		$this->load->view('user', array('data' => $data));
	}

	
}

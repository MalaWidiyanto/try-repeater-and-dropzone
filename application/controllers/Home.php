<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_mod');
	}

	public function index()
	{
		$this->load->view('home');
	}

	public function register(){
		$firstName = $this->input->post('first_name');
		$lastName = $this->input->post('last_name');
		$bod = $this->input->post('bod');
		$address = $this->input->post('address');

		$data = array(
			'first_name' => $firstName,
			'last_name' => $lastName,
			'bod' => $bod,
			'address' => $address
		);

		$lastId = $this->user_mod->insert('tb_users', $data);

		//save experiences
		$experiences = $this->input->post('experience');
		for ($i=0; $i<count($experiences); $i++){
			$experiences[$i]['user_id'] = $lastId;
		}

		$this->user_mod->insert_batch('tb_experiences', $experiences);

		$response = array();
		$response['last_id'] = $lastId;
		if($lastId > 0){
			$response['status'] = true;
		}else{
			$response['status'] = false;
		}
		echo json_encode($response);
	}

	public function save_portfolio(){
		$lastId = $this->input->post('last_id');

		// var_dump($_FILES['file']['name']);
		// return;

		//upload portfolio
		if(count($_FILES['file']['name'])>0){
			$portfolios = array();

			$total = count($_FILES['file']['name']);

			// echo "count: ".$total." | ";

			$files = $_FILES;
			for($i=0; $i<$total; $i++){
				$_FILES['file']['name']= $files['file']['name'][$i];
				$_FILES['file']['type']= $files['file']['type'][$i];
				$_FILES['file']['tmp_name']= $files['file']['tmp_name'][$i];
				$_FILES['file']['error']= $files['file']['error'][$i];
				$_FILES['file']['size']= $files['file']['size'][$i];    

				$config['upload_path'] = 'uploads/portfolio/'; 
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['max_size'] = '2048'; // max_size in kb
				$config['file_name'] = $_FILES['file']['name'];

				$this->load->library('upload',$config); 

				if($this->upload->do_upload('file')){
					$uploadData = $this->upload->data()['file_name'];
					$temp = array(
						'user_id' => $lastId,
						'image_url' => 'uploads/portfolio/'.$uploadData
					);
					// echo "name : ".$uploadData." | ";
					array_push($portfolios, $temp);
				}
			}
			// var_dump($portfolios);
			$this->user_mod->insert_batch('tb_portfolios', $portfolios);
		}

	}

	
}

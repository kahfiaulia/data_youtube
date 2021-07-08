<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index() {
		$this->load->view("index");
	}
	
	public function data_channel() {
		// $data = array(
		// 'id' => $this->input->post('id_channel'),
		// 'maxResults' => $this->input->post('max_results')
		// );
		
		// $this->load->view("output", $data);

		$data = $this->input->post();
		print_r($data);
		}

	public function data_video() {
		// $data = array(
		// 'idVideo' => $this->input->post('id_video')
		// );
		
		// $this->load->view("output", $data);

		$data = $this->input->post();
		print_r($data);
		}
}

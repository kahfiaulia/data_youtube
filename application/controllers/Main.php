<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public $id;
    public $maxResults;
	public $idVideo;

	public function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
	}

	public function index() {
		$this->load->view("index");
	}
	
	public function data_channel() {
		$data['id'] = $this->input->post('id_channel');
		$data['maxResults'] = $this->input->post('max_results');
		// $data = array(
		// 	'id'           		=> $this->input->post('id_channel'),
		// 	'maxResults'          => $this->input->post('max_results'));
		$this->load->view("output_channel", $data);
		}

	public function data_video() {
		$data['idVideo'] = $this->input->post('id_video');
		
		$this->load->view("output_video", $data);

		// $data = $this->input->post();
		// print_r($data);
		}
}

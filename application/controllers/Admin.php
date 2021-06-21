<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->session->set_flashdata('not-login', 'Gagal!');
		if (!$this->session->userdata('email')) {
			redirect('welcome/admin');
		}
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('admin', ['email' =>
		$this->session->userdata('email')])->row_array();

		$this->load->view('admin/index');
	}
}

/* End of file Admin.php */

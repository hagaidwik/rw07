<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		$this->load->view("admin/index.php");
	}

	public function admin()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
			'required' => 'Harap isi bidang email!',
			'valid_email' => 'Email tidak valid!',
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', [
			'required' => 'Harap isi Password!',
		]);
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/login');
		} else {
			//validasi sukses
			$this->adminlogin();
		}
	}

	private function adminlogin()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('admin', ['email' => $email])->row_array();

		if ($user) {
			//cek password
			if (password_verify($password, $user['password'])) {
				$data = [

					'email' => $user['email'],
					'nama' => $user['username'],

				];
				$this->session->set_userdata($data);
				redirect(base_url('admin'));
			} else {

				$this->session->set_flashdata('fail-pass', 'Gagal!');
				redirect(base_url('welcome/admin'));
			}
		} else {

			$this->session->set_flashdata('fail-login', 'Gagal!');
			redirect(base_url('welcome/admin'));
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// This Controller is Used of Resgister and Login
class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('home');
	}

	public function registerNow()
	{
		if($_SERVER['REQUEST_METHOD']==='POST')
		{
			$this->form_validation->set_rules('username','User Name','required');
			$this->form_validation->set_rules('email','email','required');
			$this->form_validation->set_rules('password','password','required');

			if($this->form_validation->run()===TRUE)
			{
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$password = $this->input->post('password');

				$data = array(
					'username'=>$username,
					'email'=>$email,
					'password'=>md5($password),
					'status'=>1
				);

				$this->load->model('user_model');
				$this->user_model->insertuser($data);
				$this->session->set_flashdata('success','Successfully User Created');
				redirect(base_url('welcome/index'));
			}
		}
	}

	public function Login()
	{
		$this->load->view('login');
	}

	public function loginNow()
	{
		if($_SERVER['REQUEST_METHOD']==='POST')
		{
			$this->form_validation->set_rules('email','email','required');
			$this->form_validation->set_rules('password','password','required');

			if($this->form_validation->run()===TRUE)
			{
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$password = md5($password);

				$this->load->model('user_model');
				$status = $this->user_model->checkPassword($password,$email);
				
				if($status!=false)
				{
					$username = $status->username;
					$email = $status->email;

					$session_data = array(
						'username'=>$username,
						'email'=>$email
					);

					$this->session->set_userdata('UserLoginSession',$session_data);
					redirect(base_url('welcome/dashboard'));
				}
				else
				{
					$this->session->set_flashdata('error','Email or Password is Wrong');
					redirect(base_url('welcome/login'));
				}
			}
		}
		else
		{
			$this->session->set_flashdata('error','Please Fill the Required Field');
			redirect(base_url('welcome/login'));
		}
	}
	function dashboard()
	{
		$this->load->view('dashboard');
	}
	
}
?>
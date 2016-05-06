<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CompilerHub {

	// public function test($do) {
	// 	switch ($do) {
	// 		case 'mail':
	// 			# code...
	// 			break;
			
	// 		default:
	// 			# code...
	// 			break;
	// 	}
	// }

	public function login()
	{
		$this->nav();
		if ($this->user()) 
			redirect('/');
		
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() != FALSE) {
			$this->db->where('username', $this->input->post('username'));
			$this->db->where('password', md5($this->input->post('password')));
			$result = $this->db->get('users');

			if ($result->num_rows() > 0) {
				if ($result->result()[0]->verification_code != NULL)
					$this->_data['errors'][] = 'Your account is not verified.';
				elseif ($result->result()[0]->activated == 0) 
					$this->_data['errors'][] = 'Your account is inactive.';
				else {
					$this->session->set_userdata('user', $result->result()[0]);
					redirect('/');
				}
			} else {
				$this->_data['errors'][] = 'Incorrect Username and/or Password.';
			}
		}

		$this->template('account/login');
	}

	public function verify($verification_code) {
		$this->db->where('verification_code', $verification_code);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			$user = $query->result()[0];
			$this->db->where('id', $user->id);
			$this->db->update('users', ['verification_code' => '', 'activated' => 1]);

			$this->session->set_flashdata('alert_success', 'Your account is now verified/activated. Please login to buy our product.');
			redirect('account/login');
		}

		$this->session->set_flashdata('alert_danger', 'Unknown verification code.');
		redirect('/');
	}

	public function logout() {
		$this->session->unset_userdata('user');
		$this->session->sess_destroy();
		redirect('/');
	}

	public function register()
	{
		$this->nav();
		if ($this->user()) 
			redirect('/');

		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[12]|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->template('account/register');
		} else {
			$data = [
				'username' => strtolower($this->input->post('username')),
				'full_name' => ucwords($this->input->post('full_name')),
				'email' => strtolower($this->input->post('email')),
				'password' => md5($this->input->post('password')), 
				'verification_code' => md5(uniqid(rand(), true)), 
			];

			$this->db->insert('users', $data);

			if ($this->db->insert_id()) {
				$message = "Thank you for registering to coolgeeks.technology.\r\n" . 
				"Please click the link below to verify your account:\r\n" . 
				'http://' . $_SERVER['HTTP_HOST'] . base_url('account/verify/' . $data['verification_code']);

				$this->email->from('support@coolgeeks.technology', 'CoolGeeks Store');
				$this->email->to(strtolower($this->input->post('email')));
				$this->email->subject('Please Verify Your Account');
				$this->email->message($message);
				$this->email->send();
			}

			$this->template('account/register_success');
		}
	}

	public function transaction($cuid = NULL) {
		$this->nav();
		if (!$this->user()) 
			redirect('/');

		if ($this->isAdmin()) 
			$this->db->select('users.username, pricing.amount, products.title, pricing.price, transactions.sender, vouchers.code, transactions.creation_date, transactions.status, transactions.test');
		else
			$this->db->select('pricing.amount, products.title, pricing.price, transactions.sender, vouchers.code, transactions.creation_date');
		
		$this->db->join('vouchers', 'vouchers.transaction_id = transactions.id');
		$this->db->join('pricing', 'pricing.id = vouchers.pricing_id');
		$this->db->join('products', 'products.id = pricing.product_id');

		if ($this->isAdmin()) {
			$this->db->join('users', 'users.id = transactions.user_id');
		} else {
			$this->db->join('users', 'users.id = transactions.user_id');
			$this->db->where('users.id', $this->user()->id);
			$this->db->where('transactions.status', 'completed');
			$this->db->where('transactions.test', 0);
		}

		if ($cuid) 
			$this->db->where('transactions.cuid', $cuid);

		$this->db->order_by('transactions.id', 'desc');
		$query = $this->db->get('transactions');

		// echo $this->db->last_query(); exit;
		$this->_data['transactions'] = ($query->num_rows() > 0) ? $query->result() : false;
		$this->template('account/transaction');

	}
}

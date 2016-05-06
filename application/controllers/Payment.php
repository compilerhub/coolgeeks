<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CompilerHub {

	public function fortumo($service_id) {
		if (!$this->user()) {
			$this->session->set_flashdata('alert_danger', 'You are not login. Please login first to be able to buy our product.');
			redirect('account/login');
		}

		$this->db->join('vouchers', 'vouchers.pricing_id = pricing.id');
		$this->db->where('pricing.service_id', $service_id);
		$this->db->where('vouchers.transaction_id', 0);
		$query = $this->db->get('pricing');

		if ($query->num_rows()) {
			$data = [
				'user_id' => $this->user()->id, 
				'service_id' => $service_id, 
				'cuid' => md5(uniqid(rand(), true)), 
				'status' => 'pending', 
				'creation_date' => date('Y-m-d H:i:s', time()),
			];

			$this->db->where('user_id', $this->user()->id);
			$this->db->where('service_id', $service_id);
			$this->db->where('status', 'pending');
			$query = $this->db->get('transactions');

			if ($query->num_rows() > 0) {
				$this->db->where('user_id', $this->user()->id);
				$this->db->where('service_id', $service_id);
				$this->db->where('status', 'pending');
				$this->db->update('transactions', $data);
			} else {
				$this->db->insert('transactions', $data);
			}

			redirect('http://pay.fortumo.com/mobile_payments/' . $service_id . '?cuid=' . $data['cuid']);
			// create transaction [PENDING]
			// redirect to fortumo
		}

		redirect('/');
	}

	protected function _checkSignature() {
		$params = $this->input->get();
		ksort($params);

		if (!isset($params['service_id'])) 
			return false;

		$this->db->where('service_id', $params['service_id']);
		$query = $this->db->get('pricing');
		$pricing = ($query->num_rows() > 0) ? $query->result()[0] : false;
		if (!$pricing) 
			return false;

		$str = '';
		foreach ($params as $k=>$v) {
			if($k != 'sig') {
				$str .= "$k=$v";
			}
		}

		$str .= $pricing->secret;
		$signature = md5($str);

		return ($params['sig'] == $signature);
	}

	public function process() {
		// check that the request comes from Fortumo server
		// if(!in_array($_SERVER['REMOTE_ADDR'], array('1.2.3.4', '2.3.4.5'))) 
		// 	exit;
		

		if ($this->input->get('test') == 'ok') {
			$data = [
				'status' => $this->input->get('status'), 
				'test' => ($this->input->get('test') == 'ok') ? 1 : 0, 
				'sender' => $this->input->get('sender'), 
				'cuid' => $this->input->get('cuid'), 
				'payment_id' => $this->input->get('payment_id'), 
			];

			$this->db->insert('transactions', $data);
			exit;
		}

		$data = [
			'status' => $this->input->get('status'), 
			'test' => ($this->input->get('test') == 'ok') ? 1 : 0, 
			'sender' => $this->input->get('sender'), 
		];

		if ($this->_checkSignature()) 
			$data['payment_id'] = $this->input->get('payment_id');

		$this->db->where('service_id', $this->input->get('service_id'));
		$this->db->where('cuid', $this->input->get('cuid'));
		$this->db->update('transactions', $data);
	}
}

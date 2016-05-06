<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CompilerHub {

	public function index() {
		if ($this->_data['is_admin']) {
			$query = $this->db->get('products');
			$this->_data['products'] = ($query->num_rows() > 0) ? $query->result() : false;
			$this->template('product/admin');
		} else {
			$this->db->where('enabled', 1);
			$query = $this->db->get('products');

			$products = false;
			if ($query->num_rows() > 0) {
				
			}

			$this->_data['products'] = ($query->num_rows() > 0) ? $query->result() : false;
			$this->template('product/user');
		}
	}

	public function voucher() {
		$this->nav();


		$this->db->select('vouchers.id, vouchers.code, vouchers.pricing_id, pricing.product_id, pricing.amount, pricing.price, pricing.service_id, pricing.secret, products.title');
		$this->db->join('pricing', 'pricing.id = vouchers.pricing_id');
		$this->db->join('products', 'products.id = pricing.product_id');
		$this->db->where('vouchers.transaction_id', 0);
		$this->db->order_by('pricing.product_id', 'asc');
		$this->db->order_by('pricing.amount', 'asc');
		$this->db->order_by('vouchers.id', 'desc');
		$query = $this->db->get('vouchers');
		$this->_data['vouchers'] = ($query->num_rows() > 0) ? $query->result() : false;

		$this->template('product/voucher');
	}

	public function pricing() {
		$this->nav();


		$this->db->select('pricing.id, pricing.product_id, pricing.amount, pricing.price, pricing.service_id, pricing.secret, products.title');
		$this->db->join('products', 'products.id = pricing.product_id');
		$this->db->order_by('pricing.product_id', 'asc');
		$this->db->order_by('pricing.amount', 'asc');
		$query = $this->db->get('pricing');
		$this->_data['products'] = ($query->num_rows() > 0) ? $query->result() : false;
		
		$this->template('product/pricing');
	}

	public function disable($the, $id = NULL) {
		$id = (int) $id;
		if (!$this->isAdmin()) 
			redirect('/');

		switch ($the) {
			case 'product':
				$this->db->where('id', $id);
				$this->db->update('products', ['enabled' => 0]);

				if ($this->db->affected_rows()) 
					$this->session->set_flashdata('alert_success', 'Product has been disabled.');

				redirect('/');
				break;
		}
	}

	public function enable($the, $id = NULL) {
		$id = (int) $id;
		if (!$this->isAdmin()) 
			redirect('/');

		switch ($the) {
			case 'product':
				$this->db->where('id', $id);
				$this->db->update('products', ['enabled' => 1]);

				if ($this->db->affected_rows()) 
					$this->session->set_flashdata('alert_success', 'Product has been enabled.');

				redirect('/');
				break;
		}
	}

	public function add($the, $id = NULL) {
		$id = (int) $id;

		switch ($the) {
			case 'product':
				$this->template('product/add/product');
				break;

			case 'voucher':
				$this->nav('voucher');

				$this->form_validation->set_error_delimiters('<li>', '</li>');
				$this->form_validation->set_rules('pricing_id', 'Price', 'required|greater_than[0]');

				if ($this->form_validation->run() != FALSE) {
					$data = [
						'code' => $this->input->post('code'), 
						'pricing_id' => (int) $this->input->post('pricing_id'), 
					];

					$this->db->insert('vouchers', $data);
					if ($this->db->insert_id()) {
						$this->session->set_flashdata('alert_success', 'You have successfully created product voucher.');
					} else {
						$this->session->set_flashdata('alert_warning', 'There was an error with your current request. Please try again or contact your system administrator.');
					}

					redirect('product/voucher');
				}

				$this->db->select('pricing.id, pricing.product_id, pricing.amount, pricing.price, pricing.service_id, pricing.secret, products.title');
				$this->db->join('products', 'products.id = pricing.product_id');
				$this->db->order_by('pricing.product_id', 'asc');
				$this->db->order_by('pricing.amount', 'asc');
				$query = $this->db->get('pricing');
				$this->_data['pricings'] = ($query->num_rows() > 0) ? $query->result() : false;

				if (!$this->_data['pricings']) {
					$this->session->set_flashdata('alert_warning', 'There is no pricing(s) yet. Please create pricing before creating voucher.');
					redirect('product/voucher');
				}


				// print_r($this->_data['pricings']); exit;
				$this->template('product/add/voucher');
				break;
			
			case 'pricing':
				$this->nav('pricing');

				$this->form_validation->set_error_delimiters('<li>', '</li>');
				$this->form_validation->set_rules('product_id', 'Product', 'required');
				$this->form_validation->set_rules('amount', 'Amount', 'required');
				$this->form_validation->set_rules('price', 'Price', 'required');
				$this->form_validation->set_rules('service_id', 'Fortumo Service ID', 'required');
				$this->form_validation->set_rules('secret', 'Fortumo Secret', 'required');

				if ($this->form_validation->run() != FALSE) {
					$data = [
						'product_id' => (int) $this->input->post('product_id'), 
						'amount' => (double) $this->input->post('amount'), 
						'price' => (double) $this->input->post('price'), 
						'service_id' => preg_replace('/\s+/', '', $this->input->post('service_id')), 
						'secret' => preg_replace('/\s+/', '', $this->input->post('secret')), 
					];

					$this->db->insert('pricing', $data);
					if ($this->db->insert_id()) {
						$this->session->set_flashdata('alert_success', 'You have successfully created product pricing.');
					} else {
						$this->session->set_flashdata('alert_warning', 'There was an error with your current request. Please try again or contact your system administrator.');
					}

					redirect('product/pricing');
				}
			
				$query = $this->db->get('products');
				$this->_data['products'] = ($query->num_rows() > 0) ? $query->result() : false;
				if (!$this->_data['products']) {
					$this->session->set_flashdata('alert_warning', 'There is no product(s) yet. Please create product before creating price.');
					redirect('product/pricing');
				}

				$this->template('product/add/pricing');

				break;
		}
	}
}

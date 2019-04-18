<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, "https://danendra.000webhostapp.com/tugas5/api/minuman");
		curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($c, CURLOPT_HEADER, FALSE);
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");

		$data = curl_exec($c);

		$data = array(
			'data' => json_decode($data),
			'page' => 'data'
		);

		$this->load->view('master',$data);
	}

	public function add()
	{
		$submit	= $this->input->post('submit');
		$nama_minuman	= $this->input->post('nama');
		$harga = $this->input->post('harga');
		$stok = $this->input->post('stok');

		if ($submit) {
			$param = [
				
				'nama' 		=> $nama_minuman,
				'harga'	=> $harga,
				'stok'=> $stok
			];

			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, "https://danendra.000webhostapp.com/tugas5/api/minuman/add");
			curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($c, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($c, CURLOPT_HEADER, FALSE);
			curl_setopt($c, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($c, CURLOPT_POST, TRUE);
			curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($param));

			$data = curl_exec($c);

 			header('location:'.base_url());
		}

		$this->load->view('master',['page' => 'add']);
	}

	public function edit()
	{
		$id_minuman 	= $this->uri->segment(3);
		$submit	= $this->input->post('submit');

		if ($submit) {
			$nama_minuman	= $this->input->post('nama');
			$harga = $this->input->post('harga');
			$stok = $this->input->post('stok');
			$id_minuman 	= $this->input->post('id_minuman');

			$param = [
				'id_minuman'		=> $id_minuman,
				'nama' 		=> $nama_minuman,
				'harga'	=> $harga,
				'stok ' => $stok
			];

			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, "https://danendra.000webhostapp.com/tugas5/api/minuman/edit");
			curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($c, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($c, CURLOPT_HEADER, FALSE);
			curl_setopt($c, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($c, CURLOPT_POST, TRUE);
			curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($param));

			$data = curl_exec($c);

			print_r(json_decode($data));

			header('location:'.base_url());
		}

		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, "https://danendra.000webhostapp.com/tugas5/api/minuman?id_minuman=$id_minuman");
		curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($c, CURLOPT_HEADER, FALSE);
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");

		$data = curl_exec($c);

		$data = array(
			'data' => json_decode($data),
			'page' => 'update'
		);

		$this->load->view('master', $data);
	}

	public function delete()
	{
		$id_minuman = $this->uri->segment(3);

		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, "https://danendra.000webhostapp.com/tugas5/api/minuman/delete?id_minuman=$id_minuman");
		curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($c, CURLOPT_HEADER, FALSE);
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");

		$data = curl_exec($c);

		header('location:'.base_url());
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Server.php';

class Mahasiswa extends Server
{

	// buat fungsi get
	function service_get()
	{
		// panggil model Mmahasiswa
		$this->load->model("Mmahasiswa", "mdl", TRUE);

		// panggil fungsi "get_data"
		$hasil = $this->mdl->get_data();

		// memberikan response
		$this->response(array("mahasiswa" => $hasil), 200);
	}


	// buat fungsi post
	function service_post()
	{
		$this->load->model("Mmahasiswa","mdl",TRUE);
		$data = array(
			"npm" => $this->post("npm"),
			"nama"=>$this->post("nama"),
			"telepon"=>$this->post("telepon"),
			"jurusan"=>$this->post("jurusan"),
		);
		// panggil method simpan
		$hasil=$this->mdl->simpan_data($data["npm"],$data["nama"],$data["telepon"],$data["jurusan"],base64_encode($data["npm"]));
		// jika data tidak ditemukan
		if($hasil==0){
			$this->response(array("status"=>"data berhasil disimpan"),200);
		}
		// jika data ditemukan
		else{
			$this->response(array("status"=>"data gagal disimpan"),200);
		}
	}



	// buat fungsi put
	function service_put()
	{
	}



	// buat fungsi delete
	function service_delete()
	{
		// panggil model "Mmahasiswa"
		$this->load->model("Mmahasiswa","mdl",TRUE);
		// ambil parameter NPM
		// $token=$this->delete("FROM_BASE64(npm)");
		// // panggil method "hapus_data"
		
		$token=$this->delete("TO_BASE64(npm)");
		$hasil=$this->mdl->hapus_data(base64_encode($token));
		// panggil method "hapus_data"
		// $hasil=$this->mdl->hapus_data($token);
		// jika data berhasil dihapus
		if($hasil ==1){
			$this->response(array("status"=>"data berhasil dihapus"),200);
		}
		// jika data gagal dihapus
		else{
			$this->response(array("status"=>"data gagal dihapus!"),200);
		}
	}
}

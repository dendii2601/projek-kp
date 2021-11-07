<?php

class Data_barang extends CI_Controller{

    public function index()
    {
        $data['barang'] = $this->model_barang->tampil_data()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar'); 
        $this->load->view('admin/data_barang', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_aksi()
    {
        $tanggal      = $this->input->post('tanggal');
        $pengirim     = $this->input->post('pengirim');
        $jam          = $this->input->post('jam');
        $penerima     = $this->input->post('penerima');
        $gambar     = $_FILES['gambar']['name'];
        if ($gambar =''){}else{
            $config ['upload_path'] = './uploads';
            $config ['allowed_types'] = 'jpg|jpeg|png|gif';
            
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('gambar')){
                echo "Gambar gagal diUpload!";
            } else{
                $gambar=$this->upload->data('file_name');
            }
        }

        $data = array(
            'tanggal'      => $tanggal,
            'pengirim'     => $pengirim,
            'jam'          => $jam,
            'penerima'     => $penerima,
            'gambar'       => $gambar
        );

        $this->model_barang->tambah_barang($data, 'tb_barang');
        redirect ('admin/data_barang/index');
    }

    public function edit($id)
	{
		$where = array('id_brg' =>$id);
		$data['barang'] = $this->model_barang->edit_barang($where,'tb_barang')->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/edit_barang',$data);
		$this->load->view('templates_admin/footer');
	}

    public function update()
	{
		$id 		= $this->input->post('id_brg'); 
		$tanggal 	= $this->input->post('tanggal');
		$pengirim   = $this->input->post('pengirim');
		$jam 	    = $this->input->post('jam');
		$penerima 	= $this->input->post('penerima');
        
		$data = array(
				'tanggal'  => $tanggal,
				'pengirim' => $pengirim,
				'jam'      => $jam,
				'penerima' => $penerima,
				
		);

		$where = array(
			'id_brg' => $id
		);
		$this->model_barang->update_data($where,$data,'tb_barang');
		redirect('admin/data_barang/index');
    }
    public function hapus ($id)
	{
		$where = array('id_brg' =>$id);
		$this->model_barang->hapus_data($where,'tb_barang');
        redirect('admin/data_barang/index');
    }

    
}
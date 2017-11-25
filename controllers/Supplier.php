<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public $label = ['Kode','Nama Supplier','Alamat','Kota','Telepon','Kontak','HP','Fax'];
	public function index()
	{
		$this->load->view('index',['title'=>'Supplier']);
	}

	public function add()
	{
		$form = [];
		$field = $this->db->field_data('C007');
		$valAI = $this->autoInc();
			$form[] = ['type'=>'text','name'=>'KODE_SPL','value'=>$valAI,'pk'=>1,'label'=>$this->label[0]];
			$form[] = ['type'=>'text','name'=>'NAMA_SPL','value'=>'','label'=>$this->label[1]];
			$form[] = ['type'=>'text','name'=>'Alamat','value'=>'','label'=>$this->label[2]];
			$form[] = ['type'=>'text','name'=>'Kota','value'=>'','label'=>$this->label[3]];
			$form[] = ['type'=>'text','name'=>'Telpon','value'=>'','label'=>$this->label[4]];
			$form[] = ['type'=>'text','name'=>'Kontak','value'=>'','label'=>$this->label[5]];
			$form[] = ['type'=>'text','name'=>'NoHp','value'=>'','label'=>$this->label[6]];
			$form[] = ['type'=>'text','name'=>'NoFax','value'=>'','label'=>$this->label[7]];
			$this->load->view('index',['title'=>'Tambah Supplier','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('C007',['KODE_SPL'=>$id])->row();
		$form = [];
		$field = $this->db->field_data('C007');
		$form[] = ['type'=>'text','name'=>'KODE_SPL','value'=>$val['KODE_SPL'],'pk'=>1,'label'=>$this->label[0]];
			$form[] = ['type'=>'text','name'=>'NAMA_SPL','value'=>$val['NAMA_SPL'],'label'=>$this->label[1]];
			$form[] = ['type'=>'text','name'=>'Alamat','value'=>$val['Alamat'],'label'=>$this->label[2]];
			$form[] = ['type'=>'text','name'=>'Kota','value'=>$val['Kota'],'label'=>$this->label[3]];
			$form[] = ['type'=>'text','name'=>'Telpon','value'=>$val['Telpon'],'label'=>$this->label[4]];
			$form[] = ['type'=>'text','name'=>'Kontak','value'=>$val['Kontak'],'label'=>$this->label[5]];
			$form[] = ['type'=>'text','name'=>'NoHp','value'=>$val['NoHp'],'label'=>$this->label[6]];
			$form[] = ['type'=>'text','name'=>'NoFax','value'=>$val['NoFax'],'label'=>$this->label[7]];

			$this->load->view('index',['title'=>'Edit Supplier','field'=>$form]);
		
	}

	public function proses($type){
		if($type=="add"){
			$this->db->insert('C007',$this->input->post());
		}else{
			$this->db->where('KODE_SPL',$this->input->post('KODE_SPL'));
			$this->db->update('C007',$this->input->post());
		}
		redirect('Supplier');
	}

	public function delete($id){
		$this->db->where('KODE_SPL',$id);
		$this->db->delete('C007');
		redirect('Supplier');
	}

	public function autoInc(){
		$query = $this->db->select('KODE_SPL')->order_by('KODE_SPL',"DESC")->limit(1)->get('C007')->row();
		$num=(int) $query->KODE_SPL;
		$num=$num+1;
		if($num<10){
			$numInt = "0".$num;
		}else{
			$numInt=$num;
		}
		return $numInt;
	}

	

	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				

				$columns = array('KODE_SPL'
      ,'NAMA_SPL'
      ,'Alamat'
      ,'Kota'
      ,'Telpon'
      ,'Kontak'
      ,'NoHp'
      ,'NoFax');
				//$sel=implode(",", $columns);
				$sqlQuery = "SELECT *
							FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY [KODE_SPL]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[C007] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				/*$sql = "SELECT $sel ";
				$sql.=" FROM po where id_user = '$session' $add_q";*/
				$sql = $this->db->get('C007');
				$totalData = $sql->num_rows();
				$totalFiltered = $totalData;  
				if( $requestData['search']['value'] ) {
					$sqlQuery.="AND KODE_SPL LIKE '%".$requestData['search']['value']."%' OR NAMA_SPL LIKE '%".$requestData['search']['value']."%' ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";
					$sql=$this->db->query($sqlQuery);
				$totalFiltered = $sql->num_rows(); 
			    $res=$sql->result_array();
				
			} else { 	

				$sql=$this->db->query($sqlQuery);
								
				$res=$sql->result_array();
				
			}

			$data = [];
			foreach( $res as $k=>$row) {  
				$nestedData=array(); 
				$nestedData[] = $row["KODE_SPL"];
				$nestedData[] = $row["NAMA_SPL"];
				$nestedData[] = $row["Alamat"];
				$nestedData[] = $row["Kota"];
				$nestedData[] = $row["Telpon"];
				$nestedData[] = $row["Kontak"];
				$nestedData[] = $row["NoHp"];
				$nestedData[] = $row["NoFax"];
				$nestedData[] = "<a class='btn btn-success' href='".base_url()."index.php/".$this->uri->segment(1)."/edit/".$row["KODE_SPL"]."'><span class='glyphicon glyphicon-pencil'> </span>Edit</a><a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["KODE_SPL"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
				$data[] = $nestedData;
			}



			$json_data = array(
						"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
						"recordsTotal"    => intval( $totalData ),  // total number of records
						"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
						"data"            => $data // total data array
						);

			echo json_encode($json_data);
    }
}

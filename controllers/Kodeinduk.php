<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kodeinduk extends CI_Controller {

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
	public function index()
	{
		//$query = $this->db->select('kode_ju')->get('B001')->result_array();
		//print_r($query);die();
		$this->load->view('index',['title'=>'Induk']);
	}

	public function add()
	{
		$form = [];
		$field = $this->db->field_data('B001');
		foreach ($field as $key => $value) {
			if($value->type=='nvarchar'){
				$form[] = ['type'=>'text','name'=>$value->name,'value'=>''];
			}else{
				$form[] = ['type'=>'number','name'=>$value->name,'value'=>''];
			}
		}
		
			$this->load->view('index',['title'=>'Tambah Induk','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('B001',['kode_ju'=>$id])->row();
		$form = [];
		$field = $this->db->field_data('B001');
		print_r($field);die();
		foreach ($field as $key => $value) {
			if($value->type=='nvarchar'){
				$form[] = ['type'=>'text',
							'name'=>$value->name,
							'value'=>$val[$value->name],
							'pk'=>$value->primary_key];
			}else{
				$form[] = ['type'=>'number',
							'name'=>$value->name,
							'value'=>$val[$value->name],
							'pk'=>$value->primary_key];
			}
		}
			$this->load->view('index',['title'=>'Edit Induk','field'=>$form]);
		
	}

	public function proses($type){
		if($type=="add"){
			$this->db->insert('B001',$this->input->post());
		}else{
			$this->db->where('kode_ju',$this->input->post('kode_ju'));
			$this->db->update('B001',$this->input->post());
		}
		redirect('Kodeinduk');
	}

	

	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				$columns = array('kode_ju', 'keterangan', 'sgl_sedia', 'sgl_pdpt', 'sgl_disjual', 'sgl_disbeli');
				//print_r($requestData);die();
				//$sel=implode(",", $columns);
				$sqlQuery = "SELECT kode_ju,keterangan,sgl_sedia,sgl_pdpt,sgl_disjual,sgl_disbeli
							FROM ( SELECT kode_ju,keterangan,sgl_sedia,sgl_pdpt,sgl_disjual,sgl_disbeli, ROW_NUMBER() OVER (ORDER BY [KODE_JU]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[B001] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				/*$sql = "SELECT $sel ";
				$sql.=" FROM po where id_user = '$session' $add_q";*/
				$sql = $this->db->select('kode_ju,keterangan,sgl_sedia,sgl_pdpt,sgl_disjual,sgl_disbeli')->get('B001');
				$totalData = $sql->num_rows();
				$totalFiltered = $totalData;  
				if( $requestData['search']['value'] ) {
					$sqlQuery.="AND kode_ju LIKE '%".$requestData['search']['value']."%' OR keterangan LIKE '%".$requestData['search']['value']."%' ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";
				/*$sql = $this->db->select('kode_ju,keterangan,sgl_sedia,sgl_pdpt,sgl_disjual,sgl_disbeli')
								->like('kode_ju',$requestData['search']['value'])
								->or_like('keterangan',$requestData['search']['value'])
								->order_by($columns[$requestData['order'][0]['column']],$requestData['order'][0]['dir'])
								->limit($requestData['start'].",".$requestData['length'])
								->get('B001');*/
				$sql=$this->db->query($sqlQuery);
				$totalFiltered = $sql->num_rows(); 
			    $res=$sql->result_array();
				
			} else { 	

				/*$sql = $this->db->select('kode_ju,keterangan,sgl_sedia,sgl_pdpt,sgl_disjual,sgl_disbeli')
								->order_by($columns[$requestData['order'][0]['column']],$requestData['order'][0]['dir'])
								->limit($requestData['start'].",".$requestData['length'])
								->get('B001');*/
				$sql=$this->db->query($sqlQuery);
				$res=$sql->result_array();
				
			}
			$data = [];
			foreach( $res as $k=>$row) {  
				$nestedData=array(); 
				$nestedData[] = $row["kode_ju"];
				$nestedData[] = $row["keterangan"];
				$nestedData[] = $row["sgl_sedia"];
				$nestedData[] = $row["sgl_pdpt"];
				$nestedData[] = $row["sgl_disjual"];
				$nestedData[] = $row["sgl_disbeli"];
				$nestedData[] = "<a class='btn btn-success' href='".base_url()."index.php/Kodeinduk/edit/".$row["kode_ju"]."'><span class='glyphicon glyphicon-pencil'> </span>Edit</a><a class='btn btn-danger' href='".base_url()."index.php/Kodeinduk/delete/".$row["kode_ju"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
				$data[] = $nestedData;
			}



			$json_data = array(
						"draw"            => intval( $requestData['draw'] ),  
						"recordsTotal"    => intval( $totalData ), 
						"recordsFiltered" => intval( $totalFiltered ), 
						"data"            => $data
						);

			echo json_encode($json_data);
    }
}

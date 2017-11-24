<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sgl extends CI_Controller {

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
		$this->load->view('index',['title'=>'Sub General Ledger']);
	}

	public function add()
	{
		$this->form_validation->set_rules('kodegl', 'Username', 'required');
		$form = [];
		$fk = 'codegl';
		$dataOptionsQuery = $this->db->select('codegl,namagl')
									 ->get('g001')->result_array();
		foreach ($dataOptionsQuery as $key => $value) {
			$dataOptions[$value['codegl']] = $value['namagl'];
		}
		$field = $this->db->field_data('g002');
		foreach ($field as $key => $value) {
			if($value->type=='nvarchar' && $value->name!=$fk){
				$form[] = ['type'=>'text',
							'name'=>$value->name,
							'value'=>$val[$value->name],
							'pk'=>0];
			}else if($value->type!='nvarchar' && $value->name!=$fk){
				$form[] = ['type'=>'number'
							,'name'=>$value->name,
							'value'=>$val[$value->name],
							'pk'=>0];
			}else if($value->name==$fk){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$dataOptions,'value'=>$val[$value->name]];
			}
		}
		
			$this->load->view('index',['title'=>'Tambah Sub General Ledger','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('g002',['codesgl'=>$id])->row();
		$form = [];
		$fk = 'codegl';
		$dataOptionsQuery = $this->db->select('codegl,namagl')
									 ->get('g001')->result_array();
		foreach ($dataOptionsQuery as $key => $value) {
			$dataOptions[$value['codegl']] = $value['namagl'];
		}
		$field = $this->db->field_data('g002');
		foreach ($field as $key => $value) {
			if($value->type=='nvarchar' && $value->name!=$fk){
				$form[] = ['type'=>'text',
							'name'=>$value->name,
							'value'=>$val[$value->name],
							'pk'=>$value->primary_key];
			}else if($value->type!='nvarchar' && $value->name!=$fk){
				$form[] = ['type'=>'number'
							,'name'=>$value->name,
							'value'=>$val[$value->name],
							'pk'=>$value->primary_key];
			}else if($value->name==$fk){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$dataOptions,'value'=>$val[$value->name]];
			}
		}
			$this->load->view('index',['title'=>'Edit Sub General Ledger','field'=>$form]);
		
	}

	public function proses($type){
		if($type=="add"){
			$this->db->insert('g002',$this->input->post());
		}else{
			$this->db->where('codesgl',$this->input->post('codesgl'));
			$this->db->update('g002',$this->input->post());
		}
		redirect('Sgl');
	}

	public function delete($id){
		$this->db->where('codesgl',$id);
		$this->db->delete('g002');
		redirect('Sgl');
	}

	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				

				$columns = array('codesgl','codegl','namasgl');
				$sqlQuery = "SELECT *
							FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY [codesgl]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[G002] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				$sql = $this->db->select('codesgl,codegl,namasgl')
								->get('G002');
				$totalData = $sql->num_rows();
				$totalFiltered = $totalData;  
				if( $requestData['search']['value'] ) {
				$sqlQuery.="AND codesgl LIKE '%".$requestData['search']['value']."%' OR namasgl LIKE '%".$requestData['search']['value']."%' ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";
					$sql=$this->db->query($sqlQuery);
								
								
				$totalFiltered = $sql->num_rows(); 
			    $res=$sql->result_array();
				
			} else { 	

				$sql = $this->db->query($sqlQuery);
								
				$res=$sql->result_array();
				
			}

			$data = [];
			foreach( $res as $k=>$row) {  
				$nestedData=array(); 
				$nestedData[] = $row["codesgl"];
				$nestedData[] = $row["codegl"];
				$nestedData[] = $row["namasgl"];
				$nestedData[] = "<a class='btn btn-success' href='".base_url()."index.php/".$this->uri->segment(1)."/edit/".$row["codesgl"]."'><span class='glyphicon glyphicon-pencil'> </span>Edit</a><a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["codesgl"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
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

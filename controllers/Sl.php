<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sl extends CI_Controller {

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
		$this->load->view('index',['title'=>'Sub Ledger']);
	}

	public function add()
	{
		$form = [];
		$fk = 'codesgl';
		$dataOptionsQuery = $this->db->select('codesgl,namasgl')
									 ->get('G002')->result_array();
		foreach ($dataOptionsQuery as $key => $value) {
			$dataOptions[$value['codesgl']] = $value['namasgl'];
		}
		$field = $this->db->field_data('g003');
		$form[] = ['type'=>'select',
							'name'=>'codesgl',
							'value'=>'',
							'options'=>$dataOptions,
							'pk'=>0];
							$form[] = ['type'=>'text',
							'name'=>'codesl',
							'value'=>$val['codesl'],
							'pk'=>0];
							$form[] = ['type'=>'text',
							'name'=>'namasl',
							'value'=>$val['namasl'],
							'pk'=>0];
		
			$this->load->view('index',['title'=>'Tambah Sub Ledger','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('G003',['codesl'=>$id])->row();
		$form = [];
		$fk = 'codesgl';
		$dataOptionsQuery = $this->db->select('codesgl,namasgl')
									 ->get('G002')->result_array();
		foreach ($dataOptionsQuery as $key => $value) {
			$dataOptions[$value['codesgl']] = $value['namasgl'];
		}
		$field = $this->db->field_data('g003');
		$form[] = ['type'=>'select',
							'name'=>'codesgl',
							'value'=>$val['codesgl'],
							'options'=>$dataOptions,
							'pk'=>0];
							$form[] = ['type'=>'text',
							'name'=>'codesl',
							'value'=>$val['codesl'],
							'pk'=>0];
							$form[] = ['type'=>'text',
							'name'=>'namasl',
							'value'=>$val['namasl'],
							'pk'=>0];
			$this->load->view('index',['title'=>'Edit Sub Ledger','field'=>$form]);
		
	}

	public function proses($type){
		if($type=="add"){
			$this->db->insert('G003',$this->input->post());
		}else{
			$this->db->where('codesl',$this->input->post('codesl'));
			$this->db->update('G003',$this->input->post());
		}
		redirect('Sl');
	}

	public function delete($id){
		$this->db->where('codesl',$id);
		$this->db->delete('G003');
		redirect('Sl');
	}

	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				

				$columns = array('codesl','codesgl','namasl','saldo_awal','mutasid','mutasic','saldo','s150','sldr','bph');
				$sqlQuery = "SELECT *
							FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY [codesl]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[G003] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				//$sel=implode(",", $columns);

				/*$sql = "SELECT $sel ";
				$sql.=" FROM po where id_user = '$session' $add_q";*/
				$sql = $this->db
								->get('g003');
				$totalData = $sql->num_rows();
				$totalFiltered = $totalData;  
				if( $requestData['search']['value'] ) {
				$sqlQuery.="AND codesl LIKE '%".$requestData['search']['value']."%' OR namasl LIKE '%".$requestData['search']['value']."%' ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";
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
				$nestedData[] = $row["codesl"];
				$nestedData[] = $row["codesgl"];
				$nestedData[] = $row["namasl"];
				
				$nestedData[] = "<a class='btn btn-success' href='".base_url()."index.php/".$this->uri->segment(1)."/edit/".$row["codesl"]."'><span class='glyphicon glyphicon-pencil'> </span>Edit</a><a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["codesl"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
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

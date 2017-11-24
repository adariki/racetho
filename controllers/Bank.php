<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {

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
		$this->load->view('index',['title'=>'Bank']);
	}

	public function add()
	{
		$form = [];
		$fk="SGL";
		$dataOptionsQuery = $this->db->select('codesl,namasl')
									 ->get('G003')->result_array();
		foreach ($dataOptionsQuery as $key => $value) {
			$dataOptions[$value['codesl']] = $value['namasl'];
		}
		$field = $this->db->field_data('C006');
		/*echo '<pre>';
		print_r($dataOptions);die();*/
		foreach ($field as $key => $value) {
			if($value->type=='nvarchar' && $value->name!=$fk){
				$form[] = ['type'=>'text','name'=>$value->name,'value'=>'','pk'=>0];
			}else if($value->type!='varchar' && $value->name!=$fk){
				$form[] = ['type'=>'number','name'=>$value->name,'value'=>'','pk'=>0];
			}else if($value->name==$fk){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$dataOptions];
			}

		}
		
			$this->load->view('index',['title'=>'Tambah Bank','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('C006',['NoRek'=>$id])->row();
		$form = [];
		$fk = "SGL";
		$dataOptionsQuery = $this->db->select('codesl,namasl')
									 ->get('G003')->result_array();
		foreach ($dataOptionsQuery as $key => $value) {
			$dataOptions[$value['codesl']] = $value['namasl'];
		}
		$field = $this->db->field_data('C006');
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
			$this->load->view('index',['title'=>'Edit Bank','field'=>$form]);
		
	}

	public function proses($type){
		if($type=="add"){
			$this->db->insert('C006',$this->input->post());
		}else{
			$this->db->where('NoRek',$this->input->post('NoRek'));
			$this->db->update('C006',$this->input->post());
		}
		redirect('Bank');
	}

	public function delete($id){
		$this->db->where('NoRek',$id);
		$this->db->delete('C006');
		redirect('Bank');
	}

	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				

				$columns = array(
		      'NoRek',
		      'Bank',
		      'Nama',
		      'SGL'
		      );
				//$sel=implode(",", $columns);
				$sqlQuery = "SELECT *
							FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY [NoRek]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[C006] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				/*$sql = "SELECT $sel ";
				$sql.=" FROM po where id_user = '$session' $add_q";*/
				$sql = $this->db->get('C006');
				$totalData = $sql->num_rows();
				$totalFiltered = $totalData;  
				if( $requestData['search']['value'] ) {
					$sqlQuery.="AND NoRek LIKE '%".$requestData['search']['value']."%' OR Bank LIKE '%".$requestData['search']['value']."%' ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";
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
				$nestedData[] = $row["NoRek"];
				$nestedData[] = $row["Bank"];
				$nestedData[] = $row["Nama"];
				$nestedData[] = $row["SGL"];
				$nestedData[] = "<a class='btn btn-success' href='".base_url()."index.php/".$this->uri->segment(1)."/edit/".$row["NoRek"]."'><span class='glyphicon glyphicon-pencil'> </span>Edit</a><a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["NoRek"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gl extends CI_Controller {

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
	public $label = ['Kode','Nama','Balance','Posisi','Jurnal Db/Cr'];
	public function index()
	{
		$this->load->view('index',['title'=>'General Ledger']);
	}

	public function add()
	{
		$form = [];
		$fk = "dbcr";
		$fk2 = "Balance";
		$fk3 = "posisi";
		$field = $this->db->field_data('g001');
		$dataOptions = ['D'=>'DEBET','C'=>'KREDIT'];
		$dataOptions2 = ['NERACA'=>'NERACA','LABA RUGI'=>'LABA RUGI'];
		$dataOptions3 = ['ASET'=>'ASET','BIAYA'=>'BIAYA','KEWAJIBAN'=>'KEWAJIBAN','MODAL'=>'MODAL','PENDAPATAN'=>'PENDAPATAN'];
		/*foreach ($field as $key => $value) {
			if($value->type=='nvarchar' && $value->name!=$fk && $value->name!=$fk2 && $value->name!=$fk3){
				$form[] = ['type'=>'text','name'=>$value->name,'value'=>'','label'=>$this->label[$key]];
			}else if($value->type!='nvarchar' && $value->name!=$fk && $value->name!=$fk2 && $value->name!=$fk3){
				$form[] = ['type'=>'number','name'=>$value->name,'value'=>'','label'=>$this->label[$key]];
			}else if($value->name==$fk){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$dataOptions,'label'=>$this->label[$key]];
			}else if($value->name==$fk2){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$dataOptions2,'label'=>$this->label[$key]];
			}
			else if($value->name==$fk3){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$dataOptions3,'label'=>$this->label[$key]];
			}
		}*/
			$form[] = ['type'=>'text','name'=>'codegl','value'=>'','label'=>$this->label[0]];
			$form[] = ['type'=>'text','name'=>'namagl','value'=>'','label'=>$this->label[1]];
			$form[] = ['type'=>'select','name'=>'Balance','options'=>$dataOptions2,'label'=>$this->label[2]];
			$form[] = ['type'=>'select','name'=>'posisi','options'=>$dataOptions3,'label'=>$this->label[3]];
			$form[] = ['type'=>'select','name'=>'dbcr','options'=>$dataOptions,'label'=>$this->label[4]];
			$this->load->view('index',['title'=>'Tambah General Ledger','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('G001',['codegl'=>$id])->row();
		$form = [];
		$fk = "dbcr";
		$fk2 = "Balance";
		$fk3 = "posisi";
		$field = $this->db->field_data('G001');
		$dataOptions = ['D'=>'DEBET','C'=>'KREDIT'];
		$dataOptions2 = ['NERACA'=>'NERACA','LABA RUGI'=>'LABA RUGI'];
		$dataOptions3 = ['ASET'=>'ASET','BIAYA'=>'BIAYA','KEWAJIBAN'=>'KEWAJIBAN','MODAL'=>'MODAL','PENDAPATAN'=>'PENDAPATAN'];
		$form[] = ['type'=>'text','name'=>'codegl','value'=>$val['codegl'],'label'=>$this->label[0]];
			$form[] = ['type'=>'text','name'=>'namagl','value'=>$val['namagl'],'label'=>$this->label[1]];
			$form[] = ['type'=>'select','name'=>'Balance','options'=>$dataOptions2,'label'=>$this->label[2],'value'=>$val['Balance']];
			$form[] = ['type'=>'select','name'=>'posisi','options'=>$dataOptions3,'label'=>$this->label[3],'value'=>$val['posisi']];
			$form[] = ['type'=>'select','name'=>'dbcr','options'=>$dataOptions,'label'=>$this->label[4],'value'=>$val['dbcr']];
			$this->load->view('index',['title'=>'Edit General Ledger','field'=>$form]);
		
	}

	public function proses($type){
		if($type=="add"){
			$this->db->insert('G001',$this->input->post());
		}else{
			$this->db->where('codegl',$this->input->post('codegl'));
			$this->db->update('G001',$this->input->post());
		}
		redirect('Gl');
	}

	public function delete($id){
		$this->db->where('codegl',$id);
		$this->db->delete('G001');
		redirect('Gl');
	}
	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				

				$columns = array('codegl','namagl','balance','posisi','dbcr');
				$sqlQuery = "SELECT *
							FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY [codegl]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[G001] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				$sql = $this->db->select('codegl,namagl,balance,posisi,dbcr')
								->get('g001');
				$totalData = $sql->num_rows();
				$totalFiltered = $totalData;  
				if( $requestData['search']['value'] ) {
				$sqlQuery.="AND codegl LIKE '%".$requestData['search']['value']."%' OR namagl LIKE '%".$requestData['search']['value']."%' ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";
					$sql=$this->db->query($sqlQuery);
								
								
				$totalFiltered = $sql->num_rows(); 
			    $res=$sql->result_array();
				
			} else { 	

				$sql = $sql=$this->db->query($sqlQuery);
								
				$res=$sql->result_array();
				
			}

			$data = [];
			foreach( $res as $k=>$row) {  
				$nestedData=array(); 
				$nestedData[] = $row["codegl"];
				$nestedData[] = $row["namagl"];
				$nestedData[] = $row["Balance"];
				$nestedData[] = $row["posisi"];
				$nestedData[] = $row["dbcr"];
				$nestedData[] = "<a class='btn btn-success' href='".base_url()."index.php/".$this->uri->segment(1)."/edit/".$row["codegl"]."'><span class='glyphicon glyphicon-pencil'> </span>Edit</a><a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["codegl"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
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

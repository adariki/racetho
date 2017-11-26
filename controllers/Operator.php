<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends CI_Controller {

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
	public $label = ['NoUrut','UserCode','Nama','Password'];
	public function index()
	{
		$this->load->view('index',['title'=>'Operator']);
	}

	public function add()
	{
		$form = [];
		$field = $this->db->field_data('C013');
		
			$form[] = ['type'=>'text','name'=>'NoUrut','value'=>'','label'=>$this->label[0],'pk'=>1];
			$form[] = ['type'=>'text','name'=>'UserCode','value'=>'','label'=>$this->label[1]];
			$form[] = ['type'=>'text','name'=>'Nama','value'=>'','label'=>$this->label[2]];
			$form[] = ['type'=>'password','name'=>'Password','value'=>'','label'=>$this->label[3]];
		
			$this->load->view('index',['title'=>'Tambah Operator','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('C013',['NoUrut'=>$id])->row();
		$form = [];
		$field = $this->db->field_data('C013');
			$form[] = ['type'=>'text','name'=>'NoUrut','value'=>$val['NoUrut'],'label'=>$this->label[0],'pk'=>1];
			$form[] = ['type'=>'text','name'=>'UserCode','value'=>$val['UserCode'],'label'=>$this->label[1]];
			$form[] = ['type'=>'text','name'=>'Nama','value'=>$val['Nama'],'label'=>$this->label[2]];
			$form[] = ['type'=>'password','name'=>'Password','value'=>$val['Password'],'label'=>$this->label[3]];
			$this->load->view('index',['title'=>'Edit Operator','field'=>$form]);
		
	}

	public function proses($type){
		$post = ['Nama'=>$this->input->post('Nama'),'UserCode'=>$this->input->post('UserCode'),'Password'=>md5($this->input->post('Password'))];
		if($type=="add"){
			$this->db->insert('C013',$post);
		}else{
			$this->db->where('NoUrut',$this->input->post('NoUrut'));
			$this->db->update('C013',$post);
		}
		redirect('Supplier');
	}

	

	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				

				$columns = array('NoUrut'
      ,'Codecab'
      ,'UserCode'
      ,'Password'
      ,'Nama'
      ,'GDbCr'
      ,'GBgOut'
      ,'GBgIn'
      ,'MutasiD'
      ,'MutasiC'
      ,'Saldo');
				//$sel=implode(",", $columns);
				$sqlQuery = "SELECT *
							FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY [Kode_hutang]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[C013] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				/*$sql = "SELECT $sel ";
				$sql.=" FROM po where id_user = '$session' $add_q";*/
				$sql = $this->db->get('C013');
				$totalData = $sql->num_rows();
				$totalFiltered = $totalData;  
				if( $requestData['search']['value'] ) {
					$sqlQuery.="AND NoUrut LIKE '%".$requestData['search']['value']."%' OR Nama LIKE '%".$requestData['search']['value']."%' ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";
					$sql=$this->db->query($sqlQuery);
				$totalFiltered = $sql->num_rows(); 
			    $res=$sql->result_array();
				
			} else { 	

				$sql = $this->db
								->order_by($columns[$requestData['order'][0]['column']],$requestData['order'][0]['dir'])
								->limit($requestData['length'])
								->get('C013');
								
				$res=$sql->result_array();
				
			}

			$data = [];
			foreach( $res as $k=>$row) {  
				$nestedData=array(); 
				$nestedData[] = $row["NoUrut"];
				$nestedData[] = $row["UserCode"];
				$nestedData[] = $row["Nama"];
				$nestedData[] = "<a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["NoUrut"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
				$data[] = $nestedData;
			}

/*<a class='btn btn-success' href='".base_url()."index.php/".$this->uri->segment(1)."/edit/".$row["NoUrut"]."'><span class='glyphicon glyphicon-pencil'> </span>Edit</a>*/

			$json_data = array(
						"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
						"recordsTotal"    => intval( $totalData ),  // total number of records
						"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
						"data"            => $data // total data array
						);

			echo json_encode($json_data);
    }
}

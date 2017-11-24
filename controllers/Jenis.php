<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

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
		$this->load->view('index',['title'=>'Jenis']);
	}

	public function add()
	{
		$form = [];
		$fk="";
		$field = $this->db->field_data('B001C');
		/*echo '<pre>';
		print_r($dataOptions);die();*/
		$valAI = $this->autoInc();
		
		$form[] = ['type'=>'text','name'=>'KODE_JNS','value'=>$valAI,'pk'=>1];
		$form[] = ['type'=>'text','name'=>'KETERANGAN','value'=>'','pk'=>0];
		
			$this->load->view('index',['title'=>'Tambah Jenis','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('B001C',['KODE_JNS'=>$id])->row();
		$form = [];
		$fk = "";
		
		$field = $this->db->field_data('B001C');
		$form[] = ['type'=>'text','name'=>'KODE_JNS','value'=>$val['KODE_JNS'],'pk'=>1];
		$form[] = ['type'=>'text','name'=>'KETERANGAN','value'=>$val['KETERANGAN'],'pk'=>0];
			$this->load->view('index',['title'=>'Edit Jenis','field'=>$form]);
		
	}

	public function proses($type){
		if($type=="add"){
			$this->db->insert('B001C',$this->input->post());
		}else{
			$this->db->where('KODE_JNS',$this->input->post('KODE_JNS'));
			$this->db->update('B001C',$this->input->post());
		}
		redirect('Jenis');
	}

	public function autoInc(){
		$query = $this->db->select('KODE_JNS')->order_by('KODE_JNS',"DESC")->limit(1)->get('B001C')->row();
		$num=(int) $query->KODE_JNS;
		$num=$num+1;
		if($num<10){
			$numInt = "0".$num;
		}else{
			$numInt=$num;
		}
		return $numInt;
	}

	public function delete($id){
		$this->db->where('KODE_JNS',$id);
		$this->db->delete('B001C');
		redirect('Jenis');
	}
	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				

				$columns = array(
		      'KODE_JNS'
		      ,'KETERANGAN'
		      );
				//$sel=implode(",", $columns);
				$sqlQuery = "SELECT *
							FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY [KODE_JNS]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[B001C] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				/*$sql = "SELECT $sel ";
				$sql.=" FROM po where id_user = '$session' $add_q";*/
				$sql = $this->db->get('B001C');
				$totalData = $sql->num_rows();
				$totalFiltered = $totalData;  
				if( $requestData['search']['value'] ) {
					$sqlQuery.="AND KODE_JNS LIKE '%".$requestData['search']['value']."%' OR KETERANGAN LIKE '%".$requestData['search']['value']."%' ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";
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
				$nestedData[] = $row["KODE_JNS"];
				$nestedData[] = $row["KETERANGAN"];
				$nestedData[] = "<a class='btn btn-success' href='".base_url()."index.php/".$this->uri->segment(1)."/edit/".$row["KODE_JNS"]."'><span class='glyphicon glyphicon-pencil'> </span>Edit</a><a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["KODE_JNS"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
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
